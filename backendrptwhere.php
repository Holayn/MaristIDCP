<?php

$debug = true;

$q = $_GET['q'];

require('includes/connect_db_c9.php');

mysqli_select_db($dbc,"ajax_demo");

$field_name = array("PROGRAM"=>"PRG_NAME", "COURSE"=>"CRS_NAME", "CERTIFICATE"=>"CERT_NAME", "EMPLOYER"=>"EMP_NAME", "STU_ID"=>"Student ID","STU_TAG"=>"Tag", "STU_LNAME"=>"Last Name", "STU_FNAME"=>"First Name", "STU_INITIAL"=>"Initial", 
"STU_YR_START"=>"Year Started", "STU_MON_START"=>"Month Started", "STU_DAY_START"=>"Day Started", "STU_YR_END"=>"Year Ended", "STU_MON_END"=>"Month Ended", "STU_DAY_END"=>"Day Ended",
"STU_EDU_LVL"=>"Education Level", "STU_JOB_TITLE"=>"Job Title", "STU_STREET"=>"Street Address", "STU_CITY"=>"City", "STU_STATE"=>"State", "STU_COUNTRY"=>"Country", "STU_ZIP"=>"Zip Code",
"STU_PHONE"=>"Phone", "STU_EMAIL_1"=>"Email 1", "STU_EMAIL_2"=>"Email 2", "STU_YR_DOB"=>"Year of Birth", "STU_MON_DOB"=>"Month of Birth", "STU_DAY_DOB"=>"Day of Birth", 
"STU_ETHNICITY"=>"Ethnicity", "STU_CITY"=>"City", "STU_GENDER"=>"Gender", "STU_CITIZEN"=>"Citizenship", "STU_TRANSCRIPT"=>"Transcript", "STU_COMMENT"=>"Comment", 
"CERT_ID"=>"Certificate ID", "CERT_NAME"=>"Name", "MAIL_YR"=>"Year Mailed", "MAIL_MON"=>"Month Mailed", "MAIL_DAY"=>"Day Mailed", "EARN_YR"=>"Year Earned", "EARN_MON"=>"Month Earned", "EARN_DAY"=>"Day Earned","INS_ID"=>"Instructor ID", "INS_LNAME"=>"Last Name", "INS_INITIAL"=>"Initial", "INS_FNAME"=>"First Name", "INS_EMAIL"=>"Email", 
"CRS_ID"=>"Course ID", "CRS_NAME"=>"Name", "CRS_LEVEL"=>"Level", "PRG_ID"=>"Program ID", "PRG_NAME"=>"Name", "EMP_ID"=>"Employer ID", "EMP_NAME"=>"Name", "EMP_EMAIL"=>"Email", "EMP_PHONE"=>"Phone");

if(isset($q)){
	$q = explode(".", $q);
	$query ="SELECT DISTINCT ".$q[0]." FROM ".strtoupper($q[1])."";
	$results = mysqli_query($dbc,$query);
	
	echo "<label>specifically:</label>";
	echo $query;
	echo "<select class=\"form-control\" name=\"spec\" value=\"<?php if (isset(\$_POST[\'spec\'])) echo \$_POST[\'spec\'];?>\" data-error=\"Please enter the certificate id\" required>";
	echo "<option disabled selected value>---</option>";
	    if($results){
	        while ($row = mysqli_fetch_array($results,MYSQLI_NUM))
			{
				$row_id = 0;
				while ($row_id < count($row)){
					echo '<option>'.$row[$row_id].'</option>';
					$row_id++;
				}
			}
	    }
	    else
		{
			echo '<p>' . mysqli_error( $dbc ) . '</p>'  ;
		}
	echo "</select>";
	mysqli_close($dbc);
}
else
	echo "Error";
?>
 