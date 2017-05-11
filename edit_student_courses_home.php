<!--Edit student's course info-->
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<?php
        $title = "IDCP - Edit Student's Courses";
        $page = 'student';
        $page_name = 'edit_stu_crs';
        require('includes/header.php');
        # Connect to MySQL server and the database
        require( 'includes/connect_db_c9.php' ) ;
        # Includes these helper functions
        require( 'includes/student_helpers.php' ) ;
        $stu_id = $_SESSION['STU_ID'];
        ?>
    <!-- Bread Crumbs -->
    <ol class = "breadcrumb">
        <li><a href = "home.php">Home</a></li>
        <li><a href = "student.php">Student</a></li>
        <li><a href = "student_search.php">Student Search</a></li>
        <li><a href = "student_profile.php">Student Profile</a></li>
        <li class = "active">Student Course Info</li>
    </ol>
        <!-- Page Content -->
        <div id="page-content-wrapper" style="margin-left: 50px;">
            <div class="container-fluid">
                <div class="dropdown">
                    <div class="row">
                        <div class="page-header">
                            <?php
        				        $stu_id = $_SESSION['STU_ID'];
        				        $name = get_stu_name($dbc, $stu_id);
        				        if($user_role != "User")
        				            echo '<h1>Courses for ' . "$name" . '   <small>Click a row to edit</small></h1>';
        				        else
        				            echo '<h1>Course for ' . "$name" . '</h1>';
    				        ?>
                        </div>
                    </div>
                    <div class = "row">
                        <div class = "butspan" style = "width: 300px;">
                        <button type="button" class="btn btn-primary btn-block" style = "margin-right: 50px; height: 50px; <?php if($user_role=='User') echo 'display:none;';?> " onclick="location.href='add_edit_student_course.php';">Add a Course</button>
                        </div>
                    </div>
                    <!--<div class="row">-->
                    <!--    <button class="btn btn-primary" class="btn btn-primary" style="<?php if($user_role=='User') echo 'display:none;';?>" onclick ="location.href='add_edit_student_course.php';">Add a Course</button>-->
                    <!--</div>-->
                    <div class="row">
                        <h3>Active Courses</h3>
                    </div>
                    <!--List the student's active courses-->
                    <div class="row">
                    <?php
                        show_active_courses($dbc, $stu_id); 
                    ?>
                    </div>
                    <div class="row">
                        <h3>Completed Courses</h3>
                    </div>
                    <!--List the student's completed courses-->
                    <div class="row">
                    <?php
                        show_completed_courses($dbc, $stu_id); 
                    ?>
                    </div>
                    <div class="row">
                        <h3>Inactive Courses</h3>
                    </div>
                    <!--List the student's completed courses-->
                    <div class="row">
                    <?php
                        show_inactive_courses($dbc, $stu_id); 
                    ?>
                    </div>
                    <div class="row">
                        <div class = "butspan" style = "width: 300px;">
                            <button class="btn btn-default" onclick ="location.href='student_profile.php';">Back to Profile</button>
                            <button class="btn btn-primary" style="<?php if($user_role=='User') echo 'display:none;';?>" onclick ="location.href='add_edit_student_course.php';">Add a Course</button>
                        </div>
                    </div>
                </div>
            </div>
        <!-- /#page-content-wrapper -->
        </div>
        <!--Footer-->
        <?php require('includes/footer.php'); ?>
    </div>
    <!-- /#wrapper -->
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Validator Bootstrap Plugin-->
    <script src="js/validator.js"></script>
    <?php if($user_role != "User"){?>
    <!--Makes table rows clickable-->
    <script>
    jQuery(document).ready(function($) {
        $('.table > tbody > tr').click(function() {
            var crsid = $(this).find('td:first').text();
            var crsenrollstart = $(this).find('td:nth-child(3)').text();
            jQuery.ajax({
                url: 'backendcrs.php',
                type: 'POST',
                data: {
                    'CRS_ID': crsid,
                    'CRS_ENROLL_START': crsenrollstart,
                },
                dataType : 'json',
                success: function(data, textStatus, xhr) {
                    window.location.href = "edit_student_course.php";
                    console.log(data); // do with data e.g success message
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.log(textStatus.reponseText);
                    window.location.href = "edit_student_course.php";
                }
            });
        });
    });
    </script>
    <?php } ?>
</body>
</html>
