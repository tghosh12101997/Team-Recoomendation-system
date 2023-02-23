<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Oyster | Role Dashboard</title>
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
  div.dataTables_wrapper div.dataTables_length label,
  div.dataTables_wrapper div.dataTables_filter label,
  table.table-bordered.dataTable th,
  table.table-bordered.dataTable tbody td,
  div.dataTables_wrapper div.dataTables_info,
  div.dataTables_wrapper div.dataTables_paginate
  {
   font-size: 14px !important;	  
 }

 .card-header
 {
   padding: 0.5rem 0.5rem !important;
 }
</style>
<style type="text/css">
.card{
  box-shadow:unset !important;
  background-color: unset !important; 
  background-clip: unset;
  border: unset; 
  border-radius: unset;
}
.card-header{
  border-bottom: unset !important; 
}
</style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <!--common navbar -->
    <?php include 'common_pages/common_navbar.php';?>

    <!--common sidebar -->
    <?php include 'common_pages/common_sidebar.php';?>
   <?php if($_SESSION['access'][0]['view_master'] != '1' && $_SESSION['role'] != '1') { 
    echo "<script>alert('You Do Not Have Access Rights');location.href='catalogue_dashboard.php';</script>";
    } ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h6>Role Dashboard</h6>
            </div>
            <div class="col-sm-6">
              <!-- <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Role Dashboard</li>
              </ol> -->
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <div class="row">
                   <div class="col-md-4"></div>
                   <div class="col-md-4"></div>
                   <div class="col-md-4">   
                     <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;" onclick="location.href='role_add.php';" >
                      <i class="fas fa-plus"></i>New</button>
                    </div>
                  </div>
                  <!--<h3 class="card-title">DataTable with default features</h3>-->
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="role" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Role</th>
                      <th>Permission</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>                  
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
<!-- 	<div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Role</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p id="modal_role"></p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>	 -->  
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
      var dataTable = $("#role").DataTable({
        "responsive": true,
        "autoWidth": false,
        "processing" :true,
        "serverSide" :true,
        "dom": 'Bfrtip',
        "buttons": [
        'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        "order" :[],
        "ajax" :{
          url:"model/role_fetch.php",
          type :"POST"
        },
        "ColumnDefs":[{
          "targets":[0,1,2],
          "orderable":true
        },]
      });

      $(document).on('click', '.delete', function(){
        var id = $(this).attr("id");
        if(confirm("Are you sure you want to delete the Role?"))
        {
         $.ajax({
          url:"model/generic_delete.php",
          method:"POST",
          data:{id:id,table:'oyester_role'},
          success:function(data)
          {
            var data = data.split('|');
            if(data[0] == '1'){
              dataTable.ajax.reload();
            }
            if(data[0] == '2'){
             alert(data[1]);
           }            
         }
       });
       }
       else
       {
         return false; 
       }
     });


	   //Modal
	   // $('#role tbody').on( 'click', 'tr td', function () {            
    //    var data_row = dataTable.row( $(this).parents('tr') ).data(); // here is the change
    //     var role = data_row[0];
		  //   alert(role);
		  //       document.getElementById('modal_role').innerHTML = role;
		  //  $('#modal-default').modal('show');
    // });

  });
</script>
<script>
  $(function(){
    $( "#nav_role_dashboard" ).addClass( "active" );
  });
</script>
</body>
</html>