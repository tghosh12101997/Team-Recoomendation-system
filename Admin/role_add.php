<?php 
  include('controller/db.php');
  if(!empty($_REQUEST['id'])){
  $query = 'SELECT * FROM  oyester_role  WHERE id ='.$_REQUEST['id'];
  $query .= ' AND status = 1 ';
  $query .= 'ORDER BY id ASC ';
  $statement = $conn->prepare($query);
  $statement->execute();
  $role_data = $statement->fetchAll();
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Oyster | <?php if(!empty($_REQUEST['id'])){?>Edit<?php }else{?> Add <?php } ?> Role</title>
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
  .table-striped{
    text-align:center;
  }
  input[type=checkbox]{
    height: auto;
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
            <h6><?php if(!empty($_REQUEST['id'])){?>Edit<?php }else{?> Add <?php } ?> Role</h6>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="role_dashboard.php">Role</a></li>
              <li class="breadcrumb-item active"><?php if(!empty($_REQUEST['id'])){?>Edit<?php }else{?> Add <?php } ?> Role</li>
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
				<form action="controller/roles.php" method="post">
				<div class="row">
					<div class="col-12">
					<div class="form-group">
						<label for="inputRole">Role</label>
						<input id="inputRole" name="new_role" id="new_role" class="form-control" value="<?php echo $role_data[0]['role_name']; ?>"  required/>
					</div>
					</div>
				</div>
        <table class="table table-bordered table-striped">
           <thead>
          <tr>
          <th></th>
          <th>Menu</th>
           <th>View</th>
            <th>Add/Edit</th>
            <th>delete</th>
          </tr>
          <tr>
            <td>Product</td>
            <td> <input type="checkbox" name="product"  class="form-control" value="1" <?php if($role_data[0]['product'] == '1'){ echo "checked"; } ?> /></td>
            <td><input type="checkbox" name="view_product"  class="form-control" value="1" <?php if($role_data[0]['view_product'] == '1'){ echo "checked"; } ?> /></td>
            <td><input type="checkbox" name="edit_product"  class="form-control" value="1" <?php if($role_data[0]['edit_product'] == '1'){ echo "checked"; } ?>/></td>
            <td><input type="checkbox" name="delete_product"  class="form-control" value="1" <?php  if($role_data[0]['delete_product'] == '1'){ echo "checked"; } ?> /></td>
          </tr>
           <tr>
            <td>Customer</td>
            <td><input type="checkbox" name="customer"  class="form-control" value="1" <?php if($role_data[0]['customer'] == '1'){ echo "checked"; } ?> /></td>
            <td><input type="checkbox" name="view_customer"  class="form-control" value="1" <?php if($role_data[0]['view_customer'] == '1'){ echo "checked"; } ?> /></td>
            <td><input type="checkbox" name="edit_customer"  class="form-control" value="1" <?php if($role_data[0]['edit_customer'] == '1'){ echo "checked"; } ?> /></td>
            <td><input type="checkbox" name="delete_customer"  class="form-control" value="1" <?php if($role_data[0]['delete_customer'] == '1'){ echo "checked"; } ?> /></td>
          </tr>
           <tr>
            <td>Master</td>
            <td><input type="checkbox" name="master"  class="form-control" value="1" <?php if($role_data[0]['master'] == '1'){ echo "checked"; } ?> /></td>
            <td><input type="checkbox" name="view_master"  class="form-control" value="1" <?php if($role_data[0]['view_master'] == '1'){ echo "checked"; } ?> /></td>
            <td><input type="checkbox" name="edit_master"  class="form-control" value="1" <?php if($role_data[0]['edit_master'] == '1'){ echo "checked"; } ?> /></td>
            <td><input type="checkbox" name="delete_master"  class="form-control" value="1" <?php if($role_data[0]['delete_master'] == '1'){ echo "checked"; } ?> /></td>
          </tr>
            <tr>
            <td>Catalogue</td>
            <td><input type="checkbox" name="catalogue"  class="form-control" value="1" <?php if($role_data[0]['catalogue'] == '1'){ echo "checked"; } ?> /></td>
            <td><input type="checkbox" name="view_catalogue"  class="form-control" value="1" <?php if($role_data[0]['view_catalogue'] == '1'){ echo "checked"; } ?> /></td>
            <td><input type="checkbox" name="edit_catalogue"  class="form-control" value="1" <?php if($role_data[0]['edit_catalogue'] == '1'){ echo "checked"; } ?> /></td>
            <td><input type="checkbox" name="delete_catalogue"  class="form-control" value="1" <?php if($role_data[0]['delete_catalogue'] == '1'){ echo "checked"; } ?> /></td>
          </tr>
           <tr>
            <td>Inquiry</td>
            <td><input type="checkbox" name="inquiry"  class="form-control" value="1" <?php if($role_data[0]['inquiry'] == '1'){ echo "checked"; } ?> /></td>
            <td><input type="checkbox" name="view_inquiry"  class="form-control" value="1" <?php if($role_data[0]['view_inquiry'] == '1'){ echo "checked"; } ?> /></td>
            <td><input type="checkbox" name="edit_inquiry"  class="form-control" value="1" <?php if($role_data[0]['edit_inquiry'] == '1'){ echo "checked"; } ?> /></td>
            <td><input type="checkbox" name="delete_inquiry"  class="form-control" value="1" <?php if($role_data[0]['delete_inquiry'] == '1'){ echo "checked"; } ?> /></td>
          </tr>
          <tr>
            <td>Order</td>
            <td><input type="checkbox" name="orders"  class="form-control" value="1" <?php if($role_data[0]['orders'] == '1'){ echo "checked"; } ?> /></td>
            <td><input type="checkbox" name="view_order"  class="form-control" value="1" <?php if($role_data[0]['view_order'] == '1'){ echo "checked"; } ?> /></td>
            <td><input type="checkbox" name="edit_order"  class="form-control" value="1" <?php if($role_data[0]['edit_order'] == '1'){ echo "checked"; } ?> /></td>
            <td><input type="checkbox" name="delete_order"  class="form-control" value="1" <?php if($role_data[0]['delete_order'] == '1'){ echo "checked"; } ?> /></td>
          </tr>
        </table>	
				<div class="row">
						<div class="col-12">		
							<a href="role_dashboard.php" class="btn btn-secondary">Cancel</a>
              <input type="hidden"  name="id"  class="form-control" value="<?php echo $role_data[0]['id']; ?>">
							<input type="submit" value="<?php if(!empty($_REQUEST['id'])){?>Edit<?php }else{?> Add <?php } ?> Role" class="btn btn-success float-right">
						</div>
					</div>					
				</form>			  
			</div>
			
              </div>
              <!-- /.card-body -->
            
			
            <!-- /.card -->
          
		  
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
$( "#nav_role_dashboard" ).addClass( "active" );
});
</script>
</body>
</html>
