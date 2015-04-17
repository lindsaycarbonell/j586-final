<?php
ini_set('display_errors', 1); //change to zero to not display errors
require_once('TwitterAPIExchange.php');

/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => "16192753-C3Ah2Dg9JJLaaOZHyzFxPqW4jYF9iVTdq5alkSfBa",
   'oauth_access_token_secret' => "zAM5whJiLbi9d97EZkC5Ty5akHifwsYudXEkVi54",
   'consumer_key' => "7DupEseAPvT0aGaA9zwuKA",
   'consumer_secret' => "9Va802Pnpfd5nkz23ZIsqkQJjz2ZqLUxuAxzXQSI"
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
$getfield = '?q=%23baseball';
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);
echo $twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest();
