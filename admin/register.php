<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>DLSL IT Asset Management System</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/skin-green.min.css">
  <!-- inadd -->
  <link rel="stylesheet" type="text/css" href="../logo/design1.css"/>
  <link rel="icon" href="../images/icon.png"/>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <script>
  $('#password, #confirm_password').on('keyup', function () {
    if ($('#password').val() == $('#confirm_password').val()) {
        $('#message').html('Matching').css('color', 'green');
    } else 
        $('#message').html('Not Matching').css('color', 'red');
});</script>
</head>
<?php
  session_start();
  include_once('denyAccess.php');
  require_once('../db.php');
  if (isset($_POST['reg']))
  {
    $idnumber=$_POST["idnumber"];
    $password=$_POST["password"];
    $password=md5($password);
    $lastname=$_POST["lastname"];
    $firstname=$_POST["firstname"];
    $middlename=$_POST["middlename"];
    $gender=$_POST["gender"];
    $email=$_POST["email"];
    $department=$_POST["department"];
    $accounttype=$_POST["accounttype"];
    if($accounttype=='Immediate Superior' ||$accounttype=='Dean') $accounttype= $department . ' ' . $accounttype;

     $sql = "SELECT * FROM users WHERE idnumber='$idnumber' OR email='$email'";
     $result = $conn->query($sql);

    if ($result->num_rows > 0)
    {
      while($row = $result->fetch_assoc()) 
      {
          echo "Record already exist<BR>";
          ?><button onclick="history.go(-1);">Back </button><?php
          exit();
      }
    } 

    else
    {
      $sql = "INSERT INTO users (idnumber,password,lastname,firstname,middlename,gender,department,email,accountType)
      VALUES ($idnumber,'$password','$lastname','$firstname','$middlename','$gender','$department','$email','$accounttype')";

      if (mysqli_query($conn, $sql)) 
      {
        echo "Registration Successfull! You will be redirected in 3 Seconds";
        $_SESSION['notification']=1;
        header( "refresh:3;url=users" );  
         date_default_timezone_set("Asia/Manila"); 
                $vd=date("Y-m-d h:i:a");
                $sql1 = "select * from users where idnumber = '".$_SESSION['idnumber']."'"; 
                 $result = $conn->query($sql1);

            $vn=$_SESSION["firstname"] ;
             $vn1=$_SESSION["middlename"] ;
            $vn2=$_SESSION["lastname"] ;
            $vn3=$_SESSION["accountType"] ;
           

            $sql3 = "INSERT INTO tbl_log(Log_Name, Log_LOP, Log_Date_Time,category, Log_Function,id) VALUES ('$vn $vn1 $vn2','$vn3','$vd','User','Create a account','$idnumber')";

            if (mysqli_query($conn, $sql3)){}
            else 
            echo "Error: " . $sql3 . "<br>" . mysqli_error($conn);

        exit();
      }

      else 
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
   
          exit();
    }

         


  }
?>
<body class="hold-transition skin-green sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">


  <!-- =============================================== -->

  <?php 
  include_once('main-header.php');
  include_once('sidebar.php');?>
  

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Create new account
      </h1>
      <ol class="breadcrumb">
        <li>Create new account</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Create new account</h3>
        </div>
        <div class="box-body">
          <form role="form" action='register' method="post">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                        <label>Employee Number</label>
                        <input type="text" class="form-control" required name="idnumber" required name='name' placeholder="Enter Employee Number" onkeypress="return isNumberKey(event)">
                      </div>
                      <!-- /.form-group -->
                      
                      <!-- /.form-group -->
                      <div class="form-group">
                        <label>Password</label>
                        <input type="password" id="password" class="form-control" required name="password" id="password" pattern=".{4,}" title="Four or more characters" placeholder="Enter Password" >
                      </div>
                      <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" id="password" class="form-control" required name="confirm_password" id="confirm_pasasword" pattern=".{4,}" title="Four or more characters" placeholder="Enter Password" >
                        <span id='message'></span>
                      </div>
                      <!-- /.form-group -->
                      <div class="form-group">
                        <label>First Name</label>
                        <input type="text" required name="firstname" class="form-control" placeholder="Enter First name" >
                      </div>
                      <!-- /.form-group -->
                      <div class="form-group">
                        <label>Middle Name</label>
                        <input type="text" required name="middlename" class="form-control" placeholder="Enter Middle name" >
                      </div>
                      <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" required name="lastname" class="form-control" placeholder="Enter Last name">
                      </div>
                      <!-- /.form-group -->
                    <div class="form-group">
                      <label>Gender</label>
                      <select class="form-control" name="gender">
                        <option>Male</option>
                        <option>Female</option>
                      </select>
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                      <label>Email Address</label>
                      <input type="email" name="email" required class="form-control" placeholder="Enter Email address">
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                      <label>Department</label>
                      <select class="form-control" name="department">
                        <option value="CITE">CITE</option>  
                        <option value="CIHTM" >CIHTM</option>
                        <option value="CBEAM">CBEAM</option>
                        <option value="CEAS" >CEAS</option>
                        <option value="CON" >CON</option>
                        <option value="COL" >COL</option>
                      </select>
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                      <label>Privelege</label>
                      <select class="form-control" name="accounttype">
                          <option value="Regular Employee">Regular Employee</option>  
                          <option value="Immediate Superior" >Immediate Superior</option>
                          <option value="Dean">Dean</option>
                          <option value="Budget Analyst" >Budget Analyst</option>
                          <option value="FRD Manager" >FRD Manager</option>
                          <option value="VCAR" >VCAR</option>
                          <option value="VCAD" >VCAD</option>
                          <option value="VCM" >VCM</option>
                          <option value="Chancellor" >Chancellor</option>
                          <option value="FHP Director" >FHP Director</option>
                          <option value="Property Custodian" >Property Custodian</option>
                          <option value="Properties and Reservation Officer" >Properties and Reservations Officer</option>
                          <option value="ICT Manager" >ICT Manager</option>
                          <option value="Admin" >ICT Administrator</option>
                          <option value="ICT Staff" >ICT Staff</option>
                          <option value="Director" >Director</option>
                          <option value="Section Head" >Section Head</option>
                          <option value="Principal" >Principal</option>
                      </select>
                    </div>
                    <!-- /.form-group -->
              </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div>&nbsp;</div>
          <div class="box-footer">
            <input type='submit' class="btn btn-success pull-right" value="Submit" name='reg'/>
          </div>
      </form>
      </div>
      <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php include_once('footer.php');?>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../bootstrap/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<script>
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
</script>
</body>
</html>
