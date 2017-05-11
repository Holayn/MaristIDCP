<!DOCTYPE html>
<html>
    <head>
        <title> </title>
    </head>
    <body>
<script type="text/javascript" src="http://ajax.googleapis.com/
ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
$(".country").change(function()
{
var id=$(this).val();
var dataString = 'id='+ id;

$.ajax
({
type: "POST",
url: "test.php",
data: dataString,
cache: false,
success: function(html)
{
$(".city").html(html);
} 
});

});

});
</script>
//HTML Code
Country :
<select name="country" class="country">
<option selected="selected">--Select Country--</option>
<?php
	require( 'includes/connect_db_c9.php' ) ;
$sql=mysql_query("select id,data from data where weight='1'");
while($row=mysql_fetch_array($sql))
{
$id=$row['id'];
$data=$row['data'];
echo '<option value="'.$id.'">'.$data.'</option>';
} ?>
</select> <br/><br/>

City :
<select name="city" class="city">
<option selected="selected">--Select City--</option>
</select>
    </body>
</html>



	// echo "<div class='form-group'>";
	// echo "<label class='col-xs-3 control-label'>Specific:*</label>";
	// echo "<div class='col-xs-2'>";
 //   echo "<input type='text' class='form-control' name='spec' value='<?php if (isset(\$_POST['spec'])) echo \$_POST['spec'];?>' data-error='Please list the specification' required>";
	// echo "</div>";
	// echo "<div class='help-block with-errors'></div>";
	// echo "</div>";