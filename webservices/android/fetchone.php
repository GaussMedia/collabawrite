<?php
include('config.php');
$edit_id=$_POST['id'];
$table=$_POST['table'];
getConnection();
$obj=new KARAMJEET();
$fetch=$obj->fetch_one($table,"`payment_id`='".$edit_id."'");
//echo "<pre>";
//print_r($fetch);
//exit;
echo implode(",", $fetch);
//echo json_encode(array("result" => $fetch));
?>