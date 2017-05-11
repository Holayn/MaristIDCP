<!--Home page for certificates-->
<?php 
    $title = "IDCP - Certificate";
    $page = 'certificate';
    $page_name = 'cert';
    require('includes/header.php');
    if(isset($_SESSION['searchString'])){
        $_SESSION['searchString'] = "";
    }
?>
<!-- Bread Crumbs -->
<ol class = "breadcrumb">
    <li><a href = "home.php">Home</a></li>
    <li class = "active">Certificate</li>
</ol>
    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="dropdown">
                <div class="page-header">
                    <h1>Certificates</h1>
                </div>
                <br>
                <div class = "butspan" style = "width: 300px;">
                    <button type="button" class="btn btn-primary btn-block" style = "margin-right: 50px; height: 50px; <?php if($user_role=='User') echo 'display:none;';?> " onclick="location.href='certificate_add.php';">Add New Certificate</button>
                    <button type="button" class="btn btn-primary btn-block" style = "margin-right: 50px; height: 50px;" onclick="location.href='certificate_search.php';">Search for Certificate</button>
                </div>
            </div>
            <br>
            <button class="btn btn-default btn-sm" onclick ="location.href='home.php';">Back to Home</button>
        </div>
        <!-- /#container --> 
    </div>
    <!-- /#page-content-wrapper -->
	<!-- Footer -->
    <?php require('includes/footer.php'); ?>
</div>
<!-- /#wrapper -->
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>