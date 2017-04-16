<?php
require_once('../db.php');
require_once('function.php');

if (isset($_POST['submit']))
{
  session_start();
  $contact=$_POST['contact'];
  $remarks=$_POST['remarks'];
  $justification=$_POST['justification'];
  $idnumber=$_SESSION["idnumber"];

  $sql2 = "SELECT * FROM users WHERE idnumber='$idnumber'";
    $result2 = $conn->query($sql2);
    if ($result2->num_rows > 0)
    {
        while($row2 = $result2->fetch_assoc()) 
        {
            $department=$row2['department'];
        }
    }

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

    $acc=$_SESSION["accountType"];

    if($acc=="Admin"){
        echo "<script>
        alert('Request Successfully Sent');
        window.location.href='../admin/workOrder';
        </script>";
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
        die();}
        
    else if($acc=="Regular Employee"){
        echo "<script>
        alert('Request Successfully Sent');
        window.location.href='../user1/workOrder';
        </script>";
        //header("Location: ../user1/workOrder");
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
        die();}
        
    else{
        echo "<script>
        alert('Request Successfully Sent');
        window.location.href='../user2/workOrder';
        </script>";
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
<form method='post' action='../forms/ICTSR'>
  <div class="row">
              <div class="col-md-6">
                
                      <!-- /.form-group -->
                <div class="form-group">
                        <label>Remarks</label>
                        <input type="text" class="form-control" required name='remarks' value="" placeholder="Enter Remarks" />
                 </div>

                  <div class="form-group">
                        <label>Request Description</label>
                        <textarea class="form-control" name="justification" rows="3" placeholder="Enter Request Description"></textarea>
                  </div>
                      <!-- /.form-group -->
              </div>
                    <!-- /.col -->
              <div class="col-md-6">
                  <div class="form-group">
                        <label>Local/Contact No:</label>
                        <input type="text" class="form-control" required name='contact' placeholder="Enter Local/Contact no.">
                  </div>
                      <!-- /.form-group -->
                  <div class="form-group">
                  </div>
              </div>
            </div>

<div class="box-footer">
  <input type='submit' value="Submit" class="btn btn-success pull-right" name='submit'/>
</div>
</form>
</body>
</html>
