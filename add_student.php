<!--Form for adding a new student-->
<?php
        $title = "IDCP - Add a Student";
        $page = 'student';
        $page_name= 'add_stu';
        require("includes/header.php");
        # Connect to MySQL server and the database
        require( 'includes/connect_db_c9.php' ) ;
        # Includes these helper functions
        require( 'includes/student_helpers.php' ) ;
        # Check to make sure it is the first time user is visiting the page
        if ($_SERVER['REQUEST_METHOD'] == 'GET'){
            if(isset($_SESSION['STU_ID'])){
                $page = 'edit_student.php';
        		header("Location: $page");
            }
        	$stu_id = "";
        	$stu_tag = "";
        	$stu_fname = "";
        	$stu_lname = "";
        	$stu_initial = "";
        	$stu_gender = "";
        	$stu_citizen = "";
        	$stu_street = "";
        	$stu_city = "";
        	$stu_zip = "";
        	$stu_country = "";
        	$stu_ethnicity = "";
        	$stu_dob = "";
        	$stu_edu_lvl = "";
        	$stu_transcript = "";
        	$stu_email_1 = "";
        	$stu_email_2 = "";
        	$stu_phone = "";
        	$stu_start = "";
        	$stu_comment = "";
        	$stu_qualify_exam = "";
        	$emp_id = "";
        	$stu_job_title = "";
        	$stu_state = "";
        	
        	//Regular user cannot access this page
            if($user_role == "User"){
                $page = 'home.php';
                header("Location: $page");
            }
        }
        # Check to make sure the form method is post
        if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
        	$stu_id = mysqli_real_escape_string($dbc, trim($_POST['stu_id']));
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
        	$stu_comment = mysqli_real_escape_string($dbc, trim($_POST['stu_comment']));
        // 	$emp_id = mysqli_real_escape_string($dbc, trim($_POST['emp_name']));
        	$stu_job_title = mysqli_real_escape_string($dbc, trim($_POST['stu_job_title']));
        	$stu_state = mysqli_real_escape_string($dbc, trim($_POST['stu_state']));
        	if(!isset($_POST['stu_state'])) $stu_state = NULL;
    	        else $stu_state = $_POST['stu_state'];
        	if($stu_state ==  "--"){
        	    $stu_state = "";
        	}
        	$stu_qualify_exam = $_POST['stu_qualify_exam'];
        	//ID is stored in DB, not the name. Also need to populate dropdown with employer names
        	if(!isset($_POST['emp_name'])) $emp_id = "NULL";
    	        else $emp_id = $_POST['emp_name'];
        	if($emp_id == "None" || $emp_id=="NULL"){
        	    $emp_id = "NULL";
        	    echo "<script>alert('$emp_id')</script>";
        	}
        	else{
        	    $emp_id = get_employer_id($dbc, $emp_id);
        	}
            //Converting date to YYYY-MM-DD format
            $stu_dob = date('Y-m-d', strtotime($stu_dob));
            $stu_start = date('Y-m-d', strtotime($stu_start));
    		$result = add_new_student_record($dbc, $stu_id, $stu_tag, $stu_lname, $stu_fname, $stu_initial, $stu_start, $stu_edu_lvl, $stu_job_title, $stu_street, $stu_city, $stu_state, $stu_country, $stu_zip, $stu_phone, $stu_email_1, $stu_email_2, $stu_dob, $stu_ethnicity, $stu_gender, $stu_citizen, $stu_transcript, $stu_comment, $stu_qualify_exam, $emp_id);
    		//Handling duplicates
    		if(mysqli_errno($dbc) == 1062) {
    		    $query = "SELECT * FROM STUDENT WHERE STU_ID = $stu_id";
            	$results = mysqli_query($dbc, $query);
            	if(mysqli_num_rows( $results ) != 0 ){
        	    ?>
            <div class="alert alert-danger alert-dismissible" role="alert" style="margin-top: 20px">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Error!</strong> This student id already exists. Please enter a different one.
            </div>
                <?php
            	}
            	else{
            	   // echo '<script>alert("The student tag entered already exists! Please try again")</script>';
            	}
            }
		    else{
                echo "Success! Thanks" ; 
                //Passes student ID to next page    		
                $page = 'add_student_program.php';
                $_SESSION['stu_id'] = $stu_id;
                $_SESSION['STU_ID'] = $stu_id;
    	        $_SESSION['addedCourse'] = false;
    	        $_SESSION['addedProgram'] = false;
        		header("Location: $page");
        		exit();
            }
        }
        # Close the connection
        mysqli_close( $dbc ) ;
        ?>
