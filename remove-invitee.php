<?php
session_start();
include('Twitter_Login/config/dbconfig.php');
include('webadmin/k.php');
$obj=new KARAMJEET();
$invitee_id =  $_GET['id'];
$collection_id = $_GET['collection'];
$sql = "DELETE  FROM collection_invitee WHERE collection_id='$collection_id' AND invitee_id='$invitee_id'";
$res = mysql_query($sql)or die(mysql_error());
if($res)
{
    echo json_encode($res);
}
?>
