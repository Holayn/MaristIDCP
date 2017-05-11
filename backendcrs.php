<?php
session_start();
$_SESSION['CRS_ID'] = $_POST['CRS_ID'];
$_SESSION['CRS_ENROLL_START'] = $_POST['CRS_ENROLL_START'];
//Close any existing db connections
mysqli_close( $dbc ) ;
?>