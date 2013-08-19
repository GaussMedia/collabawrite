<?php
session_start();
require 'twitter/twitteroauth.php';
define('YOUR_CONSUMER_KEY' , 'cNGSOfn2g1tWfrVMF6Ukw');
define('YOUR_CONSUMER_SECRET' , 'FJxonbkKmFfx3ZAg20oIJCz9EZNeOKmxkbRrcyxzRl8');
$twitteroauth = new TwitterOAuth(YOUR_CONSUMER_KEY, YOUR_CONSUMER_SECRET);
$request_token = $twitteroauth->getRequestToken('http://startups.pnf-sites.info/developer/twitter_back.php');
$_SESSION['oauth_token'] = $request_token['oauth_token'];
$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
if ($twitteroauth->http_code == 200) {
	$url = $twitteroauth->getAuthorizeURL($request_token['oauth_token']);
	header('Location: ' . $url);
}

?>