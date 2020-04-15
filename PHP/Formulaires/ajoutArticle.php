<?php
//Récupération des données  !!!! Les clés étrangères ? 
$nom = isset($_POST["nom"])? $_POST["nom"] : "";
$description = isset($_POST["description"])? $_POST["description"] : "";
$typeArticle = isset($_POST["typeArticle"])? $_POST["TypeArticle"] : "";
$prix = isset($_POST["prix"])? $_POST["prix"] : "";
$VenteEnchere = isset($_POST["VenteEnchere"])? $_POST["VenteEnchere"] : "";
$VenteImmediat = isset($_POST["VenteImmediat"])? $_POST["VenteImmediat"] : "";
$VenteBestOffer = isset($_POST["VenteBestOffer"])? $_POST["VenteBestOffer"] : "";
$dateLim = isset($_POST["DateLim"])? $_POST["DateLim"] : "";
 // $IDVendeur = isset($_POST["prix"])? $_POST["prix"] : "";
$CheminImage1 = isset($_POST["CheminImage1"])? $_POST["CheminImage1"] : "";
$CheminImage2 = isset($_POST["CheminImage2"])? $_POST["CheminImage2"] : "";   
$CheminVideo = isset($_POST["CheminVideo"])? $_POST["CheminVideo"] : "";

//identifier votre BDD
$database = "ebayece";
//connectez-vous de votre BDD
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);

//Ajout de l'article

if (isset($_POST['button1'])) {
    if ($db_found) {
    $sql = "SELECT * FROM article";
        if ($nom != "") {
        $sql .= " WHERE nom LIKE '$nom'";
            if ($auteur != "") {
                 $sql .= " AND IDVendeur LIKE '$IDVendeur'";
                 }
        }
    $result = mysqli_query($db_handle, $sql);

    //vérification Article déjà existant avec même vendeur
    if (mysqli_num_rows($result) == 0) {
        $sql = "INSERT INTO article(nom, description, typeArticle, prix, VenteEnchere; VenteImmediat, VenteBestOffer, dateLim, CheminImage1, CheminImage2, CheminVideo)
        VALUES('$nom', '$description', '$typeArticle', '$prix', '$VenteEnchere'; '$VenteImmediat', '$VenteBestOffer', '$dateLim', '$CheminImage1', '$CheminImage2', '$CheminVideo')";
        echo "Article mis en vente <br>";
        } 
    else {
        //Article déjà existant
    echo "Article deja existant";
        }
}
else {
echo "Database not found";
}
?>