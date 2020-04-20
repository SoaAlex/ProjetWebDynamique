<?php
session_start();
//Récupération des données  !!!! Les clés étrangères ? 
$nom = isset($_POST["nom"])? $_POST["nom"] : "";
$typeArticle = isset($_POST["typeProd"])? $_POST["typeProd"] : "";
$description = isset($_POST["description"])? $_POST["description"] : "";
$VenteEnchere = isset($_POST["VenteEnchere"])? $_POST["VenteEnchere"] : "";
$VenteImmediat = isset($_POST["VenteImmediat"])? $_POST["VenteImmediat"] : "";
$VenteBestOffer = isset($_POST["VenteBestOffer"])? $_POST["VenteBestOffer"] : "";
$prix = isset($_POST["prix"])? $_POST["prix"] : "";
$dateLim = isset($_POST["dateLim"])? $_POST["dateLim"] : "";
$PSVendeur = isset($_SESSION["username"])? $_SESSION["username"] : "";
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

    $sql = "SELECT IDVendeur FROM vendeur WHERE Pseudo LIKE '$PSVendeur'";
    $result = mysqli_query($db_handle, $sql);
    $row = mysqli_fetch_assoc($result);
    $IDVendeur = $row['IDVendeur'];

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
    if(mysqli_num_rows($result)==0){
   

        $sql2 = "INSERT INTO `article` (`Nom`, `Description`, `TypeArticle`, `Prix`, `VenteEnchere`, `VenteImmediat`, `VenteBestOffer`, `DateLim`, `#IDCommande`, `#IDVendeur`, `#IDAdmin`, `CheminVideo`)
        VALUES('$nom','$description','$typeArticle',$prix,$VenteEnchere,$VenteImmediat,$VenteBestOffer,'$dateLim', NULL,'$IDVendeur', NULL,'$CheminVideo')";
        
        if (mysqli_query($db_handle, $sql2)) {
        } else {
            echo "Error: " . $sql2 . "<br>" . mysqli_error($db_handle);
        }
        } 
        else {
        //Article déjà existant
        }

        $sql = "SELECT IDArticle FROM article WHERE Nom LIKE '$nom' AND DateLim LIKE '$dateLim'";
        $result = mysqli_query($db_handle, $sql);
        $row = mysqli_fetch_assoc($result);
        $IDArticle = $row['IDArticle'];

        $sql3 = "INSERT INTO `image` (`CheminImg`,`Nom`,`#IDArticle`)
        VALUES('$CheminImage1','$nom',$IDArticle)";

        if (mysqli_query($db_handle, $sql3)) {
            } else {
        echo "Error: " . $sql3 . "<br>" . mysqli_error($db_handle);
            }       

        if($CheminImage2 != NULL)
        {
        $sql4 = "INSERT INTO `image` (`CheminImg`,`Nom`,`#IDArticle`)
        VALUES('$CheminImage2','$nom',$IDArticle)";

        if (mysqli_query($db_handle, $sql4)) {
         } else {
        echo "Error: " . $sql3 . "<br>" . mysqli_error($db_handle);
    }
    }
    if($CheminImage3 != NULL)
    {
    $sql5 = "INSERT INTO `image` (`CheminImg`,`Nom`,`#IDArticle`)
    VALUES('$CheminImage3','$nom',$IDArticle)";

    if (mysqli_query($db_handle, $sql5)) {
     } else {
    echo "Error: " . $sql3 . "<br>" . mysqli_error($db_handle);
}
}


}
else {
echo "Database not found";
}
header("Location : landingPage.php");
}
?>