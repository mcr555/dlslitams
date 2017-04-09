<?php 
session_start();
require_once('denyAccess.php');
include_once('adminHeader.php'); 
require_once('../db.php');

?>
<html>
 <head>
   <link rel="stylesheet" type="text/css" href="../css/design1.css"/>
   <link rel="icon" href="../img/icon.png"/>
   <script src="../js/popup.js"></script> 
   <title>Approved Work Order</title>
 </head>
<body>

<BR><BR>

 
<?php
$idnumber=$_SESSION["idnumber"];
$sql = "SELECT *,ticket.ticket_type,ticket.date_requested,users.lastname,users.firstname FROM ticket_view LEFT JOIN ticket ON ticket.ticket_id=ticket_view.ticket_id LEFT JOIN users ON users.idnumber=ticket.user_id WHERE tistatus='2' AND tuser_id=$idnumber";  
$result = $conn->query($sql);

  if ($result->num_rows > 0)
  {
    echo "<table align='center' border=1>
    <tr><td>ID</td>
    <td>Type</td>
    <td>Date</td>
    <td>Requested By</td>
    <td>View Details</td>
    </tr>";
    while($row = $result->fetch_assoc()) 
    {
        if($row['step']==0) continue;
        $str = $row['position'];
        $arr = explode(' ',trim($str));
      echo "<tr><td>";
      echo $row["ticket_id"]."</td><td>";
      echo $row["ticket_type"]."</td><td>";
      echo $row["date_requested"]."</td><td>";
      echo $row["firstname"].' '.$row["lastname"];
      echo "</td><td>";
      $go='view'.$row["ticket_type"]?>
      <input type='button'   onClick="popitup2('../forms/<?php echo $go;?>?id=<?php echo $row['ticket_id'];?>')" value='Show'>
     </td></tr>
       <?php 
    }
    echo "</table>";
  }
  else echo "No records found";
?>
 
</body>

</html>