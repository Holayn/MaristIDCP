<?php
session_start();
$_SESSION['INS_LNAME'] = $_POST['INS_LNAME'];
$_SESSION['INS_FNAME'] = $_POST['INS_FNAME'];
//Close any existing db connections
mysqli_close( $dbc ) ;
?>