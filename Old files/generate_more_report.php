<?php
    $title = "IDCP - Generate Another Report";
    require('includes/header.php');
    if(!isset($_SESSION['searchString'])){
        $_SESSION['searchString'] = "";
    }
    $searchString = $_SESSION['searchString'];
    # Connect to MySQL server and the database
    require( 'includes/connect_db_c9.php' ) ;
    # Includes these helper functions
    require( 'includes/student_helpers.php' ) ;
    //After user submits, set session's search string to what user typed in.
    if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
        #Deprecated
        // $stu_id = $_POST['stu_id'];
        // loadSearch('student_profile.php', $stu_id);
        $_SESSION['searchString'] = $_POST['searchString'];
        $page = 'student_search.php';
        session_write_close();
        header("Location: $page");
    }
?>

<style>
.button {
    background-color: darkred;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
}
</style>
<style> 
input[type=text] {
    width: 130px;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
    background-color: white;
    background-image: url('searchicon.png');
    background-position: 10px 10px; 
    background-repeat: no-repeat;
    padding: 12px 20px 12px 40px;
    -webkit-transition: width 0.4s ease-in-out;
    transition: width 0.4s ease-in-out;
}

input[type=text]:focus {
    width: 25%;
}
</style>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
            <!--<div class="container" style="padding-right: 100px; max-width: 1100px;">-->
                <div class="dropdown">
                    <div class="page-header">
                        <h1>Search Students<small> Click on a student to view more</small><br></h1>
                    </div>
                    <font size="3">Search a Name or ID: &nbsp;&nbsp;</font>
                    <form method="POST" action="student_search.php">
                        <input type="text" name="searchString" value ="<?php echo $searchString; ?>" placeholder="Search.."/>
                        <br>
                        <!--<input type="submit" class="button">-->
                        <br>
                        <div class = "butspan" style = "width: 200px;">
                            <button type="submit" class="btn btn-primary btn-block" style="height: 50px;">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        <!-- /#page-content-wrapper -->
        </div>
		    
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!--Makes rows clickable-->
    <script>
        $('.table > tbody > tr').click(function() {
            //Puts CRS_ID into session
            var value = $(this).find('td:first').text(); //first column in table
            // Send Ajax request to backend.php, with value set as "CRS_ID" in the POST data
            $.post("/backendstu.php", {"STU_ID": value});
            window.location.href = "student_profile.php";
        });
        
    </script>

</body>

</html>
