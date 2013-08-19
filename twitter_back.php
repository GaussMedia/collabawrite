<?php
session_start();
include("include/connection.php");
require 'twitter/twitteroauth.php';
define('YOUR_CONSUMER_KEY' , 'cNGSOfn2g1tWfrVMF6Ukw');
define('YOUR_CONSUMER_SECRET' , 'FJxonbkKmFfx3ZAg20oIJCz9EZNeOKmxkbRrcyxzRl8');
if (!empty($_GET['oauth_verifier']) && !empty($_SESSION['oauth_token']) && !empty($_SESSION['oauth_token_secret'])) {
	$twitteroauth = new TwitterOAuth(YOUR_CONSUMER_KEY, YOUR_CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
	$access_token = $twitteroauth->getAccessToken($_GET['oauth_verifier']);
	$_SESSION['access_token'] = $access_token;
	$user_info = $twitteroauth->get('account/verify_credentials');
	$twitter_otoken=$_SESSION['oauth_token'];
	$twitter_otoken_secret=$_SESSION['oauth_token_secret'];
	$uid = $user_info->id;
	$img = $user_info->profile_image_url_https;
	$username = $user_info->screen_name;
	$name = explode(' ' , $user_info->name);
	$firstname = $name[0];
	$lastname = $name[1];
	$userdata = checkUser($uid, 'twitter', $username,$twitter_otoken , $img , $firstname , $lastname);
	if($userdata){
		header("location:index-b.php");
	}
}

function checkUser($uid, $oauth_provider, $username='',$token ,$image='',$firstname='' , $lastname='') {
	 $qr = "select * from users where oauth_uid = '$uid'";
	 $info = mysql_query($qr);
	 if(!empty($info->id)){
		$time = time();
	 } else {
		$info1 = mysql_query("insert into users set first_name='$firstname', last_name='$lastname', email='$email', user_image='$image', oauth_provider='$oauth_provider', oauth_uid='$uid', access_token='$access_token', username='$username'") or die(mysql_error());
		if($info1){
			return true;
		}
	}
}
?>