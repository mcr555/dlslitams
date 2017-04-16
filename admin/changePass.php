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
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/skin-green.min.css">
  <!-- inadd -->
  <link rel="stylesheet" type="text/css" href="../logo/design1.css"/>
  <link rel="icon" href="../images/icon.png"/>
  <style>
    .center{
      margin: auto;
    }
  </style>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<?php
  session_start();
  include_once('denyAccess.php');
  require_once('../db.php');
  if (isset($_POST['change']))
  {
    $idnumber=$_SESSION["idnumber"];
    $oldPassword=$_POST["oldPassword"];
    $md5=md5($oldPassword);
    $newPassword=$_POST["newPassword"];
    $retypePassword=$_POST["retypePassword"];

    $sql = "SELECT * FROM users WHERE idnumber='$idnumber' AND password='$md5'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0)
    {
      if($retypePassword!=$newPassword) echo "Retype and New Password does not match";
      else
      {
        $newPass=md5($newPassword);
        $sql="UPDATE users SET password = '$newPass' WHERE idnumber = '$idnumber'";
        if (mysqli_query($conn, $sql)) 
        {
          $_SESSION['notification']=1;
           date_default_timezone_set("Asia/Manila"); 
                $vd=date("Y-m-d h:i:a");
                $sql1 = "select * from users where idnumber = '".$_SESSION['idnumber']."'"; 
                 $result = $conn->query($sql1);

            $vn=$_SESSION["firstname"] ;
             $vn1=$_SESSION["middlename"] ;
            $vn2=$_SESSION["lastname"] ;
            $vn3=$_SESSION["accountType"] ;
           

            $sql3 = "INSERT INTO tbl_log(Log_Name, Log_LOP, Log_Date_Time,category, Log_Function,id) VALUES ('$vn $vn1 $vn2','$vn3','$vd','User','Change password','$idnumber')";

            if (mysqli_query($conn, $sql3)){}
            else 
            echo "Error: " . $sql3 . "<br>" . mysqli_error($conn);

          header("Location: users");
          exit();            
        }

        else 
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        exit();
      }
    }
    else
    {
      echo "<BR>Password is incorrect";
    }  
  }
?>
<body class="hold-transition skin-green sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  

  <!-- =============================================== -->

  <?php 
  include_once('main-header.php');
  include_once('sidebar.php');
  require_once('notification.php');?>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Change Password
      </h1>
      <ol class="breadcrumb">
        <li>Change password</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content center">

      <div class="col-md-6">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Change Password</h3>
        </div>
        <div class="box-body">
          <form role="form" action='changePass' method="post">
          <div class="form-group">
            <label>Old Password</label>
            <input type="password" class="form-control" required name="oldPassword" placeholder="Enter Old password">
          </div>
          <!-- /.form group -->
          <div class="form-group">
            <label>New Password</label>
            <input type="password" class="form-control" required name="newPassword" placeholder="Enter Old password">
          </div>
          <!-- /.form group -->
          <div class="form-group">
            <label>Re-type New Password</label>
            <input type="password" class="form-control" required name="retypePassword" placeholder="Enter Old password">
          </div>
          <!-- /.form group -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
         <input type='submit' class="btn btn-success pull-right" value="Submit" name="change" />
        </div>
        <!-- /.box-footer-->
      </form>
      </div>
      <!-- /.box -->
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php include_once('footer.php') ?>
  
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
</body>
</html>
