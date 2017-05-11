<!--Program profile page-->
<?php 
    $title = "IDCP - Program Profile";
    $page = 'program';
    $page_name = 'prg';
    require('includes/header.php');
    require( 'includes/connect_db_c9.php' ) ;
    require( 'includes/program_helpers.php' ) ;
    $prg_id = get_prg_id($dbc, $_SESSION['PRG_NAME']);
    $_SESSION['PRG_ID'] = $prg_id;
    if(!isset($_SESSION['subSearchString'])){
        $_SESSION['subSearchString'] = "";
    }
    if(!isset($_SESSION['suborder'])){
        $_SESSION['suborder'] = "";
        $suborder = $_SESSION['suborder'];
    }
    else{
        $suborder = $_SESSION['suborder'];
    }
    $subSearchString = $_SESSION['subSearchString'];
    if(isset($_SESSION['reset'])){
        unset($_SESSION['reset']);
        $subSearchString = "";
        $_SESSION['subSearchString'] = "";
        unset($_SESSION['suborder']);
        $suborder = "";
    }
    if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
        $suborder = $_POST['suborder'];
        $_SESSION['suborder'] = $suborder;
        $_SESSION['subSearchString'] = mysqli_real_escape_string($dbc, trim($_POST['subSearchString']));
        $page = 'program_profile.php';
        header("Location: $page");
    }
?>
<style>
    .inline {
  display: inline;
}
.link-button {
  background: none;
  bsuborder: none;
}
.link-button:focus {
  outline: none;
}
.link-button:hover {
  outline: none;
}
.link-button:active {
  color:white;
}
</style>
<style> 
input[type=text] {
    width: 250px;
    height: 40px;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
    font-size: 14px;
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
    <!-- Bread Crumbs -->
    <ol class = "breadcrumb">
        <li><a href = "home.php">Home</a></li>
        <li><a href = "program.php">Program</a></li>
        <li><a href = "program_search.php">Program Search</a></li>
        <li class = "active">Program Profile</li>
    </ol>
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="page-header">
                    <h1>
                        <?php
                            echo get_prg_name($dbc, $prg_id);
                        ?>
                    </h1>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <h3 class="panel-title">Program Information</a></h3>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <p><label>Program Name:</label><br>
                                    <?php
                                      echo get_prg_name($dbc, $prg_id);
                                    ?>
                                    </p>
                                    <button class="btn btn-default btn-sm" style="<?php if($user_role=='User') echo 'display:none;';?>" onclick ="location.href='edit_program.php';">Edit</button>
                                </div>
                            </div>
                        </div>
                        
                        <!--Moved this button to the edit program page-->
                        <!--<button class="btn btn-danger btn-sm" style="<?php if($user_role=='User') echo 'display:none;';?>" onclick ="location.href='delete_program_confirm.php';">Delete Program</button>-->
                    </div>
                </div>
                <?php 
                    if ($user_role != "User")
                        echo "<h3>Enrolled Student(s)<small> Click on a student to edit</small><br></h3>";
                    else
                        echo "<h3>Enrolled Student(s)</h3><br>";
                ?>
                <hr>
                <form method="POST" action="program_profile.php" class="form-horizontal" role="form">
                    <input type="text" name="subSearchString" value ="<?php echo $subSearchString; ?>" placeholder="Search student in program..."/>
                    <br><br>
                    <div class = "butspan" style = "width: 150px;">
                        <button type="submit" class="btn btn-primary btn-block" style="height: 40px;">Submit</button>
                        <button type="button" id='reset' class="btn btn-secondary btn-block">Reset</button>
                    </div>
                    <br>
                    <div class="form-group">
                        <div class="col-xs-2">
                            Order By:
                            <select class="form-control" id="suborder" name="suborder">
                                <option disabled selected value>--</option>
                                <option <?php if ($suborder == 'ID') echo 'selected="selected"'; ?>>ID</option>
                                <option <?php if ($suborder == 'Last Name') echo 'selected="selected"'; ?>>Last Name</option>
                                <option <?php if ($suborder == 'First Name') echo 'selected="selected"'; ?>>First Name</option>
                                <option <?php if ($suborder == 'Enroll Date') echo 'selected="selected"'; ?>>Enroll Date</option>
                            </select>
                        </div>
                    </div>
                </form>
                <div id="field_display" class="span3" style="height: 200px; overflow: auto;">
                    <?php
                        show_students_in_program($dbc, $prg_id, $suborder, $subSearchString);
                    ?>
                </div>
                <button class="btn btn-default btn-sm" onclick ="location.href='program_search.php';">Back to Search</button>
            <!-- /#container close -->
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
            jQuery.ajax({
                url: 'backendstu.php',
                type: 'POST',
                data: {
                    'STU_ID': value,
                },
                dataType : 'json',
                success: function(data, textStatus, xhr) {
                    window.location.href = "edit_student_program_home.php";
                    console.log(data); // do with data e.g success message
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.log(textStatus.reponseText);
                window.location.href = "edit_student_program_home.php";
                }
            });
        });
    });
    </script>
    <?php } ?>
    <script type="text/javascript">
    jQuery(function($){
        var suborder = $("#suborder").val();
        $("#suborder").change(function(){
            cntr = $("#suborder option:selected").val();
            $('form').submit();
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
                    window.location.href = "program_profile.php";
                    // alert('reset');
                    console.log(data); // do with data e.g success message
                },
                error: function(xhr, textStatus, errorThrown) {
                    // alert('reset');
                    console.log(textStatus.reponseText);
                window.location.href = "program_profile.php";
                }
            });    
    
        });
    });
    </script>
</body>
</html>
