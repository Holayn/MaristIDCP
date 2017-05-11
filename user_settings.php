<!--User profile page-->
<?php 
    $title = "IDCP - User Profile";
    $page = 'user_settings';
    $page_name = 'user';
    require('includes/header.php');
    require( 'includes/connect_db_c9.php' ) ;
    require( 'includes/user_helpers.php' ) ;
    // already in header
    // $user_id = $_SESSION['user_id'];
    // $user_role = $_SESSION['user_role'];
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
    <li class = "active">User Settings</li>
    </ol>
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="page-header">
                    <h1>
                        <?php
                            echo $user_id;
                        ?>
                    </h1>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <h3 class="panel-title">Account Information</a></h3>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <p><label>User ID: </label><br>
                                    <?php
                                     echo $user_id;
                                    ?>
                                    </p>
                                    <p><label>Role:</label><br>
                                    <?php
                                      echo $user_role;
                                    ?>
                                    </p>
                                    <button class="btn btn-default btn-sm" onclick ="location.href='user_edit.php';">Edit</button>
                                    <button class="btn btn-default btn-sm" onclick ="location.href='user_change_pwd.php';">Change Password</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php if($user_role != "User"){?>
                    <div class="col-sm-4">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <h3 class="panel-title">Task</a></h3>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <button class="btn btn-default btn-sm" onclick ="location.href='user_create.php';">Create New User</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <!--</div>-->
                <?php }?>
                <?php if($user_role != "User"){?>
                <br><br><br><br><br><br><br><br><br><br><br><br><br>
                    <div class="col-sm-4">
                    <h3>Users<small> Click on a user to edit</small></h3>
                    <?php
                        show_user_results($dbc);
                    ?>
                    </div>
                <?php }?>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <button class="btn btn-default btn-sm" onclick ="location.href='home.php';">Back to Home</button>
                    </div>
                </div>
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
        <!--Makes rows clickable-->
    <script>
    jQuery(document).ready(function($) {
        $('.table > tbody > tr').click(function() {
            var value = $(this).find('td:first').text();
            jQuery.ajax({
                url: 'backenduser.php',
                type: 'POST',
                data: {
                    'USER_ID': value,
                },
                dataType : 'json',
                success: function(data, textStatus, xhr) {
                    window.location.href = "other_user_settings.php";
                    console.log(data); // do with data e.g success message
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.log(textStatus.reponseText);
                window.location.href = "other_user_settings.php";
                }
            });
        });
    });
    </script>
</body>
</html>
