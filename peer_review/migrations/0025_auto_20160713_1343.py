# -*- coding: utf-8 -*-
# Generated by Django 1.9.7 on 2016-07-13 11:43
from __future__ import unicode_literals

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('peer_review', '0024_auto_20160712_1042'),
    ]

    operations = [
        migrations.RemoveField(
            model_name='user',
            name='id',
        ),
        migrations.AlterField(
            model_name='user',
            name='userId',
            field=models.CharField(max_length=12, primary_key=True, serialize=False),
        ),
    ]
