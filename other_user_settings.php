<!--User profile page-->
<?php 
    $title = "IDCP - User Profile";
    $page = 'user_settings';
    $page_name = 'user';
    require('includes/header.php');
    require( 'includes/connect_db_c9.php' ) ;
    require( 'includes/user_helpers.php' ) ;
    $other_user_id = $_SESSION['OTHER_USER_ID'];
    //Regular user cannot access this page
        if($user_role == "User"){
            $page = 'home.php';
            header("Location: $page");
        }
?>
<style>
    .inline {
  display: inline;
}
.link-button {
  background: none;
  border: none;
}
.link-button:focus {
  outline: none;
}
.link-button:hover {
  outline: none;
}
.link-button:active {
  color:white;
}
</style>
    <!-- Bread Crumbs -->
    <ol class = "breadcrumb">
    <li><a href = "home.php">Home</a></li>
    <li><a href = "user_settings.php">User Settings</a></li>
    <li class = "active"><?php echo $other_user_id ?></li>
    </ol>
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="page-header">
                    <h1>
                        <?php
                            echo "$other_user_id's User Account";
                        ?>
                    </h1>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <h3 class="panel-title">Account Information</a></h3>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <p><label>User ID: </label><br>
                                    <?php
                                     echo $other_user_id;
                                    ?>
                                    </p>
                                    <p><label>Role:</label><br>
                                    <?php
                                      echo get_user_role($dbc, $other_user_id);
                                    ?>
                                    </p>
                                    <button class="btn btn-default btn-sm" onclick ="location.href='other_user_edit.php';">Edit</button>
                                    <button class="btn btn-default btn-sm" onclick ="location.href='other_user_change_pwd.php';">Change Password</button>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-default btn-sm" onclick ="location.href='user_settings.php';">Back to Settings</button>
                    </div>
                </div>
            <!-- /#container close -->
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
</body>
</html>
