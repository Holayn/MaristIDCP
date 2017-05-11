<!--Allows user to add certificate for student -->
<?php
        $title = 'IDCP - Add Program for Student';
        $page = 'student';
        $page_name = 'add_stu_prg';
        require('includes/header.php');
        # Connect to MySQL server and the database
        require( 'includes/connect_db_c9.php' ) ;
        # Includes these helper functions
        require( 'includes/student_helpers.php' ) ;
        # Check to make sure it is the first time user is visiting the page
        if ($_SERVER['REQUEST_METHOD'] == 'GET'){
            $cert_name = "";
            $earn_date = "";
            $mail_date = "";
            
            //Regular user cannot access this page
            if($user_role == "User"){
                $page = 'home.php';
                header("Location: $page");
            }
        }
        # Check to make sure the form method is post
        if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
            $cert_name = $_POST['cert_name'];
            $earn_date = $_POST['earn_date'];
            $mail_date = $_POST['mail_date'];
        	$query = "SELECT CERT_ID FROM CERTIFICATE WHERE CERT_NAME = '$cert_name'";
        	$results = mysqli_query($dbc, $query);
        	$row = mysqli_fetch_array( $results , MYSQLI_ASSOC );
            $cert_id = $row['CERT_ID'];
            $stu_id = $_SESSION['STU_ID'];
    		
		    $query = "SELECT * FROM CERT_EARNED WHERE STU_ID = $stu_id AND CERT_ID = $cert_id";
        	$results = mysqli_query($dbc, $query);
        	if(mysqli_num_rows( $results ) != 0 ){
        	    ?>
            <div class="alert alert-danger alert-dismissible" role="alert" style="margin-top: 20px">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Error!</strong> Student already has this certificate. Please add a different one.
            </div>
                <?php        	}
            else{
                $result = insert_record_cert_earned($dbc, $stu_id, $cert_id, $mail_date, $earn_date);
                $page = 'edit_student_certificate_home.php';
                header("Location: $page");
        		exit();
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
        <li><a href = "edit_student_certificate_home.php">Student Certificate Info</a></li>
        <li class = "active">Add a Certificate for Student</li>
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
				        echo '<h1>Add a Certificate for ' . "$name" . '</h1>';
				    ?>
			    </div>
                <form action="add_edit_student_certificate.php" method="POST" class="form-horizontal" role="form" data-toggle="validator">
                    <div class="form-group">
                        <label class="col-xs-3 control-label"></label>
                        <div class="col-xs-5">
                            <h3>Certificate Information</h3>
                        </div>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label">Certificate*</label>
                        <div class="col-xs-3">
                            <select class="form-control" id="sel1" name="cert_name" value="<?php if (isset($_POST['cert_name'])) echo $_POST['cert_name'];?>" data-error="Please select a certificate" required>
                            <option disabled selected value>-- select an option --</option>
                            <?php
                                require('includes/connect_db_c9.php');
                                $query = 'SELECT CERT_NAME FROM CERTIFICATE ORDER BY CERT_NAME';
                                $results = mysqli_query($dbc, $query);
                                if($results){
                                    while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
                            		{
                            			echo '<option>' . $row['CERT_NAME'] . '</option>' ;
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
                        <label class="col-xs-3 control-label" for="earn_date">Earn Date*</label>
                        <div class="col-xs-3">
                            <input type="date" class="form-control" id="earn_date" value="<?php echo $earn_date ?>" name="earn_date" data-error="Please select the student's earn date" required>
                        </div>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label" for="mail_date">Mail Date</label>
                        <div class="col-xs-3">
                            <input type="date" class="form-control" id="mail_date" value="<?php echo $mail_date ?>" name="mail_date">
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
                             <button type="button" class="btn btn-default" onclick ="location.href='edit_student_certificate_home.php';">Back to Certificate Info</button>
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
