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
        Freeware
      </h1>
      <ol class="breadcrumb">
        <li> Assets</li>
        <li> Freeware</li>
        <li> Unused Freeware</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box box-success">
        <div class="box-header with-border">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right">
             
              <li class="pull-left header">Unused Freeware</li>
               <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  More <span class="caret"></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </a>
                <ul class="dropdown-menu">
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="freewareAdd">Add Freeware</a></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="freeware">All Freeware</a></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="freewareUsed">Used Freeware</a></li>
                </ul>
              </li>
            </ul>
           
            <!-- /.tab-content -->
          </div>
        </div>
        <div class="box-body">
        <form method='post' action='softwareAction'>
          <table id="example1" class="table table-bordered table-striped">
          <button type='submit' name='delete' class="btn btn-default" ><i class="fa fa-trash"></i>Delete</button>
          <button type='submit' name='use' class="btn btn-default" ><i class="fa fa-trash"></i>Use</button>
            <input type="hidden" name="link" value="freewareUnused"/>

            <?php
            $sql = "SELECT * FROM software WHERE asset_id=0  AND type=0 ORDER BY software_id desc";
            $result = $conn->query($sql);

                echo "<thead>";
                echo "<tr><th></th><th>";
                echo "Name</th><th>";
                echo "Version</th><th>";
                echo "&nbsp;</th></thead><tbody>";


             if ($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc()) 
                {
                  echo "<tr><td>";
                  echo "<input name='checkbox[]' type='checkbox' value='". $row["software_id"] ."'/></td><td>";
                  echo $row["name"]."</td><td>";
                  echo $row["version"]."</td><td>";
                  ?><input type='button' class="btn btn-default" onClick="popitup('softwareUnused2?sid=<?php echo $row['software_id'];?>')" value='Use'>
                  <button  type='button' class="btn btn-default" onclick="buttonCall('serialDelete?id=<?php echo $row['software_id'];?>')"  ><i class="fa fa-trash"></i> Delete</button><?php 
 
                  echo "</td></tr>";
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
        'orderable': false, 'targets': [2]
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
<script src="../js/buttonCallFunction.js"></script>
</body>
</html>
