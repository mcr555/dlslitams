<?php

include("../db.php");

 $studid = $_POST["studid"];

$select_query = "SELECT images_path FROM  images_tbl WHERE images_id ='$studid'";

$result = $conn->query($select_query);
while($row = $result->fetch_assoc()){

?>

<table style="border-collapse: collapse; font: 12px Tahoma;" border="1" cellspacing="5" cellpadding="5">

<tbody><tr>

<td>
<img src="../img/<?php echo $row["images_path"];?>" />






</td>

</tr>

</tbody></table>
<?php
}
?>