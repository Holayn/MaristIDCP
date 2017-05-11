<!--Page for editing user info-->
<?php
        $title = "IDCP - User Edit Info";
        $page = 'user_settings';
        $page_name = 'edit_user';
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
        	$user_id = $row['USER_ID'];
        	$user_pwd = "";
        	mysqli_free_result($result);
        	}
        else{
            echo '<p>'.mysqli_error($dbc).'</p>';
        }
        # Check to make sure the form method is post
        if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
            $old_user_id = $_SESSION['user_id'];
        	$user_pwd = SHA1($_POST['user_pwd']);
        	if($user_role!="User")
            	$user_role = $_POST['user_role'];
            else
                $user_role = $user_role;
    		#Updates record if all inputs are valid
    		$query = "SELECT USER_PWD FROM IDCP_USER WHERE USER_ID = '$old_user_id'";
        	$result = mysqli_query($dbc, $query);
        	$row = mysqli_fetch_array($result, MYSQLI_ASSOC) ;
        	$user_pwd_data = $row['USER_PWD'];
        	if ($user_pwd != $user_pwd_data){
        	    ?>
                	<div class="alert alert-danger alert-dismissible" role="alert" style="margin-top: 20px">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Error!</strong> Incorrect password. Please enter it again.
                    </div>
        	    <?php
        	}
        	else{
    	        $new_user_id = mysqli_real_escape_string($dbc, trim($_POST['user_id']));
    	        $query = "SELECT * FROM IDCP_USER WHERE USER_ID='".$new_user_id."'";
                $result = mysqli_query($dbc,$query);
                if($new_user_id != $old_user_id){
                    if(mysqli_num_rows( $result ) != 0 ){
        	    ?>
                	<div class="alert alert-danger alert-dismissible" role="alert" style="margin-top: 20px">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Error!</strong> This user id already exist. Please enter a different one.
                    </div>
        	    <?php
                    }
                    else{
                        $_SESSION['user_id'] = $new_user_id;
                	    $result = update_user_record($dbc, $old_user_id, $new_user_id, $user_role);
                	    $page = 'user_settings.php';
                        header("Location: $page");
                    }
                }
                else{
        	        $_SESSION['user_id'] = $new_user_id;
            	    $result = update_user_record($dbc, $old_user_id, $new_user_id, $user_role);
            	    $page = 'user_settings.php';
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
        <li class = "active">Edit User Info</li>
    </ol>
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="dropdown">
                    <div class="page-header">
                        <h1> Manage Your Account</h1>
                    </div>
                    <form action="user_edit.php" method="POST" class="form-horizontal" data-toggle="validator" id="user_edit">
                        <div class="form-group">
                            <label class="col-xs-3 control-label">ID*</label>
                            <div class="col-xs-2">
                                <input type="text" class="form-control" name="user_id" value="<?php echo $user_id;?>" data-error="Please enter the user's ID" required>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Role*</label>
                            <div class="col-xs-2">
                                <select class="form-control" id="sel1" name="user_role" data-error="Please select the role for user" <?php if($user_role != "User") echo 'required'; else echo 'disabled';?>>
                                    <?php
                                        $selected = $user_role;
                                        $roles = array("Admin", "Super User", "User");
                                        foreach($roles as $role){
                                            if($selected == $role){
                                                echo "<option selected='selected' value='$role'>$role</option>" ;
                                            }else{
                                                echo "<option value='$role'>$role</option>" ;
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Enter your Current Password*</label>
                            <div class="col-xs-2">
                                <input type="password" class="form-control" name="user_pwd" value="<?php if (isset($_POST['user_pwd'])) echo $_POST['user_pwd'];?>" data-error="Please enter the password to make change" required>
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

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>

</body>

</html>