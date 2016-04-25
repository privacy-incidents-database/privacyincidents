#!/usr/bin/python

import mysql.connector
from mysql.connector import errorcode


DB_NAME = 'Privacyincidents'
TABLES = {}
TABLES['location'] = (
	"	CREATE TABLE `location` ("
	"	`locationID` int(11) NOT NULL AUTO_INCREMENT,"
	"	`location` varchar(100) NOT NULL,"
	"	PRIMARY KEY (`locationID`)"
	")	ENGINE=InnoDB")

TABLES['company'] = (
	"	CREATE TABLE `company` ("
	"	`companyID` int(11) NOT NULL AUTO_INCREMENT,"
	"	`company` varchar(100) NOT NULL,"
	"	PRIMARY KEY (`companyID`)"
	")	ENGINE=InnoDB")

TABLES['incidenttype'] = (
	"	CREATE TABLE `incidenttype` ("
	"	`incidenttypeID` int(11) NOT NULL AUTO_INCREMENT,"
	"	`type` varchar(100) NOT NULL,"
	"	PRIMARY KEY (`incidenttypeID`)"
	")	ENGINE=InnoDB")

TABLES['rootcause'] = (
	"	CREATE TABLE `rootcause` ("
	"	`rootcauseID` int(11) NOT NULL AUTO_INCREMENT,"
	"	`rootcause` varchar(100) NOT NULL,"
	"	PRIMARY KEY (`rootcauseID`)"
	")	ENGINE=InnoDB")

TABLES['people'] = (
	"	CREATE TABLE `people` ("
	"	`peopleID` int(11) NOT NULL AUTO_INCREMENT,"
	"	`peopleaffected` varchar(100) NOT NULL,"
	"	PRIMARY KEY (`peopleID`)"
	")	ENGINE=InnoDB")

TABLES['incidentdetails'] = (
	"   CREATE TABLE `incidentdetails` ("
	"   `incidentID` int(11) NOT NULL AUTO_INCREMENT,"
	"   `date_submitted` date,"
	"   `date_occured` date,"
	"   `casestudy` varchar(100),"
	"   `contributor_name` varchar(100),"
	"   `contributor_email` varchar(100),"
	"   `description` varchar(1000),"
	"   `link` varchar(1000),"
	"   `source` varchar(100),"
	"   `locationID` int(11) NOT NULL,"
	"   `review` tinyint(1),"
	"   PRIMARY KEY (`incidentID`),"
	"   CONSTRAINT FOREIGN KEY (`locationID`)"
	"   	REFERENCES `location` (`locationID`) ON DELETE CASCADE"
	")  ENGINE=InnoDB")

TABLES['incidents'] = (
	"	CREATE TABLE `incidents` ("
	"	`incidentID` int(11) NOT NULL,"	
	"	`incidenttypeID` int(11) NOT NULL,"
	"	`companyID` int(11) NOT NULL,"
	"	`peopleID` int(11) NOT NULL,"
	"	`rootcauseID` int(11) NOT NULL,"
	"	PRIMARY KEY (`incidentID`,`incidenttypeID`,`companyID`,`peopleID`,`rootcauseID`),"
	"	CONSTRAINT FOREIGN KEY (`incidentID`)"
	"		REFERENCES `incidentdetails` (`incidentID`) ON DELETE CASCADE,"
	"	CONSTRAINT FOREIGN KEY (`incidenttypeID`)"
	"		REFERENCES `incidenttype` (`incidenttypeID`) ON DELETE CASCADE,"
	"	CONSTRAINT FOREIGN KEY (`companyID`)"
	"		REFERENCES `company` (`companyID`) ON DELETE CASCADE,"
	"	CONSTRAINT FOREIGN KEY (`peopleID`)"
	"		REFERENCES `people` (`peopleID`) ON DELETE CASCADE,"
	"	CONSTRAINT FOREIGN KEY (`rootcauseID`)"
	"		REFERENCES `rootcause` (`rootcauseID`) ON DELETE CASCADE"
	")	ENGINE=InnoDB")

config = {
  'user': 'user',
  'password': 'passwd',
  'host': '127.0.0.1',
}

def create_database(cursor):
    try:
        cursor.execute(
            "CREATE DATABASE {}".format(DB_NAME))
    except mysql.connector.Error as err:
        print("Failed creating database: {}".format(err))
        exit(1)


cnx = mysql.connector.connect(**config)
cursor = cnx.cursor()

try:
    cnx.database = DB_NAME    
except mysql.connector.Error as err:
    if err.errno == errorcode.ER_BAD_DB_ERROR:
        create_database(cursor)
        cnx.database = DB_NAME
    else:
        print(err)
        exit(1)
print cnx.database
for name, ddl in TABLES.iteritems():
    try:
        print("Creating table {}: ".format(name))
        cursor.execute(ddl)
    except mysql.connector.Error as err:
        if err.errno == errorcode.ER_TABLE_EXISTS_ERROR:
            print("already exists.")
        else:
            print(err.msg)
    else:
        print("OK")

cursor.close()
cnx.close()
