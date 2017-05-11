<!--Page for changing the password for the user-->
<?php
    $title = "IDCP - User Change Password";
    $page = 'user_settings';
    $page_name = 'change_other_pwd';
    require('includes/header.php');
    # Connect to MySQL server and the database
    require( 'includes/connect_db_c9.php' ) ;
    # Includes these helper functions
    require( 'includes/user_helpers.php' ) ;
    $other_user_id = $_SESSION['OTHER_USER_ID'];
    # Check to make sure it is the first time user is visiting the page
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    	$your_user_pwd = "";
    	$user_pwd_new = "";
    	$user_pwd_confirm = "";
        //Regular user cannot access this page
            if($user_role == "User"){
                $page = 'home.php';
                header("Location: $page");
            }
    	}
    else{
        echo '<p>'.mysqli_error($dbc).'</p>';
    }
    # Check to make sure the form method is post
    if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
    	$your_user_pwd = SHA1($_POST['your_user_pwd']);
    	$user_pwd_new = $_POST['user_pwd_new'];
    	$user_pwd_confirm = $_POST['user_pwd_confirm'];
    	
    	#Updates record if all inputs are valid
    	$query = "SELECT USER_PWD FROM IDCP_USER WHERE USER_ID = '".$user_id."'";
    	$result = mysqli_query($dbc, $query);
    	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    	$user_pwd = $row['USER_PWD'];
        if ($your_user_pwd != $user_pwd){
    	            ?>
                <div class="alert alert-danger alert-dismissible" role="alert" style="margin-top: 20px">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Error!</strong> Incorrect password. Please enter your password again.
                </div>
        <?php
    	}
    	else{
    	    if ($user_pwd_confirm != $user_pwd_new){
                ?>
                <div class="alert alert-danger alert-dismissible" role="alert" style="margin-top: 20px">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Error!</strong> The passwords do not match. Please enter the new password again.
                </div>
        <?php
    	    }
        	else{
        	    $result = update_user_password($dbc, $other_user_id, $user_pwd_new);
        	    $page = 'user_success.php';
                header("Location: $page");
        	}
    	}
    }
    # Close the connection
    mysqli_close( $dbc ) ;

?>
    <!-- Bread Crumbs -->
    <ol class = "breadcrumb">
        <li><a href = "home.php">Home</a></li>
        <li><a href = "user_settings.php">User Settings</a></li>
        <li><a href = "other_user_settings.php"><?php echo $other_user_id ?></a></li>
        <li class = "active">Change User Password</li>
    </ol>
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="dropdown">
                    <div class="page-header">
                        <?php
    				        echo '<h1>Change Password for ' . "$other_user_id" . '</h1>';
				        ?>
                    </div>
                    <form action="other_user_change_pwd.php" method="POST" class="form-horizontal" data-toggle="validator" id="user_change_pwd">
                        <div class="form-group">
                            <label class="col-xs-3 control-label">ID*</label>
                            <div class="col-xs-2">
                                <input type="text" class="form-control" name="user_id" value="<?php echo $other_user_id?>" readonly>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Your Password*</label>
                            <div class="col-xs-2">
                                <input type="password" class="form-control" name="your_user_pwd" data-error="Please enter your password" required>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">His/Her New Password*</label>
                            <div class="col-xs-2">
                                <input type="password" class="form-control" name="user_pwd_new" data-error="Please enter the new password for this user" required>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Confirm the New Password*</label>
                            <div class="col-xs-2">
                                <input type="password" class="form-control" name="user_pwd_confirm" data-error="Please enter the new password for this user again" required>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-5 col-xs-offset-3">
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>
                        </div>
                        <div class="form-group">
                        <div class="col-xs-5">
                             <button class="btn btn-default" type="button" onclick ="location.href='other_user_settings.php';">Back</button>
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
    <!-- Validator Bootstrap Plugin-->
    <script src="js/validator.js"></script>
</body>
</html>