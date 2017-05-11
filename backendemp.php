<?php
session_start();
$_SESSION['EMP_NAME'] = $_POST['EMP_NAME'];
//Close any existing db connections
mysqli_close( $dbc ) ;
?>