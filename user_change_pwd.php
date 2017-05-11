<!--Page for changing the password for the user-->
<?php
    $title = "IDCP - User Change Password";
    $page = 'user_settings';
    $page_name = 'change_pwd';
    require('includes/header.php');
    # Connect to MySQL server and the database
    require( 'includes/connect_db_c9.php' ) ;
    # Includes these helper functions
    require( 'includes/user_helpers.php' ) ;
    $user_id = $_SESSION['user_id'];
    # Check to make sure it is the first time user is visiting the page
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    	$query = "SELECT * FROM IDCP_USER WHERE USER_ID = '$user_id'";
    	$result = mysqli_query($dbc, $query);
    	$row = mysqli_fetch_array($result, MYSQLI_ASSOC) ;
    	$user_pwd_old = "";
    	$user_pwd_new = "";
    	$user_pwd_confirm = "";
    	mysqli_free_result($result);
    	}
    else{
        echo '<p>'.mysqli_error($dbc).'</p>';
    }
    # Check to make sure the form method is post
    if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
    	$user_pwd_old = SHA1($_POST['user_pwd_old']);
    	$user_pwd_new = $_POST['user_pwd_new'];
    	$user_pwd_confirm = $_POST['user_pwd_confirm'];
    	
    	#Updates record if all inputs are valid
    	$query = "SELECT USER_PWD FROM IDCP_USER WHERE USER_ID = '$user_id'";
    	$result = mysqli_query($dbc, $query);
    	$row = mysqli_fetch_array($result, MYSQLI_ASSOC) ;
    	$user_pwd = $row['USER_PWD'];
    	if ($user_pwd_old != $user_pwd){
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
        	    $result = update_user_password($dbc, $user_id, $user_pwd_new);
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
        <li class = "active">Change Your Password</li>
    </ol>
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="dropdown">
                    <div class="page-header">
                        <?php
    				        echo '<h1>Change Your Password</h1>';
				        ?>
                    </div>
                    <form action="user_change_pwd.php" method="POST" class="form-horizontal" data-toggle="validator" id="user_change_pwd">
                        <div class="form-group">
                            <label class="col-xs-3 control-label">ID*</label>
                            <div class="col-xs-2">
                                <input type="text" class="form-control" name="user_id" value="<?php if (isset($_POST['user_id'])) echo $_POST['user_id']; else echo $user_id;?>" data-error="Please enter the user's ID" required readonly>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Current Password*</label>
                            <div class="col-xs-2">
                                <input type="password" class="form-control" name="user_pwd_old" value="<?php if (isset($_POST['user_pwd_old'])) echo $_POST['user_pwd_old'];?>" data-error="Please enter the old password" required>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">New Password*</label>
                            <div class="col-xs-2">
                                <input type="password" class="form-control" name="user_pwd_new" value="<?php if (isset($_POST['user_pwd_new']));?>" data-error="Please enter the new password" required>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Confirm New Password*</label>
                            <div class="col-xs-2">
                                <input type="password" class="form-control" name="user_pwd_confirm" value="<?php if (isset($_POST['user_pwd_confirm']));?>" data-error="Please enter the new password again" required>
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
                             <button class="btn btn-default" type="button" onclick ="location.href='user_settings.php';">Back to Settings</button>
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