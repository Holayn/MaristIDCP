DROP DATABASE IF EXISTS IDCP;
CREATE DATABASE IDCP;
USE IDCP;

CREATE TABLE IF NOT EXISTS BUG_REPORT(
	BUG_ID INT AUTO_INCREMENT PRIMARY KEY,
	NAME VARCHAR(255),
	EMAIL VARCHAR(255),
	COMMENT TEXT
);

CREATE TABLE IF NOT EXISTS IDCP_USER(
	USER_ID VARCHAR(255) PRIMARY KEY,
	USER_PWD VARCHAR(255) NOT NULL,
	USER_ROLE VARCHAR(10) NOT NULL
);

CREATE TABLE IF NOT EXISTS PROGRAM(
	PRG_ID INT AUTO_INCREMENT PRIMARY KEY,
	PRG_NAME VARCHAR(255) UNIQUE NOT NULL
); 

CREATE TABLE IF NOT EXISTS EMPLOYER(
    EMP_ID INT AUTO_INCREMENT PRIMARY KEY,
	EMP_NAME VARCHAR(255) UNIQUE NOT NULL,
	EMP_EMAIL VARCHAR(255),
	EMP_PHONE VARCHAR(20)
); 
		
CREATE TABLE IF NOT EXISTS PRG_ENROLLED(
	STU_ID INT NOT NULL,
	PRG_ID INT NOT NULL,
	PRG_ENROLL_STATUS VARCHAR(255),
	PRG_ENROLL_START DATE NOT NULL,
	PRG_ENROLL_END DATE
);

CREATE TABLE IF NOT EXISTS STUDENT( 
STU_ID INT, 
STU_TAG VARCHAR(30), 
STU_LNAME VARCHAR(255) NOT NULL, 
STU_FNAME VARCHAR(255) NOT NULL, 
STU_INITIAL CHAR(1), 
STU_START DATE NOT NULL, 
STU_END DATE, 
STU_EDU_LVL VARCHAR(255) NOT NULL, 
STU_JOB_TITLE VARCHAR(255) NOT NULL, 
STU_STREET VARCHAR(255) NOT NULL, 
STU_CITY VARCHAR(255) NOT NULL, 
STU_STATE VARCHAR(255) DEFAULT 'NA', 
STU_COUNTRY VARCHAR(255) NOT NULL, 
STU_ZIP VARCHAR(32) DEFAULT 'NA', 
STU_PHONE VARCHAR(20) DEFAULT 'NA', 
STU_EMAIL_1 VARCHAR(255) NOT NULL, 
STU_EMAIL_2 VARCHAR(255), 
STU_DOB DATE NOT NULL, 
STU_ETHNICITY VARCHAR(255) NOT NULL, 
STU_GENDER VARCHAR(10) NOT NULL, 
STU_CITIZEN VARCHAR(5) NOT NULL, 
STU_TRANSCRIPT VARCHAR(20) NOT NULL,
STU_COMMENT TEXT,
STU_QUALIFY_EXAM VARCHAR(5) NOT NULL,
EMP_ID INT
);

CREATE TABLE IF NOT EXISTS CERT_EARNED( 
STU_ID INT NOT NULL, 
CERT_ID INT NOT NULL, 
MAIL_DATE DATE,
EARN_DATE DATE NOT NULL 
);

