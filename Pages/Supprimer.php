<?php
session_start();

$IDArticle = $_SESSION['IDArticle'];

//identifier votre BDD
$database = "bddebay";
//connectez-vous de votre BDD
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);

//Ajout de l'article    
if (isset($_POST['button'])) {
    $sql = "DELETE FROM article WHERE `IDArticle`=$IDArticle";
    mysqli_query($db_handle, $sql); 
    header('Location: SupprArticle.php');                    
}
?>