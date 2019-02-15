<?php 
session_start();

// Suppression des variables de session et de la session
$_SESSION = array();
session_destroy();
header('location: /projet3/index.php');
// Suppression des cookies de connexion automatique
//setcookie('login', '');
//setcookie('pass_hache', '');
?>