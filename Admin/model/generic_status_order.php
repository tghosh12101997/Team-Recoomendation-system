<?php
include('../controller/db.php');

ini_set('session.cache_limiter','public');
session_start();

$id = $_REQUEST['id'];
$table = $_REQUEST['table'];
$order_status = $_REQUEST['status'];
$sql =' update '.$table.' set order_status=:order_status where id=:id';
$statement = $conn->prepare($sql);
$statement->bindValue(":order_status", $order_status);
$statement->bindValue(":id", $id);
$count = $statement->execute(); 

$created_by = $_SESSION['id'];

$sql = "INSERT INTO oyester_inquiry_order_log(inquiry_id,order_status,created_by)
 VALUES(:inquiry_id,:order_status,:created_by)";
$statement = $conn->prepare($sql);
$statement->bindValue(":inquiry_id", $id);
$statement->bindValue(":order_status", $order_status);
$statement->bindValue(":created_by", $created_by);

$statement->execute(); 
if(isset($count)) {
   echo "1";
} else {
   echo "2";
}
