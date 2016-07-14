from django.core.urlresolvers import reverse
from django.test import TestCase, Client

from peer_review.models import User, TeamDetail, RoundDetail

from peer_review.views import *
import json

class MaintainTeamTests(TestCase):
	def setUp(self):
		self.client = Client()
        self.user1 = User.objects.create_user('bob@bob.com', 'bob')
        self.user2 = User.objects.create_user('joe@joe.com', 'joe')
		self.round1 = RoundDetail.objects.create(name="Round 1", )