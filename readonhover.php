<?php

include('Twitter_Login/config/dbconfig.php');
session_start();
include('webadmin/k.php');
$obj=new KARAMJEET();
$session_id=$_SESSION['id'];
//print_r($_POST);
 $key = $_POST['key'];
 //$postid = $_SESSION['getpostid'];

$sql_chk = "SELECT * FROM `c2_reportedly`.`notes` WHERE randnum='$key' ";

$res_chk = mysql_query($sql_chk)or die(mysql_error());
$fetch=  mysql_fetch_array($res_chk);
 
$fetch['text'] = stripslashes($fetch['text']);
 echo json_encode($fetch);
?>
