<?php
require_once('config.php');
require_once('core/controller.Class.php');
require_once('recaptcha_function.php');
$redirectTo = "http://".$_SERVER['SERVER_NAME']."/GoogleSignIn/callback.php";
$data = ["email"];
$fullURL = $handler -> getLoginUrl($redirectTo, $data);

if (isset($_GET['error']) && $_GET['error'] == 'not_human') {
    echo '<div class="alert alert-warning">
			<strong>Error!</strong> You are not a human.
		  </div>';
}
if (isset($_GET['success']) && $_GET['success'] == 'inserted') {
    echo '<div class="alert alert-success">
			<strong>Succes!</strong> Successfuly inserted.
		  </div>';
}
if (isset($_POST['submit'])) {
    $Controller = new Controller;
    if (is_not_Robot()) {
        $Controller -> registerUser($_REQUEST['email'], sha1($_REQUEST['password']));
    }
    else{
        header("Location: index.php?error=not_human");
    }
}

define('SITE_KEY', '6Le6wtgZAAAAAJNh5Nl8T87zHN81BhuF-6d30XiV');
define('SECRET_KEY', '6Le6wtgZAAAAAFtxhSDjYoSVVQHMNGTISoS5A7fb');


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login to my app</title>
    <script src='https://www.google.com/recaptcha/api.js?render=<?php echo SITE_KEY; ?>'></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <div class="container" style="margin-top: 100px;">
        <?php if(isset($_COOKIE['id']) && isset($_COOKIE['sess'])){
            $Controller = new Controller;
            if($Controller -> checkUserStatus($_COOKIE['id'], $_COOKIE['sess'])){
                echo $Controller -> printData(intval($_COOKIE['id']));
                echo '<a href="logout.php">Log Out</a>';
            }
            
        }else{ ?>
        <img src="img/logo.png" alt="logo" style="max-width: 150px; margin: 0 auto; display: table;" />
        <form action='' method="POST">
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <div class="form-group">
            <input type="text" id="token" name="token">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Register</button>
            <button onclick="window.location = '<?php echo $login_url; ?>'" type="button" class="btn btn-danger">Login with Google</button>
            <input type="button" onclick="window.location = '<?php echo $fullURL ?>'" value="Login with Facebook" class="btn btn-primary">
        </form>
        <!-- RECAPTCHA -->
        <script>
        function start_recaptcha(){
            grecaptcha.execute('<?php echo SITE_KEY; ?>', {action: 'homepage'})
            .then(function(token) {
                // console.log(token);
                document.getElementById("token").value = token;
            });
            }
            grecaptcha.ready(function() {
                start_recaptcha();
            });
            setInterval(function(){ 
                start_recaptcha();
            }, 100000);
        </script>
        <!-- RECAPTCHA -->
        <?php } 
        if(isset($_SESSION['access_token'])){
        ?>

        <div class="row justify-content-center">
            <div class="col-md-3">
                <img src="<?php echo $_SESSION['userData']['picture']['url'] ?>">
            </div>
            <br><br>
            <div class="col-md-9">
                <table class="table table-hover table-bordered">
                    <tbody>
                        <tr>
                            <td>ID</td>
                            <td><?php echo $_SESSION['userData']['id'] ?></td>
                        </tr>
                        <tr>
                            <td>First Name</td>
                            <td><?php echo $_SESSION['userData']['first_name'] ?></td>
                        </tr>
                        <tr>
                            <td>Last Name</td>
                            <td><?php echo $_SESSION['userData']['last_name'] ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><?php echo $_SESSION['userData']['email'] ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="logout">
        <a href="logout.php">Logout</a>
        </div>
        <?php }?>
    </div>

    
</body>
</html>