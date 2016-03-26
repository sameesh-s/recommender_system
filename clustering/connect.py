#!/usr/bin/python
# view_rows.py - Fetch and display the rows from a MySQL database query

# import the MySQLdb and sys modules, sudo apt-get install python-MySQLdb
import MySQLdb
import sys
import gc

# open a database connection
# be sure to change the host IP address, username, password and database name to match your own
connection = MySQLdb.connect (host = "localhost", user = "root", passwd = "safeer", db = "mcadb")
# prepare a cursor object using cursor() method
cursor = connection.cursor ()

def listProducts( user_id ):
	products = []
	query = 'select product_id_wish from wishlist where user_id_wish ='+str(user_id)
	print query
	cursor.execute (query)
	for row in cursor:
		products.append(row[0])
	query = 'select order_line.product_line_id from purchased,order_line where purchased.user_id = '+str(user_id)+' and order_line.order_line_id = purchased.order_id'
	cursor.execute (query)
	for row in cursor:
		products.append(row[0])
	#print products
	return products

def closeC():
	# close the cursor object
	cursor.close ()
	# close the connection
	connection.close ()
	#grabage collection
	gc.collect()

def userList():
	cursor.execute ("select user_id from user")
	users = []
	for row in cursor:
		users.append(row[0])
	return users

if __name__ == '__main__':
	# execute the SQL query using execute() method.
	cursor.execute ("select * from brand")
	for row in cursor:
		print row[0], row[1]
	# fetch all of the rows from the query
	#data = cursor.fetchall ()
	#for row in data :
		#print row[0], row[1]
	closeC()
	# exit the program
	sys.exit()
