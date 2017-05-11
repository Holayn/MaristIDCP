<?php

$debug = true;

$p = strtoupper($_GET['p']);

require('includes/connect_db_c9.php');

mysqli_select_db($dbc,"ajax_demo");

if(isset($p)){
$query ="SELECT * FROM ".$p."";
$results = mysqli_query($dbc,$query);

$field_name = array("STU_ID"=>"Student ID","STU_TAG"=>"Tag", "STU_LNAME"=>"Last Name", "STU_FNAME"=>"First Name", "STU_INITIAL"=>"Initial", 
"STU_YR_START"=>"Year Started", "STU_MON_START"=>"Month Started", "STU_DAY_START"=>"Day Started", "STU_YR_END"=>"Year Ended", "STU_MON_END"=>"Month Ended", "STU_DAY_END"=>"Day Ended",
"STU_EDU_LVL"=>"Education Level", "STU_JOB_TITLE"=>"Job Title", "STU_STREET"=>"Street Address", "STU_CITY"=>"City", "STU_STATE"=>"State", "STU_COUNTRY"=>"Country", "STU_ZIP"=>"Zip Code",
"STU_PHONE"=>"Phone", "STU_EMAIL_1"=>"Email 1", "STU_EMAIL_2"=>"Email 2", "STU_YR_DOB"=>"Year of Birth", "STU_MON_DOB"=>"Month of Birth", "STU_DAY_DOB"=>"Day of Birth", 
"STU_ETHNICITY"=>"Ethnicity", "STU_CITY"=>"City", "STU_GENDER"=>"Gender", "STU_CITIZEN"=>"Citizenship", "STU_TRANSCRIPT"=>"Transcript", "STU_COMMENT"=>"Comment", 
"CERT_ID"=>"Certificate ID", "CERT_NAME"=>"Name", "INS_ID"=>"Instructor ID", "INS_LNAME"=>"Last Name", "INS_INITIAL"=>"Initial", "INS_FNAME"=>"First Name", "INS_EMAIL"=>"Email", 
"CRS_ID"=>"Course ID", "CRS_NAME"=>"Name", "CRS_LEVEL"=>"Level", "PRG_ID"=>"Program ID", "PRG_NAME"=>"Name", "EMP_ID"=>"Employer ID", "EMP_NAME"=>"Name", "EMP_EMAIL"=>"Email", "EMP_PHONE"=>"Phone");

echo "<label>about:</label>";
echo $sql;
echo "<select class=\"form-control\" name=\"field\" value=\"<?php if (isset(\$_POST[\'field\'])) echo \$_POST[\'field\'];?>\" onchange=\"showOption(this.value)\" data-error=\"Please enter the certificate id\" required>";
echo '<option disabled selected value>---</option>';
    if($results){
		while ($field=mysqli_fetch_field($results)){
		{
			echo '<option value="'.$field->name.'">'.$field_name[$field->name].'</option>';
			}
		}
    }
    else
	{
		echo '<p>' . mysqli_error( $dbc ) . '</p>'  ;
	}
echo "</select>";
}
else 
	echo "Error";

?>