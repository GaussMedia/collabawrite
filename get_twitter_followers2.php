

    <?php

     

    require_once('TwitterAPIExchange.php');

     

    $consumerKey = 'IcMRXf2qBmxLAItJWf6VA';

    $consumerKeySecret = 'Hgt19HJQNwpF6xUYFJKUbmKd6H4JyPS8Zyf1YtAU15k';

    $accessToken = '1366310028-StCLS9qs9HVClGs3DBvArfniptEeOhejq7aNbO0';

    $accessTokenSecret = 'aCBNyC8A1H58hqfKZY5uZ8BmJRG4uXfhxUwzZnCJW8';

     

    $settings = array(

      'oauth_access_token' => $accessToken,

      'oauth_access_token_secret' => $accessTokenSecret,

      'consumer_key' => $consumerKey,

      'consumer_secret' => $consumerKeySecret

    );

     

    $i = 0;

    $cursor = -1;

     

    do {

      $url = 'https://api.twitter.com/1.1/followers/list.json';

  $getfield = '?cursor='.$cursor.'&screen_name=peugeot&skip_status=true&include_user_entities=false';

      $requestMethod = 'GET';

      $twitter = new TwitterAPIExchange($settings);

      $response = $twitter->setGetfield($getfield)

                          ->buildOauth($url, $requestMethod)

                          ->performRequest();

     

      $response = json_decode($response, true);

      $errors = $response["errors"];

     

      if (!empty($errors)) {

        foreach($errors as $error){

          $code = $error['code'];

          $msg = $error['message'];

          echo "<br><br>Error " . $code . ": " . $msg;

        }

        $cursor = 0;

      }

      else {

        $users = $response['users'];

        foreach($users as $user){

          $thumb = $user['profile_image_url'];

          $url = $user['screen_name'];   

          $name = $user['name'];

          echo "<a title='" . $name . "' href='http://www.twitter.com/" . $url . "'>" . "<img src='" . $thumb . "' /></a>";

          $i++;

        }

        $cursor = $response["next_cursor"];

      }

    }

    while ( $cursor != 0 );

     

    if (!empty($users)) {

      echo '<br><br>Total: ' . $i;

    }

     

    ?>

