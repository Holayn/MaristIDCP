<!--Page to edit program-->
<?php
    $title = "IDCP - Edit Program";
    $page = 'program';
    $page_name = 'edit_prg';
    require('includes/header.php');
    require( 'includes/connect_db_c9.php' ) ;
    require( 'includes/program_helpers.php' ) ;
    $prg_id = $_SESSION['PRG_ID'];
    $prg_name = get_prg_name($dbc, $prg_id);
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
    	$prg_id = $_SESSION['PRG_ID'];
    	$changed = False;
    	if($prg_name != mysqli_real_escape_string($dbc, trim($_POST['prg_name']))){
    	    $changed = True;
    	}
    	$prg_name = mysqli_real_escape_string($dbc, trim($_POST['prg_name']));
    	//checking to see if name already exists
    	$query = "SELECT * FROM PROGRAM WHERE PRG_NAME = '$prg_name'";
    	$results = mysqli_query($dbc, $query);
    	if(mysqli_num_rows( $results ) != 0 ){
    	    if($changed == True){
    	        echo '<script>alert("The program name entered already exists! Please try again")</script>';
    	    }
    	    else{
    	       $page = 'program_profile.php';
               header("Location: $page"); 
    	    }
    	}
    	else{
    	    $result = update_program($dbc, $prg_id, $prg_name);
    	    $_SESSION['PRG_NAME'] = $prg_name;
        	$page = 'program_profile.php';
            header("Location: $page");
	    }
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
        <li><a href = "program.php">Program</a></li>
        <li><a href = "program_search.php">Program Search</a></li>
        <li><a href = "program_profile.php">Program Profile</a></li>
        <li class = "active">Edit Program</li>
    </ol>
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="dropdown">
                    <div class="page-header">
                    <h1>Edit Program Information for <?php $prg_id = $_SESSION['PRG_ID']; echo get_prg_name($dbc, $prg_id);?></h1>
                    </div>
                    <form action ="edit_program.php" method="POST" class="form-horizontal" data-toggle="validator" id="edit_program_form">
                        <div class="form-group">
                            <label class="col-xs-3 control-label"></label>
                            <div class="col-xs-5">
                                <h3>Program Information</h3>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Program Name*</label>
                            <div class="col-xs-2">
                                <input type="text" class="form-control" name="prg_name" maxlength="255" value="<?php echo get_prg_name($dbc, $prg_id);?>" data-error="Please enter a program name" required>
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
                                <button class="btn btn-danger btn-sm" type="button" style="<?php if($user_role=='User') echo 'display:none;';?>" onclick ="location.href='delete_program_confirm.php';">Delete Program</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-5">
                                 <button type="button" class="btn btn-default" onclick ="location.href='program_profile.php';">Back to Profile</button>
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
     <!--Validator Bootstrap Plugin-->
    <script src="js/validator.js"></script>
</body>
</html>
