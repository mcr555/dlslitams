<aside class="main-sidebar">
<section class="sidebar">
            <?php
             
            require_once('../db.php');

                $sql2 = "select imagepath from users where idnumber = '".$_SESSION['id']."'"; 
                $result1 = $conn->query($sql2);
                $row = $result1->fetch_array(MYSQLI_ASSOC);
?>
<div class="user-panel">
  <div class="pull-left image"> <img src="../img/<?php echo $row["imagepath"];?>" class="img-circle" alt="User Image"></div>
  <div class="pull-left info">
    <p><?php echo $_SESSION['firstname'];?></p>
    <a href="#"><?php echo $_SESSION['accountType'];?> </a>
  </div>
</div>

<ul class="sidebar-menu">
  <li class="header">MENU</li>

  <li class="treeview">
    <a href="../admin/home">
      <i class="fa fa-home"></i> <span>Home</span>
    </a>
  </li>

  <li class="treeview">
    <a href="#">
      <i class="fa fa-laptop"></i> <span>Assets</span>
      <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
    </a>
    <ul class="treeview-menu">
      <li><a href="../admin/hardware"><i class="fa fa-circle-o"></i> Hardware</a></li>
      <li>
        <a href="#"><i class="fa fa-circle-o"></i> Software
          <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
        </a>
        <ul class="treeview-menu">
          <li><a href="../admin/software"><i class="fa fa-circle-o"></i> Licensed Software</a></li>
          <li><a href="../admin/freeware"><i class="fa fa-circle-o"></i> Freeware </a></li>
        </ul>
      </li>

      <li>
        <a href="#"><i class="fa fa-circle-o"></i> Components
          <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
        </a>
        <ul class="treeview-menu">
          <li><a href="../admin/componentsUsed"><i class="fa fa-circle-o"></i> Used Components</a></li>
          <li><a href="../admin/componentsUnused"><i class="fa fa-circle-o"></i> Unused Components </a></li>
        </ul>
      </li>

    </ul>
  </li>

  <li class="treeview">
    <a href="#">
      <i class="fa fa-users"></i><span>Deployment</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="../admin/assetsUndeployed"><i class="fa fa-circle-o"></i> Undeployed Asssets</a></li>
      <li><a href="../admin/assetsDeployed"><i class="fa fa-circle-o"></i> Deployed Assets</a></li>
    </ul>
  </li>

  <li class="treeview">
    <a href="#">
      <i class="fa fa-bar-chart"></i> <span>Reports</span>
      <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
    </a>

    <ul class="treeview-menu">
      <li>
        <a href="#"><i class="fa fa-circle-o"></i>Hardware
          <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
        </a>
        <ul class="treeview-menu">
          <li><a href="ReportHardwareStat"><i class="fa fa-circle-o"></i>Status</a></li>
          <li><a href="ReportHardwareLoc"><i class="fa fa-circle-o"></i>Location</a></li>
          <li><a href="ReportHardwareWE"><i class="fa fa-circle-o"></i>Expired Warranty</a></li>
          <li><a href="ReportHardwareWarranty"><i class="fa fa-circle-o"></i>Warranty Expires</a></li>
        </ul>
      </li>
    </ul>
    <ul class="treeview-menu">
      <li>
        <a href="#"><i class="fa fa-circle-o"></i>Software
          <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
        </a>
        <ul class="treeview-menu">
          <li><a href="ReportSoftwareStat"><i class="fa fa-circle-o"></i>Status</a></li>
          <li><a href="ReportSoftwareExp"><i class="fa fa-circle-o"></i>Expired</a></li>
          </a></li>
        </ul>
      </li>
    </ul>
    <ul class="treeview-menu">
    <li>
     <li><a href="ReportComponents"><i class="fa fa-circle-o"></i>Components</a></li>
    </li>
    </ul>
        <ul class="treeview-menu">
      <li>
        <a href="#"><i class="fa fa-circle-o"></i>User
          <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
        </a>
        <ul class="treeview-menu">
          <li><a href="ReportUserStat"><i class="fa fa-circle-o"></i>Status</a></li>
          <li><a href="ReportUserPriv"><i class="fa fa-circle-o"></i>Privilege</a></li>
          <li><a href="ReportUserDevice"><i class="fa fa-circle-o"></i>Device</a></li>
          </a></li>
        </ul>
      </li>
    </ul>
    <ul class="treeview-menu">
    <li>
     <li><a href="ReportTicketStat"><i class="fa fa-circle-o"></i>Request</a></li>
      <li><a href="ReportSupplier"><i class="fa fa-circle-o"></i>Supplier</a></li>
      <li><a href="ReportLogs"><i class="fa fa-circle-o"></i>Logs</a></li>
    </li>
    </ul>


  <li class="treeview">
    <a href="../admin/suppliers">
      <i class="fa fa-dropbox"></i> <span>Supplier</span>
    </a>
  </li>

  <li class="treeview">
    <a href="../admin/pending">
      <i class="fa fa-dropbox"></i> <span>Pending Work Order</span>
    </a>
  </li>

  <li class="treeview">
    <a href="#">
      <i class="fa fa-users"></i><span> Accounts</span>
      <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
    </a>
    <ul class="treeview-menu">
      <li><a href="../admin/users"><i class="fa fa-circle-o"></i> Active Accounts</a></li>
      <li><a href="../admin/userInactive"><i class="fa fa-circle-o"></i> Deactivated Accounts</a></li>
      <li><a href="../admin/register"><i class="fa fa-circle-o"></i> Create new account</a></li>
    </ul>
  </li>

  <li class="treeview">
    <a href="#">
      <i class="fa fa-cog"></i><span> Account Settings</span>
      <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
    </a>
    <ul class="treeview-menu">
      <li><a href="../admin/profile1"><i class="fa fa-circle-o"></i>Profile</a></li>
      <li><a href="../admin/changePass"><i class="fa fa-circle-o"></i>Change Password</a></li>
      <li><a href="../logout"><i class="fa fa-circle-o"></i>Sign Out</a></li>
    </ul>
  </li>

  <li class="treeview">
    <a href="dropdown">
      <i class="fa fa-user-plus"></i> <span>Manage Dropdown</span>
    </a>
  </li>
        
</ul>

</section>
</aside>
