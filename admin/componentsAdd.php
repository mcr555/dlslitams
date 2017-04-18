<?php
  session_start();
  include_once('denyAccess.php');
  require_once('../db.php');
  $quantity=1;
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
    <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/skin-green.min.css">
  <!-- inadd -->
  <link rel="stylesheet" type="text/css" href="../logo/design1.css"/>
  <link rel="icon" href="../images/icon.png"/>
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

<script>
function validateForm() {
    var dateBought = document.forms["myForm"]["dateBought"].value;
    var warranty_expiration = document.forms["myForm"]["warranty_expiration"].value;
    
    var selectedDate = new Date(dateBought);
    var now = new Date();
    if (selectedDate > now) {
      alert("Date bought is greater than current date");
      return false;
    }

    if (dateBought > warranty_expiration) {
      alert("Warranty expiration date is earlier than the Date Bought");
      return false;
    }
}
</script>

<script>
$( document ).ready(function() {
    $("#from-datepicker").datepicker({ 
        format: 'yyyy-mm-dd'
    });
    $("#from-datepicker").on("change", function () {
        var fromdate = $(this).val();
    });
    $("#from-datepicker2").datepicker({ 
        format: 'yyyy-mm-dd'
    });
    $("#from-datepicker2").on("change", function () {
        var fromdate = $(this).val();
    });
}); 
</script>
<script src="../js/popup.js"></script> 
<script src="../js/ajax.js"></script> 


<?php
if (isset($_POST['submit']))
{
    $name=$_POST['name'];
    $supplier_id=$_POST['supplier_id'];
    $buying_price=$_POST['buying_price'];
    $category=$_POST['category'];
    $warranty_expiration=$_POST['warranty_expiration'];
    $dateBought=$_POST['dateBought'];
    $quantity=$_POST['quantity'];

    for($i=0;$i<$quantity;$i++)
      {
               $sql = "INSERT INTO components (name,supplier_id,component_status,component_category,dateBuy,warranty_expiration,buy_price)
        VALUES ('$name','$supplier_id',0,'$category','$dateBought','$warranty_expiration','$buying_price')";

          if (mysqli_query($conn, $sql)){}
          else echo "Error: " . $sql . "<br>" . mysqli_error($conn); 
      }
        
    $_SESSION['notification']=1;
    header("Location: componentsUnused");

exit();
}
?>

<body class="hold-transition skin-green sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <!-- =============================================== -->

  <?php 
  include_once('main-header.php');
  include_once('sidebar.php');?>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Components
      </h1>
      <ol class="breadcrumb">
        <li>Assets</li>
        <li>Components</li>
        <li>Add Components</li>
      </ol>
    </section>

      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Add Components</h3>
        </div>
        <div class="box-body">
          <form role="form" name="myForm" onsubmit="return validateForm()" action="" method="post">
            <div class="row">
              <div class="col-md-6">

                <div class="form-group">


                    <label>Name</label>
                    <input type="text" class="form-control" id="InputSoftwareName" required name='name' placeholder="Enter Component Name">
                </div>
                <div class="form-group">
                        <label>Price</label>
                        <input class="form-control" type="number" step="0.01" min="0" required name='buying_price' placeholder="Enter Price">
                </div>
                <div class="form-group">

                        <div id="output">
                        <?php
                        echo '<label>Supplier</label>';
                        $sql = "SELECT * FROM supplier";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0)
                        {
                            $select= '<select name="supplier_id">';
                            $select.='<option value=""></option>';
                            while($row = $result->fetch_assoc()) 
                                $select.='<option value="'.$row['supplier_id'].'">'.$row['supplier_name'].'</option>';
                        }
                        $select.='</select>';
                        echo $select;
                        ?>
                        <input type='button'  onClick="popitup2('suppliersAddNoRefresh')" value='Add Supplier'><BR>

                        <?php
                        echo '<label>Categories</label>';
                        $sql = "SELECT * FROM dropdown_list WHERE dropdown_type=2";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0)
                        {
                            $select= '<select name="category">';
                            while($row = $result->fetch_assoc()) 
                                $select.='<option value="'.$row['dropdown_name'].'">'.$row['dropdown_name'].'</option>';
                        }
                        $select.='</select>';
                        echo $select;
                        ?>
                        <input type='button'  onClick="popitup2('addComponentDrop')" value='Add Category'><BR>
                </div>
                        <input type='button' onclick="return getOutput('dropdownSupCat2')" value='Refresh Dropdown Values'>
                </div>
                <div class="form-group">
                <label>Quantity</label><input class="form-control" type="number" min="1" required name='quantity' placeholder="Enter Quantity">
                  
                </div>
                
              </div>
                    <!-- /.col -->
              <div class="col-md-6">
                  <div class="form-group">
                        <label>Warranty Expiration</label>
                        <input type="text" class="form-control" required name='warranty_expiration' id="from-datepicker">
                  </div>
                      <!-- /.form-group -->
                  <div class="form-group">
                    <div class="form-group">
                        <label>Date Bought</label>
                        <input type="text" class="form-control" required name='dateBought' id="from-datepicker2">
                    </div>
                <!-- /.form-group -->
                  </div>
              </div>
            </div>
        <!-- /.box-body -->
          <div class="box-footer">
            <input type='button' class="btn btn-default" onclick="location.href='components';" value='Cancel'/>
            <input type='submit' class="btn btn-success pull-right" name='submit' value='Submit' />
          </div>
        </form>
      </div>
      <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

</div>
  <?php include_once('footer.php');?>


</body>
</html>

