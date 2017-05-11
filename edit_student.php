<!--Edit student page-->
<?php
    $title = "IDCP - Edit Student";
    $page = 'student';
    $page_name = 'edit_stu';
    require('includes/header.php');
    # Connect to MySQL server and the database
    require( 'includes/connect_db_c9.php' ) ;
    # Includes these helper functions
    require( 'includes/student_helpers.php' ) ;
    $stu_id = $_SESSION['STU_ID'];
    # Check to make sure it is the first time user is visiting the page
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    	$query = "SELECT * FROM STUDENT WHERE STU_ID = $stu_id";
    	$result = mysqli_query($dbc, $query);
    	$row = mysqli_fetch_array($result, MYSQLI_ASSOC) ;
    	$stu_id = $row['STU_ID'];
    	$stu_tag = $row['STU_TAG'];
    	$stu_fname = $row['STU_FNAME'];
    	$stu_lname = $row['STU_LNAME'];
    	$stu_initial = $row['STU_INITIAL'];
    	$stu_gender = $row['STU_GENDER'];
    	$stu_citizen = $row['STU_CITIZEN'];
    	$stu_street = $row['STU_STREET'];
    	$stu_city = $row['STU_CITY'];
    	$stu_zip = $row['STU_ZIP'];
    	$stu_country = $row['STU_COUNTRY'];
    	$stu_ethnicity = $row['STU_ETHNICITY'];
    	$stu_dob = $row['STU_DOB'];
    	$stu_transcript = $row['STU_TRANSCRIPT'];
    	$stu_edu_lvl = $row['STU_EDU_LVL'];
    	$stu_email_1 = $row['STU_EMAIL_1'];
    	$stu_email_2 = $row['STU_EMAIL_2'];
    	$stu_phone = $row['STU_PHONE'];
    	$stu_start = $row['STU_START'];
    	$stu_end = $row['STU_END'];
    	$stu_comment = $row['STU_COMMENT'];
    	$emp_id = $row['EMP_ID'];
    	$stu_job_title = $row['STU_JOB_TITLE'];
    	$stu_state = $row['STU_STATE'];
    	$stu_qualify_exam = $row['STU_QUALIFY_EXAM'];
    	mysqli_free_result($result);
        //Regular user cannot access this page
        if($user_role == "User"){
            $page = 'home.php';
            header("Location: $page");
        }
    	}
    else{
        echo '<p>'.mysqli_error($dbc).'</p>';
    }
    # Check to make sure the form method is post
    if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
    	$stu_tag = mysqli_real_escape_string($dbc, trim($_POST['stu_tag']));
    	$stu_fname = mysqli_real_escape_string($dbc, trim($_POST['stu_fname']));
    	$stu_lname = mysqli_real_escape_string($dbc, trim($_POST['stu_lname']));
    	$stu_initial = mysqli_real_escape_string($dbc, trim($_POST['stu_initial']));
    	$stu_gender = mysqli_real_escape_string($dbc, trim($_POST['stu_gender']));
    	$stu_citizen = mysqli_real_escape_string($dbc, trim($_POST['stu_citizen']));
    	$stu_street = mysqli_real_escape_string($dbc, trim($_POST['stu_street']));
    	$stu_city = mysqli_real_escape_string($dbc, trim($_POST['stu_city']));
    	$stu_zip = mysqli_real_escape_string($dbc, trim($_POST['stu_zip']));
    	$stu_country = mysqli_real_escape_string($dbc, trim($_POST['stu_country']));
    	$stu_ethnicity = mysqli_real_escape_string($dbc, trim($_POST['stu_ethnicity']));
    	$stu_dob = mysqli_real_escape_string($dbc, trim($_POST['stu_dob']));
    	$stu_edu_lvl = mysqli_real_escape_string($dbc, trim($_POST['stu_edu_lvl']));
    	$stu_transcript = mysqli_real_escape_string($dbc, trim($_POST['stu_transcript']));
    	$stu_email_1 = mysqli_real_escape_string($dbc, trim($_POST['stu_email_1']));
    	$stu_email_2 = mysqli_real_escape_string($dbc, trim($_POST['stu_email_2']));
    	$stu_phone = mysqli_real_escape_string($dbc, trim($_POST['stu_phone']));
    	$stu_start = mysqli_real_escape_string($dbc, trim($_POST['stu_start']));
    	$stu_end = mysqli_real_escape_string($dbc, trim($_POST['stu_end']));
    	$stu_comment = mysqli_real_escape_string($dbc, trim($_POST['stu_comment']));
    // 	$emp_id = mysqli_real_escape_string($dbc, trim($_POST['emp_name']));
    	$stu_job_title = mysqli_real_escape_string($dbc, trim($_POST['stu_job_title']));
    	if(!isset($_POST['stu_state'])) $stu_state = NULL;
    	else $stu_state = $_POST['stu_state'];
    	if($stu_state ==  "--"){
        	    $stu_state = "";
        	}
    	$stu_qualify_exam = $_POST['stu_qualify_exam'];
    	if(!isset($_POST['emp_name'])) $emp_id = "NULL";
    	        else $emp_id = $_POST['emp_name'];
    	if($emp_id == "None" || $emp_id=="NULL"){
    	    $emp_id = "NULL";
    	    echo "<script>alert('$emp_id')</script>";
    	}
    	else{
    	    $emp_id = get_employer_id($dbc, $emp_id);
    	}
    	$result = update_record($dbc, $stu_id, $stu_tag, $stu_lname, $stu_fname, $stu_initial, $stu_start, $stu_end, $stu_edu_lvl, $stu_job_title, $stu_street, $stu_city, $stu_state, $stu_country, $stu_zip, $stu_phone, $stu_email_1, $stu_email_2, $stu_dob, $stu_ethnicity, $stu_gender, $stu_citizen, $stu_transcript, $stu_comment, $stu_qualify_exam, $emp_id);
    	$page = 'student_profile_detail.php';
        header("Location: $page");
    }
    # Close the connection
    mysqli_close( $dbc ) ;
