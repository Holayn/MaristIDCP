<!--Success page for creating a user-->
<?php
    $title = "IDCP - Create User Success";
    $page = 'user_settings';
            $page_name = 'add_user';
    require('includes/header.php');
    $page = 'user_settings.php';
	header("Refresh: 3;url=$page");
?>
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="dropdown">
                    <h1>Success!</h1>
                    <p>You will be automatically redirected in 3 seconds...</p>
                    <div class = "butspan" style = "width: 300px;">
                        <button type="button" class="btn btn-primary btn-block" style = "margin-right: 50px;" onclick="location.href='user_settings.php';">Continue</button>
                    </div>
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
</body>
</html>
