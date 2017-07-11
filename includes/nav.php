  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/user.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['email']; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
    
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        

         <li class="treeview <?php if($currentPage =='dashboard' ){echo 'active';}?>">
          <a href="dashboard.php">
            <i class="fa fa-dashboard"></i> <span>All Claims</span>
          </a>
        </li> 

          	<?php
		  	if($_SESSION['role']=="dealinghand") {
		  	?>
       
          
           <li class="treeview <?php if($currentPage =='reeval' ){echo 'active';}?>">
          <a href="reeval.php">
            <i class="fa fa-dashboard"></i> <span>Re-eval</span>
          </a>
        </li>
          <?php
            }else if($_SESSION['role']=="hag"){
		  	?>
          <li class="treeview <?php if($currentPage =='dashboard_hag' ){echo 'active';}?>">
          <a href="dashboard_hag.php">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
         
        </li>
          <?php
            }else if($_SESSION['role']=="iadmin"){
          ?>
          <li class="treeview <?php if($currentPage =='dashboard_iadmin' ){echo 'active';}?>">
          <a href="dashboard_iadmin.php">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
          
          <?php
            }else if($_SESSION['role']=="acp"){
          ?>
          <li class="treeview <?php if($currentPage =='dashboard_acp' ){echo 'active';}?>">
          <a href="dashboard_acp.php">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
          
          <?php
            }else if($_SESSION['role']=="admin"){
          ?>
          <li class="treeview <?php if($currentPage =='dashboard_admin' ){echo 'active';}?>">
          <a href="dashboard_admin.php">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>

        <li class="treeview <?php if($currentPage =='logs' ){echo 'active';}?>">
          <a href="logs.php">
            <i class="fa fa-dashboard"></i> <span>Logs</span>
          </a>
        </li>

         
          <?php
            }
          ?>
          
             <li class="treeview <?php if($currentPage =='logout' ){echo 'active';}?>">
          <a href="logout.php">
            <i class="fa fa-dashboard"></i> <span>Logout</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
