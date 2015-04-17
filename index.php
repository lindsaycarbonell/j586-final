<html>
<head>
<meta charset="UTF-8">
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
$url = 'https://api.twitter.com/1.1/search/tweets.json';
$getfield = '?q=%23election2016';
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);

//echo $twitter->setGetfield($getfield)
              //->buildOauth($url, $requestMethod)
              //->performRequest();

$tweetData = json_decode($twitter->setGetfield($getfield)
              ->buildOauth($url, $requestMethod)
              ->performRequest(),$assoc = TRUE);

//echo $tweetData;

foreach($tweetData['statuses'] as $items){
  echo "<div class='twitter-tweet'>Tweet: " . $items['text'] . "'</div>'";
  echo "Time: " . $items['created_at'] . "</br>";
}

?>

</body>


</html>
