<?php

include('../controller/db.php');

include('../function/function.php');

session_start();

$query = '';

$output = array();

$query .= "SELECT l.*,a.acad_score FROM  dbse_login l JOIN dbse_acads a ON l.id= a.user_id WHERE l.id <>'' ";

if(isset($_POST["search"]["value"]))

{ 

	$query .= ' AND (l.name LIKE "%'.$_POST["search"]["value"].'%")';

}

$query .= " AND l.role !='1' AND l.status = 1   ";

if(isset($_POST["order"]))

{

	$query .= ' ORDER BY l.name '.$_POST['order']['0']['dir'].' ';

}

else

{

	$query .= ' ORDER BY l.id ASC ';

}

if($_POST["length"] != -1)

{

	$query .= ' LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];

}

$statement = $conn->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

$data = array();

$filtered_rows = $statement->rowCount();

foreach($result as $row)

{

	$sub_array = array();

	$sub_array[] = $row["name"];

	$sub_array[] = $row["email"];
	
	$sub_array[] = $row["acad_score"];
	
	$data[] = $sub_array;

}

$output = array(

	"draw"    => intval($_POST["draw"]),

	"recordsTotal"  =>  $filtered_rows,

	"recordsFiltered" => get_total_all_user(),

	"data"    => $data

);

echo json_encode($output);

?> 