?>
<!--Doesn't work rn-->
<script>
    window.onbeforeunload = function() {
        sessionStorage.setItem("stu_id", document.getElementById("stu_id").value);
        sessionStorage.setItem("stu_tag", document.getElementById("stu_tag").value);
        sessionStorage.setItem("stu_fname", document.getElementById("stu_fname").value);
        sessionStorage.setItem("stu_lname", document.getElementById("stu_lname").value);
        sessionStorage.setItem("stu_initial", document.getElementById("stu_initial").value);
        sessionStorage.setItem("stu_gender", document.getElementById("stu_gender").value);
        sessionStorage.setItem("stu_citizen", document.getElementById("stu_citizen").value);
        sessionStorage.setItem("stu_street", document.getElementById("stu_street").value);
        sessionStorage.setItem("stu_city", document.getElementById("stu_city").value);
        sessionStorage.setItem("stu_state", document.getElementById("stu_state").value);
        sessionStorage.setItem("stu_zip", document.getElementById("stu_zip").value);
        sessionStorage.setItem("stu_country", document.getElementById("stu_country").value);
        sessionStorage.setItem("stu_ethnicity", document.getElementById("stu_ethnicity").value);
        sessionStorage.setItem("stu_dob", document.getElementById("stu_dob").value);
        sessionStorage.setItem("stu_edu_lvl", document.getElementById("stu_edu_lvl").value);
        sessionStorage.setItem("stu_transcript", document.getElementById("stu_transcript").value);
        sessionStorage.setItem("stu_email_1", document.getElementById("stu_email_1").value);
        sessionStorage.setItem("stu_email_2", document.getElementById("stu_email_2").value);
        sessionStorage.setItem("stu_phone", document.getElementById("stu_phone").value);
        sessionStorage.setItem("emp_name", document.getElementById("emp_name").value);
        sessionStorage.setItem("stu_job_title", document.getElementById("stu_job_title").value);
        sessionStorage.setItem("stu_start", document.getElementById("stu_start").value);
        sessionStorage.setItem("stu_end", document.getElementById("stu_end").value);
        sessionStorage.setItem("stu_comment", document.getElementById("stu_comment").value);
        sessionStorage.setItem("stu_qualify_exam", document.getElementById("stu_qualify_exam").value);
    }
