<!--Shows more information about a course-->
<?php 
    $title = "IDCP - Instructor Profile";
    $page = 'idcp_settings';
    $page_name = 'idcp_instructor';
    require('includes/header.php');
    require( 'includes/connect_db_c9.php' ) ;
    require( 'includes/instructor_helpers.php' ) ;
    $ins_lname = $_SESSION['INS_LNAME'];
    $ins_fname = $_SESSION['INS_FNAME'];
    $query = "SELECT INS_ID FROM INSTRUCTOR WHERE INS_FNAME = '$ins_fname' AND INS_LNAME = '$ins_lname'";
	$result = mysqli_query($dbc, $query);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC) ;
    $ins_id = $row['INS_ID'];
    $_SESSION['INS_ID'] = $ins_id;

?>
<style>
    .inline {
  display: inline;
}
.link-button {
  background: none;
  border: none;
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
    <!-- Bread Crumbs -->
    <ol class = "breadcrumb">
        <li><a href = "home.php">Home</a></li>
        <li><a href = "idcp_settings.php">IDCP Settings</a></li>
        <li><a href = "instructor_search.php">Search Instructor</a></li>
        <li class = "active">Instructor Profile</li>
    </ol>
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="page-header">
                    <h1>
                        <?php
                            echo $ins_fname . " " . $ins_lname;
                        ?>
                    </h1>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <h3 class="panel-title">Instructor Info</a></h3>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <p><label>First Name: </label><br>
                                    <?php
                                        echo $ins_fname;
                                    ?>
                                    </p>
                                    <p><label>Last Name:</label><br>
                                    <?php
                                        echo $ins_lname;
                                    ?>
                                    </p>
                                    <p><label>Initial:</label><br>
                                    <?php
                                      echo get_ins_initial($dbc, $ins_id);
                                    ?>
                                    </p>
                                    <p><label>Email:</label><br>
                                    <?php
                                      echo get_ins_email($dbc, $ins_id);
                                    ?>
                                    </p>
                                    <button class="btn btn-default btn-sm" style="<?php if($user_role=='User') echo 'display:none;';?>" onclick ="location.href='edit_instructor.php';">Edit</button>
                                </div>
                            </div>
                        </div>
                        <h3>Courses Being Taught<br><small>Click on a course to view it</small></h3><hr>
                        <?php
                            echo get_ins_courses($dbc, $ins_id);
                        ?>
                        <button class="btn btn-default btn-sm" onclick ="location.href='instructor_search.php';">Back</button>
                        <!--<button class="btn btn-danger btn-sm" style="<?php if($user_role=='User') echo 'display:none;';?>" onclick ="location.href='delete_course_confirm.php';">Delete Course</button>-->
                    </div>
                </div>
            </div>
            <!-- /#container close -->
        </div>
        <!-- /#page-content-wrapper -->
        <!--Footer-->
        <?php require('includes/footer.php'); ?>
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script>
    //Clicking on table row redirects user to course profile page
    jQuery(document).ready(function($) {
        $('.table > tbody > tr').click(function() {
            var value = $(this).find('td:first').text();
            jQuery.ajax({
                url: 'backendcrs.php',
                type: 'POST',
                data: {
                    'CRS_ID': value,
                },
                dataType : 'json',
                success: function(data, textStatus, xhr) {
                    window.location.href = "course_profile.php";
                    console.log(data); // do with data e.g success message
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.log(textStatus.reponseText);
                window.location.href = "course_profile.php";
                }
            });
        });
    });
    </script>
</body>
</html>