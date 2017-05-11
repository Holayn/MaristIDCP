<!--Edit employer page-->
<?php
    $title = "IDCP - Edit Employer";
    $page = 'idcp_settings';
    $page_name = 'edit_emp';
    require('includes/header.php');
    $emp_name = $_SESSION['EMP_NAME'];
    require( 'includes/connect_db_c9.php' ) ;
    require( 'includes/employer_helpers.php' ) ;
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
            $query = "SELECT * FROM EMPLOYER WHERE EMP_NAME = '$emp_name'";
        	$result = mysqli_query($dbc, $query);
        	$row = mysqli_fetch_array($result, MYSQLI_ASSOC) ;
        	$emp_name = $row['EMP_NAME'];
        	$emp_phone = $row['EMP_PHONE'];
        	$emp_email = $row['EMP_EMAIL'];

        //Regular user cannot access this page
        if($user_role == "User"){
            $page = 'home.php';
            header("Location: $page");
        }
        }
        # Check to make sure the form method is post
    if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
        $query = "SELECT EMP_ID FROM EMPLOYER WHERE EMP_NAME = '$emp_name'";
    	$result = mysqli_query($dbc, $query);
    	$row = mysqli_fetch_array($result, MYSQLI_ASSOC) ;
        $emp_id = $row['EMP_ID'];
    	$emp_name = mysqli_real_escape_string($dbc, trim($_POST['emp_name']));
    	$emp_phone = mysqli_real_escape_string($dbc, trim($_POST['emp_phone']));
    	$emp_email = mysqli_real_escape_string($dbc, trim($_POST['emp_email']));

    	$result = update_employer($dbc, $emp_id, $emp_name, $emp_phone, $emp_email);
    	$page = 'employer_search.php';
        header("Location: $page");
    }
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
        <li><a href = "employer_search.php">Search Employer</a></li>
        <li class = "active">Edit Employer Info</li>
    </ol>
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="dropdown">
                    <div class="page-header">
                    <h1>Edit Employer Information for <?php echo $emp_name;?></h1>
                    </div>
                    <form action ="edit_employer.php" method="POST" class="form-horizontal" data-toggle="validator" id="edit_program_form">
                        <div class="form-group">
                            <label class="col-xs-3 control-label"></label>
                            <div class="col-xs-5">
                                <h3>Employer Information</h3>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Employer Name*</label>
                            <div class="col-xs-2">
                                <input type="text" class="form-control" name="emp_name" value="<?php echo $emp_name;?>" data-error="Please enter the employer's name" required>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Employer Email</label>
                            <div class="col-xs-2">
                                <input type="text" class="form-control" name="emp_email" value="<?php echo $emp_email;?>">
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Employer Phone</label>
                            <div class="col-xs-2">
                                <input type="text" class="form-control" name="emp_phone" value="<?php echo $emp_phone;?>">
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-5 col-xs-offset-3">
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-5 col-xs-offset-3">
                                <button class="btn btn-danger btn-sm" type="button" onclick ="location.href='delete_employer_confirm.php';">Delete</button>
                            </div>
                        </div>
                        <div class="form-group">
                        <div class="col-xs-5">
                             <button type="button" class="btn btn-default" onclick ="location.href='employer_search.php';">Back to Search</button>
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
     <!--Validator Bootstrap Plugin-->
    <script src="js/validator.js"></script>
</body>
</html>
