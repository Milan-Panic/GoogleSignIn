<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="canonical" href="https://www.w3schools.com/tags/ref_urlencode.ASP">
    <title>Test</title>
</head>
<body>
<?php
echo $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$url = "https://www.w3schools.com/tags/ref_urlencode.ASP";
$encoded_url = rawurlencode($url);
?>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v9.0&appId=694849811119858&autoLogAppEvents=1" nonce="tEnqfhQQ"></script>
<div class="fb-share-button" data-href="<?php echo $url; ?>" data-layout="button" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $encoded_url; ?>&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Подели</a></div>
<br>

<!-- <a class="twitter-share-button"
  href="https://twitter.com/intent/tweet?text=Hello%20world"
  data-size="large">
Tweet</a> -->

<!-- <a href="https://twitter.com/intent/tweet?hashtags=wizardofvegas,milanpanic&amp;original_referer=https%3A%2F%2Fdeveloper.twitter.com%2F&amp;ref_src=twsrc%5Etfw&amp;related=twitterapi%2Ctwitter&amp;text=Ovde%20ide%20neki%20naslov&amp;tw_p=tweetbutton&amp;url=<?php //echo rawurlencode('https://www.w3schools.com/tags/ref_urlencode.ASP'); ?>&amp;via=wizardofvegas" data-size="large" target="_blank" class="twitter-share-button"></a> -->
<a 
    href="https://twitter.com/share?ref_src=twsrc%5Etfw" 
    class="twitter-share-button" 
    data-size="large" 
    data-text="hello" 
    data-url="https://wizardofvegas.com/articles/gambling-game-review-1/" 
    data-via="latestcasinobonuses" 
    data-hashtags="lcb" 
    data-show-count="false">
    Tweet
</a>
<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
<!-- <script>window.twttr = (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0],
    t = window.twttr || {};
  if (d.getElementById(id)) return t;
  js = d.createElement(s);
  js.id = id;
  js.src = "https://platform.twitter.com/widgets.js";
  fjs.parentNode.insertBefore(js, fjs);

  t._e = [];
  t.ready = function(f) {
    t._e.push(f);
  };

  return t;
}(document, "script", "twitter-wjs"));
</script> -->
</body>
</html>