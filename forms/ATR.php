 <?php
require_once('../db.php');
require_once('function.php');
if (isset($_POST['submit']))
{
  session_start();

  $dateNeeded=$_POST['dateNeeded'];
  $quantity=$_POST['quantity'];
  $specs=$_POST['specs'];
  $justification=$_POST['justification'];
  $tto=$_POST['tto'];
  $tfrom=$_POST['tfrom'];
  $squantity= serialize($quantity);
  $sspecs= serialize($specs);
  $stto= serialize($tto);
  $stfrom= serialize($tfrom);
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
  
  $sql = "INSERT INTO ticket (ticket_type,requestedFor,dateNeeded,justification,quantity,specs,user_id,tto,tfrom)
  VALUES ('ATR','$department','$dateNeeded','$justification','$squantity','$sspecs','$idnumber','$stto','$stfrom')";

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
            $vn5=$vn4+1;

                  $sql3 = "INSERT INTO tbl_log(Log_Name, Log_LOP, Log_Date_Time, Log_Function) VALUES ('$vn $vn1 $vn2','$vn3','$vd','Send ATR form($vn5)')";

            if (mysqli_query($conn, $sql3)){}
            else 
            {echo "Error: " . $sql . "<br>" . mysqli_error($conn); exit();}

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
              $message="Your request has been sent to the Dean for approval <a href='http://dlsl.comeze.com/forms/viewATR?id=$ticket_id' > View </a>";
              sendMail($email,$message);
          }
      }




      $sql = "INSERT INTO ticket_view (ticket_id,tuser_id,position,tistatus)
  VALUES ('$ticket_id','$idnumber','requestor',3)";
      mysqli_query($conn, $sql);
      requestDean($ticket_id,$conn);

      $acc=$_SESSION["accountType"];

      if($acc=="Admin"){
          $_SESSION['notification']=1;
          echo "<script>window.location.href='../admin/workOrder';</script>";
          die();}
          
      else if($acc=="Regular Employee"){
          $_SESSION['notification']=1;
          echo "<script>window.location.href='../user1/user1History';</script>";
          //header("Location: ../user1/workOrder");
          die();}
          
      else{
          $_SESSION['notification']=1;
          echo "<script>window.location.href='../user2/workOrder';</script>";
          die();}

    
    exit();
  }

  else 
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  exit();
//header("Location: software");
exit();
}

?>
<html>
 <head>
   <link rel="stylesheet" type="text/css" href="../css/design1.css"/>
   <link rel="icon" href="../images/icon.png"/>
   <script src="https://code.jquery.com/jquery-2.2.3.min.js"   integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo="   crossorigin="anonymous"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/css/bootstrap-datepicker3.min.css">

   <script>

var counter = 1;
function add_fields() {
    counter++;
    var objTo = document.getElementById('room_fields')
    var divtest = document.createElement("div");

    var str='<div class="form-group"><label>Quantity/Unit</label><input type="text" class="form-control" required name="quantity[]" value="" /></div>';
        str+='<div class="form-group"><label>Particulars/Specifications</label><input type="text" class="form-control" required  name="specs[]" value="" /></div>';
        str+='<div class="form-group"><label>Transfer From</label><input type="text" class="form-control" required name="tfrom[]" value="" /></div>';
        str+='<div class="form-group"><label>Transfer To</label><input type="text" class="form-control" required name="tto[]" value="" /></div>';

    divtest.innerHTML = str;

    objTo.appendChild(divtest)
}

</script>
<script>
$( document ).ready(function() {
    $("#from-datepicker").datepicker({ 
        format: 'yyyy-mm-dd'
    });
    $("#from-datepicker").on("change", function () {
        var fromdate = $(this).val();
    });
    $("#from-datepicker2").datepicker({ 
        format: 'yyyy-mm-dd'
    });
    $("#from-datepicker2").on("change", function () {
        var fromdate = $(this).val();
    });
}); 
</script>
  <title>ATR</title>
 </head>
<body>
<form method='post' action='../forms/ATR'>
  <div class="row">
    <div class="col-md-6">
      
            <!-- /.form-group -->
      <div class="form-group">
              <input type="button" id="more_fields" onclick="add_fields();" class="btn btn-default" value="Add Item" />
      </div>
            <!-- /.form-group -->
      <div id="room_fields">
        <div class="form-group">
              <label>Quantity/Unit</label>
              <input type="text" class="form-control" required name="quantity[]" value="" />
        </div>

        <div class="form-group">
              <label>Particulars/Specifications</label>
              <input type="text" class="form-control" required  name="specs[]" value="" />
        </div>

        <div class="form-group">
              <label>Transfer From</label>
              <input type="text" class="form-control" required name="tfrom[]" value="" />
        </div>

        <div class="form-group">
              <label>Transfer To</label>
              <input type="text" class="form-control" required name="tto[]" value="" />
        </div>
      </div>

        <div class="form-group">
              <label>Reason/Purpose</label>
              <textarea class="form-control" name="justification" rows="3" placeholder="Enter ..."></textarea>
        </div>
            <!-- /.form-group -->
    </div>
          <!-- /.col -->
    <div class="col-md-6">
        <div class="form-group">
              <label>Date Needed</label>
              <input type="text" class="form-control" required name='dateNeeded' id="from-datepicker" placeholder="Enter Date needed">
        </div>
            <!-- /.form-group -->
        <div class="form-group">
        </div>
    </div>
  </div>

<div class="box-footer">
  <input type='submit' value="Submit" class="btn btn-success pull-right" name='submit'/>
</div>
<!-- /.box-footer-->

</form>
</body>




</html>
