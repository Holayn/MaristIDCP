<!--Page to edit student's program info-->
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<?php
        $title = "IDCP - Edit Student's Programs";
        $page = 'student';
        $page_name = 'edit_stu_prg';
        require('includes/header.php');
        # Connect to MySQL server and the database
        require( 'includes/connect_db_c9.php' ) ;
        # Includes these helper functions
        require( 'includes/student_helpers.php' ) ;
        $stu_id = $_SESSION['STU_ID'];
        $prg_name = $_SESSION['PRG_NAME'];
        $prg_enroll_start = $_SESSION['PRG_ENROLL_START'];
        $prg_id;
    	$query = "SELECT PRG_ID FROM PROGRAM WHERE PRG_NAME = '$prg_name'";
        $results = mysqli_query( $dbc, $query ) ;
        if($results){
        $row = mysqli_fetch_array($results, MYSQLI_ASSOC);
        $_SESSION['PRG_ID'] = $row['PRG_ID'];
        $prg_id = $row [ 'PRG_ID' ] ;
        }
        else{
    // 		echo $prg_name;
        }
        mysqli_free_result( $results );
        # Check to make sure it is the first time user is visiting the page
        if ($_SERVER['REQUEST_METHOD'] == 'GET'){
        	$query = "SELECT * FROM PRG_ENROLLED WHERE STU_ID = $stu_id AND PRG_ID = $prg_id AND PRG_ENROLL_START = '$prg_enroll_start'";
        	$result = mysqli_query($dbc, $query);
        	$row = mysqli_fetch_array($result, MYSQLI_ASSOC) ;
        	$prg_enroll_status = $row['PRG_ENROLL_STATUS'];
        	$prg_enroll_start = $row['PRG_ENROLL_START'];
        	$prg_enroll_end = $row['PRG_ENROLL_END'];
            //Regular user cannot access this page
            if($user_role == "User"){
                $page = 'home.php';
                header("Location: $page");
            }
        	}
        # Check to make sure the form method is post
        if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
        	$prg_enroll_start_old = $prg_enroll_start;
        	$prg_enroll_status = $_POST['prg_enroll_status'];
        	$prg_enroll_start = $_POST['prg_enroll_start'];
        	$prg_enroll_end = $_POST['prg_enroll_end'];
    		$result = update_record_prg_enrolled($dbc, $prg_enroll_status, $prg_enroll_start, $prg_enroll_end, $prg_id, $stu_id, $prg_enroll_start_old);
    		$page = 'edit_student_program_home.php';
            header("Location: $page");
        }
        # Close the connection
        mysqli_close( $dbc ) ;
        ?>
        <!-- Page Content -->
        <div id="page-content-wrapper" style="margin-left: 50px;">
            <div class="container" style="padding-right: 100px; max-width: 1050px;">
                <div class="dropdown">
                    <div class="row">
                        <div class="page-header">
                            <?php
        				        $stu_id = $_SESSION['STU_ID'];
        				        $name = get_stu_name($dbc, $stu_id);
        				        echo '<h1>Edit ' .$prg_name. ' Enrollment Info for ' . "$name" . '</h1>';
    				        ?>
                        </div>
                    </div>
                    <form action="edit_student_program.php" method="POST" class="form-horizontal" data-toggle="validator" id="edit_student_program">
                        <div class="form-group">
                            <label class="col-xs-3 control-label"></label>
                            <div class="col-xs-5">
                                <h3>Program Information</h3>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Enrollment Status*</label>
                            <div class="col-xs-2">
                                <select class="form-control" id="sel1" name="prg_enroll_status" value="<?php if (isset($_POST['prg_enroll_status'])) echo $_POST['prg_enroll_status'];?>" data-error="Please select the student's enrollment status" required>
                                    <option disabled selected value> -- </option>
                                    <?php
                                        $selected = $prg_enroll_status;
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
                            <label class="col-xs-3 control-label"></label>
                            <div class="col-xs-5">
                                <h3>Time Interval</h3>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label" for="prg_enroll_start">Enroll Date*</label>
                            <div class="col-xs-3">
                                <input type="date" class="form-control" id="prg_enroll_start" value="<?php echo $prg_enroll_start ?>" name="prg_enroll_start" data-error="Please select the student's start date in the program" required>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label" for="prg_enroll_end">Completion Date</label>
                            <div class="col-xs-3">
                                <input type="date" class="form-control" id="prg_enroll_end" value="<?php echo $prg_enroll_end ?>" name="prg_enroll_end" data-error="Please select the student's end date in the program">
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
                                <button class='btn btn-danger' type="button" onclick="location.href='delete_student_program_confirm.php';">Delete</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-5">
                                 <button class="btn btn-default" type="button" onclick ="location.href='edit_student_program_home.php';">Back to Program Info</button>
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
