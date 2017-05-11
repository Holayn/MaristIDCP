<?php
  require( 'includes/connect_db_c9.php' ) ; 

$debug = true;
function insert_instructor($dbc, $ins_lname, $ins_fname, $ins_initial, $ins_email){
	$query = 'INSERT INTO INSTRUCTOR(INS_LNAME, INS_FNAME, INS_INITIAL, INS_EMAIL) VALUES ("'.$ins_lname.'" , "'.$ins_fname.'" , "'.$ins_initial.'" , "'.$ins_email.'")';
  // show_query($query);
  $results = mysqli_query($dbc,$query) ;
  return $results ;
}
function update_instructor($dbc, $ins_id, $ins_lname, $ins_fname, $ins_initial, $ins_email) {
  $query = 'UPDATE INSTRUCTOR SET INS_LNAME = "'.$ins_lname.'", INS_FNAME = "'.$ins_fname.'", INS_INITIAL = "'.$ins_initial.'",  INS_EMAIL = "'.$ins_email.'" WHERE INS_ID = '.$ins_id;
  // show_query($query);
  $results = mysqli_query($dbc,$query) ;
  return $results ;
}
function get_ins_initial($dbc, $ins_id){
	$query = "SELECT INS_INITIAL FROM INSTRUCTOR WHERE INS_ID = $ins_id";
	$results = mysqli_query($dbc, $query) ;
  $row = mysqli_fetch_array($results, MYSQLI_ASSOC);
  return $row['INS_INITIAL'];
}
function get_ins_courses($dbc, $ins_id){
	$query = "SELECT COURSE.CRS_ID, COURSE.CRS_NAME FROM COURSE, TEACHES WHERE COURSE.CRS_ID = TEACHES.CRS_ID AND TEACHES.INS_ID = $ins_id";
	$results = mysqli_query($dbc, $query) ;
  echo '<div class="span3" style="height: 200px !important; overflow: auto;">';
	echo '<TABLE class="table table-condensed table-striped table-hover">';
	echo '<THEAD>';
	echo '<TR>';
	echo '<TH>Course ID</TH>';
	echo '<TH>Course Name</TH>';
	echo '</TR>';
	echo '</THEAD>';
	echo '<TBODY>';
	if($results){
		while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) ){
			echo "<TR class='clickable-row'>";
			echo '<TD>' . $row['CRS_ID'] . '</TD>' ;
			echo '<TD>' . $row['CRS_NAME'] . '</TD>' ;
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
function get_ins_email($dbc, $ins_id){
	$query = "SELECT INS_EMAIL FROM INSTRUCTOR WHERE INS_ID = $ins_id";
	$results = mysqli_query($dbc,$query) ;
  $row = mysqli_fetch_array($results, MYSQLI_ASSOC);
  return $row['INS_EMAIL'];
}
function show_instructor_results($dbc, $searchString, $order){
  require( 'includes/connect_db_c9.php' ) ; 
	$query = "SELECT * FROM INSTRUCTOR WHERE INS_FNAME LIKE '%$searchString%' OR INS_LNAME LIKE '%$searchString%'";
	if($order == "Last Name"){
		$query = $query . ' ORDER BY INS_LNAME ';
	}
	else if($order == "First Name"){
		$query = $query . ' ORDER BY INS_FNAME ';
	}
	else{
		$query = $query . ' ORDER BY INS_LNAME ';
	}
	$results = mysqli_query($dbc, $query);
	echo '<div class="span3" style="height: 200px !important; overflow: auto;">';
	echo '<TABLE class="table table-condensed table-striped table-hover">';
	echo '<THEAD>';
	echo '<TR>';
	echo '<TH>Last Name</TH>';
	echo '<TH>First Name</TH>';
	echo '<TH>Initial</TH>';
	echo '<TH>Email</TH>';
	echo '</TR>';
	echo '</THEAD>';
	echo '<TBODY>';
	if($results){
		while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) ){
			echo "<TR class='clickable-row'>";
			echo '<TD>' . $row['INS_LNAME'] . '</TD>' ;
			echo '<TD>' . $row['INS_FNAME'] . '</TD>' ;
			echo '<TD>' . $row['INS_INITIAL'] . '</TD>' ;
			echo '<TD>' . $row['INS_EMAIL'] . '</TD>' ;
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