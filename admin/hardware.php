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
    <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../../plugins/iCheck/all.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/skin-green.min.css">
  <!-- inadd -->
  <link rel="stylesheet" type="text/css" href="../logo/design1.css"/>
  <link rel="icon" href="../images/icon.png"/>

  <!-- jQuery 2.2.3 -->
<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../bootstrap/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../plugins/fastclick/fastclick.js"></script>
<!-- iCheck 1.0.1 -->
<script src="../../plugins/iCheck/icheck.min.js"></script>
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
        'orderable': false, 'targets': [6]
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
<script src="../js/ajax.js"></script> 
<script>
  $(function () {
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });
  });
</script>

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
        Hardware
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Assets</li>
        <li>Hardware</li>
      </ol>
    </section>

    <form method="post" action="hardware2">
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box box-success">
        <div class="box-header with-border">
          
           <div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right">
             
              <li class="pull-left header">Hardware</li>
               <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  More <span class="caret"></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </a>
                <ul class="dropdown-menu">
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="hardwareComputerAdd">Add Hardware</a></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="hardwareAdd">Add Asset</a></li>
                </ul>
              </li>
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  View <span class="caret"></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </a>
                <ul class="dropdown-menu">
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="hardwareRetired.php">Retired Asset</a></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="hardwareDonated.php">Donated Asset</a></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="hardwareDecommissioned.php">Decommissioned Asset</a></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="hardware">All Hardware</a></li>
                </ul>
              </li>
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  Action <span class="caret"></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </a>
                <ul class="dropdown-menu">
                  <li role="presentation"><input type="submit" class="btn btn-default"  name="donate" value="Donate"/></li>
                  <li role="presentation"><input type="submit" class="btn btn-default"  name="retire" value="Retire"/></li>
                  <li role="presentation"><input type="submit" class="btn btn-default"  name="decommission" value="Decommission"/></li>
                </ul>
              </li>
            </ul>
           
            <!-- /.tab-content -->
          </div>
        </div>
        <div class="box-body">
        
          <table id="example1" class="table table-bordered table-striped">
            <?php
            $sql = "SELECT *,supplier.supplier_name FROM hardware LEFT JOIN supplier ON hardware.supplier_id=supplier.supplier_id WHERE status!=2";
            $result = $conn->query($sql);

            echo "<thead><tr><th></th><th>";
            echo "Asset ID</th><th>";
            echo "Barcode</th><th>";
            echo "Name</th><th>";
            echo "Location</th><th>";
            echo "Status</th><th>";
            echo "&nbsp;</th></thead><tbody>";


            if ($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc()) 
                {
                  echo "<tr><td>";
                  echo "<input type='checkbox' name='checkbox[]' class='flat-red' value='". $row["asset_id"] ."'/></td><td>";
                  echo $row["asset_id"]."</td><td>";
                  echo $row["barcode"]."</td><td>";
                  echo $row["name"]."</td><td>";
                  echo $row["location"]."</td><td>";
                  if($row["status"]==0) 
                  {
                    if($row["asset_type"]==1)
                    {
                      if($row["user_id"]==NULL || $row["user_id"]==0) 
                        echo '<span class="label bg-blue">Not Borrowed</span>';
                      else echo '<span class="label bg-orange">Borrowed';
                    }
                    else echo "<span class='label bg-purple'>Undeployed</span>";
                    }
                    if($row["status"]==1)
                    {
                      echo "<span class='label bg-olive'>Deployed</span>";
                    }
                    if($row["status"]==2)
                    {
                      echo "<span class='label bg-maroon'>Retired</span>";
                    }
                    if($row["status"]==3)
                    {
                      echo "<span class='label bg-red'>Decommissioned</span>";
                    }
                  echo "</td><td>";
                  ?><button type='button' class="btn btn-default" onClick="popitup2('hardwareDetails?hid=<?php echo $row['asset_id'];?>')" name='submit'><i class="fa fa-eye"></i> View Details</button><?php
                  echo "</td></tr>";    
                }
            }
            echo "</tbody></table></form>";
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


</body>
</html>
