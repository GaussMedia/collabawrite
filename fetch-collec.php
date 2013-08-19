<?php
include('Twitter_Login/config/dbconfig.php');
session_start();
$collection_id= $_GET['id'];
$sql="SELECT * FROM `collections` WHERE `id` = '$collection_id'";
$res=  mysql_query($sql)or die(mysql_error());
$fetch= mysql_fetch_array($res);
echo json_encode($fetch);
?>