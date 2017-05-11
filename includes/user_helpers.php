<?php
$debug = true;

# Adds a new user to a database
function add_new_user_record($dbc, $user_id, $user_pwd, $user_role) {
  require( 'includes/connect_db_c9.php' ) ; 
  $user_pwd = SHA1($user_pwd);
  $query = "INSERT INTO IDCP_USER(USER_ID, USER_PWD, USER_ROLE) VALUES('".$user_id."','".$user_pwd."', '".$user_role."')";
  //show_query($query);
  $results = mysqli_query($dbc,$query) ;
  return $results ;
}

function update_user_record($dbc, $old_user_id, $new_user_id, $user_role){
  require( 'includes/connect_db_c9.php' ) ; 
  $_SESSION['user_role'] = $user_role;
  $query = "UPDATE IDCP_USER SET USER_ID = '$new_user_id', USER_ROLE = '$user_role' WHERE USER_ID = '$old_user_id'";
  $results = mysqli_query($dbc,$query) ;
  return $results ;
}

function update_other_user_record($dbc, $old_user_id, $new_user_id, $user_role){
  require( 'includes/connect_db_c9.php' ) ; 
  $query = "UPDATE IDCP_USER SET USER_ID = '$new_user_id', USER_ROLE = '$user_role' WHERE USER_ID = '$old_user_id'";
  $results = mysqli_query($dbc,$query) ;
  return $results ;
}

function update_user_password($dbc, $user_id, $user_pwd_new){
  require( 'includes/connect_db_c9.php' ) ; 
  $user_pwd_new = SHA1($user_pwd_new);
  $query = "UPDATE IDCP_USER SET USER_PWD='".$user_pwd_new."' WHERE USER_ID = '$user_id'";
  //show_query($query);
  $results = mysqli_query($dbc,$query) ;
  return $results ;
}

function get_user_role($dbc, $user_id){
  require( 'includes/connect_db_c9.php' ) ; 
  $query = "SELECT USER_ROLE FROM IDCP_USER WHERE USER_ID = '$user_id'";
 // show_query($query);
  $results = mysqli_query($dbc,$query);
  if ($results){
    $row = mysqli_fetch_array( $results , MYSQLI_ASSOC );
    return $row['USER_ROLE'];
  }
    else{
    		echo $user_id;
    }
    mysqli_free_result( $results );
		mysqli_close( $dbc ) ;
}

function show_user_results($dbc){
  $query = "SELECT USER_ID, USER_ROLE FROM IDCP_USER";
	// show_query($query);
	$results = mysqli_query($dbc, $query);
	echo '<div class="span3" style="height: 200px !important; overflow: auto;">';
	echo '<TABLE class="table table-condensed table-striped table-hover">';
	echo '<THEAD>';
	echo '<TR>';
	echo '<TH>User Id</TH>';
	echo '<TH>User Role</TH>';
	echo '</TR>';
	echo '</THEAD>';
	echo '<TBODY>';
	if($results){
		while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) ){
			echo "<TR class='clickable-row'>";
			echo '<TD>' . $row['USER_ID'] . '</TD>' ;
			echo '<TD>' . $row['USER_ROLE'] . '</TD>' ;
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