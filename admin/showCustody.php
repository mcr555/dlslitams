<?php
session_start();
require_once('../db.php');

$idnumber=$_GET['id'];

$sql = "SELECT * FROM hardware WHERE custodian='$idnumber'";
$result = $conn->query($sql);

if ($result->num_rows > 0)
{
  while($row = $result->fetch_assoc()) 
  {
    $asset_type=$row["asset_type"];
  }
}
else
{
  echo 'No records found';
  exit();
} 

echo "<h4>Custodian: ";
  $sql= "SELECT * FROM users WHERE idnumber=$idnumber";
  $result = $conn->query($sql);
  while($row = $result->fetch_assoc())  
    {echo $row["firstname"]." ".$row["lastname"];}

echo "</h4>";  

  echo "<h2>Asset Details</h2>";
  $sql = "SELECT *,supplier.supplier_name FROM hardware LEFT JOIN supplier ON hardware.supplier_id=supplier.supplier_id WHERE custodian=$idnumber";
  $result = $conn->query($sql);

  if ($result->num_rows > 0)
  {
      echo "<table border=1>";
      echo "<tr><th>";
      echo "Category</th><th>";
      echo "Barcode</th><th>";
      echo "Name</th><th>";
      echo "Date Bought</th><th>";
      echo "Warranty Expiration</th><th>";
      echo "Price Bought</th><th>";
      echo "Current Value</th><th>";
      echo "Location</th><th>";
      echo "Supplier</th><th>";
      echo "Lifespan End</th><th>";
      echo "Status</th>";
      while($row = $result->fetch_assoc())  
      {

        echo "<tr><td>";
        echo $row["hardware_category"]."</td><td>";
        echo $row["barcode"]."</td><td>";
        echo $row["name"]."</td><td>";
        echo $row["dateBought"]."</td><td>";
        echo $row["warranty_expiration"]."</td><td>";
        echo $row["buying_price"]."</td><td>";
        echo "</td><td>";
        echo $row["location"]."</td><td>";
        echo $row["supplier_name"]."</td><td>";
        echo $row["lifespanEnd"]."</td><td>";
        if($row["status"]==0) 
        {
          if($row["asset_type"]==1)
          {
            if($row["user_id"]==NULL || $row["user_id"]==0) 
              echo '<span class="label bg-blue">Not Borrowed</span>';
            else echo '<span class="label bg-orange">Borrowed';
          }
          else echo "<span class='label bg-purple'>Undeployed</span>";
          }
          if($row["status"]==1)
          {
            echo "<span class='label bg-olive'>Deployed</span>";
          }
          if($row["status"]==2)
          {
            echo "<span class='label bg-maroon'>Retired</span>";
          }
          if($row["status"]==3)
          {
            echo "<span class='label bg-red'>Decommissioned</span>";
          }
        echo "</td>";
        echo "</td></tr>";
      }
      echo "</table>";
  }
  else echo "No records found";
