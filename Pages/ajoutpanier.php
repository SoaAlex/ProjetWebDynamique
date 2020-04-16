<?php
    session_start();
    $database = "bddebay";
    $db_handle = mysqli_connect('localhost', 'root','');
    $db_found = mysqli_select_db($db_handle, $database);
    $IDAcheteur = $_SESSION['userID'];
    $IDArticle = $_SESSION['IDArticle'];

    //Recherche si article déjà dans panier
    if(isset($_POST["buttonNego"]) || isset($_POST["buttonEnchere"]) || isset($_POST["buttonImmediat"])){
        $sql = "SELECT * FROM `choixArticle` WHERE `IDArticle`=$IDArticle AND `IDAcheteur`=$IDAcheteur";
        $result = mysqli_query($db_handle, $sql);
        //Si pas dans panier
        if(mysqli_num_rows($result) == 0) {
            $sql = "INSERT INTO choixArticles(`#IDAcheteur`, `#IDArticle`) VALUES (`$IDAcheteur`, `$IDArticle`)";
            $result = mysqli_query($db_handle, $sql);//AJouter
            header("Location: http://localhost/ProjetWebDynamique/Pages/panier.php");
        }
    }
?>