 <?php
$trends_url = "http://api.twitter.com/1/statuses/followers/facebooklive.json";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $trends_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$curlout = curl_exec($ch);
curl_close($ch);
$response = json_decode($curlout, true);
echo '<pre>';
echo count($response);
die;
foreach($response as $friends){
$thumb = $friends['profile_image_url'];
$url = $friends['screen_name'];
$name = $friends['name'];

?>
<a title="<?php echo $name;?>" href="http://www.twitter.com/<?php echo $url;?>">
    <img src="https://api.twitter.com/1/users/profile_image?screen_name=<?php echo $name;?>&size=normal" border="0" alt="" width="40" />
</a>


<?php
}
?>