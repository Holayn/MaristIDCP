<!--Employer search page-->
<?php
    $title = "IDCP - Employer Search";
    $page = 'idcp_settings';
    $page_name = 'search_emp';
    require('includes/header.php');
    if(!isset($_SESSION['searchString'])){
        $_SESSION['searchString'] = "";
    }
    $searchString = $_SESSION['searchString'];
    //Allows user to reset their search
    if(isset($_SESSION['reset'])){
        unset($_SESSION['reset']);
        $searchString = "";
        $_SESSION['searchString'] = "";
    }
    # Connect to MySQL server and the database
    require( 'includes/connect_db_c9.php' ) ;
    # Includes these helper functions
    require( 'includes/employer_helpers.php' ) ;
    if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
        $_SESSION['searchString'] = mysqli_real_escape_string($dbc, trim($_POST['searchString']));
        $page = 'employer_search.php';
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
    <!-- Bread Crumbs -->
    <ol class = "breadcrumb">
        <li><a href = "home.php">Home</a></li>
        <li><a href = "idcp_settings.php">IDCP Settings</a></li>
        <li class = "active">Search Employer</li>
    </ol>
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="dropdown">
                    <div class="page-header">
                        <?php 
                            if($user_role != "User")
                                echo "<h1>Search Employers<small> Click on an Employer to edit</small><br></h1>";
                            else 
                                echo "<h1>Search Employers</h1>";
                        ?>
                    </div>
                    <font size="3">Search a Name: &nbsp;&nbsp;</font>
                    <form method="POST" action="employer_search.php">
                        <input type="text" name="searchString" value ="<?php echo $searchString; ?>" placeholder="Search.."/>
                        <br>
                        <br>
                        <div class = "butspan" style = "width: 200px;">
                            <button type="submit" class="btn btn-primary btn-block" style="height: 50px;">Submit</button>
                        </div>
                    </form>
                    <h3>Employers</h3>
                    <?php
                        show_employer_results($dbc, $searchString);
                    ?>
                    <br>
                    <button class="btn btn-default btn-sm" onclick ="location.href='idcp_settings.php';">Back to Settings</button>
                </div>
            </div>
        <!-- /#page-content-wrapper -->
        </div>
        <!--Footer-->
        <?php require('includes/footer.php'); ?>
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <?php if($user_role != "User"){ ?>
    <!--Makes rows clickable-->
    <script>
    jQuery(document).ready(function($) {
        $('.table > tbody > tr').click(function() {
            var value = $(this).find('td:first').text();
            console.log(value);
            jQuery.ajax({
                url: 'backendemp.php',
                type: 'POST',
                data: {
                    'EMP_NAME': value
                },
                dataType : 'json',
                success: function(data, textStatus, xhr) {
                    window.location.href = "edit_employer.php";
                    console.log(data);
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.log(textStatus.reponseText);
                window.location.href = "edit_employer.php";
                }
            });
        });
    });
    </script>
    <!--Resets the search and sort-->
    <script>
    jQuery(document).ready(function($) {
        $('#reset').click(function() {
            jQuery.ajax({
                 url: 'reset.php',
                type: 'POST',
                data: {
                    'reset': "reset",
                },
                dataType : 'json',
                success: function(data, textStatus, xhr) {
                    window.location.href = "employer_search.php";
                    // alert('reset');
                    console.log(data); // do with data e.g success message
                },
                error: function(xhr, textStatus, errorThrown) {
                    // alert('reset');
                    console.log(textStatus.reponseText);
                window.location.href = "employer_search.php";
                }
            });    
    
        });
    });
    </script>
    <?php } ?>
</body>
</html>