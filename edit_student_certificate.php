<!--Allows user to add certificate for student -->
<?php
        $title = 'IDCP - Edit Certificate for Student';
        $page = 'student';
        $page_name = 'edit_stu_cert';
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
            //If user is coming from Certificate page
            $stu_id = $_SESSION['STU_ID'];
            // $query = "SELECT CERT_NAME, MAIL_DATE, EARN_DATE FROM CERT_EARNED, CERTIFICATE WHERE CERT_EARNED.CERT_ID = CERTIFICATE.CERT_ID AND CERT_EARNED.CERT_ID = $cert_id AND STU_ID = $stu_id";
            // $result = mysqli_query($dbc, $query);
            // if($result){
            //     $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            //     $cert_name = $row['CERT_NAME'];
            //     $_SESSION['CERT_NAME'] = $cert_name;
            //     $mail_date = $row['MAIL_DATE'];
            //     $earn_date = $row['EARN_DATE'];
            // }
            // //If user is coming from Student page
            // else{
                $cert_name = $_SESSION['CERT_NAME'];
		        $earn_date = $_SESSION['EARN_DATE'];
		        $mail_date = $_SESSION['MAIL_DATE'];
            // }
        }
        # Check to make sure the form method is post
        if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
            $earn_date = $_POST['earn_date'];
            $mail_date = $_POST['mail_date'];
            $cert_name = $_SESSION['CERT_NAME'];
            $stu_id = $_SESSION['STU_ID'];
        	$query = "SELECT CERT_ID FROM CERTIFICATE WHERE CERT_NAME = '$cert_name'";
        	$results = mysqli_query($dbc, $query);
        	$row = mysqli_fetch_array( $results , MYSQLI_ASSOC );
            $cert_id = $row['CERT_ID'];
    		$result = update_record_cert_earned($dbc, $stu_id, $cert_id, $mail_date, $earn_date);

    	    $page = 'edit_student_certificate_home.php';
            header("Location: $page");
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
        <li class = "active">Edit Certificate for Student</li>
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
				        echo '<h1>Edit a Certificate for ' . "$name" . '</h1>';

				    ?>
			    </div>
                <form action="edit_student_certificate.php" method="POST" class="form-horizontal" role="form" data-toggle="validator">
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
                            <input type="text" class="form-control" name="cert_name" value="<?php $cert_name = $_SESSION['CERT_NAME']; echo $cert_name ?>" disabled>
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
                            <button type="button" class="btn btn-danger" onclick ="location.href='delete_student_certificate_confirm.php';">Delete</button> 
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
