<script>
    window.onunload = refreshParent;
    function refreshParent() {
        window.opener.location.reload();
    }
</script>
<script type="text/javascript">
var ICT= ["ICT Manager|ICT Manager", "Section Head|Section Head", "Helpdesk|Helpdesk","Supervisor|Supervisor","Hardware Admin|Hardware Admin","Software Admin|Software Admin","Network Admin|Network Admin",    "Admin|ICT Administrator"];
var IS= ["Faculty2|Faculty", "Curriculum Coordinator|Curriculum Coordinator",  "Principal|Principal"];
var Faculty= ["Faculty1|Faculty", "Dean|Dean",  "Department Chair|Department Chair"];
var FRD= ["FRD Manager|FRD Manager", "Budget Analyst|Budget Analyst",  "FHP Director|FHP Director"];
var Others= ["VCAR|VCAR", "VCAD|VCAD",  "VCM|VCM"];
var ILFO= ["Staff|Staff", "Manager|Manager",  "Director|Director"];

function set_course() {
  var select_dept = document.myform.department;
  var select_course = document.myform.accounttype;
  var selected_dept = select_dept.options[select_dept.selectedIndex].value;

  select_course.options.length=0;
  var tarr = [];
  switch (selected_dept) {


  case 'ICTC' :
    for(var i=0; i<ICT.length; i++) {
     tarr = ICT[i].split('|');
     select_course.options[select_course.options.length] = new Option(tarr[1],tarr[0]);
    }
    break;

   case 'CITE' : case 'CIHTM' : case 'CBEAM' : case 'CEAS' : case 'CON' : case 'COL' :
    for(var i=0; i<Faculty.length; i++) {
     tarr = Faculty[i].split('|');
     select_course.options[select_course.options.length] = new Option(tarr[1],tarr[0]);
    }
    break;

   case 'FRD' :
    for(var i=0; i<FRD.length; i++) {
     tarr = FRD[i].split('|');
     select_course.options[select_course.options.length] = new Option(tarr[1],tarr[0]);
    }
    break;

   case 'ILFO' :
    for(var i=0; i<ILFO.length; i++) {
     tarr = ILFO[i].split('|');
     select_course.options[select_course.options.length] = new Option(tarr[1],tarr[0]);
    }
    break;

   case 'Others' :
    for(var i=0; i<Others.length; i++) {
     tarr = Others[i].split('|');
     select_course.options[select_course.options.length] = new Option(tarr[1],tarr[0]);
    }
    break;


   case 'IS' : 
    for(var i=0; i<IS.length; i++) {
     tarr = IS[i].split('|');
     select_course.options[select_course.options.length] = new Option(tarr[1],tarr[0]);
    }
  }
}

function ShowSelection(flag) {
  var select_dept = document.myform.department;
  var select_course = document.myform.accounttype;
  var selected_dept = select_dept.options[select_dept.selectedIndex].value;
  var selected_course = select_course.options[select_course.selectedIndex].value;
  if (flag == false) {
    alert('Selection: '+selected_dept+ ' : ' + selected_course);
  } else {
    var sel = document.getElementById('Courses').getElementsByTagName('div');
    for (var i=0; i<sel.length; i++) { sel[i].style.display = 'none'; }
    if (selected_course != '') {
      document.getElementById(selected_course).style.display = 'block';
    }
  }
}
</script>
<?php
session_start();
include_once('denyAccess.php');
require_once('../db.php');

if (isset($_POST['accounttype']))
{
    require_once('db.php');
    $idnumber=$_POST['idnumber'];
    $department=$_POST['department'];
    $accounttype=$_POST['accounttype'];
    if($accounttype=='Immediate Superior' ||$accounttype=='Dean') $accounttype= $department . ' ' . $accounttype; 
    $sql ="UPDATE users SET department='$department',accountType = '$accounttype' WHERE idnumber = '$idnumber'";
    if (mysqli_query($conn, $sql)) echo "<script>window.close();</script>";
    else echo "Error: " . $sql . "<br>" . mysqli_error($conn);

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
           

            $sql3 = "INSERT INTO tbl_log(Log_Name, Log_LOP, Log_Date_Time,category, Log_Function,id) VALUES ('$vn $vn1 $vn2','$vn3','$vd','User','Change priviledge of $vn5 $vn6 $vn7','$idnumber')";

            if (mysqli_query($conn, $sql3)){}
            else 
            echo "Error: " . $sql3 . "<br>" . mysqli_error($conn);
    exit();
    
}

?>
<html>
<head>
 <link rel="stylesheet" type="text/css" href="../css/design1.css"/>
   <link rel="icon" href="../images/icon.png"/>
   
  <title>Change Priviledge</title>
</head>
<body>
<BR></BR>
<form role="form" name="myform" action="" method="post">

<label>Department</label>
                      <select name="department" class="form-control" onchange="set_course()">
                      <option value="">Select Department</option>
                      <option value="CITE">CITE</option>  
                      <option value="CIHTM" >CIHTM</option>
                      <option value="CBEAM">CBEAM</option>
                      <option value="CEAS" >CEAS</option>
                      <option value="CON" >CON</option>
                      <option value="COL" >COL</option>
                      <option value="ILFO">ILFO</option>
                      <option value="IS">IS</option>
                      <option value="FRD">FRD</option>
                      <option value="ICTC">ICTC</option>
                      <option value="Others">Others</option>
                     </select>

<label>Privilege</label>
                      <select name="accounttype" class="form-control" onchange="ShowSelection(true)"
                      <option value=""> ------ </option>
                      </select>

<input type='hidden' name='idnumber' value="<?php echo $_GET["id"]?>">
<input type="BUTTON" Value="Back" Onclick="window.close();">
<input type="submit" name="save"  value="Save">
</form>

</body>
</html>