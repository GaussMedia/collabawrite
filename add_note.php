<?php
include('Twitter_Login/config/dbconfig.php');
session_start();
$session_id=$_SESSION['id'];
//print_r($_POST);
 $collectionid = $_POST['collectionid'];
 $postid = $_POST['postid'];
 $note = addslashes(strip_tags($_POST['note']));
 $text = mysql_real_escape_string($_POST['text']);
 $randnum = $_POST['randnum'];
 //$text = substr($string, $start)
 $d=time(); 
  //$text
if(!empty($note)){
$sql = "INSERT INTO `c2_reportedly`.`notes` (`randnum`,`note`,`text` ,`note_author` ,`note_on_post` ,`creation_date` )
VALUES ('$randnum', '$note','$text', '$session_id', '$postid', '$d')
";
   $res = mysql_query($sql)or die(mysql_error());
   $id = mysql_insert_id();
   if($res)
   {
       $sql_chk = "SELECT * FROM `c2_reportedly`.`notes` WHERE id='$id' ";
       $res_chk = mysql_query($sql_chk)or die(mysql_error());
       $fetch=  mysql_fetch_array($res_chk);
       echo json_encode($fetch);
   }
   
}

?>