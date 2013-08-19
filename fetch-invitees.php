<?php
session_start();
include('Twitter_Login/config/dbconfig.php');
include('webadmin/k.php');
$obj=new KARAMJEET();
$collection_id = $_GET['collecton'];
$query = "SELECT DISTINCT(twitter_users.id) FROM `twitter_users` 
INNER 
JOIN `collection_invitee` ON twitter_users.id=collection_invitee.invitee_id
JOIN `collections` ON collections.id=collection_invitee.collection_id
WHERE collections.id='$collection_id'
";
$res=mysql_query($query)or die(mysql_error());
while($fetch =  mysql_fetch_array($res))
{
    //$sql = "SELECT * FROM twitter_users WHERE id = '$fetch[id]' ";
    //$res = mysql_query($sql);
    //$feteh = mysql_fetch_array($res);
    $collec=$obj->fetch_one('twitter_users',"`id`='".$fetch[id]."'");
    //$fetch_user =  array('id' =>$fetch[id],
                                     // 'fullname' =>$fetch[fullname],
                                     // 'username' =>$fetch[username],    
                                    //  'image' =>$fetch[image],
                                   //   'oauth_provider' =>$fetch[oauth_provider],
        //);
    $fetch_user[] = $collec;
}

//print_r($fetch_user);

echo json_encode($fetch_user);
//print_r($fetch_user);
//echo json_encode($fetch_users);
?>
