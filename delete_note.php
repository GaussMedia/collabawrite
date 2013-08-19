<?php
include('Twitter_Login/config/dbconfig.php');
session_start();
$sess_id = $_SESSION['id'];
$id = $_POST['id'];
$sql_del_drft = "DELETE FROM notes WHERE id='$id'  ";
$res=mysql_query($sql_del_drft)or die(mysql_error());
$ar[0] = "ok";
echo json_encode($ar);
?>
