<?php
include('k.php'); 
function getConnection()
{
	$host='localhost';
	$user='c2_reportedly';
	$password='123456';
	$db='c2_reportedly';
	$dbh=new connection();
	$dbh->construct($host,$user,$password,$db);
}

?>