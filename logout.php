<?php
session_start();
unset($_SESSION['userData']);
unset($_SESSION['access_token']);
session_destroy();
setcookie('id', '', time() - 60*60*24*30, '/'); 
setcookie('sess', '', time() - 60*60*24*30, '/');
header('Location: index.php');
die();
?>