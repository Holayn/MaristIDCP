(X) = Done
(!!!) = Attention

TO DO:
- sort dropdown menus
- keep checking for bugs
- add examples to help page
- edit help page
- change report query from like to something 

jQuery(document).ready(function($) {
	hi
}
Stuff I ran into:
If you are getting a mysqli error, make sure the connection to the DB is open! Sometimes a function closes it. Also, make sure you close the DB connection when redirecting to another page.
Getting rid of bottom scrollbar:**
Replace page content div container with:
<div class="container-fluid">
Also make titles headers with <div class="page-header">
-------------------------------------------------------------------
Notes:
Don't comment sql file
CHANGE DATE FORMAT

C9 DB CHANGES:
	I moved STU_QUALIFY_EXAM to PRG_ENROLLED, away from STUDENT. Makes more sense this way if student is in more than one program.
	Changed PRG_ENROLLED's ENROLL_STATUS to PRG_ENROLL_STATUS to match server database
	Changed EMP_ID to AUTO_INCREMENT. also had to define EMP_ID as primary in table definition rather than after because of AUTO_INCREMENT.
	Made enroll dates primary key in prg_enrolled, just like crs_enrolled
	Changed stu_transcript to store string
	Changed stu_citizen to store string
	Changed stu_qualify_exam to store string
	Changed credit to store string
	Made IDCP_USER one table and added role column
	STU_PHONE & EMP_PHONE is now varchar(20) bc international numbers are recorded too
	EMP_NAME cannot be null
	STU_TAG NOT UNIQUE, multiple student can have same tag
	4/3---
	Auto increment instructor id
	4/5---
	Auto increment program and certificate id
	Program name is now unique
	Student tag is now unique
	idcp user_id is now not a primary key. it's not needed. allows them to change their user id as well.
	Remove not null from prg id in Certificate?
	Stu_tag is now a varchar(30)
	4/9---
	Changed all dates to be dates, not integers.
	--changes made: prg_enroll_start, prg_enroll_end
	--changes made: stu_start, stu_end, stu_dob
	--mail_date and earn_date
	-- crs_enroll_start, crs_enroll_end
	Dates are stored in format of YYYY-MM-DD
	-- removed unique constraint of stu_tag (students can have same one)
	-- stu_start is NOT NULL
	-- USER_ID in IDCP_USER is primary key
	-- emp_name is now UNIQUE and NOT NULL
	
Server DB CHANGES:
	I moved STU_QUALIFY_EXAM to PRG_ENROLLED, away from STUDENT. Makes more sense this way if student is in more than one program.
	Changed PRG_ENROLLED's ENROLL_STATUS to PRG_ENROLL_STATUS to match server database
	Changed EMP_ID to AUTO_INCREMENT. also had to define EMP_ID as primary in table definition rather than after because of AUTO_INCREMENT.
	Made enroll dates primary key in prg_enrolled, just like crs_enrolled
	Changed stu_transcript to store string
	Changed stu_citizen to store string
	Changed stu_qualify_exam to store string
	Changed credit to store string
	Made IDCP_USER one table and added role column
	4/3---
	STU_PHONE & EMP_PHONE is now varchar(20) bc international numbers are recorded too
	STU_QUALIFY_EXAM matches C9 DB, STU_QUALIFY_EXAM VARCHAR(5) NOT NULL; data in table matches too
	STU_CITIZEN matches C9 DB, STU_CITIZEN VARCHAR(5) NOT NULL; data in table matches too
	CREDIT matches C9 DB, CREDIT VARCHAR(5) NOT NULL; data in table matches too
	4/5---
	4/9---
		Server database completely in sync with c9 db
	
Wendy Changelog:
	I made this change to the actual database too
	STU_PHONE IS NOW VARCHAR(20) since international numbers are included
	STU_TRANSCRIPT IS NOW VARCHAR(20) it can be high school, college, none
	Certificate pages are done, can search, view, add, and edit
	Changed primary key of CRS_ENROLLED to crs_id, stu_id, and the enroll date in sql file and database
	Updated sidebars of all pages to go to certificate.php when certificate is clicked
	Change user_id to string and remove user_name
	Server database fake data uploaded
	Server database table structures match idcp.sql (CRS_ENROLLED PK = CRS + STU + DATE, PRG_ENROLLED PK = PRG + STU +DATE, EMP_ID = AUTO_INCREMENT)
	Testing filter functions with student page in student_search.1.php'
	User pages complete
	report_student_in allow report from prg_enrolled, crs_enrolled, cert_earned and employer
	breadcrumbs added to all pages needed
	

What Wendy working on:
	Come up with design for functional report: SEE: report_student_in.php can do queries like how many students are blank in blank
	Queries will all be DISTINCT since they are all asking for how many, details don't matter
		1 page for generate students demographics (show student id, name, and 
		other field client wants with certain filter and sort) //How about show them all fields and give them option to sort by, just like in BookFace? e.g. for 5th query, would show all student info, along with the course that was taken in last five years
			✔ How many women have taken our courses? //(KAI-looking at patterns in queries) (SELECT * FROM STUDENT, CRS_ENROLLED WHERE STUDENT.STU_ID = CRS_ENROLLED.STU_ID AND STU_GENDER = 'Female')
			✔ How many students from a specific country have taken our courses? //(SELECT * FROM STUDENT, CRS_ENROLLED WHERE STUDENT.STU_ID = CRS_ENROLLED.STU_ID AND STU_COUNTRY = country)
			✔ How many undergraduates were enrolled in 2016? //(SELECT * FROM STUDENT, CRS_ENROLLED WHERE STUDENT.STU_ID = CRS_ENROLLED.STU_ID AND (STU_EDU_LVL = 'None' OR STU_EDU_LVL = 'High School') AND STU_START_YR < 2016 AND (STU_END_YR > 2016 OR STU_END_YR = NULL)
				- //queries above all take from student and crs_enrolled. 						

				- //also have query count and display result somewhere outside of table because that's what they're looking for (WENDY ??)

		1 page about students in certain course/program or have certain certificate 
		(show student id, name, and other field client wants for student in 
		certain course/program/certificate with certain filter and sort)
			✔ How many students completed this certificate in 2016? //(SELECT * FROM STUDENT, CERTIFICATE, CERT_EARNED WHERE connecting statements AND CERT_YR_EARNED = 2016 AND CERT_NAME = certname)
			✔ How many IBM employees have completed our program? //(SELECT * FROM STUDENT, EMPLOYER, PROGRAM, PRG_ENROLLED WHERE connecting statements AND EMPLOYER.name = IBM AND PRG_ENROLL_STATUS = complete)
				- //still concerned with students
				- //have count 
		
		o How many that were born after XX/XX/XXXX have taken our courses? //(SELECT * FROM STUDENT, CRS_ENROLLED WHERE STUDENT.STU_ID = CRS_ENROLLED.STU_ID AND STU_DOB > date)

		More complicated:
			o How many students have completed more than one certificate? //(SELECT * FROM STUDENT, CERT_EARNED, CERTIFICATE WHERE connecting statements GROUP BY STU_ID HAVING COUNT(*) > 1)
			o How many students have complete year 1, 2 & 3 (which would be Associate,
			Professional and Expert levels). //(SELECT * FROM STUDENT, COURSE, CRS_ENROLLED WHERE connecting statements AND CRS_LEVEL = yr)
			o How many of those students completed a certificate? //have this pop up after every query they do? this can apply to many queries WENDY: sounds good
			o How many undergraduates have taken courses in the last five years? //(SELECT * FROM STUDENT, CRS_ENROLLED WHERE STUDENT.STU_ID = CRS_ENROLLED.STU_ID AND THISYEAR - CRS_ENROLLED.ENROLL_START_YR <= 5)
				- //concerned with students and if they have taken courses, so need to also include crs_enrolled.
				
	(KAI) For each query that pulls from a certain set of tables, have a different page for each of those queries.
			e.g. queries that use tables STUDENT, CRS_ENROLLED would be on a page called Students and Demographics
				 queries that use tables STUDENT, CERTIFICATE, CERT_EARNED would be on a page called Students and Certificates
				 queries that use tables STUDENT, EMPLOYER, PROGRAM, PRG_ENROLLED would be on a page called Students and Programs
		  Home Report Page with buttons that direct to the different pages (WENDY: nice)
		  Each page displays table of relevant information. E.g. Students and their Courses page would have all student info and the courses they're enrolled in for each record.
			Like in BookFace, be able to set filter(s). Worry about sort later, not necessary yet. Reloading the page will reset the table, or can also have reset button.
			Have a record counter so they can see how many students apply to their filter.
			For now, we can just have boxes they enter info into above and submit, and filters the table for them? Much like what is already on report_student.php
	4/5---
		Help page layout
		Finish specific report
		Make query on query
	4/19---
		Change order by in student to last name first name
		Check for bugs on user pages

Christian Changelog:
	Added option to add courses from the edit student course home page
	Added option to add programs from the edit student program home page
	Updated all pages to include the new sidebar
	Added the dynamic search table to course searches
	Added option for course's program when adding a new course, inserts into CRS_MADE_OF
	Added programs pages
	Prevented people from skipping login
	Can now delete certificate, student, course, program. delete appropriate records in enrolled and part_of tables
	Added certificate option to update and add student certificates
	Made delete confirmation
	Started working on help page for student
	Began commenting code on pages
	

What Christian working on:
	--4/18--
	Continue write up help documentation
	Delete a student's certificate info
	
	
	

Kai Changelog:
	Finished add student
	Finished edit student
	Finished adding student's courses and programs
	Finished edit and view student's courses and programs and information (profile)
	Improved search page
	Made student profile detail page less pretty and more straightforward
	When user reloads page, keeps what they input in form (for student page)
	Error is thrown when user tries to enter duplicate student id
	Made add employer button on add student page functional
	3/28---
	Since dates are primary keys now, made change to how things work on edit-student-courses-home
	Since dates are primary key now, made change to how things work program edit student
	CREATED HEADER.PHP FILE! See index.php and student.php to see how to apply them to each file. So we don't need to change navbars across all pages.
	Updated all pages to require header.php!
	Added back buttons to course pages, updated course profile page and edit course page (added validator)
	Edit course_profile.php to match student_profile functionality
	Renamed all pages and links to pages (it was just a find and replace in cloud9)
	Added back buttons to pages to increase interface usability
	3/31---
	Created report_student_certificate
	4/3---
	Added sidebar highlighting page user is on
	Added adding and editing instructor and employer functionality
	Changed instructor id to auto increment
	4/4---
	Added input verification to add student (checking to see they entered data right, also escape stringing input)
	Added input verification to edit student
	Added input verification for add program
	Added input verification for edit program
	4/5---
	Program id also needs to autoincrement
	Certificate id also needs to autoincrement
	Made student tag unique
	Made program name unique
	Can't add duplicate program name
	Can't edit program name to program that already exists
	Can't add duplicate certificate name
	Can't edit to duplicate certificate name
	Removed adding and editing program id
	Removed adding and editing certificate id
	Can't add duplicate student tag
	Added input verification to add and edit course
	Added input verification to edit student course
	Added input verification to search pages
	Added input verification on add and edit employer and instructor
	Added input cleaning on report pages
	Removed primary key from idcp_user
	Changing username works, and adding new users works now as well
	Added input verification on user pages as well
	Throwing errors on adding duplicate program name, course id, certificate name
	All inputs verified
	4/9---
	Updated date stuff on add student
	Updated date stuff on edit student
	Updated date stuff for student detail profile
	Updated date stuff on add course for student
	Updated date stuff on edit course for student
	Updated daate stuff on add program for student
	Update date stuff on edit program for student
	
	
What Kai working on: 
	Look for ways to improve interface usability
	Sorting on search pages
	Help pages
	Make sure works on server(x)
	Write help on doc
	Change erd
	If student no courses, program, certificate, put none on profile page(x)
	How are student's status with certificate determined? Certificate progress bar? Be able to select what courses need to complete to get certificate, show progress
	Make input type email for student info(x)
	Have way to delete employer/instructor(x)
	Show what program course belongs to(x)
	Documentation(light)
	Copyright notice at bottom of page(x)
	Donald R Schwartz and Marist College(x)
	limit table ouput(x)
	timeout time session(x)
	Report year stuff doesn't work(x)
	Can you put number on top of the table(x)
	calendar on report(x)
	delete buttons to red(x)
	please clean up pages, especially on those confirm pages(x)
	table of contents(in progress)
	prevent adding duplicate instrcutor?(x)
	show what course teacher is teaching, choose teacher when making course (addcourse, editcourse, courseprofile instructorprofile)(x)
	working on populating edit course option(x)
	order by(x)
	add documentatino to student_helpers
	add filter?
	order by on instructors and employers(x)
	fix up userspage butons(x)
	show what students in that course on course page(x)
	FAQs section(x)
	show crs level for student course(x)
	gen report page buttons(x)
	icon title(x)
	url to navigate to add edit student course(?)(error)(nvm)
	duplicate checking to add program and course for student?
	change level to actual level(x)
	make sure breadcrumb pages are correctly named...(x)
	fix onload stuff on edit student page
	anything not a US state, remove from SQL db
	trying to make help highlight when selected(x)
	make modal pop up for error on add student page(x)
	error for adding course that already exists from add course for student
	update screenshots(x)
	make sure data input matches data that can be entered into DB (for wendy over summer)
------------------------------------------------------------------------------OLD STUFF--------------------------------------------------------------------------------------------------------









TO DO:
Help pages
Rename pages to not have zOS, and make sure all pages referenced in code are updated accordingly (x)
Make newindex.html the new index.html. Update sidebars (we need to agree on new design first) (x)
Import data to database. Done by importing data into a big table, and inserting with select (x)
Make user settings page (x)
Make IDCP settings page. Be able to add employers and instructors here (x)
Add Programs to the sidebar and all of its necessary parts (x)
Add Certificates to the sidebar and all of its necessary parts (x)
Be able to add an employer from add student page (x)
Be able to add courses in the Edit Student Courses page on student profile page
Be able to add programs in the Edit Student Programs page on student profile page
Add View/Edit pages for Student Certificates on student profile page (same like add courses/programs) (x)
When adding courses, be able to select what program the course is part of. Same when editing courses
Add breadcrumbs where it makes sense (https://www.tutorialspoint.com/bootstrap/bootstrap_breadcrumb.htm)
Escape_string all inputs (sanitizing) and improve data input validation
Change all instances of $_SESSION['stu_id'] to $_SESSION['STU_ID'] on pages that have broken PHP.
Maybe put header into its own file and include it on every page. That way don't have to change header on every page. (x)
Should store stu_transcript as string itself, not random 0, 1, 2. Random person looking at DB will not know what it means. Same with stu_qualify_exam in prg_enrolled.
DOes stu_qualify_exam actually belong in cert_enrolled?
Show position of current page (like on the navbar. highlighted)

Helpful Links:
http://getbootstrap.com/components/

Make sure to reference back to our ER diagram. [WENDY: i will upload the updated version to google docs, minor changes]

Make tables scrollable by surrounding table with <div class="span3" style="height: 200px !important; overflow: auto;"> 



Paper stuff:
What we doing and why
What/how site accomplishes
Screenshots and explanation of functionality

---------Kai's Old Notes--------

(!!!!!!!!!!!!)
Rename pages to not have zOS. That way, it's easier to duplicate for Data Center. MB guys -Kai
Our best bet is to have a folder named zOS and another folder named Data Center.
(!!!!!!!!!!!!see below big attention!!!)

Importing data to database  [Wendy's working on it]
Import data into big fake table, insert select.  [Wendy's working on it]

UPDATE SIDEBAR TO REFLECT NEW CHANGES, AS WELL AS INDEX.html. REPLACE zOS.php with index.html. Look at newindex.html

If there is error in DB, say they try to add in a tag that already exists for another student, then how to provide feedback?

(!!!!!!!!!!!!!!!!!!!!!!!!!big attention!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!)
student_profile_detail - what if student is enrolled in multiple programs? should we just make it one form, and no separate Data Center and z/OS?
e.g. if they want to add a Data Center student, but student is already a z/OS student, they won't be able to add the student. How to fix this?
Right now, I will show as much program information that they have in the detail page. Show all programs they're in dynamically and their info. (X)
On add student page, provide way to add what program(s) they are in. (X - made it a separate page like courses)
Program status (X)

OR include an option to add an existing student to a program (button on students page)?
Maybe we should scrap the separate program pages. Have a master student, courses, reports. When adding student, put what program(s) they are taking. Separate page, like when adding courses. be able to edit this. (X)
Same thing with adding courses. Have option to select what program it is part of
Put qualifying exam with prg_enrolled, not student. (X)
Separate student's courses by what program the courses correspond to. Actually, just make the table show what program they want to see for. easy with query
(!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!)


Be able to add courses to edit course page. e.g. student id of 103. Yolo Swag has no classes rn, be able to add courses from his profile page, in courses view.
Be able to add programs to edit programs page. same as courses above.
When adding a new course, make sure to also add a new record to CRS_MADE_OF! Otherwise, course isn't associated with a program. Also be able to edit what program course is part of.

Be able to change student's status in program - Active, Complete, Dropped, Failed

Edit student info (X)
and courses they're taking (x)

error checking on add student form (X)
error checking on add course for student (X)
seeing detail info for student (X)
separate inactive, active courses (X)
list 3 recent active courses (X)

put courses for student on add course page (X)
be able to add course from add course for student page, and go back to where you were before (this will be a lot of work. need to save user progress on that page. there could be problems if there are fields not set. maybe don't bother with this)
make them able to add an employer from add student screen (this will be a lot of work. need to save user progress on that page. there could be problems if there are fields not set.)

make user settings page
make IDCP settings page (top right)
	add employers
	add instructors

be able to search for students by name (who memorizes/searches by IDs?) (X)
display some students/courses in table when searching, or just give the whole list of students (!!!) (X)
display current courses for student (X)

add success pages (for ones that aren't obvious) (X mostly)
add edit student's courses page (X)

get current year (X)

breadcrumbs: https://www.tutorialspoint.com/bootstrap/bootstrap_breadcrumb.htm (we should def put this in)
pagination: https://www.tutorialspoint.com/bootstrap/bootstrap_pagination.htm (meh)
cool tricks: https://scotch.io/bar-talk/bootstrap-3-tips-and-tricks-you-might-not-know#how-to-enable-bootstrap-3-hover-dropdowns
Jquery and php: http://stackoverflow.com/questions/607673/setting-a-php-sessionvar-using-jquery

http://getbootstrap.com/components/