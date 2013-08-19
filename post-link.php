<?php
session_start();
include('Twitter_Login/config/dbconfig.php');
include('webadmin/k.php');
include('webadmin/resize-class.php');
$obj=new KARAMJEET();
$emails = $_POST['email'];
$text = $_POST['text'];
$email  = explode(',', $emails);
//print_r($email);
   // die;
$length = count($email);
for($i=0;$i<$length;$i++){
    //$postid = $_POST['postid'];
    //echo $getpostid=base64_decode($postid);
    //echo $email[$i];
    //print_r($email);
    //die;
$postid = $_POST['postid'];
$getpostid=base64_decode($postid);
$fetchpost=$obj->fetch_one('drafts',"`id`='".$getpostid."'");
$fetchuser=$obj->fetch_one('twitter_users',"`id`='".$_SESSION[id]."'");
//$url = "http://reportedly.pnf-sites.info/post_more?post=".$postid;
if(!empty($email[$i])){
    $to = $email[$i];
    $subject  = "You have a post from Reportedly";
    $message  ="<html><body>";
    $message .= '<b>'.$text.'</b><br>'; 
    $message .="<a href='http://reportedly.pnf-sites.info/post_more?post=$postid'><img src='http://reportedly.pnf-sites.info/img/logo.3.png' width='100px' height='100px' title='click to go to reported.ly'/></a><br><br>";
    $message .="$fetchuser[fullname] has shared a report from Reportedly. <br>";
    $message .="$fetchpost[title]  <br>";
    
    $message .="http://reportedly.pnf-sites.info/post_more?post=".$postid;
    $message .="<br> <b>About Reportedly</b> <br> ";
    $message .="We believe the creative process is collaborative so we’ve created a process that allows you to invite others to collaborate with you.";
    $message .= "<br> Thanks!";
    $message .="</body></html>";
//    $message .= "\r\nIf you believe you received this in error, feel free to ignore. You may contact us at hello@Reportedly.co \r\n";
    
    $from = "hello@reported.ly";
    $headers ="MIME-Version: 1.0 \r\n"; 
    $headers.="from: $from  $subject  \r\n"; 
    $headers.="Content-type: text/html;charset=utf-8 \r\n"; 
    $headers.="X-Priority: 3\r\n"; 
    $headers.="X-Mailer: smail-PHP ".phpversion()."\r\n";
    $sentmail = mail($to, $subject, $message, $headers);
    if($sentmail)
    {
       $ar[] = 'Successfully emailed post';
       //echo json_encode($ar[0]);
    }
else{
      $ar[] .= 'Not Posted.Try Later to email';
    }
}
}
echo json_encode($ar[0]);
?>
