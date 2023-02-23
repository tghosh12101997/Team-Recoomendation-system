<?php

function get_sales_data(){
	include('controller/db.php');
	$query = 'SELECT * FROM  oyester_inquiry  WHERE created_on like "%'.date('Y').'-12'.'%"';
	$statement = $conn->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$dec = $statement->rowCount();
    $query = 'SELECT * FROM  oyester_inquiry  WHERE created_on like "%'.date('Y').'-11'.'%"';
	$statement = $conn->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$nov = $statement->rowCount();
	$query = 'SELECT * FROM  oyester_inquiry  WHERE created_on like "%'.date('Y').'-10'.'%"';
	$statement = $conn->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$oct = $statement->rowCount();
	$query = 'SELECT * FROM  oyester_inquiry  WHERE created_on like "%'.date('Y').'-09'.'%"';
	$statement = $conn->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$sept = $statement->rowCount();
	$query = 'SELECT * FROM  oyester_inquiry  WHERE created_on like "%'.date('Y').'-08'.'%"';
	$statement = $conn->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$aug = $statement->rowCount();
	$query = 'SELECT * FROM  oyester_inquiry  WHERE created_on like "%'.date('Y').'-07'.'%"';
	$statement = $conn->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$jul = $statement->rowCount();
	$query = 'SELECT * FROM  oyester_inquiry  WHERE created_on like "%'.date('Y').'-06'.'%"';
	$statement = $conn->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$jun = $statement->rowCount();
	$query = 'SELECT * FROM  oyester_inquiry  WHERE created_on like "%'.date('Y').'-05'.'%"';
	$statement = $conn->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$may = $statement->rowCount();
	$query = 'SELECT * FROM  oyester_inquiry  WHERE created_on like "%'.date('Y').'-04'.'%"';
	$statement = $conn->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$apr = $statement->rowCount();
	$query = 'SELECT * FROM  oyester_inquiry  WHERE created_on like "%'.date('Y').'-03'.'%"';
	$statement = $conn->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$mar = $statement->rowCount();
	$query = 'SELECT * FROM  oyester_inquiry  WHERE created_on like "%'.date('Y').'-02'.'%"';
	$statement = $conn->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$feb = $statement->rowCount();
	$query = 'SELECT * FROM  oyester_inquiry  WHERE created_on like "%'.date('Y').'-01'.'%"';
	$statement = $conn->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$jan = $statement->rowCount();
	return $jan.','.$feb.','.$mar.','.$apr.','.$may.','.$jun.','.$jul.','.$aug.','.$sept.','.$oct.','.$nov.','.$dec;
}

