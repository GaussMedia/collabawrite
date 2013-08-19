<?php
ob_start();
session_start();
include("resize-class.php");
include("config.php");
getConnection();
$obj=new KARAMJEET();
//send Table name
$table="twitter_users";
$sql = "SELECT id,email FROM $table";
$res= mysql_query($sql)or die(mysql_error());
while($fetch = mysql_fetch_array($res))
{
    //echo '<pre>';
    //print_r($fetch);
    $fetch_user=$obj->fetch_one('twitter_users',"`id`='".$fetch['id']."'");
    //echo $fetch_auther['fullname'];
   $Res[]=array($fetch['id']=>$fetch);
}
echo '<pre>';
echo json_encode($Res);
?>
 