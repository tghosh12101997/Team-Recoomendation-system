<?php


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
	$query = 'SELECT * FROM  dbse_recommendation  WHERE user_id ='.$_SESSION['id'];
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
	return '1';
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