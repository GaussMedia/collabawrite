<?php

include('Twitter_Login/config/dbconfig.php');
session_start();
include('webadmin/k.php');
$obj=new KARAMJEET();
$session_id=$_SESSION['id'];
//print_r($_POST);
$postid = $_POST['postid'];

$sql_chk = "SELECT * FROM `c2_reportedly`.`drafts` WHERE id > '$postid' LIMIT 1";
$res_chk = mysql_query($sql_chk)or die(mysql_error());
if(mysql_num_rows($res_chk)>0){
    $fetch=  mysql_fetch_array($res_chk);
    $fetch['id'] = base64_encode($fetch['id']);
    echo json_encode($fetch);
}else{
    $sql_chk = "SELECT * FROM `c2_reportedly`.`drafts` order by `id` ASC LIMIT 1";
    $res_chk = mysql_query($sql_chk)or die(mysql_error());
    $fetch=  mysql_fetch_array($res_chk);
    $fetch['id'] = base64_encode($fetch['id']);
    echo json_encode($fetch);
}
?>
