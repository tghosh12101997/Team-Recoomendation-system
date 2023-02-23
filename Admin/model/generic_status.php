<?php
include('../controller/db.php');

ini_set('session.cache_limiter','public');
session_start();

$id = $_REQUEST['id'];
$table = $_REQUEST['table'];
$status = $_REQUEST['status'];
if(trim($status) == 'PREVIEW'){
    $status = 'PREVIEW & EST SENT';
}
$reason = $_REQUEST['reason'];
$estimation_sent = $_REQUEST['estimation_sent'];
$final_amt = $_REQUEST['final_amt'];
if(!empty($estimation_sent)){
$sql =' update '.$table.' set inquiry_status=:status,reason=:reason,estimation_sent=:estimation_sent,final_amt=:final_amt where id=:id';
}
else{
$sql =' update '.$table.' set inquiry_status=:status,reason=:reason where id=:id';
}
$statement = $conn->prepare($sql);
$statement->bindValue(":status", $status);
$statement->bindValue(":reason", $reason);
if(!empty($estimation_sent)){
$statement->bindValue(":estimation_sent", $estimation_sent);
$statement->bindValue(":final_amt", $final_amt);
}
$statement->bindValue(":id", $id);
$count = $statement->execute(); 

$created_by = $_SESSION['id'];
if(!empty($estimation_sent)){
$sql = "INSERT INTO oyester_inquiry_log(inquiry_id,inquiry_status,reason,estimation_sent,final_amt,created_by)
 VALUES(:inquiry_id,:inquiry_status,:reason,:estimation_sent,:final_amt,:created_by)";
}
else{
$sql = "INSERT INTO oyester_inquiry_log(inquiry_id,inquiry_status,reason,created_by)
 VALUES(:inquiry_id,:inquiry_status,:reason,:created_by)";   
}
$statement = $conn->prepare($sql);
$statement->bindValue(":inquiry_id", $id);
$statement->bindValue(":inquiry_status", $status);
$statement->bindValue(":reason", $reason);
if(!empty($estimation_sent)){
$statement->bindValue(":estimation_sent", $estimation_sent);
$statement->bindValue(":final_amt", $final_amt);
}
$statement->bindValue(":created_by", $created_by);

$statement->execute(); 
if($estimation_sent == '1'){
	$URL="../inquiry_dashboard.php";
	echo "<script>location.href='$URL'</script>";
}
if(isset($count)) {
   echo "1";
} else {
   echo "2";
}
