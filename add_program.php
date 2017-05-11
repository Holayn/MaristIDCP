<!--Allows user to add a program to the DB-->
<?php
    $title = "IDCP - Add Program";
    $page = 'program';
    $page_name = 'add_prg';
    require('includes/header.php');
    # Connect to MySQL server and the database
    require( 'includes/connect_db_c9.php' ) ;
    # Includes these helper functions
    require( 'includes/program_helpers.php' ) ;
    # Check to make sure it is the first time user is visiting the page
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    	$prg_id = "";
    	$prg_name = "";
    	
    	//Regular user cannot access this page
        if($user_role == "User"){
            $page = 'home.php';
            header("Location: $page");
        }
    }
    # Check to make sure the form method is post
    if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
    	$prg_name = mysqli_real_escape_string($dbc, trim($_POST['prg_name']));
		$query = "SELECT * FROM PROGRAM WHERE PRG_NAME = '$prg_name'";
    	$results = mysqli_query($dbc, $query);
    	if(mysqli_num_rows( $results ) != 0 ){
        	    ?>
            <div class="alert alert-danger alert-dismissible" role="alert" style="margin-top: 20px">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Error!</strong> This program name already exists. Please enter a different one.
            </div>
                <?php
                }
		else{
		    $result = insert_program($dbc, $prg_name);
		    $page = 'add_program_success.php';
	    	header("Location: $page");
		}
    }
     mysqli_close( $dbc ) ;
?>
<script>
    //Makes sure user only enters numbers
    function isNumberKey(evt){
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
</script>
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
    <li><a href = "program.php">Program</a></li>
    <li class = "active">Add Program</li>
</ol>
    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="dropdown">
                <div class="page-header">
                    <h1>Add a Program</h1>
                </div>
                <form action="add_program.php" method="POST" class="form-horizontal" role="form" data-toggle="validator">
                    <div class="form-group">
                        <label class="col-xs-3 control-label"></label>
                        <div class="col-xs-5">
                            <h3>Program Information</h3>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label">Program Name*</label>
                        <div class="col-xs-2">
                            <input type="text" class="form-control" name="prg_name" maxlength="255" value="<?php if (isset($_POST['prg_name'])) echo $_POST['prg_name'];?>" data-error="Please enter the program name" required>
                        </div>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-5 col-xs-offset-3">
                            <p><button type="submit" class="btn btn-success">Submit</button></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-5">
                             <button class="btn btn-default btn-sm" type="button" onclick ="location.href='program.php';">Back to Program Home</button>
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
    <!-- Bootstrap Form Validator -->
    <script src="js/validator.js"></script>
</body>
</html>
