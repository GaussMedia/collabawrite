<?php
session_start();
include('Twitter_Login/config/dbconfig.php');
include('webadmin/k.php');
$obj=new KARAMJEET();

 $email = $_GET['email'];

$collection_id=$_GET['collection'];

$sessionuser=$obj->fetch_one('twitter_users',"`id`='".$_SESSION[id]."'");
$collec=$obj->fetch_one('collections',"`id`='".$collection_id."'");


//$query = "SELECT id,username,fullname,email,image,oauth_provider FROM `twitter_users` WHERE username = '$username'";
//$res = mysql_query($query)or die(mysql_error());
//$fetch= mysql_fetch_array($res);
//
////Insert invitee
//$chk_invitee = "SELECT * FROM collection_invitee WHERE author_id=$_SESSION[id] AND collection_id='$collection_id'
// AND invitee_id ='$fetch[id]'";
//$chk_resp = mysql_query($chk_invitee)or die(mysql_error());
//if(mysql_num_rows($chk_resp) > 0)
//{
//    echo 'already added';
//}
// else {
if(!empty($email))
{
    $date=time();
    
echo $sql_invitee="INSERT INTO `c2_reportedly`.`collection_invitee` (
`author_id` ,
`email`,
`collection_id` ,
`creation_date` 
)
VALUES (
 '$_SESSION[id]','$email',  '$collection_id', '$date'
)";
$res_invitee=mysql_query($sql_invitee)or die(mysql_error());
if($res_invitee){
    $to = $email;
    $subject = "$sessionuser[fullname]  has invited you to contribute to a collection ";
    $url = "http://reportedly.pnf-sites.info/";
    $message  ="<html><body>";  
    $message .= "$sessionuser[fullname] has invited you to contribute to the following collection on Reportedly. <br>\n";
//$message .= "<img src='http://reportedly.pnf-sites.info/ajaximage/uploads/".$collec[image]."' alt='' />";
    //$message .= $msg;
    $message .='<a href="'.$url.'write-post.php?collection='.$collec['collection_name'].'">'.$collec[collection_name].'</a> ';
    $message .="<br> Team Reporttedly";
    $message .="<br> ";
    $message .="<br></body></html>";
    $headers ="MIME-Version: 1.0 \r\n"; 
    $headers.="from: Reportedly \r\n"; 
    $headers.="Content-type: text/html;charset=utf-8 \r\n"; 
    $headers.="X-Priority: 3\r\n"; 
    $headers.="X-Mailer: smail-PHP ".phpversion()."\r\n";
    $sentmail = mail($to, $subject, $message, $headers);
    if($sentmail)
    {
       echo "Successfully invited email has sent to this user";
       //echo json_encode($fetch);
    }

    }
    
}
 else {
       echo 'Directly Contact to this person';
       //echo json_encode($fetch);
   }

//}

//}

?>