<?php
// Require the TwitterOAuth library. http://github.com/abraham/twitteroauth
require_once('twitteroauth/twitteroauth.php');
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_SECRET);
 
// Empty array that will be used to store followers.
$profiles = array();
// Get the ids of all followers.
$ids = $connection->get('followers/ids');
// Chunk the ids in to arrays of 100.
$ids_arrays = array_chunk($ids, 100);
 
// Loop through each array of 100 ids.
foreach($ids_arrays as $implode) {
// Perform a lookup for each chunk of 100 ids.
$results = $connection->get('users/lookup', array('user_id' => implode(',', $implode)));
// Loop through each profile result.
foreach($results as $profile) {
// Use screen_name as key for $profiles array.
echo $profiles[$profile->screen_name] = $profile;
}
}
 
// Array of user objects.
var_dump($profiles);
