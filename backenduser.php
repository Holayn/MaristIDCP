<?php
session_start();
$_SESSION['OTHER_USER_ID'] = $_POST['USER_ID'];
//Close any existing db connections
mysqli_close( $dbc ) ;
?>