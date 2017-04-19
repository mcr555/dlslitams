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

  <?php 
include_once('user1Header.php');
                $sql2 = "select imagepath from users where idnumber = '".$_SESSION['id']."'"; 
                $result1 = $conn->query($sql2);
                $row = $result1->fetch_array(MYSQLI_ASSOC);

                 $sql1 = "select * from users where idnumber = '".$_SESSION['id']."'"; 
                $result = $conn->query($sql1);
                $row = $result->fetch_array(MYSQLI_ASSOC);
                if($row['userStatus'] =='0')
                {
                  $status="Activated";
                }
                else
                {
                  $status="Deactivated";
                }

  ?>
  

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Profile
      </h1>
      <ol class="breadcrumb">
        <li>Profile</li>
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
          <form role="form" action='saveimage' enctype="multipart/form-data" method="post">
            <div class="row">
              <div class="col-md-6">
            <div>
          <?php
            if ($row['imagepath']>= 1){
              echo" <div> <img src='../img/$row[imagepath]'  width=200 height=200  alt='User Image'>";
    

    }
else

 echo "<div> <img src='../dist/img/user2-160x160.jpg'  width=200 height=200  alt='User Image'>";
?>
     
                        <input name="uploadedimage" type="file" value="change" >
                         <input name="Upload Now" type="submit" value="Upload Image">
                         </form>
                         </div>
                        </div>
                        
                    <br>

                <div class="form-group">
                        <label>ID Number</label>
                        <input type="number" class="form-control" disabled name="idnumber" value="<?php echo $row['idnumber'];?>">
                      </div>
                      <!-- /.form-group -->
                      
                      <!-- /.form-group -->
                      <div class="form-group">
                         <label>Name</label>
                        <input type="text" class="form-control" disabled name="name" value="<?php echo $row['firstname'];?>">
                      </div>
                      <div class="form-group">
                        <label>Gender</label>
                        <input type="text" class="form-control" disabled name="gender" value="<?php echo $row['gender'];?>">
                      </div>
                      <!-- /.form-group -->
                      <div class="form-group">
                       <label>Email</label>
                        <input type="text" class="form-control" disabled name="email" value="<?php echo $row['email'];?>">
                      </div>
                      <!-- /.form-group -->
                      <div class="form-group">
                      <label>Department</label>
                        <input type="text" class="form-control" disabled name="department" value="<?php echo $row['department'];?>">
                        </div>
                         <div class="form-group">
                       <label>Privilige</label>
                        <input type="text" class="form-control" disabled name="accounttype" value="<?php echo $row['accountType'];?>">
                      </div>
                      <!-- /.form-group -->
                       <div class="form-group">
                   <label>Status</label>
                        <input type="text" class="form-control" disabled name="status" value="<?php echo $status;?>">
                        </div>
                      </div>
                      <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                  
                     
                    <!-- /.form-group -->
              </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div>&nbsp;</div>
  
           

     
      </div>
      <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <?php include_once('../admin/footer.php');?>
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
