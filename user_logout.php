<!--Executes when user presses the logout button-->
<?php
session_start();
session_destroy();
$page = 'index.php?logout=true';
header("Location: $page");
?>