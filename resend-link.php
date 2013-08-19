<?php
session_start();
include('Twitter_Login/config/dbconfig.php');
include('webadmin/k.php');
include('webadmin/resize-class.php');
$obj=new KARAMJEET();
$session_id = $_SESSION['id'];
$email = $_POST['email'];
if(empty($email)){
 echo 'link has not resend.';    
}else{
    $confirm_code=substr(md5(uniqid(rand($pwd), true)), 16, 16); 
    $to = $email;
    $subject = "Your new confirmation link here";
    $message = "Thanks for creating an account on ChangeFuel! To verify your account, please click the link below\r\n";
    $message .= "http://reportedly.pnf-sites.info/confirm.php?passkey=$confirm_code";
    $message .= "\r\nIf you believe you received this in error, feel free to ignore. You may contact us at hello@ChangeFuel.co \r\n";
    $message .= "Thanks!";
    $from = "hello@changefuel.co";
    $headers ="MIME-Version: 1.0 \r\n"; 
    $headers.="from: $from  $subject  \r\n"; 
    $headers.="Content-type: text/html;charset=utf-8 \r\n"; 
    $headers.="X-Priority: 3\r\n"; 
    $headers.="X-Mailer: smail-PHP ".phpversion()."\r\n";
    $sentmail = mail($to, $subject, $message, $headers);

if($sentmail)
{
    $sql="UPDATE twitter_users SET confirm_code='$confirm_code' WHERE id='$session_id'";
    $res=mysql_query($sql)or die(mysql_error());
    if($res)
    {
        $ar[] = 'link has resend.check your email.';
        echo json_encode($ar[0]);
        ///echo "<meta http-equiv='refresh' content='=5;index.php' />";
    }
}
}
?>
