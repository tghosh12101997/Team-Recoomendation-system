<?php

include('../controller/db.php');

include('../function/function.php');

session_start();

$query = '';

$output = array();

$query .= "SELECT rec.*, n.name, n.email,nr.name as r_name, nr.email as r_email FROM  dbse_recommendation rec JOIN dbse_login n ON n.id = rec.user_id JOIN dbse_login nr ON nr.id = rec.recommendation  WHERE rec.id <>'' ";

if(isset($_POST["search"]["value"]))

{ 

	$query .= ' AND (rec.user_id LIKE "%'.$_POST["search"]["value"].'%")';

}


if(isset($_POST["order"]))

{

	$query .= ' ORDER BY rec.distance '.$_POST['order']['0']['dir'].' ';

}

else

{

	$query .= ' ORDER BY rec.user_id, rec.distance ASC ';

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
	
	$sub_array[] = $row["r_name"];
	
	$sub_array[] = $row["r_email"];
	
	$sub_array[] = ' <a href="graph.php?id='.$row["user_id"].'"><i class="fa fa-eye btn btn-primary"></i></a>';

	$data[] = $sub_array;

}

$output = array(

	"draw"    => intval($_POST["draw"]),

	"recordsTotal"  =>  $filtered_rows,

	"recordsFiltered" => get_total_all_recom1(),

	"data"    => $data

);

echo json_encode($output);

?> 