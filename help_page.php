<!--Help Page-->
<?php 
    $title = "IDCP - Help Page";
    $page = 'help';
    require("includes/header.php");
?>
<style>
    .fakebtn{
    border-style: solid;
    border-width: thin;
}
</style>
<!-- Bread Crumbs -->
    <ol class = "breadcrumb">
        <li><a href = "home.php">Home</a></li>
        <li class = "active">Help Page</li>
    </ol>
<!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="page-header">
                    <h1> IDCP Help Page</h1>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="offset">Table of Contents</h2>
                        <div class="panel panel-default" style="width: 500px;">
                            <div class="panel-heading">
                                <h3 class="panel-title"></h3>
                            </div>
                            <div class="panel-body">
                                <ul>
                                    <li><a href="#stu">Student Pages</a></li>
                                    <ul>
                                        <li><a href="#add_stu">Add Student</a></li>
                                        <li><a href="#search_stu">Search Student</a></li>
                                        <li><a href="#edit_stu">Edit Student</a></li>
                                        <li><a href="#delete_stu">Delete Student</a></li>
                                        <li><a href="#add_stu_crs">Add Course for Student</a></li>
                                        <li><a href="#edit_stu_crs">Edit Course for Student</a></li>
                                        <li><a href="#delete_stu_crs">Delete Course for Student</a></li>
                                        <li><a href="#add_stu_prg">Add Program for Student</a></li>
                                        <li><a href="#edit_stu_prg">Edit Program for Student</a></li>
                                        <li><a href="#delete_stu_prg">Delete Program for Student</a></li>
                                        <li><a href="#add_stu_cert">Add Certificate for Student</a></li>
                                        <li><a href="#edit_stu_cert">Edit Certificate for Student</a></li>
                                        <li><a href="#delete_stu_cert">Delete Certificate for Student</a></li>
                                        <li><a href="#add_stu_emp">Add Employer for Student</a></li>
                                    </ul>
                                </ul>
                                <ul>
                                    <li><a href="#prg">Program Pages</a></li>
                                    <ul>
                                        <li><a href="#add_prg">Add Program</a></li>
                                        <li><a href="#search_prg">Search Program</a></li>
                                        <li><a href="#edit_prg">Edit Program</a></li>
                                        <li><a href="#delete_prg">Delete Program</a></li>
                                    </ul>
                                </ul>
                                <ul>
                                    <li><a href="#crs">Course Pages</a></li>
                                    <ul>
                                        <li><a href="#add_crs">Add Course</a></li>
                                        <li><a href="#search_crs">Search Course</a></li>
                                        <li><a href="#edit_crs">Edit Course</a></li>
                                        <li><a href="#delete_crs">Delete Course</a></li>
                                    </ul>
                                </ul>
                                <ul>
                                    <li><a href="#cert">Certificate Pages</a></li>
                                    <ul>
                                        <li><a href="#add_cert">Add Certificate</a></li>
                                        <li><a href="#search_cert">Search Certificate</a></li>
                                        <li><a href="#edit_cert">Edit Certificate</a></li>
                                        <li><a href="#delete_cert">Delete Certificate</a></li>
                                    </ul>
                                </ul>
                                <ul>
                                    <li><a href="#rpt">Report Pages</a></li>
                                    <ul>
                                        <li><a href="#demo_rpt">Generate Student Demographic Report</a></li>
                                        <li><a href="#in_rpt">Generate Report about Student in...</a></li>
                                        <li><a href="#specific_rpt">Generate Specific Report</a></li>
                                    </ul>
                                </ul>
                                <ul>
                                    <li><a href="#user">User Pages</a></li>
                                    <ul>
                                        <li><a href="#add_cert">Add User</a></li>
                                        <li><a href="#edit_user">Edit Your User Account</a></li>
                                        <li><a href="#change_pwd">Change Your User Password</a></li>
                                        <li><a href="#edit_user">Edit Other User Account</a></li>
                                        <li><a href="#change_other_pwd">Change Other User Password</a></li>
                                        <li><a href="#delete_other_user">Delete Other User</a></li>
                                    </ul>
                                </ul>
                                <ul>
                                    <li><a href="#idcp_settings">IDCP Settings Pages</a></li>
                                    <ul>
                                        <li><a href="#add_ins">Add Instructor</a></li>
                                        <li><a href="#search_ins">Search Instructor</a></li>
                                        <li><a href="#edit_ins">Edit Instructor</a></li>
                                        <li><a href="#delete_ins">Delete Instructor</a></li>
                                        <li><a href="#add_emp">Add Employer</a></li>
                                        <li><a href="#search_emp">Search Employer</a></li>
                                        <li><a href="#edit_emp">Edit Employer</a></li>
                                        <li><a href="#delete_emp">Delete Employer</a></li>
                                    </ul>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="offset">FREQUENTLY ASKED QUESTIONS:</h2>
                        <div class="panel panel-default" style="width: 500px;">
                            <div class="panel-heading">
                                <h3 id="add_stu" class="panel-title"></h3>
                            </div>
                            <div class="panel-body">
                                <ul>
                                    <li><big><a href="#add_stu">How do I add a student?</a></big><br></li>
                                    <li><big><a href="#rpt">How do I generate a report?</a></big><br></li>
                                    <li><big><a href="#edit_stu">How do I edit a student’s information?</a></big><br></li>
                                    <li><big><a href="#add_stu_cert">How do I add a certificate to a student’s record?</a></big><br></li>
                                    <li><big><a href="#change_pwd">How do I change my password?</a></big><br></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <h3 id="stu" class="offset">Student Pages</h3>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 id="add_stu" class="panel-title">Add Student</h3>
                            </div>
                            <div class="panel-body">
                                <p><b>How it works:</b> To add a new student, navigate to the <text class="fakebtn">Students</text> tab on the sidebar, or click <text class="fakebtn">Students</text> on the Welcome page. Click <text class="fakebtn">Add New Students</text> on that page to get started.</p>
                                <p>Once you are on the 'Add New Student' page, there will be four sections of fields to fill in student information. Any field marked with an <text style="color:red;">*</text> symbol is required, and the form can not be submitted without having those fields filled in. </p>
                                <p style="margin-left: 40px">Example: </p>
                                <p style="margin-left: 200px">Identification: </p>
                                <p style="margin-left: 136px"> ID<text style="color:red;">*</text>: <input type="text" value="12345678" readonly> </p>
                                <p style="margin-left: 80px"> First Name<text style="color:red;">*</text>: <input type="text" value="John" readonly> </p>
                                <p style="margin-left: 80px"> Last Name<text style="color:red;">*</text>: <input type="text" value="Smith" readonly> </p>
                                <p>If you are adding a student whose employer is not currently listed, click the <text class="fakebtn">Add an Employer</text> button next to the employer field. A small form should come up, and upon hitting submit you will be returned to the ‘Add New Student’ page.</p>
                                <p style="margin-left: 40px">
                                Employer*: <select disabled> <option>-- select an option --</option> </select> <text style="border-style: solid; border-width: thin;">Add an Employer</text>
                                <p>After filling out all of the required information fields, scroll to the bottom and hit the <text class="fakebtn">Submit</text> button. This will process the information and add the student to the database.</p>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 id="search_stu" class="panel-title">Search Student</h3>
                            </div>
                            <div class="panel-body">
                                <p><b>How it works:</b> To search a student, click the <text class="fakebtn">Students</text> tab on the sidebar, or click <text class="fakebtn">Students</text> on the Welcome page. Once you are on the "Students" page, click the <br><text class="fakebtn">Search for student</text> button. </p>
                                <p style="margin-left: 40px">Example: </p>
                                <p style="margin-left: 80px"> Search a Name or ID: <input type="text" value="John" readonly> <text class="fakebtn">Submit</text></p>
                                <p>On this page, all students will be listed in the table. To search for a specific student, you can enter either a first or last name, or a student ID. Once you type in the name or ID, hit submit and the table will refresh with your search. You can sort the results by the student’s first or last name, or reset your search by hitting the <text class="fakebtn">reset</text> button.</p>
                                <p>To view a student’s profile, simply click on their name within the table.</p>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 id="edit_stu" class="panel-title">Edit Student</h3>
                            </div>
                            <div class="panel-body">
                                <p><b>How it works:</b> To edit a Student, navigate to his/her student profile. Several boxes with information will show up in the student profile.</p>
                                <p>To edit student information, click the <text class="fakebtn">Edit</text> button in the 'Personal Info' box. A list of fields with their current information will load on the page. Edit any information needed and click the <text class="fakebtn">Submit</text> button at the bottom to finalize your changes. Remember to not leave any fields with an <text style="color:red;">*</text> blank, or you will not be able to submit the form.</p>
                                <p style="margin-left: 40px">Example: </p>
                                <p style="margin-left: 163px">Identification </p>
                                <p style="margin-left: 136px"> ID<text style="color:red;">*</text>: <input type="text" value="12345678" readonly> </p>
                                <p style="margin-left: 80px"> First Name<text style="color:red;">*</text>: <input type="text" value="John" readonly> </p>
                                <p style="margin-left: 80px"> Last Name<text style="color:red;">*</text>: <input type="text" value="Smith" readonly> </p>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 id="delete_stu" class="panel-title">Delete Student</h3>
                            </div>
                            <div class="panel-body">
                                <p><b>How it works:</b> To delete a Student, navigate to his/her student profile. There is a red <text class="fakebtn" style="border-color:red">Delete</text> button located at the bottom of the page. Upon clicking the button, you will have to confirm that you want to delete the student. Any students deleted will no longer show up in the student search! <b>WARNING: this change is permanent and cannot be undone.</b></p>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 id="add_stu_crs" class="panel-title">Add Course for Student</h3>
                            </div>
                            <div class="panel-body">
                                <p><b>How it works:</b> To enroll a student in a course, first you must navigate to their student profile. Under the courses box in their profile, click the <text class="fakebtn">Edit</text> button to bring you to the student’s enrolled courses page. At the bottom of this page, there is an <text class="fakebtn">Add Course</text> button.  </p>
                                <p>From here, select the Course Name, Enroll Date, and if they are taking it for credit. All of these fields are required, so make sure to fill out all 3.</p>
                                <p>Click the <text class="fakebtn">Submit</text> button at the bottom of the page and the student will be enrolled in the course.</p>
                                <p style="margin-left: 40px">Example: </p>
                                <p style="margin-left: 180px">Enrollment Information </p>
                                <p style="margin-left: 80px"> Course Name<text style="color:red;">*</text>: <select disabled> <option>CMPT309L758 Project Management</option> </select> </p>
                                <p style="margin-left: 98px"> Enroll Date<text style="color:red;">*</text>: <select disabled> <option>05/05/2017</option> </select> </p>
                                <p style="margin-left: 56px"> Taking for Credit?<text style="color:red;">*</text>: <select disabled> <option>Yes</option> </select> </p>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 id="edit_stu_crs" class="panel-title">Edit Course for Student</h3>
                            </div>
                            <div class="panel-body">
                                <p><b>How it works:</b> If you wish to edit one of the courses a student is enrolled in, navigate to the student’s profile and click the <text class="fakebtn">Edit</text> button in the 'Courses' box. Click on the course you would like to edit from one of the tables on the enrolled courses page. </p>
                                <p>This will bring you to the edit student courses page. Update any information needed and click the <text class="fakebtn">Submit</text> button to finalize your changes. Make sure to fill out all fields marked with an <text style="color:red;">*</text>, as they are required and the form cannot be submitted without them.</p>
                                <p style="margin-left: 40px">Example: </p>
                                <p style="margin-left: 173px">Standing </p>
                                <p style="margin-left: 80px"> Enroll Status<text style="color:red;">*</text>: <select disabled> <option>Active</option> </select> </p>
                                <p style="margin-left: 125px"> Grade: <select disabled> <option>A-</option> </select> </p>
                                <p style="margin-left: 48px"> Taking for Credit?<text style="color:red;">*</text>: <select disabled> <option>Yes</option> </select> </p>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 id="delete_stu_crs" class="panel-title">Delete Course for Student</h3>
                            </div>
                            <div class="panel-body">
                                <p><b>How it works:</b> To delete one of the courses a student is enrolled in, navigate to the student’s profile and click the <text class="fakebtn">Edit</text> button in the 'Courses' box. Click on the course you would like to delete from one of the tables on the enrolled courses page. </p>
                                <p>A red <text class="fakebtn" style="border-color:red;">Delete</text> button is located at the bottom of the page. Upon clicking it, you will be asked to confirm that you want to remove this course from the student’s enrolled courses. Click <text class="fakebtn">Yes</text> and the course will be removed. <b>WARNING: this change is permanent and cannot be undone.</b></p>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 id="add_stu_prg" class="panel-title">Add Program for Student</h3>
                            </div>
                            <div class="panel-body">
                                <p><b>How it works:</b> To add a program for a student, navigate to their student profile and click the <text class="fakebtn">Edit</text> button in the 'Programs' box. At the bottom of the page, click the <text class="fakebtn">Add Program</text> button. </p>
                                <p>Fill out all required fields and hit the <text class="fakebtn">Submit</text> button to add the program to the student. Remember, the form cannot be submitted unless all fields are filled out.</p>
                                <p style="margin-left: 40px">Example: </p>
                                <p style="margin-left: 205px">Program Information </p>
                                <p style="margin-left: 80px"> Enrollment Status<text style="color:red;">*</text>: <select disabled> <option>Active</option> </select> </p>
                                <p style="margin-left: 205px">Time Interval </p>
                                <p style="margin-left: 121px"> Enroll Date<text style="color:red;">*</text>: <select disabled> <option>05/05/2017</option> </select> </p>
                                <p style="margin-left: 137px"> End Date: <select disabled> <option>05/05/2017</option> </select> </p>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 id="edit_stu_prg" class="panel-title">Edit Program for Student</h3>
                            </div>
                            <div class="panel-body">
                                <p><b>How it works:</b> To edit a program for a student, navigate to their student profile and click the <text class="fakebtn">Edit</text> button in the 'Programs' box. Click the program you want to edit located in one of the tables on the page.</p>
                                <p>Make any changes needed and click the <text class="fakebtn">Submit</text> button. This will finalize your changes and update them on the student profile.</p>
                                <p style="margin-left: 40px">Example: </p>
                                <p style="margin-left: 149px">Program Information </p>
                                <p style="margin-left: 80px"> Program<text style="color:red;">*</text>: <select disabled> <option>Data Center</option> </select> </p>
                                <p style="margin-left: 81px"> End Date: <select disabled> <option>05/05/2017</option> </select> </p>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 id="delete_stu_prg" class="panel-title">Delete Program for Student</h3>
                            </div>
                            <div class="panel-body">
                                <p><b>How it works:</b> To delete a program for a student, navigate to their student profile and click the <text class="fakebtn">Edit</text> button in the 'Programs' box. Click the program you want to delete located in one of the tables on the page. </p>
                                <p>A red <text class="fakebtn" style="border-color:red;">Delete</text> button is located at the bottom of the page. To delete the program from the student’s profile, click <text class="fakebtn" style="border-color:red;">Delete</text>. Click <text class="fakebtn">Yes</text> to confirm the delete. <b>WARNING: this change is permanent and cannot be undone.</b></p>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 id="add_stu_cert" class="panel-title">Add Certificate for Student</h3>
                            </div>
                            <div class="panel-body">
                                <p><b>How it works:</b> To add a certificate for a student, navigate to their student profile and click the <text class="fakebtn">Edit</text> button in the 'Certificate' box. At the bottom of the page, click the <text class="fakebtn">Add Certificate</text> button. </p>
                                <p>Fill out all required fields and hit the <text class="fakebtn">Submit</text> button to add the certificate to the student. Remember, the form cannot be submitted unless all fields are filled out.</p>
                                <p style="margin-left: 40px">Example: </p>
                                <p style="margin-left: 205px">Certificate Information </p>
                                <p style="margin-left: 80px"> Certificate:<text style="color:red;">*</text>: <select disabled> <option>Certificate Name</option> </select> </p>
                                <p style="margin-left: 121px"> Earn Date<text style="color:red;">*</text>: <select disabled> <option>05/05/2017</option> </select> </p>
                                <p style="margin-left: 137px"> Mail Date: <select disabled> <option>05/05/2017</option> </select> </p>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 id="edit_stu_cert" class="panel-title">Edit Certficate for Student</h3>
                            </div>
                            <div class="panel-body">
                                <p><b>How it works:</b> To edit a certificate for a student, navigate to their student profile and click the <text class="fakebtn">Edit</text> button in the 'Certificates' box. Click the certificate you want to edit located in one of the tables on the page.</p>
                                <p>Make any changes needed and click the <text class="fakebtn">Submit</text> button. This will finalize your changes and update them on the student profile.</p>
                                <p style="margin-left: 40px">Example: </p>
                                <p style="margin-left: 149px">Certificate Information </p>
                                <p style="margin-left: 80px"> Certificate:<text style="color:red;">*</text>: <select disabled> <option>Certificate Name</option> </select> </p>
                                <p style="margin-left: 121px"> Earn Date<text style="color:red;">*</text>: <select disabled> <option>05/05/2017</option> </select> </p>
                                <p style="margin-left: 137px"> Mail Date: <select disabled> <option>05/05/2017</option> </select> </p>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 id="delete_stu_cert" class="panel-title">Delete Certificate for Student</h3>
                            </div>
                            <div class="panel-body">
                                <p><b>How it works:</b> To delete a certificate for a student, navigate to their student profile and click the <text class="fakebtn">Edit</text> button in the 'Certificates' box. Click the certificate you want to delete located in one of the tables on the page. </p>
                                <p>A red <text class="fakebtn" style="border-color:red;">Delete</text> button is located at the bottom of the page. To delete the program from the student’s profile, click <text class="fakebtn" style="border-color:red;">Delete</text>. Click <text class="fakebtn">Yes</text> to confirm the delete. <b>WARNING: this change is permanent and cannot be undone.</b></p>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 id="add_stu_emp" class="panel-title">Add Employer of Student</h3>
                            </div>
                            <div class="panel-body">
                                <p><b>How it works:</b> To add an employer for a student, navigate to their student profile and click the <text class="fakebtn">Edit</text> button in the 'Personal Info' box. Scroll down to 'Contact & Employer' and change the employer or click the 
                                <br><text class="fakebtn">Add an Employer</text> button. </p>
                                <p>Fill out all required fields and hit the <text class="fakebtn">Submit</text> button to add the employer to the student. Remember, the form cannot be submitted unless all fields required are filled out.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <h3 id="prg" class="offset">Program Pages</h3>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 id="add_prg" class="panel-title">Add Program</h3>
                            </div>
                            <div class="panel-body">
                                <p><b>How it works:</b> To add a new program, navigate to the <text class="fakebtn">Programs</text> tab on the sidebar, or click <text class="fakebtn">Programs</text> on the Welcome page. Click <text class="fakebtn">Add New Program</text> on this page to get started.</p>
                                <p>Once you are on the 'Add New Program' page, fill out the required field with the new program’s name. After, hit the <text class="fakebtn">Submit</text> button. This will add the program to the database.</p>
                                <p style="margin-left: 40px">Example: </p>
                                <p style="margin-left: 191px">Program Information </p>
                                <p style="margin-left: 80px"> Program Name<text style="color:red;">*</text>: <input type="text" value="12345678" readonly> </p>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 id="search_prg" class="panel-title">Search Program</h3>
                            </div>
                            <div class="panel-body">
                                <p><b>How it works:</b> To search for a program, click the <text class="fakebtn">Programs</text> tab on the sidebar, or click <text class="fakebtn">Programs</text> on the Welcome page. Once you are on the 'Programs' page, click the <text class="fakebtn">Search for Program</text> button.</p>
                                <p>On this page, all programs will be listed in a table. To search for a specific program, you can enter the program’s name into the search box. Once you type in the name, hit <text class="fakebtn">Submit</text> and the table will refresh with your search. </p>
                                <p>Click the <text class="fakebtn">Reset</text> button to reset your search.</p>
                                <p>To view program, click on its name within the table.</p>
                                <p style="margin-left: 40px">Example: </p>
                                <p style="margin-left: 80px"> Search a Name: <input type="text" value="Data Center" readonly> <text class="fakebtn">Submit</text></p>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 id="edit_prg" class="panel-title">Edit Program</h3>
                            </div>
                            <div class="panel-body">
                                <p><b>How it works:</b> To edit a program, navigate to the program’s profile by searching for the program. A panel labeled ‘Program Information’ will appear, which contains the program’s information. </p>
                                <p>To edit the program information, click the <text class="fakebtn">Edit</text> button in the ‘Program Information’ panel. Edit any information needed and click the <text class="fakebtn">Submit</text> button at the bottom to finalize your changes. Remember to not leave any fields with an <text style="color:red;">*</text> blank, or you will not be able to submit the form. As of now, a program’s only information is its name.</p>
                                <p style="margin-left: 40px">Example: </p>
                                <p style="margin-left: 191px">Program Information </p>
                                <p style="margin-left: 80px"> Program Name<text style="color:red;">*</text>: <input type="text" value="12345678" readonly> </p>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 id="delete_prg" class="panel-title">Delete Program</h3>
                            </div>
                            <div class="panel-body">
                                <p><b>How it works:</b> To delete a program, navigate to the program’s profile by searching for the program. Press the <text class="fakebtn">Edit</text> button. </p>
                                <p>At the bottom of the form, there is a red <text class="fakebtn" style="border-color:red;">Delete</text> button. Clicking this button will redirect you to a confirmation for deletion page. <b>WARNING: this change is permanent and cannot be undone.</b></p>
                                <p><b>It is highly advised not to delete a program, as it will delete all the certificates associated with that program.</b> If you wish to keep these certificates, first assign them to a different program.<p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <h3 id="crs" class="offset">Course Pages</h3>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 id="add_crs" class="panel-title">Add Course</h3>
                            </div>
                            <div class="panel-body">
                                <p><b>How it works:</b> To add a new course, navigate to the <text class="fakebtn">Courses</text> tab on the sidebar, or click <text class="fakebtn">Courses</text> on the Welcome page. Click <text class="fakebtn">Add New Course</text> on this page to get started.</p>
                                <p>Once you are on the ‘Add New Course’ page, fill out the required fields, or you will not be able to add the course. Enter the course ID, the course name, the level of the course, the program the course belongs to, and the instructor that teaches the course. After, hit the <text class="fakebtn">Submit</text> button. This will add the course to the database.</p>
                                <p style="margin-left: 40px">Example: </p>
                                <p style="margin-left: 158px">Course Information </p>
                                <p style="margin-left: 80px"> Course ID<text style="color:red;">*</text>: <input type="text" value="CMPT309L758" readonly> </p>
                                <p style="margin-left: 56px"> Course Name<text style="color:red;">*</text>: <input type="text" value="Project Management" readonly> </p>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 id="search_crs" class="panel-title">Search Course</h3>
                            </div>
                            <div class="panel-body">
                                <p><b>How it works:</b> To search for a course, click the <text class="fakebtn">Courses</text> tab on the sidebar, or click <text class="fakebtn">Courses</text> on the Welcome page. Once you are on the Courses page, click the <text class="fakebtn">Search for Course</text> button.</p>
                                <p>On this page, all courses will be listed in a table. To search for a specific courses, you can enter the course’s name or ID into the search box. Once you type in the name, hit <text class="fakebtn">Submit</text> and the table will refresh with your search. </p>
                                <p>You can order the table by course name or level. It is ordered by course ID by default.</p>
                                <p>Click the <text class="fakebtn">Reset</text> button to reset your search.</p>
                                <p>To view a course, click on its name within the table.</p>
                                <p style="margin-left: 40px">Example: </p>
                                <p style="margin-left: 80px"> Search a Name: <input type="text" value="Data Analytics" readonly> <text class="fakebtn">Submit</text></p>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 id="edit_crs" class="panel-title">Edit Course</h3>
                            </div>
                            <div class="panel-body">
                                <p><b>How it works:</b> To edit a course, navigate to the course’s profile by searching for the course. A panel labeled ‘Course Information’ will appear, which contains the course’s information. </p>
                                <p>To edit the course information, click the <text class="fakebtn">Edit</text> button in the ‘Course Information’ panel. Edit any information needed and click the <text class="fakebtn">Submit</text> button at the bottom to finalize your changes. Remember to not leave any fields with an <text style="color:red;">*</text> blank, or you will not be able to submit the form.</p>
                                <p style="margin-left: 40px">Example: </p>
                                <p style="margin-left: 158px">Course Information </p>
                                <p style="margin-left: 80px"> Course ID<text style="color:red;">*</text>: <input type="text" value="CMPT309L758" readonly> </p>
                                <p style="margin-left: 56px"> Course Name<text style="color:red;">*</text>: <input type="text" value="Project Management" readonly> </p>
                                <p style="margin-left: 60px"> Course Level<text style="color:red;">*</text>: <select disabled> <option>Professional</option> </select> </p>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 id="delete_crs" class="panel-title">Delete Course</h3>
                            </div>
                            <div class="panel-body">
                                <p><b>How it works:</b> To delete a course, navigate to the course’s profile by searching for the course. Press the <text class="fakebtn">Edit</text> button. </p>
                                <p>At the bottom of the form, there is a red <text class="fakebtn" style="border-color:red;">Delete</text> button. Clicking this button will redirect you to a confirmation for deletion page. <b>WARNING: this change is permanent and cannot be undone.</b></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <h3 id="cert" class="offset">Certificate Pages</h3>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 id="add_cert" class="panel-title">Add Certificate</h3>
                            </div>
                            <div class="panel-body">
                                <p><b>How it works:</b> To add a new certificate, navigate to the <text class="fakebtn">Certificates</text> tab on the sidebar, or click <text class="fakebtn">Certificates</text> on the Welcome page. Click <text class="fakebtn">Add New Certificate</text> on this page to get started.</p>
                                <p>Once you are on the ‘Add New Certificate’ page, fill out the required fields, or you will not be able to add the certificate. Enter the certificate name and the program the certificate belongs to. After, hit the <text class="fakebtn">Submit</text> button. This will add the certificate to the database.</p>
                                <p style="margin-left: 40px">Example: </p>
                                <p style="margin-left: 198px">Certificate Information </p>
                                <p style="margin-left: 80px"> Certificate Name<text style="color:red;">*</text>: <input type="text" value="Project Management" readonly> </p>
                                <p style="margin-left: 63px"> Certificate Program<text style="color:red;">*</text>: <select disabled> <option>Data Center</option> </select> </p>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 id="search_cert" class="panel-title">Search Certificate</h3>
                            </div>
                            <div class="panel-body">
                                <p><b>How it works:</b> To search for a certificate, click the <text class="fakebtn">Certificates</text> tab on the sidebar, or click <text class="fakebtn">Certificates</text> on the Welcome page. Once you are on the Certificates page, click the <text class="fakebtn">Search for Certificate</text> button.</p>
                                <p>On this page, all certificates will be listed in a table. To search for a specific certificates, you can enter the certificate’s name into the search box. Once you type in the name, hit <text class="fakebtn">Submit</text> and the table will refresh with your search. </p>
                                <p>Click the <text class="fakebtn">Reset</text> button to reset your search.</p>
                                <p>To view a certificate, click on its name within the table.</p>
                                <p style="margin-left: 40px">Example: </p>
                                <p style="margin-left: 80px"> Search a Name: <input type="text" value="COBOL Application" readonly> <text class="fakebtn">Submit</text></p>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 id="edit_cert" class="panel-title">Edit Certificate</h3>
                            </div>
                            <div class="panel-body">
                                <p><b>How it works:</b> To edit a certificate, navigate to the certificate’s profile by searching for the certificate. A panel labeled ‘Certificate Information’ will appear, which contains the certificate’s information. </p>
                                <p>To edit the certificate information, click the <text class="fakebtn">Edit</text> button in the ‘Certificate Information’ panel. Edit any information needed and click the <text class="fakebtn">Submit</text> button at the bottom to finalize your changes. Remember to not leave any fields with an <text style="color:red;">*</text> blank, or you will not be able to submit the form.</p>
                                <p style="margin-left: 40px">Example: </p>
                                <p style="margin-left: 198px">Certificate Information </p>
                                <p style="margin-left: 80px"> Certificate Name<text style="color:red;">*</text>: <input type="text" value="Project Management" readonly> </p>
                                <p style="margin-left: 63px"> Certificate Program<text style="color:red;">*</text>: <select disabled> <option>Data Center</option> </select> </p>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 id="delete_cert" class="panel-title">Delete Certificate</h3>
                            </div>
                            <div class="panel-body">
                                <p><b>How it works:</b> To delete a certificate, navigate to the certificate’s profile by searching for the certificate. Press the <text class="fakebtn">Edit</text> button. </p>
                                <p>At the bottom of the form, there is a red <text class="fakebtn" style="border-color:red;">Delete</text> button. Clicking this button will redirect you to a confirmation for deletion page. <b>WARNING: this change is permanent and cannot be undone.</b></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <h3 id="rpt" class="offset">Report Pages</h3>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 id="demo_rpt" class="panel-title">Student Demographic Report</h3>
                            </div>
                            <div class="panel-body">
                                <p><b>How it works:</b> To generate a report of all the students that fall under a specific demographic, first click the demographic that you want. Then input the specification and click <text class="fakebtn">Submit</text>. The more specific the input, the more accurate the report will be.</p>
                                <p style="margin-left: 40px">Example: How many students are from New York City?</p>
                                    <!--<p style="margin-left: 80px">Demographic*: City</p>-->
                                    <!--<p style="margin-left: 80px">Specifically*: New</p> -->
                                        <p style="margin-left: 80px">
                                            Demographic*: <select disabled> <option>City</option> </select>
                                        </p>
                                        <p style="margin-left: 80px">
                                            Specifically*: <input type="text" value="New" readonly>
                                        </p>
                                        <p style="margin-left: 120px"><i>will give you students from all cities that have “New” in the name</i></p>
                                        <p style="margin-left: 80px">
                                            Specifically*: <input type="text" value="New York" readonly>
                                        </p>
                                        <p style="margin-left: 120px"><i>will give you students from New York only</i></p>
                                <p>To generate a report about those students, click <text class="fakebtn">How many of these students…</text> and select the option you want.</p>
                                    <p style="margin-left: 40px">Example: How many of those students from New York City have completed a certificate?</p>
                                        <p style="margin-left: 80px"><text class="fakebtn">How many of these students…</text> > Have completed a*: <select disabled> <option>Certificate</option> </select> > <text class="fakebtn">Submit</text></p>
                                <p>When you are satisfy with the report generated, simply click the <text class="fakebtn">Print</text> button to print the report or click the <text class="fakebtn">Export as .csv</text> button to download the report as a .csv file.</p>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 id="in_rpt" class="panel-title">Student in... Report</h3>
                            </div>
                            <div class="panel-body">
                                <p><b>How it works:</b> To generate a report of the students in a specific program/course or have a specific certificate/employer or is in a program/course or have a certificate/employer in general, first click the option you want. Second, choose a specific name or select all. Then choose the category you want to filter by. Lastly, input the specification and click <b>Submit</b>. The more specific the input, the more accurate the report will be. </p>
                                    <p style="margin-left: 40px">Example: How many students in “Project Management” course are female?
                                        <!--<p style="margin-left: 80px">In*: Course</p>-->
                                        <!--<p style="margin-left: 80px">Name*: Project Management</p>-->
                                        <!--<p style="margin-left: 80px">Where*: Gender</p>-->
                                        <!--<p style="margin-left: 80px">Specific*: Female</p>-->
                                        <p style="margin-left: 80px">
                                            In*: <select disabled> <option>Course</option> </select>
                                        </p>
                                        <p style="margin-left: 80px">
                                            Name*: <select disabled> <option>Project Management</option> </select>
                                        </p>
                                        <p style="margin-left: 80px">
                                            Where*: <select disabled> <option>Gender</option> </select>
                                        </p>
                                        <p style="margin-left: 80px">
                                            Specific*: <input type="text" value="Female" readonly>
                                        </p>
                                <p>To generate a report about those students, click <text class="fakebtn">How many of these students…</text> and select the option you want.</p>
                                    <p style="margin-left: 40px">Example: How many of those female students in “Project Management” have completed a certificate?</p>
                                        <p style="margin-left: 80px"><text class="fakebtn">How many of these students…</text> > Have completed a*: <select disabled> <option>Certificate</option> </select> > <text class="fakebtn">Submit</text></p>
                                <p>When you are satisfy with the report generated, simply click the <text class="fakebtn">Print</text> button to print the report or click the <text class="fakebtn">Export as .csv</text> button to download the report as a .csv file.</p>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 id="specific_rpt" class="panel-title">Specific Report</h3>
                            </div>
                            <div class="panel-body">
                                <p><b>How it works:</b> To generate a more complex report, choose from the list of predefined reports. Input any specifications if needed and click <text class="fakebtn">Submit</text>.</p>
                                    <p style="margin-left: 40px">Example: How many students who took our course were born after January 1, 1990?</p>
                                        <!--<p style="margin-left: 80px">Question*: How many students who took our course were born after…</p>-->
                                        <!--<p style="margin-left: 80px">Birthdate*: 01/01/1990</p>-->
                                        <p style="margin-left: 80px">
                                            Question*: <select disabled> <option>How many students who took our course were born after…</option> </select>
                                        </p>
                                        <p style="margin-left: 80px">
                                            Birthdate*: <select disabled> <option>01/01/1990</option> </select>
                                        </p>
                                <p>To generate a report about those students, click <text class="fakebtn">How many of these students…</text> and select the option you want.</p>
                                    <p style="margin-left: 40px">Example: How many of those students born after after January 1, 1990 have completed a certificate?</p>
                                        <p style="margin-left: 80px"><text class="fakebtn">How many of these students…</text> > Have completed a*: <select disabled> <option>Certificate</option> </select> > <text class="fakebtn">Submit</text></p>
                                <p>When you are satisfy with the report generated, simply click the <text class="fakebtn">Print</text> button to print the report or click the <text class="fakebtn">Export as .csv</text> button to download the report as a .csv file.</p>
                                <p>If the report you need is not listed, please contact us.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <h3 id="user" class="offset">User Pages</h3>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 id="add_user" class="panel-title">Add User</h3>
                            </div>
                            <div class="panel-body">
                                <p><b>How it works:</b> To add a new user, click your user id in the top menu bar and navigate to the ‘User Settings’ tab on the drop-down menu. Click <text class="fakebtn">Create New User</text> under 'Task'. Enter an ID using numbers and letters only. Then enter the password twice (a strong password with Capital letters, numbers and special characters is recommended). Lastly, assign the role of the user (see privileges of each role below).</p>
                                <p style="margin-left: 40px"> Admin & Super User: Search, view, add, edit, and delete Students, Programs, Courses, Certificates, Employers, and Instructors. Change password, role, and user id for all users.</p>
                                <p style="margin-left: 40px"> User: Search and view information about Students, Programs, Courses, Certificates, Employers, and Instructors. Change your own password and user id. </p>
                                <p style="margin-left: 40px">Example: </p>
                                <p style="margin-left: 140px">User Information </p>
                                <p style="margin-left: 114px"> ID<text style="color:red;">*</text>: <input type="text" value="user123" readonly> </p>
                                <p style="margin-left: 66px"> Password<text style="color:red;">*</text>: <input type="password" value="user123" readonly> </p>
                                <p style="margin-left: 11px"> Confirm Password<text style="color:red;">*</text>: <input type="password" value="user123" readonly> </p>
                                <p style="margin-left: 97px"> Role<text style="color:red;">*</text>: <select disabled> <option>User</option> </select> </p>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 id="edit_user" class="panel-title">Edit Your User Account</h3>
                            </div>
                            <div class="panel-body">
                                <p><b>How it works:</b> To edit your user id or role, click your user id in the top menu bar and navigate to the ‘User Settings’ tab on the drop-down menu. Click <text class="fakebtn">Edit</text> under 'Account Information'. Enter the new user id and/or select the new role. Then enter your password and click <text class="fakebtn">Submit</text> to make the change. </p>
                                <p style="margin-left: 40px">Example: </p>
                                <p style="margin-left: 140px">Manage Your Account </p>
                                <p style="margin-left: 114px"> ID<text style="color:red;">*</text>: <input type="text" value="yourUserID" readonly> </p>
                                <p style="margin-left: 99px"> Role<text style="color:red;">*</text>: <select disabled> <option>User</option> </select> </p>
                                <p style="margin-left: 6px"> Enter your
                                <br>Current Password*<text style="color:red;">*</text>: <input type="password" value="user123" readonly> </p>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 id="change_pwd" class="panel-title">Change Your User Password</h3>
                            </div>
                            <div class="panel-body">
                                <p><b>How it works:</b> To change your password, in User Settings, click your user id in the top menu bar and navigate to the ‘User Settings’ tab on the drop-down menu. <br>Click <text class="fakebtn">Change Password</text> under 'Account Information'. First enter your current password, then enter the new password and confirm it. Click <text class="fakebtn">Submit</text> to make the change.</p> 
                                <p style="margin-left: 40px">Example: </p>
                                <p style="margin-left: 172px">Change Your Password </p>
                                <p style="margin-left: 146px"> ID<text style="color:red;">*</text>: <input type="text" value="yourUserID" readonly> </p>
                                <p style="margin-left: 46px"> Current Password<text style="color:red;">*</text>: <input type="text" value="user123" readonly> </p>
                                <p style="margin-left: 66px"> New Password<text style="color:red;">*</text>: <input type="password" value="user123" readonly> </p>
                                <p style="margin-left: 11px"> Confirm New Password<text style="color:red;">*</text>: <input type="password" value="user123" readonly> </p>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 id="edit_other_user" class="panel-title">Edit Other User Account</h3>
                            </div>
                            <div class="panel-body">
                                <p><b>How it works:</b> To edit another user’s user id or role, in User Settings, click on the user’s id within the table. Click <text class="fakebtn">Edit</text> under 'Account Information'. Enter the new user id and/or select the new role. Then enter your password and click <text class="fakebtn">Submit</text> to make the change. </p>
                                <p style="margin-left: 40px">Example: </p>
                                <p style="margin-left: 140px">Manage thisuser's User Account </p>
                                <p style="margin-left: 114px"> ID<text style="color:red;">*</text>: <input type="text" value="thisuser" readonly> </p>
                                <p style="margin-left: 99px"> Role<text style="color:red;">*</text>: <select disabled> <option>User</option> </select> </p>
                                <p style="margin-left: 59px"> Enter your
                                <br>Password*<text style="color:red;">*</text>: <input type="password" value="user123" readonly> </p>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 id="change_other_pwd" class="panel-title">Change Other User's Password</h3>
                            </div>
                            <div class="panel-body">
                                <p><b>How it works:</b> To change your password, in User Settings,  click on the user’s id within the table. Click <text class="fakebtn">Change Password</text> under 'Account Information'. First enter your current password, then enter his/her new password and confirm it. Click <text class="fakebtn">Submit</text> to make the change.</p> 
                                <p style="margin-left: 40px">Example: </p>
                                <p style="margin-left: 195px">Change Password for thisuser </p>
                                <p style="margin-left: 169px"> ID<text style="color:red;">*</text>: <input type="text" value="thisuser" readonly> </p>
                                <p style="margin-left: 88px"> Your Password<text style="color:red;">*</text>: <input type="password" value="user123" readonly> </p>
                                <p style="margin-left: 38px"> His/Her New Password<text style="color:red;">*</text>: <input type="password" value="usdedr123" readonly> </p>
                                <p style="margin-left: 11px"> Confirm the New Password<text style="color:red;">*</text>: <input type="password" value="usesdr123" readonly> </p>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 id="delete_user" class="panel-title">Delete User</h3>
                            </div>
                            <div class="panel-body">
                                <p><b>How it works:</b> To delete a user, in User Settings, click the user you want to delete. Once on his/her profile page, <text class="fakebtn">Edit</text>. Then click <text class="fakebtn" style="border-color:red;">Delete</text> and confirm that you want to delete the user. <b>WARNING: this change is permanent and cannot be undone.</b></p> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <h3 id="idcp_settings" class="offset">ICDP Settings Page</h3>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 id="add_ins" class="panel-title">Add Instructor</h3>
                        </div>
                        <div class="panel-body">
                            <p><b>How it works:</b> To add a new instructor, click your user id in the top menu bar and navigate to the ‘IDCP Settings’ tab on the drop-down menu. Click <text class="fakebtn">Add Instructors</text> on this page to get started.</p>
                            <p>Once you are on the ‘Add New Instructors’ page, fill out the required fields, or you will not be able to add the instructor. Enter the instructor’s first and last name, the instructor’s initials, if any and the instructor’s email. After, hit the <text class="fakebtn">Submit</text> button. This will add the instructor to the database.</p>
                            <p style="margin-left: 40px">Example: </p>
                            <p style="margin-left: 226px">Add an Instructor </p>
                            <p style="margin-left: 80px"> Instructor First Name<text style="color:red;">*</text>: <input type="text" value="John" readonly> </p>
                            <p style="margin-left: 80px"> Instructor Last Name<text style="color:red;">*</text>: <input type="text" value="Smith" readonly> </p>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 id="search_ins" class="panel-title">Search Instructor</h3>
                        </div>
                        <div class="panel-body">
                            <p><b>How it works:</b> To search for an instructor, click your user id in the top menu bar and navigate to the ‘IDCP Settings’ tab on the drop-down menu, Click <text class="fakebtn">Search Instructors</text>.</p>
                            <p>On this page, all instructors will be listed in a table. To search for a specific instructor, you can enter the instructor’s name into the search box. Once you type in the name, hit <text class="fakebtn">Submit</text> and the table will refresh with your search. </p>
                            <p>Click the <text class="fakebtn">Reset</text> button to reset your search.</p>
                            <p>To view instructor, click on its name within the table.</p>
                            <p style="margin-left: 40px">Example: </p>
                            <p style="margin-left: 80px"> Search a Name: <input type="text" value="Helen" readonly> <text class="fakebtn">Submit</text></p>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 id="edit_ins" class="panel-title">Edit Instructor</h3>
                        </div>
                        <div class="panel-body">
                            <p>To edit a instructor, navigate to the instructor’s profile by searching for the instructor. A panel labeled ‘Instructor Information’ will appear, which contains the instructor’s information. </p>
                            <p>To edit the instructor information, click the <text class="fakebtn">Edit</text> button in the ‘Instructor Information’ panel. Edit any information needed and click the <text class="fakebtn">Submit</text> button at the bottom to finalize your changes. Remember to not leave any fields with an <text style="color:red;">*</text> blank, or you will not be able to submit the form.</p>                            <p style="margin-left: 40px">Example: </p>
                            <p style="margin-left: 226px">Add an Instructor </p>
                            <p style="margin-left: 80px"> Instructor First Name<text style="color:red;">*</text>: <input type="text" value="John" readonly> </p>
                            <p style="margin-left: 80px"> Instructor Last Name<text style="color:red;">*</text>: <input type="text" value="Smith" readonly> </p>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 id="delete_ins" class="panel-title">Delete Instructor</h3>
                        </div>
                        <div class="panel-body">
                            <p>To delete a instructor, navigate to the instructor’s profile by searching for the instructor. Press the <text class="fakebtn">Edit</text> button. </p>
                            <p>At the bottom of the form, there is a red <text class="fakebtn" style="border-color:red;">Delete</text> button. Clicking this button will redirect you to a confirmation for deletion page. <b>WARNING: this change is permanent and cannot be undone.</b></p>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 id="add_emp" class="panel-title">Add Employer</h3>
                        </div>
                        <div class="panel-body">
                            <p><b>How it works:</b> To add a new employer, click your user id in the top menu bar and navigate to the ‘IDCP Settings’ tab on the drop-down menu, Click <text class="fakebtn">Add Employer</text> on this page to get started.</p>
                            <p>Once you are on the ‘Add New Instructors’ page, fill out the required fields, or you will not be able to add the instructor. Enter the employer name, the employer email, and employer phone. After, hit the <text class="fakebtn">Submit</text> button. This will add the employer to the database.</p>
                            <p style="margin-left: 40px">Example: </p>
                            <p style="margin-left: 196px">Add an Employer </p>
                            <p style="margin-left: 80px"> Employer Name<text style="color:red;">*</text>: <input type="text" value="IBM" readonly> </p>
                            <p style="margin-left: 88px"> Employer Email<text style="color:red;"></text>: <input type="text" value="ibm@ibm.us" readonly> </p>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 id="search_emp" class="panel-title">Search Employer</h3>
                        </div>
                        <div class="panel-body">
                            <p><b>How it works:</b> To search for an employer, click your user id in the top menu bar and navigate to the ‘IDCP Settings’ tab on the drop-down menu, Click <text class="fakebtn">Search Employer</text>.</p>
                            <p>On this page, all employers will be listed in a table. To search for a specific employer, you can enter the employer’s name into the search box. Once you type in the name, hit <text class="fakebtn">Submit</text> and the table will refresh with your search. </p>
                            <p>Click the <text class="fakebtn">Reset</text> button to reset your search.</p>
                            <p>To view employer, click on its name within the table.</p>
                            <p style="margin-left: 80px"> Search a Name: <input type="text" value="IBM" readonly> <text class="fakebtn">Submit</text></p>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                        <h3 id="edit_emp" class="panel-title">Edit Employer</h3>
                        </div>
                        <div class="panel-body">
                            <p>To edit a employer, navigate to the employer’s profile by searching for the employer. A panel labeled ‘Employer Information’ will appear, which contains the employer’s information. </p>
                            <p>To edit the employer information, click the <text class="fakebtn">Edit</text> button in the ‘Employer Information’ panel. Edit any information needed and click the <text class="fakebtn">Submit</text> button at the bottom to finalize your changes. Remember to not leave any fields with an <text style="color:red;">*</text> blank, or you will not be able to submit the form.</p>
                            <p style="margin-left: 40px">Example: </p>
                            <p style="margin-left: 196px">Add an Employer </p>
                            <p style="margin-left: 80px"> Employer Name<text style="color:red;">*</text>: <input type="text" value="IBM" readonly> </p>
                            <p style="margin-left: 88px"> Employer Email<text style="color:red;"></text>: <input type="text" value="ibm@ibm.us" readonly> </p>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 id="delete_emp" class="panel-title">Delete Employer</h3>
                        </div>
                        <div class="panel-body">
                            <p>To delete a employer, navigate to the employer’s profile by searching for the employer. Press the <text class="fakebtn">Edit</text> button. </p>
                            <p>At the bottom of the form, there is a red <text class="fakebtn" >Delete</text> button. Clicking this button will redirect you to a confirmation for deletion page. <b>WARNING: this change is permanent and cannot be undone.</b></p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /#container close -->
            </div>
        <!-- /#page-content-wrapper -->
        </div>
        <!--Footer-->
        <?php require('includes/footer.php'); ?>
        <a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Click to return on the top page" data-toggle="tooltip" data-placement="left"><span class="glyphicon glyphicon-chevron-up"></span></a>

    </div>
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
        <!-- anchor fix -->
    <script>
 $(function() {
  $('a[href*=#]:not([href=#])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') 
&& location.hostname == this.hostname) {

      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html,body').animate({
          scrollTop: target.offset().top - 250//offsets for fixed header
        }, 1000);
        return false;
      }
    }
  });
  //Executed on page load with URL containing an anchor tag.
  if($(location.href.split("#")[1])) {
      var target = $('#'+location.href.split("#")[1]);
      if (target.length) {
        $('html,body').animate({
          scrollTop: target.offset().top - 250 //offset height of header here too.
        }, 1000);
        return false;
      }
    }
});
$(document).ready(function(){
     $(window).scroll(function () {
            if ($(this).scrollTop() > 50) {
                $('#back-to-top').fadeIn();
            } else {
                $('#back-to-top').fadeOut();
            }
        });
        // scroll body to 0px on click
        $('#back-to-top').click(function () {
            $('#back-to-top').tooltip('hide');
            $('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });
        
        $('#back-to-top').tooltip('show');

});
    </script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-anchor.min.js"></script>
</body>
</html>
