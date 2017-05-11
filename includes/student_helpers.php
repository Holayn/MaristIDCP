<?php
$debug = true;

#Deprecated. Just use header() to redirect to pages and start the session on every page.
function load($page = 'add_student.php', $stu_id = -1){
	session_start();
	header("Location: $page");
	$_SESSION['stu_id'] = $stu_id;
	$_SESSION['addedCourse'] = false;
	exit();
}

function loadSearch($page = 'add_student.php', $stu_id = -1){
	session_start();
	header("Location: $page");
	$_SESSION['stu_id'] = $stu_id;
	exit();
}

# Adds a new student to a program
function add_new_student_record($dbc, $stu_id, $stu_tag, $stu_lname, $stu_fname, $stu_initial, $stu_start, $stu_edu_lvl, $stu_job_title, $stu_street, $stu_city, $stu_state, $stu_country, $stu_zip, $stu_phone, $stu_email_1, $stu_email_2, $stu_dob, $stu_ethnicity, $stu_gender, $stu_citizen, $stu_transcript, $stu_comment, $stu_qualify_exam, $emp_id) {
  $query = 'INSERT INTO STUDENT(STU_ID, STU_TAG, STU_LNAME, STU_FNAME, STU_INITIAL, STU_START, STU_EDU_LVL, STU_JOB_TITLE, STU_STREET, STU_CITY, STU_STATE, STU_COUNTRY, STU_ZIP, STU_PHONE, STU_EMAIL_1, STU_EMAIL_2, STU_DOB, STU_ETHNICITY, STU_GENDER, STU_CITIZEN, STU_TRANSCRIPT, STU_COMMENT, STU_QUALIFY_EXAM, EMP_ID) VALUES ('.$stu_id.' , "'.$stu_tag.'" , "'.$stu_lname.'" , "'.$stu_fname.'" , "'.$stu_initial.'" , "'.$stu_start.'" , "'.$stu_edu_lvl.'" , "'.$stu_job_title.'" , "'.$stu_street.'" , "'.$stu_city.'" , "'.$stu_state.'" , "'.$stu_country.'" , "'.$stu_zip.'" , "'.$stu_phone.'" , "'.$stu_email_1.'" , "'.$stu_email_2.'" , "'.$stu_dob.'" , "'.$stu_ethnicity.'" , "'.$stu_gender.'" , "'.$stu_citizen.'" , "'.$stu_transcript.'", "'.$stu_comment.'" , "'.$stu_qualify_exam.'", '.$emp_id.')' ;
  show_query($query);
  $results = mysqli_query($dbc,$query) ;
  return $results ;
}
function add_new_prg_enrolled_record($dbc, $stu_id, $prg_id, $prg_enroll_start){
	$query = 'INSERT INTO PRG_ENROLLED(STU_ID, PRG_ID, PRG_ENROLL_STATUS, PRG_ENROLL_START) VALUES ('.$stu_id.', '.$prg_id.', "Active", "'.$prg_enroll_start.'")';
	// show_query($query);
	$results = mysqli_query($dbc, $query);
  return $results ;
}
function update_record($dbc, $stu_id, $stu_tag, $stu_lname, $stu_fname, $stu_initial, $stu_start, $stu_end, $stu_edu_lvl, $stu_job_title, $stu_street, $stu_city, $stu_state, $stu_country, $stu_zip, $stu_phone, $stu_email_1, $stu_email_2, $stu_dob, $stu_ethnicity, $stu_gender, $stu_citizen, $stu_transcript, $stu_comment, $stu_qualify_exam, $emp_id) {
  $query = 'UPDATE STUDENT SET STU_TAG = "'.$stu_tag.'" , STU_LNAME = "'.$stu_lname.'" , STU_FNAME = "'.$stu_fname.'" , STU_INITIAL = "'.$stu_initial.'" , STU_START = "'.$stu_start.'" , STU_END = '. ($stu_end == NULL ? "NULL" : "'$stu_end'") .' , STU_EDU_LVL = "'.$stu_edu_lvl.'" , STU_JOB_TITLE = "'.$stu_job_title.'" , STU_STREET = "'.$stu_street.'" , STU_CITY = "'.$stu_city.'" , STU_STATE = "'.$stu_state.'" , STU_COUNTRY = "'.$stu_country.'" , STU_ZIP = "'.$stu_zip.'" , STU_PHONE = "'.$stu_phone.'" , STU_EMAIL_1 = "'.$stu_email_1.'" , STU_EMAIL_2 = "'.$stu_email_2.'" , STU_DOB = "'.$stu_dob.'" , STU_ETHNICITY = "'.$stu_ethnicity.'" , STU_GENDER = "'.$stu_gender.'" , STU_CITIZEN = "'.$stu_citizen.'" , STU_TRANSCRIPT = "'.$stu_transcript.'" , STU_COMMENT = "'.$stu_comment.'" , STU_QUALIFY_EXAM = "'.$stu_qualify_exam.'", EMP_ID = '.($emp_id == NULL ? "NULL" : $emp_id).' WHERE STU_ID = '.$stu_id;
  // show_query($query);
  $results = mysqli_query($dbc,$query) ;
  // check_results($results) ;
  return $results ;
}
function insert_record_crs_enrolled($dbc, $credit, $crs_enroll_start, $crs_id, $stu_id){
	$query = 'INSERT INTO CRS_ENROLLED(CREDIT, CRS_ENROLL_STATUS, CRS_ENROLL_START, CRS_ID, STU_ID) VALUES ("'.$credit.'" , "Active" , "'.$crs_enroll_start.'" , "'.$crs_id.'" , '.$stu_id.')';
	//show_query($query);
	$results = mysqli_query($dbc,$query) ;
	//check_results($results) ;
	return $results ;
}

