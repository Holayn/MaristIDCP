<?php

$debug = true;

$q = $_GET['q'];

require('includes/connect_db_c9.php');

mysqli_select_db($dbc,"ajax_demo");

if(isset($q)){
	$q = explode(".", $q);
	$query ="SELECT DISTINCT ".$q[0]." FROM ".strtoupper($q[1])."";
	$results = mysqli_query($dbc,$query);
	
	echo "<label>specifically:</label>";
	echo $query;
	echo "<select class=\"form-control\" name=\"spec\" value=\"<?php if (isset(\$_POST[\'spec\'])) echo \$_POST[\'spec\'];?>\" data-error=\"Please enter the certificate id\" required>";
	echo "<option disabled selected value>---</option>";
	    if($results){
	        while ($row = mysqli_fetch_array($results,MYSQLI_NUM))
			{
				$row_id = 0;
				while ($row_id < count($row)){
					echo '<option>'.$row[$row_id].'</option>';
					$row_id++;
				}
			}
	    }
	    else
		{
			echo '<p>' . mysqli_error( $dbc ) . '</p>'  ;
		}
	echo "</select>";
	mysqli_close($dbc);
}
else
	echo "Error";
?>
 