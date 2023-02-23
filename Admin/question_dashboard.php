<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>DBSE | Question Dashboard</title>
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
  <link href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css" rel="stylesheet" />
  <style>
  div.dataTables_wrapper div.dataTables_length label,
  div.dataTables_wrapper div.dataTables_filter label,
  table.table-bordered.dataTable th,
  table.table-bordered.dataTable tbody td,
  div.dataTables_wrapper div.dataTables_info,
  div.dataTables_wrapper div.dataTables_paginate
  {
   font-size: 14px;	  
 }

 .card-header
 {
   padding: 0.5rem 0.5rem !important;
 }
 .image{
display: flex;
align-items: center;
justify-content: center;
 }
.table-model{
font-size: 14px;
}
.table-model td{
border-top:unset !important;
}
.table-striped tbody td:nth-of-type(2):hover
{
  color:#007bff;
}
.table-striped tbody tr:hover td
{
  background-color: #e8e8e8;;
  border: 1px solid #e8e8e8;;
  /*border-top:4px solid transparent;*/
  /*border-bottom:4px solid transparent;*/
}
.table-striped tbody td:nth-of-type(2)
{
  font-size: 16px !important;
}
.table-bordered td,.table-bordered th {
     border: unset !important; 
}
.items-label {
    font-weight: 300;
    color: #777;
}
.label{
font-weight: 400;
}
.table-striped td,.table-striped th{
    text-align:center;
}
img[id*='product_image']{
  padding:20px;
  margin:10px;
}
</style>
</head>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!--common navbar -->
    <?php include 'common_pages/common_navbar.php';?>

    <!--common sidebar -->
    <?php include 'common_pages/common_sidebar.php';?>
     <?php if($_SESSION['access'][0]['view_product'] != '1' && $_SESSION['role'] != '1') { 
    echo "<script>alert('You Do Not Have Access Rights');location.href='question_dashboard.php';</script>";
    } ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h6>Question Dashboard</h6>
            </div>
            <div class="col-sm-6">
             <!--  <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="product_dashboard.php">Product</a></li>
                <li class="breadcrumb-item active">Product Dashboard</li>
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
                   <div class="col-md-4">
                   </div>
                   <div class="col-md-4">   
                     <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#uploadModal" >Import</button>
                            <div id="uploadModal" class="modal fade" role="dialog">
                                      <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <!--<h4 class="modal-title">File upload form</h4>-->
                                        </div>
                                        <div class="modal-body">
                                            <!-- Form -->
                                            <form method='post' action='controller/import.php' enctype="multipart/form-data">
                                              Select file : <input type='file' name='file' id='file' class='form-control' required ><br>
                                              <input type="hidden" name="url" value="question">
                                              <input type='submit' class='btn btn-info' value='Upload' id='upload'>
                                          </form>

                                          <!-- Preview-->
                                          <div id='preview'></div>
                                      </div>

                                  </div>

                              </div>
                          </div>
                      <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;" onclick="location.href='question_add.php';" >
                      <i class="fas fa-plus"></i>New</button>
                      
                    </div>
                  </div>
                  <!--<h3 class="card-title">DataTable with default features</h3>-->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="question" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Question</th>
				        <th>Type</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
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
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>

  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="dist/js/demo.js"></script>
  <!-- page script -->
  <script>
    $(function () {
     var dataTable = $("#question").DataTable({
      "responsive": true,
      "autoWidth": false,
      "processing" :true,
      "serverSide" :true,
      "dom": 'Bfrtip',
      "buttons": [
           {
                extend: 'collection',
                text: 'Export',
                buttons: [
                    'copy',
                    'excel',
                    'csv',
                    'pdf',
                    'print'
                ]
            }
      ],
      "order" :[],
      "ajax" :{
        url:"model/question_fetch.php",
        type :"POST"
      },
      "ColumnDefs":[{
        "targets":[0,1,2],
        "orderable":true
      },]
    });

    


     $(".delete").click(function(){
      var id = $(this).attr("id");
      if(confirm("Are you sure you want to delete the question?"))
      {
       $.ajax({
        url:"model/generic_delete.php",
        method:"POST",
        data:{id:id,table:'dbse_questions'},
        success:function(data)
        {
          var data = data.split('|');
          if(data[0] == '1'){
            alert(data[1]);
            $('#modal-default').modal('hide');
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
    $('#product tbody').on( 'click', 'tr td', function () {
       var data_row = dataTable.row( $(this).parents('tr') ).data(); // here is the change
       var id = data_row[0];
       $.ajax({
        url:"model/generic_data.php",
        method:"POST",
        data:{id:id,table:'dbse_questions'},
        success:function(data)
        {
          var data = $.parseJSON(data);
          console.log(data);     
          $("#name").html(data[0]['name']);  
          $("#sku").html(data[0]['sku']);  
          $("#category").html(data[0]['category']);  
          $("#subcategory_id").html(data[0]['subcategory_id']);  
          $("#unit").html(data[0]['unit']);  
          $("#series").html(data[0]['series']);  
          $("#ean").html(data[0]['ean']); 
          $("#hsn").html(data[0]['hsn']);  
          if(data[0]['product_image']){
          $("#product_image").attr("src",'controller/'+data[0]['product_image']);  
          }
          else{
          $("#product_image").attr("src",'dist/img/boxed-bg.png');   
          }
          if(data[0]['product_image2']){
          $("#product_image2").attr("src",'controller/'+data[0]['product_image2']);  
          }
          else{
          $("#product_image2").attr("src",'dist/img/boxed-bg.png');   
          }
          if(data[0]['product_image3']){
          $("#product_image3").attr("src",'controller/'+data[0]['product_image3']);  
          }
          else{
          $("#product_image3").attr("src",'dist/img/boxed-bg.png');   
          }
          if(data[0]['product_image4']){
          $("#product_image4").attr("src",'controller/'+data[0]['product_image4']);  
          }
          else{
          $("#product_image4").attr("src",'dist/img/boxed-bg.png');   
          }
          $("#selling_price").html("Rs. "+data[0]['selling_price']);  
          $("#gst").html(data[0]['gst']); 
          $("#media_width").html(data[0]['media_width']); 
          $("#media_thickness").html(data[0]['media_thickness']); 
          $("#print_platform").html(data[0]['print_platform']);
          $("#description").html(data[0]['description']);
          $("#edit_btn").attr("href","product_add.php?id="+data[0]['id']);
          $(".delete").attr("id",data[0]['id']);
          $("#order_logs").html(data[0]['order_logs']);
          $("#prod_logs").html(data[0]['prod_logs']);
          $('#modal-default').modal('show');
        }
      });
     });

    $("#edit_btn").click(function(){
     var href=$(this).attr('href');
      window.location.href=href;
    });

  });
</script>

<script>
  $(function(){
    $( "#question_dashboard" ).addClass( "active" );
  });
</script>
</body>
</html>


<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Product : <span id="name"></span>&nbsp;&nbsp;&nbsp;&nbsp;
          <!-- <a id="edit_btn" href="" class="float-right"><i class="fa fa-edit"></i></a> -->
        </h4>
        <div class="btn-group">
          <button type="button" class="btn btn-info">Action</button>
          <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown">
            <div class="dropdown-menu" role="menu">
              <a id="edit_btn" href="" class="dropdown-item" href="#">Edit</a>
              <a class="dropdown-item delete" href="#">Delete</a>
            </div>
          </button>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card">
          <div class="card-header p-2">
            <ul class="nav nav-pills">
              <li class="nav-item"><a class="nav-link active" href="#Overview" data-toggle="tab">Overview</a></li>
              <li class="nav-item"><a class="nav-link" href="#Transactions" data-toggle="tab">History</a></li>  
              <li class="nav-item"><a class="nav-link" href="#Related" data-toggle="tab">Related Lists</a></li>  
              <!--<li class="nav-item"><a class="nav-link" href="#History" data-toggle="tab">History</a></li>-->
            </ul>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content">
              <div class="active tab-pane" id="Overview">
                <p>Primary Details</p>
                <div class="row">
                  <div class="col-md-6">
                    <table class="table table-model">
                      <tr><td class="items-label">Category</td><td class="label"><span id="category"></span></td></tr>
                      <tr><td class="items-label">Sub Category</td><td class="label"><span id="subcategory_id"></span></td></tr>
                      <tr><td class="items-label">SKU</td><td class="label"><span id="sku"></span></td></tr>
                      <tr><td class="items-label">Unit</td><td class="label"><span id="unit"></span></td></tr>
                      <tr><td class="items-label">Series</td><td class="label"><span id="series"></span></td></tr>
                      <tr><td class="items-label">EAN</td><td class="label"><span id="ean"></span></td></tr>
                      <tr><td class="items-label">Description</td><td class="label"><span id="description"></span></td></tr>
                      <tr><td class="items-label">HSN</td><td class="label"><span id="hsn"></span></td></tr>
                      <tr><td class="items-label">Selling Price</td><td class="label"><span id="selling_price"></span></td></tr>
                      <tr><td class="items-label">GST</td><td class="label"><span id="gst"></span></td></tr>
                      <tr><td class="items-label">Media Width</td><td class="label"><span id="media_width"></span></td></tr>
                      <tr><td class="items-label">Media Thickness</td><td class="label"><span id="media_thickness"></span></td></tr>
                      <tr><td class="items-label">Print Platform</td><td class="label"><span id="print_platform"></span></td></tr>
                    </table>
                  </div>
                  <div class="col-md-6">
                    <div class="row">
                      <div class="col-md-6"><img id="product_image" src="" class="img-fuild" width="200" height="200" /></div>
                      <div class="col-md-6"><img id="product_image2" src="" class="img-fuild" width="200" height="200" /></div>
                    </div>
                     <div class="row">
                      <div class="col-md-6"><img id="product_image3" src="" class="img-fuild" width="200" height="200" /></div>
                      <div class="col-md-6"><img id="product_image4" src="" class="img-fuild" width="200" height="200" /></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="Transactions">
                  <span id="order_logs"></span>
              </div>
              <div class="tab-pane" id="Related">
                  <span id="prod_logs"></span>
              </div>
              <!--<div class="tab-pane" id="History">-->
              <!--</div>-->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