function insert_record_cert_earned($dbc, $stu_id, $cert_id, $mail_date, $earn_date){
	$query = 'INSERT INTO CERT_EARNED(STU_ID, CERT_ID, MAIL_DATE, EARN_DATE) VALUES ("'.$stu_id.'", "'.$cert_id.'" , '. ($mail_date == NULL ? "NULL" : "'$mail_date'") .' , "'.$earn_date.'")';
	//show_query($query);
	$results = mysqli_query($dbc,$query) ;
	//check_results($results) ;
	return $results ;
}

function update_record_crs_enrolled($dbc, $credit, $grade, $crs_enroll_status, $crs_enroll_start, $crs_enroll_end, $crs_id, $stu_id, $crs_enroll_start_old){
	// $query = 'UPDATE CRS_ENROLLED SET CREDIT = "'.$credit.'", CRS_ENROLL_STATUS = "'.$crs_enroll_status.'", GRADE = "'.$grade.'", CRS_ENROLL_START = "'.$crs_enroll_start.'", CRS_ENROLL_END = "'.$crs_enroll_end.'" WHERE CRS_ENROLL_START = "'.$crs_enroll_start_old.'" AND STU_ID = '.$stu_id.' AND CRS_ID = "'.$crs_id.'"';
  $query = 'UPDATE CRS_ENROLLED SET CREDIT = "'.$credit.'", CRS_ENROLL_STATUS = "'.$crs_enroll_status.'", GRADE = "'.$grade.'", CRS_ENROLL_START = "'.$crs_enroll_start.'", CRS_ENROLL_END = '. ($crs_enroll_end == NULL ? "NULL" : "'$crs_enroll_end'") .' WHERE CRS_ENROLL_START = "'.$crs_enroll_start_old.'" AND STU_ID = '.$stu_id.' AND CRS_ID = "'.$crs_id.'"';
  // show_query($query);
  $results = mysqli_query($dbc,$query) ;
  check_results($results) ;
  return $results ;
}
function update_record_prg_enrolled($dbc, $enroll_status, $prg_enroll_start, $prg_enroll_end, $prg_id, $stu_id, $prg_enroll_start_old){
	$query = 'UPDATE PRG_ENROLLED SET PRG_ENROLL_STATUS = "'.$enroll_status.'", PRG_ENROLL_START = "'.$prg_enroll_start.'", PRG_ENROLL_END = '. ($prg_enroll_end == NULL ? "NULL" : "'$prg_enroll_end'") .' WHERE PRG_ID = '.$prg_id.' AND PRG_ENROLL_START = "'.$prg_enroll_start_old.'" AND STU_ID = '.$stu_id;
  // show_query($query);
  $results = mysqli_query($dbc,$query) ;
  check_results($results) ;
  return $results ;
}
#Lists out the active courses for a student
function show_active_courses($dbc, $stu_id){
	require( 'includes/connect_db_c9.php' ) ;
  $query = 'SELECT * FROM CRS_ENROLLED, CRS_MADE_OF, PROGRAM, COURSE WHERE COURSE.CRS_ID = CRS_ENROLLED.CRS_ID AND CRS_MADE_OF.CRS_ID = CRS_ENROLLED.CRS_ID AND PROGRAM.PRG_ID = CRS_MADE_OF.PRG_ID AND CRS_ENROLL_STATUS = "Active" AND STU_ID = ' . $stu_id.' ORDER BY CRS_ENROLLED.CRS_ID';
  // echo $query;
  $results = mysqli_query($dbc, $query);
  if($results){
  		echo '<div class="span3" style="height: 200px !important; overflow: auto;">';
  		echo '<TABLE class="table table-condensed table-striped table-hover">';
  		echo '<THEAD>';
  		echo '<TR>';
  		echo '<TH>ID</TH>';
  		echo '<TH>Level</TH>';
  		echo '<TH>Enroll Date</TH>';
  		echo '<TH>Completion Date</TH>';
  		echo '<TH>Grade</TH>';
  		echo '<TH>Credit</TH>';
  		echo '<TH>Status</TH>';
  		echo '<TH>Program</TH>';
  		echo '</TR>';
  		echo '</THEAD>';
  		echo '<TBODY>';
  		while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
  		{
  			echo "<TR class='clickable-row'>";
  			echo '<TD>' . $row['CRS_ID'] . '</TD>' ;
  			echo '<TD>' . $row['CRS_LEVEL'] . '</TD>' ;
  			echo '<TD>' . $row['CRS_ENROLL_START'] . '</TD>' ;
  			echo '<TD>' . $row['CRS_ENROLL_END'] . '</TD>' ;
  			echo '<TD>' . $row['GRADE'] . '</TD>' ;
  			echo '<TD>' . $row['CREDIT'] . '</TD>' ;
  			echo '<TD>' . $row['CRS_ENROLL_STATUS'] . '</TD>' ;
  			echo '<TD>' . $row['PRG_NAME'] . '</TD>' ;
  			echo '</TR>';
  		}
  		echo '</TBODY>';
  		echo '</TABLE>';
  		echo '</div>';
      }
	# Free up the results in memory
	mysqli_free_result( $results );
	# DONT CLOSE CONNECTION YET!
	mysqli_close( $dbc ) ;
}
function show_active_certificates($dbc, $stu_id){
	require( 'includes/connect_db_c9.php' ) ;
  $query = 	$query = 'SELECT CERT_NAME, EARN_DATE, MAIL_DATE FROM CERTIFICATE AS C, CERT_EARNED AS CE WHERE C.CERT_ID=CE.CERT_ID AND STU_ID='.$stu_id.' ORDER BY CERT_NAME';
  // echo $query;
  $results = mysqli_query($dbc, $query);
  if($results){
  		echo '<div class="span3" style="height: 200px !important; overflow: auto;">';
  		echo '<TABLE class="table table-condensed table-striped table-hover">';
  		echo '<THEAD>';
  		echo '<TR>';
  		echo '<TH>Certificate Name</TH>';
  		echo '<TH>Date Earned</TH>';
  		echo '<TH>Mail Date</TH>';
  		echo '</TR>';
  		echo '</THEAD>';
  		echo '<TBODY>';
  		while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
  		{
  			echo "<TR class='clickable-row'>";
  			echo '<TD>' . $row['CERT_NAME'] . '</TD>' ;
  			echo '<TD>' . $row['EARN_DATE'] . '</TD>' ;
  			echo '<TD>' . $row['MAIL_DATE'] . '</TD>' ;
  			echo '</TR>';
  		}
  		echo '</TBODY>';
  		echo '</TABLE>';
  		echo '</div>';
      }
	# Free up the results in memory
	mysqli_free_result( $results );
	# DONT CLOSE CONNECTION YET!
	mysqli_close( $dbc ) ;
}
function show_completed_courses($dbc, $stu_id){
	require( 'includes/connect_db_c9.php' ) ;
	$query = 'SELECT * FROM CRS_ENROLLED, CRS_MADE_OF, PROGRAM, COURSE WHERE COURSE.CRS_ID = CRS_ENROLLED.CRS_ID AND CRS_MADE_OF.CRS_ID = CRS_ENROLLED.CRS_ID AND PROGRAM.PRG_ID = CRS_MADE_OF.PRG_ID AND CRS_ENROLL_STATUS = "Completed" AND STU_ID = ' . $stu_id.' ORDER BY CRS_ENROLLED.CRS_ID';
  // echo $query;
  $results = mysqli_query($dbc, $query);
  if($results){
  		echo '<div class="span3" style="height: 200px !important; overflow: auto;">';
  		echo '<TABLE class="table table-condensed table-striped table-hover">';
  		echo '<THEAD>';
  		echo '<TR>';
  		echo '<TH>ID</TH>';
  		echo '<TH>Level</TH>';
  		echo '<TH>Enroll Date</TH>';
  		echo '<TH>Completion Date</TH>';
  		echo '<TH>Grade</TH>';
  		echo '<TH>Credit</TH>';
  		echo '<TH>Status</TH>';
  		echo '<TH>Program</TH>';
  		echo '</TR>';
  		echo '</THEAD>';
  		echo '<TBODY>';
  		while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
  		{
  			echo "<TR class='clickable-row'>";
  			echo '<TD>' . $row['CRS_ID'] . '</TD>' ;
  			echo '<TD>' . $row['CRS_LEVEL'] . '</TD>' ;
  			echo '<TD>' . $row['CRS_ENROLL_START'] . '</TD>' ;
  			echo '<TD>' . $row['CRS_ENROLL_END'] . '</TD>' ;
  			echo '<TD>' . $row['GRADE'] . '</TD>' ;
  			echo '<TD>' . $row['CREDIT'] . '</TD>' ;
  			echo '<TD>' . $row['CRS_ENROLL_STATUS'] . '</TD>' ;
  			echo '<TD>' . $row['PRG_NAME'] . '</TD>' ;
  			echo '</TR>';
  		}
  		echo '</TBODY>';
  		echo '</TABLE>';
  		echo '</div>';
      }
}
#Shows inactive courses of the student. These courses are probably dropped or failed.
function show_inactive_courses($dbc, $stu_id){
	require( 'includes/connect_db_c9.php' ) ;
	$query = 'SELECT * FROM CRS_ENROLLED, CRS_MADE_OF, PROGRAM, COURSE WHERE COURSE.CRS_ID = CRS_ENROLLED.CRS_ID AND CRS_MADE_OF.CRS_ID = CRS_ENROLLED.CRS_ID AND PROGRAM.PRG_ID = CRS_MADE_OF.PRG_ID AND CRS_ENROLL_STATUS <> "Active" AND CRS_ENROLL_STATUS <> "Completed" AND STU_ID = ' . $stu_id.' ORDER BY CRS_ENROLLED.CRS_ID';
  // echo $query;
  $results = mysqli_query($dbc, $query);
  if($results){
  		echo '<div class="span3" style="height: 200px !important; overflow: auto;">';
  		echo '<TABLE class="table table-condensed table-striped table-hover">';
  		echo '<THEAD>';
  		echo '<TR>';
  		echo '<TH>ID</TH>';
  		echo '<TH>Level</TH>';
  		echo '<TH>Enroll Date</TH>';
  		echo '<TH>Completion Date</TH>';
  		echo '<TH>Grade</TH>';
  		echo '<TH>Credit</TH>';
  		echo '<TH>Status</TH>';
  		echo '<TH>Program</TH>';
  		echo '</TR>';
  		echo '</THEAD>';
  		echo '<TBODY>';
  		while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
  		{
  			echo "<TR class='clickable-row'>";
  			echo '<TD>' . $row['CRS_ID'] . '</TD>' ;
  			echo '<TD>' . $row['CRS_LEVEL'] . '</TD>' ;
  			echo '<TD>' . $row['CRS_ENROLL_START'] . '</TD>' ;
  			echo '<TD>' . $row['CRS_ENROLL_END'] . '</TD>' ;
  			echo '<TD>' . $row['GRADE'] . '</TD>' ;
  			echo '<TD>' . $row['CREDIT'] . '</TD>' ;
  			echo '<TD>' . $row['CRS_ENROLL_STATUS'] . '</TD>' ;
  			echo '<TD>' . $row['PRG_NAME'] . '</TD>' ;
  			echo '</TR>';
  		}
  		echo '</TBODY>';
  		echo '</TABLE>';
  		echo '</div>';
      }
}
# Shows courses student is enrolled in in a table. Used for while adding courses for a new student
function show_student_courses($dbc, $stu_id){
	require( 'includes/connect_db_c9.php' ) ; //connection is closed at end of this function, so need to reopen it every time
  $query = 'SELECT * FROM CRS_ENROLLED WHERE STU_ID = ' . $stu_id;
  $results = mysqli_query($dbc, $query);
  check_results($results);
  if($results){
  		echo '<div class="span3" style="height: 200px !important; overflow: auto;">';
  		echo '<TABLE class="table table-condensed">';
  		echo '<TR>';
  		echo '<TH>ID</TH>';
  		echo '<TH>Enroll Date</TH>';
  		echo '<TH>Completion Date</TH>';
  		echo '<TH>Grade</TH>';
  		echo '<TH>Credit</TH>';
  		echo '<TH>Status</TH>';
  		echo '</TR>';
  		while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
  		{
  			echo '<TR>' ;
  			echo '<TD>' . $row['CRS_ID'] . '</TD>' ;
  			echo '<TD>' . $row['CRS_ENROLL_START'] . '</TD>' ;
  			echo '<TD>' . $row['CRS_ENROLL_END'] . '</TD>' ;
  			echo '<TD>' . $row['GRADE'] . '</TD>' ;
  			echo '<TD>' . $row['CREDIT'] . '</TD>' ;
  			echo '<TD>' . $row['CRS_ENROLL_STATUS'] . '</TD>' ;
  			echo '</TR>';
  		}
  		echo '</TABLE>';
  		echo '</div>';
      }
	# Free up the results in memory
	mysqli_free_result( $results );
	mysqli_close( $dbc ) ;
}
function show_active_programs($dbc, $stu_id){
	require( 'includes/connect_db_c9.php' ) ; 
  $query = 'SELECT * FROM PRG_ENROLLED, PROGRAM WHERE PROGRAM.PRG_ID = PRG_ENROLLED.PRG_ID AND PRG_ENROLL_STATUS = "Active" AND STU_ID = ' . $stu_id. ' ORDER BY PRG_NAME';
  $results = mysqli_query($dbc, $query);
  if($results){
  		echo '<div class="span3" style="height: 200px !important; overflow: auto;">';
  		echo '<TABLE class="table table-condensed table-striped table-hover">';
  		echo '<THEAD>';
  		echo '<TR>';
  		echo '<TH>Program Name</TH>';
  		echo '<TH>Enroll Date</TH>';
  		echo '<TH>Completion Date</TH>';
  		echo '<TH>Status</TH>';
  		echo '</TR>';
  		echo '</THEAD>';
  		echo '<TBODY>';
  		while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
  		{
  			echo "<TR class='clickable-row'>";
  			echo '<TD>' . $row['PRG_NAME'] . '</TD>' ;
  			echo '<TD>' . $row['PRG_ENROLL_START'] . '</TD>' ;
  			echo '<TD>' . $row['PRG_ENROLL_END'] . '</TD>' ;
  			echo '<TD>' . $row['PRG_ENROLL_STATUS'] . '</TD>' ;
  			echo '</TR>';
  			// echo '<input type="hidden" name="CRS_ID" value="'.$row['CRS_ID'].'">';
  			// echo '</form>';
  		}
  		echo '</TBODY>';
  		echo '</TABLE>';
  		echo '</div>';
      }
	# Free up the results in memory
	mysqli_free_result( $results );
	# DONT CLOSE CONNECTION YET!
	mysqli_close( $dbc ) ;
}
function show_completed_programs($dbc, $stu_id){
	require( 'includes/connect_db_c9.php' ) ; 
	$query = 'SELECT * FROM PRG_ENROLLED, PROGRAM WHERE PROGRAM.PRG_ID = PRG_ENROLLED.PRG_ID AND PRG_ENROLL_STATUS = "Completed" AND STU_ID = ' . $stu_id.' ORDER BY PRG_NAME';
  $results = mysqli_query($dbc, $query);
  if($results){
  		echo '<div class="span3" style="height: 200px !important; overflow: auto;">';
  		echo '<TABLE class="table table-condensed table-striped table-hover">';
  		echo '<THEAD>';
  		echo '<TR>';
  		echo '<TH>Program Name</TH>';
  		echo '<TH>Enroll Date</TH>';
  		echo '<TH>Completion Date</TH>';
  		echo '<TH>Status</TH>';
  		echo '</TR>';
  		echo '</THEAD>';
  		echo '<TBODY>';
  		while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
  		{
  			echo "<TR class='clickable-row'>";
  			echo '<TD>' . $row['PRG_NAME'] . '</TD>' ;
  			echo '<TD>' . $row['PRG_ENROLL_START'] . '</TD>' ;
  			echo '<TD>' . $row['PRG_ENROLL_END'] . '</TD>' ;
  			echo '<TD>' . $row['PRG_ENROLL_STATUS'] . '</TD>' ;
  			echo '</TR>';
  			// echo '<input type="hidden" name="CRS_ID" value="'.$row['CRS_ID'].'">';
  			// echo '</form>';
  		}
  		echo '</TBODY>';
  		echo '</TABLE>';
  		echo '</div>';
      }
	# Free up the results in memory
	mysqli_free_result( $results );
	mysqli_close( $dbc ) ;
}
#Shows inactive courses of the student. These courses are probably dropped or failed.
function show_inactive_programs($dbc, $stu_id){
	require( 'includes/connect_db_c9.php' ) ; 
	$query = 'SELECT * FROM PRG_ENROLLED, PROGRAM WHERE PROGRAM.PRG_ID = PRG_ENROLLED.PRG_ID AND PRG_ENROLL_STATUS <> "Completed" AND PRG_ENROLL_STATUS <> "Active" AND STU_ID = ' . $stu_id.' ORDER BY PRG_NAME';
  $results = mysqli_query($dbc, $query);
  if($results){
  		echo '<div class="span3" style="height: 200px !important; overflow: auto;">';
  		echo '<TABLE class="table table-condensed table-striped table-hover">';
  		echo '<THEAD>';
  		echo '<TR>';
  		echo '<TH>Program Name</TH>';
  		echo '<TH>Enroll Date</TH>';
  		echo '<TH>Completion Date</TH>';
  		echo '<TH>Status</TH>';
  		echo '</TR>';
  		echo '</THEAD>';
  		echo '<TBODY>';
  		while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
  		{
  			echo "<TR class='clickable-row'>";
  			echo '<TD>' . $row['PRG_NAME'] . '</TD>' ;
  			echo '<TD>' . $row['PRG_ENROLL_START'] . '</TD>' ;
  			echo '<TD>' . $row['PRG_ENROLL_END'] . '</TD>' ;
  			echo '<TD>' . $row['PRG_ENROLL_STATUS'] . '</TD>' ;
  			echo '</TR>';
  			// echo '<input type="hidden" name="CRS_ID" value="'.$row['CRS_ID'].'">';
  			// echo '</form>';
  		}
  		echo '</TBODY>';
  		echo '</TABLE>';
  		echo '</div>';
      }
	# Free up the results in memory
	mysqli_free_result( $results );
	mysqli_close( $dbc ) ;
}
// function show_student_program_information($dbc, $stu_id){
// 	require( 'includes/connect_db_c9.php' ) ;
// 	$query = "SELECT * FROM PRG_ENROLLED WHERE STU_ID = $stu_id";
// 	$results = mysqli_query($dbc, $query);
//   check_results($results);
// 	if($results){
// 		while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) ){
// 			$prg_id = $row['PRG_ID'];
// 			$query2 = "SELECT PRG_NAME FROM PROGRAM WHERE PRG_ID = $prg_id";
// 			$results2 = mysqli_query($dbc, $query2);
// 			$row2 = mysqli_fetch_array( $results2, MYSQLI_ASSOC);
// 			$prg_name = $row2['PRG_NAME'];
// 			echo '<h3>'.$prg_name.'</h3>';
//   		echo '<div class="d-flex flex-wrap">';
//   		echo '<div class = "panel panel-red" style="display: inline-block; margin:2px" >';
//   		echo '<div class = "panel-heading">';
//       echo '<h3 class = "panel-title">Start Year</h3>';
//       echo '</div>';
//       echo '<div class = "panel-body">';
//       echo $row['PRG_ENROLL_YR_START']; 
//       echo '<a style="visibility: hidden">a</a>';
//       echo '</div>';
//       echo '</div>';
//       echo '<div class = "panel panel-red" style="display: inline-block; margin:2px" >';
//       echo '<div class = "panel-heading">';
//       echo '<h3 class = "panel-title">Start Month</h3>';
//       echo '</div>';
//       echo '<div class = "panel-body">';
//       echo month_num_to_name($row['PRG_ENROLL_MON_START']); 
//       echo '<a style="visibility: hidden">a</a>';
//       echo '</div>';
//   		echo '</div>';
//   		echo '<div class = "panel panel-red" style="display: inline-block; margin:2px" >';
//     	echo '<div class = "panel-heading">';
//       echo '<h3 class = "panel-title">Start Day</h3>';
//       echo '</div>';
//       echo '<div class = "panel-body">';
//       echo $row['PRG_ENROLL_DAY_START'];
//       echo '<a style="visibility: hidden">a</a>';
//       echo '</div>';
// 			echo '</div>';
//   		echo '<div class = "panel panel-red" style="display: inline-block; margin:2px" >';
//     	echo '<div class = "panel-heading">';
//       echo '<h3 class = "panel-title">End Year</h3>';
//     	echo '</div>';
//   		echo '<div class = "panel-body">';
//   		echo $row['PRG_ENROLL_YR_END'];
//   		echo '<a style="visibility: hidden">a</a>';
//     	echo '</div>';
// 			echo '</div>';
// 			echo '<div class = "panel panel-red" style="display: inline-block; margin:2px" >';
//     	echo '<div class = "panel-heading">';
//       echo '<h3 class = "panel-title">End Month</h3>';
//     	echo '</div>';
//   		echo '<div class = "panel-body">';
//   		echo month_num_to_name($row['PRG_ENROLL_MON_END']);
//   		echo '<a style="visibility: hidden">a</a>';
//     	echo '</div>';
// 			echo '</div>';
// 			echo '<div class = "panel panel-red" style="display: inline-block; margin:2px" >';
//     	echo '<div class = "panel-heading">';
//       echo '<h3 class = "panel-title">End Day</h3>';
//     	echo '</div>';
//   		echo '<div class = "panel-body">';
//   		echo $row['PRG_ENROLL_DAY_END'];
//   		echo '<a style="visibility: hidden">a</a>';
//     	echo '</div>';
// 			echo '</div>';
// 	  	echo '<div class = "panel panel-red" style="display: inline-block; margin:2px" >';
//     	echo '<div class = "panel-heading">';
//       echo '<h3 class = "panel-title">Enrollment Status</h3>';
//     	echo '</div>';
//   		echo '<div class = "panel-body">';
//   		echo $row['PRG_ENROLL_STATUS'];
//   		echo '<a style="visibility: hidden">a</a>';
//     	echo '</div>';
// 			echo '</div>';
// 			echo '</div>';
// 		}
// 	}
// }
#Shows table with small part of all student info. Allows user to click on student to view their profile.
function show_brief_students($dbc){
	$query = 'SELECT STU_ID, STU_TAG, STU_LNAME, STU_FNAME FROM STUDENT';
	$results = mysqli_query($dbc, $query);
	echo '<div class="span3" style="height: 200px !important; overflow: auto;">';
	echo '<TABLE class="table table-condensed table-striped table-hover">';
	echo '<THEAD>';
	echo '<TR>';
	echo '<TH>ID</TH>';
	echo '<TH>Tag</TH>';
	echo '<TH>Last Name</TH>';
	echo '<TH>First Name</TH>';
	echo '</TR>';
	echo '</THEAD>';
	echo '<TBODY>';
	if($results){
		while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) ){
			echo "<TR class='clickable-row'>";
			echo '<TD>' . $row['STU_ID'] . '</TD>' ;
			echo '<TD>' . $row['STU_TAG'] . '</TD>' ;
			echo '<TD>' . $row['STU_LNAME'] . '</TD>' ;
			echo '<TD>' . $row['STU_FNAME'] . '</TD>' ;
			echo '</TR>';
		}
		echo '</TBODY>';
		echo '</TABLE>';
    }
  echo '</div>';
	# Free up the results in memory
	mysqli_free_result( $results );
	mysqli_close( $dbc ) ;
}
#Shows results of search
function show_brief_students_results($dbc, $string, $order){
	$query = "SELECT STU_ID, STU_TAG, STU_LNAME, STU_FNAME FROM STUDENT WHERE STU_ID LIKE '%$string%' OR STU_LNAME LIKE '%$string%' OR STU_FNAME LIKE '%$string%'";
	if($order == "Last Name"){
		$query = $query . ' ORDER BY STU_LNAME ';
	}
	else if($order == "First Name"){
		$query = $query . ' ORDER BY STU_FNAME ';
	}
	// show_query($query);
	$results = mysqli_query($dbc, $query);
	echo '<div class="span3" style="height: 200px !important; overflow: auto;">';
	echo '<TABLE class="table table-condensed table-striped table-hover">';
	echo '<THEAD>';
	echo '<TR>';
	echo '<TH>ID</TH>';
	echo '<TH>Tag</TH>';
	echo '<TH>Last Name</TH>';
	echo '<TH>First Name</TH>';
	echo '</TR>';
	echo '</THEAD>';
	echo '<TBODY>';
	if($results){
		while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) ){
			echo "<TR class='clickable-row'>";
			echo '<TD>' . $row['STU_ID'] . '</TD>' ;
			echo '<TD>' . $row['STU_TAG'] . '</TD>' ;
			echo '<TD>' . $row['STU_LNAME'] . '</TD>' ;
			echo '<TD>' . $row['STU_FNAME'] . '</TD>' ;
			echo '</TR>';
		}
		echo '</TBODY>';
		echo '</TABLE>';
    }
  echo '</div>';
	# Free up the results in memory
	mysqli_free_result( $results );
	mysqli_close( $dbc ) ;
}
# Gets the id of the student
function get_student_id($dbc, $stu_name){
	$query = "SELECT STU_ID FROM STUDENT WHERE STU_FNAME = '".$stu_name."'";
	$results = mysqli_query($dbc,$query) ;
	$row = mysqli_fetch_array($results, MYSQLI_ASSOC) ;
	$stu_id = $row [ 'STU_ID' ] ;
	return intval($stu_id) ;
}
# Gets the id of the course
function get_crs_id($dbc, $crs_name){
	$query = "SELECT CRS_ID FROM COURSE WHERE CRS_NAME = '".$crs_name."'";
	$results = mysqli_query($dbc,$query) ;
	$row = mysqli_fetch_array($results, MYSQLI_ASSOC) ;
	$crs_id = $row [ 'CRS_ID' ] ;
	return $crs_id;
}
function get_emp_name($dbc, $emp_id){
	$query = "SELECT EMP_NAME FROM EMPLOYER WHERE EMP_ID = $emp_id";
	$results = mysqli_query($dbc,$query) ;
	if($results){
		$row = mysqli_fetch_array($results, MYSQLI_ASSOC) ;
		$emp_id= $row [ 'EMP_NAME' ] ;
		return $emp_id;
	}
	
}
# Gets the id of the employer
function get_employer_id($dbc, $emp_name){
	$query = "SELECT EMP_ID FROM EMPLOYER WHERE EMP_NAME = '".$emp_name."'";
	$results = mysqli_query($dbc,$query) ;
	$row = mysqli_fetch_array($results, MYSQLI_ASSOC) ;
	$emp_id = $row [ 'EMP_ID' ] ;
	return intval($emp_id) ;
}
# Gets the full name of the student from the student ID
function get_stu_name($dbc, $stu_id){
	require( 'includes/connect_db_c9.php' ) ; //Not sure why we need this here...
	$query = "SELECT STU_FNAME, STU_LNAME FROM STUDENT WHERE STU_ID = $stu_id";
	//show_query($query) ;
    $results = mysqli_query( $dbc, $query ) ;
    if($results){
    $row = mysqli_fetch_array($results, MYSQLI_ASSOC);
    $fname = $row [ 'STU_FNAME' ] ;
    $lname = $row [ 'STU_LNAME' ] ;
    $name = $fname . " " . $lname;
    return $name;
    }
    else{
    		echo $stu_id;
    }
    mysqli_free_result( $results );
		mysqli_close( $dbc ) ;
}


