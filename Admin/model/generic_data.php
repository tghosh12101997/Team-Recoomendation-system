<?php
include('../controller/db.php');
include('../function/function.php');
session_start();
$id = $_REQUEST['id'];
$table = $_REQUEST['table'];
$field = $_REQUEST['field'];
if($field =='customer' && $table.trim() =='oyester_customer'){
$sql =' select * from  '.$table.' where company_name=:id';
$statement = $conn->prepare($sql);
$statement->bindValue(":id", $id);
$count = $statement->execute(); 
$data = $statement->fetchAll();
$rows['id'] = $data[0]['id'];
$rows['customer_displayname'] = $data[0]['customer_displayname']?$data[0]['customer_displayname']:$data[0]['first_name'].' '.$data[0]['last_name'];
$rows['customer_displayname1'] = $data[0]['customer_displayname1'];
}

if($table.trim() =='oyester_products'){
$sql =' select * from  '.$table.' where id=:id';
$statement = $conn->prepare($sql);
$statement->bindValue(":id", $id);
$count = $statement->execute(); 
$rows = $statement->fetchAll();
$cat_id = $rows[0]["category"];
$rows[0]['category'] = getCategorynamebyid($rows[0]["category"]);
$rows[0]['subcategory_id'] = getSubCategorynamebyid($rows[0]["subcategory_id"]);
$rows[0]['unit'] = getUnitnamebyid($rows[0]["unit"]);
$sql =' select * from  oyester_inquiry where product_id=:id';
$statement = $conn->prepare($sql);
$statement->bindValue(":id", $rows[0]["id"]);
$count = $statement->execute(); 
$product_data = $statement->fetchAll();
$order_logs ='<table border="1" class="table"><tr><th>Ticket No</th><th>Company Name</th><th>Customer Name</th><th>Amount</th><th>Status</th></tr>';
foreach($product_data as $key => $value){
if(!empty($value['order_status'])){
$order_logs .='<tr><td>'.$value["ticket_no"].''.$value['ticket_id'].'</td><td>'.$value['company_id'].'</td><td>'.$value['customer_name'].'</td><td>';
$order_logs .= $value['final_amt'].'</td><td>'.$value['inquiry_status'].'</td>';
$order_logs .='</tr>';  
}
}
$order_logs .='</table>';
$rows[0]['order_logs'] = $order_logs;

$sql_prod =' select * from  oyester_products where category=:id and status=1';
$statement = $conn->prepare($sql_prod);
$statement->bindValue(":id", $cat_id);
$count = $statement->execute(); 
$product_cat_data = $statement->fetchAll();
$prod_logs ='<table border="1" class="table"><tr><th>Product Name</th><th>Category Name</th><th>Sub Category</tr>';
foreach($product_cat_data as $key => $value){
if(!empty($value['name'])){
$prod_logs .='<tr><td>'.$value['name'].'</td><td>'.getCategorynamebyid($value['category']).'</td><td>'.getSubCategorynamebyid($value['subcategory_id']).'</td>';
$prod_logs .='</tr>';  
}
}
$prod_logs .='</table>';
$rows[0]['prod_logs'] = $prod_logs;

}
if($table.trim() =='oyester_customer' && empty($field)){
$sql =' select * from  '.$table.' where id=:id';
$statement = $conn->prepare($sql);
$statement->bindValue(":id", $id);
$count = $statement->execute(); 
$rows = $statement->fetchAll();
if(!empty($rows)){
$rows[0]['currency'] = getNamebyid($rows[0]["currency"],'oyester_currency');
$rows[0]['payment_terms'] = getNamebyid($rows[0]["payment_terms"],'oyester_payment');
$rows[0]['price_list'] = getNamebyid($rows[0]["price_list"],'oyester_price_list');  
$rows[0]['bill_country_region'] = getNamebyid($rows[0]["bill_country_region"],'oyester_countries'); 
$rows[0]['ship_country_region'] = getNamebyid($rows[0]["ship_country_region"],'oyester_countries'); 
$sql =' select * from  oyester_inquiry where customer_id=:id';
$statement = $conn->prepare($sql);
$statement->bindValue(":id", $rows[0]["id"]);
$count = $statement->execute(); 
$product_data = $statement->fetchAll();
$order_logs ='<table border="1" class="table"><tr><th>Ticket No</th><th>Company Name</th><th>Customer Name</th><th>Amount</th><th>Status</th></tr>';
foreach($product_data as $key => $value){
if(!empty($value['order_status'])){
$order_logs .='<tr><td>'.$value["ticket_no"].''.$value['ticket_id'].'</td><td>'.$value['company_id'].'</td><td>'.$value['customer_name'].'</td><td>';
$order_logs .= $value['final_amt'].'</td><td>'.$value['inquiry_status'].'</td>';
$order_logs .='</tr>';  
}
}
$order_logs .='</table>';
$rows[0]['order_logs'] = $order_logs;
}
}
if($table.trim() =='oyester_inquiry'){
$sql =' select * from  '.$table.' where id=:id';
$statement = $conn->prepare($sql);
$statement->bindValue(":id", $id);
$count = $statement->execute(); 
$rows = $statement->fetchAll();
$cust_id = $rows[0]["customer_id"];
$rows[0]['cust_id'] = $rows[0]["customer_id"];
$rows[0]['customer_id'] = getNamebyid($rows[0]["customer_id"],'oyester_customer');
$rows[0]['customer_info'] = getNamebyinfoid($cust_id,'oyester_customer');
$rows[0]['application_id'] = getNamebyid($rows[0]["application_id"],'oyester_category');
$rows[0]['subcategory_name'] = getNamebyid($rows[0]["product_category_id"],'oyester_subcategory');  
$rows[0]['product_name'] = getNamebyid($rows[0]["product_id"],'oyester_products');  
if($rows[0]['inquiry_status']== 'SENT' && $_SESSION['role'] != 'Dealer' ){
$rows[0]['inquiry_status'] = 'ACTION PENDING';    
}
elseif($rows[0]['inquiry_status']== 'REVISION AWAITED' && $_SESSION['role'] == 'Dealer' ){
$rows[0]['inquiry_status'] = 'NEED TO REVISE';    
}
elseif(trim($rows[0]['inquiry_status'])== 'PREVIEW & EST PENDING' && $_SESSION['role'] == 'Dealer'){
$rows[0]['inquiry_status'] = 'PREVIEW & EST AWAITING';    
}
elseif(trim($rows[0]['inquiry_status'])== 'PREVIEW & EST SENT' && $_SESSION['role'] == 'Dealer'){
$rows[0]['inquiry_status'] = 'APPROVAL PENDING';    
}

$catalogid = explode('_',$rows[0]['catalogue_code_id']);
$sql =' select * from  oyester_catalog where id=:id';
$statement = $conn->prepare($sql);
$statement->bindValue(":id", $catalogid[1]);
$count = $statement->execute(); 
$catalog = $statement->fetchAll();
$rows[0]['catalog_image'] = $catalog[0]['path'];  

$sql_log =' select * from  oyester_inquiry_log where inquiry_id=:id';
$statement = $conn->prepare($sql_log);
$statement->bindValue(":id", $id);
$count = $statement->execute(); 
$rows_logs = $statement->fetchAll();
$logs ='<table border="1" class="table"><tr><th>Date & Time</th><th>Changes done by</th><th>Status</th></tr>';
$sent_cnt = array();
foreach($rows_logs as $key => $value){
if(!empty($value['inquiry_status'])){
if($value['inquiry_status'] == 'SENT'){
$sent_cnt[] = $value['inquiry_status'];
}
$logs .='<tr><td>'.date('d-m-y h:i:s',strtotime($value['created_on'])) .'</td><td>'.getNamebyid($value['created_by'],'oyester_login').'</td><td>';
if($value['inquiry_status'] == 'PREVIEW & EST PENDING'){
$logs .= 'Accepted -> '.$value['inquiry_status'].'</td>';
}
elseif($value['inquiry_status'] == 'REVISION AWAITED'){
$logs .= 'Unaccepted -> '.$value['inquiry_status'].'</td>';
}
elseif($value['inquiry_status'] == 'SENT' && count($sent_cnt) > '1'){
$logs .= 'Edit -> '.$value['inquiry_status'].'</td>';
}
elseif($value['inquiry_status'] == 'ORDER'){
$logs .= 'Approved -> '.$value['inquiry_status'].'</td>';
}
else{
$logs .= $value['inquiry_status'].'</td>';
}
$logs .='</tr>';  
}
}
$logs .='</table>';
$rows[0]['logs'] = $logs;

$sql_o_log =' select * from  oyester_inquiry_order_log where inquiry_id=:id';
$statement = $conn->prepare($sql_o_log);
$statement->bindValue(":id", $id);
$count = $statement->execute(); 
$rows_order_logs = $statement->fetchAll();
$order_logs ='<table border="1" class="table"><tr><th>Date & Time</th><th>Changes done by</th><th>Order Status</th></tr>';
$sent_cnt = array();
foreach($rows_order_logs as $key => $value){
if(!empty($value['order_status'])){
$order_logs .='<tr><td>'.date('d-m-y h:i:s',strtotime($value['created_on'])) .'</td><td>'.getNamebyid($value['created_by'],'oyester_login').'</td><td>';
$order_logs .= $value['order_status'].'</td>';
$order_logs .='</tr>';  
}
}
$order_logs .='</table>';
$rows[0]['order_logs'] = $order_logs;

}
echo json_encode($rows);
