<?php 
session_start();
include_once('user1Header.php'); 
require_once('denyAccess.php');
require_once('../db.php');

?>
<html>
 <head>
   <link rel="stylesheet" type="text/css" href="../css/design1.css"/>
   <link rel="icon" href="../img/icon.png"/>
   <script src="../js/popup.js"></script> 
   <title>Work Order</title>
 </head>
<body>
<?php include_once('user1Header.php'); ?>

<BR><BR>
  <center><input type="BUTTON" Value="Add Request" Onclick="window.location.href='addWorkOrder.php'"/><BR><BR>
 
<?php
$idnumber=$_SESSION["idnumber"];
$sql = "SELECT * FROM ticket WHERE user_id=$idnumber ";
$result = $conn->query($sql);

  if ($result->num_rows > 0)
  {
    echo "<table align='center' border=1>
    <tr><td>ID</td>
    <td>Type</td>
    <td>Date</td>
    <td>Status</td>
    <td>View Details</td>
    </tr>";
    while($row = $result->fetch_assoc()) 
    {
      echo "<tr><td>";
      echo $row["ticket_id"]."</td><td>";
      echo $row["ticket_type"]."</td><td>";
      echo $row["date_requested"]."</td><td>";
      if($row["tstatus"]==0) echo 'Ongoing';
      if($row["tstatus"]==1) echo 'Approved';
      if($row["tstatus"]==2) echo 'Rejected';
      echo "</td><td>";
      $go='view'.$row["ticket_type"]?>
      <input type='button'   onClick="popitup2('../forms/<?php echo $go;?>?id=<?php echo $row['ticket_id'];?>')" value='Show'>
      <?php echo "</td></tr>";
    }
    echo "</table>";
  }
  else echo "No records found";
?>
 
</body>

</html>