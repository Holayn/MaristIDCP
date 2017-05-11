<!--Confirmation to delete a student's course-->
<?php
    $title = "IDCP - Delete Student's Course";
    $page = 'student';
    $page_name = 'delete_stu_crs';
    require('includes/header.php');
     require( 'includes/connect_db_c9.php' );
     require('includes/delete_helpers.php');
     require('includes/student_helpers.php');
    $crs_id = $_SESSION['CRS_ID'];
    $stu_id = $_SESSION['STU_ID'];
    $crs_enroll_start = $_SESSION['CRS_ENROLL_START'];
    //Regular user cannot access this page
    if($user_role == "User"){
        $page = 'home.php';
        header("Location: $page");
    }
    if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
            $result = delete_student_course($dbc, $crs_id, $stu_id, $crs_enroll_start);
        	$page = 'edit_student_courses_home.php';
            header("Location: $page");
        }
?>
    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="dropdown">
                <div class="page-header">
                    <h3><p>Are you sure you want to remove <?php echo get_stu_name($dbc, $stu_id); ?>'s enrollment in <?php echo $crs_id; echo " "; echo get_crs_name($dbc, $crs_id); ?>?</p></h3>
                </div>
                <form action ="delete_student_course_confirm.php" method="POST"  data-toggle="validator" id="delete_course">
                    <div class="form-group">
                        <div class = "butspan" style = "width: 300px;">
                            <button type="submit" class="btn btn-primary btn-block" style = "margin-right: 50px;">Yes</button>
                            <button type="button" class="btn btn-primary btn-block" style = "margin-right: 50px;" onclick="location.href='edit_student_course.php';">No</button>
                        </div>
                    </div>
                </form>
                <br>
                <button class="btn btn-default btn-sm" onclick="location.href='edit_student_course.php';">Back</button>
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
