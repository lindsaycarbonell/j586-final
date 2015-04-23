<html>
<head>
  <meta charset="UTF-8">
  <base target="_blank">
  <link rel="stylesheet" href="css/styles.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="js/tweetLinkIt.js"></script>

  <script>

      function pageComplete(){
          $('.twit-tweet').tweetLinkify();
      }
  </script>
</head>
<body>
<?php
$items;

ini_set('display_errors', 1); //change to zero to not display errors
require_once('TwitterAPIExchange.php');

/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => "552536795-QFZeUfGdXOf0bJ8rxxFNe42sNRDHpwH1XndGu8zL",
   'oauth_access_token_secret' => "7Vioa0WfDub9GnuKSwtlAPpi0uZW32yAkafHrKBRytweu",
   'consumer_key' => "8WVMJuaj2dliM11CQZcFwlgVV",
   'consumer_secret' => "mVl9IOF6sdkIdeNjc8gSrM9mv7QeSHhnbVxXGZzOLsU04NI2nN"
);

/** URL for REST request, see: https://dev.twitter.com/docs/api/1.1/ **/
$url = 'https://api.twitter.com/1.1/blocks/tweets.json';
$requestMethod = 'GET';

/** POST fields required by the URL above. See relevant docs as above **/
$postfields = array(
    'screen_name' => 'usernameToBlock',
    'skip_status' => '1'
);

/** Perform a POST request and echo the response **/
// $twitter = new TwitterAPIExchange($settings);
// echo $twitter->buildOauth($url, $requestMethod)
//              ->setPostfields($postfields)
//              ->performRequest();

/** Perform a GET request and echo the response **/
/** Note: Set the GET field BEFORE calling buildOauth(); **/
$url = 'https://api.twitter.com/1.1/search/tweets.json'; /*search tweets: 1.1./search/tweets.json*/
$getfield = '?q=%23writing'; /*how to do a #: ?q=%23hashtag*/
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);

// echo $twitter->setGetfield($getfield)
//               ->buildOauth($url, $requestMethod)
//               ->performRequest();

$tweetData = json_decode($twitter->setGetfield($getfield)
              ->buildOauth($url, $requestMethod)
              ->performRequest(),$assoc = TRUE);

// echo $tweetData;

foreach($tweetData['statuses'] as $items){

  $userArray = $items['user'];
  $entitiesArray = $items['entities'];
  $mediaArray = $entitiesArray['media'];
  $tweetMedia = $mediaArray[0];

  echo "<img class='twit-prof' src='" . $userArray['profile_image_url'] . "' />";

  echo  "<p class='screen-name'>@" . $userArray['screen_name'] . "</p>";

  echo "<div class='twit-tweet-div'><p class='twit-tweet'>" . $items['text'] . "</p></div>";

  if($tweetMedia['media_url'] != null){echo "<a target='_blank' href='http://www.twitter.com/" . $tweetMedia['media_url'] . "'><img class='twit-img' src='" . $tweetMedia['media_url'] . "' ></a></br>";
}
  echo "<hr class='hr'>";
}

echo "<script>pageComplete()</script>"


?>





</body>
</html>
