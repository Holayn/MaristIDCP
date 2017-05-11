<?php
  require( 'includes/connect_db_c9.php' ) ; 

$debug = true;
function insert_program($dbc, $prg_name) {
  $query = 'INSERT INTO PROGRAM(PRG_NAME) VALUES ("'.$prg_name.'")' ;
 //show_query($query);
  $results = mysqli_query($dbc,$query) ;
  // check_results($results) ;
  return $results ;
}

function update_program($dbc, $prg_id, $prg_name) {
  $query = 'UPDATE PROGRAM SET PRG_NAME = "'.$prg_name.'" WHERE PRG_ID = "'.$prg_id.'"';
  //show_query($query);
  $results = mysqli_query($dbc,$query) ;
  check_results($results) ;
  return $results ;
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
function show_students_in_program($dbc, $prg_id, $order, $string){
	$query = "SELECT STUDENT.STU_ID, STUDENT.STU_LNAME, STUDENT.STU_FNAME, PRG_ENROLLED.PRG_ENROLL_START FROM PRG_ENROLLED, STUDENT WHERE STUDENT.STU_ID = PRG_ENROLLED.STU_ID AND PRG_ENROLLED.PRG_ENROLL_STATUS = 'Active' AND PRG_ENROLLED.PRG_ID = '$prg_id' AND (STUDENT.STU_ID LIKE '%$string%' OR STUDENT.STU_LNAME LIKE '%$string%' OR STUDENT.STU_FNAME LIKE '%$string%')";
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
		$query = $query . ' ORDER BY PRG_ENROLL_START ';
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
	echo '<TH>Program Enroll Date</TH>';
	echo '</TR>';
	echo '</THEAD>';
	echo '<TBODY>';
	if($results){
		while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) ){
			echo "<TR class='clickable-row'>";
			echo '<TD>' . $row['STU_ID'] . '</TD>' ;
			echo '<TD>' . $row['STU_LNAME'] . '</TD>' ;
			echo '<TD>' . $row['STU_FNAME'] . '</TD>' ;
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

function show_brief_program_results($dbc, $string){
	$query = "SELECT PRG_ID, PRG_NAME FROM PROGRAM WHERE PRG_ID LIKE '%$string%' OR PRG_NAME LIKE '%$string%' ORDER BY PRG_NAME";
	// show_query($query);
	$results = mysqli_query($dbc, $query);
	echo '<div class="span3" style="height: 200px !important; overflow: auto;">';
	echo '<TABLE class="table table-condensed table-striped table-hover">';
	echo '<THEAD>';
	echo '<TR>';
	//echo '<TH>ID</TH>';
	echo '<TH>Name</TH>';
	echo '</TR>';
	echo '</THEAD>';
	echo '<TBODY>';
	if($results){
		while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) ){
			echo "<TR class='clickable-row'>";
		//	echo '<TD>' . $row['PRG_ID'] . '</TD>' ;
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

function get_prg_name($dbc, $prg_id){
  require( 'includes/connect_db_c9.php' ) ; 
	$query = "SELECT PRG_NAME FROM PROGRAM WHERE PRG_ID = '$prg_id'";
	//show_query($query) ;
    $results = mysqli_query( $dbc, $query ) ;
    if(!$results){
    	echo "didnt work";
    }
	$row = mysqli_fetch_array($results, MYSQLI_ASSOC) ;
	$prg_name = $row ['PRG_NAME'];
	return $prg_name;
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