window.onload = function() {
        if (sessionStorage.getItem("stu_id") !== null) document.getElementById("stu_id").value = sessionStorage.getItem("stu_id");
        if (sessionStorage.getItem("stu_tag") !== null) document.getElementById("stu_tag").value = sessionStorage.getItem("stu_tag");
        if (sessionStorage.getItem("stu_fname") !== null) document.getElementById("stu_fname").value = sessionStorage.getItem("stu_fname");
        if (sessionStorage.getItem("stu_lname") !== null) document.getElementById("stu_lname").value = sessionStorage.getItem("stu_lname");
        if (sessionStorage.getItem("stu_initial") !== null) document.getElementById("stu_initial").value = sessionStorage.getItem("stu_initial");
        if (sessionStorage.getItem("stu_gender") !== null) document.getElementById("stu_gender").value = sessionStorage.getItem("stu_gender");
        if (sessionStorage.getItem("stu_citizen") !== null) document.getElementById("stu_citizen").value = sessionStorage.getItem("stu_citizen");
        if (sessionStorage.getItem("stu_street") !== null) document.getElementById("stu_street").value = sessionStorage.getItem("stu_street");
        if (sessionStorage.getItem("stu_city") !== null) document.getElementById("stu_city").value = sessionStorage.getItem("stu_city");
        if (sessionStorage.getItem("stu_state") !== null) document.getElementById("stu_state").value = sessionStorage.getItem("stu_state");
        if (sessionStorage.getItem("stu_zip") !== null) document.getElementById("stu_zip").value = sessionStorage.getItem("stu_zip");
        if (sessionStorage.getItem("stu_country") !== null) document.getElementById("stu_country").value = sessionStorage.getItem("stu_country");
        if (sessionStorage.getItem("stu_ethnicity") !== null) document.getElementById("stu_ethnicity").value = sessionStorage.getItem("stu_ethnicity");
        if (sessionStorage.getItem("stu_dob") !== null) document.getElementById("stu_dob").value = sessionStorage.getItem("stu_dob");
        if (sessionStorage.getItem("stu_edu_lvl") !== null) document.getElementById("stu_edu_lvl").value = sessionStorage.getItem("stu_edu_lvl");
        if (sessionStorage.getItem("stu_transcript") !== null) document.getElementById("stu_transcript").value = sessionStorage.getItem("stu_transcript");
        if (sessionStorage.getItem("stu_email_1") !== null) document.getElementById("stu_email_1").value = sessionStorage.getItem("stu_email_1");
        if (sessionStorage.getItem("stu_email_2") !== null) document.getElementById("stu_email_2").value = sessionStorage.getItem("stu_email_2");
        if (sessionStorage.getItem("stu_phone") !== null) document.getElementById("stu_phone").value = sessionStorage.getItem("stu_phone");
        if (sessionStorage.getItem("emp_name") !== null) document.getElementById("emp_name").value = sessionStorage.getItem("emp_name");
        if (sessionStorage.getItem("stu_job_title") !== null) document.getElementById("stu_job_title").value = sessionStorage.getItem("stu_job_title");
        if (sessionStorage.getItem("stu_start") !== null) document.getElementById("stu_start").value = sessionStorage.getItem("stu_start");
        if (sessionStorage.getItem("stu_end") !== null) document.getElementById("stu_end").value = sessionStorage.getItem("stu_end");
        if (sessionStorage.getItem("stu_comment") !== null) document.getElementById("stu_comment").value = sessionStorage.getItem("stu_comment");
        if (sessionStorage.getItem("stu_qualify_exam") !== null) document.getElementById("stu_qualify_exam").value = sessionStorage.getItem("stu_qualify_exam");
    }
