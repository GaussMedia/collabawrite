<?php
session_start();
include('Twitter_Login/config/dbconfig.php');
include('webadmin/k.php');
$obj=new KARAMJEET();
$collection_id = $_POST['id'];
$query = "DELETE FROM collections WHERE   id='$collection_id' AND collection_author='$_SESSION[id]'";
$res=mysql_query($query)or die(mysql_error());
if($res)
{
    $a[] = 'true';
    echo json_encode($a);
}



?>