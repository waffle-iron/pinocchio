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
		self.round1 = RoundDetail.objects.create(name='Round 1', startingDate=datetime.datetime.now(), endingDate=datetime.datetime.now(), description='Test Round 1')
		self.round2 = RoundDetail.objects.create(name='Round 2', startingDate=datetime.datetime.now(), endingDate=datetime.datetime.now(), description='Test Round 2')
	
	# Test that the user's team name is changed for the round
	def test_change_user_team_for_round(self):
		self.client.login(username='bob@bob.com', password='bob')
		
		# Change user1's teamName for round1 to 'Red'
		url = reverse('changeUserTeamForRound', kwargs={'round_pk':self.round1.pk, 'user_pk':self.user1.userId, 'team_name':'Red'})
		response = self.client.get(url)
		# Check if there are no errors
		self.assertEqual(response.status_code, 200)
		data = json.loads(response.content.decode())
		team = TeamDetail.objects.get(pk=data['team_pk'])
		# Test that the teamName is 'Red'
		self.assertEqual(team.teamName, 'Red')
		
		# Change user1's teamName for round1 to 'Green'
		url = reverse('changeUserTeamForRound', kwargs={'round_pk':self.round1.pk, 'user_pk':self.user1.userId, 'team_name':'Green'})
		response = self.client.get(url)
		# Check if there are no errors
		self.assertEqual(response.status_code, 200)
		data = json.loads(response.content.decode())
		team = TeamDetail.objects.get(pk=data['team_pk'])
		# Test that the teamName is 'Green'
		self.assertEqual(team.teamName, 'Green')
	
	def test_change_team_status(self):
		self.client.login(username='bob@bob.com', password='bob')
		team = TeamDetail.objects.create(user=self.user2, roundDetail)
		url = reverse('changeTeamStatus', kwargs={'team_pk':team.pk, 'status':})