#Gets the programs the student is in
function get_student_programs($dbc, $stu_id){
	require( 'includes/connect_db_c9.php' ) ; //Not sure why we need this here...
	$query = "SELECT * FROM PRG_ENROLLED, PROGRAM WHERE PROGRAM.PRG_ID = PRG_ENROLLED.PRG_ID AND STU_ID = $stu_id";
	//show_query($query) ;
  $results = mysqli_query( $dbc, $query ) ;
  echo '<div class="span3" style="height: 200px !important; overflow: auto;">';
	echo '<TABLE class="table table-condensed">';
	echo '<THEAD>';
	echo '<TR>';
	echo '<TH>Program Name</TH>';
	echo '<TH>Enrollment Status</TH>';
	echo '<TH>Enrollment Date</TH>';
	echo '</TR>';
	echo '</THEAD>';
	echo '<TBODY>';
  if($results){
		while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) ){
			echo '<TD>' . $row['PRG_NAME'] . '</TD>' ;
			echo '<TD>' . $row['PRG_ENROLL_STATUS'] . '</TD>' ;
			echo '<TD>' . $row['PRG_ENROLL_START'] . '</TD>' ;
			echo '</TR>';
		}
		echo '</TBODY>';
		echo '</TABLE>';
    }
  echo '</div>';
	# Free up the results in memory
	mysqli_free_result( $results );
	mysqli_close( $dbc ) ;
}
# Gets the program name from program id
function get_prg_name($dbc, $prg_id){
	require( 'includes/connect_db_c9.php' ) ;
	$query = "SELECT PRG_NAME FROM PROGRAM WHERE PRG_ID = $prg_id";
	//show_query($query) ;
    $results = mysqli_query( $dbc, $query ) ;
    if($results){
    $row = mysqli_fetch_array($results, MYSQLI_ASSOC);
    $name = $row [ 'PRG_NAME' ] ;
    return $name;
    }
    else{
    		echo $prg_id;
    }
    mysqli_free_result( $results );
		mysqli_close( $dbc ) ;
}
# Gets the program name from program id
function get_prg_id($dbc, $prg_name){
	require( 'includes/connect_db_c9.php' ) ;
	$query = "SELECT PRG_ID FROM PROGRAM WHERE PRG_NAME = '$prg_name'";
	//show_query($query) ;
    $results = mysqli_query( $dbc, $query ) ;
    if($results){
    $row = mysqli_fetch_array($results, MYSQLI_ASSOC);
    $id = $row [ 'PRG_ID' ] ;
    return $id;
    }
    else{
    		echo $prg_id;
    }
    mysqli_free_result( $results );
		mysqli_close( $dbc ) ;
}

