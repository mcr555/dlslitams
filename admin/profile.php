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
  include_once('sidebar.php');
   $sql1=mysql_query("select * from users where idnumber = '".$_SESSION['id']."'");
               $row = mysql_fetch_assoc($sql1);
  
      
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
          <form role="form" action='register' method="post">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                <div class="user-panel">
                <div class="pull-left image"><img src="../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"></div>
                        <label>idnumber</label>
                        <input type="number" class="form-control" disabled name="idnumber" value="<?php echo $row['idnumber'];?>">
                      </div>
                      <!-- /.form-group -->
                      
                      <!-- /.form-group -->
                       <div class="form-group">
                        <label>name</label>
                        <input type="text" class="form-control" disabled name="name" value="<?php echo $row['firstname'];?>">
                      </div>
                     <div class="form-group">
                        <label>Gender</label>
                        <input type="text" class="form-control" disabled name="gender" value="<?php echo $row['gender'];?>">
                      </div>
                      <!-- /.form-group -->
                      <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" disabled name="email" value="<?php echo $row['email'];?>"></td>
                      </div>
                      <!-- /.form-group -->
                      
                      </div>
                      <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <div class="form-group">
                        <label>Department</label>
                        <input type="text" class="form-control" disabled name="department" value="<?php echo $row['department'];?>">
                        <!-- /.form-group -->
                    <div class="form-group">
                        <label>Privilige</label>
                        <input type="text" class="form-control" disabled name="accounttype" value="<?php echo $row['accountType'];?>">
                      </div>
                      <!-- /.form-group -->
                    <div class="form-group">
                        <label>Status</label>
                        <input type="text" class="form-control" disabled name="status" value="<?php echo $status;?>">
                      </div>
                    
                    <!-- /.form-group -->
              </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div>&nbsp;</div>
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
