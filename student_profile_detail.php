<!--Shows more detailed information about the student-->
<?php
        $title = "IDCP - Student Profile";
        $page = 'student';
        $page = 'stu';
        require('includes/header.php');
        # Connect to MySQL server and the database
        require( 'includes/connect_db_c9.php' ) ;
        # Includes these helper functions
        require( 'includes/student_helpers.php' ) ;
        $stu_id = $_SESSION['STU_ID'];
        $query = "SELECT * FROM STUDENT WHERE STU_ID = $stu_id";
        $results = mysqli_query($dbc, $query);
        $row = mysqli_fetch_array( $results , MYSQLI_ASSOC );
    	$stu_id = $row['STU_ID'];
    	$stu_tag = $row['STU_TAG'];
    	$stu_fname = $row['STU_FNAME'];
    	$stu_lname = $row['STU_LNAME'];
    	$stu_initial = $row['STU_INITIAL'];
    	$stu_gender = $row['STU_GENDER'];
    	$stu_citizen = $row['STU_CITIZEN'];
    	$stu_street = $row['STU_STREET'];
    	$stu_city = $row['STU_CITY'];
    	$stu_zip = $row['STU_ZIP'];
    	$stu_country = $row['STU_COUNTRY'];
    	$stu_ethnicity = $row['STU_ETHNICITY'];
    	$stu_dob = $row['STU_DOB'];
    	$stu_edu_lvl = $row['STU_EDU_LVL'];
    	$stu_transcript = $row['STU_TRANSCRIPT'];
    	$stu_email_1 = $row['STU_EMAIL_1'];
    	$stu_email_2 = $row['STU_EMAIL_2'];
    	$stu_phone = $row['STU_PHONE'];
    	$stu_start = $row['STU_START'];
    	$stu_end = $row['STU_END'];
    	$stu_comment = $row['STU_COMMENT'];
    	$emp_id = $row['EMP_ID'];
    	$stu_job_title = $row['STU_JOB_TITLE'];
    	$stu_state = $row['STU_STATE'];
    	$stu_qualify_exam = $row['STU_QUALIFY_EXAM'];
?>
    <!-- Bread Crumbs -->
    <ol class = "breadcrumb">
    <li><a href = "home.php">Home</a></li>
    <li><a href = "student.php">Student</a></li>
    <li><a href = "student_search.php">Student Search</a></li>
    <li><a href = "student_profile.php">Student Profile</a></li>
    <li class = "active">Personal Info</li>
    </ol>
        <!-- Page Content -->
        <div id="page-content-wrapper">
           <div class="container-fluid">
                <div class="dropdown">
                    <div class="page-header">
                        <?php
    				        $stu_id = $_SESSION['STU_ID'];
    				        $name = get_stu_name($dbc, $stu_id);
    				        echo '<h1>Personal Info for ' . "$name" . '</h1>';
				        ?>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="panel panel-red">
                                <div class="panel-heading">Identification</div>
                                <div class="panel-body">
                                    <b>ID: </b> <?php echo $stu_id; ?><br>
                                    <b>Tag: </b><?php echo $stu_tag; ?><br>
                                    <b>First Name: </b><?php echo $stu_fname ?><br>
                                    <b>Last Name: </b><?php echo $stu_lname ?><br>
                                    <b>Initial: </b><?php echo $stu_initial; ?><br>
                                    <b>Gender: </b><?php echo $stu_gender; ?><br>
                                    <b>Citizen: </b><?php echo $stu_citizen ?><br>
                                    <b>Street: </b><?php echo $stu_street; ?><br>
                                    <b>City: </b><?php echo $stu_city; ?><br>
                                    <b>State: </b><?php echo $stu_state; ?><br>
                                    <b>ZIP: </b><?php echo $stu_zip; ?><br>
                                    <b>Country: </b><?php echo $stu_country; ?><br>
                                    <b>Ethnicity: </b><?php echo $stu_ethnicity ?><br>
                                    <b>Date of Birth: </b><?php echo $stu_dob; ?><br>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="panel panel panel-red">
                                <div class="panel-heading">Education</div>
                                <div class="panel-body">
                                    <b>Highest Education Level: </b><?php echo $stu_edu_lvl ?><br>
                                    <b>Transcript Received: </b><?php echo $stu_transcript ?><br>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="panel panel panel-red">
                                <div class="panel-heading">Contact and Employer</div>
                                <div class="panel-body">
                                    <b>Email 1: </b><?php echo $stu_email_1 ?><br>
                                    <b>Email 2: </b><?php echo $stu_email_2 ?><br>
                                    <b>Phone: </b><?php echo $stu_phone ?><br>
                                    <b>Employer: </b><?php echo get_emp_name($dbc, $emp_id)?><br>
                                    <b>Job Title: </b><?php echo $stu_job_title; ?><br>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="panel panel panel-red">
                                <div class="panel-heading">Enrollment Time</div>
                                <div class="panel-body">
                                    <b>Start Date: </b><?php echo $stu_start; ?><br>
                                    <b>End Date: </b><?php echo $stu_end; ?><br>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="panel panel panel-red">
                                <div class="panel-heading">Miscellaneous</div>
                                <div class="panel-body">
                                    <b>Qualifying Exam: </b><?php echo $stu_qualify_exam; ?><br>
                                    <b>Comment: </b><?php echo $stu_comment; ?><br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class = "butspan" style = "width: 300px;">
                        <button class="btn btn-default" onclick ="location.href='student_profile.php';">Back to Profile</button>
                        <button class="btn btn-default" style="<?php if($user_role=='User') echo 'display:none;';?>" onclick ="location.href='edit_student.php';">Edit</button>
                    </div>
                </div>
            </div>
        <!-- /#page-content-wrapper -->
        </div>
        <!--Footer-->
        <?php require('includes/footer.php'); ?>
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
