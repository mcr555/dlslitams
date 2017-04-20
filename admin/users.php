
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
    <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
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
  if (isset($_POST['deactivate']))
  {

  $idnumber=$_POST['idnumber']; 
  date_default_timezone_set('Asia/Singapore');
  $date=date('Y/m/d G:i:s ', time());
  $sql="UPDATE users SET userStatus='1',dateDeactivated='$date' WHERE idnumber = '$idnumber'";

  if (mysqli_query($conn, $sql)){}
  else 
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
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
           

            $sql3 = "INSERT INTO tbl_log(Log_Name, Log_LOP, Log_Date_Time,category, Log_Function,id) VALUES ('$vn $vn1 $vn2','$vn3','$vd','User','Deactivated account of $vn5 $vn6 $vn7','$idnumber')";

            if (mysqli_query($conn, $sql3)){}
            else 
            echo "Error: " . $sql3 . "<br>" . mysqli_error($conn);
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
        Accounts
      </h1>
      <ol class="breadcrumb">
        <li> Accounts</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Accounts</h3>
        </div>
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <?php
            $sql = "SELECT * FROM users WHERE userStatus='0' ";
            $result = $conn->query($sql);


            echo "<thead><tr><th>";
            echo "ID Number</th><th>";
            echo "Lastname</th><th>";
            echo "Firstname</th><th>";
            echo "Department</th><th>";
            echo "Account Type</th><th>";
            echo "&nbsp;</th>
              <th>&nbsp;</th>
              <th>&nbsp;</th>
            </thead><tbody>";

            if ($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc()) 
                {
                  echo "<tr><td>";
                  echo $row["idnumber"]."</td><td>";
                  echo $row["lastname"]."</td><td>";
                  echo $row["firstname"]."</td><td>";
                  echo $row["department"]."</td><td>";
                  echo $row["accountType"];
                  echo "</td><td>";
                  $idnumber=$row['idnumber'];
                  $sql2 = "SELECT * FROM hardware WHERE custodian='$idnumber'";
                  $result2 = $conn->query($sql2);
                  if ($result2->num_rows > 0)
                  {
                    $showButton=1;
                  }
                  else $showButton=0;
                  echo "<form name='myform' method='POST' action='changePrivilege'>";?>
                  <input type='hidden' name='lastname' value="<?php echo $row["lastname"]?>">
                  <input type='hidden' name='firstname' value="<?php echo $row["firstname"]?>">
                  <input type='hidden' name='idnumber' value="<?php echo $row["idnumber"]?>">

                  <input type="submit" class="btn btn-default" value="Change Privilege"
                  onclick="myform.target='POPUPW'; POPUPW = window.open(
                  'about:blank','POPUPW','width=600,height=400');">


                  <?php
                  echo "</form>"; ?>
                  <form action="users" method="POST" onsubmit="return confirm('Are you sure you want to deactivate user?');">
                  <input type="hidden" name="idnumber" value="<?php echo $row['idnumber'];?>" />
                  <td><input type="submit" class="btn btn-default" name="deactivate" value="Deactivate" /></td>
                  <td><button type='button' class="btn btn-default" onClick="popitup2('usersEdit?id=<?php echo $row['idnumber'];?>')" name='submit'><i class="fa fa-edit"></i> Edit</button>
                  <?php if($showButton==1){?><button type='button' class="btn btn-default" onClick="popitup2('showCustody?id=<?php echo $row['idnumber'];?>')" name='submit'><i class="fa fa-eye"></i> Assets</button><?php } ?></td></tr>
                  <?php
                }
            }
            echo "</tbody></table>";
            ?>
        </div>
        <!-- /.box-body -->
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
<!-- DataTables -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "order": [],
      "columnDefs": [{
        'orderable': false, 'targets': [5, 6, 7]
      }]
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
   <script src="../js/popup.js"></script> 
</body>
</html>
