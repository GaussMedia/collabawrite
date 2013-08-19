<?php
include('k.php');

function getConnection()
{
	$host='localhost';
	$user='root';
	$password='';
	$db='api1';
	$dbh=new connection();
	$dbh->contruct($host,$user,$password,$db);
}
$db=getConnection();
$obj=new KARAMJEET();
$table=array('test ','(`fnm`,','`lnm`,','`email`,','`pass`)');
$where=array("('karam',","'jeet',","'karamjeetpnf2@gmail.com',","'123456')");
$obj->insert($table,$where);
//$table='test';
//$where='id=19';
//$obj->delete($table,$where);
?>