<?php
    $title = "IDCP - Add Student Error";
    $page = 'student';
    require('includes/header.php');
?>
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
            <!--<div class="container" style="padding-right: 100px; max-width: 1100px;">-->
                <div class="dropdown">
                    <div class="page-header">
                        <h1>You entered a duplicate student ID or tag. Please try again.</h1>
                    </div>
                    <div class = "butspan" style = "width: 300px;">
                        <button type="button" class="btn btn-primary btn-block" style = "margin-right: 50px;" onclick="history.go(-1);">Back</button>
                    </div>
                </div>
            </div>
        <!-- /#page-content-wrapper -->
        </div>
		    
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
