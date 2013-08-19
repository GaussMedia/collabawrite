<?php

include('Twitter_Login/config/dbconfig.php');
session_start();
include('webadmin/k.php');
$obj=new KARAMJEET();
$session_id=$_SESSION['id'];
//print_r($_POST);
 $collectionid = $_POST['collectionid'];
 $postid = $_POST['postid'];

$sql_chk = "SELECT * FROM `c2_reportedly`.`notes` WHERE note_on_post='$postid' ";
$res_chk = mysql_query($sql_chk)or die(mysql_error());
while($fetch=  mysql_fetch_array($res_chk))
{
 $user=$obj->fetch_one('twitter_users',"`id`='".$fetch['note_author']."'");
           
           if($user['oauth_provider'] == 'twitter')
            {
             
              $src='https://api.twitter.com/1/users/profile_image?screen_name='.$user[username].'&size=bigger';
           
            }
            else
            {
                if($user['oauth_provider']== 'facebook')
                {
            
               $src='https://graph.facebook.com/'.$user[username].'/picture?type=normal';
                }
              }
  $src = str_replace('\/', '/',$src);          
       $note[] =  array('note' => $fetch['note'],'random' => $fetch['randnum']);
   // echo json_encode();,'user'=>$fetch
       
      
}
 echo json_encode(array('data'=>$note));
?>
