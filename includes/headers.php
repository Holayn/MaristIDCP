//save to work on for later

<!DOCTYPE html>
<html>
<?php
    require( 'connect_db.php' );
    require_once ( 'helpers.php' );
    session_start();
    if (!isset($title)) {
        $title = "IDCP";
    }
?>
</html>
