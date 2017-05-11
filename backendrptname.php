<?php

$debug = true;

$p = strtoupper($_GET['p']);

require('includes/connect_db_c9.php');
require('includes/report_helpers.php');

mysqli_select_db($dbc,"ajax_demo");

$field_name = array("PROGRAM"=>"PRG_NAME", "COURSE"=>"CRS_NAME", "CERTIFICATE"=>"CERT_NAME", "EMPLOYER"=>"EMP_NAME", "STU_ID"=>"Student ID","STU_TAG"=>"Tag", "STU_LNAME"=>"Last Name", "STU_FNAME"=>"First Name", "STU_INITIAL"=>"Initial", 
"STU_YR_START"=>"Year Started", "STU_MON_START"=>"Month Started", "STU_DAY_START"=>"Day Started", "STU_YR_END"=>"Year Ended", "STU_MON_END"=>"Month Ended", "STU_DAY_END"=>"Day Ended", "STU_EDU_LVL"=>"Education Level", "STU_JOB_TITLE"=>"Job Title", "STU_STREET"=>"Street Address", "STU_CITY"=>"City", "STU_STATE"=>"State", "STU_COUNTRY"=>"Country", "STU_ZIP"=>"Zip Code",
"STU_PHONE"=>"Phone", "STU_EMAIL_1"=>"Email 1", "STU_EMAIL_2"=>"Email 2", "STU_YR_DOB"=>"Year of Birth", "STU_MON_DOB"=>"Month of Birth", "STU_DAY_DOB"=>"Day of Birth", "STU_ETHNICITY"=>"Ethnicity", "STU_CITY"=>"City", "STU_GENDER"=>"Gender", "STU_CITIZEN"=>"Citizenship", "STU_TRANSCRIPT"=>"Transcript", "STU_COMMENT"=>"Comment", 
"CERT_ID"=>"Certificate ID", "CERT_NAME"=>"Name", "MAIL_YR"=>"Year Mailed", "MAIL_MON"=>"Month Mailed", "MAIL_DAY"=>"Day Mailed", "EARN_YR"=>"Year Earned", "EARN_MON"=>"Month Earned", "EARN_DAY"=>"Day Earned","INS_ID"=>"Instructor ID", "INS_LNAME"=>"Last Name", "INS_INITIAL"=>"Initial", "INS_FNAME"=>"First Name", "INS_EMAIL"=>"Email", 
"CRS_ID"=>"Course ID", "CRS_NAME"=>"Name", "CRS_LEVEL"=>"Level", "CRS_ENROLL_YR_START"=>"Year Enrolled", "CRS_ENROLL_YR_END"=>"Year Ended", "PRG_ID"=>"Program ID","STU_QUALIFY_EXAM"=>"Exam Qualification", "PRG_NAME"=>"Name", "PRG_ENROLL_YR_START"=>"Year Enrolled", "PRG_ENROLL_YR_END"=>"Year Ended", "EMP_ID"=>"Employer ID", "EMP_NAME"=>"Name", "EMP_EMAIL"=>"Email", "EMP_PHONE"=>"Phone");

	if(isset($p)){
	$query ="SELECT $field_name[$p] FROM $p ORDER BY $field_name[$p]";
	$results = mysqli_query($dbc,$query);
	global $field_name;
	
	echo "<div class='form-group'>";
	echo "<label class='col-xs-3 control-label'> Name*: </label>";
	echo "<div class='col-xs-4'>";
	echo "<select class='form-control' name='ent_name' data-error='Please choose a field' required>";
	echo '<option disabled selected value>-- select an option --</option>';
	echo "<option value='all'>All</option>";
	echo "<option disabled role=separator>─────────────────────────</option>";

	    if($results){
			while ($row = mysqli_fetch_array($results, MYSQLI_ASSOC))
			{
				echo '<option value="'.$row[$field_name[$p]].'">'.$row[$field_name[$p]].'</option>';
				}
	    }
	    else
		{
			echo '<p>' . mysqli_error( $dbc ) . '</p>'  ;
		}
	echo "</select>";
	echo "</div>";
	echo "<div class='help-block with-errors'></div>";
	echo "</div>";
	echo "<div class='form-group'>";
    echo "<label class='col-xs-3 control-label'>Where*:</label>";
    echo "<div class='col-xs-4'>";
    echo "<select class='form-control' id='where1' name='where' data-error='Please choose a field' required>";
    echo "<option disabled selected value>-- select an option --</option>";
    populate_demographic($dbc);
    if($p == 'PROGRAM'){
    	echo "<option value='PRG_ENROLL_START'>Year Enrolled</option>";
    	echo "<option value='PRG_ENROLL_END'>Year Ended</option>";
    	echo "<option value='EMP_NAME'>Employer</option>";
    }
    elseif($p == 'COURSE'){
    	echo "<option value='CRS_ENROLL_START'>Year Enrolled</option>";
    	echo "<option value='CRS_ENROLL_END'>Year Completed</option>";
    	echo "<option value='GRADE'>Grade</option>";
    	echo "<option value='EMP_NAME'>Employer</option>";
    }
    elseif($p == 'CERTIFICATE'){
    	echo "<option value='EARN_DATE'>Year Earned</option>";
    	echo "<option value='MAIL_DATE'>Year Mailed</option>";
    	echo "<option value='EMP_NAME'>Employer</option>";
    }
	echo "</select>";
	echo "</div>";
	echo "<div class='help-block with-errors'></div>";
	echo "</div>";
	echo "<div class='form-group'>";
	echo "<label class='col-xs-3 control-label'>Specific:*</label>";
	echo "<div class='col-xs-4'>";
	echo "<input id='spec1' type='text' class='form-control' name='spec' data-error='Please enter the specification' required>";
	echo "</div>";
	echo "<div class='help-block with-errors'></div>";
	echo "</div>";
	}
	else {
		echo "Error";
	}
		mysqli_free_result( $results );
		mysqli_close( $dbc ) ;
?>