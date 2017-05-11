<!--Add an employer from the edit student page-->
<?php
    $title = "IDCP - Add Employer";
    $page = 'student';
    $page_name = 'edit_stu_emp';
    require('includes/header.php');
    # Connect to MySQL server and the database
    require( 'includes/connect_db_c9.php' ) ;
    # Includes these helper functions
    require( 'includes/employer_helpers.php' ) ;
    # Check to make sure it is the first time user is visiting the page
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    	$emp_name = "";
    	$emp_email = "";
    	$emp_phone = "";

        //Regular user cannot access this page
        if($user_role == "User"){
            $page = 'home.php';
            header("Location: $page");
        }
    }
    # Check to make sure the form method is post
    if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
    	$emp_name = $_POST['emp_name'];
    	$emp_email = $_POST['emp_email'];
    	$emp_phone = $_POST['emp_phone'];
		$emp_id = trim($emp_id);
		$emp_name = trim($emp_name);
		$emp_email = trim($emp_email);
		$emp_phone = trim($emp_phone);
		$result = insert_employer($dbc, $emp_name, $emp_email, $emp_phone);
		$page = 'edit_student_employer_add_success.php';
		header("Location: $page");
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
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container" style="padding-right: 100px; max-width: 1100px;">
                <div class="dropdown">
                    <div class="page-header">
                        <h1>Add an Employer</h1>
                    </div>
                    <form action="edit_student_employer_add.php" method="POST" class="form-horizontal" role="form" data-toggle="validator">
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Employer Name*</label>
                            <div class="col-xs-2">
                                <input type="text" class="form-control" name="emp_name" value="<?php if (isset($_POST['emp_name'])) echo $_POST['emp_name'];?>" data-error="Please enter the employer's name" required>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Employer Email</label>
                            <div class="col-xs-2">
                                <input type="text" class="form-control" name="emp_email" value="<?php if (isset($_POST['emp_email'])) echo $_POST['emp_email'];?>">
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Employer Phone</label>
                            <div class="col-xs-2">
                                <input type="text" class="form-control" name="emp_phone" value="<?php if (isset($_POST['emp_phone'])) echo $_POST['emp_phone'];?>">
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-5 col-xs-offset-3">
                                <button type="button" class="btn btn-default" onclick="location.href='edit_student.php'">Back</button>
                                <button type="submit" class="btn btn-default">Submit</button>
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
