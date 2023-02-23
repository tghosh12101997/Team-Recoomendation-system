<?php
include('../controller/db.php');
$id = $_REQUEST['id'];
$table = $_REQUEST['table'];
$image =$_REQUEST['image'];
if(!empty($image)){
$sql =' update '.$table.' set '.$image.' = "" where id=:id';
$statement = $conn->prepare($sql);
$statement->bindValue(":id", $id);
$count = $statement->execute(); 
if(isset($count)) {
   echo "1|Deleted Succesfully";
} else {
   echo "2|can't delete";
}
}
else{
$sql =' update '.$table.' set status= 2 where id=:id';
$statement = $conn->prepare($sql);
$statement->bindValue(":id", $id);
$count = $statement->execute(); 
if(isset($count)) {
   echo "1|Deleted Succesfully";
} else {
   echo "2|can't delete";
}
}