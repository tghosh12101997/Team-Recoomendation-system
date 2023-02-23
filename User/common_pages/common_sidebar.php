<?php 
error_reporting(0);
session_start();
if(empty($_SESSION['id'])){
  echo "<script language='javascript' type='text/javascript'>";
  echo "alert('You are not logged in.');";
  echo "</script>";

  $URL="index.php";
  echo "<script>location.href='$URL'</script>";
}
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="" class="brand-link">
    <img src="../Admin/dist/img/ovgu_logo.jpeg" style="opacity: 8.8;width: 186px;margin-left: 10%;"> <!--class="brand-image img-circle elevation-3"-->
    <!--<span class="brand-text font-weight-light">Oyster</span>-->
    <!--<span class="brand-text" style="font-weight:bold;">Oyster</span>-->
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?php if(!empty($_SESSION['pro_img'])){ echo 'controller/'.$_SESSION['pro_img']; } else { ?>dist/img/user-profile.png<?php } ?>" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block"><?php echo $_SESSION['name']; ?></a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      
        <li class="nav-item">
          <a href="graph.php" class="nav-link" id="graph_dashboard">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Personality Overview
            </p>
          </a>
        </li>
      
       
         <li class="nav-item has-treeview" id="Masters">
          <a  class="nav-link">
            <i class="nav-icon fas fa-search"></i>
            <p>
              Team
              <i class="fas fa-angle-left right"></i>
              <!-- <span class="badge badge-info right">3</span> -->
            </p>
          </a>
           <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="recommendation_1.php" class="nav-link" id="recommendation_1">
                <i class="far fa-circle nav-icon"></i>
                <p>Recommendation 1</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="recommendation_2.php" class="nav-link" id ="recommendation_2">
                <i class="far fa-circle nav-icon"></i>
                <p>Recommendation 2</p>
              </a>
            </li> 
            </ul>
          </li>
       
        <li class="nav-item">
            <a href="question_dashboard.php" class="nav-link" id="question_dashboard">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Questions
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="logout.php" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  
  <style>
    .nav-sidebar .nav-item>.nav-link,
    .nav-sidebar>.nav-item .nav-icon
    {
     font-size:16px !important;
   }
 </style>