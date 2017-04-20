<?php
require_once('../db.php');
require_once('function.php');

if (!isset($_POST['quantity']))
$quantity=1;
else $quantity= $_POST['quantity'];
if (isset($_POST['submit']))
{
  session_start();
  $contact=$_POST['contact'];
  $remarks=$_POST['remarks'];
  $justification=$_POST['justification'];
  $idnumber=$_SESSION["idnumber"];
  $department=$_SESSION["department"];
  

  $sql = "INSERT INTO ticket (ticket_type,requestedFor,justification,contact,remarks,user_id)
  VALUES ('ICTSR','$department','$justification','$contact','$remarks','$idnumber')";


  if (mysqli_query($conn, $sql)) 
  {
    $ticket_id = mysqli_insert_id($conn);

    $sql2 = "SELECT * FROM users WHERE idnumber='$idnumber'";
    $result2 = $conn->query($sql2);
    if ($result2->num_rows > 0)
    {
        while($row2 = $result2->fetch_assoc()) 
        {
            $email=$row2['email'];
            $message="Your request has been sent to the Dean for approval <a href='http://dlsl.comeze.com/forms/viewICTSR?id=$ticket_id' > View </a>";
            sendMail($email,$message);
        }
    }

    $sql = "INSERT INTO ticket_view (ticket_id,tuser_id,position,tistatus)
    VALUES ('$ticket_id','$idnumber','requestor',3)";
    mysqli_query($conn, $sql);
    requestIS($ticket_id,$conn);

    date_default_timezone_set("Asia/Manila"); 
    $vd=date("Y-m-d h:i:a");
    $sql2 ="select * from ticket ORDER BY ticket_id DESC LIMIT 1"; 
    $result1 = $conn->query($sql2);
    $row = $result1->fetch_array(MYSQLI_ASSOC);
    $sql1 = "select * from users where idnumber = '".$_SESSION['idnumber']."'"; 
    $result = $conn->query($sql1);

    $vn=$_SESSION["firstname"] ;
    $vn1=$_SESSION["middlename"] ;
    $vn2=$_SESSION["lastname"] ;
    $vn3=$_SESSION["accountType"] ;
    $vn4=$row["ticket_id"];

    $sql3 = "INSERT INTO tbl_log(Log_Name, Log_LOP, Log_Date_Time,category, Log_Function,id) VALUES ('$vn $vn1 $vn2','$vn3','$vd','Request','Send ICTSR form','$vn4')";

    if (mysqli_query($conn, $sql3)){}
    else 
    {echo "Error: " . $sql . "<br>" . mysqli_error($conn); exit();}



    $acc=$_SESSION["accountType"];

    if($acc=="Admin"){
        echo "<script>
        alert('Request Successfully Sent');
        window.location.href='../admin/workOrder';
        </script>";
         
        die();}
        
    else if($acc=="Regular Employee"){
        echo "<script>
        alert('Request Successfully Sent');
        window.location.href='../user1/userHistory';
        </script>";
        //header("Location: ../user1/workOrder");
         
        die();}
        
    else{
        echo "<script>
        alert('Request Successfully Sent');
        window.location.href='userHistory';
        </script>";
         
        die();}

  
  exit();
  }

    else 
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
exit();
}

?>
<html>
 <head>
   <link rel="stylesheet" type="text/css" href="../css/design1.css"/>
   <link rel="icon" href="../images/icon.png"/>
 
  
  <title>ICTSR</title>


 </head>
<body>

</body>
</html>
