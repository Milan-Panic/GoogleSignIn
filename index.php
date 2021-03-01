<?php
include 'nav_menu.php';
$redirectTo = "http://".$_SERVER['SERVER_NAME']."/GoogleSignIn/callback.php";
$data = ["email"];
$fullURL = $handler -> getLoginUrl($redirectTo, $data);

if(isset($_POST['submit2'])){
    // var_dump($_POST);
}

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
$tokk = isset($_POST['token']) ? $_POST['token'] : '';
if (isset($_POST['submit'])) {
    $Controller = new Controller;
    if (is_not_Robot($tokk)) {
        $Controller -> registerUser($_REQUEST['email'], sha1($_REQUEST['password']));
    }
    else{
        header("Location: index.php?error=not_human");
    }
}


?>  
    <div class="container" >
        <?php if(isset($_COOKIE['id']) && isset($_COOKIE['sess'])){
            $Controller = new Controller;
            if($Controller -> checkUserStatus($_COOKIE['id'], $_COOKIE['sess'])){
                echo $Controller -> printData(intval($_COOKIE['id']));
                echo '<a href="logout.php">Log Out</a>';
            }
            
        }else{?>

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
        <a href="http://localhost/GoogleSignIn/table/table.html"><span class="table-link">Clik here to see table design</span></a>
        <h1>CKEditor</h1>
        <form action='' method='POST'>
            <div class="form-group">
                <label for="textarea">Text Area</label>
                <textarea class="form-control" name="example" id="SCEditor" cols="30" rows="10">
                    <?php 
                    // if(isset($_POST['example'])){
                    //     echo ForumCodeToHtml($_POST['example']);
                    //     echo $_POST['example'];
                    // }
                    ?>
                </textarea>
            </div>
            <button type="submit" name="submit2" class="btn btn-primary">Submit</button>
        </form>
        <script>
            CKEDITOR.replace( 'SCEditor',{
                width: '100%',
                height: 700,
            } )
            CKEDITOR.on('dialogDefinition', function(e){
                dialogName = e.data.name;
                dialogDefinition = e.data.definition;
                console.log(dialogDefinition);//OVAKO MOZEMO DA UHVATIMO IME KOMANDE
                if(dialogName == 'image'){
                    // dialogDefinition.removeContents('Link');
                    // dialogDefinition.removeContents('advanced');
                }
            })
        </script>
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
        <div class="output">
            <?php if(isset($_POST['example'])){
                echo ForumCodeToHtml($_POST['example']);
            } ?>
        </div>
    </div>

    
</body>
</html>