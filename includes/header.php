<!DOCTYPE html>
<html lang="en">
<?php
    ob_start();
    session_start();
    $user_id = $_SESSION['user_id'];
    $user_role = $_SESSION['user_role'];
    $order = "";
    if(!isset($user_id)){
     $page = 'index.php';
     header("Location: $page");
     exit();
    }
    //Taken from GraphicNarrative
    function checkForIdleSession() {
        $time = $_SERVER['REQUEST_TIME'];
        /**
         * for a 30 minute timeout, specified in seconds
         */
        $timeout_duration = 1800;
        // $timeout_duration = 5;
        /**
         * if last activity longer than timeout, reset session
         */
        if (isset($_SESSION['LAST_ACTIVITY']) && ($time - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
            session_unset();
            session_destroy();
            session_start();
        }
        $_SESSION['LAST_ACTIVITY'] = $time;
    }
    checkForIdleSession();
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo $title ?></title>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link href="css/banner.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="css/to-top.css" rel="stylesheet">
    <link rel="shortcut icon" href="https://my.marist.edu/myMarist62-theme/images/favicon.ico"/>
</head>
<body>
    <img src='placeholder.png' style="visibility: hidden;" id="banner">
	<!--Navigation Bars-->
    <div id="wrapper">
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
                <a class="navbar-brand" href="home.php">Home</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li <?php if ($page == 'help') echo 'style="background-color: black"'; ?>>
                    <a href="help_page.php<?php if (isset($page_name)) echo "#$page_name";?>"><i class="glyphicon glyphicon-question-sign"></i> Help</a>
                </li>
                <li class="dropdown" <?php if ($page == 'user_settings' || $page == 'idcp_settings' || $page == 'report_bug') echo 'style="background-color: black"'; ?>>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> 
                        <?php 
                        echo $user_id; 
                        ?> 
                        <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li <?php if ($page == 'user_settings') echo 'class="active"'?>>
                            <a href="user_settings.php"><i class="fa fa-fw fa-user"></i> User Settings</a>
                        </li>
                        <li <?php if ($page == 'idcp_settings') echo 'class="active"'?>>
                            <a href="idcp_settings.php"><i class="fa fa-fw fa-gear"></i> IDCP Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li <?php if ($page == 'report_bug') echo 'class="active"'?>>
                            <a href="report_bug.php"><i class="fa fa-fw fa-wrench"></i> Report a Bug</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="user_logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav" style="margin-top:7%;">
                    <li <?php if ($page == 'student') echo 'class="active"'?>>
                        <a href="student.php">Students</a>
                    </li>
                    <li <?php if ($page == 'program') echo 'class="active"'?>>
                        <a href="program.php">Programs</a>
                    </li>
                    <li <?php if ($page == 'course') echo 'class="active"'?>>
                        <a href="course.php">Courses</a>
                    </li>
                    <li <?php if ($page == 'certificate') echo 'class="active"'?>>
                        <a href="certificate.php">Certificates</a>
                    </li>
                    <li class="divider"></li>
                    <li <?php if ($page == 'report') echo 'class="active"'?>>
                        <a href="generate_report.php">Generate a Report</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>