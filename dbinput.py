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

import mysql

class DBinput:

	def __init__(self,database,host,user,pwd):
		self.database = database
		self.user = user
		self.pwd = pwd
		self.host = host

	def insert(self,jsonfile=None):
		self.cnx = mysql.connector.connect(user=self.user, password=self.pwd,
                              host=self.host,
                              database=self.database)
		
		self.cursor = self.cnx.cursor()
		if jsonfile:
			with open(jsonfile,'r') as fin:
				input_json = json.load(fin)
			for row in input_json:
				self.inputrow = {}
				
				query = ("SELECT locationID FROM location WHERE location={}".format(row["location"]))
				self.cursor.execute(query)
				for each in cursor:
					self.inputrow["locationID"] = each[0]
				
				query = ("SELECT companyID FROM company WHERE company in {}".format(row["company"]))
				self.cursor.execute(query)
				for each in cursor:
					self.inputrow["companyID"].append(each)
			
				query = ("SELECT incidenttypeID FROM incidenttype WHERE type in {}".format(row["incidenttype"]))
				self.cursor.execute(query)
				for each in cursor:
					self.inputrow["incidenttypeID"].append(each)
				
				query = ("SELECT rootcauseID FROM rootcause WHERE rootcause in {}".format(row["rootcause"]))
				self.cursor.execute(query)
				for each in cursor:
					self.inputrow["rootcauseID"].append(each)

				query = ("SELECT peopleID FROM people WHERE peopleaffected in {}".format(row["people"]))
				self.cursor.execute(query)
				for each in cursor:
					self.inputrow["peopleID"].append(each)

				insertquery = ("INSERT INTO incidentdetails VALUES (%s,%s,%s,%s,%s,%s,%s,%s,%s)")
				incidentdata = (row["date_submitted"],row["date_occurred"],row["contributor_name"],row["contributor_email"],row["description"],\
						row["url"],row["source"],self.inputrow["locationID"],row["review"])
				self.cursor.execute(insertquery,incidentdata)
				self.inputrow["incidentID"] = self.cursor.lastrowid

				insertquery = ("""INSERT INTO incidents VALUES (%s,%s,%s,%s,%s)""")	
				for company in self.inputrow["companyID"]:
					for incidenttype in self.inputrow["incidenttype"]:
						for rootcause in self.inputrow["rootcauseID"]:
							for people in self.inputrow["peopleID"]:
								data = (self.inputrow["incidentID"],incidenttype,company,people,rootcause)
								self.cursor.execute(insertquery,data)
								self.cnx.commit()

				self.cursor.close()
				self.cnx.close()
				
