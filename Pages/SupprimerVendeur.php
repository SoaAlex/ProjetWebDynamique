<?php
session_start();

$Pseudo = isset($_POST["pseudo"])? $_POST["pseudo"] : "";

//identifier votre BDD
$database = "bddebay";
//connectez-vous de votre BDD
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);

//Ajout de l'article    
if (isset($_POST['button'])) {
    $sql = "DELETE FROM vendeur WHERE `Pseudo`= '$Pseudo'";
    mysqli_query($db_handle, $sql); 
    header('Location: SupprVendeur.php');                    
}
?>