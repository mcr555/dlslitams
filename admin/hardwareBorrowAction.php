<script>
    window.onunload = refreshParent;
    function refreshParent() {
        window.opener.location.reload();
        window.close();
    }
</script>

<?php
session_start();
require_once('../db.php');
if (isset($_POST['submit']))
{
	$asset_id=$_POST['asset_id'];
	$user_id=$_POST['user_id'];
	date_default_timezone_set('Asia/Singapore');
	$date=date('Y/m/d G:i:s ', time());
	$sql="UPDATE hardware SET user_id = '$user_id',date_borrowed='$date',date_returned='' WHERE asset_id = '$asset_id'";
	if (mysqli_query($conn, $sql)){}
	else echo "Error: " . $sql . "<br>" . mysqli_error($conn);


}
if(isset($_GET['act']))
{
	$id=$_GET['id'];
	if($_GET['act']==0)
	{
		?><form method='post' action='hardwareBorrowAction'>
		<input type='hidden' name='asset_id' value="<?php echo $id;?>">
		Lend to:
		<?php
		$sql = "SELECT * FROM users";
		$result = $conn->query($sql);
		if ($result->num_rows > 0)
		{
			$select= '<select name="user_id">';
			while($row = $result->fetch_assoc()) 
			{
				$select.='<option value="'.$row['idnumber'].'">'.$row['firstname'] . ' ' .$row['lastname'].'</option>';
			}
			$select.='</select>';
			echo $select;
		}
		?>
		<input type='submit' value='Submit' name='submit'>
		</form><?php
	}
	if($_GET['act']==1)
	{
		$asset_id=$_GET['id'];
		date_default_timezone_set('Asia/Singapore');
		$date=date('Y/m/d G:i:s ', time());
		$sql="UPDATE hardware SET user_id = 'NULL',date_returned='$date' WHERE asset_id = '$asset_id'";
		if (mysqli_query($conn, $sql)){}
		else echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		echo "<script>window.close();</script>";

	}
}
?>