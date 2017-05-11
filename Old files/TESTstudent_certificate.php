
        <!-- Page Content -->
        <?php
        $title = "IDCP - Certificate";
        $page = 'student';
        require('includes/header.php');
        # Connect to MySQL server and the database
        require( 'includes/connect_db.php' ) ;
        # Includes these helper functions
        require( 'includes/report_helpers.php' ) ;
        # Close the connection
        mysqli_close( $dbc ) ;
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
        <div id="page-content-wrapper">
            <div class="container-fluid">
            <!--<div class="container" style="padding-right: 100px; max-width: 1100px;">-->
            <!--<div class="container-fluid">-->
                <div class="col-lg-6">
                        <h2>Certificates</h2>
                        <div class="form-group">
                                <form action="student_certificate.php" method="POST">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="check_list[]" value=",earn_yr">Date Earned
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="check_list[]" value=",mail_yr">Date Mailed
                                    </label>
                                    <input type="submit" name="submit1" class="submit1"/>
                                </form>
                        </div>
                        <div class="table-responsive">
                            <div id="printableArea">
                                <div class="example-print">
                                    <img src="footer_logo.png">
                                    <h2>Lilly White</h2>
                                </div>
                                <table class="table table-hover table-striped">
                                    <?php
                                        require('includes/connect_db_c9.php');
                            			//require('includes/report_helpers.php');
                            			$strfield = " ";
                            			if(!empty($_POST['check_list'])){
                            			    foreach($_POST['check_list'] as $check){
                            			        $strfield = "".$strfield."".$check." ";
                            			    }
                            			}
                            				$statement = 'SELECT CERT_NAME' .$strfield.'FROM CERTIFICATE, CERT_EARNED WHERE CERTIFICATE.CERT_ID=CERT_EARNED.CERT_ID AND STU_ID=20034567';
                            				echo $statement;
                                        show_basic_report($dbc,$statement);
                                    ?>
                                </table>
                            </div>
                            <button type="button" class="btn btn-default" onclick="printDiv('printableArea')">Print</button>
                        </div>
                    </div>
            <!-- /#container close -->
            </div>
        <!-- /#page-content-wrapper -->
        </div>
		    
    </div>
    <!-- /#wrapper -->

    <!--<script src="//cdnjs.buttflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>-->
    
    <script src="js/printhelper.js"></script>
    
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
