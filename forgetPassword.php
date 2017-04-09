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

        function sendMail($email,$code) {
          $to      = $email;
          $subject = 'New Password';
          $message = '<html><body>';
          $message .= "http://dlsl.comeze.com/changePassword?code=$code";
          $message .= '</body></html>';
          $headers = 'From: dlsl@edu.ph' . "\r\n" .
            'Reply-To: dlsl@edu.ph' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
  
          $headers  = 'MIME-Version: 1.0' . "\r\n";
          $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
          $headers .= 'From: DLSL <dlsl@edu.ph>' . "\r\n";

          mail($to, $subject, $message, $headers);
        }

        if (isset($_POST['fp']))
        {
          $email=$_POST["email"];

          $sql = "SELECT * FROM users WHERE email='$email'";
          $result = $conn->query($sql);

          if ($result->num_rows > 0)
          {
            while($row = $result->fetch_assoc()) 
            {
                $code=substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(8/strlen($x)) )),1,8);
                echo "A request for new password has been sent to your email!";
                sendMail($email,$code);
                 $sql = "INSERT INTO changepassword (email,code)
                  VALUES ('$email','$code')";
                if (mysqli_query($conn, $sql)){}
                else 
                  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                exit();
            }
          }
          else echo "<p class='login-box-msg text-red'><b>Email not found!";
        }
?>

    <form action='forgetPassword' method="post">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" name="email" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4">
          <input type="button" class="btn btn-success btn-block btn-flat" value="Back" onclick="window.location.href='login'">
        </div>
        <!-- /.col -->
        <div class="col-xs-4 pull-right">
          <input type="submit" class="btn btn-success btn-block btn-flat" name="fp" value="Send">
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
