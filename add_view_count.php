<?php

include('Twitter_Login/config/dbconfig.php');
session_start();
$session_id=$_SESSION['id'];
//print_r($_POST);
 $collectionid = $_POST['collectionid'];
 $postid = $_POST['postid'];


//$sql_chk = "SELECT * FROM `c2_reportedly`.`views` WHERE  view_person='$_SESSION[id]' AND view_post='$postid'";

//$res_chk = mysql_query($sql_chk)or die(mysql_error());
//if(!mysql_num_rows($res_chk) > '0')
//{
   $d=time(); 
   $sql="INSERT INTO `c2_reportedly`.`views`(view_person,view_post,creation_date) VALUES('$session_id','$postid','$d')";
   $res = mysql_query($sql)or die(mysql_error());
   if($res)
   {
       $ar[] = '0';
       echo json_encode($ar);
   }
//}
?>
