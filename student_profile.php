<!--Shows general overview of student info and their enrollment and certificate info-->
<?php 
    $title = "IDCP - Student Profile";
    $page = 'student';
    $page_name = 'stu';
    require('includes/header.php');
    require( 'includes/connect_db_c9.php' ) ;
    require( 'includes/student_helpers.php' ) ;
    require( 'includes/report_helpers.php' ) ;
    $stu_id = $_SESSION['STU_ID'];
    $_SESSION['searchString'] = "";
?>
<script>
    sessionStorage.clear();
</script>
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
    <li><a href = "student.php">Student</a></li>
    <li><a href = "student_search.php">Student Search</a></li>
    <li class = "active">Student Profile</li>
    </ol>
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="page-header">
                    <h1>
                        <?php
                            echo get_stu_name($dbc, $stu_id);
                        ?>
                    </h1>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    Personal Info
                                </h3>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <p><label>ID</label><br>
                                        <?php
    				                        echo $stu_id;                                
    				                    ?>
				                    </p>
                                    <p><label>Gender</label><br>
                                        <?php
                                         echo get_stu_gender($dbc, $stu_id);
                                        ?>
                                    </p>
                                    <p><label>Student Since</label><br>
                                        <?php
                                         echo get_stu_start($dbc, $stu_id);
                                        ?>
                                    </p>
                                    <button class="btn btn-default btn-sm" onclick="location.href='student_profile_detail.php';">View More</button>
                                    <button class="btn btn-default btn-sm" style="<?php if($user_role=='User') echo 'display:none;';?>" onclick ="location.href='edit_student.php';">Edit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-sm-4 -->
                    <div class="col-sm-4">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <h3 class="panel-title">Courses</a></h3>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <?php
                                        show_recent_student_courses($dbc, $stu_id);
                                    ?>
                                <button class="btn btn-default btn-sm" onclick="location.href='edit_student_courses_home.php';">View More</button>
                                    <button class="btn btn-default btn-sm" style="<?php if($user_role=='User') echo 'display:none;';?>" onclick ="location.href='edit_student_courses_home.php';">Edit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-sm-4 -->
                    <div class="col-sm-4">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <h3 class="panel-title">Programs</a></h3>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <?php
                                        show_student_programs($dbc, $stu_id);
                                    ?>
                                <button class="btn btn-default btn-sm" onclick="location.href='edit_student_program_home.php';">View More</button>
                                    <button class="btn btn-default btn-sm" style="<?php if($user_role=='User') echo 'display:none;';?>" onclick ="location.href='edit_student_program_home.php';">Edit</button>
                        
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-sm-4 -->
                    <div class="col-sm-4">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <h3 class="panel-title">Certificates</a></h3>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <?php
                                        show_stu_cert($dbc,$stu_id);
                                    ?>
                                    <button class="btn btn-default btn-sm" onclick="location.href='edit_student_certificate_home.php';">View More</button>
                                    <button class="btn btn-default btn-sm" style="<?php if($user_role=='User') echo 'display:none;';?>" onclick ="location.href='edit_student_certificate_home.php';">Edit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <button class="btn btn-default btn-sm" onclick="location.href='student_search.php';">Back to Search</button>
                        <button class="btn btn-danger btn-sm" style="<?php if($user_role=='User') echo 'display:none;';?>" onclick ="location.href='delete_student_confirm.php';">Delete Student</button>
                    </div>
                </div>
            <!-- /#container close -->
            </div>
        <!-- /#page-content-wrapper -->
        </div>
        <!--Footer-->
        <?php require('includes/footer.php'); ?>
    </div>
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
