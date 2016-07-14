from django.core.urlresolvers import reverse
from django.test import TestCase, Client

from peer_review.models import User, TeamDetail, RoundDetail

from peer_review.views import *
import json
import datetime

class MaintainTeamTests(TestCase):
	def setUp(self):
		self.client = Client()
		self.user1 = User.objects.create_user('bob@bob.com', 'bob')
		self.user2 = User.objects.create_user('joe@joe.com', 'joe')
		self.round1 = RoundDetail.objects.create(name='Round 1', startingDate=datetime.datetime.now(), endingDate=datetime.datetime.now(), description='Test Round 1')
		self.round2 = RoundDetail.objects.create(name='Round 2', startingDate=datetime.datetime.now(), endingDate=datetime.datetime.now(), description='Test Round 2')
	
	