<?php
require_once('../db.php');
?> 
<?php
echo '<label>Supplier</label>';
$sql = "SELECT * FROM supplier";
$result = $conn->query($sql);
if ($result->num_rows > 0)
{
    $select= '<select name="supplier_id">';
    $select.='<option value=""></option>';
    while($row = $result->fetch_assoc()) 
        $select.='<option value="'.$row['supplier_id'].'">'.$row['supplier_name'].'</option>';
}
$select.='</select>';
echo $select;
?>
