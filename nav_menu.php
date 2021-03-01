<?php 
    require_once('config.php');
    require_once('core/controller.Class.php');
    require_once('recaptcha_function.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login to my app</title>
    <script src='https://www.google.com/recaptcha/api.js?render=<?php echo SITE_KEY; ?>'></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> NIJE RADIO AJAX-->
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../minified/themes/default.min.css" />
    <script src="../minified/sceditor.min.js"></script>
    <script src="../minified/formats/bbcode.js"></script>
    <script src="../minified/plugins/dragdrop.js"></script>
    <!-- drag drop nece raditi ako nisu zakomentarisane sledece dve skripte -->
    <!-- <script src="../minified/jquery.sceditor.min.js"></script> -->
    <script src="../minified/jquery.sceditor.bbcode.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/zt84bx8r06hulpz2ko0eg50bkc6h2ycyyuhr8w1cfgjouijh/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="js/googlemap.js"></script>
	<style type="text/css">
		.container {
			height: 450px;
		}
		#map {
			width: 100%;
			height: 100%;
			border: 1px solid blue;
		}
		#data, #allData {
			display: none;
		}
        .output{
            width: 70%;
            min-height: 100px;
            margin: 0 auto;
            border:2px solid blue;
            border-radius: 5px;
            margin-top: 30px;
        }
        .b{
            font-weight: bold;
        }
        .userdata tr:first-child td {
            font-weight: bold;
            border: 1px solid blue;
        }
        .table-link{
            display: inline-block;
            width: 230px;
            background-color: green;
            border-radius: 5px;
            padding: 7px;
            margin: 10px;
            text-align: center;
        }
        a{
            color:white;
        }
	</style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
<a class="navbar-brand" href="/GoogleSignin/index.php">
    <img src="/GoogleSignin/img/logo.png" alt="logo" width="30" height="30" class="d-inline-block align-top" loading="lazy">
    Experimental page
</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
    <li class="nav-item active">
        <a class="nav-link" href="/GoogleSignin/index.php">Home <span class="sr-only">(current)</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/GoogleSignin/google_maps/google-map-php-mysql/">Maps</a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Editors</a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="/GoogleSignin/tiny_editor/">Tiny editor</a>
            <a class="dropdown-item" href="/GoogleSignin/sc_editor/">SC editor(dragdrop)</a>
            <a class="dropdown-item" href="/GoogleSignin/sc_editor/insert_file.php">SC editor(insert file)</a>
        </div>
    </li>
    </ul>
</div>
</nav>
