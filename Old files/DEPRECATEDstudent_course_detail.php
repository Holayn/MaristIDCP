<!--Shows course information-->
<?php
   $title = "IDCP - Student Course Info";
   $page = 'student';
   $page_name = 'stu';
   require('includes/header.php');
   # Connect to MySQL server and the database
   require( 'includes/connect_db_c9.php' ) ;
   # Includes these helper functions
   require( 'includes/student_helpers.php' ) ;
   $stu_id = $_SESSION['stu_id'];
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
   $stu_yr_dob = $row['STU_YR_DOB'];
   $stu_mon_dob = $row['STU_MON_DOB'];
   $stu_day_dob = $row['STU_DAY_DOB'];
   $stu_edu_lvl = $row['STU_EDU_LVL'];
   $stu_transcript = $row['STU_TRANSCRIPT'];
   $stu_email_1 = $row['STU_EMAIL_1'];
   $stu_email_2 = $row['STU_EMAIL_2'];
   $stu_phone = $row['STU_PHONE'];
   $stu_yr_start = $row['STU_YR_START'];
   $stu_mon_start = $row['STU_MON_START'];
   $stu_day_start = $row['STU_DAY_START'];
   $stu_yr_end = $row['STU_YR_END'];
   $stu_mon_end = $row['STU_MON_END'];
   $stu_day_end = $row['STU_DAY_END'];
   $stu_comment = $row['STU_COMMENT'];
   $stu_qualify_exam = $row['STU_QUALIFY_EXAM'];
   $emp_id = $row['EMP_ID'];
   $stu_job_title = $row['STU_JOB_TITLE'];
   $stu_state = $row['STU_STATE'];
