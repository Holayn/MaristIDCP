<!--Report page for generating a report about student demographics-->
<?php
    $title = "IDCP - Generate a Report about Student Demographics";
    $page = 'report';
    $page_name = 'demo_rpt';
    require('includes/header.php');
    require( 'includes/report_helpers.php' ) ;
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    	$demographic = "";
    	$spec = "";
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
    	require('includes/connect_db_c9.php');
    	$demographic = $_POST['demographic'];
    	$spec = mysqli_real_escape_string($dbc, trim($_POST['spec']));
    }
?>
<!--style for printing-->
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
    <li class = "active">About Student Demographic</li>
</ol>
    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container" style="padding-right: 100px; max-width: 1100px;">
            <div class="dropdown">
                <div class="page-header">
                    <h1>Generate a Report about Student Demographics</h1>
                </div>
                <br>
                <form action="report_student.php" method="POST" class="form-horizontal" role="form" data-toggle="validator">
                    <div class="form-group">
                        <label class="col-xs-3 control-label">Demographic:*</label>
                        <div class="col-xs-3">
                                <select class="form-control" id="demographic1" name="demographic" value="<?php if (isset($_POST['demographic'])) echo $_POST['demographic'];?>" data-error="Please choose a filter" required>
                                    <option disabled selected value>-- select an option --</option>
                                    <?php
                                        populate_demographic($dbc)
                                    ?>
                                </select>
                        </div>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label">Specifically:*</label>
                        <div class="col-xs-3">
                            <input type="text" class="form-control" name="spec" data-error="Please enter the specification" required>
                        </div>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-5 col-xs-offset-3">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-12">
                        <?php    	
                            if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
                                if(!empty($_SESSION['sel'])){
                                    $sel = $_SESSION['sel'];
                                    $statement = "SELECT DISTINCT * FROM (". $_SESSION['query']. ") AS NEW WHERE STU_ID IN (SELECT STU_ID FROM $sel)";
                                    show_complex_report($dbc,$statement);
                                    unset($_SESSION['sel']);
                                }
                                else{
                                    show_demographic_report($dbc, $demographic, $spec);
                                    unset($_SESSION['sel']);
                                }
                            }
                        ?>
                <br>
                    <?php
                        if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
                            echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#more_query" style="margin-right: 50px; height: 50px; width: 300px;">How many of these students...</button>';
                            echo '<button type="button" class="btn btn-primary" style="margin-right: 50px; height: 50px; width: 200px;" onclick="printDiv(\'printableArea\')"><i class="glyphicon glyphicon-print"></i> Print</button>';
                            echo '<a href="#" id="export" role="button" class="btn btn-primary" style="margin-right: 50px; padding-top: 15px; height: 50px; width: 300px;"><i class="glyphicon glyphicon-download-alt"></i> Export to Excel (.csv) </a>';

                        }
                    ?>
                <br>
                <br>
                <button class="btn btn-default btn-sm" onclick ="location.href='generate_report.php';">Back to Report Home</button>
            </div>
            <!-- modal dialog for more queries -->
            <div class="modal fade" id="more_query" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">How many of these students...</h4>
                        </div>
                        <div class="modal-body">
                            <form id="more_query_form" action="includes/modal_helper.php" method="POST" role="form" data-toggle="validator">
                                <label>Have completed a:*</label>
                                    <select class="form-control" id="sel1" name="sel" data-error="Please choose a filter" required>
                        				<option value="program">Program</option>
                        				<option value="course">Course</option>
                        				<option value="certificate">Certificate</option>
                                    </select>
                                <div class="help-block with-errors"></div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" id="submitForm" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end of modal -->
        </div>
        <!--Footer-->
        <?php require('includes/footer.php'); ?>
        <!-- /#container close -->
    </div>
    <!-- /#page-content-wrapper -->
</div>
<!-- /#wrapper -->
    <!-- export -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>
        jQuery(document).ready(function() {
        function exportTableToCSV($table, filename) {
            var $rows = $table.find('tr:has(td),tr:has(th)'),
                // Temporary delimiter characters unlikely to be typed by keyboard
                // This is to avoid accidentally splitting the actual contents
                tmpColDelim = String.fromCharCode(11), // vertical tab character
                tmpRowDelim = String.fromCharCode(0), // null character
                // actual delimiter characters for CSV format
                colDelim = '","',
                rowDelim = '"\r\n"',
                // Grab text from table into CSV formatted string
                csv = '"' + $rows.map(function (i, row) {
                    var $row = $(row), $cols = $row.find('td,th');
                    return $cols.map(function (j, col) {
                        var $col = $(col), text = $col.text();
                        return text.replace(/"/g, '""'); // escape double quotes
                    }).get().join(tmpColDelim);
                }).get().join(tmpRowDelim)
                    .split(tmpRowDelim).join(rowDelim)
                    .split(tmpColDelim).join(colDelim) + '"',
                // Data URI
                csvData = 'data:application/csv;charset=utf-8,' + encodeURIComponent(csv);
                console.log(csv);
                if (window.navigator.msSaveBlob) { // IE 10+
                    //alert('IE' + csv);
                    window.navigator.msSaveOrOpenBlob(new Blob([csv], {type: "text/plain;charset=utf-8;"}), "csvname.csv")
                } 
                else {
                    $(this).attr({ 'download': filename, 'href': csvData, 'target': '_blank' }); 
                }
        }
            // This must be a hyperlink
            $("#export").on('click', function (event) {
                exportTableToCSV.apply(this, [$('#report'), 'IDCP_Report.csv']);
                // IF CSV, don't do event.preventDefault() or return false
                // We actually need this to be a typical hyperlink
            });
        });
    </script>
    <!-- Modal -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>
    /* must apply only after HTML has loaded */
    $(document).ready(function () {
        $("#more_query_form").on("submit", function(e) {
            var postData = $(this).serializeArray();
            var formURL = $(this).attr("action");
            $.ajax({
                url: formURL,
                type: "POST",
                data: postData,
                success: function() {
                    window.location.reload();
                    $("#submitForm").remove();
                },
                error: function() {
                    console.log(status + ": " + error);
                }
            });
            e.preventDefault();
        });
         
        $("#submitForm").on('click', function() {
            $("#more_query_form").submit();
        });
    });
    </script>
    <!-- Printing -->
	<script src="js/printhelper.js"></script>
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Validator Bootstrap Plugin-->
    <script src="js/validator.js"></script>
</body>
</html>
