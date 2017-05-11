<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>IDCP</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <!--<link href="css/simple-sidebar.css" rel="stylesheet">-->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link href="css/banner.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
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
    
</head>

<body>
    <img src='placeholder.png' style="visibility: hidden;" id="banner">
	<!--Navigation Bars-->
    <div id="wrapper">
        <!--<img src="IDCPorig.png" id="banner">-->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <img src="IDCPlogo.PNG" id="banner">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Home</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> John Smith <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="user_settings.php"><i class="fa fa-fw fa-user"></i> User Settings</a>
                        </li>
                        <li>
                            <a href="idcp_settings.php"><i class="fa fa-fw fa-gear"></i> IDCP Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
        <!--</div>-->
        <!--<div id="wrapper">-->
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
             <!--top: 145px;-->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav" style="margin-top:7%;">
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#zOS"> z/OS <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="zOS" class="collapse">
                            <li>
                                <a href="student.php">Students</a>
                            </li>
                            <li>
                                <a href="course.php">Courses</a>
                            </li>
                            <li>
                                <a href="generate_report.php">Report</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#dataCenter"> Data Center <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="dataCenter" class="collapse">
                            <li>
                                <a href="#">Students</a>
                            </li>
                            <li>
                                <a href="#">Courses</a>
                            </li>
                            <li>
                                <a href="#">Report</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
        <!-- Page Content -->
        <?php
        # Connect to MySQL server and the database
        require( 'includes/connect_db.php' ) ;
        # Includes these helper functions
        require( 'includes/report_helpers.php' ) ;
        require('includes/student_helpers.php');
	    $stu_id = $_SESSION['stu_id'];
        # Close the connection
        mysqli_close( $dbc ) ;
        ?>
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="col-lg-6">
                        <h2>Courses</h2>
                        <div class="form-group">
                                <form action="student_course.php" method="POST">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="check_list[]" value=",crs_enroll_status">Status
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="check_list[]" value=",crs_enroll_yr_start">Date Enrolled
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="check_list[]" value=",crs_enroll_yr_end">Date Completed
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="check_list[]" value=",grade">Grade
                                    </label>
                                    <input type="submit" name="submit1" class="submit1"/>
                                </form>
                        </div>
                        <div class="table-responsive">
                            <div id="printableArea">
                                <div class="example-print">
                                    <img src="footer_logo.png">
                                    <h2><?php
                                    get_stu_name($dbc, $stu_id)
                                    ?>
                                    </h2>
                                </div>
                                <table class="table table-hover table-striped">
                                    <?php
                                        require('includes/connect_db_c9.php');
                            			$strfield = " ";
                            			if(!empty($_POST['check_list'])){
                            			    foreach($_POST['check_list'] as $check){
                            			        $strfield = "".$strfield."".$check." ";
                            			    }
                            			}
                            				$statement = 'SELECT CRS_NAME' .$strfield.'FROM CRS_ENROLLED, COURSE WHERE CRS_ENROLLED.CRS_ID=COURSE.CRS_ID AND STU_ID='. $stu_id;
                            				echo $statement;
                                        show_basic_report($dbc,$statement);
                                    ?>
                                </table>
                            </div>
                            <button type="button" class="btn btn-default" onclick="printDiv('printableArea')">Print</button>
                        </div>                    
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

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>

</body>

</html>
