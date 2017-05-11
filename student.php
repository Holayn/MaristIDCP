<!--Student Home Page-->
<?php 
    $title = "IDCP - Students";
    $page = 'student';
    $page_name = 'stu';
    require("includes/header.php");
    //gets rid of what user searched before in searchfield
    if(isset($_SESSION['searchString'])){
        $_SESSION['searchString'] = "";
    }
    if(isset($_SESSION['order'])){
        $_SESSION['order'] = "";
    }
    if (isset($_SESSION['stu_id']) && !empty($_SESSION['stu_id'])) {
        unset($_SESSION['stu_id']);
    } 
    if(isset($_SESSION['STU_ID']) && !empty($_SESSION['STU_ID'])) {
        unset($_SESSION['STU_ID']);
    }
?>
<script>
    sessionStorage.clear();
</script>
<!-- Bread Crumbs -->
    <ol class = "breadcrumb">
        <li><a href = "home.php">Home</a></li>
        <li class = "active">Student</li>
    </ol>
<!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="dropdown">
                <div class="page-header">
                    <h1>Students</h1>
                </div>
                <br>
                <div class = "butspan" style = "width: 300px;">
                    <button type="button" class="btn btn-primary btn-block" style = "margin-right: 50px; height: 50px; <?php if($user_role=='User') echo 'display:none;';?> " onclick="location.href='add_student.php';">Add New Student</button>
                    <button type="button" class="btn btn-primary btn-block" style = "margin-right: 50px; height: 50px;" onclick="location.href='student_search.php';">Search for Student</button>
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
