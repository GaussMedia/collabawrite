<?php
session_start();
include('Twitter_Login/config/dbconfig.php');


$location = stripslashes($_POST['newlocation']);

$uid = $_SESSION['id'];

$sql = "UPDATE twitter_users SET location = '$location' WHERE id = '$uid'";
$res = mysql_query($sql)or die(mysql_error());
if($res){
$sql2 = "SELECT location FROM twitter_users WHERE id = '$uid'";
$res2 = mysql_query($sql2)or die(mysql_error());
$fetch = mysql_fetch_array($res2);
if($fetch){
    //$ar[] =$fetch;
    echo json_encode($fetch);
}
}
?>
