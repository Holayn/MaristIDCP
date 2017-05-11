<?php
session_start();
$_SESSION['STU_ID'] = $_POST['STU_ID'];
//Close any existing db connections
mysqli_close( $dbc ) ;
?>