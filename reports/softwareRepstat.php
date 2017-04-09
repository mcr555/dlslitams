<html>
<body>  


<?php 
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
<b>Software</b>
</td></tr>
</center>
</font>
</table>
";
?>

<form action="reportsphp/softwarestat.php" method="POST">
<table align="center" height="100" cellpadding='10' width ="700" bgcolor='#e0e0e0'>
<tr> 
	<br><br><br><br><br><br><br><br><br>
	<td align = "center"><H1 align = "center">Software Status</H1>
	
 <select name=software>

  <option value="all">All</option>
  <option value="0">undeployed</option>
    <option value="1">deployed</option>
     <option value="3">Expired</option>


</select>
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
