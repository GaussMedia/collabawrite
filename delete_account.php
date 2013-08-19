<?php
session_start();
include('Twitter_Login/config/dbconfig.php');
include('webadmin/k.php');
$uid = $_SESSION['id'];
session_unset($_SESSION['id']);
$sql = "DELETE FROM twitter_users WHERE id = '$uid' ";
$res = mysql_query($sql);
if($res){
    $ar[] = "Your account exists no more.";
}else{
    $ar[] = "Can't delete your account at the moment";
}
if($ar){
    echo json_encode($ar);
}
?>
