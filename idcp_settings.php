<!--Settings page for IDCP-->
<?php
    $title = "IDCP - Settings";
    $page = 'idcp_settings';
    $page_name ='idcp_settings';
    require('includes/header.php');
    if(isset($_SESSION['searchString'])){
    $_SESSION['searchString'] = "";
    }
    unset($_SESSION['order']);
?>
    <!-- Bread Crumbs -->
    <ol class = "breadcrumb">
        <li><a href = "home.php">Home</a></li>
        <li class = "active">IDCP Settings</li>
    </ol>
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="dropdown">
                    <div class="page-header">
                        <h1>IDCP Settings</h1>
                    </div>
                    <br>
                    <div class = "butspan" style = "width: 300px;">
                        <button type="button" class="btn btn-primary btn-block" style = "margin-right: 50px; height: 50px; <?php if($user_role=='User') echo 'display:none;';?>" onclick="location.href='instructor_add.php';">Add Instructors</button>
                        <button type="button" class="btn btn-primary btn-block" style = "margin-right: 50px; height: 50px;" onclick="location.href='instructor_search.php';">Search Instructors</button>
                        <hr>
                        <button type="button" class="btn btn-primary btn-block" style = "margin-right: 50px; height: 50px; <?php if($user_role=='User') echo 'display:none;';?>" onclick="location.href='employer_add.php';">Add Employers</button>
                        <button type="button" class="btn btn-primary btn-block" style = "margin-right: 50px; height: 50px;" onclick="location.href='employer_search.php';">Search Employers</button>
                    </div>
                </div>
                <br><br>
                <button type="button" class="btn btn-default" onclick="location.href='home.php'">Back to Home</button>
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
</body>
</html>
