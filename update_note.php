<?php
include('Twitter_Login/config/dbconfig.php');
session_start();
$session_id=$_SESSION['id'];
//print_r($_POST);
 $noteid = $_POST['id'];
 $note = mysql_real_escape_string($_POST['note']);
 //$text = substr($string, $start)
 $d=time(); 
  //$text
if(!empty($note)){
$sql = "UPDATE  `c2_reportedly`.`notes` SET `note`='$note' WHERE id='$noteid'
";
   $res = mysql_query($sql)or die(mysql_error());
   $id = mysql_insert_id();
   if($res)
   {
       $sql_chk = "SELECT * FROM `c2_reportedly`.`notes` WHERE id='$noteid' ";
       $res_chk = mysql_query($sql_chk)or die(mysql_error());
       $fetch=  mysql_fetch_array($res_chk);
       echo json_encode($fetch);
   }
   
}

?>