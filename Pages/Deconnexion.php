<?php
//inspiré de: https://www.tutorialrepublic.com/php-tutorial/php-mysql-login-system.php
// Initialiser la session
session_start();
 
// Suppression des variables
$_SESSION = array();
 
// Destruction de la session
session_destroy();
 
// Redirection vers page d'accueil
header("location: landingPage.php");
exit;
?>