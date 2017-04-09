<html>
<body>  


<?php 
require_once('db.php');
$sql = "SELECT * FROM hardware";
$result = $conn->query($sql);
echo "

<style>
<link rel='stylesheet' type='text/css' href='style.css'>
</style>

<body bgcolor='#3366cc'>

<table bgcolor='#e0e0e0' width='100%' height='100' >

<tr><td>
<td>
<font size='20' color='#000066' face='Verdana'><center>
<b>IT Asset Managment System</b><br>
<b>Hardware</b>
</td></tr>
</center>
</font>
</table>
";
?>


<form action="reportsphp/hardwareloc.php" method="POST">
<table align="center" height="100" cellpadding='10' width ="700" bgcolor='#e0e0e0'>
<tr> 

	<br><br><br><br><br><br><br><br><br>
	<td align = "center">
	<H1 align = "center">Location of hardware</H1>
	 
      <?php

    $select= '<select name="asset_id">';
    
    while($row = $result->fetch_assoc()) 
    $select.='<option value="'.$row['location'].'">'.$row['location'].'</option>';
    $select.='</select>';

echo $select;
?>
<br><br><br>
<input type='submit' name='Generate'></button></a></td>
 

<td><td>
	</tr>

</form>
</table><br>

</td>
</table>
</body>
</html>
<html>
<body>  

