<!--Page to edit course-->
<?php
    $title = "IDCP - Edit Course";
    $page = 'course';
    $page_name = 'edit_crs';
    require('includes/header.php');
    $crs_id = $_SESSION['CRS_ID'];
    require( 'includes/connect_db_c9.php' ) ;
    require( 'includes/course_helpers.php' ) ;
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
        	$crs_id = "";
        	$crs_name = "";
        	$crs_level = "";
        	$prg_name = "";
        	
        //Regular user cannot access this page
        if($user_role == "User"){
            $page = 'home.php';
            header("Location: $page");
        }
    }
    # Check to make sure the form method is post
    if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
        $crs_id = $_SESSION['CRS_ID'];
        $subquery = 'SELECT PRG_ID FROM CRS_MADE_OF WHERE CRS_ID = "' . $crs_id.'"';
	    $subresults = mysqli_query($dbc, $subquery);
	    $subrow = mysqli_fetch_array( $subresults , MYSQLI_ASSOC );
	    $prg_id_old = $subrow['PRG_ID'];
    	$crs_name = mysqli_real_escape_string($dbc, trim($_POST['crs_name']));
    	$crs_level = mysqli_real_escape_string($dbc, trim($_POST['crs_lvl']));
    	$prg_name = mysqli_real_escape_string($dbc, trim($_POST['prg_name']));
    	$prg_id = get_prg_id($dbc, $prg_name);
    	update_course($dbc, $crs_id, $crs_name, $crs_level, $prg_id, $prg_id_old);
    	$subquery = "SELECT INS_ID FROM TEACHES WHERE CRS_ID = '$crs_id'";
        $result = mysqli_query($dbc, $subquery);
        $subrow = mysqli_fetch_array( $result , MYSQLI_ASSOC );
        $ins_id_old = $subrow['INS_ID'];
    	if(isset($_POST['ins_name'])){
		    if($_POST['ins_name'] != 'None'){
        		$ins_name = $_POST['ins_name'];
        		$query = "SELECT INS_ID FROM INSTRUCTOR WHERE CONCAT(INS_FNAME, ' ', INS_LNAME) LIKE '%$ins_name%'";
        		$results = mysqli_query($dbc, $query);
        		$row = mysqli_fetch_array($results, MYSQLI_ASSOC);
        		$ins_id = $row['INS_ID'];
        		$subquery = "SELECT INS_ID FROM TEACHES WHERE CRS_ID = '$crs_id'";
                $result = mysqli_query($dbc, $subquery);
                if(mysqli_num_rows($result) == 0){
        		    insert_teaches($dbc, $crs_id, $ins_id);
                }
                else{
        		    update_teaches($dbc, $crs_id, $ins_id, $ins_id_old); 
                }
		    }
		}
    	$page = 'course_profile.php';
        header("Location: $page");
    }
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
        <li><a href = "course_search.php">Course Search</a></li>
        <li><a href = "course_profile.php">Course Detail</a></li>
        <li class = "active">Edit Course</li>
    </ol>
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="dropdown">
                    <div class="page-header"><h1>Edit Course Information for <?php $crs_id = $_SESSION['CRS_ID']; echo $crs_id; echo " "; echo get_crs_name($dbc, $crs_id);?></h1></div>
                    <form action ="edit_course.php" method="POST" class="form-horizontal" data-toggle="validator" id="edit_course_form">
                        <div class="form-group">
                            <label class="col-xs-3 control-label"></label>
                            <div class="col-xs-5">
                                <h3>Course Information</h3>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Course ID</label>
                            <div class="col-xs-2">
                                <input type="text" class="form-control" name="crs_id" value="<?php echo $crs_id;?>" disabled readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Course Name*</label>
                            <div class="col-xs-3">
                                <input type="text" class="form-control" name="crs_name" value="<?php echo get_crs_name($dbc, $crs_id);?>" data-error="Please enter a course name" required>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Course Level*</label>
                            <div class="col-xs-2">
                                <select class="form-control" name="crs_lvl" data-error="Please select the level of this course" required>
                                    <option disabled selected value>-- select an option --</option>
                                    <?php $crs_level = get_crs_level($dbc, $crs_id) ?>
                                    <option <?php if($crs_level == 'Expert') echo "selected='selected'" ?>>Expert</option>
                                    <option <?php if($crs_level == 'Professional') echo "selected='selected'" ?>>Professional</option>
                                    <option <?php if($crs_level == 'Associates') echo "selected='selected'" ?>>Associates</option>
                                </select>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Program*</label>
                            <div class="col-xs-2">
                                <select class="form-control" id="sel1" name="prg_name" value="<?php if (isset($_POST['prg_name'])) echo $_POST['prg_name'];?>" data-error="Please select the program name associated with this course" required>
                                <option disabled selected value>-- select an option --</option>
                                <?php
                                    require('includes/connect_db_c9.php');
                                    $query = 'SELECT PRG_NAME FROM PROGRAM';
	                                $results = mysqli_query($dbc, $query);
	                                if($results){
	                                    while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
                                		{
                                		    //getting the employer name from the id
                                		    $prgquery = 'SELECT PRG_NAME FROM PROGRAM, CRS_MADE_OF WHERE CRS_MADE_OF.PRG_ID = PROGRAM.PRG_ID AND CRS_ID = "' . $crs_id.'"';
                                		    $prgresults = mysqli_query($dbc, $prgquery);
                                		    $prgrow = mysqli_fetch_array( $prgresults , MYSQLI_ASSOC );
                                		    $selected = $prgrow [ 'PRG_NAME' ] ;
                                		    if($selected == $row['PRG_NAME']){
                                			    echo "<option selected='selected'>" . $row['PRG_NAME'] . "</option>" ;
                                		    }
                                		    else{
                                		        echo '<option>' . $row['PRG_NAME'] . '</option>' ;
                                		    }
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
                        <label class="col-xs-3 control-label">Course's Instructor</label>
                        <div class="col-xs-2">
                            <select class="form-control" name="ins_name">
                                <option disabled selected value>-- select an option --</option>
                                <option>None</option>
                                <option disabled selected value>-----</option>
                                    <?php
                                        require( 'includes/connect_db_c9.php' ) ;
                                        $query = 'SELECT INS_ID, INS_FNAME, INS_LNAME FROM INSTRUCTOR ORDER BY INS_FNAME, INS_LNAME';
    	                                $results = mysqli_query($dbc, $query);
    	                                $subquery = "SELECT INS_ID FROM TEACHES WHERE CRS_ID = '$crs_id'";
    	                                echo $subquery;
	                                    $result = mysqli_query($dbc, $subquery);
	                                    $subrow = mysqli_fetch_array( $result , MYSQLI_ASSOC );
	                                    $selected = $subrow['INS_ID'];
    	                                if($results){
    	                                    while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
                                    		{
                                    		    if($row['INS_ID'] == $selected){
                                    			    echo '<option selected="selected">' .  " " . $row['INS_FNAME'] . " " . $row['INS_LNAME'] . '</option>' ;
                                    		    }
                                    		    else{
                                    		        echo '<option>' .  " " . $row['INS_FNAME'] . " " . $row['INS_LNAME'] . '</option>' ;
                                    		    }
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
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-5 col-xs-offset-3">
                                <button class="btn btn-danger btn-sm" type="button" style="<?php if($user_role=='User') echo 'display:none;';?>" onclick ="location.href='delete_course_confirm.php';">Delete Course</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-5">
                                 <button type="button" class="btn btn-default" onclick ="location.href='course_profile.php';">Back to Course Profile</button>
                            </div>
                        </div>
                        </form>
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
     <!--Validator Bootstrap Plugin-->
    <script src="js/validator.js"></script>
</body>
</html>