CREATE TABLE IF NOT EXISTS INSTRUCTOR(
	INS_ID INT AUTO_INCREMENT PRIMARY KEY,
	INS_LNAME VARCHAR(255) NOT NULL,
	INS_FNAME VARCHAR(255) NOT NULL,
	INS_INITIAL CHAR(1),
	INS_EMAIL VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS TEACHES(
	INS_ID INT,
	CRS_ID VARCHAR(255) NOT NULL
);
		
CREATE TABLE IF NOT EXISTS COURSE(
    CRS_ID VARCHAR(255),
    CRS_NAME VARCHAR(255) NOT NULL,
    CRS_LEVEL VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS CRS_ENROLLED(
	CREDIT VARCHAR(5) NOT NULL,
	GRADE VARCHAR(2),
	CRS_ENROLL_STATUS VARCHAR(255) NOT NULL,
	CRS_ENROLL_START DATE NOT NULL,
	CRS_ENROLL_END DATE,
	CRS_ID VARCHAR(255) NOT NULL,
	STU_ID INT NOT NULL
);

CREATE TABLE IF NOT EXISTS CRS_MADE_OF(
  CRS_ID VARCHAR(255) NOT NULL,
  PRG_ID INT NOT NULL
);

CREATE TABLE IF NOT EXISTS CERTIFICATE( 
CERT_ID INT AUTO_INCREMENT PRIMARY KEY, 
CERT_NAME VARCHAR(255) NOT NULL,
PRG_ID INT
); 

ALTER TABLE PRG_ENROLLED
	ADD PRIMARY KEY (STU_ID, PRG_ID, PRG_ENROLL_START);

ALTER TABLE STUDENT 
	ADD PRIMARY KEY (STU_ID); 

ALTER TABLE CERT_EARNED 
	ADD PRIMARY KEY (STU_ID, CERT_ID);
  
ALTER TABLE TEACHES
  ADD PRIMARY KEY(INS_ID,CRS_ID);
  
ALTER TABLE COURSE
  ADD PRIMARY KEY (CRS_ID);
 
ALTER TABLE CRS_ENROLLED
  ADD PRIMARY KEY (CRS_ID, STU_ID, CRS_ENROLL_START);
  
ALTER TABLE CRS_MADE_OF
  ADD PRIMARY KEY (CRS_ID, PRG_ID);
	
ALTER TABLE CERTIFICATE 
	ADD FOREIGN KEY (PRG_ID) REFERENCES PROGRAM (PRG_ID);

ALTER TABLE CERT_EARNED 
	ADD FOREIGN KEY (STU_ID) REFERENCES STUDENT (STU_ID);

ALTER TABLE CERT_EARNED 
	ADD FOREIGN KEY (CERT_ID) REFERENCES CERTIFICATE (CERT_ID);

ALTER TABLE PRG_ENROLLED 
	ADD FOREIGN KEY (STU_ID) REFERENCES STUDENT (STU_ID);

ALTER TABLE PRG_ENROLLED 
	ADD FOREIGN KEY (PRG_ID) REFERENCES PROGRAM (PRG_ID);
 
ALTER TABLE TEACHES
	ADD FOREIGN KEY (INS_ID) REFERENCES INSTRUCTOR (INS_ID);
  
ALTER TABLE TEACHES
	ADD FOREIGN KEY (CRS_ID) REFERENCES COURSE (CRS_ID);
  
ALTER TABLE CRS_ENROLLED 
	ADD FOREIGN KEY (CRS_ID) REFERENCES COURSE (CRS_ID);
  
ALTER TABLE CRS_ENROLLED 
	ADD FOREIGN KEY (STU_ID) REFERENCES STUDENT (STU_ID);
  
ALTER TABLE CRS_MADE_OF
	ADD FOREIGN KEY (CRS_ID) REFERENCES COURSE (CRS_ID);
  
ALTER TABLE CRS_MADE_OF
	ADD FOREIGN KEY (PRG_ID) REFERENCES PROGRAM(PRG_ID);
	
INSERT INTO STUDENT (STU_ID, STU_LNAME, STU_FNAME, STU_INITIAL, 
	STU_EDU_LVL, STU_JOB_TITLE, STU_STREET, STU_CITY, STU_STATE,
	STU_COUNTRY, STU_ZIP, STU_PHONE, STU_EMAIL_1, STU_DOB, STU_START, STU_ETHNICITY, STU_GENDER, STU_CITIZEN, STU_TRANSCRIPT, STU_QUALIFY_EXAM, EMP_ID)
	VALUES(20012345, 'White', 'Lilly', '', 'High School', 'Sales Manager',
		'3399 North Rd', 'Poughkeepsie', 'New York', 'USA', '12601', '8451234567',
		'lilly@mail.edu', '1990-04-19', '2005-10-5', 'Asian', 'Female', 'Yes', 'College', 'Yes', 111),
		(20023456, 'Blue', 'Violet', 'R', 'Associates', 'IT Specialist',
		'123 Main Street', 'Newmarket', 'Ontario', 'Canada', 'S7S 8F8', '7894561237',
		'blue@canada.com', '1997-04-19', '2005-10-5', 'White', 'Female', 'Yes', 'High School', 'Yes', 222),
		(20034567, 'Smith', 'John', 'C', 'Bachelors', 'Accountant',
		'89 Warren Street', 'Townsville', 'X State', 'Y Country', '82738204',
		'0985678479', 'john@smith.com', '1990-04-19', '2005-10-5', 'Hispanic/Latino', 'Male', 'No', 'High School', 'Yes', 222),
		(19998939, 'Gill', 'Fiona', '', 'Associates', 'Mainframe Sys Engineer',
		'47 Viola Drive', 'East Hampton', 'CT', 'USA', '06424', '8606365821',
		'fiona.gill@fakemail.com', '1989-04-19', '2005-10-5', 'White', 'Female', 'Yes', 'High School', 'No', 333),
		(19998696, 'McDonald', 'Lillian', '', 'Bachelors', 'MVS Systems Programmer',
		'535 West 7th Street, Apt 2204', 'Charlotte', 'NC', 'USA', '28202',
		'7045901331', 'lillian.mcdonald@fakemail.com', '1990-04-19', '2005-10-5', 'White', 'Male', 'No', 'High School', 'Yes', 444),
		(19931615, 'Morgan', 'Charles', '', 'Bachelors', 'Analyst',
		'5 Bobolink Lane', 'Northport', 'NY', 'USA', '11768', '6312627476',
		'charles.morgan@fakemail.com', '1990-04-19', '2005-10-5', 'White', 'Male', 'Yes', 'None', 'Yes', 555);
		
		
INSERT INTO EMPLOYER
	VALUES(111, 'IBM', 'ibm@ibm.com', '8774266006'),
		(222, 'JP Morgan Chase', 'jpmorgan@chase.com', '8009359935'),
		(333, 'Aetna, Inc.', 'okonispa@aetna.com', '5162728765'),
		(444, 'Wachovia', 'wachovia@wachovia.com', '817263726'),
		(555, 'Depository Trust (DTCC)', 'pholton@dtcc.com', '4152329873');

INSERT INTO COURSE
	VALUES ('CMPT309L758', 'Project Management', 'Expert'),
		('NCRT710N002', 'Greening of the Data Center', 'Associates'),
		('NCRT130N008', 'z/OS Security Course', 'Associates'),
		('NCRT620N613', 'Basic Assembler Language', 'Professional'),
		('ITS430L758', 'System Analysis & Design', 'Expert'),
		('ORG203L758', 'Accounting for the Data Center', 'Associates');
	
INSERT INTO PROGRAM 
	VALUES (1, 'z/OS'),
	(2, 'Data Center');
	
INSERT INTO CERTIFICATE
	VALUES (123,'Assembler Application Programming Certificate', 1),
	(345, 'System z Assembler Certificate', 1),
	(342, 'COBOL Application Programming', 1),
	(837, 'System z Professional Certificate', 1),
	(889, 'Fake1 DC Certificate', 2),
	(726, 'Fake2 DC Certificate', 2);
	
INSERT INTO INSTRUCTOR
	VALUES (10021398, 'Baker', 'Helen', '', 'helen@email.com'),
		(10067886, 'Holton', 'Sam', 'E', 'sam@email.com'),
		(10087559, 'Ross', 'Melody', '', 'melody@email.com'),
		(10085470, 'Parker', 'Bryant', 'E', 'bryant@email.com'),
		(10076655, 'Brown', 'Albert', 'S', 'albert@email.com');
		
INSERT INTO TEACHES
	VALUES (10021398, 'CMPT309L758'),
		(10067886, 'ITS430L758'),
		(10087559, 'NCRT130N008'),
		(10087559, 'NCRT620N613'),
		(10085470, 'NCRT710N002'),
		(10076655, 'ORG203L758');
		
INSERT INTO PRG_ENROLLED (STU_ID, PRG_ID, PRG_ENROLL_STATUS, PRG_ENROLL_START)
	VALUES (19931615, 1, "Active", '1990-04-19'),
	(19998696, 1, "Failed", '1990-04-19'),
	(19998939, 1, "Dropped", '1990-04-19'),
	(20012345, 2, "Completed", '1990-04-19'),
	(20023456, 2, "Active", '1990-04-19'),
	(20034567, 2, "Active", '1990-04-19');
	
INSERT INTO CRS_ENROLLED (CREDIT, CRS_ENROLL_STATUS, CRS_ENROLL_START, CRS_ID, STU_ID)
	VALUES ('Yes', 'Active', '1990-04-19', 'CMPT309L758', 19931615),
	('Yes', 'Active', '1990-04-19', 'ITS430L758', 19931615),
	('Yes', 'Active', '1990-04-19', 'ITS430L758', 19998939),
	('Yes', 'Active', '1990-04-19', 'ITS430L758', 19998696),
	('Yes', 'Active', '1990-04-19', 'ORG203L758', 19998696),
	('Yes', 'Active', '1990-04-19', 'NCRT620N613', 19998696),
	('No', 'Active', '1990-04-19', 'NCRT620N613', 20012345),
	('No', 'Active', '1990-04-19', 'NCRT710N002', 20012345),
	('No', 'Active', '1990-04-19', 'NCRT710N002', 20023456);

INSERT INTO CRS_ENROLLED
	VALUES (1, 'A', 'Completed', '1990-04-19', '2005-10-5', 'ORG203L758', 20034567),
	(1, 'F', 'Failed', '2013-10-5', '2014-2-5', 'NCRT710N002', 20034567),
	(1, 'B+', 'Completed', '1990-04-19', '2005-10-5', 'NCRT710N002', 20034567);

INSERT INTO CERT_EARNED (STU_ID, CERT_ID, EARN_DATE)
	VALUES (20034567, 889, '1990-04-19'),
	(20023456, 889, '1990-04-19'),
	(20034567, 345, '1990-04-19');
	
INSERT INTO CRS_MADE_OF
	VALUES ('NCRT710N002', 1),
	('NCRT130N008', 1),
	('NCRT620N613', 1),
	('ITS430L758', 2),
	('ORG203L758', 2),
	('CMPT309L758', 2);
	
INSERT INTO IDCP_USER
	VALUES ('aduser', SHA1('adpass123'), 'Admin'),
	('suuser', SHA1('supass123'), 'Super User'),
	('uuser', SHA1('upass123'), 'User');