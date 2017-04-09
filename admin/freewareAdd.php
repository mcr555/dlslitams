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
  if (isset($_POST['submit']))
  {
      if (!isset($_POST['version']))
      $version='';
      else $version=$_POST['version'];
      $name=$_POST['name'];
      $quantity=$_POST['quantity'];

      for($i=0;$i<$quantity;$i++)
      {
          $sql = "INSERT INTO software (name,version,type)
          VALUES ('$name','$version',0)";

          if (mysqli_query($conn, $sql)){}
          else echo "Error: " . $sql . "<br>" . mysqli_error($conn); 
      date_default_timezone_set("Asia/Manila"); 
                $vd=date("Y-m-d h:i:a");
                $sql2 ="select * from software ORDER BY software_id DESC LIMIT 1"; 
                $result1 = $conn->query($sql2);
                $row = $result1->fetch_array(MYSQLI_ASSOC);
                 $sql1 = "select * from users where idnumber = '".$_SESSION['id']."'"; 
           $result = $conn->query($sql1);

            $vn=$_SESSION["firstname"] ;
             $vn1=$_SESSION["middlename"] ;
            $vn2=$_SESSION["lastname"] ;
            $vn3=$_SESSION["accountType"] ;
            $vn4=$row["software_id"];
            
            

                  $sql3 = "INSERT INTO tbl_log(Log_Name, Log_LOP, Log_Date_Time, Log_Function) VALUES ('$vn $vn1 $vn2','$vn3','$vd','add a freeware($vn4)')";

            if (mysqli_query($conn, $sql3)){}
            else 
           
           echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
      $_SESSION['notification']=1;
      header("Location: freewareUnused");
      exit();
  }
?>
<body class="hold-transition skin-green sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="../../index2.html" class="logo">
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>ITAMS</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
    </nav>
  </header>

  <!-- =============================================== -->

  <?php include_once('sidebar.php') ?>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Software
      </h1>
      <ol class="breadcrumb">
        <li>Assets</li>
        <li>Sofware</li>
        <li>Freeware</a></li>
        <li>Add Freeware</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Add Freeware</h3>
        </div>
        <div class="box-body">
          <form role="form" action='freewareAdd' method="post">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                        <label>Software Name</label>
                        <input type="text" class="form-control" id="InputSoftwareName" required name='name' placeholder="Enter Software Name">
                      </div>
                      <!-- /.form-group -->
                      <div class="form-group">
                         <label>Version</label>
                        <input type="text" class="form-control" id="InputVersion" name='version' placeholder="Enter Version">
                      </div>
                      <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Quantity</label>
                        <input type="number" min='0' name='quantity' class="form-control" required placeholder="Enter Quantity">
                      </div>
                      <!-- /.form-group -->
              </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div>&nbsp;</div>
          <div class="box-footer">
            <input type='button' class="btn btn-default" onclick="history.go(-1);" value='Cancel'/>
            <input type='submit' class="btn btn-success pull-right" value="Submit" name='submit'/>
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
</body>
</html>
