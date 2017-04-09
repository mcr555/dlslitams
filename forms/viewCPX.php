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
<body>
<?php
session_start();
require_once('../db.php');
require_once('function.php');
echo '<link rel="stylesheet" type="text/css" href="../css/design1.css"/>';
?>
<div class="box box-success">
  <div class="box-header with-border">
      <form role="form" method='post' action='suppliersEdit'>
        <div class="row">
          <div class="col-md-6">
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
                            $quantity=unserialize($row['quantity']);
                            $amount=unserialize($row['amount']);
                            $specs=unserialize($row['specs']);
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
                              <label>Date needed</label>
                              <input type='text' class='form-control' readonly  value='<?= $row["dateNeeded"] ?>'>
                            </div>

                            <div class="form-group">
                              <label>Date requested</label>
                              <input type='text' class='form-control' readonly  value='<?= $row["date_requested"] ?>'>
                            </div>

                            <div class="form-group">
                              <label>Justification</label>
                              <textarea class="form-control" rows="3" readonly><?php echo $row["justification"];?></textarea>
                            </div>

                             <div class="box">
                                <!-- /.box-header -->
                                <div class="box-body no-padding">
                                  <table class="table table-striped">
                                    <?php echo "<tr>
                                        <th>Quantity/Unit</th>
                                        <th>Amount</th>
                                        <th>Specifications</th>
                                        </tr>";
                                        foreach( $quantity as $key => $n ) {
                                        echo "<tr><td>"
                                        .$n."</td><td>"
                                        .$amount[$key]."</td><td>"
                                        .$specs[$key]."</td></tr>";
                                        }
                                    echo "</table>";?>
                                </div>
                                <!-- /.box-body -->
                              </div>
                              <!-- /.box -->

                                                        <div class="form-group">
                              <label>Recommending Purchase(is)</label>
                              <input type='text' class='form-control' readonly value='<?= getName($conn,$ticket_id,1) ?>'>
                            </div>

                            <div class="form-group">
                              <label>Recommending Purchase(DEAN/Director/Principal)</label>
                              <input type='text' class='form-control' readonly value='<?= getName($conn,$ticket_id,2) ?>'>
                            </div>

                            <div class="form-group">
                              <label>Validated by(BA)</label>
                              <input type='text' class='form-control' readonly  value='<?= getName($conn,$ticket_id,3) ?>'>
                            </div>

                            <div class="form-group">
                              <label>Checked By(FRD Manager)</label>
                              <input type='text' class='form-control' readonly  value='<?= getName($conn,$ticket_id,4) ?>'>
                            </div>

                                                        <div class="form-group">
                              <label>Budget Validation</label>
                              <input type='text' class='form-control' readonly value='<?= getName($conn,$ticket_id,5) ?>'>
                            </div>

                            <div class="form-group">
                              <label>Recommendation</label>
                              <input type='text' class='form-control' readonly  value='<?= getName($conn,$ticket_id,6) ?>'>
                            </div>

                            <div class="form-group">
                              <label>Approved By</label>
                              <input type='text' class='form-control' readonly  value='<?= getName($conn,$ticket_id,7) ?>'>
                            </div>
                  <?php
                        }
                    }
                    else echo "Record not found!";
                }
                else
                {
                    echo 'ID not found';
                }

              ?>
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
</body>
</html>