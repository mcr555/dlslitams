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
<input type='button'  onClick="popitup2('suppliersAddNoRefresh')" value='Add Supplier'><BR>
<?php
echo '<label>Categories</label>';
$sql = "SELECT * FROM dropdown_list WHERE dropdown_type=2";
$result = $conn->query($sql);
if ($result->num_rows > 0)
{
    $select= '<select name="category">';
    while($row = $result->fetch_assoc()) 
        $select.='<option value="'.$row['dropdown_name'].'">'.$row['dropdown_name'].'</option>';
}
$select.='</select>';
echo $select;
?>
<input type='button'  onClick="popitup2('addComponentDrop')" value='Add Category'><BR>