<!--Edits student's course info-->
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<?php
        $title = "IDCP - Edit Student's Course";
        $page = 'student';
        $page_name = 'edit_stu_crs';
        require('includes/header.php');
        # Connect to MySQL server and the database
        require( 'includes/connect_db_c9.php' ) ;
        # Includes these helper functions
        require( 'includes/student_helpers.php' ) ;
        $stu_id = $_SESSION['STU_ID'];
        $crs_id = $_SESSION['CRS_ID'];
        $crs_enroll_start = $_SESSION['CRS_ENROLL_START'];
        # Check to make sure it is the first time user is visiting the page
        if ($_SERVER['REQUEST_METHOD'] == 'GET'){
        	$query = "SELECT * FROM CRS_ENROLLED WHERE STU_ID = $stu_id AND CRS_ID = '$crs_id' AND CRS_ENROLL_START = '$crs_enroll_start'";
        	$result = mysqli_query($dbc, $query);
        	$row = mysqli_fetch_array($result, MYSQLI_ASSOC) ;
        	$credit = $row['CREDIT'];
        	$grade = mysqli_real_escape_string($dbc, trim($row['GRADE']));
        	$crs_enroll_status = $row['CRS_ENROLL_STATUS'];
        	$crs_enroll_start = $row['CRS_ENROLL_START'];
        	$crs_enroll_end = $row['CRS_ENROLL_END'];
            //Regular user cannot access this page
            if($user_role == "User"){
                $page = 'home.php';
                header("Location: $page");
            }
        	}
        // else{
        //     echo '<p>'.mysqli_error($dbc).'</p>';
        // }
        # Check to make sure the form method is post
        if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
        	$credit = $_POST['credit'];
        	$grade = $_POST['grade'];
        	$crs_enroll_start_old = $crs_enroll_start;
        	$crs_enroll_status = $_POST['crs_enroll_status'];
        	$crs_enroll_start = $_POST['crs_enroll_start'];
        	$crs_enroll_end = $_POST['crs_enroll_end'];
    		$grade = mysqli_real_escape_string($dbc, trim($grade));
    		$result = update_record_crs_enrolled($dbc, $credit, $grade, $crs_enroll_status, $crs_enroll_start, $crs_enroll_end, $crs_id, $stu_id, $crs_enroll_start_old);
    		$page = 'edit_student_courses_home.php';
            header("Location: $page");
        }
        # Close the connection
        mysqli_close( $dbc ) ;
        ?>
        
    <!-- Bread Crumbs -->
    <ol class = "breadcrumb">
        <li><a href = "home.php">Home</a></li>
        <li><a href = "student.php">Student</a></li>
        <li><a href = "student_search.php">Student Search</a></li>
        <li><a href = "student_profile.php">Student Profile</a></li>
        <li><a href = "edit_student_courses_home.php">Student Course Info</a></li>
        <li class = "active"> Edit Student Course Info</li>
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
        				        $crs_name = get_crs_name($dbc, $crs_id);
        				        echo '<h1>Edit '.$crs_id.' '.$crs_name. ' Enrollment Info for ' . "$name" . '</h1>';
    				        ?>
                        </div>
                    </div>
                    <form action="edit_student_course.php" method="POST" class="form-horizontal" data-toggle="validator" id="edit_student_course">
                        <div class="form-group">
                            <label class="col-xs-3 control-label"></label>
                            <div class="col-xs-5">
                                <h3>Standing</h3>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Enrollment Status*</label>
                            <div class="col-xs-2">
                                <select class="form-control" id="sel1" name="crs_enroll_status" value="<?php if (isset($_POST['crs_enroll_status'])) echo $_POST['crs_enroll_status'];?>" data-error="Please select the student's enrollment status" required>
                                    <option disabled selected value> -- </option>
                                    <?php
                                        $selected = $crs_enroll_status;
                                        $statuses = array("Active", "Completed", "Failed", "Dropped");
                                        foreach($statuses as $status){
                                            if($selected == $status){
                                                echo "<option selected='selected' value='$status'>$status</option>" ;
                                            }else{
                                                echo "<option value='$status'>$status</option>" ;
                                            }
                                        }                                  
                                    ?>
                                </select>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Grade</label>
                            <div class="col-xs-2">
                            <!--    <input type="text" class="form-control" maxlength = "2" name="grade" value="<?php if (isset($_POST['grade'])) echo $_POST['grade']; else echo $grade;?>">-->
                            <!--</div>-->
                            <select class="form-control" id="sel2" name="grade" value="<?php if (isset($_POST['grade'])) echo $_POST['grade'];?>">
                                <option disabled selected value> -- </option>
                                <?php
                                    $selected = $grade;
                                    $grades = array("A+", "A", "A-", "B+", "B", "B-", "C+", "C", "C-", "D+", "D", "D-", "F", "W");
                                    foreach($grades as $grade){
                                        if($selected == $grade){
                                            echo "<option selected='selected' value='$grade'>$grade</option>" ;
                                        }else{
                                            echo "<option value='$grade'>$grade</option>" ;
                                        }
                                    }                                  
                                ?>
                            </select>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Taking for Credit?*</label>
                            <div class="col-xs-2">
                                <select class="form-control" id="sel1" name="credit" value="<?php if (isset($_POST['credit'])) echo $_POST['credit'];?>" data-error="Please select if the student is taking the course for credit" required>
                                    <option disabled selected value>--</option>
                                    <option <?php if($credit == 'Yes') echo 'selected="selected"' ?>>Yes</option>
                                    <option <?php if($credit == 'No') echo 'selected="selected"' ?>>No</option>
                                  </select>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label"></label>
                            <div class="col-xs-5">
                                <h3>Time Interval</h3>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label" for="crs_enroll_start">Enroll Date*</label>
                            <div class="col-xs-3">
                                <input type="date" class="form-control" id="crs_enroll_start" value="<?php echo $crs_enroll_start ?>" name="crs_enroll_start" data-error="Please select the student's course start date" required>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label" for="crs_enroll_end">Completion Date</label>
                            <div class="col-xs-3">
                                <input type="date" class="form-control" id="crs_enroll_end" value="<?php echo $crs_enroll_end ?>" name="crs_enroll_end" data-error="Please select the student's course end date">
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-5 col-xs-offset-3">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-5 col-xs-offset-3">
                                <button class='btn btn-danger' type="button" onclick="location.href='delete_student_course_confirm.php';">Delete</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-5">
                                 <button type="button" class="btn btn-default" onclick ="location.href='edit_student_courses_home.php';">Back to Course Info</button>
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
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Validator Bootstrap Plugin-->
    <script src="js/validator.js"></script>
</body>
</html>
