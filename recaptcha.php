<?php
	require_once('recaptcha_function.php');
	// if(isset($_POST['post'])) {
	// 	// print_r($_POST);
	// 	$url = "https://www.google.com/recaptcha/api/siteverify";
	// 	$data = [
	// 		'secret' => "6Le6wtgZAAAAAFtxhSDjYoSVVQHMNGTISoS5A7fb",
	// 		'response' => $_POST['token'],
	// 		'remoteip' => $_SERVER['REMOTE_ADDR']
	// 	];

	// 	$options = array(
	// 	    'http' => array(
	// 	      'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
	// 	      'method'  => 'POST',
	// 	      'content' => http_build_query($data)
	// 	    )
	// 	  );

	// 	$context  = stream_context_create($options);
  	// 	$response = file_get_contents($url, false, $context);

	// 	$res = json_decode($response, true);
	// 	if($res['success'] == true && $res['score'] > 0.5 ) {

	// 		// Perform you logic here for ex:- save you data to database
  	// 		echo '<div class="alert alert-success">
	// 		  		<strong>Success!</strong> Your inquiry successfully submitted.
	// 	 		  </div>';
	// 	} else {
	// 		echo '<div class="alert alert-warning">
	// 				  <strong>Error!</strong> You are not a human.
	// 			  </div>';
	// 	}
	// }
 ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Learn Web Coding > Google reCAPTHA V3 integration in PHP</title>
    <link rel="stylesheet" type="text/css" href="../library/css/bootstrap.min.css"/>
    <style type="text/css">
    	.card {
    		width: 70%;
    		margin: 0 auto;
    	}
    </style>
    <script src="https://www.google.com/recaptcha/api.js?render=6Le6wtgZAAAAAJNh5Nl8T87zHN81BhuF-6d30XiV"></script>
  
  </head>
  <body>
	<div class="container">
	    <center><h1>Google reCAPTHA V3 integration in PHP</h1><img src="recaptcha.png"></center>
	    <hr>
	    <div class="card">
		  	<h3 class="card-header info-color white-text text-center py-4">
		    	<strong>What's in you mind, let us know</strong>
		  	</h3>
		  	<div class="card-body px-lg-5 pt-0">
		    	<form id="enq-frm" role="form" method="post" action="#" class="form-horizontal">
				<div class="form-group">
	              	<div class="input-group">
	                    <div class="input-group-addon addon-diff-color">
	                        <span class="glyphicon glyphicon-user"></span>
	                    </div>
	                    <input type="text" class="form-control" id="fname" name="fname" placeholder="Full Name">
	              	</div>
	            </div>
	            <div class="form-group">
	            	<div class="input-group">
	                    <div class="input-group-addon addon-diff-color">
	                        <span class="glyphicon glyphicon-envelope"></span>
	                    </div>
	                	<input type="email" class="form-control" id="uemail" name="uemail" placeholder="Email Address">
	            	</div>
	            </div>
	            <div class="form-group">
	            	<div class="input-group">
	                    <div class="input-group-addon addon-diff-color">
	                        <span class="glyphicon glyphicon-envelope"></span>
	                    </div>
	                	<textarea class="form-control" id="msg" name="msg" placeholder="Enter your message" rows="5"></textarea>
	            	</div>
	            </div>
	            <div class="form-group">
	                <input type="submit" value="Post" class="btn btn-success btn-block" name="post">
	            </div> 
	            <input type="text" id="token" name="token">
	        	</form>
			</div>
		</div>
	</div>
	<div style="position: fixed; bottom: 30px; right: 100px; color: green;">
	    <strong>
	        Learn Web Coding
	    </strong>
	</div>
  </body>

  <script>
  function recapthaToken(){
    grecaptcha.ready(function() {
      grecaptcha.execute('6Le6wtgZAAAAAJNh5Nl8T87zHN81BhuF-6d30XiV', {action: 'homepage'}).then(function(token) {
         // console.log(token);
         document.getElementById("token").value = token;
      });
    });
  };
  recapthaToken();
  setInterval(function(){ 
    recapthaToken();
   }, 5000);
  </script>

</html>