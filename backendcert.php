<?php
session_start();
$_SESSION['CERT_NAME'] = $_POST['CERT_NAME'];
$_SESSION['EARN_DATE'] = $_POST['EARN_DATE'];
$_SESSION['MAIL_DATE'] = $_POST['MAIL_DATE'];

//Close any existing db connections
mysqli_close( $dbc ) ;
?>