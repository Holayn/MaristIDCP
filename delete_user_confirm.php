<!--Confirmation to delete a student's course-->
<?php
    $title = "IDCP - Delete User";
    $page = 'user_settings';
    $page_name = 'delete_user';
    $other_user_id = $_SESSION['OTHER_USER_ID'];
    require('includes/header.php');
    require( 'includes/connect_db_c9.php' );
    require('includes/delete_helpers.php');
    //Regular user cannot access this page
    if($user_role == "User"){
        $page = 'home.php';
        header("Location: $page");
    }
    if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
            $other_user_id = $_SESSION['OTHER_USER_ID'];
            $result = delete_other_user($dbc, $other_user_id);
        	$page = 'user_settings.php';
            header("Location: $page");
        }
?>
    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="dropdown">
                <div class="page-header">
                    <h3><p>Are you sure you want to remove the <?php echo $_SESSION['OTHER_USER_ID']; ?> user?</p></h3>
                </div>
                <form action ="delete_user_confirm.php" method="POST"  data-toggle="validator" id="delete_user">
                    <div class="form-group">
                        <div class = "butspan" style = "width: 300px;">
                            <button type="submit" class="btn btn-primary btn-block" style = "margin-right: 50px;">Yes</button>
                            <button type="button" class="btn btn-primary btn-block" style = "margin-right: 50px;" onclick="location.href='other_user_settings.php';">No</button>
                        </div>
                    </div>
                </form>
                <br>
                <button class="btn btn-default btn-sm" onclick="location.href='user_settings.php';">Back</button>
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
</body>
</html>
