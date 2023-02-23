<?php

include('../controller/db.php');

include('../function/function.php');

session_start();

$query = '';

$output = array();

$query .= "SELECT * FROM  oyester_role WHERE id <>'' ";

if(isset($_POST["search"]["value"]))

{ 

	$query .= ' AND (role_name LIKE "%'.$_POST["search"]["value"].'%")';

}

$query .= ' AND (status = 1) ';

if(isset($_POST["order"]))

{

	$query .= ' ORDER BY role_name '.$_POST['order']['0']['dir'].' ';

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


	$sub_array[] = $row["role_name"];

	$pers ='';
	if($row['product'] == '1'){
    $pers .='<span class="badge badge-primary" style="color: #fff;
    background-color: lightblue;
    height: 20px;
    font-size: 15px;
    font-weight: normal">Product</span> ';
	}
	if($row['customer'] == '1'){
    $pers .='<span class="badge badge-primary" style="color: #fff;
    background-color: lightcoral;
    height: 20px;
    font-size: 15px;
    font-weight: normal">Customer</span> ';
	}
	if($row['master'] == '1'){
    $pers .='<span class="badge badge-primary" style="color: #fff;
    background-color: lightgreen;
    height: 20px;
    font-size: 15px;
    font-weight: normal">Master</span> ';
	}
	if($row['catalogue'] == '1'){
    $pers .='<span class="badge badge-primary" style="color: #fff;
    background-color: burlywood;
    height: 20px;
    font-size: 15px;
    font-weight: normal">Catalogue</span> ';
	}
	if($row['inquiry'] == '1'){
    $pers .='<span class="badge badge-primary" style="color: #fff;
    background-color: orchid;
    height: 20px;
    font-size: 15px;
    font-weight: normal">Inquiry</span> ';
	}
	if($row['orders'] == '1'){
    $pers .='<span class="badge badge-primary" style="color: #fff;
    background-color: red;
    height: 20px;
    font-size: 15px;
    font-weight: normal">Orders</span> ';
	}

	$sub_array[] = $pers;

	// $sub_array[] = $row["cell_no"]?$row["cell_no"]:'NA';

	$sub_array[] = ' <a href="role_add.php?id='.$row["id"].'"><i class="fa fa-edit btn btn-primary"></i></a> <i id="'.$row["id"].'" class="fas fa-trash-alt btn btn-danger delete"></i>';

	$data[] = $sub_array;

}

$output = array(

	"draw"    => intval($_POST["draw"]),

	"recordsTotal"  =>  $filtered_rows,

	"recordsFiltered" => get_total_all_role(),

	"data"    => $data

);

echo json_encode($output);

?> 