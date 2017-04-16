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
<?php
session_start();
require_once('../db.php');
if (isset($_POST['submit']))
{
  $supplier_id=$_POST['supplier_id'];
  $supplier_name=$_POST['supplier_name'];
  $supplier_address=$_POST['supplier_address'];
  $supplier_email=$_POST['supplier_email'];
  $supplier_contact=$_POST['supplier_contact'];
  $supplier_representative=$_POST['supplier_representative'];
  

  $sql="UPDATE supplier SET supplier_name ='". htmlspecialchars($supplier_name, ENT_QUOTES)."',supplier_address = '$supplier_address',supplier_email = '$supplier_email',supplier_contact = '$supplier_contact',supplier_representative = '$supplier_representative' WHERE supplier_id = '$supplier_id'";
  if (mysqli_query($conn, $sql)){echo '<script>window.close();</script>';}
  else 
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  exit();

}
?>

<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Edit Supplier</h3>
      <form role="form" method='post' action='suppliersEdit'>
        <div class="row">
          <div class="col-md-6">
            <?php
              $supplier_id=$_GET['sid'];
              $sql = "SELECT * FROM supplier WHERE supplier_id='$supplier_id'";
              $result = $conn->query($sql);

              if ($result->num_rows > 0)
              {
                while($row = $result->fetch_assoc())
                { ?>
                    <div class="form-group">
                      <label>Supplier Name</label>
                      <?php echo "<input type='text' class='form-control' name='supplier_name' value='" . $row['supplier_name'] . "'>"; ?>
                    </div>

                    <div class="form-group">
                      <label>Address</label>
                      <?php echo "<input type='text' class='form-control' name='supplier_address' value='".$row['supplier_address'] . "' >"; ?>
                    </div>

                    <div class="form-group">
                      <label>Contact</label>
                      <?php echo "<input type='text' class='form-control' name='supplier_contact' value='".$row['supplier_contact'] . "' >"; ?>
                    </div>

                    <div class="form-group">
                      <label>Email</label>
                      <?php echo "<input type='email' class='form-control' name='supplier_email' value='".$row['supplier_email'] . "' >"; ?>
                    </div>

                    <div class="form-group">
                      <label>Representative</label>
                      <?php echo "<input type='text' class='form-control' name='supplier_representative' value='".$row['supplier_representative'] . "' >"; ?>
                    </div>
                  <?php
                }
              }
              else echo "Record not found!";

              ?>
            <div class="box-footer">
              <input type='hidden' name='supplier_id' value="<?php echo $supplier_id;?>">
              <input type='submit' class="btn btn-success pull-right" name='submit' value='Submit' />
            </div>
          </div>
        </div>
      </form>
  </div>
</div>


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
    window.onunload = refreshParent;
    function refreshParent() {
        window.opener.location.reload();
    }
</script>
</body>
</html>
