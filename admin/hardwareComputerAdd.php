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
  $(document).ready(function() {
    var max_fields      = 50; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
   
    var x = 1; //initlal text box count
    var quantity=parseInt("<?php echo $quantity;?>");
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div class="form-group"><input type="text" required class="form-control" name="barcode[]"/><a href="#" class="remove_field">Remove</a></div>'); //add input box
        }
        quantity += 1;
        document.getElementById("quantity").innerHTML = quantity;
    });
   
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
        quantity -= 1;
        document.getElementById("quantity").innerHTML = quantity;
    })
  });
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
<script src="../js/enterToTab.js"></script>


<?php
if (isset($_POST['submit']))
{
  $name=$_POST['name'];
  $message=0;
  $supplier_id=$_POST['supplier_id'];
  $buying_price=$_POST['buying_price'];
  $lifespan=$_POST['lifespan'];
  $warranty_expiration=$_POST['warranty_expiration'];
  $dateBought=$_POST['dateBought'];   
  $category=$_POST['category'];
  $barcode=$_POST['barcode'];
  $lifespanEnd = date("Y-m-d", strtotime(date("Y-m-d", strtotime($dateBought)) . " + " .$lifespan ." year"));
  $os=$_POST['os'];
  $nam[]='Processor';
  $nam[]='Memory';
  $nam[]='Video Card';
  $nam[]='Audio Card';
  $nam[]='Optical Drive';
  $nam[]='Storage';
  $nam[]='Motherboard';
  if (!isset($_POST['barcode']))
  {
      $_SESSION['notification']=2;
      echo "<script>window.location.href='hardware';</script>";
      exit();
  }
  $barcode = array_unique($barcode); 
  foreach($barcode as $index => $value)
  {
    $duplicate=0;
    if($value!='')
    {
      $sql = "SELECT * FROM hardware WHERE barcode='$value'";
      $result = $conn->query($sql);
      if ($result->num_rows > 0)
      {
        while($row = $result->fetch_assoc())
        {
          echo "Duplicate barcode found: $value<BR>";
          $duplicate=1;
          $message=1;
          break;
        }
      } 
    if($duplicate==1) continue;

    $sql = "INSERT INTO hardware (lifespanEnd,hardware_category,location,supplier_id,name,buying_price,book_value,warranty_expiration,dateBought,barcode,asset_type)
      VALUES ('$lifespanEnd','$category','warehouse','$supplier_id','$name','$buying_price','$buying_price','$warranty_expiration','$dateBought','$value',2)";
      
    if (mysqli_query($conn, $sql))
    {
      $asset_id = mysqli_insert_id($conn);
      foreach($_POST['com'] as $index2 => $value2)
      {
        if($value2=='') continue;
        $sql2 = "INSERT INTO components (asset_id,name,component_status,component_category)
        VALUES ('$asset_id','$value2',1,'$nam[$index2]')";
        mysqli_query($conn, $sql2);
        date_default_timezone_set("Asia/Manila"); 
        $vd=date("Y-m-d h:i:a");
        $sql2 ="select * from hardware ORDER BY asset_id DESC LIMIT 1"; 
        $result1 = $conn->query($sql2);
        $row = $result1->fetch_array(MYSQLI_ASSOC);
        $sql1 = "select * from users where idnumber = '".$_SESSION['idnumber']."'"; 
        $result = $conn->query($sql1);

        $vn=$_SESSION["firstname"] ;
        $vn1=$_SESSION["middlename"] ;
        $vn2=$_SESSION["lastname"] ;
        $vn3=$_SESSION["accountType"] ;
        $vn4=$row["asset_id"];

        $sql3 = "INSERT INTO tbl_log(Log_Name, Log_LOP, Log_Date_Time, Log_Function) VALUES ('$vn $vn1 $vn2','$vn3','$vd','add a hardware($vn4)')";
        if (mysqli_query($conn, $sql3)){}
        else echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
    }
    else echo "Error: " . $sql . "<br>" . mysqli_error($conn);

    $sql = "INSERT INTO software (name,type,asset_id)
      VALUES ('$os',1,'$asset_id')";
    mysqli_query($conn, $sql);
    }
  }
  if($message==1){
    echo '<BR>Barcodes with duplicate will not be saved<BR><a href="hardware">Back</a>';
    exit();
    }
      $_SESSION['notification']=1;
      echo "<script>window.location.href='hardware';</script>";
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
      <h1>Hardware</h1>
      <ol class="breadcrumb">
        <li>Assets</li>
        <li>Hardware</li>
        <li>Add Hardware</li>
      </ol>
  </section>

  <div class="box box-success">
    <div class="box-header with-border">
    <h3 class="box-title">Add Hardware</h3>
    </div>

    <div class="box-body">
    <form role="form" name="myForm" onsubmit="return validateForm()" action="hardwareComputerAdd" method="post">
      <div class="row">

        <div class="col-md-6">

          <div class="form-group">
              <label>Name</label>
              <input type="text" class="form-control" id="InputSoftwareName" required name='name' placeholder="Enter Software Name">
          </div>

          <div class="form-group">
                  <label>Price</label>
                  <input class="form-control" type="number" step="0.01" min="0" required name='buying_price' placeholder="Enter Price">
          </div>

          <div class="form-group">
                  <label>Warranty Expiration</label>
                  <input type="text" class="form-control" required name='warranty_expiration' id="from-datepicker">
          </div>

          <div class="form-group">
                  <label>Date Bought</label>
                  <input type="text" class="form-control" required name='dateBought' id="from-datepicker2">
          </div>

          <div class="form-group">
                  <label>Lifespan(Years)</label>
                  <input type="number" min='0' class="form-control" required name='lifespan'>
          </div>

          <div class="form-group">
                  <label>Category</label>
                  <select name="category">';
                      <option value="laptop">Laptop</option>
                      <option value="desktop">Desktop</option>
                  </select>
          </div>

          <div class="form-group">
                  
                  <div class="form-group" id="output">
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
                  </div>

                  <input type='button'  onClick="popitup2('suppliersAddNoRefresh')" value='Add Supplier'><BR>
                  <input type='button' onclick="return getOutput('dropdownSuppliers')" value='Refresh Dropdown Values'>
          </div>

          <div class="form-group">
                <p>Quantity: <a id="quantity"><?php echo $quantity;?></a></p>
                        <button class="add_field_button">Add More Fields</button>
                </div>

          <div id="room_fields" class="input_fields_wrap" >
                        <label>Barcode</label>
                        <div><input type="text"  required class="form-control" name="barcode[]"><a href="#" class="remove_field">Remove</a></div>
                </div>

        </div>
              <!-- /.col -->
        <div class="col-md-6">

            <div class="form-group">
                  <label>Processor</label>
                  <input type="text" class="form-control" required name='com[]'>
            </div>

                <!-- /.form-group -->
              <div class="form-group">
                  <label>Memory</label>
                  <input type="text" class="form-control" required name='com[]'>
              </div>

              <div class="form-group">
                  <label>Video Card</label>
                  <input type="text" class="form-control" required name='com[]'>
              </div>

              <div class="form-group">
                  <label>Audio Card</label>
                  <input type="text" class="form-control" required name='com[]'>
              </div>

              <div class="form-group">
                  <label>Optical Drive</label>
                  <input type="text" class="form-control" name='com[]'>
              </div>

              <div class="form-group">
                  <label>Storage</label>
                  <input type="text" class="form-control" required name='com[]'>
              </div>

              <div class="form-group">
                  <label>Motherboard</label>
                  <input type="text" class="form-control" required name='com[]'>
              </div>

              <div class="form-group">
                  <label>OS</label>
                  <input type="text" class="form-control" required name='os'>
              </div>
          <!-- /.form-group -->
        </div>
      </div>
        <!-- /.box-body -->
          <div class="box-footer">
            <input type='button' class="btn btn-default" onclick="location.href='hardware';" value='Cancel'/>
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
