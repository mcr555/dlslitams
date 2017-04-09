<aside class="main-sidebar">
<section class="sidebar">

<div class="user-panel">
  <div class="pull-left image"><img src="../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"></div>
  <div class="pull-left info">
    <p><?php echo $_SESSION['firstname'];?></p>
    <a href="#"><?php echo $_SESSION['accountType'];?> </a>
  </div>
</div>

<ul class="sidebar-menu">
  <li class="header">MENU</li>

  <li class="treeview">
    <a href="home">
      <i class="fa fa-home"></i> <span>Home</span>
    </a>
  </li>

  <li class="treeview">
    <a href="#">
      <i class="fa fa-laptop"></i> <span>Assets</span>
      <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
    </a>
    <ul class="treeview-menu">
      <li><a href="hardware"><i class="fa fa-circle-o"></i> Hardware</a></li>
      <li>
        <a href="#"><i class="fa fa-circle-o"></i> Software
          <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
        </a>
        <ul class="treeview-menu">
          <li><a href="software"><i class="fa fa-circle-o"></i> Licensed Software</a></li>
          <li><a href="freeware"><i class="fa fa-circle-o"></i> Freeware </a></li>
        </ul>
      </li>
      <li><a href="components"><i class="fa fa-circle-o"></i> Component</a></li>
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
      <li><a href="assetsUndeployed"><i class="fa fa-circle-o"></i> Undeployed Asssets</a></li>
      <li><a href="assetsDeployed"><i class="fa fa-circle-o"></i> Deployed Assets</a></li>
    </ul>
  </li>

  <li>
    <a href="#">
      <i class="fa fa-bar-chart"></i> <span>Reports</span>
      <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
    </a>

    <ul class="treeview-menu">
      <li>
        <a href="#"><i class="fa fa-circle-o"></i> Hardware
          <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
        </a>
        <ul class="treeview-menu">
          <li><a href="../reports/hardwareRepstat"><i class="fa fa-circle-o"></i> Status</a></li>
          <li><a href="../reports/hardwareReploc"><i class="fa fa-circle-o"></i> Location</a></li>
          <li><a href="../reports/hardwareRepdate"><i class="fa fa-circle-o"></i> Date Range</a></li>
        </ul>
      </li>
    </ul>
    <ul class="treeview-menu">
      <li>
        <a href="../reports/componentsRepdate"><i class="fa fa-circle-o"></i> Components
        </a>
      </li>
    </ul>
    <ul class="treeview-menu">
      <li>
        <a href="#"><i class="fa fa-circle-o"></i> Software
          <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
        </a>
        <ul class="treeview-menu">
          <li><a href="../reports/softwareRepstat"><i class="fa fa-circle-o"></i> Status</a></li>
          <li><a href="../reports/softwareRepexp"><i class="fa fa-circle-o"></i> Expired</a></li>
          <li><a href="../reports/softwareRepdate"><i class="fa fa-circle-o"></i> Date Range</a></li>
        </ul>
      </li>
    </ul>
  </li>

  <li class="treeview">
    <a href="suppliers">
      <i class="fa fa-dropbox"></i> <span>Supplier</span>
    </a>
  </li>

  <li class="treeview">
    <a href="pending">
      <i class="fa fa-dropbox"></i> <span>Pending Work Order</span>
    </a>
  </li>

  <li class="treeview">
    <a href="#">
      <i class="fa fa-users"></i><span> Accounts</span>
      <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
    </a>
    <ul class="treeview-menu">
      <li><a href="users"><i class="fa fa-circle-o"></i> Active Accounts</a></li>
      <li><a href="userInactive"><i class="fa fa-circle-o"></i> Deactivated Accounts</a></li>
      <li><a href="register"><i class="fa fa-circle-o"></i> Create new account</a></li>
    </ul>
  </li>

  <li class="treeview">
    <a href="#">
      <i class="fa fa-cog"></i><span> Account Settings</span>
      <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
    </a>
    <ul class="treeview-menu">
      <li><a href="profile"><i class="fa fa-circle-o"></i>Profile</a></li>
      <li><a href="changePass"><i class="fa fa-circle-o"></i>Change Password</a></li>
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
