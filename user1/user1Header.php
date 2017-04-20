<!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
           <?php
             
            require_once('../db.php');

                $sql2 = "select imagepath from users where idnumber = '".$_SESSION['id']."'"; 
                $result1 = $conn->query($sql2);
                $row = $result1->fetch_array(MYSQLI_ASSOC);

             if ($result1->num_rows > 0){
              echo"<div class='user-panel'>
  <div class='pull-left image'>  <img src='../img/$row[imagepath]'  class='img-circle' alt='User Image'>";
    

    }
else
echo"<div class='user-panel'>
  <div class='pull-left image'> <img src='../dist/img/user2-160x160.jpg'  class='img-circle' alt='User Image'>";
?>
     
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['firstname'];?></p>
           <a href="#"><?php echo $_SESSION['accountType'];?> </a>
        </div>
      </div>
      <ul class="sidebar-menu">
       
        <li class="treeview">
          <a href="home">
            <i class="fa fa-home"></i> <span>Home</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-file-text-o"></i> <span>Forms</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="formCAPEX"><i class="fa fa-circle-o"></i> CAPEX</a></li>
            <li><a href="formICTSR"><i class="fa fa-circle-o"></i> ICTSR</a></li>
            <li><a href="formATR"><i class="fa fa-circle-o"></i> ATR</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="user1History">
            <i class="fa fa-history"></i> <span>My History Requests</span>
          </a>
        </li>
         </li>
        <li class="treeview">
          <a href="profile1">
            <i class="fa fa-history"></i> <span>Profile</span>
          </a>
        </li>
         <li class="treeview">
          <a href="../logout">
            <i class="fa fa-sign-out"></i> <span>Log out</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>