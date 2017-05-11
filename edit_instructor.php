<!--Edit instructor page-->
<?php
    $title = "IDCP - Edit Instructor";
    $page = 'idcp_settings';
    $page_name = 'edit_ins';
    require('includes/header.php');
    $ins_lname = $_SESSION['INS_LNAME'];
    $ins_fname = $_SESSION['INS_FNAME'];
    require( 'includes/connect_db_c9.php' ) ;
    require( 'includes/instructor_helpers.php' ) ;
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
        $query = "SELECT * FROM INSTRUCTOR WHERE INS_FNAME = '$ins_fname' AND INS_LNAME = '$ins_lname'";
    	$result = mysqli_query($dbc, $query);
    	$row = mysqli_fetch_array($result, MYSQLI_ASSOC) ;
    	$ins_lname = $row['INS_LNAME'];
	    $ins_fname = $row['INS_FNAME'];
	    $ins_initial = $row['INS_INITIAL'];
	    $ins_email = $row['INS_EMAIL'];

        //Regular user cannot access this page
        if($user_role == "User"){
            $page = 'home.php';
            header("Location: $page");
        }
        }
        # Check to make sure the form method is post
    if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
        $query = "SELECT INS_ID FROM INSTRUCTOR WHERE INS_FNAME = '$ins_fname' AND INS_LNAME = '$ins_lname'";
    	$result = mysqli_query($dbc, $query);
    	$row = mysqli_fetch_array($result, MYSQLI_ASSOC) ;
        $ins_id = $row['INS_ID'];
    	$ins_lname = mysqli_real_escape_string($dbc, trim($_POST['ins_lname']));
    	$ins_fname = mysqli_real_escape_string($dbc, trim($_POST['ins_fname']));
    	$ins_initial = mysqli_real_escape_string($dbc, trim($_POST['ins_initial']));
    	$ins_email = mysqli_real_escape_string($dbc, trim($_POST['ins_email']));

    	$result = update_instructor($dbc, $ins_id, $ins_lname, $ins_fname, $ins_initial, $ins_email);
    	
    	$_SESSION['INS_LNAME'] = $ins_lname;
        $_SESSION['INS_FNAME'] = $ins_fname;
    	$page = 'instructor_profile.php';
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
        <li><a href = "instructor_search.php">Search Instructor</a></li>
        <li class = "active">Edit Instructor Info</li>
    </ol>
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="dropdown">
                    <div class="page-header">
                    <h1>Edit Instructor Information for <?php echo $ins_fname ." ". $ins_lname;?></h1>
                    </div>
                    <form action ="edit_instructor.php" method="POST" class="form-horizontal" data-toggle="validator" id="edit_instructor_form">
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Instructor First Name*</label>
                            <div class="col-xs-2">
                                <input type="text" class="form-control" name="ins_fname" value="<?php echo $ins_fname?>" data-error="Please enter the instructor's first name" required>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Instructor Last Name*</label>
                            <div class="col-xs-2">
                                <input type="text" class="form-control" name="ins_lname" value="<?php echo $ins_lname?>" data-error="Please enter the instructor's last name" required>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Instructor Initial</label>
                            <div class="col-xs-2">
                                <input type="text" class="form-control" name="ins_initial" value="<?php echo $ins_initial?>" maxlength="1">
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Instructor Email</label>
                            <div class="col-xs-2">
                                <input type="text" class="form-control" name="ins_email" value="<?php echo $ins_email?>">
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-5 col-xs-offset-3">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-5 col-xs-offset-3">
                                <button class="btn btn-danger btn-sm" type="button" onclick ="location.href='delete_instructor_confirm.php';">Delete</button>
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
     <!--Validator Bootstrap Plugin-->
    <script src="js/validator.js"></script>
</body>
</html>
