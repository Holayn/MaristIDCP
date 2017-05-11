<!--Allows user to add course for student -->
<?php
    $title = 'IDCP - Add Course for Student';
    $page = 'student';
    $page_name = 'add_stu_crs';
    require('includes/header.php');
    # Connect to MySQL server and the database
    require( 'includes/connect_db_c9.php' ) ;
    # Includes these helper functions
    require( 'includes/student_helpers.php' ) ;
    # Check to make sure it is the first time user is visiting the page
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
        $crs_name = "";
        $crs_enroll_start = "";
        $credit = "";
            //Regular user cannot access this page
        if($user_role == "User"){
            $page = 'home.php';
            header("Location: $page");
        }
    }
    # Check to make sure the form method is post
    if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
        $crs_name = $_POST['crs_name'];
        //This is actually the course name, not the ID
        $crs_pieces = explode(" ", $crs_name);
        $crs_id = $crs_pieces[0];
        $crs_enroll_start = $_POST['crs_enroll_start'];
        $credit = $_POST['credit'];
        $stu_id = $_SESSION['STU_ID'];
		$query = "SELECT * FROM CRS_ENROLLED WHERE STU_ID = $stu_id AND CRS_ID = '$crs_id' AND CRS_ENROLL_STATUS='Active'";
    	$results = mysqli_query($dbc, $query);
    	if(mysqli_num_rows( $results ) != 0 ){
        	    ?>
            <div class="alert alert-danger alert-dismissible" role="alert" style="margin-top: 20px">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Error!</strong> Student is already taking this course. Please add a different one.
            </div>
                <?php
                }
        else{
    		$result = insert_record_crs_enrolled($dbc, $credit, $crs_enroll_start, $crs_id, $stu_id);
    		echo "Success! Thanks" ; 
    		$_SESSION['addedCourse'] = true;
    		$page = 'edit_student_courses_home.php';
            header("Location: $page");
        }
    }
    # Close the connection
    mysqli_close( $dbc ) ;
?>
<!-- Bread Crumbs -->
<ol class = "breadcrumb">
    <li><a href = "home.php">Home</a></li>
    <li><a href = "student.php">Student</a></li>
    <li><a href = "student_search.php">Student Search</a></li>
    <li><a href = "student_profile.php">Student Profile</a></li>
    <li><a href = "edit_student_courses_home.php">Student Course Info</a></li>
    <li class = "active">Add a Course for Student</li>
</ol>
    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="dropdown">
                <div class="page-header">
                    <!--Make this dynamic-->
                    <?php
				        $stu_id = $_SESSION['STU_ID'];
				        $name = get_stu_name($dbc, $stu_id);
				        echo '<h1>Add a Course for ' . "$name" . '</h1>';
				    ?>
			    </div>
                <form action="add_edit_student_course.php" method="POST" class="form-horizontal" role="form" data-toggle="validator">
                    <div class="form-group">
                        <label class="col-xs-3 control-label"></label>
                        <div class="col-xs-5">
                            <h3>Enrollment Information</h3>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label">Course Name*</label>
                        <div class="col-xs-3">
                            <select class="form-control" id="sel1" name="crs_name" value="<?php if (isset($_POST['crs_name'])) echo $_POST['crs_name'];?>" data-error="Please select the course name" required>
                            <option disabled selected value>-- select an option --</option>
                            <?php
                                require( 'includes/connect_db_c9.php' ) ;
                                $query = 'SELECT CRS_ID, CRS_NAME FROM COURSE ORDER BY CRS_ID';
                                $results = mysqli_query($dbc, $query);
                                if($results){
                                    while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
                            		{
                            			echo '<option>' . $row['CRS_ID'] . " " . $row['CRS_NAME'] . '</option>' ;
                            		}
                                }
                                else
                            	{
                            		echo '<p>' . mysqli_error( $dbc ) . '</p>'  ;
                            	}
                            	# Free up the results in memory
                            	mysqli_free_result( $results );
                            	mysqli_close( $dbc ) ;
                            ?>
                            </select>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label" for="crs_enroll_start">Enroll Date*</label>
                        <div class="col-xs-3">
                            <input type="date" class="form-control" id="crs_enroll_start" value="<?php echo $crs_enroll_start ?>" name="crs_enroll_start" data-error="Please select the student's start date in the course" required>
                        </div>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label">Taking for Credit?*</label>
                        <div class="col-xs-2">
                            <select class="form-control" id="sel1" name="credit" value="<?php if (isset($_POST['credit'])) echo $_POST['credit'];?>" data-error="Please select if the student is taking the course for credit" required>
                                <option disabled selected value>--</option>
                                <option>Yes</option>
                                <option>No</option>
                              </select>
                        </div>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-5 col-xs-offset-3">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-5">
                             <button type="button" class="btn btn-default" onclick ="location.href='edit_student_courses_home.php';">Back to Course Info</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- dropdown -->
        </div>
        <!-- /#container -->
    </div>
    <!-- /#page-content-wrapper -->
	<!--Footer-->
    <?php require('includes/footer.php'); ?>
</div>
<!-- /#wrapper -->
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Validator Bootstrap Plugin-->
    <script src="js/validator.js"></script>
</body>
</html>
