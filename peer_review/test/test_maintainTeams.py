from django.core.urlresolvers import reverse
from django.test import TestCase, Client

from peer_review.models import User, TeamDetail, RoundDetail

from peer_review.views import *
import json
import datetime


class MaintainTeamTests(TestCase):
    def setUp(self):
        self.client = Client()
        self.user1 = User.objects.create_user('bob@bob.com', 'bob', userId=1)
        self.user2 = User.objects.create_user('joe@joe.com', 'joe', userId=2)
        self.round1 = RoundDetail.objects.create(name='Round 1', startingDate=datetime.datetime.now(),
                                                 endingDate=datetime.datetime.now(), description='Test Round 1')
        self.round2 = RoundDetail.objects.create(name='Round 2', startingDate=datetime.datetime.now(),
                                                 endingDate=datetime.datetime.now(), description='Test Round 2')

    def test_get_teams_for_round(self):
        self.client.login(username='bob@bob.com', password='bob')

        team1 = TeamDetail.objects.create(user=self.user1, roundDetail=self.round1, teamName='Team1', pk=123)
        team2 = TeamDetail.objects.create(user=self.user2, roundDetail=self.round1, teamName='Team2', pk=321)

        url = reverse("getTeamsForRound", kwargs={'round_pk':self.round1.pk})
        json_response = json.loads(self.client.get(url).content.decode())

        # Both teams should be in the JSON file as root keys
        self.assertIsNotNone(json_response[str(team1.pk)])
        self.assertIsNotNone(json_response[str(team2.pk)])

        # Both users should be in their respective teams
        json_response_team1 = json_response[str(team1.pk)]
        self.assertEqual(json_response_team1['teamName'], team1.teamName)
        self.assertEqual(json_response_team1['userId'], str(self.user1.pk))
        self.assertEqual(json_response_team1['status'], team1.status)

        json_response_team2 = json_response[str(team2.pk)]
        self.assertEqual(json_response_team2['teamName'], team2.teamName)
        self.assertEqual(json_response_team2['userId'], str(self.user2.pk))
        self.assertEqual(json_response_team2['status'], team2.status)