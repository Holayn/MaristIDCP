<?php
$title = "IDCP - Home"; //Title of the page
$page = 'home'; //This determines what page user is on for sidebar highlighting
require( 'includes/header.php' ); //Top and side navbars

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    //This pops up when the user logs in for the first time
    if (isset($_GET['login'])) {
        ?>
        <div class="alert alert-success alert-dismissible" role="alert" style="margin-top: 20px">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Welcome!</strong> You have logged in as <?php echo $user_id; ?>!
        </div>
        <?php
    }
}
?>
<!--Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="page-header">
                <h1>Welcome, <?php echo $user_id ?></h1>
            </div>
            <br>
            <div class = "butspan" style = "width: 300px;">
                <button type="button" class="btn btn-primary btn-block" style = "margin-right: 50px; height: 50px;" onclick="location.href='student.php';">Students</button>
                <hr>
                <!--<hr style="width: 100%; color: black; height: 1px; background-color:black;">-->
                <button type="button" class="btn btn-primary btn-block" style = "margin-right: 50px; height: 50px;" onclick="location.href='program.php';">Programs</button>
                <button type="button" class="btn btn-primary btn-block" style = "margin-right: 50px; height: 50px;" onclick="location.href='course.php';">Courses</button>
                <button type="button" class="btn btn-primary btn-block" style = "margin-right: 50px; height: 50px;" onclick="location.href='certificate.php';">Certificates</button>
                <hr>
                <!--<hr style="width: 100%; color: black; height: 1px; background-color:black;"> -->
                <button type="button" class="btn btn-primary btn-block" style = "margin-right: 50px; height: 50px;" onclick="location.href='generate_report.php';">Generate a Report</button>
            </div>
        </div>
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