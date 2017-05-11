<?php
    $title = "IDCP - Student Search";
    require('includes/header.php');
    if(!isset($_SESSION['searchString'])){
        $_SESSION['searchString'] = "";
    }
    $searchString = $_SESSION['searchString'];
    # Connect to MySQL server and the database
    require( 'includes/connect_db_c9.php' ) ;
    # Includes these helper functions
    require( 'includes/student_helpers.php' ) ;
    //After user submits, set session's search string to what user typed in.
    if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
        #Deprecated
        // $stu_id = $_POST['stu_id'];
        // loadSearch('student_profile.php', $stu_id);
        $_SESSION['searchString'] = $_POST['searchString'];
        $page = 'student_search.php';
        session_write_close();
        header("Location: $page");
    }
?>

<script>
    function showField(str) {
      if (str=="") {
        document.getElementById("field_display").innerHTML="";
        return;
      } 
      if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
      } else { // code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
      xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
          document.getElementById("field_display").innerHTML=this.responseText;
        }
      }
      //str =
      //str1 = $( "#cert_id" ).text()+ "." + str;
      xmlhttp.open("GET","backendsturpt.php?q="+str,true);
      xmlhttp.send();
    }
</script>

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
                    <div class="page-header">
                        <h1>Search Students<small> Click on a student to view more</small><br></h1>
                    </div>
                    <font size="3">Search a Name or ID: &nbsp;&nbsp;</font>
                    <form method="POST" action="student_search.1.php">
                        <input type="text" name="searchString" value ="<?php echo $searchString; ?>" placeholder="Search.."/>
                        <br>
                        <!--<input type="submit" class="button">-->
                        <br>
                        <div class = "butspan" style = "width: 200px;">
                            <button type="submit" class="btn btn-primary btn-block" style="height: 50px;">Submit</button>
                        </div>
                    </form>
                    <div class="form-group">
                            <label class="col-xs-3 control-label" for="emp_name">Employer</label>
                            <div class="col-xs-2">
                                <select class="form-control" id="emp_name" name="emp_name" value="<?php if (isset($_POST['emp_name'])) echo $_POST['emp_name'];?>" onchange="showField(this.value)" data-error="Please select the earn date" required>
                                    <option disabled selected value>--</option>
                                    <?php
                                        populate_emp_name($dbc);
                                    ?>
                              </select>
                            </div>
                            <div class="help-block with-errors"></div>
                    </div>
                    <br>
                    <h3>Students</h3>
                    <div id="field_display" class="span3" style="height: 200px; overflow: auto;"> 
                        <?php
                            show_brief_students_results($dbc, $searchString);
                        ?>
                    </div>
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

    <!--Makes rows clickable-->
    <script>
    jQuery(document).ready(function($) {
        $('.table > tbody > tr').click(function() {
            // //Puts CRS_ID into session
            // var value = $(this).find('td:first').text(); //first column in table
            // // Send Ajax request to backend.php, with value set as "CRS_ID" in the POST data
            // $.post("/backendstu.php", {"STU_ID": value});
            // window.location.href = "student_profile.php";
            
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
    
    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>

</body>

</html>
