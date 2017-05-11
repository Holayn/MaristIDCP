<!--Template page for IDCP-->
<?php
    $title = "TEMPLATE";
    $page = 'PUT SIDEBAR CATEGORY HERE';
    $page_name = 'PUT HELP ANCHOR HERE';
    require('includes/header.php');
?>
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="dropdown">
                    <div class="page-header">
                        <h1>Welcome</h1>
                    </div>
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Select a Program:
                    <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                      <li><a href="zOS.html">z/OS</a></li>
                      <li><a href="#">Data Center</a></li>
                    </ul>
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
</body>
</html>
