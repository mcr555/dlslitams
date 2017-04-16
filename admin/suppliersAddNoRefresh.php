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
  if (isset($_POST['submit']))
  {
      $supplier_name=$_POST['supplier_name'];
      $supplier_address=$_POST['supplier_address'];
      $supplier_email=$_POST['supplier_email'];
      $supplier_contact=$_POST['supplier_contact'];
      $supplier_representative=$_POST['supplier_representative'];

      $sql = "INSERT INTO supplier (supplier_name,supplier_address,supplier_contact,supplier_email,supplier_representative)
          VALUES ('". htmlspecialchars($supplier_name, ENT_QUOTES)."','$supplier_address','$supplier_contact','$supplier_email','$supplier_representative')";

      if (mysqli_query($conn, $sql)){echo '<script>window.close();</script>';}
      else echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      exit();
  }
  ?>
<body class="hold-transition skin-green sidebar-mini">
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Add Supplier</h3>
        </div>
        <div class="box-body">
          <form role="form" action='suppliersAdd' method="post">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                      <label>Name</label>
                      <input type="text" class="form-control" required name='supplier_name' placeholder="Enter Supplier Name">
                      </div>
                      <!-- /.form-group -->
                      <div class="form-group">
                        <label>Address</label><BR>
                        <TEXTAREA NAME='supplier_address' ROWS=4 COLS=40></TEXTAREA>
                      </div>

                      <div class="form-group">
                        <label>Contact Number</label>
                        <input type="text" class="form-control" required name='supplier_contact' placeholder="Enter Contact Number">
                      </div>

                      <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" required name='supplier_email' placeholder="Enter Email">
                      </div>

                      <div class="form-group">
                        <label>Representative</label>
                        <input type="text" class="form-control" required name='supplier_representative' placeholder="Enter Representative">
                      </div>
                      <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                      <!-- /.form-group -->
                <!-- /.form-group -->
              </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div>&nbsp;</div>
          <div class="box-footer">
            <input type='button' class="btn btn-default" onclick="location.href='suppliers';" value='Cancel'/>
            <input type='submit' class="btn btn-success pull-right" value="Submit" name='submit'/>
          </div>
      </form>
      </div>
      <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

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
<!-- bootstrap datepicker -->
<script src="../plugins/datepicker/bootstrap-datepicker.js"></script>

</body>
</html>
