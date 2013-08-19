<?php
session_start();
include('Twitter_Login/config/dbconfig.php');
include('webadmin/k.php');
$obj=new KARAMJEET();

$username = $_GET['username'];
$collection_id=$_GET['collection'];

$sessionuser=$obj->fetch_one('twitter_users',"`id`='".$_SESSION[id]."'");
$collec=$obj->fetch_one('collections',"`id`='".$collection_id."'");


$query = "SELECT id,username,fullname,email,image,oauth_provider FROM `twitter_users` WHERE username = '$username'";
$res = mysql_query($query)or die(mysql_error());
$fetch= mysql_fetch_array($res);

//Insert invitee
$chk_invitee = "SELECT * FROM collection_invitee WHERE author_id=$_SESSION[id] AND collection_id='$collection_id'
 AND invitee_id ='$fetch[id]'";
$chk_resp = mysql_query($chk_invitee)or die(mysql_error());
if(mysql_num_rows($chk_resp) > 0)
{
    echo 'already added';
}
 else {
    $date=time();
$sql_invitee="INSERT INTO `c2_reportedly`.`collection_invitee` (
`invitee_id` ,
`author_id` ,
`collection_id` ,
`creation_date` 
)
VALUES (
'$fetch[id]', '$_SESSION[id]',  '$collection_id', '$date'
)";
$res_invitee=mysql_query($sql_invitee)or die(mysql_error());
$email=$fetch['email'];
if(!empty($email))
{
    $to = $email;
    $subject = "$sessionuser[fullname]  has invited you to contribute to a collection ";
      //        //From
    $headers.="From: hello@Reportedly.co \r\n"; 
    $headers.="Content-type: text/html;charset=utf-8 \r\n"; 
    $headers.="X-Priority: 3\r\n"; 
    $headers.="X-Mailer: smail-PHP ".phpversion()."\r\n";  
     $message = '<table cellpadding="10" style="border-color: #666;"><tbody><tr style="background: #fddea7;"><td><font color="#990000"><strong> '.$sessionuser[fullname].',</strong></font>has invited you to contribute to the following collection on Reportedly.<br><br><br>
<a target="_blank" href="http://reportedly.pnf-sites.info/collection?collection_name='.$collec['id'].'">'.$collec[collection_name].' </a><br>Thank you,<br>Team Reportedly <br>Thanks! </td></tr></tbody></table>';
//    $headers ="MIME-Version: 1.0 \r\n"; 
//    $headers.="from: Reportedly \r\n"; 
//    $headers.="Content-type: text/html;charset=utf-8 \r\n"; 
//    $headers.="X-Priority: 3\r\n"; 
//    $headers.="X-Mailer: smail-PHP ".phpversion()."\r\n";
//    
    $sentmail = mail($to, $subject, $message, $headers);
    if($sentmail)
    {
//        $d = time();
//       $sql = "INSERT INTO  `c2_reportedly`.`collection_invitee` (`invitee_id`,`author_id `,`collection_id`,`creation_date`) VALUES('$fetch[id]',$_SESSION[id],'$collection_id','$d')";
//       $res = mysql_query($sql)or die(mysql_error());
//       if($res){
            echo json_encode($fetch);
       //}
    }
 else {
       //echo 'Directly Contact to this person';
       echo json_encode($fetch);
   }

}

}

?>