function get_total_all_role(){
	include('../controller/db.php');
	$query = 'SELECT * FROM  oyester_role  WHERE id <>"" ';
	if(isset($_POST["search"]["value"]))
	{
		$query .= ' AND (role_name LIKE "%'.$_POST["search"]["value"].'%")  ';
	}
	$query .= ' AND status = 1 ';
	$query .= 'ORDER BY id ASC ';
	$statement = $conn->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

 function countbytable($table){
 include('controller/db.php');
  $query = 'SELECT * FROM  '.$table.'  WHERE id ';
  
  $statement = $conn->prepare($query);
  $statement->execute();
  return $statement->rowCount();
 }


function get_total_all_question(){
	include('../controller/db.php');
	$query = 'SELECT * FROM  dbse_questions  WHERE id <>"" ';
	if(isset($_POST["search"]["value"]))
	{
		$query .= ' AND (name LIKE "%'.$_POST["search"]["value"].'%")  ';
	}
	$query .= ' AND status = 1 ';
	$query .= 'ORDER BY id ASC ';
	$statement = $conn->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}


function get_total_all_category(){
	include('../controller/db.php');
	$query = 'SELECT * FROM  oyester_category  WHERE id <>"" ';
	if(isset($_POST["search"]["value"]))
	{
		$query .= ' AND (category_name LIKE "%'.$_POST["search"]["value"].'%")  ';
	}
	$query .= ' AND status = 1 ';
	$query .= 'ORDER BY id ASC ';
	$statement = $conn->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}


function getcustomer_total_balance($id){
   include('../controller/db.php');
    $query = 'SELECT * FROM  oyester_inquiry  WHERE customer_id  = '.$id;
	$query .= ' AND status = 1 ';
	$statement = $conn->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$amount = '0';
	foreach ($result as $key => $value) {
    $amount += ($value['final_amt'] - ($value['advance_payment']+$value['amount_recv']));
	}	
	if($amount == '0')
	{
     $amount  = '-';
	}
	return $amount;


}

function get_total_all_unit(){
	include('../controller/db.php');
	$query = 'SELECT * FROM  oyester_unit  WHERE id <>"" ';
	if(isset($_POST["search"]["value"]))
	{
		$query .= ' AND (unit_name LIKE "%'.$_POST["search"]["value"].'%")  ';
	}
	$query .= ' AND status = 1 ';
	$query .= 'ORDER BY id ASC ';
	$statement = $conn->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

function get_total_all_subcategory(){
	include('../controller/db.php');
	$query = 'SELECT * FROM  oyester_subcategory  WHERE id <>"" ';
	if(isset($_POST["search"]["value"]))
	{
		$query .= ' AND (subcategory_name LIKE "%'.$_POST["search"]["value"].'%")  ';
	}
	$query .= ' AND status = 1 ';
	$query .= 'ORDER BY id ASC ';
	$statement = $conn->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}


function get_total_all_currency(){
	include('../controller/db.php');
	$query = 'SELECT * FROM  oyester_currency  WHERE id <>"" ';
	if(isset($_POST["search"]["value"]))
	{
		$query .= ' AND (currency_name LIKE "%'.$_POST["search"]["value"].'%")  ';
	}
	$query .= ' AND status = 1 ';
	$query .= 'ORDER BY id ASC ';
	$statement = $conn->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

function get_total_all_payment(){
	include('../controller/db.php');
	$query = 'SELECT * FROM  oyester_payment  WHERE id <>"" ';
	if(isset($_POST["search"]["value"]))
	{
		$query .= ' AND (payment_name LIKE "%'.$_POST["search"]["value"].'%")  ';
	}
	$query .= ' AND status = 1 ';
	$query .= 'ORDER BY id ASC ';
	$statement = $conn->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

function get_total_all_price_list(){
    include('../controller/db.php');
	$query = 'SELECT * FROM  oyester_price_list  WHERE id <>"" ';
	if(isset($_POST["search"]["value"]))
	{
		$query .= ' AND (price_list_name LIKE "%'.$_POST["search"]["value"].'%")  ';
	}
	$query .= ' AND status = 1 ';
	$query .= 'ORDER BY id ASC ';
	$statement = $conn->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

function get_total_all_customer(){
	include('../controller/db.php');
	$query = 'SELECT * FROM  oyester_customer  WHERE id <>"" ';
	if(isset($_POST["search"]["value"]))
	{
		$query .= ' AND (company_name LIKE "%'.$_POST["search"]["value"].'%")  ';
	}
	$query .= ' AND status = 1 ';
	$query .= 'ORDER BY id ASC ';
	$statement = $conn->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

function get_total_all_user(){
	include('../controller/db.php');
	$query = 'SELECT * FROM  dbse_login  WHERE id <>"" ';
	if(isset($_POST["search"]["value"]))
	{
		$query .= ' AND (name LIKE "%'.$_POST["search"]["value"].'%")  ';
	}
	$query .= ' AND status = 1 aND role !="1" ';
	$query .= 'ORDER BY id ASC ';
	$statement = $conn->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}


function get_total_all_recom1(){
	include('../controller/db.php');
	$query = 'SELECT * FROM  dbse_recommendation  WHERE id <>"" ';
	if(isset($_POST["search"]["value"]))
	{
		$query .= ' AND (user_id LIKE "%'.$_POST["search"]["value"].'%")  ';
	}
	$query .= 'ORDER BY distance ASC ';
	$statement = $conn->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

function get_total_all_recom2(){
	include('../controller/db.php');
	$query = 'SELECT * FROM  dbse_recommendation_1  WHERE id <>"" ';
	if(isset($_POST["search"]["value"]))
	{
		$query .= ' AND (team LIKE "%'.$_POST["search"]["value"].'%")  ';
	}
	$query .= 'ORDER BY id ASC ';
	$statement = $conn->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

function get_username_byid($id){
    include('../controller/db.php');
    $username = '';
    $ids = explode(',',$id);
    foreach($ids as $k => $v){
	$query = 'SELECT name,email FROM  dbse_login  WHERE id ="'.$v.'" ';
	$statement = $conn->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $username .= " <p>".$result[0]['name']."(".$result[0]['email'].") </p>";
    } 
    return $username;
}


function get_total_all_product(){
	include('../controller/db.php');
	$query = 'SELECT * FROM  oyester_products  WHERE id <>"" ';
	if(isset($_POST["search"]["value"]))
	{
		$query .= ' AND (name LIKE "%'.$_POST["search"]["value"].'%")  ';
	}
	$query .= ' AND status = 1 ';
	$query .= 'ORDER BY id ASC ';
	$statement = $conn->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

function get_total_all_inquiry(){
    session_start();
    include('../controller/db.php');
	$query = 'SELECT * FROM  oyester_inquiry  WHERE id <>"" ';
   if($_SESSION['role'] == 'Dealer' || $_SESSION['role'] == 'Studio' || $_SESSION['role'] == 'Architect' || $_SESSION['role'] == 'Interior Designer' ){
    if($_POST["search"]["value"] == 'Awaited'){
    $search = ' inquiry_status LIKE "%REVISION AWAITED%" or inquiry_status LIKE "%PREVIEW & EST SENT%" ';
    }
    elseif($_POST["search"]["value"] == 'Pending'){
    $search = ' inquiry_status ="SENT" or inquiry_status LIKE "%PREVIEW & EST PENDING%"  ';
    }
    else{
    $search =' inquiry_status LIKE "%'.$_POST["search"]["value"].'%" ';
    }
}
else{
    if($_POST["search"]["value"] == 'Awaited'){
    $search = ' inquiry_status ="SENT" or inquiry_status LIKE "%PREVIEW & EST PENDING%" ';
    }
    elseif($_POST["search"]["value"] == 'Pending'){
    $search = ' inquiry_status LIKE "%REVISION AWAITED%" or inquiry_status LIKE "%PREVIEW & EST SENT%" ';
    }
    else{
    $search =' inquiry_status LIKE "%'.$_POST["search"]["value"].'%" ';
    }
}
    	
    if(isset($_POST["search"]["value"]))
    
    { 
    
	$query .= ' AND (ticket_no LIKE "%'.$_POST["search"]["value"].'%"  or '.$search.' or order_status LIKE "%'.$_POST["search"]["value"].'%" )';
    
    }

	$query .= ' AND status = 1 ';
	if($_SESSION['role'] == 'Dealer' || $_SESSION['role'] == 'Studio' || $_SESSION['role'] == 'Architect' || $_SESSION['role'] == 'Interior Designer' ){
    $query .= ' AND created_by ='.$_SESSION['id'];   
    }
	$query .= ' ORDER BY id ASC ';
	$statement = $conn->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

function getCategorynamebyid($cat_id){
	include('../controller/db.php');
	$query = 'SELECT * FROM  oyester_category  WHERE id ='.$cat_id;
	$statement = $conn->prepare($query);
	$statement->execute();
	$result = $statement->fetch();
	return $result['category_name'];
}

function getSubCategorynamebyid($cat_id){
	include('../controller/db.php');
	$query = 'SELECT * FROM  oyester_subcategory  WHERE id ='.$cat_id;
	$statement = $conn->prepare($query);
	$statement->execute();
	$result = $statement->fetch();
	return $result['subcategory_name'];
}

function getUnitnamebyid($unit){
	include('../controller/db.php');
	$query = 'SELECT * FROM  oyester_unit  WHERE id ='.$unit;
	$statement = $conn->prepare($query);
	$statement->execute();
	$result = $statement->fetch();
	return $result['unit_name'];
}

function getRoleCustomerbyid($id){
  	include('../controller/db.php');
	$query = 'SELECT c.*,l.role FROM  oyester_customer c join oyester_login l on c.id = l.customer_id  WHERE c.id ='.$id;
	$statement = $conn->prepare($query);
	$statement->execute();
	$result = $statement->fetch();
	if(empty($result['role'])){
	    return '-';
	}
	else{
	return getNamebyid($result['role'],'oyester_role');  
	}
}

function getNamebyid($id,$table){
	include('../controller/db.php');
	$query = 'SELECT * FROM  '.$table.'  WHERE id ='.$id;
	$statement = $conn->prepare($query);
	$statement->execute();
	$result = $statement->fetch();
    if($table == 'oyester_currency'){
	return $result['currency_name']; 
    }
    if($table == 'oyester_payment'){
	return $result['payment_name']; 
    }
    if($table == 'oyester_price_list'){
	return $result['price_list_name']; 
    }   
    if($table == 'oyester_countries'){
    return $result['country_name']; 
    }
    if($table == 'oyester_role'){
    return $result['role_name']; 
    }
    if($table == 'oyester_customer'){
    return $result['first_name'].' '.$result['last_name']; 
    }
    if($table == 'oyester_category'){
    return $result['category_name']; 
    }
    if($table == 'oyester_subcategory'){
    return $result['subcategory_name']; 
    }
    if($table == 'oyester_products'){
    return $result['name']; 
    }
    if($table == 'oyester_catalogue'){
    return $result['name'];
    }
    if($table == 'oyester_login'){
    return $result['name'];
    }
}

function getNamebyinfoid($id,$table){
   	include('../controller/db.php');
	$query = 'SELECT * FROM  '.$table.'  WHERE id ='.$id;
	$statement = $conn->prepare($query);
	$statement->execute();
	$result = $statement->fetch();
	return 'Phone No:- '.$result['phone_no'].' Email:- '.$result['customer_email'].' Address:- '.$result['bill_attention'];
}

function getcatalogidbyname($name){
   	include('../controller/db.php');
	$query = 'SELECT * FROM oyester_catalogue   WHERE name ="'.trim($name).'" and status=1 ';
	$statement = $conn->prepare($query);
	$statement->execute();
	$result = $statement->fetch();
	return $result['id'];
}

function getcatalogidbynamevolume($name,$volume){
    include('../controller/db.php');
	$query = 'SELECT * FROM oyester_catalogue   WHERE name ="'.trim($name).'" and volume ="'.$volume.'" and status=1 ';
	$statement = $conn->prepare($query);
	$statement->execute();
	$result = $statement->fetch();
	return $result['id'];
}

function numberTowords($num)
{ 
$ones = array( 
1 => "one", 
2 => "two", 
3 => "three", 
4 => "four", 
5 => "five", 
6 => "six", 
7 => "seven", 
8 => "eight", 
9 => "nine", 
10 => "ten", 
11 => "eleven", 
12 => "twelve", 
13 => "thirteen", 
14 => "fourteen", 
15 => "fifteen", 
16 => "sixteen", 
17 => "seventeen", 
18 => "eighteen", 
19 => "nineteen" 
); 
$tens = array( 
1 => "ten",
2 => "twenty", 
3 => "thirty", 
4 => "forty", 
5 => "fifty", 
6 => "sixty", 
7 => "seventy", 
8 => "eighty", 
9 => "ninety" 
); 
$hundreds = array( 
"hundred", 
"thousand", 
"million", 
"billion", 
"trillion", 
"quadrillion" 
); //limit t quadrillion 
$num = number_format($num,2,".",","); 
$num_arr = explode(".",$num); 
$wholenum = $num_arr[0]; 
$decnum = $num_arr[1]; 
$whole_arr = array_reverse(explode(",",$wholenum)); 
krsort($whole_arr); 
$rettxt = ""; 
foreach($whole_arr as $key => $i){ 
if($i < 20){ 
$rettxt .= $ones[$i]; 
}elseif($i < 100){ 
$rettxt .= $tens[substr($i,0,1)]; 
$rettxt .= " ".$ones[substr($i,1,1)]; 
}else{ 
$rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0]; 
$rettxt .= " ".$tens[substr($i,1,1)]; 
$rettxt .= " ".$ones[substr($i,2,1)]; 
} 
if($key > 0){ 
$rettxt .= " ".$hundreds[$key]." "; 
} 
} 
if($decnum > 0){ 
$rettxt .= " and "; 
if($decnum < 20){ 
$rettxt .= $ones[$decnum]; 
}elseif($decnum < 100){ 
$rettxt .= $tens[substr($decnum,0,1)]; 
$rettxt .= " ".$ones[substr($decnum,1,1)]; 
} 
} 
return $rettxt; 
} 

?>