<!--Initial landing page for IDCP. User has to login-->
<!DOCTYPE html>
<html lang="en">
<?php
        # Connect to MySQL server and the database
        require( 'includes/connect_db_c9.php' ) ;
        $invalid = false;
        $logout = false;
        
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                $user_id = "";
                $user_pwd = "";
            if (isset($_GET['logout'])) {
                $logout = true;
            }
        }
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if(isset($_POST['user_id']) and isset($_POST['user_pwd']) ) {
                $user_id = $_POST['user_id'];
                $user_pwd = SHA1($_POST['user_pwd']);
                $query = "SELECT * FROM IDCP_USER WHERE USER_ID='".$user_id."' AND USER_PWD='".$user_pwd."'";
                $result = mysqli_query($dbc,$query);
                if(mysqli_num_rows( $result ) != 0 ){
                    session_start();
                    $userData = mysqli_fetch_array($result, MYSQLI_ASSOC) ; #stores data as array w/ column names as index
                    $_SESSION['user_id'] = $userData['USER_ID'];
                    $_SESSION['user_role'] = $userData['USER_ROLE'];
            		$page = 'home.php?login=true';
                    header("Location: $page");
                } else {
                    $invalid = true;
                }
            }    
        }

?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>IDCP - Login</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <!--<link href="css/simple-sidebar.css" rel="stylesheet">-->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link href="css/banner.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="https://my.marist.edu/myMarist62-theme/images/favicon.ico"/>

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
                <a class="navbar-brand"></a>
            </div>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav" style="margin-top:7%;">
                    <li> 
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
        
        <?php
            if($invalid){
        ?>
                <div class="alert alert-danger alert-dismissible" role="alert" style="margin-top: 20px">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Error!</strong> Incorrect username or password
                </div>
        <?php
            }
            else if($logout){?>
                <div class="alert alert-success alert-dismissible" role="alert" style="margin-top: 20px">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Goodbye!</strong> You have successfully logged out
                </div>
                <?php
            }
        ?>
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="dropdown">
                    <!--    <div class="alert alert-danger alert-dismissible" role="alert" style="margin-top: 20px; display='none'">-->
                    <!--    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
                    <!--    <strong>Error</strong> Wrong username or password-->
                    <!--</div>-->
                    <div class="page-header">
                        <h1> Welcome, Please Login to continue </h1>
                    </div>
                    <form action="index.php" method="POST" class="form-horizontal" data-toggle="validator" id="user_login">
                        <div class="form-group">
                            <label class="col-xs-3 control-label"></label>
                            <div class="col-xs-5">
                                <h3>User Login</h3>
                                <p id="ErrorMsg"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">ID*</label>
                            <div class="col-xs-2">
                                <input type="text" class="form-control" name="user_id" data-error="Please enter a user ID" required>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Password*</label>
                            <div class="col-xs-2">
                                <input type="password" class="form-control" name="user_pwd" data-error="Please enter a password" required>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-5 col-xs-offset-3">
                                <button type="submit" class="btn btn-default">Login</button>
                            </div>
                        </div>
                    </form>
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
    
    <!-- Validator Bootstrap Plugin-->
    <script src="js/validator.js"></script>

</body>

</html>
