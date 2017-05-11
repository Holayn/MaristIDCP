<!--Confirmation to delete a student's course-->
<?php
    $title = "IDCP - Delete Employer";
    $page = 'idcp_settings';
    $page_name = 'delete_employer';
    require('includes/header.php');
    $emp_name = $_SESSION['EMP_NAME'];
    require( 'includes/connect_db_c9.php' );
    require('includes/delete_helpers.php');
    require('includes/student_helpers.php');
    //Regular user cannot access this page
    if($user_role == "User"){
        $page = 'home.php';
        header("Location: $page");
    }
    if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
        $emp_name = $_SESSION['EMP_NAME'];
            $result = delete_employer($dbc, $emp_name);
        	$page = 'employer_search.php';
            header("Location: $page");
        }
?>
    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="dropdown">
                <div class="page-header">
                    <h3><p>Are you sure you want to remove <?php echo $_SESSION['EMP_NAME']; ?> from the database?</p></h3>
                </div>
                <form action ="delete_employer_confirm.php" method="POST"  data-toggle="validator" id="delete_employer">
                    <div class="form-group">
                        <div class = "butspan" style = "width: 300px;">
                            <button type="submit" class="btn btn-primary btn-block" style = "margin-right: 50px;">Yes</button>
                            <button type="button" class="btn btn-primary btn-block" style = "margin-right: 50px;" onclick="location.href='edit_employer.php';">No</button>
                        </div>
                    </div>
                </form>
                <br>
                <button class="btn btn-default btn-sm" onclick="location.href='edit_employer.php';">Back</button>
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
