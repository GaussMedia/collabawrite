<?php
session_start();
include('Twitter_Login/config/dbconfig.php');
include('webadmin/k.php');
include('webadmin/resize-class.php');
$obj=new KARAMJEET();
//$fetch=$obj->fetch_one($table,"`id`='".$edit_id."'");
$id = $_SESSION['id'];
$fetchcommentuser=$obj->fetch_one('twitter_users',"`id`='".$id."'");
if(!empty($fetchcommentuser)){
 echo json_encode($fetchcommentuser);
}
?>
