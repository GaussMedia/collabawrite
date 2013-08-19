<?php

require 'dbconfig.php';

class UserFb {

    function checkUser($uid, $username,$fullname,$email) 
	{
            $ip = $_SERVER['REMOTE_ADDR'];
            $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));
           $query = "SELECT * FROM `twitter_users` WHERE oauth_uid = '$uid' AND    oauth_provider = 'facebook'";
        $res = mysql_query($query)or die(mysql_error());
        $result = mysql_fetch_array($res);
//        echo '<pre>';
//        print_r($result);
//        die;
        if (!empty($result)) {
            # User is already present
            echo 'User already exists';
            header("Location: http://reportedly.pnf-sites.info/");
            
        } else {
            #user not present. Insert a new Record
            
            //echo '<pre>';
            //print_r($ip_data);
            //die;
            //$addrress = $ip_data->geoplugin_city." ".$ip_data->geoplugin_region." ".$ip_data->geoplugin_countryName;
            $confirm_code=substr(md5(uniqid(rand($pwd), true)), 16, 16);
            $d=time();
             $query = "INSERT INTO `twitter_users` ( 
                 confirm_code,
                 email,
                 oauth_provider,
                 oauth_uid, 
                 username,
                 fullname,
                 creation_date
                 )
                 VALUES ('$confirm_code','$email','facebook', '$uid', '$username','$fullname','$d')";
                 $res = mysql_query($query)or die(mysql_error());
              //echo 'User added succesfully';
  //=================== Sending Mail ==================///              
                 //send email to who?
//                $to = $email;
//        //
//        //        //email subject
//                $subject = 'Your confirmation link here';
//        //
//        //        //From
//                
//                           
//                 $headers  = 'MIME-Version: 1.0' . "\r\n";
//                 $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//                 $headers = 'From: Hello@Reportedly.co' . "\r\n" ;
//                 $headers .= 'Reply-To: admin@Reportedly.com' . "\r\n";
//        //
//        //        //Message content
//                $message = "Thanks for creating an account on Reportedly! To verify your account, please click the link below\r\n";
//                $message .= "http://reportedly.pnf-sites.info/confirm.php?passkey=$confirm_code";
//                $message .= "\r\nIf you believe you received this in error, feel free to ignore. You may contact us at hello@Reportedly.co \r\n";
//                $message .= "Thanks!";
//        //
//                if(mail($to, $subject, $message, $headers))
//                {
             $query = "(SELECT * FROM `twitter_users` WHERE oauth_uid = '$uid' and oauth_provider = 'facebook')";
             $query_res=mysql_query($query)or die(mysql_error());
            $result = mysql_fetch_array($query_res);
                //}
            
            return $result;
        }
        return $result;
    }

    

}

?>
