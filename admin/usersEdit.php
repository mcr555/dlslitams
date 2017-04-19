<script>
    window.onunload = refreshParent;
    function refreshParent() {
        window.opener.location.reload();
        window.close();
    }
</script>
<?php
session_start();
include_once('denyAccess.php');
require_once('../db.php');
if(isset($_POST['edit']))
{
  $idnumber=$_POST['idnumber'];
  $firstname=$_POST['firstname'];
  $middlename=$_POST['middlename'];
  $lastname=$_POST['lastname'];
  $department=$_POST['department'];
  $email=$_POST['email'];
  $sql="UPDATE users SET firstname = '$firstname', middlename = '$middlename', lastname = '$lastname', department = '$department',
  email = '$email' WHERE idnumber = '$idnumber'";
  if (mysqli_query($conn, $sql)){}
  else 
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  date_default_timezone_set("Asia/Manila"); 
                $vd=date("Y-m-d h:i:a");
                $sql2 ="select * from users WHERE idnumber = '$idnumber'";
                $result1 = $conn->query($sql2);
                $row = $result1->fetch_array(MYSQLI_ASSOC);
                $sql1 = "select * from users where idnumber = '".$_SESSION['idnumber']."'"; 
                 $result = $conn->query($sql1);

            $vn=$_SESSION["firstname"] ;
             $vn1=$_SESSION["middlename"] ;
            $vn2=$_SESSION["lastname"] ;
            $vn3=$_SESSION["accountType"] ;
            $vn5=$row["firstname"];
            $vn6=$row["middlename"];
            $vn7=$row["lastname"];
           

            $sql3 = "INSERT INTO tbl_log(Log_Name, Log_LOP, Log_Date_Time,category, Log_Function,id) VALUES ('$vn $vn1 $vn2','$vn3','$vd','User','Edit user of $vn5 $vn6 $vn7','$idnumber')";

            if (mysqli_query($conn, $sql3)){}
            else 
            echo "Error: " . $sql3 . "<br>" . mysqli_error($conn);
          
  exit();
}

if(isset($_GET['id']))
{
  $idnumber=$_GET['id'];
  $sql = "SELECT * FROM users WHERE idnumber=$idnumber";
  $result = $conn->query($sql);
  if ($result->num_rows > 0)
  {
      while($row = $result->fetch_assoc()) 
      {
        //
        echo '<form action="usersEdit.php" method="post">';
        echo '<input type="hidden" name="idnumber" value="' .$idnumber . '">';
        echo '<BR>First Name: <input type="text" name="firstname" value="' .$row["firstname"] . '">';
        echo '<BR>Middle Name: <input type="text" name="middlename" value="' .$row["middlename"] . '">';
        echo '<BR>Last Name: <input type="text" name="lastname" value="' .$row["lastname"] . '">';
        echo '<BR>Department: <input type="text" name="department" value="' .$row["department"] . '">';
        echo '<BR>Email: <input type="text" name="email" value="' .$row["email"] . '">';
        echo '<input type="submit" name="edit"  value="Edit">';
        echo '</form>';
      }
      
  }
  else echo "No records found";

}
?>