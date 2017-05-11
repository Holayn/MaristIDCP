<?php
session_start();
$_SESSION['PRG_ID'] = $_POST['PRG_ID'];
$_SESSION['PRG_NAME'] = $_POST['PRG_NAME'];
$_SESSION['PRG_ENROLL_START'] = $_POST['PRG_ENROLL_START'];
//Close any existing db connections
mysqli_close( $dbc ) ;
?>