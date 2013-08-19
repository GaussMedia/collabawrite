<?php

include('Twitter_Login/config/dbconfig.php');
session_start();

$session_id=$_SESSION['id'];
//print_r($_POST);
 $collectionid = $_POST['collectionid'];
 $postid = $_POST['postid'];


$sql_chk = ("SELECT * FROM recommends WHERE recommend_user='$_SESSION[id]' AND recommend_post='$postid' ");
$res_chk = mysql_query($sql_chk)or die(mysql_error());
$fetch_recm=  mysql_fetch_array($res_chk);
//echo mysql_num_rows($res_chk);
//$d = time(); 
if(!mysql_num_rows($res_chk) > '0')
{
 // $d=date("m"); 
    $d = time();
    $sql="INSERT INTO recommends (recommend_user,recommend_post,recommend_collection,creation_date) VALUES('$session_id','$postid','$collectionid','$d')";
   if($res = mysql_query($sql)or die(mysql_error()))
   {
       echo '0';
   }
   
}
else{
    
         $sql="DELETE FROM recommends WHERE recommend_user='$_SESSION[id]' AND recommend_post='$postid' ";
        if($res=mysql_query($sql)or die(mysql_error()))
        {
           echo '1';
        }
}
?>
