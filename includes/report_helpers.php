<?php

$debug = true;

$field_name = array("STU_ID"=>"Student ID","STU_TAG"=>"Tag", "STU_LNAME"=>"Last Name", "STU_FNAME"=>"First Name", "STU_INITIAL"=>"Initial", 
"STU_START"=>"Date Started", "STU_END"=>"Date Ended", "STU_EDU_LVL"=>"Education Level", "STU_JOB_TITLE"=>"Job Title", "STU_STREET"=>"Street Address", "STU_CITY"=>"City", "STU_STATE"=>"State", "STU_COUNTRY"=>"Country", "STU_ZIP"=>"Zip Code",
"STU_PHONE"=>"Phone", "STU_EMAIL_1"=>"Email 1", "STU_EMAIL_2"=>"Email 2", "STU_DOB"=>"Date of Birth", "STU_ETHNICITY"=>"Ethnicity", "STU_CITY"=>"City", "STU_GENDER"=>"Gender", "STU_CITIZEN"=>"Citizenship", "STU_TRANSCRIPT"=>"Transcript", "STU_COMMENT"=>"Comment", 
"CERT_ID"=>"Certificate ID", "CERT_NAME"=>"Name", "MAIL_DATE"=>"Year Mailed", "EARN_DATE"=>"Year Earned", "INS_ID"=>"Instructor ID", "INS_LNAME"=>"Last Name", "INS_INITIAL"=>"Initial", "INS_FNAME"=>"First Name", "INS_EMAIL"=>"Email", 
"CRS_ID"=>"Course ID", "GRADE"=>"Grade","CRS_NAME"=>"Name", "CRS_LEVEL"=>"Level", "CRS_ENROLL_START"=>"Date Enrolled", "CRS_ENROLL_END"=>"Date Ended", "PRG_ENROLL_START" => "Date Enrolled", "PRG_ENROLL_END" => "Date Ended","PRG_ID"=>"Program ID", "PRG_NAME"=>"Name","STU_QUALIFY_EXAM" => "Exam Qualification", "EMP_ID"=>"Employer ID", "EMP_NAME"=>"Employer Name", "EMP_EMAIL"=>"Email", "EMP_PHONE"=>"Phone");


function show_course($dbc, $statement){
	require('connect_db_c9.php');
	$query = ''.$statement.'';
	$results = mysqli_query($dbc,$query);
	$field_count = 0;
	if ($results){
		echo '<TABLE border=2>';
		echo '<TR>';
		while ($fieldinfo=mysqli_fetch_field($results)){
			echo '<TH>'.$fieldinfo->name.'</TH>';
		}
		echo '</TR>';
		while ($row = mysqli_fetch_array($results,MYSQLI_NUM)){
			echo '<TR>';
			$row_id = 0;
			while ($row_id < count($row)){
			echo '<TD>'.$row[$row_id].'</TD>';
			$row_id++;
			}
			echo '</TR>';
		}
		echo '</TABLE>';
		mysqli_free_result($results) ;
	}
	else{
		echo '<p>'.mysqli_error($dbc).'</p>';
	}
	mysqli_close($dbc);
}

function generate_report($dbc,$statement){
	require('connect_db_c9.php');
	if($statement='')
		$statement = 'SELECT * FROM INSTRUCTOR';
	$query = ''.$statement.'';
	$result = mysqli_query($dbc,$query);
}

function show_stu_crs($dbc,$id){
	require('connect_db_c9.php');
	$query = 'SELECT CRS_NAME, CRS_ENROLL_STATUS FROM COURSE, CRS_ENROLLED WHERE COURSE.CRS_ID=CRS_ENROLLED.CRS_ID AND STU_ID='.$id.'';
	$results = mysqli_query($dbc,$query);
	if($results){
		while ($row = mysqli_fetch_array($results,MYSQLI_NUM)){
				echo '<LABEL>'.$row[0].'</LABEL>';
				echo '<p class="form-control-static">'.$row[1].'<p class="form-control-static">';
			}
			mysqli_free_result($results) ;
	}
	else{
		echo '<p>'.mysqli_error($dbc).'</p>';
	}
	mysqli_close($dbc);
}

