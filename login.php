<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>DLSL IT Asset Management System</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
  <!-- inadd -->
  <link rel="stylesheet" type="text/css" href="logo/design1.css"/>
  <link rel="icon" href="images/icon.png"/>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <img class="img-responsive" src="images/logo.png">
    <b>IT ASSET</b> MANAGEMENT SYSTEM
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">SIGN IN</p>
    <?php
      session_start();
      require_once('db.php');
      if (isset($_POST['login']))
      {
        $idnumber=$_POST["idnumber"];
        $password=$_POST["password"];
        $md5=md5($password);
        $sql = "SELECT * FROM users WHERE idnumber='$idnumber' AND password='$md5' AND userStatus=0";
        $result = $conn->query($sql);

        if ($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc()) 
            {
              $_SESSION["firstname"] = $row["firstname"];
              $_SESSION["lastname"] =$row["lastname"];
              $_SESSION["idnumber"] = $row["idnumber"];
              $_SESSION["contact"] = $row["contact"];
              $_SESSION["middlename"] = $row["middlename"];
              $_SESSION["accountType"] = $row["accountType"];
              $_SESSION["department"] = $row["department"];

              date_default_timezone_set("Asia/Manila");
              $vd=date("Y-m-d h:i:a");
              $_SESSION['id']=$row['idnumber'];//kwaon ang id sang may tyakto nga username kag password ang ibotang sa $_SESSION['adminid']
              $sql = "INSERT INTO tbl_log(Log_Name, Log_LOP, Log_Date_Time,category, Log_Function,id) VALUES ('$row[firstname] $row[middlename] $row[lastname]','$row[accountType]','$vd','Login','Log On to the system',$_SESSION[idnumber])";
                
              if (mysqli_query($conn, $sql)){echo "success";}
              else 
              echo "Error: " . $sql . "<br>" . mysqli_error($conn);


              if($row["accountType"]=="Admin"){
                header("Location: admin/home");
                die();}
                  
              else if($row["accountType"]=="Regular Employee"){
                header("Location: user1/home");
                die();}
                  
              else{
                header("Location: user2/home");
                die();}

            }
          }
          else
          { ?>
              <p class="login-box-msg text-red"><b>Invalid Username/Password!</b></p>
            <?php
          } 
      }

    ?>

    <form action="login" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="idnumber" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <a href="forgetPassword">Forgot Password</a><br>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <input type="submit" class="btn btn-success btn-block btn-flat" name="login"  value="Log in">
        </div>
        <!-- /.col -->
      </div>
    </form>
    <!-- /.social-auth-links -->
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-green',
      radioClass: 'iradio_square-green',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
