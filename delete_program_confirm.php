<!--Confirmation page for deleting a program-->
<?php
    $title = "IDCP - Delete Program";
    $page = 'program';
    $page_name = 'delete_prg';
    require('includes/header.php');
     require( 'includes/connect_db_c9.php' );
     require('includes/delete_helpers.php');
     require('includes/program_helpers.php');
    $prg_id = $_SESSION['PRG_ID'];
    //Regular user cannot access this page
    if($user_role == "User"){
        $page = 'home.php';
        header("Location: $page");
    }
    if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
            $prg_id = $_SESSION['PRG_ID'];
            $result = delete_program($dbc, $prg_id);
        	$page = 'program_search.php';
            header("Location: $page");
        }
?>

     <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="dropdown">
                    <div class="page-header"><h3><p>Are you sure you want to delete <?php echo get_prg_name($dbc, $prg_id); ?>?</h3></div>
                    <b>WARNING:</b> All certificates corresponding to <?php echo get_prg_name($dbc, $prg_id); ?> will be deleted!
                    </p>
                        <div class = "butspan" style = "width: 300px;">
                             <button type="button"class="btn btn-primary btn-block" style = "margin-right: 50px;" data-toggle="modal" data-target="#myModal">Yes</button>
                            <button type="button" class="btn btn-primary btn-block" style = "margin-right: 50px;" onclick="location.href='program_profile.php';">No</button>
                        </div>
                        <br>
                        <button class="btn btn-default btn-sm" onclick="location.href='program_profile.php';">Back</button>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
        <!--Footer-->
        <?php require('includes/footer.php'); ?>
  
    </div>
    <!-- /#wrapper -->
    
      <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">WARNING: This will permanently delete <?php echo get_prg_name($dbc, $prg_id); ?> and ALL corresponding certificates!</h4>
            </div>
            <div class="modal-body">
              <form action ="delete_program_confirm.php" method="POST"  data-toggle="validator" id="delete_program">
                    <div class="form-group">
                        <div class = "butspan" style = "width: 300px; margin-left: 125px;">
                              <button type="submit" class="btn btn-primary btn-block">Delete <?php echo get_prg_name($dbc, $prg_id); ?></button>
                        </div>
                    </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
          </div>
        </div>
    </div>
  <!-- end of Modal-->
  
    <!-- Modal -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>

