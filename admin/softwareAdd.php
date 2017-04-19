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
<script src="../js/enterToTab.js"></script>

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
            $(wrapper).append('<div class="form-group"><input type="text" class="form-control" name="serial[]"/><a href="#" class="remove_field">Remove</a></div>'); //add input box
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


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<?php
  if (isset($_POST['submit']))
  {
      if (!isset($_POST['version']))
      $version='';
      else $version=$_POST['version'];
      $name=$_POST['name'];
      $expiration_date=$_POST['expiration_date'];
      $date_bought=$_POST['date_bought'];
      
      
      $date = strtotime($expiration_date .' -1 months');
      $final=date('Y-m-d', $date);    
      foreach($_POST['serial'] as $index => $value) {
      if($value!='')
      {
          $sql = "INSERT INTO software (name,version,expiration_date,date_bought,serial,date_warn,type)
      VALUES ('$name','$version','$expiration_date','$date_bought','$value','$final',1)";

      if (mysqli_query($conn, $sql)) 
      {
        
      }

      else 
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      } 
      date_default_timezone_set("Asia/Manila"); 
                $vd=date("Y-m-d h:i:a");
                $sql2 ="select * from software ORDER BY software_id DESC LIMIT 1"; 
                $result1 = $conn->query($sql2);
                $row = $result1->fetch_array(MYSQLI_ASSOC);
                 $sql1 = "select * from users where idnumber = '".$_SESSION['id']."'"; 
                $result = $conn->query($sql1);

            $vn=$_SESSION["firstname"] ;
             $vn1=$_SESSION["middlename"] ;
            $vn2=$_SESSION["lastname"] ;
            $vn3=$_SESSION["accountType"] ;
            $vn4=$row["serial"];
            $vn5=$row["name"];
           

            $sql3 = "INSERT INTO tbl_log(Log_Name, Log_LOP, Log_Date_Time,category, Log_Function,id) VALUES ('$vn $vn1 $vn2','$vn3','$vd','Software','add a $vn5','$vn4')";

            if (mysqli_query($conn, $sql3)){}
            else 
            echo "Error: " . $sql3 . "<br>" . mysqli_error($conn);
  }
  header("Location: software");
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
        Software
      </h1>
      <ol class="breadcrumb">
        <li>Assets</li>
        <li>Software</li>
        <li>Licensed Software</li>
        <li>Add Licensed Software</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Add Licensed Software</h3>
        </div>
        <div class="box-body">
          <form role="form" action="softwareAdd" method="post">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <label>Software Name</label>
                    <input type="text" class="form-control" id="InputSoftwareName" required name='name' placeholder="Enter Software Name">
                </div>
                      <!-- /.form-group -->
                <div class="form-group">
                        <label>Expiration Date</label>
                        <input type="text" class="form-control" required name='expiration_date' id="from-datepicker" placeholder="Enter Expiration Date">
                </div>
                      <!-- /.form-group -->
                <div class="form-group">
                <p>Quantity: <a id="quantity"><?php echo $quantity;?></a></p>
                        <button class="add_field_button">Add More Fields</button>
                </div>
                      <!-- /.form-group -->
                <div id="room_fields" class="input_fields_wrap" >
                        <label>Serial</label>
                        <div><input type="text"  class="form-control" required name="serial[]"><a href="#" class="remove_field">Remove</a></div>
                </div>
                      <!-- /.form-group -->
              </div>
                    <!-- /.col -->
              <div class="col-md-6">
                  <div class="form-group">
                        <label>Date Bought</label>
                        <input type="text" class="form-control" required name='date_bought' id="from-datepicker2" placeholder="Enter Date Bought">
                  </div>
                      <!-- /.form-group -->
                  <div class="form-group">
                    <div class="form-group">
                        <label>Version</label>
                        <input type="text" class="form-control" id="InputVersion" name='version' placeholder="Enter Version">
                    </div>
                <!-- /.form-group -->
                  </div>
              </div>
            </div>
        <!-- /.box-body -->
        <div>&nbsp;</div>
          <div class="box-footer">
            <input type='button' class="btn btn-default" onclick="location.href='software';" value='Cancel'/>
            <input type='submit' class="btn btn-success pull-right" name='submit' value='Submit' />
          </div>
        </form>
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
</body>
</html>
