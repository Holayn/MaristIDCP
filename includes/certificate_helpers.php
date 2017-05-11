<?php
$debug = true;

#Insert new certificate
function insert_certificate($dbc, $cert_name, $prg_id) {
require( 'includes/connect_db_c9.php' ) ; 
  $query = 'INSERT INTO CERTIFICATE(CERT_NAME, PRG_ID) VALUES ("'.$cert_name.'" , '.$prg_id.')' ;
 //show_query($query);
  $results = mysqli_query($dbc,$query) ;
  check_results($results) ;
  return $results ;
}

#Shows results of certificate
function show_brief_certificate_results($dbc, $string){
	require( 'includes/connect_db_c9.php' ) ; 
	$query = "SELECT CERTIFICATE.CERT_ID, CERTIFICATE.CERT_NAME, PROGRAM.PRG_NAME FROM CERTIFICATE, PROGRAM WHERE CERTIFICATE.PRG_ID = PROGRAM.PRG_ID AND (CERT_ID LIKE '%$string%' OR CERT_NAME LIKE '%$string%') ORDER BY CERT_NAME";
	// show_query($query);
	$results = mysqli_query($dbc, $query);
	echo '<div class="span3" style="height: 200px !important; overflow: auto;">';
	echo '<TABLE class="table table-condensed table-striped table-hover">';
	echo '<THEAD>';
	echo '<TR>';
	//echo '<TH>ID</TH>';
	echo '<TH>Name</TH>';
	echo '<TH>Program</TH>';
	echo '</TR>';
	echo '</THEAD>';
	echo '<TBODY>';
	if($results){
		while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) ){
			echo "<TR class='clickable-row'>";
			//echo '<TD>' . $row['CERT_ID'] . '</TD>' ;
			echo '<TD>' . $row['CERT_NAME'] . '</TD>' ;
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

#Shows results of certificate students
function show_brief_certificate_students($dbc, $cert_id, $order){
	require( 'includes/connect_db_c9.php' ) ; 
	$query = "SELECT STUDENT.STU_ID, STU_LNAME, STU_INITIAL, STU_FNAME, EARN_DATE, MAIL_DATE FROM CERT_EARNED, STUDENT WHERE CERT_EARNED.STU_ID = STUDENT.STU_ID AND CERT_ID =".$cert_id."";
// echo $query;
	//show_query($query);
	if($order == "Last Name"){
		$query = $query . ' ORDER BY STU_LNAME, STU_FNAME ';
	}
	else if($order == "First Name"){
		$query = $query . ' ORDER BY STU_FNAME, STU_LNAME ';
	}
	else if($order == "ID"){
		$query = $query . ' ORDER BY STU_ID ';
	}
	else if($order == "Earn Date"){
		$query = $query . ' ORDER BY EARN_DATE ';
	}
	else if($order == "Mail Date"){
		$query = $query . ' ORDER BY MAIL_DATE ';
	}
	else{
		$query = $query . ' ORDER BY STU_LNAME, STU_FNAME ';
	}	
	$results = mysqli_query($dbc, $query);
	echo '<div class="span3" style="height: 200px !important; overflow: auto;">';
	echo '<TABLE class="table table-condensed table-striped table-hover">';
	echo '<THEAD>';
	echo '<TR>';
	echo '<TH>ID</TH>';
	echo '<TH>Last Name</TH>';
	echo '<TH>Initial</TH>';
	echo '<TH>First Name</TH>';
	echo '<TH>Earn Date</TH>';
	echo '<TH>Mail Date</TH>';
	echo '</TR>';
	echo '</THEAD>';
	echo '<TBODY>';
	if($results){
		while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) ){
			echo "<TR class='clickable-row'>";
			echo '<TD>' . $row['STU_ID'] . '</TD>' ;
			echo '<TD>' . $row['STU_LNAME'] . '</TD>' ;
			echo '<TD>' . $row['STU_INITIAL'] . '</TD>' ;
			echo '<TD>' . $row['STU_FNAME'] . '</TD>' ;
			echo '<TD>' . $row['EARN_DATE'] . '</TD>' ;
			echo '<TD>' . $row['MAIL_DATE'] . '</TD>' ;
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

#Shows filter results of certificate students
function show_filter_certificate_results($dbc, $earn_yr){
	require( 'includes/connect_db_c9.php' ) ; 
	$query = "SELECT CERT_EARNED.* FROM CERT_EARNED, STUDENT WHERE (CERT_EARNED.STU_ID = STUDENT.STU_ID AND CERT_ID =".$cert_id.") AND EARN_YR=".$earn_yr."";
    echo $query;
	//show_query($query);
	$results = mysqli_query($dbc, $query);
	echo '<div class="span3" style="height: 200px !important; overflow: auto;">';
	echo '<TABLE class="table table-condensed table-striped table-hover">';
	echo '<THEAD>';
	echo '<TR>';
	echo '<TH>Student ID</TH>';
	echo '<TH>Last Name</TH>';
	echo '<TH>Initial</TH>';
	echo '<TH>First Name</TH>';
	echo '<TH>Earn Date</TH>';
	echo '<TH>Mail Date</TH>';
	echo '</TR>';
	echo '</THEAD>';
	echo '<TBODY>';
	if($results){
		while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) ){
			echo '<TR>';
			$row_id = 0;
			while ($row_id < count($row)){
				echo '<TD>'.$row[$row_id].'</TD>';
				$row_id++;
			}
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

# Gets the name of the certificate from the certificate ID
function get_cert_name($dbc, $cert_id){
	require( 'includes/connect_db_c9.php' ) ; 
	$query = "SELECT CERT_NAME FROM CERTIFICATE WHERE CERT_ID = $cert_id";
	//show_query($query) ;
    $results = mysqli_query( $dbc, $query ) ;
    if($results){
    $row = mysqli_fetch_array($results, MYSQLI_ASSOC);
    $cert_name = $row [ 'CERT_NAME' ] ;
    return $cert_name;
    }
    else{
    		echo $cert_id;
    }
    mysqli_free_result( $results );
		mysqli_close( $dbc ) ;
}
function get_cert_id($dbc, $cert_name){
	require( 'includes/connect_db_c9.php' ) ; 
	$query = "SELECT CERT_ID FROM CERTIFICATE WHERE CERT_NAME = '$cert_name'";
	//show_query($query) ;
    $results = mysqli_query( $dbc, $query ) ;
    if($results){
    $row = mysqli_fetch_array($results, MYSQLI_ASSOC);
    $cert_id = $row [ 'CERT_ID' ] ;
    return $cert_id;
    }
    else{
    		echo $cert_id;
    }
    mysqli_free_result( $results );
		mysqli_close( $dbc ) ;
}

# Gets the program of the certificate from the certificate ID
function get_prg_name($dbc, $cert_id){
	require( 'includes/connect_db_c9.php' ) ; 
	$query = "SELECT PRG_NAME FROM PROGRAM, CERTIFICATE WHERE CERTIFICATE.PRG_ID = PROGRAM.PRG_ID AND CERT_ID =".$cert_id."";
	//show_query($query) ;
    $results = mysqli_query( $dbc, $query ) ;
    if($results){
    $row = mysqli_fetch_array($results, MYSQLI_ASSOC);
    $prg_name = $row [ 'PRG_NAME' ] ;
    return $prg_name;
    }
    else{
    		echo "Error";
    }
    mysqli_free_result( $results );
	mysqli_close( $dbc ) ;
}

function update_record_cert($dbc, $cert_id, $cert_name, $prg_id){
	require( 'includes/connect_db_c9.php' ) ; 
	$query = 'UPDATE CERTIFICATE SET CERT_NAME = "'.$cert_name.'", PRG_ID = '.$prg_id.' WHERE CERT_ID = '.$cert_id.'';
	$results = mysqli_query($dbc,$query) ;
	check_results($results) ;
	return $results ;
}

# Checks the query results as a debugging aid
function check_results($results) {
  global $dbc;

  if($results != true)
    echo '<p>SQL ERROR = ' . mysqli_error( $dbc ) . '</p>'  ;
}

#get program id
function get_prg_id($dbc, $prg_name){
	require( 'includes/connect_db_c9.php' ) ; 
	$query = "SELECT PRG_ID FROM PROGRAM WHERE PRG_NAME='".$prg_name."'";
	$results = mysqli_query($dbc,$query) ;
	if($results){
	    $row = mysqli_fetch_array($results, MYSQLI_ASSOC);
	    $prg_id = $row [ 'PRG_ID' ] ;
	    return $prg_id;
	    }
	    else{
	    		echo "Error";
	    }
    mysqli_free_result( $results );
	mysqli_close( $dbc ) ;
}
?>