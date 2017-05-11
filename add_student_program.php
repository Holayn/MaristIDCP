<!--Allows user to add course for student -->
<?php
    $title = 'IDCP - Add Program for Student';
    $page = 'student';
    $page_name = 'add_stu_prg';
    require('includes/header.php');
    # Connect to MySQL server and the database
    require( 'includes/connect_db_c9.php' ) ;
    # Includes these helper functions
    require( 'includes/student_helpers.php' ) ;
    # Check to make sure it is the first time user is visiting the page
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
        $prg_name = "";
        $prg_enroll_start = "";
        $credit = "";
        //Regular user cannot access this page
        if($user_role == "User"){
            $page = 'home.php';
            header("Location: $page");
        }
    }
    # Check to make sure the form method is post
    if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
        $prg_id = $_POST['prg_name'];
        $prg_enroll_start = $_POST['prg_enroll_start'];
    	$query = "SELECT PRG_ID FROM PROGRAM WHERE PRG_NAME = '$prg_id'";
    	$results = mysqli_query($dbc, $query);
    	$row = mysqli_fetch_array( $results , MYSQLI_ASSOC );
        $prg_id = $row['PRG_ID'];
        $stu_id = $_SESSION['stu_id'];
        $query = "SELECT * FROM PRG_ENROLLED WHERE STU_ID = $stu_id AND PRG_ID = $prg_id AND PRG_ENROLL_STATUS='Active'";
    	$results = mysqli_query($dbc, $query);
    	if(mysqli_num_rows( $results ) != 0 ){
        	    ?>
            <div class="alert alert-danger alert-dismissible" role="alert" style="margin-top: 20px">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Error!</strong> Student is already in this program. Please add a different one.
            </div>
                <?php
                }
        else{
		$result = add_new_prg_enrolled_record($dbc, $stu_id, $prg_id, $prg_enroll_start);
		echo "Success! Thanks" ; 
		$_SESSION['addedProgram'] = true;
		$page = 'add_student_program_home.php';
        header("Location: $page");
        }
    }
    # Close the connection
    mysqli_close( $dbc ) ;
?>
    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="dropdown">
                <div class="page-header">
                    <!--Make this dynamic-->
                    <?php
				        $stu_id = $_SESSION['stu_id'];
				        $name = get_stu_name($dbc, $stu_id);
				        echo '<h1>Add a Program for ' . "$name" . '</h1>';
				    ?>
			    </div>
                <form action="add_student_program.php" method="POST" class="form-horizontal" role="form" data-toggle="validator">
                    <div class="form-group">
                        <label class="col-xs-3 control-label"></label>
                        <div class="col-xs-5">
                            <h3>Program Information</h3>
                        </div>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label">Program*</label>
                        <div class="col-xs-3">
                            <select class="form-control" id="sel1" name="prg_name" value="<?php if (isset($_POST['prg_name'])) echo $_POST['prg_name'];?>" data-error="Please select a program" required>
                            <option disabled selected value>-- select an option --</option>
                            <?php
                                require('includes/connect_db_c9.php');
                                $query = 'SELECT PRG_NAME FROM PROGRAM ORDER BY PRG_NAME';
                                $results = mysqli_query($dbc, $query);
                                if($results){
                                    while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
                            		{
                            			echo '<option>' . $row['PRG_NAME'] . '</option>' ;
                            		}
                                }
                                else
                            	{
                            		echo '<p>' . mysqli_error( $dbc ) . '</p>'  ;
                            	}
                            	# Free up the results in memory
                            	mysqli_free_result( $results );
                            	mysqli_close( $dbc ) ;
                            ?>
                            </select>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label" for="prg_enroll_start">Start Date*</label>
                        <div class="col-xs-3">
                            <input type="date" class="form-control" id="prg_enroll_start" name="prg_enroll_start" data-error="Please select the student's start date in the program" required>
                        </div>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-5 col-xs-offset-3">
                           <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                    <button type="button" class="btn btn-default" onclick ="location.href='add_student_program_home.php';">Back to Add Program</button>
                </form>
            </div>
            <!-- dropdown -->
        </div>
        <!-- /#containter -->
    </div>
    <!-- /#page-content-wrapper -->

    <!--Footer-->
    <?php require('includes/footer.php'); ?>
    </div>
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Validator Bootstrap Plugin-->
    <script src="js/validator.js"></script>
</body>
</html>
