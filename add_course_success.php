<!--Success page for adding a course-->
<?php
    $title = 'IDCP - Add Course Success';
    $page = 'course';
    $page_name = 'add_crs';
    require('includes/header.php');
    $page = 'course.php';
	header("Refresh: 3;url=$page");
?>
    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="dropdown">
                <h1>Success!</h1>
                <p>You will be automatically redirected in 3 seconds...</p>
                <div class = "butspan" style = "width: 300px;">
                    <button type="button" class="btn btn-primary btn-block" style = "margin-right: 50px;" onclick="location.href='course.php';">Continue</button>
                </div>
            </div>
            <!-- dropdown -->
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
</body>
</html>