<!--Keeps user input on reload.-->
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
        if (sessionStorage.getItem("stu_comment") !== null) document.getElementById("stu_comment").value = sessionStorage.getItem("stu_comment");
        if (sessionStorage.getItem("stu_qualify_exam") !== null) document.getElementById("stu_qualify_exam").value = sessionStorage.getItem("stu_qualify_exam");
    }
</script>
    <!-- Bread Crumbs -->
    <ol class = "breadcrumb">
    <li><a href = "home.php">Home</a></li>
    <li><a href = "student.php">Student</a></li>
    <li class = "active">Add Student</li>
    </ol>
<!-- Page Content -->
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="dropdown">
            <div class="page-header">
                <h1>Add a Student</h1>
            </div>
            <form action="add_student.php" method="POST" class="form-horizontal" role="form" data-toggle="validator" id="student_form">
                <div class="form-group">
                    <label class="col-xs-3 control-label"></label>
                    <div class="col-xs-5">
                        <h3>Identification</h3>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label">ID*</label>
                    <div class="col-xs-2">
                        <input type="text" class="form-control" maxlength="8" onkeypress="return isNumberKey(event)" pattern="^[0-9]{1,}$" id="stu_id" name="stu_id" value="<?php if (isset($_POST['stu_id'])) echo $_POST['stu_id'];?>" data-error="Please enter a student ID. Max-length: 8 digits" required>
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label">Tag</label>
                    <div class="col-xs-2">
                        <input type="text" class="form-control" maxlength="8" onkeypress="return isNumberKey(event)" pattern="^[0-9]{1,}$" id="stu_tag" name="stu_tag" value="<?php if (isset($_POST['stu_tag'])) echo $_POST['stu_tag'];?>" data-error="Please enter a student tag. Max-length: 8 digits">
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label">First Name*</label>
                    <div class="col-xs-3">
                        <input type="text" class="form-control" maxlength="255" id="stu_fname" name="stu_fname" value="<?php if (isset($_POST['stu_fname'])) echo $_POST['stu_fname'];?>" data-error="Please enter the student's first name" required>
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label">Last Name*</label>
                    <div class="col-xs-3">
                        <input type="text" class="form-control" maxlength="255" id="stu_lname" name="stu_lname" value="<?php if (isset($_POST['stu_lname'])) echo $_POST['stu_lname'];?>" data-error="Please enter the student's last name" required>
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label">Initial</label>
                    <div class="col-xs-1">
                        <input type="text" class="form-control" maxlength="1" id="stu_initial" name="stu_initial" value="<?php if (isset($_POST['stu_initial'])) echo $_POST['stu_initial'];?>">
                        <!--<input type="text" class="form-control" name="stu_initial" value="<?php if (isset($_POST['stu_initial'])) echo $_POST['stu_initial'];?>" data-error="Please enter the student's initial" required>-->
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label">Gender*</label>
                    <div class="col-xs-2">
                        <select class="form-control" id="stu_gender" name="stu_gender" value="<?php if (isset($_POST['stu_gender'])) echo $_POST['stu_gender'];?>" data-error="Please select the student's gender" required>
                            <option disabled selected value> -- select an option -- </option>
                            <option value="Female">Female</option>
                            <option value="Male">Male</option>
                        </select>
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label">U.S. Citizen*</label>
                    <div class="col-xs-2">
                        <select class="form-control" id="stu_citizen" name="stu_citizen" value="<?php if (isset($_POST['stu_citizen'])) echo $_POST['stu_citizen'];?>" data-error="Please select if the student is a U.S. citizen" required>
                            <option disabled selected value> -- select an option -- </option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label">Street Address*</label>
                    <div class="col-xs-4">
                        <input type="text" class="form-control" maxlength="255" id="stu_street" name="stu_street" value="<?php if (isset($_POST['stu_street'])) echo $_POST['stu_street'];?>" data-error="Please enter the student's street address" required>
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label">City*</label>
                    <div class="col-xs-3">
                        <input type="text" class="form-control" maxlength="255" id="stu_city" name="stu_city" value="<?php if (isset($_POST['stu_city'])) echo $_POST['stu_city'];?>" data-error="Please enter the student's city" required>
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label" for="stu_state">State</label>
                    <div class="col-xs-3">
                        <select class="form-control" id="stu_state" name="stu_state" value="<?php if (isset($_POST['stu_state'])) echo $_POST['stu_state'];?>" data-error="Please select the student's state">
                            <option>--</option>
                            <option value="AL">Alabama</option>
                        	<option value="AK">Alaska</option>
                        	<option value="AZ">Arizona</option>
                        	<option value="AR">Arkansas</option>
                        	<option value="CA">California</option>
                        	<option value="CO">Colorado</option>
                        	<option value="CT">Connecticut</option>
                        	<option value="DE">Delaware</option>
                        	<option value="DC">District Of Columbia</option>
                        	<option value="FL">Florida</option>
                        	<option value="GA">Georgia</option>
                        	<option value="HI">Hawaii</option>
                        	<option value="ID">Idaho</option>
                        	<option value="IL">Illinois</option>
                        	<option value="IN">Indiana</option>
                        	<option value="IA">Iowa</option>
                        	<option value="KS">Kansas</option>
                        	<option value="KY">Kentucky</option>
                        	<option value="LA">Louisiana</option>
                        	<option value="ME">Maine</option>
                        	<option value="MD">Maryland</option>
                        	<option value="MA">Massachusetts</option>
                        	<option value="MI">Michigan</option>
                        	<option value="MN">Minnesota</option>
                        	<option value="MS">Mississippi</option>
                        	<option value="MO">Missouri</option>
                        	<option value="MT">Montana</option>
                        	<option value="NE">Nebraska</option>
                        	<option value="NV">Nevada</option>
                        	<option value="NH">New Hampshire</option>
                        	<option value="NJ">New Jersey</option>
                        	<option value="NM">New Mexico</option>
                        	<option value="NY">New York</option>
                        	<option value="NC">North Carolina</option>
                        	<option value="ND">North Dakota</option>
                        	<option value="OH">Ohio</option>
                        	<option value="OK">Oklahoma</option>
                        	<option value="OR">Oregon</option>
                        	<option value="PA">Pennsylvania</option>
                        	<option value="RI">Rhode Island</option>
                        	<option value="SC">South Carolina</option>
                        	<option value="SD">South Dakota</option>
                        	<option value="TN">Tennessee</option>
                        	<option value="TX">Texas</option>
                        	<option value="UT">Utah</option>
                        	<option value="VT">Vermont</option>
                        	<option value="VA">Virginia</option>
                        	<option value="WA">Washington</option>
                        	<option value="WV">West Virginia</option>
                        	<option value="WI">Wisconsin</option>
                        	<option value="WY">Wyoming</option>
                        </select>
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label">ZIP*</label>
                    <div class="col-xs-2">
                        <input type="text" class="form-control" maxlength="32" id="stu_zip" name="stu_zip" value="<?php if (isset($_POST['stu_zip'])) echo $_POST['stu_zip'];?>" data-error="Please enter the student's ZIP code" required>
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label" for="stu_country">Country*</label>
                    <div class="col-xs-3">
                        <select class="form-control" id="stu_country" name="stu_country" value="<?php if (isset($_POST['stu_country'])) echo $_POST['stu_country'];?>" data-error="Please select the student's country" required>
                            <option disabled selected value> -- select an option -- </option>
                            <?php 
                            $countries = array("Afghanistan", "Åland Islands", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
                                foreach($countries as $country){
                                    echo "<option value='$country'>$country</option>" ;
                                }    
                            ?>
                      </select>
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label" for="stu_ethnicity">Race/Ethnicity*</label>
                    <div class="col-xs-3">
                        <select class="form-control" id="stu_ethnicity" name="stu_ethnicity" value="<?php if (isset($_POST['stu_ethnicity'])) echo $_POST['stu_ethnicity'];?>" data-error="Please select the student's ethnicity" required>
                            <option disabled selected value> -- select an option -- </option>
                            <?php
                                $ethnicities = array("American Indian/Alaska Native", "Asian", "Black/African American", "Hispanic/Latino", "Native Hawaiian/Other Pacific Islander", "White", "Other");
                                // $ethnicities = array("Mixed Race", "Arctic (Siberian, Eskimo)", "Caucasian (European)", "Caucasian (Indian)", "Caucasian (Middle East)", "Caucasian (North African, Other)", "Indigenous Australian", "Native American", "North East Asian (Mongol, Tibetan, Korean, Japanese, etc)", "Pacific (Polynesian, Micronesian, etc)", "South East Asian (Chinese, Thai, Malay, Filipino, etc)", "West African, Bushmen, Ethiopian", "Other Race");
                                foreach($ethnicities as $ethnicity){
                                        echo "<option value='$ethnicity'>$ethnicity</option>" ;
                                }                                  
                            ?>
                        </select>
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label" for="stu_dob">Birthdate*</label>
                    <div class="col-xs-3">
                        <input type="date" class="form-control" id="stu_dob" name="stu_dob" data-error="Please enter the student's birthdate" required>
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
                    <label class="col-xs-3 control-label" for="stu_edu_lvl">Highest Education Level*</label>
                    <div class="col-xs-2">
                        <select class="form-control" id="stu_edu_lvl" name="stu_edu_lvl" value="<?php if (isset($_POST['stu_edu_lvl'])) echo $_POST['stu_edu_lvl'];?>" data-error="Please select the student's education level" required>
                            <option disabled selected value> -- select an option -- </option>
                            <?php
                                $levels = array("Doctors", "Masters", "Bachelors", "Associates", "Some four year college", "Some two year college", "High School", "None", "Other");
                                foreach($levels as $level){
                                    echo "<option value='$level'>$level</option>" ;
                                }
                            ?>
                      </select>
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label" for="stu_transcript">Transcript Received*</label>
                    <div class="col-xs-2">
                        <select class="form-control" id="stu_transcript" name="stu_transcript" value="<?php if (isset($_POST['stu_transcript'])) echo $_POST['stu_transcript'];?>" data-error="Please select if the student's transcript was received" required>
                            <option disabled selected value> -- select an option -- </option>
                            <option>College</option>
                            <option>High School</option>
                            <option>None</option>
                      </select>
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label"></label>
                    <div class="col-xs-5">
                        <h3>Contact & Employer</h3>
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label">Email 1*</label>
                    <div class="col-xs-4">
                        <input type="email" class="form-control" maxlength="255" id="stu_email_1" name="stu_email_1" value="<?php if (isset($_POST['stu_email_1'])) echo $_POST['stu_email_1'];?>" data-error="Please enter the student's first email with the @ symbol" required>
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label">Email 2</label>
                    <div class="col-xs-4">
                        <input type="email" class="form-control" maxlength="255" id="stu_email_2" name="stu_email_2" value="<?php if (isset($_POST['stu_email_2'])) echo $_POST['stu_email_2'];?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label">Phone*</label>
                    <div class="col-xs-3">
                        <input type="text" onkeypress="return isNumberKey(event)" maxlength="20" pattern="^[0-9]{1,}$" id="stu_phone" placeholder="1234567890" class="form-control" name="stu_phone" value="<?php if (isset($_POST['stu_phone'])) echo $_POST['stu_phone'];?>" data-error="Please enter the student's phone number" required>
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
                        			echo '<option>' . $row['EMP_NAME'] . '</option>' ;
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
                    <button class="btn btn-default" type="button" onclick="location.href='student_employer_add.php';">Add an Employer</button>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label">Job Title</label>
                    <div class="col-xs-3">
                        <input type="text" class="form-control" maxlength="255" id="stu_job_title" name="stu_job_title" value="<?php if (isset($_POST['stu_job_title'])) echo $_POST['stu_job_title'];?>">
                        <!--<input type="text" class="form-control" name="stu_job_title" value="<?php if (isset($_POST['stu_job_title'])) echo $_POST['stu_job_title'];?>" data-error="Please enter the student's job title" required>-->
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label"></label>
                    <div class="col-xs-5">
                        <h3>Time of Enrollment</h3>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label" for="stu_start">Start Date*</label>
                    <div class="col-xs-3">
                        <input type="date" class="form-control" id="stu_start" name="stu_start" data-error="Please select the student's start date" required>
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
                        <select class="form-control" id="stu_qualify_exam" name="stu_qualify_exam" value="<?php if (isset($_POST['stu_qualify_exam'])) echo $_POST['stu_qualify_exam'];?>" data-error="Please select if the student has passed a qualifying exam" required>
                            <option disabled selected value>-- select an option --</option>
                            <option>Yes</option>
                            <option>No</option>
                      </select>
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label">Comment</label>
                    <div class="col-xs-5">
                        <input type="text" class="form-control" maxlength="255" id="stu_comment" name="stu_comment" value="<?php if (isset($_POST['stu_comment'])) echo $_POST['stu_comment'];?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-5 col-xs-offset-3">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </div>
                <div class="form-group">
                        <div class="col-xs-5">
                             <button class="btn btn-default" type="button" onclick ="location.href='student.php';">Back to Student Home</button>
                        </div>
                    </div>
            </form>
            </div>
            <!-- dropdown -->
        </div>
        <!-- /#container -->
    </div>
    <!-- /#page-content-wrapper -->
<!--Footer-->
<?php require('includes/footer.php'); ?>
</div>
<!-- /#wrapper-->
<!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Validator Bootstrap Plugin-->
    <script src="js/validator.js"></script>
</body>
</html>