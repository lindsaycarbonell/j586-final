<html>
<head>
  <meta charset="UTF-8">
  <!--stylesheets-->
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/styles.css">
  <!--jquery-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="js/tweetLinkIt.js"></script>
  <script>

      function pageComplete(){
          $('.twit-tweet').tweetLinkify();
      }
  </script>

</head>

<body>
<div class="container">

<!--TOP-->
<div id="top-bar" class="row">
  <div class="col-lg-10">
    <h1 id="site-title">Welcome to CampWrite 2015!</h1>
  </div>
  <div class="col-lg-2">
    <h2 id="date">06.12.15</h2>
  </div>
</div><!--end row-->

<!--NAVBAR-->
  <!-- <div class="navbar navbar-default navbar-fixed-top">
    <div class="row">
      <div class="col-lg-9 col-lg-offset-1 col-sm-9 col-sm-offset-1">
        <h1>CampWrite UNC 2015 Session</h1>
      </div>
      <div class="col-lg-2 col-sm-2">
        <h3 id="hash-title">#campw2015</h3>
      </div>
    </div>
  </div> end nav-->

<!--TWITTER-->
<div class="row">
    <div id="twitter-box" class="col-lg-4 col-md-12 col-sm-12">
      <h3><a id="twitter-title" href="https://twitter.com/search?q=campw2015">[#campw2015]</a></h3>
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
      $getfield = '?q=%23writing&count=5&lang=en'; /*how to do a #: ?q=%23hashtag*/
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

        echo "</br><img class='twit-prof' src='" . $userArray['profile_image_url'] . "' />";

        echo  "<p class='screen-name'>@" . $userArray['screen_name'] . "</p>";

        echo "<div class='twit-tweet-div'><p class='twit-tweet'>" . $items['text'] . "</p></div>";

        if($tweetMedia['media_url'] != null){echo "<a target='_blank' href='http://www.twitter.com/" . $tweetMedia['media_url'] . "'><img class='twit-img' src='" . $tweetMedia['media_url'] . "' ></a></br>";
      }
        echo "<hr class='hr'>";
      }

      echo "<script>pageComplete()</script>"


      ?>

      <!-- <h3><a href="https://twitter.com/search?q=campw2015">#campw2015</a></h3>
      <div class="embed-container"><iframe src="http://lmcarbonell.com/static/j586-final/twitterAPI.php" style="width:110%;height:600px;" scrolling="yes"></iframe></div> -->
    </div>
<!--JOURNAL-->
    <div id="notebook-box" class="col-lg-6 col-md-6 col-sm-8">
      <div>
        <h3 id="q-q-title" class="on-top">Today's Quick Quotes</h3>
        <a id="q-q-1" class="on-top">&ldquo;Day one has been really exciting! Can't wait for tomorrow." -Ally</a>
        <a id="q-q-2" class="on-top">&ldquo;Day one has been really exciting! Can't wait for tomorrow." -Ally</a>
        <a id="q-q-3" class="on-top">&ldquo;Day one has been really exciting! Can't wait for tomorrow." -Ally</a>
        <a id="q-q-4" class="on-top">&ldquo;Day one has been really exciting! Can't wait for tomorrow." -Ally</a>
      <img id="notebook" src="images/notebook-tester.png" /></div>
    </div>
    <!--TEXT INPUT-->
      <div id="input-box" class="col-lg-2 col-md-12 col-sm-12">
        <p class="input-instr">take notes:</p>
        <textarea id="inputTextToSave"></textarea>
        <div class="row">
          <div class="col-lg-12 col-sm-12">
            <p id="take-notes" class="input-instr">Filename to Save As:</p>
            <input id="inputFileNameToSaveAs"></input>
            <button onclick="saveTextAsFile()">Save</button>
          </div>
        </div>
      </div>

</div><!--end row-->

<!--INSTAGRAM-->
<hr>
  <div class="row">
    <h3>[Instagram]</h3>
    <div id="insta-box" class="col-lg-12 col-md-12 col-sm-12">
      <div class="row" id="results"></div>


      <!-- <h3>Instagram</h3>
      <div style="height:325px;" class="embed-container"><iframe src="http://lmcarbonell.com/static/j586-final/instagramAPI.php" style="height:325px;" scrolling="yes"></iframe></div> -->
    </div>
  </div><!--end row-->
<hr>
<!--LESSON-->
  <div class="row">
      <div id="lesson1" class="lesson col-lg-12">
        <h3>Today's Lesson</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ut ipsum vel ante cursus ornare nec finibus ante. Nullam aliquam tellus et magna dictum placerat. Mauris mollis rhoncus lectus, non aliquam nibh tincidunt eu. Praesent vitae velit non justo rhoncus lacinia. Mauris ultricies lorem ut magna aliquam, eu sagittis ligula ultricies. Proin placerat libero ac condimentum dapibus. Ut vel dolor libero. Vestibulum a magna id leo congue aliquam. Sed dignissim massa eu commodo tempus. Pellentesque convallis ligula id egestas finibus. Nullam rutrum nisl nibh, et feugiat elit ultrices ut. Ut ornare, libero ac lobortis dapibus, nisl nunc fringilla risus, eu vulputate enim dolor in dui. Integer hendrerit id augue nec pellentesque. Proin ullamcorper, nibh at finibus accumsan, nisl neque rutrum odio, sit amet imperdiet ex est id mauris. Donec vitae elit ac justo placerat molestie. Fusce congue neque metus.</p>

        <img src="images/shapes_of_stories.png" class="img-responsive"/>

        <p>Nunc ultricies elit id venenatis posuere. Sed rutrum, ipsum ut sagittis finibus, tortor neque fermentum diam, eget pellentesque velit urna vitae lectus. Vivamus aliquam quis libero non placerat. Integer at eros sed sapien laoreet bibendum a vel eros. Suspendisse pharetra consequat justo quis aliquet. Pellentesque suscipit tincidunt neque, vitae maximus erat lacinia quis. Aliquam sit amet pulvinar tortor, eu efficitur est. Maecenas eget dui dui. Etiam vulputate at erat at facilisis. Pellentesque eget condimentum metus. Etiam in urna consectetur, tempor quam at, scelerisque nunc. Proin mi nisl, elementum lobortis ante eget, euismod cursus nibh.</p>

        <p>Sed tempus gravida nibh, commodo fringilla risus placerat quis. Suspendisse sed elementum eros, id consequat libero. Pellentesque et sapien viverra, pharetra nisl sed, hendrerit lorem. Etiam interdum congue urna, id molestie purus pulvinar eget. Morbi quis ultrices mi. Sed porta cursus eros, varius aliquam velit ornare vitae. Vivamus sit amet justo ac augue condimentum maximus id ut ligula.</p>
      </div>
  </div><!--end row-->

<!--DIRECTIONS-->
  <div class="row">
    <div class="col-lg-12">

      <h3>Directions</h3>
        <div class="embed-container"><iframe src="http://lmcarbonell.com/static/j586-final/maptest.html" style="width:100%;height:500px;overflow:hidden;"></iframe></div>

    </div><!--end col-->
  </div><!--end row-->


</div>


<script src="js/instagramAPI.js"></script>


<!--BOTTOM-->
<footer id="bottom-bar" class="row">
  <div class="col-lg-10">
    <a class="twitter-title" href="http://campwriteunc.com">CampWrite UNC</a>
  </div>
</footer><!--end row-->
</body>

</html>
