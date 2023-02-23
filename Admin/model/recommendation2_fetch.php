<?php

include('../controller/db.php');

include('../function/function.php');

session_start();

$query = '';

$output = array();

$query .= "SELECT * FROM  dbse_recommendation_1 WHERE id <>'' ";

if(isset($_POST["search"]["value"]))

{ 

	$query .= ' AND (team LIKE "%'.$_POST["search"]["value"].'%")';

}


if(isset($_POST["order"]))

{

	$query .= ' ORDER BY team '.$_POST['order']['0']['dir'].' ';

}

else

{

	$query .= ' ORDER BY id ASC ';

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

	$sub_array[] = $row["id"];

	$sub_array[] = get_username_byid($row["team"]);
	
	$data[] = $sub_array;

}

$output = array(

	"draw"    => intval($_POST["draw"]),

	"recordsTotal"  =>  $filtered_rows,

	"recordsFiltered" => get_total_all_recom2(),

	"data"    => $data

);

echo json_encode($output);

?> 