<?php
session_start();
require_once('../db.php');
$sql = "SELECT *,users.lastname,users.firstname FROM hardware LEFT JOIN users ON hardware.user_id=users.idnumber WHERE status!=2 AND asset_type=1";
$result = $conn->query($sql);
  if ($result->num_rows > 0)
  {
      echo "<table border=1>";
      echo "<tr><th>";
      echo "Asset ID</th><th>";
      echo "Barcode</th><th>";
      echo "Name</th><th>";
      echo "Borrowed By</th><th>";
      echo "Date Borrowed</th><th>";
      echo "Date Returned</th><th>";
      echo "Action</th>";

      while($row = $result->fetch_assoc()) 
      {
        echo "<tr><td>";
        echo $row["asset_id"]."</td><td>";
        echo $row["barcode"]."</td><td>";
        echo $row["name"]."</td><td>";
        if($row["user_id"]==NULL) echo '-';
        else echo $row['firstname'].' '.$row['lastname'];
        echo "</td><td>";
        echo $row["date_borrowed"]."</td><td>";
        echo $row["date_returned"]."</td><td>";
        if($row["user_id"]==NULL ||$row["user_id"]==0){
          ?><input type='button'  onClick="popitup2('hardwareBorrowAction?id=<?php echo $row['asset_id'];?>&act=0')" value='Borrow'><?php
        }
        else {
          ?><input type='button'  onClick="popitup2('hardwareBorrowAction?id=<?php echo $row['asset_id'];?>&act=1')" value='Return'><?php
        }
        echo "</td></tr>";    
      }
      echo "</table></form>";
      
  }
  else echo "No records found";
?>  