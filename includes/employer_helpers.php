<?php
  require( 'includes/connect_db_c9.php' ) ; 

$debug = true;
function insert_employer($dbc, $emp_name, $emp_email, $emp_phone){
	$query = 'INSERT INTO EMPLOYER(EMP_NAME, EMP_EMAIL, EMP_PHONE) VALUES ("'.$emp_name.'" , "'.$emp_email.'", "'.$emp_phone.'")';
 //show_query($query);
  $results = mysqli_query($dbc,$query) ;
  check_results($results) ;
  return $results ;
}
function update_employer($dbc, $emp_id, $emp_name, $emp_phone, $emp_email) {
  $query = 'UPDATE EMPLOYER SET EMP_NAME = "'.$emp_name.'", EMP_PHONE = "'.$emp_phone.'", EMP_EMAIL = "'.$emp_email.'" WHERE EMP_ID = '.$emp_id;
  // show_query($query);
  $results = mysqli_query($dbc,$query) ;
  check_results($results) ;
  return $results ;
}
function get_emp_name($dbc, $emp_id){
  require( 'includes/connect_db_c9.php' ) ; 
	$query = "SELECT EMP_NAME FROM EMPLOYER WHERE EMP_ID = '$emp_id'";
	//show_query($query) ;
    $results = mysqli_query( $dbc, $query ) ;
    if(!$results){
    	echo "didnt work";
    }
	$row = mysqli_fetch_array($results, MYSQLI_ASSOC) ;
	$emp_name = $row ['EMP_NAME'];
	return $emp_name;
}
function show_employer_results($dbc, $searchString){
  require( 'includes/connect_db_c9.php' ) ; 
	$query = "SELECT * FROM EMPLOYER WHERE EMP_NAME LIKE '%$searchString%' ORDER BY EMP_NAME";
	$results = mysqli_query($dbc, $query);
	echo '<div class="span3" style="height: 200px !important; overflow: auto;">';
	echo '<TABLE class="table table-condensed table-striped table-hover">';
	echo '<THEAD>';
	echo '<TR>';
	echo '<TH>Name</TH>';
	echo '<TH>Email</TH>';
	echo '<TH>Phone</TH>';
	echo '</TR>';
	echo '</THEAD>';
	echo '<TBODY>';
	if($results){
		while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) ){
			echo "<TR class='clickable-row'>";
			echo '<TD>' . $row['EMP_NAME'] . '</TD>' ;
			echo '<TD>' . $row['EMP_EMAIL'] . '</TD>' ;
			echo '<TD>' . $row['EMP_PHONE'] . '</TD>' ;
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