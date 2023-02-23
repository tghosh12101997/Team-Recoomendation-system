<?php

include('../controller/db.php');

include('../function/function.php');

session_start();

$query = '';

$output = array();

$query .= "SELECT * FROM  oyester_unit WHERE id <>'' ";

if(isset($_POST["search"]["value"]))

{ 

	$query .= ' AND (unit_name LIKE "%'.$_POST["search"]["value"].'%")';

}

$query .= ' AND (status = 1) ';

if(isset($_POST["order"]))

{

	$query .= ' ORDER BY unit_name '.$_POST['order']['0']['dir'].' ';

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

	$sub_array[] = $row["unit_name"];

	// $sub_array[] = $row["address"];

	// $sub_array[] = $row["cell_no"]?$row["cell_no"]:'NA';

	$sub_array[] = ' <a href="unit_add.php?id='.$row["id"].'"><i class="fa fa-edit btn btn-primary"></i></a> <i id="'.$row["id"].'" class="fas fa-trash-alt btn btn-danger delete"></i>';
	// <button type="button" name="delete" id="'.$row["id"].'" class="btn btn-danger btn-xs delete">Delete</button>';

	$data[] = $sub_array;

}

$output = array(

	"draw"    => intval($_POST["draw"]),

	"recordsTotal"  =>  $filtered_rows,

	"recordsFiltered" => get_total_all_unit(),

	"data"    => $data

);

echo json_encode($output);

?> 