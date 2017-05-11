<?php
  require( 'includes/connect_db_c9.php' ) ; 
$debug = true;


function delete_student($dbc, $stu_id){
    require( 'includes/connect_db_c9.php' ) ; 

   $query = "DELETE FROM PRG_ENROLLED WHERE STU_ID = '$stu_id'";
  $results = mysqli_query($dbc,$query) ;
  check_delete_results($results) ;

   $query = "DELETE FROM CERT_EARNED WHERE STU_ID = '$stu_id'";
  $results = mysqli_query($dbc,$query) ;
  check_delete_results($results) ;

  $query = "DELETE FROM CRS_ENROLLED WHERE STU_ID = '$stu_id'";
  $results = mysqli_query($dbc,$query) ;
  check_delete_results($results) ;

	$query = "DELETE FROM STUDENT WHERE STU_ID = '$stu_id'";
  $results = mysqli_query($dbc,$query) ;
  check_delete_results($results) ;

}
function delete_employer($dbc, $emp_name){
  require( 'includes/connect_db_c9.php' ) ; 

  $query = "DELETE FROM EMPLOYER WHERE EMP_NAME = '$emp_name'";
  $results = mysqli_query($dbc,$query) ;
  check_delete_results($results) ;
}
function delete_instructor($dbc, $ins_id){
  require( 'includes/connect_db_c9.php' ) ; 
  $query = "DELETE FROM TEACHES WHERE INS_ID = $ins_id";
  $results = mysqli_query($dbc,$query) ;
  $query = "DELETE FROM INSTRUCTOR WHERE INS_ID = $ins_id";
  $results = mysqli_query($dbc,$query) ;
}
function delete_other_user($dbc, $other_user_id){
  require( 'includes/connect_db_c9.php' ) ; 
  $query = "DELETE FROM IDCP_USER WHERE USER_ID = '$other_user_id'";
  $results = mysqli_query($dbc,$query) ;
  check_delete_results($results) ;
}
function delete_student_program($dbc, $prg_id, $stu_id, $prg_enroll_start){
  require( 'includes/connect_db_c9.php' ) ; 
  $query = "DELETE FROM PRG_ENROLLED WHERE PRG_ID = $prg_id AND STU_ID = $stu_id AND PRG_ENROLL_START = '$prg_enroll_start'";
  // echo $query;
  $results = mysqli_query($dbc,$query) ;
  // check_delete_results($results) ;
	mysqli_close( $dbc ) ;
}
function delete_student_course($dbc, $crs_id, $stu_id, $crs_enroll_start){
  require( 'includes/connect_db_c9.php' ) ; 
  $query = "DELETE FROM CRS_ENROLLED WHERE CRS_ID = '$crs_id' AND STU_ID = $stu_id AND CRS_ENROLL_START = '$crs_enroll_start'";
  // echo $query;
  $results = mysqli_query($dbc,$query) ;
  // check_delete_results($results) ;
	mysqli_close( $dbc ) ;
}

function delete_student_certificate($dbc, $stu_id, $cert_id){
  require( 'includes/connect_db_c9.php' ) ; 
  $query = "DELETE FROM CERT_EARNED WHERE CERT_ID = '$cert_id' AND STU_ID = $stu_id";
  // echo $query;
  $results = mysqli_query($dbc,$query) ;
  // check_delete_results($results) ;
	mysqli_close( $dbc ) ;
  
}
function delete_program($dbc, $prg_id){
  require( 'includes/connect_db_c9.php' ) ; 

  $query = "DELETE FROM PRG_ENROLLED WHERE PRG_ID = $prg_id";
  $results = mysqli_query($dbc,$query) ;
  check_delete_results($results) ;
  
  $query = "DELETE ce FROM CERT_EARNED ce, CERTIFICATE c WHERE c.PRG_ID = $prg_id AND c.CERT_ID = ce.CERT_ID";
  $results = mysqli_query($dbc,$query) ;
  check_delete_results($results) ;

  $query = "DELETE FROM CERTIFICATE WHERE PRG_ID = $prg_id";
  $results = mysqli_query($dbc,$query) ;
  check_delete_results($results) ;

  $query = "DELETE FROM CRS_MADE_OF WHERE PRG_ID = $prg_id";
  $results = mysqli_query($dbc,$query) ;
  check_delete_results($results) ;

	$query = "DELETE FROM PROGRAM WHERE PRG_ID = $prg_id";
  $results = mysqli_query($dbc,$query) ;
  check_delete_results($results) ;

}

function delete_certificate($dbc, $cert_id){
  require( 'includes/connect_db_c9.php' ) ; 

  $query = "DELETE FROM CERT_EARNED WHERE CERT_ID = '$cert_id'";
  $results = mysqli_query($dbc,$query) ;
  check_delete_results($results) ;

  $query = "DELETE FROM CERTIFICATE WHERE CERT_ID = '$cert_id'";
  $results = mysqli_query($dbc,$query) ;
  check_delete_results($results) ;

}

function delete_course($dbc, $crs_id){
    require( 'includes/connect_db_c9.php' ) ; 

   $query = "DELETE FROM CRS_ENROLLED WHERE CRS_ID = '$crs_id'";
  $results = mysqli_query($dbc,$query) ;
  check_delete_results($results) ;

   $query = "DELETE FROM CRS_MADE_OF WHERE CRS_ID = '$crs_id'";
  $results = mysqli_query($dbc,$query) ;
  check_delete_results($results) ;

  $query = "DELETE FROM TEACHES WHERE CRS_ID = '$crs_id'";
  $results = mysqli_query($dbc,$query) ;
  check_delete_results($results) ;

	$query = "DELETE FROM COURSE WHERE CRS_ID = '$crs_id'";
  $results = mysqli_query($dbc,$query) ;
  check_delete_results($results) ;

}

function show_delete_query($query) {
  global $debug;

  if($debug)
    echo "<p>Query = $query</p>" ;
}

function check_delete_results($results) {
  global $dbc;

  if($results != true)
    echo '<p>SQL ERROR = ' . mysqli_error( $dbc ) . '</p>'  ;
}


?>