<?php

$debug = true;

$q = $_GET['q'];

require('includes/connect_db_c9.php');

mysqli_select_db($dbc,"ajax_demo");

if(isset($q)){
	$q = explode(".", $q);
	$query ="SELECT * FROM CERT_EARNED, STUDENT WHERE CERT_EARNED.STU_ID=STUDENT.STU_ID AND CERT_ID=".$q[0]." AND EARN_YR=".$q[1]."";
	echo $query; 
	
	$results = mysqli_query($dbc, $query);
		echo '<div class="span3" style="height: 200px !important; overflow: auto;">';
		echo '<TABLE class="table table-condensed table-striped table-hover">';
		echo '<THEAD>';
		echo '<TR>';
		echo '<TH>Student ID</TH>';
		echo '<TH>Student Name</TH>';
		echo '<TH>Earn Date</TH>';
		echo '<TH>Mail Date</TH>';
		echo '</TR>';
		echo '</THEAD>';
		echo '<TBODY>';
	if($results){
		while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) ){
			$stu_name = $row['STU_FNAME'].' '.$row['STU_INITIAL'].' '. $row['STU_LNAME'];
			$earn_day = $row['EARN_MON'].'/'.$row['EARN_DAY'].'/'. $row['EARN_YR'];
			$mail_day = $row['MAIL_MON'].'/'.$row['MAIL_DAY'].'/'. $row['MAIL_YR'];
			echo "<TR class='clickable-row'>";
			echo '<TD>' . $row['STU_ID'] . '</TD>' ;
			echo '<TD>' . $stu_name . '</TD>' ;
			echo '<TD>' . $earn_day . '</TD>' ;
			echo '<TD>' . $mail_day . '</TD>' ;
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
 