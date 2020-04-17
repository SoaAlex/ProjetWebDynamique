<?php
    session_start();
    $database = "bddebay";
    $db_handle = mysqli_connect('localhost', 'root','');
    $db_found = mysqli_select_db($db_handle, $database);
    $IDAcheteur = $_SESSION['userID'];
    $IDArticle = $_SESSION['IDArticle'];

    //Recherche si article déjà dans panier
    if(isset($_POST["buttonNego"]) || isset($_POST["buttonEnchere"]) || isset($_POST["buttonImmediat"])){
        $sql = "SELECT * FROM `choixArticles` WHERE `#IDArticle`=$IDArticle AND `#IDAcheteur`=$IDAcheteur";
        $result = mysqli_query($db_handle, $sql);
        //Si pas dans panier
        if(mysqli_num_rows($result) == 0) {
            //Ajout panier
            $sql = "INSERT INTO choixArticles(`#IDAcheteur`, `#IDArticle`) VALUES ($IDAcheteur, $IDArticle)";
            $result = mysqli_query($db_handle, $sql);//AJouter

            //Si nego
            $sql_article = "SELECT * FROM article WHERE `IDArticle`=$IDArticle";
            $result_article = mysqli_query($db_handle, $sql_article);
            $data = mysqli_fetch_assoc($result_article);
            $isNego = $data['VenteBestOffer'];
            echo "TEST";

            if($isNego == 1){
                //Insertion dans table nego
                $prixNego = $_POST['prixNego'];
                $sql_nego = "INSERT INTO negociation('NBNego', 'DerniereOffre', 'Accepte', `#IDArticle`, `#IDAcheteur`) VALUES (1, $prixNego, 0, $IDArticle, $IDAcheteur)";
                $result_nego = mysqli_query($db_handle, $sql_nego);//Ajouter nego
                echo "TEST2";
            }
            //Redirection
            header("Location: http://localhost/ProjetWebDynamique/Pages/panier.php");
        }
    }
?>