<!--Confirmation pages for deleting cert-->
<?php
    $title = "IDCP - Delete Student Certificate";
    $page = 'cetificate';
    $page_name = 'delete_cert';
    require('includes/header.php');
    require( 'includes/connect_db_c9.php' );
    require('includes/delete_helpers.php');
    require('includes/student_helpers.php');
    $stu_id = $_SESSION['STU_ID'];
    $certname = $_SESSION['CERT_NAME'];
    $query = "SELECT CERT_ID FROM CERTIFICATE WHERE CERT_NAME = '".$certname."'";
    $results = mysqli_query($dbc,$query) ;
	$row = mysqli_fetch_array($results, MYSQLI_ASSOC) ;
	$cert_id = $row [ 'CERT_ID' ] ;
    //Regular user cannot access this page
    if($user_role == "User"){
        $page = 'home.php';
        header("Location: $page");
    }
    if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
        $crs_id = $_SESSION['CRS_ID'];
        $result = delete_student_certificate($dbc, $stu_id , $cert_id);
    	$page = 'edit_student_certificate_home.php';
        header("Location: $page");
    }
    
?>
    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="dropdown">
                <div class="page-header">
                    <h3><p>Are you sure you want to delete <?php echo $certname?> from <?php echo get_stu_name($dbc,$stu_id); ?>'s profile?</p></h3>
                </div>
                <div class = "butspan" style = "width: 300px;">
                    <button type="button"class="btn btn-primary btn-block" style = "margin-right: 50px;" data-toggle="modal" data-target="#myModal">Yes</button>
                    <button type="button" class="btn btn-primary btn-block" style = "margin-right: 50px;" onclick="location.href='edit_student_certificate.php';">No</button>
                </div>
                <br>
                <button class="btn btn-default btn-sm" onclick="location.href='edit_student_certificate.php';">Back</button>
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->
    <!--Footer-->
    <?php require('includes/footer.php'); ?>
    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">WARNING: This will permanently delete <?php echo $certname ?> from <?php echo get_stu_name($dbc,$stu_id); ?>'s profile!</h4>
            </div>
            <div class="modal-body">
                <form action ="delete_student_certificate_confirm.php" method="POST"  data-toggle="validator" id="delete_stu_cert">
                    <div class="form-group">
                        <div class = "butspan" style = "width: 300px; margin-left: 125px;">
                              <button type="submit" class="btn btn-primary btn-block">Delete <?php echo $certname ?></button>
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
</div>
<!-- /#wrapper -->
    <!-- Modal -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>