</script>
    <!-- Bread Crumbs -->
    <ol class = "breadcrumb">
    <li><a href = "home.php">Home</a></li>
    <li><a href = "student.php">Student</a></li>
    <li><a href = "student_search.php">Student Search</a></li>
    <li><a href = "student_profile.php">Student Profile</a></li>
    <li><a href = "student_profile_detail.php">Personal Info</a></li>
    <li class = "active">Edit Student</li>
    </ol>
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="dropdown">
                    <div class="page-header">
                        <?php
    				        $stu_id = $_SESSION['STU_ID'];
    				        $name = get_stu_name($dbc, $stu_id);
    				        echo '<h1>Edit Student - Edit Info for ' . "$name" . '</h1>';
				        ?>
                    </div>
                    <form action="edit_student.php" method="POST" class="form-horizontal" data-toggle="validator" id="student_form">
                        <div class="form-group">
                            <label class="col-xs-3 control-label"></label>
                            <div class="col-xs-5">
                                <h3>Identification</h3>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">ID*</label>
                            <div class="col-xs-2">
                                <input type="text" class="form-control" maxlength="8" onkeypress="return isNumberKey(event)" pattern="^[0-9]{1,}$" name="stu_id" id="stu_id" value="<?php if (isset($_POST['stu_id'])) echo $_POST['stu_id']; else echo $stu_id;?>" data-error="Please enter the student's ID. Max-length: 8 digits" required readonly disabled>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Tag</label>
                            <div class="col-xs-2">
                                <input type="text" class="form-control" maxlength="8" onkeypress="return isNumberKey(event)" pattern="^[0-9]{1,}$" name="stu_tag" id="stu_tag" value="<?php if (isset($_POST['stu_tag'])) echo $_POST['stu_tag']; else echo $stu_tag;?>" data-error="Please enter the student's tag. Max-length: 8 digits">
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">First Name*</label>
                            <div class="col-xs-5">
                                <input type="text" class="form-control" name="stu_fname" id="stu_fname" value="<?php if (isset($_POST['stu_fname'])) echo $_POST['stu_fname']; else echo $stu_fname;?>" data-error="Please enter the student's first name" required>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Last Name*</label>
                            <div class="col-xs-5">
                                <input type="text" class="form-control" name="stu_lname" id="stu_lname" value="<?php if (isset($_POST['stu_lname'])) echo $_POST['stu_lname']; else echo $stu_lname;?>" data-error="Please enter the student's last name" required>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Initial</label>
                            <div class="col-xs-1">
                                <input type="text" class="form-control" maxlength="1" name="stu_initial" id="stu_initial" value="<?php if (isset($_POST['stu_initial'])) echo $_POST['stu_initial']; else echo $stu_initial;?>")>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Gender*</label>
                            <div class="col-xs-2">
                                <select class="form-control" id="stu_gender" name="stu_gender" value="
                                <?php 
                                if (isset($_POST['stu_gender'])){
                                    echo $_POST['stu_gender'];
                                } 
                                else{
                                    echo $stu_gender;
                                }
                                ?>
                                " data-error="Please select the student's gender" required>
                                    <option disabled selected value> -- select an option -- </option>
                                    <option value="Female" <?php if($stu_gender == 'Female') echo 'selected="selected"' ?>>Female</option>
                                    <option value="Male" <?php if($stu_gender == 'Male') echo 'selected="selected"' ?>>Male</option>
                                </select>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">U.S. Citizen*</label>
                            <div class="col-xs-1">
                                <select class="form-control" id="stu_citizen" name="stu_citizen" data-error="Please select if the student is a U.S. citizen" required>
                                    <option disabled selected value> -- select an option -- </option>
                                    <option value="Yes" <?php if($stu_citizen == 'Yes' || $stu_citizen == 'yes') echo 'selected="selected"' ?>>Yes</option>
                                    <option value="No" <?php if($stu_citizen == 'No' || $stu_citizen == 'no') echo 'selected="selected"' ?>>No</option>
                                </select>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Street Address*</label>
                            <div class="col-xs-5">
                                <input type="text" class="form-control" maxlength="255" name="stu_street" id="stu_street" value="<?php if (isset($_POST['stu_street'])) echo $_POST['stu_street']; else echo $stu_street;?>" data-error="Please enter the student's street address" required>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">City*</label>
                            <div class="col-xs-3">
                                <input type="text" class="form-control" maxlength="255" name="stu_city" id="stu_city" value="<?php if (isset($_POST['stu_city'])) echo $_POST['stu_city']; else echo $stu_city?>" data-error="Please enter the student's city" required)>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label" for="sel1">State</label>
                            <div class="col-xs-3">
                                <select class="form-control" id="stu_state" name="stu_state" value="<?php if (isset($_POST['stu_state'])) echo $_POST['stu_state']; else echo $stu_state?>">
                                    <option>--</option>
                                    <option value="AL" <?php if($stu_state == 'AL') echo 'selected="selected"' ?>>Alabama</option>
                                	<option value="AK" <?php if($stu_state == 'AK') echo 'selected="selected"' ?>>Alaska</option>
                                	<option value="AZ" <?php if($stu_state == 'AZ') echo 'selected="selected"' ?>>Arizona</option>
                                	<option value="AR" <?php if($stu_state == 'AR') echo 'selected="selected"' ?>>Arkansas</option>
                                	<option value="CA" <?php if($stu_state == 'CA') echo 'selected="selected"' ?>>California</option>
                                	<option value="CO" <?php if($stu_state == 'CO') echo 'selected="selected"' ?>>Colorado</option>
                                	<option value="CT" <?php if($stu_state == 'CT') echo 'selected="selected"' ?>>Connecticut</option>
                                	<option value="DE" <?php if($stu_state == 'DE') echo 'selected="selected"' ?>>Delaware</option>
                                	<option value="DC" <?php if($stu_state == 'DC') echo 'selected="selected"' ?>>District Of Columbia</option>
                                	<option value="FL" <?php if($stu_state == 'FL') echo 'selected="selected"' ?>>Florida</option>
                                	<option value="GA" <?php if($stu_state == 'GA') echo 'selected="selected"' ?>>Georgia</option>
                                	<option value="HI" <?php if($stu_state == 'HI') echo 'selected="selected"' ?>>Hawaii</option>
                                	<option value="ID" <?php if($stu_state == 'ID') echo 'selected="selected"' ?>>Idaho</option>
                                	<option value="IL" <?php if($stu_state == 'IL') echo 'selected="selected"' ?>>Illinois</option>
                                	<option value="IN" <?php if($stu_state == 'IN') echo 'selected="selected"' ?>>Indiana</option>
                                	<option value="IA" <?php if($stu_state == 'IA') echo 'selected="selected"' ?>>Iowa</option>
                                	<option value="KS" <?php if($stu_state == 'KS') echo 'selected="selected"' ?>>Kansas</option>
                                	<option value="KY" <?php if($stu_state == 'KY') echo 'selected="selected"' ?>>Kentucky</option>
                                	<option value="LA" <?php if($stu_state == 'LA') echo 'selected="selected"' ?>>Louisiana</option>
                                	<option value="ME" <?php if($stu_state == 'ME') echo 'selected="selected"' ?>>Maine</option>
                                	<option value="MD" <?php if($stu_state == 'MD') echo 'selected="selected"' ?>>Maryland</option>
                                	<option value="MA" <?php if($stu_state == 'MA') echo 'selected="selected"' ?>>Massachusetts</option>
                                	<option value="MI" <?php if($stu_state == 'MI') echo 'selected="selected"' ?>>Michigan</option>
                                	<option value="MN" <?php if($stu_state == 'MN') echo 'selected="selected"' ?>>Minnesota</option>
                                	<option value="MS" <?php if($stu_state == 'MS') echo 'selected="selected"' ?>>Mississippi</option>
                                	<option value="MO" <?php if($stu_state == 'MO') echo 'selected="selected"' ?>>Missouri</option>
                                	<option value="MT" <?php if($stu_state == 'MT') echo 'selected="selected"' ?>>Montana</option>
                                	<option value="NE" <?php if($stu_state == 'NE') echo 'selected="selected"' ?>>Nebraska</option>
                                	<option value="NV" <?php if($stu_state == 'NV') echo 'selected="selected"' ?>>Nevada</option>
                                	<option value="NH" <?php if($stu_state == 'NH') echo 'selected="selected"' ?>>New Hampshire</option>
                                	<option value="NJ" <?php if($stu_state == 'NJ') echo 'selected="selected"' ?>>New Jersey</option>
                                	<option value="NM" <?php if($stu_state == 'NM') echo 'selected="selected"' ?>>New Mexico</option>
                                	<option value="NY" <?php if($stu_state == 'NY') echo 'selected="selected"' ?>>New York</option>
                                	<option value="NC" <?php if($stu_state == 'NC') echo 'selected="selected"' ?>>North Carolina</option>
                                	<option value="ND" <?php if($stu_state == 'ND') echo 'selected="selected"' ?>>North Dakota</option>
                                	<option value="OH" <?php if($stu_state == 'OH') echo 'selected="selected"' ?>>Ohio</option>
                                	<option value="OK" <?php if($stu_state == 'OK') echo 'selected="selected"' ?>>Oklahoma</option>
                                	<option value="OR" <?php if($stu_state == 'OR') echo 'selected="selected"' ?>>Oregon</option>
                                	<option value="PA" <?php if($stu_state == 'PA') echo 'selected="selected"' ?>>Pennsylvania</option>
                                	<option value="RI" <?php if($stu_state == 'RI') echo 'selected="selected"' ?>>Rhode Island</option>
                                	<option value="SC" <?php if($stu_state == 'SC') echo 'selected="selected"' ?>>South Carolina</option>
                                	<option value="SD" <?php if($stu_state == 'SD') echo 'selected="selected"' ?>>South Dakota</option>
                                	<option value="TN" <?php if($stu_state == 'TN') echo 'selected="selected"' ?>>Tennessee</option>
                                	<option value="TX" <?php if($stu_state == 'TX') echo 'selected="selected"' ?>>Texas</option>
                                	<option value="UT" <?php if($stu_state == 'UT') echo 'selected="selected"' ?>>Utah</option>
                                	<option value="VT" <?php if($stu_state == 'VT') echo 'selected="selected"' ?>>Vermont</option>
                                	<option value="VA" <?php if($stu_state == 'VA') echo 'selected="selected"' ?>>Virginia</option>
                                	<option value="WA" <?php if($stu_state == 'WA') echo 'selected="selected"' ?>>Washington</option>
                                	<option value="WV" <?php if($stu_state == 'WV') echo 'selected="selected"' ?>>West Virginia</option>
                                	<option value="WI" <?php if($stu_state == 'WI') echo 'selected="selected"' ?>>Wisconsin</option>
                                	<option value="WY" <?php if($stu_state == 'WY') echo 'selected="selected"' ?>>Wyoming</option> 
                                	<option value="WY" <?php if($stu_state == 'WY') echo 'selected="selected"' ?>>Wyoming</option> 
                                </select>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">ZIP*</label>
                            <div class="col-xs-2">
                                <input type="text" class="form-control" maxlength="32" name="stu_zip" id="stu_zip" value="<?php if (isset($_POST['stu_zip'])) echo $_POST['stu_zip']; else echo $stu_zip?>" data-error="Please enter the student's ZIP" required>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label" for="sel1">Country*</label>
                            <div class="col-xs-3">
                                <select class="form-control" id="stu_country" name="stu_country" value="<?php if (isset($_POST['stu_country'])) echo $_POST['stu_country'];?>" data-error="Please select the student's country" required>
                                    <option disabled selected value> -- select an option -- </option>
                                    <?php
                                        $selected = $stu_country;
                                        $countries = array("USA", "Afghanistan", "Åland Islands", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
                                        foreach($countries as $country){
                                            if($selected == $country){
                                                echo "<option selected='selected' value='$country'>$country</option>" ;
                                            }else{
                                                echo "<option value='$country'>$country</option>" ;
                                            }
                                        }                                  
                                    ?>
                                </select>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label" for="sel1">Race/Ethnicity*</label>
                            <div class="col-xs-3">
                                <select class="form-control" id="stu_ethnicity" name="stu_ethnicity" value="<?php if (isset($_POST['stu_ethnicity'])) echo $_POST['stu_ethnicity'];?>" data-error="Please select the student's ethnicity" required>
                                    <option disabled selected value> -- select an option -- </option>
                                    <?php
                                        $selected = $stu_ethnicity;
                                        $ethnicities = array("American Indian/Alaska Native", "Asian", "Black/African American", "Hispanic/Latino", "Native Hawaiian/Other Pacific Islander", "White", "Other");
                                        // $ethnicities = array("Mixed Race", "Arctic (Siberian, Eskimo)", "Caucasian (European)", "Caucasian (Indian)", "Caucasian (Middle East)", "Caucasian (North African, Other)", "Indigenous Australian", "Native American", "North East Asian (Mongol, Tibetan, Korean, Japanese, etc)", "Pacific (Polynesian, Micronesian, etc)", "South East Asian (Chinese, Thai, Malay, Filipino, etc)", "West African, Bushmen, Ethiopian", "Other Race");
                                        foreach($ethnicities as $ethnicity){
                                            if($selected == $ethnicity){
                                                echo "<option selected='selected' value='$ethnicity'>$ethnicity</option>" ;
                                            }else{
                                                echo "<option value='$ethnicity'>$ethnicity</option>" ;
                                            }
                                        }                                  
                                    ?>
                                </select>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label" for="stu_dob">Birthdate*</label>
                            <div class="col-xs-3">
                                <input type="date" class="form-control" id="stu_dob" name="stu_dob" value="<?php echo $stu_dob; ?>" data-error="Please enter the student's birthdate" required>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label"></label>
                            <div class="col-xs-5">
                                <h3>Education</h3>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label" for="sel1">Highest Education Level*</label>
                            <div class="col-xs-2">
                                <select class="form-control" name="stu_edu_lvl" name="stu_edu_lvl" value="<?php if (isset($_POST['stu_edu_lvl'])) echo $_POST['stu_edu_lvl'];?>" data-error="Please select the student's education level" required>
                                    <option disabled selected value> -- select an option -- </option>
                                    <?php
                                        $selected = $stu_edu_lvl;
                                        $levels = array("Doctors", "Masters", "Bachelors", "Associates", "Some four year college", "Some two year college", "High School", "None", "Other");
                                        foreach($levels as $level){
                                            if($selected == $level){
                                                echo "<option selected='selected' value='$level'>$level</option>" ;
                                            }else{
                                                echo "<option value='$level'>$level</option>" ;
                                            }
                                        }
                                    ?>
                              </select>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label" for="sel1">Transcript Received*</label>
                            <div class="col-xs-2">
                                <select class="form-control" id="sel1" name="stu_transcript" id="stu_transcript" value="<?php if (isset($_POST['stu_transcript'])) echo $_POST['stu_transcript'];?>" data-error="Please selectt if the student's transcript was received" required>
                                    <option disabled selected value> -- select an option -- </option>
                                    <option <?php if($stu_transcript == 'College') echo 'selected="selected"' ?>>College</option>
                                    <option <?php if($stu_transcript == 'High School') echo 'selected="selected"' ?>>High School</option>
                                    <option <?php if($stu_transcript == 'None') echo 'selected="selected"' ?>>None</option>
                              </select>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label"></label>
                            <div class="col-xs-5">
                                <h3>Contact & Employer</h3>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Email 1*</label>
                            <div class="col-xs-4">
                                <input type="email" class="form-control" maxlength="255" name="stu_email_1" id="stu_email_1" value="<?php if (isset($_POST['stu_email_1'])) echo $_POST['stu_email_1']; else echo $stu_email_1;?>" data-error="Please enter the student's first email with the @ symbol" required>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Email 2</label>
                            <div class="col-xs-4">
                                <input type="email" class="form-control" maxlength="255" name="stu_email_2" id="stu_email_2" value="<?php if (isset($_POST['stu_email_2'])) echo $_POST['stu_email_2']; else echo $stu_email_2;?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Phone*</label>
                            <div class="col-xs-3">
                                <input type="text" onkeypress="return isNumberKey(event)" maxlength="20" placeholder="1234567890" class="form-control" name="stu_phone" id="stu_phone" value="<?php if (isset($_POST['stu_phone'])) echo $_POST['stu_phone']; else echo $stu_phone;?> " data-error="Please enter the student's phone number" required>
                            </div>
                            <div class="help-block with-errors"></div>
                            <!--Only allows numbers for input-->
                            <script>
                                function isNumberKey(evt){
                                    var charCode = (evt.which) ? evt.which : event.keyCode
                                    if (charCode > 31 && (charCode < 48 || charCode > 57))
                                        return false;
                                    return true;
                                }
                            </script>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Employer</label>
                            <div class="col-xs-3">
                                <select class="form-control" id="emp_name" name="emp_name" value="<?php if (isset($_POST['emp_name'])) echo $_POST['emp_name'];?>">
                                <option disabled selected value>-- select an option --</option>
                                <option>None</option>;
                                <option disabled selected value>---------</option>
                                <?php
                                    require('includes/connect_db_c9.php');
                                    $query = 'SELECT EMP_NAME FROM EMPLOYER ORDER BY EMP_NAME';
	                                $results = mysqli_query($dbc, $query);
	                                if($results){
	                                    while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
                                		{
                                		    //getting the employer name from the id
                                		    $empquery = 'SELECT EMP_NAME FROM EMPLOYER WHERE EMP_ID = ' . $emp_id;
                                		    $empresults = mysqli_query($dbc, $empquery);
                                		    $emprow = mysqli_fetch_array( $empresults , MYSQLI_ASSOC );
                                		    $selected = $emprow [ 'EMP_NAME' ] ;
                                		    if($selected == $row['EMP_NAME']){
                                			    echo "<option selected='selected'>" . $row['EMP_NAME'] . "</option>" ;
                                		    }
                                		    else{
                                		        echo '<option>' . $row['EMP_NAME'] . '</option>' ;
                                		    }
                                		}
	                                }
	                                else
                                	{
                                		echo '<p>' . mysqli_error( $dbc ) . '</p>'  ;
                                	}
                                	# Free up the results in memory
                                	mysqli_free_result( $results );
                                	mysqli_close( $dbc ) ;
                                ?>
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>
                            <button class="btn btn-default" type="button" onclick="location.href='edit_student_employer_add.php';">Add an Employer</button>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Job Title</label>
                            <div class="col-xs-3">
                                <input type="text" class="form-control" id = "stu_job_title" name="stu_job_title" value="<?php if (isset($_POST['stu_job_title'])) echo $_POST['stu_job_title']; else echo $stu_job_title?>")>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label"></label>
                            <div class="col-xs-5">
                                <h3>Enrollment Information</h3>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label" for="stu_start">Start Date*</label>
                            <div class="col-xs-3">
                                <input type="date" class="form-control" id="stu_start" value="<?php echo $stu_start ?>" name="stu_start" data-error="Please select the student's start date" required>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label" for="stu_end">End Date</label>
                            <div class="col-xs-3">
                                <input type="date" class="form-control" id="stu_end" value="<?php echo $stu_end ?>" name="stu_end">
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label"></label>
                            <div class="col-xs-5">
                                <h3>Miscellaneous</h3>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label" for="sel1">Qualifying Exam*</label>
                            <div class="col-xs-2">
                                <select class="form-control" id="sel1" name="stu_qualify_exam" value="<?php if (isset($_POST['stu_qualify_exam'])) echo $_POST['stu_qualify_exam'];?>" data-error="Please select if the student has passed a qualifying exam" required>
                                    <option disabled selected value>-- select an option --</option>
                                    <option <?php if($stu_qualify_exam == 'Yes') echo "selected='selected'" ?>>Yes</option>
                                    <option <?php if($stu_qualify_exam == 'No') echo "selected='selected'" ?>>No</option>
                              </select>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Comment</label>
                            <div class="col-xs-5">
                                <input type="text" class="form-control" maxlength="255" name="stu_comment" value="<?php if (isset($_POST['stu_comment'])) echo $_POST['stu_comment']; else echo $stu_comment;?>")>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-5 col-xs-offset-3">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-5">
                                 <button class="btn btn-default" type="button" onclick ="location.href='student_profile_detail.php';">Back to Profile</button>
                            </div>
                        </div>
                    </form>
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
    <!-- Validator Bootstrap Plugin-->
    <script src="js/validator.js"></script>
</body>
</html>
