<!--Page for adding instructors-->
<?php
    $title = "IDCP - Add Instructor";
    $page = 'idcp_settings';
    $page_name = 'ins';
    require('includes/header.php');
    # Connect to MySQL server and the database
    require( 'includes/connect_db_c9.php' ) ;
    # Includes these helper functions
    require( 'includes/instructor_helpers.php' ) ;
    # Check to make sure it is the first time user is visiting the page
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    	$ins_lname = "";
    	$ins_fname = "";
    	$ins_initial = "";
    	$ins_email = "";
        //Regular user cannot access this page
            if($user_role == "User"){
                $page = 'home.php';
                header("Location: $page");
            }
    }
    # Check to make sure the form method is post
    if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
        $ins_lname = mysqli_real_escape_string($dbc, trim($_POST['ins_lname']));
    	$ins_fname = mysqli_real_escape_string($dbc, trim($_POST['ins_fname']));
    	$ins_initial = mysqli_real_escape_string($dbc, trim($_POST['ins_initial']));
    	$ins_email = mysqli_real_escape_string($dbc, trim($_POST['ins_email']));
	    $query = "SELECT * FROM INSTRUCTOR WHERE INS_LNAME = $ins_lname AND INS_FNAME = $ins_fname AND INS_EMAIL = '$ins_email'";
    	$results = mysqli_query($dbc, $query);
    	if(mysqli_num_rows( $results ) != 0 ){
        	    ?>
            <div class="alert alert-danger alert-dismissible" role="alert" style="margin-top: 20px">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Error!</strong> This instructor already exists. Please enter add different one.
            </div>
                <?php
    	}
    	else{
		$result = insert_instructor($dbc, $ins_lname, $ins_fname, $ins_initial, $ins_email);
		$page = 'instructor_add_success.php';
		header("Location: $page");
    	}
    }
     mysqli_close( $dbc ) ;
?>
<style>
.button {
    background-color: darkred;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
}
</style>
    <!-- Bread Crumbs -->
    <ol class = "breadcrumb">
        <li><a href = "home.php">Home</a></li>
        <li><a href = "idcp_settings.php">IDCP Settings</a></li>
        <li class = "active">Add Instructor</li>
    </ol>
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container" style="padding-right: 100px; max-width: 1100px;">
                <div class="dropdown">
                    <div class="page-header">
                        <h1>Add an Instructor</h1>
                    </div>
                    <form action="instructor_add.php" method="POST" class="form-horizontal" role="form" data-toggle="validator">
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Instructor First Name*</label>
                            <div class="col-xs-2">
                                <input type="text" class="form-control" name="ins_fname" data-error="Please enter the instructor's first name" required>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Instructor Last Name*</label>
                            <div class="col-xs-2">
                                <input type="text" class="form-control" name="ins_lname" data-error="Please enter the instructor's last name" required>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Instructor Initial</label>
                            <div class="col-xs-2">
                                <input type="text" class="form-control" name="ins_initial" maxlength="1">
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Instructor Email*</label>
                            <div class="col-xs-2">
                                <input type="email" class="form-control" name="ins_email" data-error="Please enter the instructor's email" required>
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
                                 <button type="button" class="btn btn-default" onclick="location.href='idcp_settings.php'">Back to Settings</button>
                            </div>
                        </div>
                    </form>
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
    <!-- Bootstrap Form Validator -->
    <script src="js/validator.js"></script>
</body>
</html>
