<?php
session_start();
include('Twitter_Login/config/dbconfig.php');
include('webadmin/k.php');
include('webadmin/resize-class.php');
$obj=new KARAMJEET();
$getpostid=$_POST['id'];
$sql = "SELECT * FROM drafts WHERE id='$getpostid'";
$fetchpost=  mysql_fetch_array(mysql_query($sql));
echo json_encode($fetchpost);
?>
