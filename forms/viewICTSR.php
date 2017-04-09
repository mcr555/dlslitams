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
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
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
<?php
session_start();
require_once('../db.php');
require_once('function.php');
echo '<link rel="stylesheet" type="text/css" href="../css/design1.css"/>';
?>
<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">ICTSR (Service Request Form)</h3>
        <div class="row">
          <div class="col-md-4">
            <?php
                if (isset($_GET['id']))
                {
                    $id=$_GET['id'];

                    $sql = "SELECT *,users.lastname,users.firstname FROM ticket LEFT JOIN users ON ticket.user_id=users.idnumber WHERE ticket_id=$id";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0)
                    {
                        while($row = $result->fetch_assoc()) 
                        {
                            $name=$row["firstname"] . ' ' . $row["lastname"];
                            $ticket_id=$row["ticket_id"];
                            ?>
                            <div class="form-group">
                              <label>Requested by</label>
                              <input type='text' class='form-control' readonly value='<?= $name ?>'>
                            </div>

                            <div class="form-group">
                              <label>Requested for</label>
                              <input type='text' class='form-control' readonly value='<?= $row["requestedFor"] ?>'>
                            </div>

                            <div class="form-group">
                              <label>Date requested</label>
                              <input type='text' class='form-control' readonly  value='<?= $row["date_requested"] ?>'>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                              <label>Local/Contact No.</label>
                              <input type='text' class='form-control' readonly  value='<?= $row["contact"] ?>'>
                            </div>

                            <div class="form-group">
                              <label>Remarks</label>
                              <input type='text' class='form-control' readonly  value='<?= $row["remarks"] ?>'>
                            </div>

                            <div class="form-group">
                              <label>Request Description</label>
                              <textarea rows="3" class="form-control" readonly><?php echo $row["justification"];?></textarea>
                            </div>
                        </div>

                        <div class="col-md-4">
                           <div class="form-group">
                              <label>Immediate Head</label>
                              <input type='text' class='form-control' readonly  value='<?= getName($conn,$ticket_id,1) ?>'>
                            </div>

                            <div class="form-group">
                              <label>Approved by (ICT Manager)</label>
                              <input type='text' class='form-control' readonly   value='<?= getName($conn,$ticket_id,2) ?>'>
                            </div>

                            <div class="form-group">
                              <label>Processed by (ICT Staff)</label>
                              <input type='text' class='form-control' readonly  value='<?= getName($conn,$ticket_id,3) ?>'>
                            </div>

                            <div class="form-group">
                              <label>Affirmed by (ICT Admin)</label>
                              <input type='text' class='form-control' readonly  value='<?= getName($conn,$ticket_id,4) ?>'>
                            </div>
                        </div>
                        <?php
                        }
                    }
                    else echo "No records found";
                }
                else echo 'ID not found';
                ?>
          </div>
        </div>
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
<!-- DataTables -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="../js/popup.js"></script>
</body>
</html>