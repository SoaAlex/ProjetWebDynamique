<?php
   session_start();
 
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === false){
        header("location: landingPage.php");
        exit;
    }

    $userID = $_SESSION['userID'];
    $database = "bddebay";
    $db_handle = mysqli_connect('localhost', 'root','');
    $db_found = mysqli_select_db($db_handle, $database);
    $IDArticle = $_GET['IDArticle'];
    $userID = $_SESSION['userID'];

    //Supprime l'article du panier
    if($db_found){
        $sql = "DELETE FROM choixarticles
                WHERE `#IDArticle`=$IDArticle AND `#IDAcheteur`=$userID";
        mysqli_query($db_handle, $sql);

        $sql= "DELETE FROM negociation
               WHERE `#IDArticle`=$IDArticle AND `#IDAcheteur`=$userID";
        mysqli_query($db_handle, $sql);

        $sql= "DELETE FROM enchere
               WHERE `#IDArticle`=$IDArticle AND `#IDAcheteur`=$userID";
        mysqli_query($db_handle, $sql);

        header("Location: panier.php");
    }
?>