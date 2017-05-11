<!--Home page for course-->
<?php 
$title = 'IDCP - Course';
$page = 'course';
$page_name = 'crs';
require('includes/header.php');
if(isset($_SESSION['searchString'])){
    $_SESSION['searchString'] = "";
}
unset($_SESSION['order']);
?>
<!-- Bread Crumbs -->
    <ol class = "breadcrumb">
        <li><a href = "home.php">Home</a></li>
        <li class = "active">Course</li>
    </ol>
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="dropdown">
                    <div class="page-header">
                        <h1>Courses</h1>
                    </div>
                    <br>
                    <div class = "butspan" style = "width: 300px;">
                        <button type="button" class="btn btn-primary btn-block" style = "margin-right: 50px; height: 50px; <?php if($user_role=='User') echo 'display:none;';?> " onclick="location.href='add_course.php';">Add New Course</button>
                        <button type="button" class="btn btn-primary btn-block" style = "margin-right: 50px; height: 50px;" onclick="location.href='course_search.php';">Search for Course</button>
                    </div>
                    <br>
                    <button class="btn btn-default btn-sm" onclick ="location.href='home.php';">Back to Home</button>
                </div>
            </div>
            <!-- /#containter -->
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
</body>
</html>