function get_stu_cert_earn_date($dbc, $stu_id, $cert_id){
	require( 'includes/connect_db_c9.php' ) ;
	$query = 'SELECT EARN_DATE FROM CERTIFICATE AS C, CERT_EARNED AS CE WHERE C.CERT_ID=CE.CERT_ID AND CE.STU_ID='.$stu_id.' AND CE.CERT_ID = '.$cert_id;
	//show_query($query) ;
    $results = mysqli_query( $dbc, $query ) ;
    if($results){
    $row = mysqli_fetch_array($results, MYSQLI_ASSOC);
    $id = $row [ 'EARN_DATE' ] ;
    return $id;
    }
    else{
    		echo 'nope';
    }
    mysqli_free_result( $results );
		mysqli_close( $dbc ) ;
}

function get_stu_cert_mail_date($dbc, $stu_id, $cert_id){
	require( 'includes/connect_db_c9.php' ) ;
	$query = 'SELECT MAIL_DATE FROM CERTIFICATE AS C, CERT_EARNED AS CE WHERE C.CERT_ID=CE.CERT_ID AND CE.STU_ID='.$stu_id.' AND CE.CERT_ID = '.$cert_id;
	//show_query($query) ;
    $results = mysqli_query( $dbc, $query ) ;
    if($results){
    $row = mysqli_fetch_array($results, MYSQLI_ASSOC);
    $id = $row [ 'MAIL_DATE' ] ;
    return $id;
    }
    else{
    		echo 'nope';
    }
    mysqli_free_result( $results );
		mysqli_close( $dbc ) ;
}
function get_stu_cert_id($dbc, $cert_name){
	$query = "SELECT CERT_ID FROM CERTIFICATE WHERE CERT_NAME = '.$cert_name.'";
	$results = mysqli_query($dbc, $query);
	$row = mysqli_fetch_array( $results , MYSQLI_ASSOC );
  $cert_id = $row['CERT_ID'];
  return $cert_id;
  mysqli_free_result( $results );
	mysqli_close( $dbc ) ;
}
function get_stu_cert_name($dbc, $stu_id, $cert_id){
	require( 'includes/connect_db_c9.php' ) ;
	$query = 'SELECT CERT_NAME FROM CERTIFICATE AS C, CERT_EARNED AS CE WHERE C.CERT_ID=CE.CERT_ID AND CE.STU_ID='.$stu_id.' AND CE.CERT_ID = '.$cert_id;
	//show_query($query) ;
    $results = mysqli_query( $dbc, $query ) ;
    if($results){
    $row = mysqli_fetch_array($results, MYSQLI_ASSOC);
    $id = $row [ 'CERT_NAME' ] ;
    return $id;
    }
    else{
    		echo 'nope';
    }
    mysqli_free_result( $results );
		mysqli_close( $dbc ) ;
}

