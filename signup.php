<?php
require_once('core/controller.Class.php');
$success = '';
if (isset($_REQUEST["email"])) {
	$email = $_REQUEST["email"];
	$id = $_REQUEST["id"];
	$avatar = $_REQUEST["avatar"];
	$fname = $_REQUEST["fname"];
	$lname = $_REQUEST["lname"];
	$Controller = new Controller;
	if($Controller->insertNew($email, $fname, $lname, $id, $avatar)){
			$success = "Uspesno ubaceno!";
			setcookie("id", $id, time()+60*60*24*30, "/", NULL);
	}else{
			$success = "Nije ubaceno!";			
			setcookie("id", $id, time()+60*60*24*30, "/", NULL);
	}
}else{
    header('Location: index.php?undefined=true');
}
echo $success;
// $sql = "INSERT INTO `users`(`f_name`, `l_name`, `avatar`, `email`, `password`, `session`) VALUES ('Milan','Panic','Milan Panic','milan@gmail.com','2314jjd','sdgtrt2134')";


