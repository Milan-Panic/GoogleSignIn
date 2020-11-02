<?php 
	function is_not_Robot() {
		$url = "https://www.google.com/recaptcha/api/siteverify";
		$data = [
			'secret' => "6Le6wtgZAAAAAFtxhSDjYoSVVQHMNGTISoS5A7fb",
			'response' => $_POST['token'],
			'remoteip' => $_SERVER['REMOTE_ADDR']
		];

		$options = array(
		    'http' => array(
		      'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
		      'method'  => 'POST',
		      'content' => http_build_query($data)
		    )
		  );

		$context  = stream_context_create($options);
  		$response = file_get_contents($url, false, $context);

		$res = json_decode($response, true);
		if($res['success'] == true && $res['score'] > 0.5 ) {
            return true;
			// Perform you logic here for ex:- save you data to database
  			// echo '<div class="alert alert-success">
			//   		<strong>Success!</strong> Your inquiry successfully submitted.
		 	// 	  </div>';
		} 
		// else {
            // return false;
			// echo '<div class="alert alert-warning">
			// 		  <strong>Error!</strong> You are not a human.
			// 	  </div>';
		// }
	}

?>