function update_record_cert_earned($dbc, $stu_id, $cert_id, $mail_date, $earn_date) {
  $query = 'UPDATE CERT_EARNED SET MAIL_DATE = '. ($mail_date == NULL ? "NULL" : "'$mail_date'").' , EARN_DATE = "'.$earn_date.'" WHERE STU_ID = '.$stu_id.' AND CERT_ID ='.$cert_id;
  // show_query($query);
  $results = mysqli_query($dbc,$query) ;
  // check_results($results) ;
  return $results ;
}


# Gets the course name from course id
function get_crs_name($dbc, $crs_id){
	require( 'includes/connect_db_c9.php' ) ;
	$query = "SELECT CRS_NAME FROM COURSE WHERE CRS_ID = '$crs_id'";
	//show_query($query) ;
    $results = mysqli_query( $dbc, $query ) ;
    if($results){
    $row = mysqli_fetch_array($results, MYSQLI_ASSOC);
    $name = $row [ 'CRS_NAME' ] ;
    return $name;
    }
    else{
    		echo $crs_id;
    }
}
function get_stu_gender($dbc, $stu_id){
	require( 'includes/connect_db_c9.php' ) ; //Not sure why we need this here...
	$query = "SELECT STU_GENDER FROM STUDENT WHERE STU_ID = $stu_id";
	//show_query($query) ;
    $results = mysqli_query( $dbc, $query ) ;
	$row = mysqli_fetch_array($results, MYSQLI_ASSOC) ;
	$stu_gender = $row [ 'STU_GENDER' ] ;
	return $stu_gender ;
}
function get_stu_start($dbc, $stu_id){
	require( 'includes/connect_db_c9.php' ) ; //Not sure why we need this here...
	$query = "SELECT STU_START FROM STUDENT WHERE STU_ID = $stu_id";
  $results = mysqli_query( $dbc, $query ) ;
	$row = mysqli_fetch_array($results, MYSQLI_ASSOC) ;
	$stu_start = $row [ 'STU_START' ] ;
	return $stu_start ;
}

