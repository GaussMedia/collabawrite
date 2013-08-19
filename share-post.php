<?php
session_start();
include('Twitter_Login/config/dbconfig.php');
include('webadmin/k.php');
include('webadmin/resize-class.php');
$obj = new KARAMJEET();
$session_id = $_SESSION['id'];
$share_on = $_POST['share_on'];
$post_id = $_POST['postid'];
$d = time();
$sql = "INSERT into shares (`post_id`,`share_on`,`creation_date`) VALUES('$post_id','$share_on','$d')";
$res = mysql_query($sql)or die(mysql_error());
$a[] = "ok";
if($res){
    echo json_encode($a);
}
?>
