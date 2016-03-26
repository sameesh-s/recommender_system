#!/usr/bin/python
from random import randint , sample
import connect
import sys

number_clusters = 2
number_of_iterations = 1
user_length=0

def distance(center , point):
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
	print clusters

#iterate through all users to form cluster
	i=0
	while i < number_of_iterations:
		j=0
		while j < number_clusters:
			print distance( clusters [ j ] ,102548)
			j = j + 1
		i = i + 1

#close all connections
	connect.closeC()
	# exit the program
	sys.exit()
