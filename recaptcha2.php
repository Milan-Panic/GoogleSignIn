<?php
define('SITE_KEY', '6Le6wtgZAAAAAJNh5Nl8T87zHN81BhuF-6d30XiV');
define('SECRET_KEY', '6Le6wtgZAAAAAFtxhSDjYoSVVQHMNGTISoS5A7fb');

if($_POST){
    function getCaptcha($SecretKey){
        $Response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".SECRET_KEY."&response={$SecretKey}");
        $Return = json_decode($Response);
        return $Return;
    }
    $Return = getCaptcha($_POST['g-recaptcha-response']);
    // var_dump($Return);
    if($Return->success == true && $Return->score > 0.5){
        header("Location: http://localhost/GoogleSignIn/recaptcha2.php?succes");
        echo "Succes!";
    }else{
        echo "You are a Robot!!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ReCaptcha V3</title>
    <script src='https://www.google.com/recaptcha/api.js?render=<?php echo SITE_KEY; ?>'></script>
</head>
<body>
    <form action="/" method="POST">
        <input type="text" name="name" /><br />
        <input type="text" id="g-recaptcha-response" name="g-recaptcha-response" /><br >
        <input type="submit" value="Submit" />
    </form>
    <script>
        function start_recaptcha(){
            grecaptcha.execute('<?php echo SITE_KEY; ?>', {action: 'homepage'})
            .then(function(token) {
                //console.log(token);
                document.getElementById('g-recaptcha-response').value=token;
            });
            }
            grecaptcha.ready(function() {
                start_recaptcha();
            });
            setInterval(function(){ 
                start_recaptcha();
            }, 100000);
    </script>
</body>
</html>