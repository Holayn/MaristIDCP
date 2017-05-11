<?php
    /*// A simple PHP script demonstrating how to connect to MySQL.
    // Press the 'Run' button on the top to start the web server,
    // then click the URL that is emitted to the Output tab of the console.

    //$servername = getenv('10.10.7.88');
    //$username = getenv('Ni');
    //$password = "student";
    //$database = "IDCP";
    //$dbport = 3306;

    // Create connection
    // $dbc = @mysqli('10.10.7.88', 'Ni', 'student', 'IDCP');
    $dbc = @mysqli('localhost', 'root', '', 'idcp');

    // Check connection
    if ($dbc->connect_error) {
        die("Connection failed: " . $dbc->connect_error);
    } 
    echo "Connected successfully (".$dbc->host_info.")";*/
?>

<?php 

# CONNECT TO MySQL DATABASE.


# Connect  on 'localhost' for user 'mike' with password 'easysteps' to database 'site_db'.

# Otherwise fail gracefully and explain the error. 
$dbc = @mysqli_connect ( 'localhost', 'root', '', 'idcp' )


OR die ( mysqli_connect_error() ) ;


# Set encoding to match PHP script encoding.

mysqli_set_charset( $dbc, 'utf8' ) ;
?>