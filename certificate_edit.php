<!--Edit certificate page-->
<?php
    $title = "IDCP - Edit Certificate";
    $page = 'certificate';
    $page_name = 'edit_cert';
    require('includes/header.php');
    # Connect to MySQL server and the database
    require( 'includes/connect_db_c9.php' ) ;
    # Includes these helper functions
    require( 'includes/certificate_helpers.php' ) ;
    $cert_id = $_SESSION['CERT_ID'];
    $cert_name = $_SESSION['CERT_NAME'];
    # Check to make sure it is the first time user is visiting the page
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    	$query = "SELECT * FROM CERTIFICATE WHERE CERT_ID = ".$cert_id."";
    	//show_query($query);
    	$result = mysqli_query($dbc, $query);
    	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    	$cert_name = $row['CERT_NAME'];
    	$prg_id = $row['PRG_ID'];

        //Regular user cannot access this page
        if($user_role == "User"){
            $page = 'home.php';
            header("Location: $page");
        }
    	}
    # Check to make sure the form method is post
    if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
        $changed = False;
        echo $cert_name;
    	if($cert_name != mysqli_real_escape_string($dbc, trim($_POST['cert_name']))){
    	    $changed = True;
    	}
    	$cert_name = mysqli_real_escape_string($dbc, trim($_POST['cert_name']));
    	$prg_name = mysqli_real_escape_string($dbc, trim($_POST['prg_name']));
    	$prg_id = get_prg_id($dbc, $prg_name);
    	$query = "SELECT * FROM CERTIFICATE WHERE CERT_NAME = '$cert_name'";
    	echo $query;
    	$results = mysqli_query($dbc, $query);
    	if(mysqli_num_rows( $results ) != 0 ){
    	    if($changed == True){
        	    ?>
            <div class="alert alert-danger alert-dismissible" role="alert" style="margin-top: 20px">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Error!</strong> This certificate name already exists. Please enter a different one.
            </div>
                <?php
    	    }
    	    else{
    	       $result = update_record_cert($dbc, $cert_id, $cert_name, $prg_id);
    	       $page = 'certificate_detail.php';
               header("Location: $page"); 
    	    }
    	}
    	else{
    	    $result = update_record_cert($dbc, $cert_id, $cert_name, $prg_id);
    	    $_SESSION['CERT_NAME'] = $cert_name;
        	$page = 'certificate_detail.php';
            header("Location: $page");
	    }
    }
    # Close the connection
    mysqli_close( $dbc ) ;
?>
<!-- Bread Crumbs -->
<ol class = "breadcrumb">
    <li><a href = "home.php">Home</a></li>
    <li><a href = "certificate.php">Certificate</a></li>
    <li><a href = "certificate_search.php">Certificate Search</a></li>
    <li><a href = "certificate_detail.php">Certificate Detail</a></li>
    <li class = "active">Edit Certificate</li>
</ol>
<!-- Page Content -->
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="dropdown">
            <div class="page-header">
                <?php
			        $cert_id = $_SESSION['CERT_ID'];
			        $cert_name = get_cert_name($dbc, $cert_id);
			        echo '<h1>Edit ' .$cert_name. ' Info </h1>';
		        ?>
            </div>
            <form action="certificate_edit.php" method="POST" class="form-horizontal" data-toggle="validator" id="certificate_edit">
                <div class="form-group">
                    <label class="col-xs-3 control-label">Certificate Name*</label>
                    <div class="col-xs-3">
                        <input type="text" class="form-control" name="cert_name" value="<?php if (isset($_POST['cert_name'])) echo $_POST['cert_name']; else echo $cert_name;?>" data-error="Please enter a certificate name" required>
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label">Program*</label>
                    <div class="col-xs-2">
                        <select class="form-control" id="sel1" name="prg_name" value="<?php if (isset($_POST['prg_name'])) echo $_POST['prg_name'];?>" data-error="Please select the program it belongs in" required>
                            <option disabled selected value>-- select an option --</option>
                            <?php
                                $selected = get_prg_name($dbc, $cert_id);
                                require( 'includes/connect_db_c9.php' ) ; 
                                $query = "SELECT PRG_ID FROM PROGRAM";
                                $results = mysqli_query($dbc, $query);
                                if($results){
                                	while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) ){
                                	    $query_name = "SELECT PRG_NAME FROM PROGRAM WHERE PRG_ID=".$row['PRG_ID']." ORDER BY PRG_NAME";
                                	    $results_name = mysqli_query($dbc, $query_name);
                                	    if ($results_name){
                                	        while ( $row = mysqli_fetch_array( $results_name , MYSQLI_ASSOC ) ){
	                                    	    $prg = $row['PRG_NAME'];
                                                if($selected == $prg){
                                                    echo "<option selected='selected' value='$prg'>$prg</option>" ;
                                                }else{
                                                    echo "<option value='$prg'>$prg</option>" ;
                                                }
                                	        }
                                	    }
                                	    else{
                                	        echo "Error";
                                	    }
                                    }
                                }
                                else {
                                    echo 'Error';
                                }
                                # Free up the results in memory
                            	mysqli_free_result( $results );
                            	mysqli_free_result( $results_name );
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
                    <div class="col-xs-5 col-xs-offset-3">
                        <button type = "button" class="btn btn-danger btn-sm" style="<?php if($user_role=='User') echo 'display:none;';?>" onclick ="location.href='delete_certificate_confirm.php';">Delete Certificate</button>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-5">
                         <button type="button" class="btn btn-default" onclick ="location.href='certificate_detail.php';">Back to Profile</button>
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
    <!-- Validator Bootstrap Plugin-->
    <script src="js/validator.js"></script>
</body>
</html>