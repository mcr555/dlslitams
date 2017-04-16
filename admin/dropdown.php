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

<script src="../js/popup.js"></script>
<script src="../js/ajax.js"></script> 

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
        Dropdown
      </h1>
    </section>

    <form method="post" action="hardware2">
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box box-success">
        <div class="box-header with-border">
          
           <div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right">
             
              <li class="pull-left header">Dropdown</li>
               
              
            </ul>
           
            <!-- /.tab-content -->
          </div>
        </div>
        <div class="box-body">
        
          <table id="example1" class="table table-bordered table-striped">
            <button type='button' class="btn btn-default" onClick="popitup2('addDropdown?type=1')" name='submit'><i class="fa fa-eye"></i> Add Hardware Category</button>
            <button type='button' class="btn btn-default" onClick="popitup2('addDropdown?type=2')" name='submit'><i class="fa fa-eye"></i> Add Component Category</button>
            <button type='button' class="btn btn-default" onClick="popitup2('addDropdown?type=3')" name='submit'><i class="fa fa-eye"></i> Add Offices</button>
            <?php
            $sql = "SELECT * FROM dropdown_list WHERE dropdown_type=1";
            $result = $conn->query($sql);
            echo '<h2>Hardware Category</h2>';
            echo "<thead><tr><th></th><th>";
            echo "Dropdown Name</th><th>";
            echo "&nbsp;</th></thead><tbody>";


            if ($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc()) 
                {
                  echo "<tr><td>";
                  echo "<input type='checkbox' name='checkbox[]' class='flat-red' value='". $row["dropdown_id"] ."'/></td><td>";
                  echo $row["dropdown_name"]."</td><td>";
                  
                  ?><button type='button' class="btn btn-default" onClick="popitup2('hardwareDetails?hid=<?php echo $row['asset_id'];?>')" name='submit'><i class="fa fa-eye"></i> Edit</button>
                  <button type='button' class="btn btn-default" onClick="popitup2('hardwareDetails?hid=<?php echo $row['asset_id'];?>')" name='submit'><i class="fa fa-eye"></i> Delete</button><?php
                  echo "</td></tr>";    
                }
            }
            echo "</tbody></table></form>";
            ?>

          <table id="example1" class="table table-bordered table-striped">
            
            <?php
            $sql = "SELECT * FROM dropdown_list WHERE dropdown_type=2";
            $result = $conn->query($sql);
            echo '<h2>Component Category</h2>';
            echo "<thead><tr><th></th><th>";
            echo "Dropdown Name</th><th>";
            echo "&nbsp;</th></thead><tbody>";

            if ($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc()) 
                {
                  echo "<tr><td>";
                  echo "<input type='checkbox' name='checkbox[]' class='flat-red' value='". $row["dropdown_id"] ."'/></td><td>";
                  echo $row["dropdown_name"]."</td><td>";
                  
                  ?><button type='button' class="btn btn-default" onClick="popitup2('hardwareDetails?hid=<?php echo $row['asset_id'];?>')" name='submit'><i class="fa fa-eye"></i> Edit</button>
                  <button type='button' class="btn btn-default" onClick="popitup2('hardwareDetails?hid=<?php echo $row['asset_id'];?>')" name='submit'><i class="fa fa-eye"></i> Delete</button><?php
                  echo "</td></tr>";    
                }
            }
            echo "</tbody></table></form>";
            ?>

          <table id="example1" class="table table-bordered table-striped">
            
            <?php
            $sql = "SELECT * FROM dropdown_list WHERE dropdown_type=3";
            $result = $conn->query($sql);
            echo '<h2>Offices</h2>';
            echo "<thead><tr><th></th><th>";
            echo "Dropdown Name</th><th>";
            echo "&nbsp;</th></thead><tbody>";

            if ($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc()) 
                {
                  echo "<tr><td>";
                  echo "<input type='checkbox' name='checkbox[]' class='flat-red' value='". $row["dropdown_id"] ."'/></td><td>";
                  echo $row["dropdown_name"]."</td><td>";
                  
                  ?><button type='button' class="btn btn-default" onClick="popitup2('hardwareDetails?hid=<?php echo $row['asset_id'];?>')" name='submit'><i class="fa fa-eye"></i> Edit</button>
                  <button type='button' class="btn btn-default" onClick="popitup2('hardwareDetails?hid=<?php echo $row['asset_id'];?>')" name='submit'><i class="fa fa-eye"></i> Delete</button><?php
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
