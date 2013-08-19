<?php 

    $trends_url = "http://api.twitter.com/1/statuses/followers/evwilliams.json";

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $trends_url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $curlout = curl_exec($ch);

    curl_close($ch);

    $response = json_decode($curlout, true);
    echo count($response);
    foreach($response as $friends){

      $thumb = $friends['profile_image_url'];

      $url = $friends['screen_name'];   

       $name = $friends['name'];

     

       print "<a title='" . $name . "' href='http://www.twitter.com/" . $url . "'>" . "<img src='" . $thumb . "' /></a>";

    }