function show_stu_cert($dbc,$id){
	require('connect_db_c9.php');
	$query = 'SELECT CERT_NAME, EARN_DATE FROM CERTIFICATE AS C, CERT_EARNED AS CE WHERE C.CERT_ID=CE.CERT_ID AND STU_ID='.$id.'';
	$results = mysqli_query($dbc,$query);
	// if(mysqli_num_rows($results) == 0) {echo '<p>(None)</p>';}
	// if($results){
	// 	while ($row = mysqli_fetch_array($results,MYSQLI_NUM)){
	// 			echo '<LABEL>'.$row[0].'</LABEL>';
	// 			echo '<p class="form-control-static">'.$row[1].'<p class="form-control-static">';
	// 		}
	// 		mysqli_free_result($results) ;
	// }
	// else{
	// 	echo '<p>'.mysqli_error($dbc).'</p>';
	// }
	$counter = 0;
	if(mysqli_num_rows($results) == 0) {echo '<p>(None)</p>';}
		while($row = mysqli_fetch_array($results, MYSQLI_ASSOC)){
			if($counter < 5){
				echo '<p><label>'.$row['CERT_NAME'].'</label> ';
				echo " (" . $row['EARN_DATE'] . ")";
				echo '</p>';
				$counter++;
			}
		}
	mysqli_close($dbc);
}

