<?php 
require_once("config.php");
require_once "core/controller.Class.php";

try {
    $accessToken = $handler->getAccessToken();
}catch(\Facebook\Exceptions\FacebookResponseException $e){
    echo "Response Exception: " . $e->getMessage();
    exit();
}catch(\Facebook\Exceptions\FacebookSDKException $e){
    echo "SDK Exception: " . $e->getMessage();
    exit();
}

if(!$accessToken){
    header('Location: index.php');
    exit();
}
$oAuth2Client = $FBObject->getOAuth2Client();
if(!$accessToken->isLongLived())
$accessToken = $oAuth2Client->getLongLivedAccesToken($accessToken);

$response = $FBObject->get("/me?fields=id, first_name, last_name, email, picture.type(large)", $accessToken);
$userData = $response->getGraphNode()->asArray();
    $_SESSION['userData'] = $userData;
    $_SESSION['access_token'] = (string) $accessToken;
    $Controller = new Controller;
    $Controller -> insertNew($userData['email'], $userData['first_name'], $userData['last_name'], $userData['id'], $userData['picture']['url']);
    // $Controller -> insertData(
    //     array(
    //         'email' => $userData['email'],
    //         'avatar' => $userData['picture']['url'],
    //         'picture' => $userData['picture']['url'],
    //         'familyName' => $userData['last_name'],
    //         'givenName' => $userData['first_name'],
    //     )
    // );
    header('Location: index.php');
    exit();

?>