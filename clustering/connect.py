#!/usr/bin/python
# import the MySQLdb and sys modules, sudo apt-get install python-MySQLdb
import MySQLdb
import sys
import gc

# open a database connection
# be sure to change the host IP address, username, password and database name to match your own
connection = MySQLdb.connect (host = "localhost", user = "root", passwd = "safeer", db = "mcadb")
# prepare a cursor object using cursor() method
cursor = connection.cursor ()

def deleteAll(table):
	query = 'delete from '+ table
	cursor.execute(query)
	connection.commit()

def newMidPoint(clust):
	query = 'select count(*) from cluster where cluster = '+ str(clust)
	try:
		cursor.execute(query)
        	rslt = cursor.fetchone()
		for row in rslt:
			median = int ( row/ 2 )  
		print median
		i = 0
		query = 'select user_id from cluster where cluster = '+ str(clust) +' ORDER BY similarity'
		cursor.execute(query)
		data = cursor.fetchall ()
		for row in data :
			if i == median:
				return row[0]
			i = i + 1
        except MySQLdb.ProgrammingError:
        	print "The following query failed:"
        	print query	

def insertCluster(user_id, clust, distance):
	query = 'insert into cluster values ( '+str(user_id) + ','+ str(clust) +','+ str(distance) +')'
	try:
        	cursor.execute(query)
		connection.commit()
        except MySQLdb.ProgrammingError:
        	print "The following query failed:"
        	print query

def listProducts( user_id ):
	products = []
	query = 'select product_id_wish from wishlist where user_id_wish ='+str(user_id)
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
	closeC()
	# exit the program
	sys.exit()
