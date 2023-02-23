<?php 
  include('controller/db.php');
  if(!empty($_REQUEST['id'])){
  $query = 'SELECT * FROM  dbse_questions  WHERE id ='.$_REQUEST['id'];
  $query .= ' AND status = 1 ';
  $query .= 'ORDER BY id ASC ';
  $statement = $conn->prepare($query);
  $statement->execute();
  $catalogue_data = $statement->fetchAll();
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Oyster | <?php if(!empty($_REQUEST['id'])){?>Edit<?php }else{?> Add <?php } ?> Questions</title>
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
  
 .add_plus{
      margin-top:3%;
  }
  
  .zoom:hover{
      transform:scale(5);
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
    echo "<script>alert('You Do Not Have Access Rights');location.href='question_dashboard.php';</script>";
    } ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h6><?php if(!empty($_REQUEST['id'])){?>Edit<?php }else{?> Add <?php } ?> Survey Questions</h6>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="question_dashboard.php">Questions</a></li>
              <li class="breadcrumb-item active"><?php if(!empty($_REQUEST['id'])){?>Edit<?php }else{?> Add <?php } ?> Questions</li>
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
			<form action="controller/question_add.php" method="post"  enctype="multipart/form-data">
				<div class="row">
					<div class="col-12">
						<div class="form-group">
							<label>Question*</label>
							<input name="name" value="<?php echo $catalogue_data[0]['name']; ?>" class="form-control" required/>
						</div>
					</div>
				</div>
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <label>Question Type*</label>
                      <select name="type" class="form-control" required/>
                      <option>Please select the type</option>
                      <option value="Tough or tender" <?php if ($catalogue_data[0]['type'] == 'Tough or Tender') {echo 'selected'; } ?> >Tough or Tender</option>
                      <option value="Success and Risk" <?php if ($catalogue_data[0]['type'] == 'Success and Risk') {echo 'selected'; } ?> >Success and Risk</option>
                      <option value="Optimist or pessimist" <?php if ($catalogue_data[0]['type'] == 'Optimist or Pessimist') {echo 'selected'; } ?> > Optimist or Pessimist</option>
                      <option value="Communicating and Role" <?php if ($catalogue_data[0]['type'] == 'Communicating and Role') {echo 'selected'; } ?> >Communicating and Role</option>
                      <option value="Managing people and resources" <?php if ($catalogue_data[0]['type'] == 'Managing people and Resources') {echo 'selected'; } ?> >Managing people and Resources</option>
                      </select>
                    </div>
                  </div>
                </div>
               
              
				<div class="row">
					<div class="col-12">		
						<a href="catalog_dashboard.php" class="btn btn-secondary">Cancel</a>
            <input type="hidden" name="id" value="<?php echo $catalogue_data[0]['id']; ?>" class="form-control"/>
						<input type="submit" value="Save" class="btn btn-success float-right">
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
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>



<script>
$(function(){
$( "#nav_catalog_dashboard" ).addClass( "active" );
});
var i =2;
var theme_count = '<?php echo $theme_count; ?>';
if(theme_count && theme_count > 0){
    i = parseInt(theme_count) + 1;
}

function add_theme(){
    
  var theme ='<div class="col-5"><div class="form-group"><label>Theme</label><input name="theme[]"  class="form-control" onblur="getthemename(this.value,'+i+')"/></div></div>';
      theme +='<div class="col-5"><div class="form-group"><label>Theme Image</label><input name="theme_img[]"  type="file"  class="form-control" id="theme_'+i+'"/>';
      theme +='</div></div><div class="col-2 add_plus"><i class="fa fa-plus" onclick="add_theme()"></i></div>';  
      $(".add_theme").append(theme);
  i++;
}

function getthemename(theme_name,index){
    if(theme_name != ''){
    $("#theme_"+index).attr('required','true');
    }
    if(theme_name.trim() == ''){
    $("#theme_"+index).removeAttr('required');
    }
}
</script>
</body>
</html>
