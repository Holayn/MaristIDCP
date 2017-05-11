<?php

$debug = true;

$q = $_GET['q'];

require('includes/connect_db_c9.php');

mysqli_select_db($dbc,"ajax_demo");

if(isset($q)){
	//$q = explode(".", $q);
	$query ="SELECT STU_ID, STU_TAG, STU_LNAME, STU_FNAME FROM STUDENT, EMPLOYER WHERE STUDENT.EMP_ID=EMPLOYER.EMP_ID AND EMPLOYER.EMP_NAME LIKE'%".$q."%'";
	echo $query; 
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
?>