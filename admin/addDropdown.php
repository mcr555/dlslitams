  <script>
    window.onunload = refreshParent;
    function refreshParent() {
      window.opener.location.reload();
    }
</script>

<?php
session_start();
require_once('../db.php');
if (isset($_POST['submit']))
{
  $category=$_POST['category'];
  $type=$_POST['type'];

  $sql = "SELECT * FROM dropdown_list WHERE dropdown_name='$category' AND dropdown_type='$type'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0)
  {
    while($row = $result->fetch_assoc()) 
    {
      echo "Record already exist<BR>";
      $_SESSION['notification']=2;
      exit();
    }
  } 
  else
  {
    $sql = "INSERT INTO dropdown_list (dropdown_name,dropdown_type)
    VALUES ('$category','$type')";
  
    if (mysqli_query($conn, $sql)){}
    else
    { 
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      exit();
    }
    $_SESSION['notification']=1;
    echo '<script>window.close();</script>';
    exit();
  }
}
  $type=$_GET['type'];
  echo "<form method='post' action=''>";
  if($type==1) echo 'Add Hardware Category: ';
  if($type==2) echo 'Add Component Category: ';
  if($type==3) echo 'Add Office Location: ';
  echo "<input type='hidden' name='type' value='$type'>";
  echo "<input type='text' required name='category'>";
  
  echo "<BR><input type='submit' value='Submit' name='submit'>";
  echo "</form>";