<?php
include('controller/db.php');

$query = 'select * from oyester_customer where status =1';
$statement = $conn->prepare($query);
$statement->execute();
$customer_data = $statement->fetchAll();

$query = 'select * from oyester_role where status =1';
$statement = $conn->prepare($query);
$statement->execute();
$role_data = $statement->fetchAll();

if(!empty($_REQUEST['id'])){
  $query = 'SELECT * FROM  oyester_login  WHERE id ='.$_REQUEST['id'];
  $statement = $conn->prepare($query);
  $statement->execute();
  $user_data = $statement->fetchAll();
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Oyster | <?php if(!empty($_REQUEST['id'])){?>Edit<?php }else{?> Add <?php } ?>  User</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  
  <style>
    div.form-group label
    {
     font-size: 13px !important;
   }
 </style>
</head>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!--common navbar -->
    <?php include 'common_pages/common_navbar.php';?>

    <!--common sidebar -->
    <?php include 'common_pages/common_sidebar.php';?>
    <?php if($_SESSION['access'][0]['edit_master'] != '1' && $_SESSION['role'] != '1') { 
    echo "<script>alert('You Do Not Have Access Rights');location.href='catalogue_dashboard.php';</script>";
    } ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h6><?php if(!empty($_REQUEST['id'])){?>Edit<?php }else{?> Add <?php } ?>  User</h6>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="user_dashboard.php">User</a></li>
                <li class="breadcrumb-item active"><?php if(!empty($_REQUEST['id'])){?>Edit<?php }else{?> Add <?php } ?>  User</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="card">
           <div class="card-body">
             <form action="controller/user_add.php" method="post" enctype="multipart/form-data">
            <div class="row">
               <div class="col-12">
                <div class="form-group">
                 <label>Customer</label>
                 <select class="form-control custom-select" name="customer_id" id="customer_id" required="">
                  <option value="">Select Customer</option>
                  <?php foreach($customer_data as $key => $value){ ?>
                    <option value="<?php echo $value['id']; ?>" <?php if($user_data[0]['customer_id'] == $value['id']){ echo "selected"; } ?>><?php echo $value['first_name'].' '.$value['last_name'].' - '.$value['company_name']; ?></option>
                  <?php } ?>
                </select>               
                </div>
             </div>
           </div>
            <div class="row">
               <div class="col-12">
                <div class="form-group">
                 <label>Username</label>
                 <input name="username" value="<?php echo $user_data[0]['username']; ?>" class="form-control" required=""/>
               </div>
             </div>
           </div>
           <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label>Password</label>
                <input name="password" value="<?php echo $user_data[0]['password']; ?>" class="form-control" required=""/>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label>Name</label>
                <input name="name" value="<?php echo $user_data[0]['name']; ?>" class="form-control" required=""/>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label>Profile Image <?php if($user_data[0]['pro_img']){ ?><img src="controller/<?php echo $user_data[0]['pro_img'];?>" width="30" height="20" class="img-fluid" id="image"><?php } ?></label>
                <input type="file" name="pro_img" value="<?php echo $user_data[0]['pro_img']; ?>" class="form-control" />
                <input type="hidden" name="pro_img_exist" value="<?php echo $user_data[0]['pro_img'];?>" id="product_image_exist">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label>Role</label>
                <select class="form-control custom-select" name="role_id" id="role_id" required="">
                  <option value="">Select Role</option>
                  <?php foreach($role_data as $key => $value){ ?>
                    <option value="<?php echo $value['id']; ?>" <?php if($user_data[0]['role'] == $value['id']){ echo "selected"; } ?>><?php echo $value['role_name']; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
           <div class="col-12">		
            <a href="unit_dashboard.php" class="btn btn-secondary">Cancel</a>
            <input type="hidden" name="id" value="<?php echo $user_data[0]['id']; ?>">
            <input type="submit" value="<?php if(!empty($_REQUEST['id'])){?>Edit<?php }else{?> Add <?php } ?>  User" class="btn btn-success float-right">
          </div>
        </div>
      </form>
    </div>
    <!-- /.card-body -->
    <!-- /.card -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->
</div>

<!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!--footer copyright-->
<?php include 'common_pages/footer_copy_right.php';?>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function(){
    $( "#user_dashboard" ).addClass( "active" );
  });
</script>
</body>
</html>
