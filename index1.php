<?php
// require_once('config.php');
require_once('core/controller.Class.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-signin-scope" content="profile email">
    <meta name="google-signin-client_id" content="359891019260-bu40u2enc10pvii2f6iipca8rlcnn5bk.apps.googleusercontent.com">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <title>Login to my app</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <div class="container" style="margin-top: 100px;">
        <?php if(isset($_COOKIE['id'])){
            $Controller = new Controller;
                echo $Controller -> printData(intval($_COOKIE['id']));
                echo '<a href="logout.php">Log Out</a>';
            
        }else{ ?>
        <img src="img/logo.png" alt="logo" style="max-width: 150px; margin: 0 auto; display: table;" />
        <form action='' method="POST">
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
            <div class="g-signin2" data-onsuccess="onSignIn" data-theme="dark"></div>
            <script>
              function onSignIn(googleUser) {
                // Useful data for your client-side scripts:
                var profile = googleUser.getBasicProfile();
                // console.log("ID: " + profile.getId()); // Don't send this directly to your server!
                console.log('Full Name: ' + profile.getName());
                console.log('Given Name: ' + profile.getGivenName());
                console.log('Family Name: ' + profile.getFamilyName());
                console.log("Image URL: " + profile.getImageUrl());
                console.log("Email: " + profile.getEmail());

                // // The ID token you need to pass to your backend:
                // var id_token = googleUser.getAuthResponse().id_token;
                // console.log("ID Token: " + id_token);
            $.ajax({
                url: "signup.php",
                type: "POST",
                data: { "id" : profile.getId(), "avatar" : profile.getImageUrl(), "fname" : profile.getGivenName(), "lname" : profile.getFamilyName(), "email" : profile.getEmail()},
                success: function(response) //response je sta smo echovali na php strani
                {
                    //alert(response);
                    //location.reload();
                    signOut()
                }
            });
          }
            </script>
            <a href="#" onclick="signOut();">Sign out</a>
            <script>
              function signOut() {
                var auth2 = gapi.auth2.getAuthInstance();
                auth2.signOut().then(function () {
                  console.log('User signed out.');
                });
              }
            </script>
        </form>
        <?php } ?>
    </div>
</body>
</html>