 <?php
require_once('../db.php');
require_once('function.php');
if (isset($_POST['submit']))
{
  session_start();

  $dateNeeded=$_POST['dateNeeded'];
  $justification=$_POST['justification'];
  $name=$_POST['name'];
  $office=$_POST['office'];
  $asset=$_POST['asset'];
  $sasset= serialize($asset);
  $idnumber=$_SESSION["idnumber"];
  $department=$_SESSION['department'];

  $sql = "INSERT INTO ticket (ticket_type,requestedFor,dateNeeded,justification,user_id,tto,tfrom,specs)
  VALUES ('ATR','$department','$dateNeeded','$justification','$idnumber','$name','$office','$sasset')";

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

                  $sql3 = "INSERT INTO tbl_log(Log_Name, Log_LOP, Log_Date_Time,category, Log_Function,id) VALUES ('$vn $vn1 $vn2','$vn3','$vd','Request','Send ATR form','$vn4')";

            if (mysqli_query($conn, $sql3)){}
            else 
            {echo "Error: " . $sql . "<br>" . mysqli_error($conn); exit();}
          die();}
          
      else if($acc=="Regular Employee"){
          $_SESSION['notification']=1;
          echo "<script>alert('Request Successfully Sent');window.location.href='../user1/userHistory';</script>";
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

                  $sql3 = "INSERT INTO tbl_log(Log_Name, Log_LOP, Log_Date_Time,category, Log_Function,id) VALUES ('$vn $vn1 $vn2','$vn3','$vd','Request','Send ATR form','$vn4')";

            if (mysqli_query($conn, $sql3)){}
            else 
            {echo "Error: " . $sql . "<br>" . mysqli_error($conn); exit();}
          //header("Location: ../user1/workOrder");
          die();}
          
      else{
          $_SESSION['notification']=1;
          echo "<script>alert('Request Successfully Sent');window.location.href='../user2/userHistory';</script>";
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

                  $sql3 = "INSERT INTO tbl_log(Log_Name, Log_LOP, Log_Date_Time,category, Log_Function,id) VALUES ('$vn $vn1 $vn2','$vn3','$vd','Request','Send ATR form','$vn4')";

            if (mysqli_query($conn, $sql3)){}
            else 
            {echo "Error: " . $sql . "<br>" . mysqli_error($conn); exit();}
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
function validateForm() {
    var dateNeeded = document.forms["myForm"]["dateNeeded"].value;
    
    var selectedDate = new Date(dateNeeded);
    var now = new Date();
    if (selectedDate <= now) {
      alert("Date needed should be greater than current date");
      return false;
    }
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
<form role="form" name="myForm" onsubmit="return validateForm()" action='../forms/ATR' method="post">
  <div class="row">
    <div class="col-md-6">

      <div class="form-group">
          <label>Requested for</label>
          <input type="text" class="form-control" disabled value='<?php echo $_SESSION["department"];?>'>
      </div>

            <div class="form-group">
        <label>Date Requested</label>
        <input type="text" class="form-control" disabled value='<?php echo date("Y-m-d");?>'>
      </div>
            <!-- /.form-group -->
      

        <div class="form-group">
              <label>Reason/Purpose</label>
              <textarea class="form-control" name="justification" rows="3" placeholder="Enter ..."></textarea>
        </div>

        <div class="form-group">
              <label>Assets to transfer</label><BR>
              <?php
              $idnumber=$_SESSION['idnumber'];
              $sql = "SELECT * FROM hardware WHERE custodian=$idnumber";
              $result = $conn->query($sql);
              if ($result->num_rows > 0)
              {
                  $select= '<select multiple required class="form-control" name="asset[]">';
                  while($row = $result->fetch_assoc()) 
                      $select.='<option value="'.$row['asset_id'].'">'.$row['name'].'</option>';
              }
              $select.='</select>';
              echo $select;
              ?>

        </div>
            <!-- /.form-group -->
    </div>
          <!-- /.col -->
    <div class="col-md-6">
        <div class="form-group">
              <label>Date Needed</label>
              <input type="text" class="form-control" required name='dateNeeded' id="from-datepicker" placeholder="Enter Date needed">
        </div>

        

        <div class="form-group">
              <label>Transfer To</label>
              <?php
              $sql = "SELECT * FROM users ORDER BY lastname asc ";
              $result = $conn->query($sql);
              if ($result->num_rows > 0)
              {
                $idnumber=$_SESSION['idnumber'];
                  echo '<select class="form-control" name="name">';
                  while($row = $result->fetch_assoc()) {
                    ?>
                    <option value="<?php echo $row['idnumber'];?>" <?php if ($row['idnumber']==$idnumber) { ?>selected="selected"<?php } ?>>
                    <?php echo $row['lastname'] . ', ' . $row['firstname'];?>
                    </option>
                    <?php
                  }
              }
              echo '</select>';
              ?>
              <BR><label>Location</label>

              <?php
              $sql = "SELECT * FROM dropdown_list WHERE dropdown_type=3 ORDER BY dropdown_name asc";
              $result = $conn->query($sql);
              if ($result->num_rows > 0)
              {
                  echo '<select class="form-control" name="office">';
                  while($row = $result->fetch_assoc()) {
                    ?>
                    <option value="<?php echo $row['dropdown_name'];?>">
                    <?php echo $row['dropdown_name'];?>
                    </option>
                    <?php
                  }
              }
              echo '</select>';
              ?>

        </div>
            <!-- /.form-group -->
        <div class="form-group">

    </div>
  </div>

<div class="box-footer">
  <input type='submit' value="Submit" class="btn btn-success pull-right" name='submit'/>
</div>
<!-- /.box-footer-->

</form>
</body>




</html>
