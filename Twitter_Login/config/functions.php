<?php

require 'dbconfig.php';

class User {

    function checkUser($uid, $username,$fullname,$profile_image_url,$twitter_otoken,$twitter_otoken_secret) 
	{
           // $ip = $_SERVER['SERVER_ADDR'];
           // $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));
           $query = "SELECT * FROM `twitter_users` WHERE oauth_uid = '$uid' AND    oauth_provider = 'twitter'";
        $res = mysql_query($query)or die(mysql_error());
        $result = mysql_fetch_array($res);
//        echo '<pre>';
//        print_r($result);
//        die;
        if (!empty($result)) {
            # User is already present
            echo 'User already exists';
            
        } else {
            #user not present. Insert a new Record
            
            //echo '<pre>';
            //print_r($ip_data);
            //die;
           // $addrress = $ip_data->geoplugin_city." ".$ip_data->geoplugin_region." ".$ip_data->geoplugin_countryName;
            //$confirm_code=substr(md5(uniqid(rand($pwd), true)), 16, 16);
            $d=time();
            $query = "INSERT INTO `twitter_users` ( 
                 oauth_provider,
                 oauth_uid, 
                 username,
                 fullname,
                 image,
                 description,
                 twitter_oauth_token,
                 twitter_oauth_token_secret,
                 creation_date
                 )
                 VALUES ('twitter', '$uid', '$username','$fullname','$profile_image_url','$description','$twitter_otoken','$twitter_otoken_secret','$d')";
            
                 $res = mysql_query($query)or die(mysql_error());
              //echo 'User added succesfully';
             $query = mysql_query("SELECT * FROM `twitter_users` WHERE oauth_uid = '$uid' and oauth_provider = 'twitter'");
            $result = mysql_fetch_array($query);
            return $result;
        }
        return $result;
    }

    

}

?>
