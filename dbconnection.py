#!/usr/bin/python

# pass list of json objects to functions for updating in DB
# Each json object for 1 incident
# json object example:
''' [ 	"date_submitted":"2016-03-13",
		"contributor_name": "abc"
		"contributor_email": "abc@gmail.com",
		"description":"description of incident",
		"url":url link,
		"date_occurred":"2016-03-10",
		"location":"US"
		"company":("abc","xyz"),
		"incidenttype": ("pii-leak"),
		"rootcause":("attack"),
		"people":("citizen","healthprofessionals"),
		"source":"news"
		"review": 0 
]'''


import mysql.connector
import json

class DBconnection:

	def __init__(self,config):
		self.config = config

	def insert(self,jsonfile):
		''' insert data into DB from json objects in file
		'''

		try:
			self.cnx = mysql.connector.connect(**self.config)
		except:
			print "Error connecting to DB"

		incidentIDs = []
		self.cursor = self.cnx.cursor()
		if jsonfile:
			with open(jsonfile,'r') as fin:
				input_json = json.load(fin)
			for row in input_json:
				self.inputrow = {}
				
				query = ("SELECT locationID FROM location WHERE location='{}'".format(row["location"]))
				self.cursor.execute(query)
				for each in self.cursor:
					self.inputrow["locationID"] = each[0]
				
				company = [c.encode("ascii") for c in row["company"]]
				self.inputrow["companyID"] = []
				query = ("SELECT companyID FROM company WHERE company in {}".format(tuple(company)))
				self.cursor.execute(query)
				for each in self.cursor:
					self.inputrow["companyID"].append(each[0])
			
				incidenttype = [c.encode("ascii") for c in row["incidenttype"]]
				self.inputrow["incidenttypeID"] = []
				query = ("SELECT incidenttypeID FROM incidenttype WHERE type in {}".format(tuple(incidenttype)))
				self.cursor.execute(query)
				for each in self.cursor:
					self.inputrow["incidenttypeID"].append(each[0])
				
				rootcause = [c.encode("ascii") for c in row["rootcause"]]
				self.inputrow["rootcauseID"] = []
				query = ("SELECT rootcauseID FROM rootcause WHERE rootcause in {}".format(tuple(rootcause)))
				self.cursor.execute(query)
				for each in self.cursor:
					self.inputrow["rootcauseID"].append(each[0])

				people = [c.encode("ascii") for c in row["people"]]
				self.inputrow["peopleID"] = []
				query = ("SELECT peopleID FROM people WHERE peopleaffected in {}".format(tuple(people)))
				self.cursor.execute(query)
				for each in self.cursor:
					self.inputrow["peopleID"].append(each[0])

				print(self.inputrow)
				self.inputrow["incidentID"] = []
				insertquery = ("INSERT INTO incidentdetails 	(date_submitted,date_occured,casestudy,contributor_name,contributor_email,description,link,source,locationID,review) "
												" VALUES (%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)")
				incidentdata = (row["date_submitted"],row["date_occurred"],"",row["contributor_name"],row["contributor_email"],row["description"],\
						row["url"],row["source"],self.inputrow["locationID"],row["review"])
				self.cursor.execute(insertquery,incidentdata)
				self.inputrow["incidentID"] = self.cursor.lastrowid

				insertquery = ("""INSERT INTO incidents VALUES (%s,%s,%s,%s,%s)""")	
				for company in self.inputrow["companyID"]:
					for incidenttype in self.inputrow["incidenttypeID"]:
						for rootcause in self.inputrow["rootcauseID"]:
							for people in self.inputrow["peopleID"]:
								data = (self.inputrow["incidentID"],incidenttype,company,people,rootcause)
								self.cursor.execute(insertquery,data)
								self.cnx.commit()
				incidentIDs.append(self.inputrow["incidentID"])

		self.cursor.close()
		self.cnx.close()
		return incidentIDs


	def queryallincidents(self):
		'''returns all incidents from DB'''
		try:
			self.cnx = mysql.connector.connect(**self.config)
		except:
			print "Error connecting to DB"
		self.incidents = []		
		query("SELECT DISTINCT incidentID FROM incidents")
		self.cursor.execute(query)
		for row in self.cursor:
			self.incidents.append(self.queryincident(row[0]))
		return self.incidents


	def queryincident(self,incidentID):
		'''returns json object of data for given incidentID'''

		try:
			self.cnx = mysql.connector.connect(**self.config)
		except:
			print "Error connecting to DB"

		self.cursor = self.cnx.cursor()
		query = ("SELECT * FROM incidents WHERE incidentID={}".format(incidentID))
		self.cursor.execute(query)
		self.incident = {"incidentID":incidentID,"incidenttypeID":[],"companyID":[],"peopleID":[],"rootcauseID":[]}
		for row in self.cursor:
			self.incident["incidenttypeID"].append(row[1])
			self.incident["companyID"].append(row[2])
			self.incident["peopleID"].append(row[3])
			self.incident["rootcauseID"].append(row[4])

		self.outputrow = {"incidentID":incidentID}
		query = ("SELECT * FROM incidentdetails WHERE incidentID={}".format(incidentID))
		self.cursor.execute(query)
		for row in self.cursor:
			self.incident["locationID"] = row[8]
			self.outputrow["date_submitted"] = row[1]
			self.outputrow["date_occurred"] = row[2]
			self.outputrow["contributor_name"] = row[3]
			self.outputrow["contributor_email"] = row[4]
			self.outputrow["description"] = row[5]
			self.outputrow["url"] = row[6]
			self.outputrow["source"] = row[7]

		query = ("SELECT location FROM location WHERE locationID={}".format(self.incident["locationID"]))
		self.cursor.execute(query)
		for each in self.cursor:
			self.outputrow["location"] = each[0]
		
		query = ("SELECT company FROM company WHERE companyID in {}".format(self.incident["companyID"]))
		self.cursor.execute(query)
		for each in self.cursor:
			self.outputrow["company"].append(each)
	
		query = ("SELECT type FROM incidenttype WHERE incidenttypeID in {}".format(row["incidenttype"]))
		self.cursor.execute(query)
		for each in self.cursor:
			self.outputrow["incidenttype"].append(each)
		
		query = ("SELECT rootcause FROM rootcause WHERE rootcauseID in {}".format(row["rootcause"]))
		self.cursor.execute(query)
		for each in self.cursor:
			self.outputrow["rootcause"].append(each)

		query = ("SELECT peopleaffected FROM people WHERE peopleID in {}".format(row["people"]))
		self.cursor.execute(query)
		for each in self.cursor:
			self.outputrow["people"].append(each)

		self.cursor.close()
		self.cnx.close()
		return json.dumps(self.outputrow,ensure_acsii=False)

if __name__ == "__main__":
		config = {
  	'user': 'root',
  	'password': 'zoro123',
  	'host': '127.0.0.1',
		'database':'Privacyincidents'
		}

		db = DBconnection(config)
	
		incidentids = db.insert("inputdata.json")
		for ID in incidentids:
				print db.queryincident(ID)

		print db.queryallincidents()
