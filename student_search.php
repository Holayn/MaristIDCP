<!--Student search page-->
<?php
    $title = "IDCP - Student Search";
    $page = 'student';
    $page_name = 'search_stu';
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
    require( 'includes/student_helpers.php' ) ;
    //After user submits, set session's search string to what user typed in.
    if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
        $_SESSION['searchString'] = mysqli_real_escape_string($dbc, trim($_POST['searchString']));
        if($_POST['order'] != '--'){
            $_SESSION['order'] = $_POST['order'];
        }
        else{
            $order = "";
        }
        $page = 'student_search.php';
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
    background-image: url('searchicon.png');
    background-position: 10px 10px; 
    background-repeat: no-repeat;
    padding: 12px 20px 12px 40px;
    -webkit-transition: width 0.4s ease-in-out;
    transition: width 0.4s ease-in-out;
}
input[type=text]:focus {
    width: 125%;
}
</style>
    <!-- Bread Crumbs -->
    <ol class = "breadcrumb">
    <li><a href = "home.php">Home</a></li>
    <li><a href = "student.php">Student</a></li>
    <li class = "active">Student Search</li>
    </ol>
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="dropdown">
                    <div class="page-header">
                        <h1>Search Students<small> Click on a student to view more</small><br></h1>
                    </div>
                    <font size="3">Search a Name or ID: &nbsp;&nbsp;</font>
                    <form method="POST" action="student_search.php" class="form-horizontal" role="form">
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
                                    <option <?php if ($order == 'First Name') echo 'selected="selected"'; ?>>First Name</option>
                                    <option <?php if ($order == 'Last Name') echo 'selected="selected"'; ?>>Last Name</option>
                                </select>
                            </div>
                        </div>
                    </form>
                    <h3>Students</h3>
                    <?php
                        show_brief_students_results($dbc, $searchString, $order);
                    ?>
                    <br>
                    <button class="btn btn-default btn-sm" onclick ="location.href='student.php';">Back to Student Home</button>
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
    <!--Makes rows clickable-->
    <script>
    jQuery(document).ready(function($) {
        $('.table > tbody > tr').click(function() {
            var value = $(this).find('td:first').text();
            jQuery.ajax({
                url: 'backendstu.php',
                type: 'POST',
                data: {
                    'STU_ID': value,
                },
                dataType : 'json',
                success: function(data, textStatus, xhr) {
                    window.location.href = "student_profile.php";
                    console.log(data); // do with data e.g success message
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.log(textStatus.reponseText);
                window.location.href = "student_profile.php";
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
                    window.location.href = "student_search.php";
                    // alert('reset');
                    console.log(data); // do with data e.g success message
                },
                error: function(xhr, textStatus, errorThrown) {
                    // alert('reset');
                    console.log(textStatus.reponseText);
                window.location.href = "student_search.php";
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
