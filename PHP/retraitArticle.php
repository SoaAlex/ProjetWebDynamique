<?php


//Récupération des données dépend de la méthode choisie à retravailler
$nom = isset($_POST["nom"])? $_POST["nom"] : "";
$description = isset($_POST["description"])? $_POST["description"] : "";
$typeArticle = isset($_POST["typeArticle"])? $_POST["TypeArticle"] : "";
$prix = isset($_POST["prix"])? $_POST["prix"] : "";
// $IDVendeur = isset($_POST["prix"])? $_POST["prix"] : "";


//identifier votre BDD
$database = "ebayece";
//connectez-vous de votre BDD
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);

// à voir la méthode de suppression d'article, si on doit rentrer info ou les infos sont récupérées toutes seules
if (isset($_POST['button1'])) {
    if ($db_found) {
        $sql = "SELECT * FROM article";
        if ($titre != "") {
            $sql .= " WHERE Nom LIKE '$nom'";
            if ($IDVendeur != "") {
            $sql .= " AND IDVendeur LIKE '$IDVendeur'";
            }
              if ($IDVendeur != "") {
                  $sql .= " AND TypeArticle LIKE '$typeArticle'";
                  }
        }
    $result = mysqli_query($db_handle, $sql);
    if (mysqli_num_rows($result) == 0) {
    //Article inexistant
    echo "Article inexitant, veuillez vérifier les infos rentrées <br>";
    } else {
    while ($data = mysqli_fetch_assoc($result) ) {
        $idArticle = $data['IDArticle'];
        echo "<br>";
    }
    $sql = "DELETE FROM article";
    $sql .= " WHERE ID = $id";
    $result = mysqli_query($db_handle, $sql);
    echo "Article retiré ! <br>";
    }
}
else {
    echo "Database not found";
    }
}
?>