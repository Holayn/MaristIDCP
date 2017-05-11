<!--User is redirected to this page after adding a student. Allows them to add courses for that student, or exit back to home page -->
<?php 
    $title = 'IDCP - Add Program for Student';
    $page = 'student';
    $page_name = 'add_stu_prg';
    require('includes/header.php');
    require( 'includes/connect_db_c9.php' ) ;
    require( 'includes/student_helpers.php' ) ;
?>
<script>
    sessionStorage.clear();
</script>
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="dropdown">
                    <div class="page-header">
    				    <?php
    				        $stu_id = $_SESSION['STU_ID'];
    				        $name = get_stu_name($dbc, $stu_id);
    				        if($_SESSION['addedProgram'] == true){
    				            echo '<h1>Add More Programs for ' . "$name" . '</h1>';
    				        }
    				        else{
    				            echo '<h1>Add Program for ' . "$name" . '</h1>';
    				        }
    				    ?>
    				</div>
                    <div class = "butspan" style = "width: 300px;">
                        <button type="button" class="btn btn-primary btn-block" style = "margin-right: 50px;" onclick="location.href='add_student_program.php';">
				        <?php
				        $stu_id = $_SESSION['STU_ID'];
				        $name = get_stu_name($dbc, $stu_id);
				        if($_SESSION['addedProgram'] == true){
				            echo 'Add Another Program for ' . "$name";
				        }
				        else{
				           echo 'Add a Program for ' . "$name";
				        }
				    ?></button>
				    <hr>
				        <!--Dynamic button-->
				        <?php
				        $stu_id = $_SESSION['STU_ID'];
				        $name = get_stu_name($dbc, $stu_id);
				        if($_SESSION['addedProgram'] == true){
				            //This line below might not work
				            echo '<button type="button" class="btn btn-primary btn-block" style = "margin-right: 50px;" onclick="location.href=\'add_student_course.php\';">';
				            echo 'Add Courses for ' . "$name";
				            echo "</button>";
				        }
				        else{
				           echo '<p>Please add a program for this student before proceeding</p>';
				        }
				        ?>
                </div>
                <hr>
                <?php
		            $stu_id = $_SESSION['STU_ID'];
		            get_student_programs($dbc, $stu_id);
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
