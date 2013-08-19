<?php
session_start();
$post_id = $_GET['id'];
include('Twitter_Login/config/dbconfig.php');
include('webadmin/k.php');
//$table="collections";
$obj=new KARAMJEET();
$edit_post=$obj->fetch_one('drafts',"`id`='".$post_id."'");
echo json_encode($edit_post);
?>
