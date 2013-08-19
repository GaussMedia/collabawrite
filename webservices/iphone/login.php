<?php
ob_start();
session_start();
include("resize-class.php");
include("config.php");
getConnection();
$username = $_GET['username'];
$password = $_GET['password'];
$pwd=md5($password);
$sql=mysql_query("SELECT * FROM twitter_users WHERE username='$username' AND password='$pwd'");
$f=mysql_fetch_array($sql);
//print_r($f);
if(!empty($f))
{
    $d=$f['id'];
    echo json_encode($response=array('messsage' => "true",'user_id'=>$d));
}else{
    echo json_encode($response=array('messsage' => "false"));
}

?>