<?php
//Récupération des données  !!!! Les clés étrangères ? 
$nom = isset($_POST["nom"])? $_POST["nom"] : "";
$typeArticle = isset($_POST["typeProd"])? $_POST["typeProd"] : "";
$description = isset($_POST["description"])? $_POST["description"] : "";
$VenteEnchere = isset($_POST["VenteEnchere"])? $_POST["VenteEnchere"] : "";
$VenteImmediat = isset($_POST["VenteImmediat"])? $_POST["VenteImmediat"] : "";
$VenteBestOffer = isset($_POST["VenteBestOffer"])? $_POST["VenteBestOffer"] : "";
$prix = isset($_POST["prix"])? $_POST["prix"] : "";
$dateLim = isset($_POST["dateLim"])? $_POST["dateLim"] : "";
$IDVendeur = isset($_SESSION["user_name"])? $_SESSION["user_name"] : "";
$CheminImage1 = isset($_POST["img1"])? $_POST["img1"] : "";
$CheminImage2 = isset($_POST["img2"])? $_POST["img2"] : "";  
$CheminImage3 = isset($_POST["img3"])? $_POST["img3"] : "";  
$CheminVideo = isset($_POST["video"])? $_POST["video"] : "";

//identifier votre BDD
$database = "bddebay";
//connectez-vous de votre BDD
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);

//Ajout de l'article
if (isset($_POST['button1'])) {

    //Remplissage False Vente
    if ($VenteEnchere == "") {
        $VenteEnchere = 0;
    }
    if ($VenteImmediat == "") {
        $VenteImmediat = 0;
    }
    if ($VenteBestOffer == "") {
        $VenteBestOffer = 0;
    }
    if ($CheminImage2 == "") {
        $CheminImage2 = NULL;
    }
    if ($CheminImage3 == "") {
        $CheminImage3 = NULL;
    }
    if ($CheminVideo == "") {
        $CheminVideo = NULL;
    }

    if ($db_found) {
    $sql = "SELECT * FROM article";
        if ($nom != "") {
        $sql .= " WHERE nom LIKE '$nom'";
        }
    $result = mysqli_query($db_handle, $sql);
    //vérification Article déjà existant avec même vendeur
    if (mysqli_num_rows($result) == 0) {
        echo "$nom ";
        echo "$typeArticle ";
        echo "$description ";
        echo "$VenteEnchere ";
        echo "$VenteImmediat ";
        echo "$VenteBestOffer ";
        echo "$prix ";
        echo "$dateLim ";
        echo "$IDVendeur";

        $sql = "INSERT INTO `article` (`Nom`, `Description`, `TypeArticle`, `Prix`, `VenteEnchere`, `VenteImmediat`, `VenteBestOffer`, `DateLim`, `#IDCommande`, `#IDVendeur`, `#IDAdmin`)
        VALUES('$nom', '$description', '$typeArticle', $prix, $VenteEnchere, $VenteImmediat, $VenteBestOffer, '$dateLim', NULL, NULL, NULL)";
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
}
?>