<!--User is redirected to this page after adding a student. Allows them to add courses for that student, or exit back to home page -->
<?php 
    $title = 'IDCP - Add Course for Student';
    $page = 'student';
    $page_name = 'add_stu_crs';
    require('includes/header.php');
    require( 'includes/connect_db_c9.php' ) ;
    require( 'includes/student_helpers.php' ) ;
    
?>
    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="dropdown">
                <div class="page-header">
				    <?php
				        $stu_id = $_SESSION['stu_id'];
				        $_SESSION['STU_ID'] = $stu_id;
				        $name = get_stu_name($dbc, $stu_id);
				        if($_SESSION['addedCourse'] == true){
				            echo '<h1>Add More Courses for ' . "$name" . '</h1>';
				        }
				        else{
				            echo '<h1>Add Courses for ' . "$name" . '</h1>';
				        }
				    ?>
				</div>
                <div class = "butspan" style = "width: 300px;">
                    <button type="button" class="btn btn-primary btn-block" style = "margin-right: 50px;" onclick="location.href='add_student_course.php';">
			        <?php
			        $stu_id = $_SESSION['stu_id'];
			        $name = get_stu_name($dbc, $stu_id);
			        if($_SESSION['addedCourse'] == true){
			            echo 'Add Another Course for ' . "$name";
			        }
			        else{
			           echo 'Add a Course for ' . "$name";
			        }
			    ?></button>
			        <hr>
			        <button type="button" class="btn btn-primary btn-block" style = "margin-right: 50px;" onclick="location.href='student_profile.php';">View <?php echo $name;?>'s Profile</button>
                    <button type="button" class="btn btn-primary btn-block" style = "margin-right: 50px;" onclick="location.href='home.php';">Back to Home</button>
                </div>
                <?php
			        $stu_id = $_SESSION['stu_id'];
			        $name = get_stu_name($dbc, $stu_id);
			        echo '<br>';
			        echo '<h3>Current Courses for ' . "$name" . '</h3>';
			        show_student_courses($dbc, $stu_id);
			    ?>
            </div>
        </div>
        <!-- /#container -->
    </div>
    <!-- /#page-content-wrapper -->
	<!--Footer-->
    <?php require('includes/footer.php'); ?>
</div>
<!-- /#wrapper -->
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <!--Student JavaScript -->
    <script src="js/student.js"></script>
</body>
</html>
