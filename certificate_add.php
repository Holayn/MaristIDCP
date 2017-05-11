<!--Allows user to add certificate to DB-->
<?php
    $title = "IDCP - Add Certificate";
    $page = 'certificate';
    $page_name = 'add_cert';
    require('includes/header.php');
    # Connect to MySQL server and the database
    require( 'includes/connect_db_c9.php' ) ;
    # Includes these helper functions
    require( 'includes/certificate_helpers.php' ) ;
    # Check to make sure it is the first time user is visiting the page
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    	$cert_name = "";
    	$prg_name = "";
    	$prg_id = "";
    	
        //Regular user cannot access this page
        if($user_role == "User"){
            $page = 'home.php';
            header("Location: $page");
        }
    }
    # Check to make sure the form method is post
    if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
    	$cert_name = mysqli_real_escape_string($dbc, trim($_POST['cert_name']));
    	$prg_name = mysqli_real_escape_string($dbc, trim($_POST['prg_name']));
		$prg_id = get_prg_id($dbc, $prg_name);
	    $query = "SELECT * FROM CERTIFICATE WHERE CERT_NAME = '$cert_name'";
    	$results = mysqli_query($dbc, $query);
    	if(mysqli_num_rows( $results ) != 0 ){
        	    ?>
            <div class="alert alert-danger alert-dismissible" role="alert" style="margin-top: 20px">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Error!</strong> This certificate name already exists. Please enter a different one.
            </div>
                <?php
                }
		else{
		    $result = insert_certificate($dbc, $cert_name, $prg_id);
    		$page = 'certificate_add_success.php';
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
    <li><a href = "certificate.php">Certificate</a></li>
    <li class = "active">Add Certificate</li>
</ol>
<!-- Page Content -->
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="dropdown">
                <div class="page-header">
                    <h1>Add a Certificate</h1>
                </div>
                <form action="certificate_add.php" method="POST" class="form-horizontal" role="form" data-toggle="validator">
                    <div class="form-group">
                        <label class="col-xs-3 control-label"></label>
                        <div class="col-xs-5">
                            <h3>Certificate Information</h3>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label">Certificate Name*</label>
                        <div class="col-xs-2">
                            <input type="text" class="form-control" name="cert_name" value="<?php if (isset($_POST['cert_name'])) echo $_POST['cert_name'];?>" data-error="Please enter the certificate name" required>
                        </div>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label">Certificates's Program*</label>
                        <div class="col-xs-2">
                            <select class="form-control" name="prg_name" value="<?php if (isset($_POST['prg_name'])) echo $_POST['prg_name'];?>" data-error="Please enter the certificate's program" required>
                                <option disabled selected value>-- select an option --</option>
                                <?php
                                    require( 'includes/connect_db_c9.php' ) ;
                                    $query = 'SELECT PRG_NAME FROM PROGRAM ORDER BY PRG_NAME';
	                                $results = mysqli_query($dbc, $query);
	                                if($results){
	                                    while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
                                		{
                                			echo '<OPTION>' . $row['PRG_NAME'] . '</OPTION>' ;
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
                             <button class="btn btn-default btn-sm" type="button" onclick ="location.href='certificate.php';">Back to Certificate Home</button>
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
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Bootstrap Form Validator -->
    <script src="js/validator.js"></script>
</body>
</html>
