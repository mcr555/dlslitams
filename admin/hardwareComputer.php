<?php
session_start();
include_once('denyAccess.php');
require_once('../db.php');
include_once('adminHeader.php'); 
require_once('notification.php');
?>
<html>
 <head>
   <link rel="stylesheet" type="text/css" href="../css/design1.css"/>
   <link rel="icon" href="../images/icon.png"/>
  <script src="../js/popup.js"></script> 
  <title>Computers</title>
 </head>
<body>
<BR></BR>
<input type="button" onclick="location.href='hardwareComputerAdd';" value="Add Computer" />
<?php
$sql = "SELECT *,supplier.supplier_name FROM hardware LEFT JOIN supplier ON hardware.supplier_id=supplier.supplier_id WHERE asset_type=2";
$result = $conn->query($sql);

	if ($result->num_rows > 0)
	{
      echo "<table border=1>";
      echo "<tr><th>";
      echo "Asset ID</th><th>";
      echo "Barcode</th><th>";
      echo "Name</th><th>";
      echo "MAC Address</th><th>";
      echo "Date Bought</th><th>";
      echo "Warranty Expiration</th><th>";
      echo "Book Value</th><th>";
      echo "Buying Price</th><th>";
      echo "Location</th><th>";
      echo "Supplier</th><th>";
      echo "Components</th><th>";
      echo "Software Installed</th>";

      while($row = $result->fetch_assoc()) 
      {
        echo "<tr><td>";
        echo $row["asset_id"]."</td><td>";
      	echo $row["barcode"]."</td><td>";
        echo $row["name"]."</td><td>";
        echo $row["macAddress"]."</td><td>";
      	echo $row["dateBought"]."</td><td>";
        echo $row["warranty_expiration"]."</td><td>";
        echo $row["book_value"]."</td><td>";
        echo $row["buying_price"]."</td><td>";
        echo $row["location"]."</td><td>";
        echo $row["supplier_name"]."</td><td>";
        echo 'components'."</td><td>";
        ?><input type='button'  onClick="popitup2('hardwareDetails?hid=<?php echo $row['asset_id'];?>')" value='Show'><?php
        echo "</td></tr>";    
      }
      echo "</table>";
      
  }
  else echo "No records found";
?>  
   </body>
</html>
