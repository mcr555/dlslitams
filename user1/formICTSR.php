<?php
  session_start();
  include_once('denyAccess.php');
  require_once('../db.php');
  require_once('../forms/function.php');
?>
<?php
if (isset($_POST['justification']))
$justification=$_POST['justification'];
else $justification ='';

if (isset($_POST['remarks']))
$remarks=$_POST['remarks'];
else $remarks ='';

if (!isset($_POST['quantity']))
$quantity=1;
else $quantity= $_POST['quantity'];
if (isset($_POST['submit']))
{
  $remarks=$_POST['remarks'];
  $justification=$_POST['justification'];
  $idnumber=$_SESSION["idnumber"];
  $contact=$_SESSION["contact"];
  $department=$_SESSION['department'];
  $asset=$_POST['asset'];
  $asset = array_unique($asset); 
  $sasset= serialize($asset);

  $sql = "INSERT INTO ticket (specs,ticket_type,requestedFor,justification,contact,remarks,user_id)
  VALUES ('$sasset','ICTSR','$department','$justification','$contact','$remarks','$idnumber')";


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
            $message="Your request has been sent to the Dean for approval <a href='http://dlsl.comeze.com/forms/viewICTSR?id=$ticket_id' > View </a>";
            sendMail($email,$message);
        }
    }

    $sql = "INSERT INTO ticket_view (ticket_id,tuser_id,position,tistatus)
    VALUES ('$ticket_id','$idnumber','requestor',3)";
    mysqli_query($conn, $sql);
    requestIS($ticket_id,$conn);

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

    $sql3 = "INSERT INTO tbl_log(Log_Name, Log_LOP, Log_Date_Time,category, Log_Function,id) VALUES ('$vn $vn1 $vn2','$vn3','$vd','Request','Send ICTSR form','$vn4')";

    if (mysqli_query($conn, $sql3)){}
    else 
    {echo "Error: " . $sql . "<br>" . mysqli_error($conn); exit();}

    echo "<script>
    alert('Request Successfully Sent');
    window.location.href='userHistory';
    </script>";
  
  exit();
  }

    else 
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
exit();
}

?>
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

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="../../dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $_SESSION['firstname'];?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  <?php echo $_SESSION['firstname'];?>
                  <small>Member since Nov. 2012</small>
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="changePass" class="btn btn-default btn-flat">Change Password</a>
                </div>
                <div class="pull-right">
                  <a href="../logout" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <?php include_once('user1Header.php') ?>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Forms
      </h1>
      <ol class="breadcrumb">
        <li>Forms</li>
        <li>ICTSR</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">ICTSR</h3>
        </div>
        <div class="box-body">
          <?php
        $idnumber=$_SESSION['idnumber'];
        $sql = "SELECT * FROM hardware WHERE custodian='$idnumber' ";
        $result = $conn->query($sql);
        if ($result->num_rows < 1)
          echo "You don't have any asset under your custody";
        else {
          ?>
          <form method='post'>
  <div class="row">

    <div class="col-md-6">
      <div class="form-group">
          <label>Requested for</label>
          <input type="text" class="form-control" disabled value='<?php echo $_SESSION["department"];?>'>
      </div>
      <!-- /.form-group -->
      
      <div class="form-group">
        <label>Date Requested</label>
        <input type="text" class="form-control" disabled pattern='[\+]\d{2}[\(]\d{2}[\)]\d{4}[\-]\d{4}' value='<?php echo date("Y-m-d");?>'>
      </div>
    </div>

    <div class="col-md-6">
      <div class="form-group">
        <label>Local/Contact No.</label>
        <input type="text" class="form-control" disabled pattern='[\+]\d{2}[\(]\d{2}[\)]\d{4}[\-]\d{4}' value='<?php echo $_SESSION['contact'];?>'>
      </div>

      <div class="form-group">
        <label>Remarks</label>
        <input type="text" class="form-control" required name='remarks' value='<?php echo $remarks;?>' placeholder="Enter Remarks" />
      </div>
    </div>

    <div class="col-md-12">
      <div class="form-group">
        <label>Request Description</label>
        <textarea class="form-control" name="justification"  rows="3" placeholder="Enter Request Description"><?php echo $justification;?></textarea>
      </div>

      <div class="form-group">
        <label>Asset Quantity</label>
        <input type='text' name='quantity' value='<?php echo $quantity;?>'>
      </div>
      <div class="form-group">
        <label><input type='submit' value="Change Quantity" class="btn btn-success pull-right" name='changer'/></label>

        <?php
          $idnumber=$_SESSION['idnumber'];
          $sql = "SELECT * FROM hardware WHERE custodian=$idnumber";
          $result = $conn->query($sql);
          if ($result->num_rows > 0)
          {
              $select= '<select name="asset[]">';
              while($row = $result->fetch_assoc()) 
                  $select.='<option value="'.$row['asset_id'].'">'.$row['name'].'</option>';
          }
          $select.='</select>';
          ?>
      </div>
      <div id='room_fields' class="form-group">
        <?php for($i=0;$i<$quantity;$i++) echo $select;?>
      </div>
    </div>


  </div>

<div class="box-footer">
  <input type='submit' value="Submit" class="btn btn-success pull-right" name='submit'/>
</div>
</form>
          <?php
        }
        ?>
        </div>
        <!-- /.box-body -->

      </div>
      <!-- /.box -->
<div>&nbsp;</div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Team</b>MAD
    </div>
    <strong>Copyright &copy; 2017 <a href="www.dlsl.edu.ph">De La Salle Lipa</a>.</strong> All rights
      reserved 1962 J.P. Laurel National Highway, Lipa City 4217 Philippines
  </footer>
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
