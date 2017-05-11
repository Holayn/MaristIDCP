<!--Program Home Page-->
<?php 
    $title = "IDCP - Program";
    $page = 'program';
    $page_name = 'prg';
    require("includes/header.php");
    if(isset($_SESSION['searchString'])){
    $_SESSION['searchString'] = "";
}
    if (isset($_SESSION['prg_id']) && !empty($_SESSION['prg_id'])) {
        unset($_SESSION['prg_id']);
    } 
?>
<script>
    sessionStorage.clear();
</script>
<!-- Bread Crumbs -->
    <ol class = "breadcrumb">
        <li><a href = "home.php">Home</a></li>
        <li class = "active">Program</li>
    </ol>
<!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="dropdown">
                <div class="page-header">
                    <h1>Programs</h1>
                </div>
                <br>
                <div class = "butspan" style = "width: 300px;">
                    <button type="button" class="btn btn-primary btn-block" style = "margin-right: 50px; height: 50px; <?php if($user_role=='User') echo 'display:none;';?> " onclick="location.href='add_program.php';">Add New Program</button>
                    <button type="button" class="btn btn-primary btn-block" style = "margin-right: 50px; height: 50px;" onclick="location.href='program_search.php';">Search for a Program</button>
                </div>
            </div>
            <br>
            <button class="btn btn-default btn-sm" onclick ="location.href='home.php';">Back to Home</button>
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
