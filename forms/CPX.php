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

    $sql2 = "SELECT * FROM users WHERE idnumber='$idnumber'";
    $result2 = $conn->query($sql2);
    if ($result2->num_rows > 0)
    {
        while($row2 = $result2->fetch_assoc()) 
        {
            $department=$row2['department'];
        }
    }

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

        if($acc=="Admin"){
            header("Location: ../admin/home");
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
            die();}
            
        else if($acc=="Regular Employee"){
            echo "<script>
            alert('Request Successfully Sent');
            window.location.href='../user1/user1History';
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

                  $sql3 = "INSERT INTO tbl_log(Log_Name, Log_LOP, Log_Date_Time,category, Log_Function,id) VALUES ('$vn $vn1 $vn2','$vn3','$vd','Request','Send CAPEX form','$vn4')";

            if (mysqli_query($conn, $sql3)){}
            else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);

         exit();}
            //header("Location: ../user1/workOrder");
            die();}
            
        else{
            header("Location: ../user2/workOrder");
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
    background-color: #EEE;
    display: table-header-group;
}
.divTableCell, .divTableHead {
    border: 1px solid #999999;
    display: table-cell;
}
.divTableHeading {
    background-color: #EEE;
    display: table-header-group;
    font-weight: bold;
}
.divTableFoot {
    background-color: #EEE;
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

var counter = 1;
function add_fields() {
    counter++;
    var objTo = document.getElementById('room_fileds')
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
<form method='post' action='../forms/CPX'>
<BR></BR>




<label>Date Needed: </label><input type="text" id="from-datepicker" name='dateNeeded'><br><br>
<input type="button" id="more_fields" onclick="add_fields();" value="Add Item" /><BR></BR>


    <div id="room_fileds">
    <div class="divTable">
    <div class="divTableBody">
        <div class="divTableRow">
        <div class="divTableCell">Quantity</div>
        <div class="divTableCell">Estimated Amount</div>
        <div class="divTableCell">Particulars/Specifications</div>
        </div>

        <div class="divTableRow">
        <div class="divTableCell"><input type="text" required name="quantity[]" value="" /></div>
        <div class="divTableCell"><input type="text" required name="amount[]" value="" /></div>
        <div class="divTableCell"><input type="text" required name="specs[]"  style="width:648px;"value="" /></div>
        </div>
    </div>
    </div>
    </div>

<BR><BR><BR>
Justification<BR><TEXTAREA NAME='justification' ROWS=4 COLS=40></TEXTAREA>
<BR>
<input type='submit' name='submit'/>
</form>
</body>




</html>
