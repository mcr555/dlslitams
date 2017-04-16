<script>
    window.onunload = refreshParent;
    function refreshParent() {
        window.opener.location.reload();
        window.close();
    }
</script>
<?php
session_start();
include_once('denyAccess.php');
require_once('../db.php');

if (isset($_POST['accounttype']))
{
    require_once('db.php');
    $idnumber=$_POST['idnumber'];
    $department=$_POST['department'];
    $accounttype=$_POST['accounttype'];
    if($accounttype=='Immediate Superior' ||$accounttype=='Dean') $accounttype= $department . ' ' . $accounttype; 
    $sql ="UPDATE users SET accountType = '$accounttype' WHERE idnumber = '$idnumber'";
    if (mysqli_query($conn, $sql)) echo "<script>window.close();</script>";
    else echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    exit();
    
}
echo $_POST['firstname'] .' '. $_POST['lastname'];
?>
<html>
<head>
 <link rel="stylesheet" type="text/css" href="../css/design1.css"/>
   <link rel="icon" href="../images/icon.png"/>
   
  <title>Change Priviledge</title>
</head>
<body>
<BR></BR>
<form method='post' action=''>
Priviledge: <select type="text"   name="accounttype" ><br><br>
                          <option value="Regular Employee">Regular Employee</option>  
                          <option value="Immediate Superior" >Immediate Superior</option>
                          <option value="Dean">Dean</option>
                          <option value="Budget Analyst" >Budget Analyst</option>
                          <option value="FRD Manager" >FRD Manager</option>
                          <option value="VCAR" >VCAR</option>
                          <option value="VCAD" >VCAD</option>
                          <option value="VCM" >VCM</option>
                          <option value="Chancellor" >Chancellor</option>
                          <option value="FHP Director" >FHP Director</option>
                          <option value="Property Custodian" >Property Custodian</option>
                          <option value="Properties and Reservation Officer" >Properties and Reservations Officer</option>
                          <option value="ICT Manager" >ICT Manager</option>
                          <option value="Admin" >ICT Administrator</option>
                          <option value="ICT Staff" >ICT Staff</option>
                          <option value="Director" >Director</option>
                          <option value="Principal" >Principal</option>
                          </select><BR><BR>  
<input type='hidden' name='lastname' value="<?php echo $_POST["lastname"]?>">
<input type='hidden' name='firstname' value="<?php echo $_POST["firstname"]?>">
<input type='hidden' name='idnumber' value="<?php echo $_POST["idnumber"]?>">
<input type='hidden' name='department' value="<?php echo $_POST["department"]?>">
<input type="BUTTON" Value="Back" Onclick="window.location.href='users'">
<input type="submit" name="save"  value="Save">
</form>

</body>
</html>