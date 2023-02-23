<?php

include('../controller/db.php');

include('../function/function.php');

session_start();

$query = '';

$output = array();

$query .= "SELECT * FROM  oyester_subcategory WHERE id <>'' ";

if(isset($_POST["search"]["value"]))

{ 

	$query .= ' AND (subcategory_name LIKE "%'.$_POST["search"]["value"].'%")';

}

$query .= ' AND (status = 1) ';

if(isset($_POST["order"]))

{

	$query .= ' ORDER BY subcategory_name '.$_POST['order']['0']['dir'].' ';

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

	$sub_array[] = getCategorynamebyid($row["category_id"]);

	$sub_array[] = $row["subcategory_name"];

	// $sub_array[] = $row["cell_no"]?$row["cell_no"]:'NA';

	$sub_array[] = ' <a href="subcategory_add.php?id='.$row["id"].'"><button type="button" name="update" id="'.$row["id"].'" class="btn btn-info btn-xs">Update</button></a>
	<button type="button" name="delete" id="'.$row["id"].'" class="btn btn-danger btn-xs delete">Delete</button>';

	$data[] = $sub_array;

}

$output = array(

	"draw"    => intval($_POST["draw"]),

	"recordsTotal"  =>  $filtered_rows,

	"recordsFiltered" => get_total_all_subcategory(),

	"data"    => $data

);

echo json_encode($output);

?> 