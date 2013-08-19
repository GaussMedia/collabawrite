<?php

require 'facebook/facebook.php';
require 'config/fbconfig.php';
require 'config/functions-facebook.php';

$facebook = new Facebook(array(
            'appId' => APP_ID,
            'secret' => APP_SECRET,
            ));

$user = $facebook->getUser();
        

if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
   if (!empty($user_profile )) {
        # User info ok? Let's print it (Here we will be adding the login and registering routines)
//          echo '<pre>';
//          print_r($user_profile);
          
        $username = $user_profile['username'];
        $uid = $user_profile['id'];
        $email = $user_profile['email'];
        $fullname = $user_profile['first_name']." ".$user_profile['last_name'];
        $user = new UserFb();
        $userdata = $user->checkUser($uid,$username,$fullname,$email);
        //echo '<pre>';
       // print_r($userdata);
       // die;
        if(!empty($userdata)){
            session_start();
            $_SESSION['id'] = $userdata['id'];
            $_SESSION['oauth_id'] = $uid;

            $_SESSION['username'] = $userdata['username'];
	    $_SESSION['email'] = $email;
            $_SESSION['oauth_provider'] = $userdata['oauth_provider'];
            //header("Location: home.php");
            $uid = $_SESSION['id'];
            $query = mysql_query("SELECT * FROM `twitter_users` WHERE id = '$uid' and oauth_provider = 'facebook'")or die(mysql_error());
            $fetch = mysql_fetch_array($query);
            if($fetch['location'] == '')
            {
             header("Location: http://reportedly.pnf-sites.info/login-facebook-location.php");
            }
            else{
                header("Location: http://reportedly.pnf-sites.info/index.php");
            }
        }
    } else {
        # For testing purposes, if there was an error, let's kill the script
        die("There was an error.");
    }
} else {
    # There's no active session, let's generate one
	$login_url = $facebook->getLoginUrl(array( 'scope' => 'email'));
    header("Location: " . $login_url);
}
?>
