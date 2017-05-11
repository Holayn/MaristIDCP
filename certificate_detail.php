<!--Shows more information about a certificate-->
<?php 
    $title = "IDCP - Certificate Details";
    $page = 'certificate';
    $page_name = 'cert';
    require('includes/header.php');
    require( 'includes/connect_db_c9.php' ) ;
    require( 'includes/certificate_helpers.php' ) ;
    $cert_name= $_SESSION['CERT_NAME'];
    $cert_id = get_cert_id($dbc, $cert_name);
    $_SESSION['CERT_ID'] = $cert_id;
    # Check to make sure it is the first time user is visiting the page
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
        $_SESSION['searchString'] = "";
    }
    if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
        $order = $_POST['order'];
    }
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
    <li><a href = "certificate.php">Certificate</a></li>
    <li><a href = "certificate_search.php">Certificate Search</a></li>
    <li class = "active">Certificate Detail</li>
</ol>
    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="page-header">
                <h1>
                    <?php
                        echo $cert_name;
                    ?>
                </h1>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                Certificate Info
                            </h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <p><label>Program that Certificate is part of:</label><br>
                                    <?php
                                     echo get_prg_name($dbc, $cert_id);
                                    ?>
                                </p>
                                <button class="btn btn-default btn-sm" style="<?php if($user_role=='User') echo 'display:none;';?>" onclick ="location.href='certificate_edit.php';">Edit</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col-sm-4 -->
            </div>
            <?php 
                if ($user_role != "User")
                    echo "<h3>Student(s) who earned this<small> Click on a student to edit</small><br></h3>";
                else
                    echo "<h3>Student(s) who earned this</h3><br>";
            ?>
            <form method="POST" action="certificate_detail.php" class="form-horizontal" role="form">
                    <div class="form-group">
                        <div class="col-xs-2">
                            Order By:
                            <select class="form-control" id="order" name="order">
                                <option disabled selected value>--</option>
                                <option <?php if ($order == 'ID') echo 'selected="selected"'; ?>>ID</option>
                                <option <?php if ($order == 'Last Name') echo 'selected="selected"'; ?>>Last Name</option>
                                <option <?php if ($order == 'First Name') echo 'selected="selected"'; ?>>First Name</option>
                                <option <?php if ($order == 'Earn Date') echo 'selected="selected"'; ?>>Earn Date</option>
                                <option <?php if ($order == 'Mail Date') echo 'selected="selected"'; ?>>Mail Date</option>
                            </select>
                        </div>
                    </div>
                </form>
            <div id="field_display" class="span3" style="height: 200px; overflow: auto;">
                <?php
                        show_brief_certificate_students($dbc, $cert_id, $order);
                ?>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <button class="btn btn-default btn-sm" type="button" onclick="location.href='certificate_search.php';">Back to Search</button>
                    <!--Moved delete button to certificate edit page-->
                    <!--<button class="btn btn-danger btn-sm" style="<?php if($user_role=='User') echo 'display:none;';?>" onclick ="location.href='delete_certificate_confirm.php';">Delete Certificate</button>-->
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
    <?php if($user_role != "User"){ ?>
    <!--Makes rows clickable-->
    <script>
    jQuery(document).ready(function($) {
        $('.table > tbody > tr').click(function() {
            var value = $(this).find('td:first').text();
            jQuery.ajax({
                url: 'backendcertstu.php',
                type: 'POST',
                data: {
                    'STU_ID': value,
                },
                dataType : 'json',
                success: function(data, textStatus, xhr) {
                    window.location.href = "edit_student_certificate_home.php";
                    console.log(data); // do with data e.g success message
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.log(textStatus.reponseText);
                window.location.href = "edit_student_certificate_home.php";
                }
            });
        });
    });
    </script>
    <?php } ?>
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
