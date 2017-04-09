<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | General UI</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <style>
    .color-palette {
      height: 35px;
      line-height: 35px;
      text-align: center;
    }

    .color-palette-set {
      margin-bottom: 15px;
    }

    .color-palette span {
      display: none;
      font-size: 12px;
    }

    .color-palette:hover span {
      display: block;
    }

    .color-palette-box h4 {
      position: absolute;
      top: 100%;
      left: 25px;
      margin-top: -40px;
      color: rgba(255, 255, 255, 0.8);
      font-size: 12px;
      display: block;
      z-index: 7;
    }

    #hideMe {
    -moz-animation: cssAnimation 0s ease-in 3s forwards;
    /* Firefox */
    -webkit-animation: cssAnimation 0s ease-in 3s forwards;
    /* Safari and Chrome */
    -o-animation: cssAnimation 0s ease-in 3s forwards;
    /* Opera */
    animation: cssAnimation 0s ease-in 3s forwards;
    -webkit-animation-fill-mode: forwards;
    animation-fill-mode: forwards;
    }
    @keyframes cssAnimation {
        to {
            width:0;
            height:0;
            overflow:hidden;
        }
    }
    @-webkit-keyframes cssAnimation {
        to {
            width:0;
            height:0;
            visibility:hidden;
        }
    }

  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<?php 
if(isset($_SESSION['notification']))
{
  if($_SESSION['notification']==1)
    {?>
    <!-- Main content -->
    <div class="col-md-6">
      <div class="box-body">
        <div class="alert alert-success alert-dismissible" id="hideMe" style="z-index:10;position: fixed;bottom: 0;right: 0;width: 300px;">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4><i class="icon fa fa-check"></i> Success!</h4>
          Changes has been saved
        </div>
      </div>
    </div>
    <!-- /.content -->

    <?php $_SESSION['notification']=0;
    }
  if($_SESSION['notification']==2)
    {?>
    <!-- Main content -->
    <div class="col-md-6">
      <div class="box-body">
        <div class="alert alert-warning alert-dismissible"  id="hideMe" style="z-index:10;position: fixed;bottom: 0;right: 0;width: 300px;">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-warning"></i> Data has not been changed/saved!</h4>
            No changes has been made on the data
        </div>
      </div>
    </div>
    <!-- /.content -->

    <?php $_SESSION['notification']=0;
    }
}?>

<!-- jQuery 2.2.3 -->
</body>
</html>
