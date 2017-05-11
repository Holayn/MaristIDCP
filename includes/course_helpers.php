<?php
  require( 'includes/connect_db_c9.php' ) ; 

$debug = true;
function insert_course($dbc, $crs_id, $crs_name, $crs_level) {
  $query = 'INSERT INTO COURSE(CRS_ID, CRS_NAME, CRS_LEVEL) VALUES ("'.$crs_id.'" , "'.$crs_name.'" , "'.$crs_level.'")' ;
 //show_query($query);
  $results = mysqli_query($dbc,$query) ;
  // check_results($results) ;
  return $results ;
}
function insert_teaches($dbc, $crs_id, $ins_id){
  $query = 'INSERT INTO TEACHES(CRS_ID, INS_ID) VALUES ("'.$crs_id.'" , '.$ins_id.')';
  // echo $query;
  $results = mysqli_query($dbc, $query);
  return $results;
}
function update_teaches($dbc, $crs_id, $ins_id, $ins_id_old){
  $query = 'UPDATE TEACHES SET INS_ID = '.$ins_id.' WHERE CRS_ID = "'.$crs_id.'" AND INS_ID = '.$ins_id_old.'';
  // echo $query;
  $results = mysqli_query($dbc, $query);
  return $results;
}
function update_course($dbc, $crs_id, $crs_name, $crs_level, $prg_id, $prg_id_old) {
  $query = 'UPDATE COURSE SET CRS_NAME = "'.$crs_name.'", CRS_LEVEL = "'.$crs_level.'" WHERE CRS_ID = "'.$crs_id.'"';
   //show_query($query);
  $results = mysqli_query($dbc,$query) ;
   check_results($results) ;
  $query = 'UPDATE CRS_MADE_OF SET PRG_ID = '.$prg_id.' WHERE PRG_ID = '.$prg_id_old.' AND CRS_ID = "'.$crs_id.'"';
   //show_query($query);
  $results = mysqli_query($dbc,$query) ;
   check_results($results) ;
  return $results ;
}

function insert_course_program($dbc, $crs_id, $prg_id){
  $query = 'INSERT INTO CRS_MADE_OF (CRS_ID, PRG_ID) VALUES ("'.$crs_id.'" , "'.$prg_id.'")'; 
  $results = mysqli_query($dbc,$query) ;
  check_results($results) ;
  return $results ;
}
function get_ins_name($dbc, $crs_id){
  $query = 'SELECT INS_FNAME, INS_LNAME FROM TEACHES, INSTRUCTOR WHERE INSTRUCTOR.INS_ID = TEACHES.INS_ID AND TEACHES.CRS_ID = "'.$crs_id.'"'; 
  $results = mysqli_query($dbc,$query) ;
  $row = mysqli_fetch_array($results, MYSQLI_ASSOC);
  $ins_name = $row['INS_FNAME'] . " " . $row['INS_LNAME'];
  return $ins_name ;
}