function get_stu_yr_start($dbc, $stu_id){
	require( 'includes/connect_db_c9.php' ) ; //Not sure why we need this here...
	$query = "SELECT STU_YR_START FROM STUDENT WHERE STU_ID = $stu_id";
  $results = mysqli_query( $dbc, $query ) ;
	$row = mysqli_fetch_array($results, MYSQLI_ASSOC) ;
	$stu_yr_start = $row [ 'STU_YR_START' ] ;
	return $stu_yr_start ;
}
function get_stu_mon_start($dbc, $stu_id){
	require( 'includes/connect_db_c9.php' ) ; //Not sure why we need this here...
	$query = "SELECT STU_MON_START FROM STUDENT WHERE STU_ID = $stu_id";
  $results = mysqli_query( $dbc, $query ) ;
	$row = mysqli_fetch_array($results, MYSQLI_ASSOC) ;
	$stu_yr_start = $row [ 'STU_MON_START' ] ;
	return $stu_yr_start ;
}
function get_stu_day_start($dbc, $stu_id){
	require( 'includes/connect_db_c9.php' ) ; //Not sure why we need this here...
	$query = "SELECT STU_DAY_START FROM STUDENT WHERE STU_ID = $stu_id";
  $results = mysqli_query( $dbc, $query ) ;
	$row = mysqli_fetch_array($results, MYSQLI_ASSOC) ;
	$stu_yr_start = $row [ 'STU_DAY_START' ] ;
	return $stu_yr_start ;
}
#Shows 3 recent courses the student has taken/is in
function show_recent_student_courses($dbc, $stu_id){
	require( 'includes/connect_db_c9.php' ) ; //Not sure why we need this here...
	$query = "SELECT COURSE.CRS_ID, COURSE.CRS_NAME, CRS_ENROLLED.CRS_ENROLL_STATUS FROM CRS_ENROLLED, COURSE WHERE CRS_ENROLLED.CRS_ID = COURSE.CRS_ID AND CRS_ENROLLED.STU_ID = $stu_id";
  $results = mysqli_query( $dbc, $query ) ;
  $counter = 0;
  if(mysqli_num_rows($results) == 0) {echo '<p>(None)</p>';}
	while($row = mysqli_fetch_array($results, MYSQLI_ASSOC)){
		if($counter < 3){
			echo '<p><label>'.$row['CRS_ID'].'</label><br>';
			echo $row['CRS_NAME'] . " (" . $row['CRS_ENROLL_STATUS'] . ")";
			echo '</p>';
			$counter++;
		}
	}
}
#Shows programs student is in. Shows 3 programs. Can remove this.
function show_student_programs($dbc, $stu_id){
	require( 'includes/connect_db_c9.php' ) ; //Not sure why we need this here...
	$query = "SELECT PROGRAM.PRG_ID, PROGRAM.PRG_NAME, PRG_ENROLLED.PRG_ENROLL_STATUS FROM PRG_ENROLLED, PROGRAM WHERE PRG_ENROLLED.PRG_ID = PROGRAM.PRG_ID AND PRG_ENROLLED.STU_ID = $stu_id";
  $results = mysqli_query( $dbc, $query ) ;
  $counter = 0;
  if(mysqli_num_rows($results) == 0) {echo '<p>(None)</p>';}
	while($row = mysqli_fetch_array($results, MYSQLI_ASSOC)){
		if($counter < 3){
			echo '<p><label>'.$row['PRG_NAME'].'</label> ';
			echo " (" . $row['PRG_ENROLL_STATUS'] . ")";
			echo '</p>';
			$counter++;
		}
	}
}


# Shows the query as a debugging aid
function show_query($query) {
  global $debug;

  if($debug)
    echo "<p>Query = $query</p>" ;
}

# Checks the query results as a debugging aid
function check_results($results) {
  global $dbc;

  if($results != true)
    echo '<p>SQL ERROR = ' . mysqli_error( $dbc ) . '</p>'  ;
}

#Created function that validates a number
function valid_number($num) {
	if (empty($num) || !is_numeric($num))
			return false;
	else {
		$num = intval($num);
		if($num <= 0)
			return false;
	}
	return true;
}

#Created function that validates name input
function valid_name($name) {
	if (empty($name))
		return false;
	else 
		return true;
}

// new
function populate_emp_name($dbc){
	require( 'includes/connect_db_c9.php' ) ; //Not sure why we need this here...
	$query = "SELECT EMP_NAME FROM EMPLOYER";
  $results = mysqli_query( $dbc, $query ) ;
	if($results){
		while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) ){
			echo '<option value='.$row['EMP_NAME'].'>' . $row['EMP_NAME'] . '</option>' ;
		}
  }
	# Free up the results in memory
	mysqli_free_result( $results );
	mysqli_close( $dbc ) ;
}
// new end
?>