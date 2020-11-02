<?php
session_start();
require_once('Facebook/autoload.php');
require_once "google-api/vendor/autoload.php";
$gClient = new Google_Client();
$gClient->setClientId("359891019260-bu40u2enc10pvii2f6iipca8rlcnn5bk.apps.googleusercontent.com");
$gClient->setClientSecret("j8oW8IlBXYQ2ZZy9_sYrlwFz");
$gClient->setApplicationName("Casinoreviewer");
$gClient->setRedirectUri("http://localhost/GoogleSignIn/controller.php");
$gClient->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");

// login URL
$login_url = $gClient->createAuthUrl();

$FBObject = new \Facebook\Facebook([
    'app_id' => '694849811119858',
    'app_secret' => 'e353e1f6a054de5f73fd7fdc32d2ae41',
    'default_graph_version' => 'v2.10'
]);

$handler = $FBObject -> getRedirectLoginHelper();
?>