<?php
require_once('../db.php');
require_once('function.php');

if (isset($_POST['submit']))
{
    session_start();
    $dateNeeded=$_POST['dateNeeded'];
    $justification=$_POST['justification'];
    $amount=$_POST['amount'];
    $quantity=$_POST['quantity'];
    $specs=$_POST['specs'];
    $samount= serialize($amount);
    $squantity= serialize($quantity);
    $sspecs= serialize($specs);
    $idnumber=$_SESSION["idnumber"];
    $department=$_SESSION['department'];

    $sql = "INSERT INTO ticket (ticket_type,requestedFor,dateNeeded,justification,amount,quantity,specs,user_id)
    VALUES ('CPX','$department','$dateNeeded','$justification','$samount','$squantity','$sspecs','$idnumber')";
          

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
                $message="Your request has been sent to the Dean for approval <a href='http://dlsl.comeze.com/forms/viewCPX?id=$ticket_id' > View </a>";
                sendMail($email,$message);
            }
        }
        $sql = "INSERT INTO ticket_view (ticket_id,tuser_id,position,tistatus)
    VALUES ('$ticket_id','$idnumber','requestor',3)";
        mysqli_query($conn, $sql);

        requestIS($ticket_id,$conn);

        $acc=$_SESSION["accountType"];

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

        $sql3 = "INSERT INTO tbl_log(Log_Name, Log_LOP, Log_Date_Time,category, Log_Function,id) VALUES ('$vn $vn1 $vn2','$vn3','$vd','Request','Send CAPEX form','$vn4')";

        if (mysqli_query($conn, $sql3)){}
        else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        exit();}

        if($acc=="Admin"){
            header("Location: ../admin/home");
            die();}
            
        else if($acc=="Regular Employee"){
            echo "<script>
            alert('Request Successfully Sent');
            window.location.href='../user1/userHistory';
            </script>";
            die();}
            
        else{
            echo "<script>
            alert('Request Successfully Sent');
            window.location.href='../user2/userHistory';
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
  <style>
.divTable{
    display: table;
    width: 50%;
}
.divTableRow {
    display: table-row;
}
.divTableHeading {
    background-color: #ebecf0;
    display: table-header-group;
}
.divTableCell, .divTableHead {
    border: 1px solid #FFF;
    display: table-cell;
}
.divTableHeading {
    background-color: #ebecf0;
    display: table-header-group;
    font-weight: bold;
}
.divTableFoot {
    background-color: #ebecf0;
    display: table-footer-group;
    font-weight: bold;
}
.divTableBody {
    display: table-row-group;
}
</style>
   <link rel="stylesheet" type="text/css" href="../css/design1.css"/>
   <link rel="icon" href="../images/icon.png"/>
   <script src="https://code.jquery.com/jquery-2.2.3.min.js"   integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo="   crossorigin="anonymous"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/css/bootstrap-datepicker3.min.css">

<script>
function validateForm() {
    var dateNeeded = document.forms["myForm"]["dateNeeded"].value;
    
    var selectedDate = new Date(dateNeeded);
    var now = new Date();
    if (selectedDate < now) {
      alert("Date Needed needs to be greater than current date");
      return false;
    }

}
</script>

<script>

var counter = 1;
function add_fields() {
    counter++;
    var objTo = document.getElementById('room_fields')
    var divtest = document.createElement("div");

    var str='<div class="divTableRow"><div class="divTableCell"><input type="text" required name="quantity[]" value="" /></div>';
    str+='<div class="divTableCell"><input type="text" required name="amount[]" value="" /></div>';
    str+='<div class="divTableCell"><input type="text" required name="specs[]"  style="width:648px;"value="" /></div></div>';

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
  <title>CPX</title>
 </head>
<body>
<form role="form" name="myForm" onsubmit="return validateForm()" action='../forms/CPX' method="post">
<BR></BR>
<div class="row">
    <div class="col-md-6">
      <div class="form-group">
          <label>Requested by</label>
          <input type="text" class="form-control" disabled value='<?php echo $_SESSION["firstname"]." ".$_SESSION["lastname"];?>' >
      </div>

        <div class="form-group">
          <label>Date Requested</label>
          <input type="text" class="form-control" disabled required value='<?php echo date("Y-m-d");?>' >
        </div>

        <div class="form-group">
            <button type="button" id="more_fields" onclick="add_fields();" class="btn btn-default" /><i class="fa fa-plus"></i> Add Item</button>
        </div>

        <div id="room_fields">
          <div class="divTable">
            <div class="divTableBody">
              <div class="divTableRow">
                <div class="divTableCell" align="center">Quantity</div>
                <div class="divTableCell" align="center">Estimated Amount</div>
                <div class="divTableCell" align="center">Particulars/Specifications (Please write the detailed specification)</div>
            </div>

            <div class="divTableRow">
              <div class="divTableCell"><input type="text" required name="quantity[]" value="" /></div>
                <div class="divTableCell"><input type="text" required name="amount[]" value="" /></div>
                <div class="divTableCell"><input type="text" required name="specs[]"  style="width:648px;"value="" /></div>
            </div>
          </div>
        </div>
    </div>
</div>

    <div class="col-md-6">
      <div class="form-group">
          <label>Requested for</label>
          <input type="text" class="form-control" disabled required value='<?php echo $_SESSION["department"];?>' >
      </div>

        <div class="form-group">
          <label>Date needed</label>
          <input type="text" class="form-control" required id="from-datepicker" name='dateNeeded'> 





      </div>
    </div>

    <dic class="col-md-12">
      <div class="form-group">
            &nbsp;
      </div>

        <div class="form-group">
            <label>Justification</label>
            <textarea class="form-control" name="justification" rows="3" placeholder="Enter Justification"></textarea>
        </div>
    </div>

    <div class="box-footer">
      <input type='submit' value="Submit" class="btn btn-success pull-right" name='submit'/>
    </div>

</form>
</body>
</html>
