<?php
session_start();
include('Twitter_Login/config/dbconfig.php');
include('webadmin/k.php');
include('webadmin/resize-class.php');
$obj=new KARAMJEET();
$session_id = $_SESSION['id'];

$email = $_POST['email'] ;
$confirm_code=substr(md5(uniqid(rand($pwd), true)), 16, 16);     
$to      = $email;
$subject = 'Reportedly';
$message = 'We got a note saying you want to change your email address for the karamjeetpnf account to $email. Before we do, please confirm the change by clicking here: https://medium.com/m/account/confirm/iW2dRCYRTp0TGko2
If you made this request in error, you can ignore this email.

However, if you did not make this request, please contact us at yourfriends@medium.com.

— Team Medium';
$message = "We got a note saying you want to change your email address for the $email! \r\n";
$message .="please confirm the change by clicking here:"; 
$message .= "http://reportedly.pnf-sites.info/confirm.php?passkey=$confirm_code";
$message .= "If you made this request in error, you can ignore this email";
$message .= "\r\nHowever, if you did not make this request, please contact us at yourfriends@Reportedly.co \r\n";
$message .= "Team Reportedly\r\n";
$message .= "Thanks!";
$headers = 'From:  hello@Reportedly.co \r\n' . "\r\n" .
    'Reply-To: From: hello@Reportedly.co \r\n' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
$ar[] = "Email has sent to email address.check your inbox";
if(mail($to, $subject, $message, $headers)){
    $sql = "UPDATE twitter_users SET confirm_code='$confirm_code',email='$email' WHERE id = '$session_id' "; 
    $res = mysql_query($sql)or die(mysql_error());
    if($res){
    echo  json_encode($ar);
    }
}
?>
