<!--Home page for generating a report. User makes choice here what report to use-->
<?php
    $title = "IDCP - Generate a Report";
    $page = 'report';
    $page_name ='rpt';
    require('includes/header.php');
    require( 'includes/report_helpers.php' );
?>
<style>
    .example-print {
        display: none;
    }
    @media print {
       .example-screen {
           display: none;
        }
        .example-print {
           display: block;
        }
    }
</style>
    <!-- Bread Crumbs -->
    <ol class = "breadcrumb">
        <li><a href = "home.php">Home</a></li>
        <li class = "active">Generate a Report</li>
    </ol>
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="page-header">
                    <h1>Generate a Report</h1>
                </div>
                <div class = "butspan" style = "width: 300px;">
                    <button type="button" class="btn btn-primary btn-block" style="margin-right: 50px; height: 50px; width: 300px;" onclick ="location.href='report_student.php';">Report on Student Demographics</button>
                    <button type="button" class="btn btn-primary btn-block" style="margin-right: 50px; height: 50px; width: 300px;" onclick ="location.href='report_student_in.php';">Report on Student in...</button>
                    <hr>
                    <button type="button" class="btn btn-primary btn-block" style="margin-right: 50px; height: 50px; width: 300px;" onclick ="location.href='report_specific.php';">Specific Queries</button>
                    <br>
                </div>
                <button class="btn btn-default btn-sm" type="button" onclick="location.href='home.php';">Back to Home</button>
            </div>
            <!-- /#container close -->
		</div>
        <!-- /#page-content-wrapper -->
		<!--Footer-->
        <?php require('includes/footer.php'); ?>
    </div>
    <!-- /#wrapper -->
	<script src="js/printhelper.js"></script>
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
