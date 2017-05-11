<?php
    $title = 'IDCP - Course Results';
    $page = 'course';
    $page_name = 'crs';

    require('includes/header.php');
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
    width: 25%;
}
</style>
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
            <!--<div class="container" style="padding-right: 100px; max-width: 1100px;">-->
                <div class="dropdown">
                    <h1>Search z/OS Courses<br><br></h1>
                    
                    <font size="3">Enter Course ID: &nbsp;&nbsp;</font>
                    <input type="text" name="crs_search" placeholder="Search.."/>
                    <br><br>
                    
                    <button class="button">Search</button>
                    
                </div>
            </div>
        <!-- /#page-content-wrapper -->
        </div>
		    
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>


</body>

</html>
