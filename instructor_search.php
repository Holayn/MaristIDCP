<!--Search page for instructors-->
<?php
    $title = "IDCP - Instructor Search";
    $page = 'idcp_settings';
        $page_name = 'search_ins';
    require('includes/header.php');
    if(!isset($_SESSION['searchString'])){
        $_SESSION['searchString'] = "";
    }
    $searchString = $_SESSION['searchString'];
    if(!isset($_SESSION['order'])){
        $order = "";
    }
    else{
        $order = $_SESSION['order'];
    }
    //Allows user to reset their search
    if(isset($_SESSION['reset'])){
        unset($_SESSION['reset']);
        unset($_SESSION['order']);
        $searchString = "";
        $_SESSION['searchString'] = "";
        $order = "";
    }
    # Connect to MySQL server and the database
    require( 'includes/connect_db_c9.php' ) ;
    # Includes these helper functions
    require( 'includes/instructor_helpers.php' ) ;
    if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
        $_SESSION['searchString'] = mysqli_real_escape_string($dbc, trim($_POST['searchString']));
        if($_POST['order'] != '--'){
            $_SESSION['order'] = $_POST['order'];
        }
        else{
            $order = "";
        }
        $page = 'instructor_search.php';
        session_write_close();
        header("Location: $page");
    }
    else{
        $_SESSION['searchString'] = "";
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
    width: 75%;
}
</style>
    <!-- Bread Crumbs -->
    <ol class = "breadcrumb">
        <li><a href = "home.php">Home</a></li>
        <li><a href = "idcp_settings.php">IDCP Settings</a></li>
        <li class = "active">Search Instructor</li>
    </ol>
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="dropdown">
                    <div class="page-header">
                        <?php 
                        if($user_role != "User")
                            echo "<h1>Search Instructors<small> Click on an Instructor to view more</small><br></h1>";
                        else 
                            echo "<h1>Search Instructor</h1>";
                        ?>
                    </div>
                    <font size="3">Search a Name: &nbsp;&nbsp;</font>
                    <form method="POST" action="instructor_search.php" class="form-horizontal" role="form">
                        <div class="form-group">
                            <div class="col-xs-3">
                                <input type="text" name="searchString" value ="<?php echo $searchString; ?>" placeholder="Search.."/>
                            </div>
                        </div>                            
                        <div class = "butspan" style = "width: 200px;">
                            <button type="submit" class="btn btn-primary btn-block" style="height: 50px;">Submit</button>
                            <button type="button" id='reset' class="btn btn-secondary btn-block">Reset</button>
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="col-xs-2">
                                Order By:
                                <select class="form-control" id="order" name="order">
                                    <option>--</option>
                                    <option <?php if ($order == 'Last Name') echo 'selected="selected"'; ?>>Last Name</option>
                                    <option <?php if ($order == 'First Name') echo 'selected="selected"'; ?>>First Name</option>
                                </select>
                            </div>
                        </div>
                    </form>
                    <h3>Instructors</h3>
                    <?php
                        show_instructor_results($dbc, $searchString, $order);
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
    <?php //if($user_role!="User"){ ?>
    <!--Makes rows clickable-->
    <script>
    jQuery(document).ready(function($) {
        $('.table > tbody > tr').click(function() {
            var lname = $(this).find('td:first').text();
            var fname = $(this).find('td:nth-child(2)').text();
            jQuery.ajax({
                url: 'backendinstructor.php',
                type: 'POST',
                data: {
                    'INS_LNAME': lname,
                    'INS_FNAME': fname
                },
                dataType : 'json',
                success: function(data, textStatus, xhr) {
                    window.location.href = "instructor_profile.php";
                    console.log(data);
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.log(textStatus.reponseText);
                window.location.href = "instructor_profile.php";
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
                    window.location.href = "instructor_search.php";
                    // alert('reset');
                    console.log(data); // do with data e.g success message
                },
                error: function(xhr, textStatus, errorThrown) {
                    // alert('reset');
                    console.log(textStatus.reponseText);
                window.location.href = "instructor_search.php";
                }
            });    
    
        });
    });
    </script>
    <script type="text/javascript">
    jQuery(function($){
        var order = $("#order").val();
        $("#order").change(function(){
            cntr = $("#order option:selected").val();
            $('form').submit();
        });
    });
    </script>
</body>
</html>