function show_basic_report($dbc, $entity, $ent_name, $where, $spec){
	require('connect_db_c9.php');
	$spec = mysqli_real_escape_string($dbc, trim($_POST['spec']));
	global $field_name;
	if($ent_name == 'all'){
	    if($entity == 'PROGRAM'){
            $clause = "PROGRAM, PRG_ENROLLED WHERE STUDENT.STU_ID=PRG_ENROLLED.STU_ID AND PROGRAM.PRG_ID=PRG_ENROLLED.PRG_ID";
        }
        elseif($entity == 'COURSE'){
            $clause = "COURSE, CRS_ENROLLED WHERE STUDENT.STU_ID=CRS_ENROLLED.STU_ID AND COURSE.CRS_ID=CRS_ENROLLED.CRS_ID";
        }
        elseif($entity == 'CERTIFICATE'){
            $clause = "CERTIFICATE, CERT_EARNED WHERE STUDENT.STU_ID=CERT_EARNED.STU_ID AND CERTIFICATE.CERT_ID=CERT_EARNED.CERT_ID";
        }
        else{
            $clause = "EMPLOYER WHERE EMPLOYER.EMP_ID=STUDENT.EMP_ID";
        }
        $eng_statement = "How many students in all ".strtolower($entity)."s where their ". strtolower($field_name[$where])." is $spec";
	}
	else {
	    if($entity == 'PROGRAM'){
            $clause = "PROGRAM, PRG_ENROLLED WHERE STUDENT.STU_ID=PRG_ENROLLED.STU_ID AND PROGRAM.PRG_ID=PRG_ENROLLED.PRG_ID AND PRG_NAME='$ent_name'";
        }
        elseif($entity == 'COURSE'){
            $clause = "COURSE, CRS_ENROLLED WHERE STUDENT.STU_ID=CRS_ENROLLED.STU_ID AND COURSE.CRS_ID=CRS_ENROLLED.CRS_ID AND CRS_NAME='$ent_name'";
        }
        elseif($entity == 'CERTIFICATE'){
            $clause = "CERTIFICATE, CERT_EARNED WHERE STUDENT.STU_ID=CERT_EARNED.STU_ID AND CERTIFICATE.CERT_ID=CERT_EARNED.CERT_ID AND CERT_NAME='$ent_name'";
        }
        else{
            $clause = "EMPLOYER WHERE EMPLOYER.EMP_ID=STUDENT.EMP_ID AND EMP_NAME='$ent_name'";
        }
        $eng_statement = "How many students in ".strtolower($entity)." named '$ent_name' where their ". strtolower($field_name[$where])." is $spec";
	}
	if($where == "EMP_NAME"){
		$query = "SELECT DISTINCT STUDENT.STU_ID, STU_LNAME, STU_FNAME, STU_INITIAL, $where FROM EMPLOYER, STUDENT, $clause AND STUDENT.EMP_ID=EMPLOYER.EMP_ID AND $where LIKE '%".$spec."%' ORDER BY STU_LNAME, STU_FNAME";
	}
	elseif($spec == "male" || $spec == "Male"){
		$query = "SELECT DISTINCT STUDENT.STU_ID, STU_LNAME, STU_FNAME, STU_INITIAL, $where FROM STUDENT, $clause AND STU_GENDER = '".$spec."' ORDER BY STU_LNAME, STU_FNAME";
	}
	else{
		$query = "SELECT DISTINCT STUDENT.STU_ID, STU_LNAME, STU_FNAME, STU_INITIAL, $where FROM STUDENT, $clause AND ($where LIKE '%".$spec."%' OR ".$where." = '".$spec."') ORDER BY STU_LNAME, STU_FNAME";
	}
	$_SESSION['query'] = $query;
	$_SESSION['eng_statement'] = $eng_statement;
	// echo $query;
	global $field_name;
	$results = mysqli_query($dbc,$query);
	if ($results){
		$num_rows = mysqli_num_rows($results);
		echo '<h3>'.$eng_statement.'?</h3>';
		echo '<h4>Number of students found:'.$num_rows.'</h4>';
		echo '<div class="span3" style="height: 200px !important; overflow: auto;">';
		echo '<div id="printableArea">';
        echo '<div class="example-print">';
        echo '<img src="footer_logo.png">';
        echo '<div class="page-header">';
        echo '<h1>Report</h1>';
		echo '<h3>'.$eng_statement.'?</h3>';
		echo '<h4>Number of students found:'.$num_rows.'</h4>';        
        echo '</div>';
        echo '</div>';
		echo '<TABLE id="report" class="table table-condensed table-striped table-hover">';
		echo '<THEAD>';
		echo '<TR>';
		while ($fieldinfo=mysqli_fetch_field($results)){
			echo '<TH>'.$field_name[$fieldinfo->name].'</TH>';
		}
		echo '</TR>';
		echo '</THEAD>';
		echo '<TBODY>';
		while ($row = mysqli_fetch_array($results,MYSQLI_NUM)){
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
		echo '</DIV>';
		echo '</DIV>';
		mysqli_free_result($results) ;
	}
	else{
		echo '<p>'.mysqli_error($dbc).'</p>';
	}
	mysqli_close($dbc);
}

function show_demographic_report($dbc, $demographic, $spec){
	require('connect_db_c9.php');
	global $field_name;
	if($spec == "male" || $spec == "Male"){
		$query = 'SELECT STU_ID, STU_LNAME, STU_FNAME, STU_INITIAL, '.$demographic.' FROM STUDENT WHERE STU_GENDER= "'.$spec.'" ORDER BY STU_LNAME, STU_FNAME';
	}
	else{
		$query = 'SELECT STU_ID, STU_LNAME, STU_FNAME, STU_INITIAL, '.$demographic.' FROM STUDENT WHERE '.$demographic.' LIKE "%'.$spec.'%" ORDER BY STU_LNAME, STU_FNAME';
	}
	// echo $query;
	$eng_statement = "How many students' ". strtolower($field_name[$demographic]). " is " .$spec. "" ;
	$_SESSION['query'] = $query;
	$_SESSION['eng_statement'] = $eng_statement;
	$results = mysqli_query($dbc,$query);
	if ($results){
		$num_rows = mysqli_num_rows($results);
		echo '<h3>'.$eng_statement.'?</h3>';
		echo '<h4>Number of students found:'.$num_rows.'</h4>';
		echo '<div class="span3" style="height: 200px !important; overflow: auto;">';
		echo '<div id="printableArea">';
        echo '<div class="example-print">';
        echo '<img src="footer_logo.png">';
        echo '<div class="page-header">';
        echo '<h1>Report</h1>';
		echo '<h3>'.$eng_statement.'?</h3>';
		echo '<h4>Number of students found:'.$num_rows.'</h4>';   
        echo '</div>';
        echo '</div>';
		echo '<TABLE id="report" class="table table-condensed table-striped table-hover">';
		echo '<THEAD>';
		echo '<TR>';
		while ($fieldinfo=mysqli_fetch_field($results)){
			echo '<TH>'.$field_name[$fieldinfo->name].'</TH>';
		}
		echo '</TR>';
		echo '</THEAD>';
		echo '<TBODY>';
		while ($row = mysqli_fetch_array($results,MYSQLI_NUM)){
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
		echo '</DIV>';
		echo '</DIV>';
		mysqli_free_result($results) ;
	}
	else{
		echo '<p>'.mysqli_error($dbc).'</p>';
	}
	mysqli_close($dbc);
}

function show_complex_report($dbc,$statement){
	require('connect_db_c9.php');
	global $field_name;
	$query = ''.$statement. ' ORDER BY STU_LNAME, STU_FNAME';
	// echo $query;
	$_SESSION['query'] = $query;
	$eng_statement = $_SESSION['eng_statement'];
	$results = mysqli_query($dbc,$query);
	if ($results){
		$num_rows = mysqli_num_rows($results);
		echo '<h3>'.$eng_statement.'?</h3>';
		echo '<h4>Number of students found:'.$num_rows.'</h4>';
		echo '<div class="span3" style="height: 200px !important; overflow: auto;">';
		echo '<div id="printableArea">';
        echo '<div class="example-print">';
        echo '<img src="footer_logo.png">';
        echo '<div class="page-header">';
        echo '<h1>Report</h1>';
    	echo '<h3>'.$eng_statement.'?</h3>';
		echo '<h4>Number of students found:'.$num_rows.'</h4>';   
        echo '</div>';
        echo '</div>';
		echo '<TABLE id="report" class="table table-condensed table-striped table-hover">';
		echo '<THEAD>';
		echo '<TR>';
		while ($fieldinfo=mysqli_fetch_field($results)){
			echo '<TH>'.$field_name[$fieldinfo->name].'</TH>';
		}
		echo '</TR>';
		echo '</THEAD>';
		echo '<TBODY>';
		while ($row = mysqli_fetch_array($results,MYSQLI_NUM)){
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
		echo '</DIV>';
		echo '</DIV>';
		mysqli_free_result($results) ;
		}
	else{
		echo '<p>'.mysqli_error($dbc).'</p>';
	}
	mysqli_close($dbc);
}

function show_specific_report($dbc,$statement){
	require('connect_db_c9.php');
	global $field_name;
	$query = "SELECT DISTINCT STUDENT.STU_ID, STU_LNAME, STU_FNAME, STU_INITIAL $statement ORDER BY STU_LNAME, STU_FNAME";
	$_SESSION['query'] = $query;
	$eng_statement = $_SESSION['eng_statement'];
	// echo $query;
	$results = mysqli_query($dbc,$query);
	if ($results){
		$num_rows = mysqli_num_rows($results);
		echo '<h3>'.$eng_statement.'?</h3>';
		echo '<h4>Number of student found:'.$num_rows.'</h4>';
		echo '<div class="span3" style="height: 200px !important; overflow: auto;">';
		echo '<div id="printableArea">';
        echo '<div class="example-print">';
        echo '<img src="footer_logo.png">';
        echo '<div class="page-header">';
        echo '<h1>Report</h1>';
		echo '<h3>'.$eng_statement.'?</h3>';
		echo '<h4>Number of students found:'.$num_rows.'</h4>';   
        echo '</div>';
        echo '</div>';
		echo '<TABLE id="report" class="table table-condensed table-striped table-hover">';
		echo '<THEAD>';
		echo '<TR>';
		while ($fieldinfo=mysqli_fetch_field($results)){
			echo '<TH>'.$field_name[$fieldinfo->name].'</TH>';
		}
		echo '</TR>';
		echo '</THEAD>';
		echo '<TBODY>';
		while ($row = mysqli_fetch_array($results,MYSQLI_NUM)){
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
		echo '</DIV>';
		echo '</DIV>';
		mysqli_free_result($results) ;
	}
	else{
		echo '<p>'.mysqli_error($dbc).'</p>';
	}
	mysqli_close($dbc);
}

function populate_demographic($dbc){
	require( 'includes/connect_db_c9.php' ) ;
	$query = 'SELECT STU_CITIZEN, STU_CITY, STU_COUNTRY, STU_EDU_LVL, STU_ETHNICITY, STU_GENDER, STU_JOB_TITLE, STU_STATE, STU_ZIP  FROM STUDENT';
    $results = mysqli_query($dbc, $query);
    global $field_name;
    
        if($results){
		while ($field=mysqli_fetch_field($results)){
		{
			echo '<option value="'.$field->name.'">'.$field_name[$field->name].'</option>';
			}
		}
    	}
	    else
		{
			echo '<p>' . mysqli_error( $dbc ) . '</p>'  ;
		}
	mysqli_free_result( $results );
	mysqli_close( $dbc ) ;
}

function populate_certificate($dbc){
	require( 'includes/connect_db_c9.php' ) ;
	$query = 'SELECT CERT_NAME FROM CERTIFICATE';
    $results = mysqli_query($dbc, $query);
    
    if($results){
		while ($row = mysqli_fetch_array($results, MYSQLI_ASSOC)){
			echo '<option value="'.$row['CERT_NAME'].'">'.$row['CERT_NAME'].'</option>';
    	}
    }
	else{
			echo '<p>' . mysqli_error( $dbc ) . '</p>'  ;
	}
	mysqli_free_result( $results );
	mysqli_close( $dbc ) ;
}

function populate_program($dbc){
	require( 'includes/connect_db_c9.php' ) ;
	$query = 'SELECT PRG_NAME FROM PROGRAM';
    $results = mysqli_query($dbc, $query);
    
    if($results){
		while ($row = mysqli_fetch_array($results, MYSQLI_ASSOC)){
			echo '<OPTION value="'.$row['PRG_NAME'].'">'.$row['PRG_NAME'].'</OPTION>';
    	}
    }
	else{
			echo '<p>' . mysqli_error( $dbc ) . '</p>'  ;
	}
	mysqli_free_result( $results );
	mysqli_close( $dbc ) ;
}

function populate_course($dbc){
	require( 'includes/connect_db_c9.php' ) ;
	$query = 'SELECT CRS_NAME FROM COURSE';
    $results = mysqli_query($dbc, $query);
    
    if($results){
		while ($row = mysqli_fetch_array($results, MYSQLI_ASSOC)){
			echo '<OPTION value="'.$row['CRS_NAME'].'">'.$row['CRS_NAME'].'</OPTION>';
    	}
    }
	else{
			echo '<p>' . mysqli_error( $dbc ) . '</p>'  ;
	}
	mysqli_free_result( $results );
	mysqli_close( $dbc ) ;
}

function populate_employer($dbc){
	require( 'includes/connect_db_c9.php' ) ;
	$query = 'SELECT EMP_NAME FROM EMPLOYER';
    $results = mysqli_query($dbc, $query);
    
    if($results){
		while ($row = mysqli_fetch_array($results, MYSQLI_ASSOC)){
			echo '<OPTION value="'.$row['EMP_NAME'].'">'.$row['EMP_NAME'].'</OPTION>';
    	}
    }
	else{
			echo '<p>' . mysqli_error( $dbc ) . '</p>'  ;
	}
	mysqli_free_result( $results );
	mysqli_close( $dbc ) ;
}

function populate_certificate_where($dbc){
	require( 'includes/connect_db_c9.php' ) ;
	$query = 'SELECT STU_EDU_LVL, STU_JOB_TITLE, STU_CITY, STU_STATE, STU_COUNTRY, STU_ZIP, STU_ETHNICITY, STU_GENDER, STU_CITIZEN, MAIL_YR, EARN_YR FROM CERT_EARNED, STUDENT';
    $results = mysqli_query($dbc, $query);
    global $field_name;
    
        if($results){
		while ($field=mysqli_fetch_field($results)){
		{
			echo '<OPTION value="'.$field->name.'">'.$field_name[$field->name].'</OPTION>';
			}
		}
    	}
	    else
		{
			echo '<p>' . mysqli_error( $dbc ) . '</p>'  ;
		}
	mysqli_free_result( $results );
	mysqli_close( $dbc ) ;
}

function populate_specific($dbc, $choice, $entity){
	require( 'includes/connect_db_c9.php' ) ;
	$query = 'SELECT '.$choice.' FROM '.$entity.'';
    $results = mysqli_query($dbc, $query);
    if($results){
        while ($row = mysqli_fetch_array($results,MYSQLI_NUM))
		{
			$row_id = 0;
			while ($row_id < count($row)){
				echo '<OPTION>'.$row[$row_id].'</OPTION>';
				$row_id++;
			}
		}
    }
    else
	{
		echo '<p>' . mysqli_error( $dbc ) . '</p>'  ;
	}
	mysqli_free_result( $results );
	mysqli_close( $dbc ) ;
}
?>
