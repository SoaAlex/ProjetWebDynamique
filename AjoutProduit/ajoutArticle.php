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
 // $IDVendeur = isset($_POST["prix"])? $_POST["prix"] : "";
$CheminImage1 = isset($_POST["img1"])? $_POST["img1"] : "";
$CheminImage2 = isset($_POST["img2"])? $_POST["img2"] : "";   
$CheminVideo = isset($_POST["video"])? $_POST["video"] : "";

//identifier votre BDD
$database = "ebayece";
//connectez-vous de votre BDD
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);

//Ajout de l'article
if (isset($_POST['button1'])) {

    //Remplissage False Vente
    if ($VenteEnchere == "") {
        $VenteEnchere = "false";
    }
    if ($VenteImmediat == "") {
        $VenteImmediat = "false";
    }
    if ($CheminImage2 == "") {
        $CheminImage2 = NULL;
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
        echo "$typeArticle";
        echo "$description ";
        echo "$VenteEnchere ";
        echo "$VenteImmediat ";
        echo "$VenteBestOffer ";
        echo "$prix ";
        echo "$dateLim ";
        echo "$CheminImage1";
        echo "$CheminImage2";
        echo "$CheminVideo ";

        $sql = "INSERT INTO article(nom, description, typeArticle, prix, VenteEnchere; VenteImmediat, VenteBestOffer, DateLim, IDCommande, IDVendeur, IDAdmin CheminImage1, CheminImage2, CheminVideo)
        VALUES('$nom', '$description', '$typeArticle', '$prix', '$VenteEnchere'; '$VenteImmediat', '$VenteBestOffer', '$dateLim', NULL, NULL, NULL,'$CheminImage1', '$CheminImage2', '$CheminVideo')";
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