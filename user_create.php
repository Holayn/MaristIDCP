<!--Page for creating a new user-->
<?php
    $title = "IDCP - New User";
    $page = 'user_settings';
    $page_name = 'add_user';
    require('includes/header.php');
    # Connect to MySQL server and the database
    require( 'includes/connect_db_c9.php' ) ;
    # Includes these helper functions
    require( 'includes/user_helpers.php' ) ;
    $invalid_id = false;
    $invalid_pwd = false;
    # Check to make sure it is the first time user is visiting the page
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    	$user_id = "";
    	$user_pwd = "";
    	$user_pwd_confirm = "";
    	$user_role = "";
    	}
    # Check to make sure the form method is post
    if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
    	$user_id = mysqli_real_escape_string($dbc, trim($_POST['user_id']));
    	$user_pwd = $_POST['user_pwd'];
    	$user_pwd_confirm = $_POST['user_pwd_confirm'];
    	$user_role = $_POST['user_role'];
		#Inserts inputs into table if all inputs are valid and no duplicates
        $query = "SELECT * FROM IDCP_USER WHERE USER_ID='".$user_id."'";
        $result = mysqli_query($dbc,$query);
        if(mysqli_num_rows( $result ) != 0 ){
        	    ?>
            <div class="alert alert-danger alert-dismissible" role="alert" style="margin-top: 20px">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Error!</strong> This user id already exists. Please enter a different one.
            </div>
                <?php
        }
    	else{
    	    if ($user_pwd_confirm != $user_pwd){
                ?>
                <div class="alert alert-danger alert-dismissible" role="alert" style="margin-top: 20px">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Error!</strong> The passwords do not match. Please enter the new password again.
                </div>
        <?php
    	    }
            else{
        	    $result = add_new_user_record($dbc, $user_id, $user_pwd, $user_role);
        	    $page = 'user_success.php';
                header("Location: $page");
        	}
    	}
    }
    # Close the connection
    mysqli_close( $dbc ) ;
?>
</script>
    <!-- Bread Crumbs -->
    <ol class = "breadcrumb">
        <li><a href = "home.php">Home</a></li>
        <li><a href = "user_settings.php">User Settings</a></li>
        <li class = "active">Create New User</li>
    </ol>
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="dropdown">
                    <div class="page-header">
                        <?php
    				        echo '<h1> Create a New User </h1>';
				        ?>
                    </div>
                    <form action="user_create.php" method="POST" class="form-horizontal" data-toggle="validator" id="user_create">
                        <div class="form-group">
                            <label class="col-xs-3 control-label"></label>
                            <div class="col-xs-5">
                                <h3>User Information</h3>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">ID*</label>
                            <div class="col-xs-2">
                                <input type="text" class="form-control" name="user_id" onchange="errorMsgID()" value="<?php if (isset($_POST['user_id'])) echo $_POST['user_id']; else echo $user_id;?>" data-error="Please enter the user's ID" required>
                            </div>

                            <div id="errorMsgID" class="help-block with-errors">
                                <?php
                                    if ($invalid_id){
                                        echo "<span style='color:#960018'> User ID has been taken, please enter a new one </span>";
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Password*</label>
                            <div class="col-xs-2">
                                <input type="password" class="form-control" name="user_pwd" value="<?php if (isset($_POST['user_pwd']));?>" data-error="Please enter the new password" required>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Confirm Password*</label>
                            <div class="col-xs-2">
                                <input type="password" class="form-control" name="user_pwd_confirm" onchange="errorMsgPWD()" value="<?php if (isset($_POST['user_pwd_confirm']));?>" data-error="Please enter the new password again" required>
                            </div>
                            <div id="errorMsgPWD" class="help-block with-errors">
                                <?php
                            	    if($invalid_pwd)
                            	        echo "<span style='color:#960018'> The passwords do not match </span>";
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Role*</label>
                            <div class="col-xs-2">
                                <select class="form-control" id="role1" name="user_role" value="<?php if (isset($_POST['user_role'])) echo $_POST['user_role'];?>" data-error="Please select the role for user" required>
                                    <option disabled selected value> -- </option>
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
                        <div class="form-group">
                            <div class="col-xs-5 col-xs-offset-3">
                                <button type="submit" class="btn btn-success">Add</button>
                            </div>
                        </div>
                        <div class="form-group">
                        <div class="col-xs-5">
                             <button class="btn btn-default" type="button" onclick ="location.href='user_settings.php';">Back to Setings</button>
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
    <script>
        document.getElementsByName("user_id").onchange = function() {errorMsgID()};
        document.getElementsByName("user_pwd_confirm").onchange = function() {errorMsgID()};

        function errorMsgID() {
            document.getElementById("errorMsgID").innerHTML = " ";
        }
        
        function errorMsgPWD() {
            document.getElementById("errorMsgPWD").innerHTML = " ";
        }
    </script>
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Validator Bootstrap Plugin-->
    <script src="js/validator.js"></script>
</body>
</html>