?>
        <!-- Page Content -->
        <div id="page-content-wrapper">
           <div class="container-fluid">
                <div class="dropdown">
                    <div class="page-header">
                        <?php
    				        $stu_id = $_SESSION['stu_id'];
    				        $name = get_stu_name($dbc, $stu_id);
    				        echo '<h1>Personal Info for ' . "$name" . '</h1>';
				        ?>
                    </div>
                    <!--<h3>ID</h3><p><?php echo $stu_id ?></p>-->
                    <h2>Identification</h2>
                    <div class="d-flex flex-wrap">
                        <div class = "panel panel-red" style="display: inline-block;" >
                           <div class = "panel-heading">
                              <h3 class = "panel-title">ID</h3>
                           </div>
                           <div class = "panel-body">
                              <?php echo $stu_id; ?>
                           </div>
                        </div>
                        <div class = "panel panel-red" style="display: inline-block;" >
                           <div class = "panel-heading">
                              <h3 class = "panel-title">Tag</h3>
                           </div>
                           <div class = "panel-body">
                              <?php echo $stu_tag; ?>
                           </div>
                        </div>
                        <div class = "panel panel-red" style="display: inline-block;" >
                           <div class = "panel-heading">
                              <h3 class = "panel-title">First Name</h3>
                           </div>
                           <div class = "panel-body">
                              <?php echo $stu_fname ?>
                           </div>
                        </div>
                        <div class = "panel panel-red" style="display: inline-block;" >
                           <div class = "panel-heading">
                              <h3 class = "panel-title">Last Name</h3>
                           </div>
                           <div class = "panel-body">
                              <?php echo $stu_lname ?>
                           </div>
                        </div>
                        <div class = "panel panel-red" style="display: inline-block;" >
                           <div class = "panel-heading">
                              <h3 class = "panel-title">Initial</h3>
                           </div>
                           <div class = "panel-body">
                              <?php echo $stu_initial; echo '<a style="visibility: hidden">a</a>'?>
                           </div>
                        </div>
                        <div class = "panel panel-red" style="display: inline-block;" >
                           <div class = "panel-heading">
                              <h3 class = "panel-title">Gender</h3>
                           </div>
                           <div class = "panel-body">
                              <?php echo $stu_gender; echo '<a style="visibility: hidden">a</a>'?>
                           </div>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap">
                        <div class = "panel panel-red" style="display: inline-block;" >
                           <div class = "panel-heading">
                              <h3 class = "panel-title">U.S. Citizen?</h3>
                           </div>
                           <div class = "panel-body">
                              <?php if($stu_citizen == 1) echo Yes; else echo No; echo '<a style="visibility: hidden">a</a>'?>
                           </div>
                        </div>
                        <div class = "panel panel-red" style="display: inline-block;" >
                           <div class = "panel-heading">
                              <h3 class = "panel-title">Street Address</h3>
                           </div>
                           <div class = "panel-body">
                              <?php echo $stu_street; echo '<a style="visibility: hidden">a</a>'?>
                           </div>
                        </div>
                        <div class = "panel panel-red" style="display: inline-block;" >
                           <div class = "panel-heading">
                              <h3 class = "panel-title">City</h3>
                           </div>
                           <div class = "panel-body">
                              <?php echo $stu_city; echo '<a style="visibility: hidden">a</a>'?>
                           </div>
                        </div>
                        <div class = "panel panel-red" style="display: inline-block;" >
                           <div class = "panel-heading">
                              <h3 class = "panel-title">State</h3>
                           </div>
                           <div class = "panel-body">
                              <?php echo $stu_state; echo '<a style="visibility: hidden">a</a>'?>
                           </div>
                        </div>
                        <div class = "panel panel-red" style="display: inline-block;" >
                           <div class = "panel-heading">
                              <h3 class = "panel-title">ZIP</h3>
                           </div>
                           <div class = "panel-body">
                              <?php echo $stu_zip; echo '<a style="visibility: hidden">a</a>'?>
                           </div>
                        </div>
                        <div class = "panel panel-red" style="display: inline-block;" >
                           <div class = "panel-heading">
                              <h3 class = "panel-title">Country</h3>
                           </div>
                           <div class = "panel-body">
                              <?php echo $stu_country; echo '<a style="visibility: hidden">a</a>'?>
                           </div>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap">
                        <div class = "panel panel-red" style="display: inline-block;" >
                           <div class = "panel-heading">
                              <h3 class = "panel-title">Ethnicity</h3>
                           </div>
                           <div class = "panel-body">
                              <?php echo $stu_ethnicity ?>
                           </div>
                        </div>
                        <div class = "panel panel-red" style="display: inline-block;" >
                           <div class = "panel-heading">
                              <h3 class = "panel-title">Birth Year</h3>
                           </div>
                           <div class = "panel-body">
                              <?php echo $stu_yr_dob; echo '<a style="visibility: hidden">a</a>'?>
                           </div>
                        </div>
                        <div class = "panel panel-red" style="display: inline-block;" >
                           <div class = "panel-heading">
                              <h3 class = "panel-title">Birth Month</h3>
                           </div>
                           <div class = "panel-body">
                              <?php echo $stu_mon_dob; echo '<a style="visibility: hidden">a</a>'?>
                           </div>
                        </div>
                        <div class = "panel panel-red" style="display: inline-block;" >
                           <div class = "panel-heading">
                              <h3 class = "panel-title">Birth Day</h3>
                           </div>
                           <div class = "panel-body">
                              <?php echo $stu_day_dob; echo '<a style="visibility: hidden">a</a>'?>
                           </div>
                        </div>
                    </div>
                    <h2>Education</h2>
                    <div class="d-flex flex-wrap">
                        <div class = "panel panel-red" style="display: inline-block;" >
                           <div class = "panel-heading">
                              <h3 class = "panel-title">Highest Education Level</h3>
                           </div>
                           <div class = "panel-body">
                              <?php echo $stu_edu_lvl ?>
                           </div>
                        </div>
                        <div class = "panel panel-red" style="display: inline-block;" >
                           <div class = "panel-heading">
                              <h3 class = "panel-title">Transcript Received</h3>
                           </div>
                           <div class = "panel-body">
                              <?php if($stu_transcript == 1) echo Yes; else echo No;?>
                           </div>
                        </div>
                    </div>
                    <h2>Contact and Employer</h2>
                    <div class="d-flex flex-wrap">
                        <div class = "panel panel-red" style="display: inline-block;" >
                           <div class = "panel-heading">
                              <h3 class = "panel-title">Email 1</h3>
                           </div>
                           <div class = "panel-body">
                              <?php echo $stu_email_1 ?>
                           </div>
                        </div>
                        <div class = "panel panel-red" style="display: inline-block;" >
                           <div class = "panel-heading">
                              <h3 class = "panel-title">Email 2</h3>
                           </div>
                           <div class = "panel-body">
                              <?php echo $stu_email_2; echo '<a style="visibility: hidden">a</a>'?>
                           </div>
                        </div>
                        <div class = "panel panel-red" style="display: inline-block;" >
                           <div class = "panel-heading">
                              <h3 class = "panel-title">Phone</h3>
                           </div>
                           <div class = "panel-body">
                              <?php echo $stu_phone ?>
                           </div>
                        </div>
                        <div class = "panel panel-red" style="display: inline-block;" >
                           <div class = "panel-heading">
                              <h3 class = "panel-title">Employer</h3>
                           </div>
                           <div class = "panel-body">
                              <?php echo get_emp_name($dbc, $emp_id)?>
                           </div>
                        </div>
                        <div class = "panel panel-red" style="display: inline-block;" >
                           <div class = "panel-heading">
                              <h3 class = "panel-title">Job Title</h3>
                           </div>
                           <div class = "panel-body">
                              <?php echo $stu_job_title ?>
                           </div>
                        </div>
                    </div>
                    <h2>Program Information</h2>
                    <div class="d-flex flex-wrap">
                        <div class = "panel panel-red" style="display: inline-block;" >
                           <div class = "panel-heading">
                              <h3 class = "panel-title">Start Year</h3>
                           </div>
                           <div class = "panel-body">
                              <?php echo $stu_yr_start; echo '<a style="visibility: hidden">a</a>'?>
                           </div>
                        </div>
                        <div class = "panel panel-red" style="display: inline-block;" >
                           <div class = "panel-heading">
                              <h3 class = "panel-title">Start Month</h3>
                           </div>
                           <div class = "panel-body">
                              <?php echo $stu_mon_start; echo '<a style="visibility: hidden">a</a>'?>
                           </div>
                        </div>
                        <div class = "panel panel-red" style="display: inline-block;" >
                           <div class = "panel-heading">
                              <h3 class = "panel-title">Start Day</h3>
                           </div>
                           <div class = "panel-body">
                              <?php echo $stu_day_start; echo '<a style="visibility: hidden">a</a>'?>
                           </div>
                        </div>
                        <div class = "panel panel-red" style="display: inline-block;" >
                           <div class = "panel-heading">
                              <h3 class = "panel-title">End Year</h3>
                           </div>
                           <div class = "panel-body">
                              <?php echo $stu_year_end; echo '<a style="visibility: hidden">a</a>'?>
                           </div>
                        </div>
                        <div class = "panel panel-red" style="display: inline-block;" >
                           <div class = "panel-heading">
                              <h3 class = "panel-title">End Month</h3>
                           </div>
                           <div class = "panel-body">
                              <?php echo $stu_mon_end; echo '<a style="visibility: hidden">a</a>'?>
                           </div>
                        </div>
                        <div class = "panel panel-red" style="display: inline-block;" >
                           <div class = "panel-heading">
                              <h3 class = "panel-title">End Day</h3>
                           </div>
                           <div class = "panel-body">
                              <?php echo $stu_day_end; echo '<a style="visibility: hidden">a</a>'?>
                           </div>
                        </div>
                        <div class = "panel panel-red" style="display: inline-block;" >
                           <div class = "panel-heading">
                              <h3 class = "panel-title">Qualifying Exam</h3>
                           </div>
                           <div class = "panel-body">
                              <?php if($stu_qualify_exam == 1) echo Yes; else echo No; ?>
                           </div>
                        </div>
                    </div>
                    <h2>Miscellaneous</h2>
                    <div class="d-flex flex-wrap">
                        <div class = "panel panel-red" style="display: inline-block;" >
                           <div class = "panel-heading">
                              <h3 class = "panel-title">Comment</h3>
                           </div>
                           <div class = "panel-body">
                              <?php echo $stu_comment; echo '<a style="visibility: hidden">a</a>'?>
                           </div>
                        </div>
                    </div>
                    <div class = "butspan" style = "width: 300px;">
                        <button class="btn btn-default" onclick ="location.href='student_profile.php';">Back</button>
                    </div>
                </div>
            </div>
        <!-- /#page-content-wrapper -->
        </div>
		    
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>

</body>

</html>
