<?php
session_start();
include('Twitter_Login/config/dbconfig.php');
include('webadmin/k.php');
$obj=new KARAMJEET();
$collection_id = $_SESSION['last_collection_id'];
$contrbute_type = $_GET['contrbute_type'];
$collection_id  = $_GET['collection'];
$query = "UPDATE  collections SET contribute_type='$contrbute_type' 
WHERE id='$collection_id'
AND collection_author='$_SESSION[id]'";
$res=mysql_query($query)or die(mysql_error());

$ar[] = 'Successfully deleted';

echo json_encode($ar);
?>