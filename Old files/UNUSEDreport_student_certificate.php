<?php
    $title = "IDCP - Generate a Report about Student Certificates";
    $page = 'report';
    require('includes/header.php');
    require( 'includes/report_helpers.php' ) ;
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    	$where = "";
    	$spec = "";
    	$certificate = "";
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
    	$where = $_POST['where'];
    	$spec = $_POST['spec'];
    	$certificate = $_POST['certificate'];
    	$statement = 'SELECT STUDENT.STU_ID, STU_LNAME, STU_FNAME, STU_INITIAL FROM STUDENT, CERTIFICATE, CERT_EARNED WHERE CERT_EARNED.CERT_ID = CERTIFICATE.CERT_ID AND STUDENT.STU_ID = CERT_EARNED.STU_ID AND CERTIFICATE.CERT_NAME = "'.$certificate.'" AND '.$where.'= "'.$spec.'"';
    }
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
        <li><a href = "generate_report.php">Generate a Report</a></li>
        <li class = "active">About Student Certificate</li>
    </ol>
    
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container" style="padding-right: 100px; max-width: 1100px;">
                <div class="dropdown">
                    <div class="page-header">
                        <h1>Generate a Report about Student Certificates</h1>
                    </div>
                        <br>
                        <form action="report_student_certificate.php" method="POST" class="form-horizontal" role="form" data-toggle="validator">
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Certificate:*</label>
                            <div class="col-xs-2">
                                    <select class="form-control" id="demographic1" name="certificate" value="<?php if (isset($_POST['certificate'])) echo $_POST['certificate'];?>" data-error="Please choose a field" required>
                                        <option disabled selected value>---</option>
                                        <?php
                                            populate_certificate($dbc)
                                        ?>
                                    </select>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Where:*</label>
                            <div class="col-xs-2">
                                    <select class="form-control" id="demographic1" name="where" value="<?php if (isset($_POST['where'])) echo $_POST['where'];?>" data-error="Please choose a field" required>
                                        <option disabled selected value>---</option>
                                        <?php
                                            populate_certificate_where($dbc)
                                        ?>
                                    </select>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">=</label>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Specific:*</label>
                            <div class="col-xs-2">
                                <input type="text" class="form-control" name="spec" value="<?php if (isset($_POST['spec'])) echo $_POST['spec'];?>" data-error="Please enter the specification" required>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-5 col-xs-offset-3">
                                <button type="submit" class="btn btn-default">Submit</button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <div class="table-responsive">
                            <div id="printableArea">
                                <div class="example-print">
                                    <img src="footer_logo.png">
                                    <h2>Report</h2>
                                </div>
                                <table class="table table-hover table-striped">
                                    <?php    	
                                        if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
                                            show_basic_report($dbc, $statement);
                                        }
                                    ?>
                                </table>
                            </div>
                        <?php
                            if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
                                echo '<button type="button" class="btn btn-primary" style="margin-right: 50px; height: 50px; width: 300px;" onclick="printDiv(\'printableArea\')">Print</button>';
                            }
                        ?>
                        <!--<button type="button" class="btn btn-primary" style="margin-right: 50px; height: 50px; width: 300px;" onclick="printDiv('printableArea')">Print</button>-->
                    </div>   
                    </div>
                    <br>
                    <button class="btn btn-default btn-sm" onclick ="location.href='generate_report.php';">Back</button>
                </div>

            <!-- /#container close -->
            </div>
        <!-- /#page-content-wrapper -->
        </div>
		    
    </div>
    <!-- /#wrapper -->

	<script src="js/printhelper.js"></script>
    
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
