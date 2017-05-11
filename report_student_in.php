<!--Report page for generating a report about students in a specific restriction-->
<?php
    $title = "IDCP - Generate a Report about Students in...";
    $page = 'report';
    $page_name = 'in_rpt';
    require('includes/header.php');
    require( 'includes/report_helpers.php' ) ;
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
        $entity = "";
        $ent_name = "";
    	$where = "";
    	$spec = "";
    	$clause = "";
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $entity = strtoupper($_POST['entity']);
        $ent_name = $_POST['ent_name'];
    	$where = $_POST['where'];
    	$spec = $_POST['spec'];
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
    <li class = "active">About Student In</li>
</ol>
<!-- populate the more fields after entity is selected-->
<script>
    function showField(str) {
      if (str=="") {
        document.getElementById("ent_name_display").innerHTML="";
        return;
      } 
      if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
      } else { // code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
      xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
          document.getElementById("ent_name_display").innerHTML=this.responseText;
        }
      }
      xmlhttp.open("GET","backendrptname.php?p="+str,true);
      xmlhttp.send();
    }
</script>
<!-- Page Content -->
<div id="page-content-wrapper">
    <div class="container" style="padding-right: 100px; max-width: 1100px;">
        <div class="dropdown">
            <div class="page-header">
                <h1>Generate a Report about Students</h1>
            </div>
            <br>
            <form action="report_student_in.php" method="POST" class="form-horizontal" role="form" data-toggle="validator">
                <div class="form-group">
                    <label class="col-xs-3 control-label">In:*</label>
                    <div class="col-xs-3">
                        <select class="form-control" id="entity1" name="entity" onchange="showField(this.value)" data-error="Please choose a field" required>
                            <option disabled selected value>-- select an option --</option>
            				<option value="certificate">Certificate</option>
            				<option value="course">Course</option>
            				<option value="employer">Employer</option>
            				<option value="program">Program</option>
                        </select>
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
                <div id="ent_name_display">
                    <!--more input fields pop-up here after selecting entity-->
                </div>
                <div class="form-group">
                    <div class="col-xs-5 col-xs-offset-3">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </div>
            </form>
        </div>
                    <?php    	
                        if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
                            if(!empty($_SESSION['sel'])){
                                require('includes/connect_db_c9.php');
                                $sel = $_SESSION['sel'];
                                $statement = "SELECT DISTINCT * FROM (". $_SESSION['query']. ") AS NEW WHERE STU_ID IN (SELECT STU_ID FROM $sel)";
                                show_complex_report($dbc,$statement);
                                unset($_SESSION['sel']);
                            }
                            else{
                                require('includes/connect_db_c9.php');
                                show_basic_report($dbc, $entity, $ent_name, $where, $spec);
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
                        <form id="more_query_form" action="includes/modal_helper.php" method="POST">
                            <label>Have completed a:*</label>
                                <select class="form-control" id="sel1" name="sel">
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
    <!-- /#container close -->
</div>
<!--Footer-->
<?php require('includes/footer.php'); ?>
<!-- /#page-content-wrapper -->
</div>
<!-- /#wrapper -->
    <!-- export -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
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
    jQuery(document).ready(function() {
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