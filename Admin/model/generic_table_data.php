<?php
include('../controller/db.php');
include('../function/function.php');
$table = $_REQUEST['table'];
$name = $_REQUEST['name'];
$search = $_REQUEST['search'];

if(!empty($_REQUEST['search'])){
$cata = explode('/',$_REQUEST['search']);
if(!empty($cata[0]) && count($cata) == '1') {
$name = "  name = '".getcatalogidbyname(trim($cata[0]))."' ";
}
elseif(!empty($cata[0]) && !empty($cata[1])){
$name = "  name = '".getcatalogidbynamevolume(trim($cata[0]),trim($cata[1]))."' and volume = '".getcatalogidbynamevolume(trim($cata[0]),trim($cata[1]))."' ";
}
}


if(!empty($_REQUEST['sub_id'])){
$sql =' select * from  '.$table.' where status=1 and id='.$_REQUEST['id'];
}
else if(!empty($_REQUEST['id'])){
$sql =' select * from  '.$table.' where status=1 and id='.$_REQUEST['id'];
}
else if(!empty($_REQUEST['search'])){
$sql =' select * from  '.$table.' where status=1 and ( '.$name.' or design_name like "%'.$search.'%" or volume like "%'.$search.'%" or tag1 like "%'.$search.'%" or design_ref like "%'.$search.'%" )';
}
else{
$sql =' select * from  '.$table.' where status=1';
}
$statement = $conn->prepare($sql);
$count = $statement->execute(); 
$rows = $statement->fetchAll();
echo json_encode($rows);
