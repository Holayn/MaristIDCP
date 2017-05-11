<!--Page to create a course-->
<?php
    $title = "IDCP - Add Course";
    $page = 'course';
    $page_name = 'add_crs';
    require('includes/header.php');
    # Connect to MySQL server and the database
    require( 'includes/connect_db_c9.php' ) ;
    # Includes these helper functions
    require( 'includes/course_helpers.php' ) ;
    # Check to make sure it is the first time user is visiting the page
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    	$crs_id = "";
    	$crs_name = "";
    	$crs_level = "";
    	
    	//Regular user cannot access this page
    	if($user_role == "User"){
            $page = 'home.php';
            header("Location: $page");
        }
    }
    # Check to make sure the form method is post
    if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
    	$crs_id = mysqli_real_escape_string($dbc, trim($_POST['crs_id']));
    	$crs_name = mysqli_real_escape_string($dbc, trim($_POST['crs_name']));
    	$crs_level = mysqli_real_escape_string($dbc, trim($_POST['crs_lvl']));
		$result = insert_course($dbc, $crs_id, $crs_name, $crs_level);
		//Checks to see if the course id already exists in the DB
		if(mysqli_errno($dbc) == 1062) {
        	    ?>
            <div class="alert alert-danger alert-dismissible" role="alert" style="margin-top: 20px">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Error!</strong> This course id already exists. Please enter a different one.
            </div>
                <?php        
		    
		}
	    else{
    		$prg_name = mysqli_real_escape_string($dbc, trim($_POST['prg_name']));
    		$prg_id = get_prg_id($dbc, $prg_name);
    		insert_course_program($dbc, $crs_id, $prg_id);
    		if(isset($_POST['ins_name'])){
    		    if($_POST['ins_name'] != 'None'){
            		$ins_name = $_POST['ins_name'];
            		echo $ins_name;
            		$query = "SELECT INS_ID FROM INSTRUCTOR WHERE CONCAT(INS_FNAME, ' ', INS_LNAME) LIKE '%$ins_name%'";
            		$results = mysqli_query($dbc, $query);
            		$row = mysqli_fetch_array($results, MYSQLI_ASSOC);
            		$ins_id = $row['INS_ID'];
            		insert_teaches($dbc, $crs_id, $ins_id);
    		    }
    		}
    		$page = 'add_course_success.php';
    		header("Location: $page");
	    }
    }
     mysqli_close( $dbc ) ;
?>
<style>
.button {
    background-color: darkred;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
}
</style>
<!-- Bread Crumbs -->
<ol class = "breadcrumb">
    <li><a href = "home.php">Home</a></li>
    <li><a href = "course.php">Course</a></li>
    <li class = "active">Add Course</li>
</ol>
    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="dropdown">
                <div class="page-header">
                <h1>Add a Course</h1>
                </div>
                <form action="add_course.php" method="POST" class="form-horizontal" role="form" data-toggle="validator">
                    <div class="form-group">
                        <label class="col-xs-3 control-label"></label>
                        <div class="col-xs-5">
                            <h3>Course Information</h3>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label">Course ID*</label>
                        <div class="col-xs-2">
                            <input type="text" class="form-control" maxlength="255" name="crs_id" value="<?php if (isset($_POST['crs_id'])) echo $_POST['crs_id'];?>" data-error="Please enter the course id" required>
                        </div>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label">Course Name*</label>
                        <div class="col-xs-2">
                            <input type="text" class="form-control" maxlength="255" name="crs_name" value="<?php if (isset($_POST['crs_name'])) echo $_POST['crs_name'];?>" data-error="Please enter the course name" required>
                        </div>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label">Course Level*</label>
                        <div class="col-xs-2">
                            <select class="form-control" name="crs_lvl" data-error="Please select the level of this course" required>
                                <option disabled selected value>-----</option>
                                <option>Expert</option>
                                <option>Professional</option>
                                <option>Associates</option>
                            </select>
                        </div>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label">Course's Program*</label>
                        <div class="col-xs-2">
                            <select class="form-control" name="prg_name" value="<?php if (isset($_POST['prg_name'])) echo $_POST['prg_name'];?>" data-error="Please enter the course's program" required>
                                <option disabled selected value>-----</option>
                                    <?php
                                        require( 'includes/connect_db_c9.php' ) ;
                                        $query = 'SELECT PRG_ID, PRG_NAME FROM PROGRAM ORDER BY PRG_NAME';
    	                                $results = mysqli_query($dbc, $query);
    	                                if($results){
    	                                    while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
                                    		{
                                    			echo '<option>' .  " " . $row['PRG_NAME'] . '</option>' ;
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
                        </div>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label">Course's Instructor</label>
                        <div class="col-xs-2">
                            <select class="form-control" name="ins_name">
                                <option disabled selected value>-- select an option --</option>
                                <option>None</option>
                                <option disabled selected value>-----</option>
                                    <?php
                                        require( 'includes/connect_db_c9.php' ) ;
                                        $query = 'SELECT INS_FNAME, INS_LNAME FROM INSTRUCTOR ORDER BY INS_FNAME, INS_LNAME';
    	                                $results = mysqli_query($dbc, $query);
    	                                if($results){
    	                                    while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
                                    		{
                                    			echo '<option>' .  " " . $row['INS_FNAME'] . " " . $row['INS_LNAME'] . '</option>' ;
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
                        </div>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-5 col-xs-offset-3">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-5">
                             <button class="btn btn-default btn-sm" type="button" onclick ="location.href='course.php';">Back to Course Home</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- dropdown -->
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
    <!-- Bootstrap Form Validator -->
    <script src="js/validator.js"></script>
</body>
</html>