function get_prg_id($dbc, $prg_name){
  $query = 'SELECT PRG_ID FROM PROGRAM WHERE PRG_NAME = "'.$prg_name.'"'; 
  //show_query($query) ;
    $results = mysqli_query( $dbc, $query ) ;
    if(!$results){
    	echo "didnt work";
    }
	$row = mysqli_fetch_array($results, MYSQLI_ASSOC) ;
	$prg_id = $row ['PRG_ID'];
	return $prg_id;
}
function get_prg_name($dbc, $crs_id){
  $query = 'SELECT PRG_NAME FROM PROGRAM, CRS_MADE_OF WHERE CRS_MADE_OF.PRG_ID = PROGRAM.PRG_ID AND CRS_MADE_OF.CRS_ID = "'.$crs_id.'"'; 
  //show_query($query) ;
    $results = mysqli_query( $dbc, $query ) ;
    if(!$results){
    	echo "didnt work";
    }
	$row = mysqli_fetch_array($results, MYSQLI_ASSOC) ;
 return $row ['PRG_NAME'];
}
function show_students_in_course($dbc, $crs_id, $order, $string){
  $query = "SELECT STUDENT.STU_ID, STUDENT.STU_LNAME, STUDENT.STU_FNAME, CRS_ENROLLED.CRS_ENROLL_START FROM CRS_ENROLLED, STUDENT WHERE STUDENT.STU_ID = CRS_ENROLLED.STU_ID AND CRS_ENROLLED.CRS_ENROLL_STATUS = 'Active' AND CRS_ENROLLED.CRS_ID = '$crs_id' AND (STUDENT.STU_ID LIKE '%$string%' OR STUDENT.STU_LNAME LIKE '%$string%' OR STUDENT.STU_FNAME LIKE '%$string%')";
	if($order == "Last Name"){
		$query = $query . ' ORDER BY STU_LNAME, STU_FNAME ';
	}
	else if($order == "First Name"){
		$query = $query . ' ORDER BY STU_FNAME, STU_LNAME ';
	}
	else if($order == "ID"){
		$query = $query . ' ORDER BY STU_ID ';
	}
	else if($order == "Enroll Date"){
		$query = $query . ' ORDER BY CRS_ENROLL_START ';
	}
	else{
		$query = $query . ' ORDER BY STU_LNAME, STU_FNAME ';
	}	
	// show_query($query);
	$results = mysqli_query($dbc, $query);
	echo '<div class="span3" style="height: 200px !important; overflow: auto;">';
	echo '<TABLE class="table table-condensed table-striped table-hover">';
	echo '<THEAD>';
	echo '<TR>';
	echo '<TH>ID</TH>';
	echo '<TH>Last Name</TH>';
	echo '<TH>First Name</TH>';
	echo '<TH>Course Enroll Date</TH>';
	echo '</TR>';
	echo '</THEAD>';
	echo '<TBODY>';
	if($results){
		while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) ){
			echo "<TR class='clickable-row'>";
			echo '<TD>' . $row['STU_ID'] . '</TD>' ;
			echo '<TD>' . $row['STU_LNAME'] . '</TD>' ;
			echo '<TD>' . $row['STU_FNAME'] . '</TD>' ;
			echo '<TD>' . $row['CRS_ENROLL_START'] . '</TD>' ;
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
function show_brief_course_results($dbc, $string, $order){
	$query = "SELECT COURSE.CRS_ID, COURSE.CRS_NAME, COURSE.CRS_LEVEL, PROGRAM.PRG_NAME FROM COURSE, CRS_MADE_OF, PROGRAM WHERE CRS_MADE_OF.CRS_ID = COURSE.CRS_ID AND CRS_MADE_OF.PRG_ID = PROGRAM.PRG_ID AND (COURSE.CRS_ID LIKE '%$string%' OR COURSE.CRS_NAME LIKE '%$string%')";
	if($order == "Name"){
		$query = $query . ' ORDER BY COURSE.CRS_NAME ';
	}
	else if($order == "Level"){
		$query = $query . ' ORDER BY COURSE.CRS_LEVEL ';
	}
	else{
	  $query = $query . ' ORDER BY COURSE.CRS_ID';
	}
	// show_query($query);
	$results = mysqli_query($dbc, $query);
	echo '<div class="span3" style="height: 200px !important; overflow: auto;">';
	echo '<TABLE class="table table-condensed table-striped table-hover">';
	echo '<THEAD>';
	echo '<TR>';
	echo '<TH>ID</TH>';
	echo '<TH>Name</TH>';
	echo '<TH>Level</TH>';
	echo '<TH>Program Name</TH>';
	echo '</TR>';
	echo '</THEAD>';
	echo '<TBODY>';
	if($results){
		while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) ){
			echo "<TR class='clickable-row'>";
			echo '<TD>' . $row['CRS_ID'] . '</TD>' ;
			echo '<TD>' . $row['CRS_NAME'] . '</TD>' ;
			echo '<TD>' . $row['CRS_LEVEL'] . '</TD>' ;
			echo '<TD>' . $row['PRG_NAME'] . '</TD>' ;
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

function get_crs_name($dbc, $crs_id){
  require( 'includes/connect_db_c9.php' ) ; 
	$query = "SELECT CRS_NAME FROM COURSE WHERE CRS_ID = '$crs_id'";
	//show_query($query) ;
    $results = mysqli_query( $dbc, $query ) ;
    if(!$results){
    	echo "didnt work";
    }
	$row = mysqli_fetch_array($results, MYSQLI_ASSOC) ;
	$crs_name = $row ['CRS_NAME'];
	return $crs_name;
}

function get_crs_level($dbc, $crs_id){
  require( 'includes/connect_db_c9.php' ) ; 
	$query = "SELECT CRS_LEVEL FROM COURSE WHERE CRS_ID = '$crs_id'";
	//show_query($query) ;
    $results = mysqli_query( $dbc, $query ) ;
    if(!$results){
    	echo "didnt work";
    }
	$row = mysqli_fetch_array($results, MYSQLI_ASSOC) ;
	$crs_level = $row ['CRS_LEVEL'];
	return $crs_level;
}

function show_query($query) {
  global $debug;

  if($debug)
    echo "<p>Query = $query</p>" ;
}

function check_results($results) {
  global $dbc;

  if($results != true)
    echo '<p>SQL ERROR = ' . mysqli_error( $dbc ) . '</p>'  ;
}


?>