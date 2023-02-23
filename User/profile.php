<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Oyster | Profile</title>
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
   .img1{
    align-items: center;
    border-radius: 80%;
    display: flex;
    margin-left: 40%;
    width: 100px;
    height: 100px;
  }
</style>
</head>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!--common navbar -->
    <?php include 'common_pages/common_navbar.php';?>

    <!--common sidebar -->
    <?php include 'common_pages/common_sidebar.php';?>
    <?php 
    include('controller/db.php');
    if(!empty($_SESSION['id'])){
      $query = 'SELECT * FROM  oyester_login  WHERE id ='.$_SESSION['id'];
      $query .= ' AND status = 1 ';
      $statement = $conn->prepare($query);
      $statement->execute();
      $user_data = $statement->fetchAll();

      $query ='select * from oyester_customer where id='.$user_data[0]["customer_id"];
      $query .= ' AND status = 1 ';
      $statement = $conn->prepare($query);
      $statement->execute(); 
      $customer_data = $statement->fetchAll();
    } 


    ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h6>Profile</h6>
            </div>
            <div class="col-sm-6">
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="card">

           <div class="card-body">
             <form action="controller/update_user.php" method="post"
             enctype="multipart/form-data">
              <div class="row">
               <div class="col-12">
                <div class="form-group">
                 <!-- <label>Profile</label> -->
                 <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <img src="<?php echo 'controller/'.$user_data[0]['pro_img']; ?>" class="img1"/></div>
                        <input type="file" name="pro_img" value="<?php echo $user_data[0]['pro_img']; ?>" />
                       <input type="hidden" name="pro_img_exist" value="<?php echo $user_data[0]['pro_img'];?>" id="product_image_exist">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <table class="table">
              <tr><th>Name</th><td><input type="text" name="name" value="<?php echo $user_data[0]['name']; ?>" class="form-control" required></td></tr>
              <tr><th>Username</th><td><input type="text" name="username" value="<?php echo $user_data[0]['username']; ?>" class="form-control" required></td></tr>
              <tr><th>Password:</th><td><input type="text" name="password" value="<?php echo $user_data[0]['password']; ?>" class="form-control" required></td></tr>
              <tr><th>Company Name:</th><td><?php echo $customer_data[0]["company_name"]?$customer_data[0]["company_name"]:'-';?></td></tr>
              <tr><th>Mobile No.</th><td><?php echo $customer_data[0]["telephone"]?$customer_data[0]["telephone"]:'-';?></td></tr>
              <tr><th>Email</th><td><?php echo $customer_data[0]["customer_email"]?$customer_data[0]["customer_email"]:'-';?></td></tr>
              <input type="hidden" name="id" id="id" value="<?php echo $user_data[0]['id']; ?>" >
           <tr><th>		
            <input type="submit" value="Update  User" class="btn btn-success float-right">
           </th></tr>
            </table>  
       </form>  
    </div>
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
    $( "#user_profile" ).addClass( "active" );
  });
</script>
</body>
</html>
