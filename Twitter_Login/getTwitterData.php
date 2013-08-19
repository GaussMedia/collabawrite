    <?php

require("twitter/twitteroauth.php");
require 'config/twconfig.php';
require 'config/functions.php';
session_start();

if (!empty($_GET['oauth_verifier']) && !empty($_SESSION['oauth_token']) && !empty($_SESSION['oauth_token_secret'])) {
    // We've got everything we need
    $twitteroauth = new TwitterOAuth(YOUR_CONSUMER_KEY, YOUR_CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
// Let's request the access token
    $access_token = $twitteroauth->getAccessToken($_GET['oauth_verifier']);
// Save it in a session var
    $_SESSION['access_token'] = $access_token;
   
    //print_r($_SESSION['access_token']);
    //die;
// Let's get the user's info
    $user_info = $twitteroauth->get('account/verify_credentials');
// Print user's info
//     echo '<pre>';
//    print_r($user_info);
//    echo '</pre><br/>';
//    die;
    if (isset($user_info->error)) {
        // Something's wrong, go back to square 1 
        echo 'Something Wrong ';
        header('Location: http://reportedly.pnf-sites.info/signup.php');
    } else {
	    //$user_id   = $_SESSION['access_token']['user_id'];
            $username  = $_SESSION['access_token']['screen_name'];
            $oauth_token = $_SESSION['access_token']['oauth_token'];
            $oauth_token_secret = $_SESSION['access_token']['oauth_token_secret'];
             $email='';
             $uid = $user_info->id;
             $fullname = $user_info->name;
             $image_url = $user_info->profile_image_url;
             $description = $user_info->description;
            
             $user = new User();
        $userdata = $user->checkUser($uid, $username,$fullname,$image_url,$oauth_token,$oauth_token_secret,$description);
//        echo '<pre>';
//        print_r($userdata);
//        die;
        if(!empty($userdata)){
            session_start();
            $_SESSION['id'] = $userdata['id'];
            $_SESSION['oauth_id'] = $uid;
            $_SESSION['username'] = $userdata['username'];
            $_SESSION['oauth_provider'] = $userdata['oauth_provider'];
           
            if(empty($userdata['email']))
            {
             header("Location: http://reportedly.pnf-sites.info/twitter_email.php");
            }
 else {
     header("Location: http://reportedly.pnf-sites.info/index.php");
 }
//            if($userdata['status'] == '0')
//            {
//              header("Location: http://reportedly.pnf-sites.info/developer/");
//            }
//            else {
//                header("Location: http://reportedly.pnf-sites.info/developer/profile.php");
//            }
            
        }
    }
} else {
    // Something's missing, go back to square 1
    header('Location: http://reportedly.pnf-sites.info/signin.php');
}

$connection = new TwitterOAuth(YOUR_CONSUMER_KEY, YOUR_CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);

// Then we use it to send a twitter message

$connection->post('statuses/update', array('status' => 'Hi All This Testing by Karamjeet Form My Web'));



?>
