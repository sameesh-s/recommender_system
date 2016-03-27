#!/usr/bin/python
from random import randint , sample
import connect
import sys

number_clusters = 2
number_of_iterations = 3
user_length=0

def distance(center , point):
	print (center , point)
	a = connect.listProducts( center )
	b = connect.listProducts( point )
	return len(set(a) & set(b))

if __name__ == '__main__':

#retrive all user_ids from database
	users = []
	users = connect.userList();
	user_length = len( users )

#create randam central points for clusters
	clusters = []
	i = 0
	while i < number_clusters:	
		rand = randint(0,user_length-1)
		if users [rand] not in clusters:
			clusters.append( users [rand] )
			i = i + 1

#iterate to form cluster
	i=0
	while i < number_of_iterations:
		#iterate through all users
		user_no=0
		while user_no < user_length:
			point = users[ user_no]
			j=0
			max_similarity = -1
			while j < number_clusters:
				similar = distance( clusters [ j ] ,point)
				if (similar > max_similarity):
					max_similarity = similar
					user_cluster = j
					user_id = point
				j = j + 1
			connect.insertCluster( user_id, user_cluster, max_similarity )
			user_no = user_no + 1
		#compute new central points for clusters
		if i+1 < number_of_iterations: 
			temp = 0
			while temp < number_clusters:	
				clusters[ temp ]= connect.newMidPoint(temp)
				temp = temp + 1
			connect.deleteAll('cluster')
		i = i + 1

#close all connections
	connect.closeC()
	# exit the program
	sys.exit()
