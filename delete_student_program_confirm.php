<!--Confirmation for deleting student's program-->
<?php
    $title = "IDCP - Delete Student's Program";
    $page = 'student';
    $page_name = 'delete_stu_prg';
    require('includes/header.php');
    require( 'includes/connect_db_c9.php' );
    require('includes/delete_helpers.php');
    require('includes/student_helpers.php');
    $prg_id = $_SESSION['PRG_ID'];
    $stu_id = $_SESSION['STU_ID'];
    $prg_enroll_start = $_SESSION['PRG_ENROLL_START'];
    //Regular user cannot access this page
    if($user_role == "User"){
        $page = 'home.php';
        header("Location: $page");
    }
    if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
        $result = delete_student_program($dbc, $prg_id, $stu_id, $prg_enroll_start);
        $page = 'edit_student_program_home.php';
        header("Location: $page");
    }
?>
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="dropdown">
                    <div class="page-header">
                        <h3><p>Are you sure you want to remove <?php echo get_stu_name($dbc, $stu_id); ?>'s enrollment information for <?php echo get_prg_name($dbc, $prg_id); ?>?</p></h3>
                    </div>
                    <form action ="delete_student_program_confirm.php" method="POST"  data-toggle="validator" id="delete_program">
                        <div class="form-group">
                            <div class = "butspan" style = "width: 300px;">
                                <button type="submit" class="btn btn-primary btn-block" style = "margin-right: 50px;">Yes</button>
                                <button type="button" class="btn btn-primary btn-block" style = "margin-right: 50px;" onclick="location.href='edit_student_program.php';">No</button>
                            </div>
                        </div>
                    </form>
                    <br>
                    <button class="btn btn-default btn-sm" onclick="location.href='edit_student_program.php';">Back</button>
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
