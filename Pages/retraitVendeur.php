<?php
//Récupération des données dépend de la méthode choisie à retravailler
$pseudo = isset($_POST["pseudo"])? $_POST["pseudo"] : "";

//identifier votre BDD
$database = "ebayece";
//connectez-vous de votre BDD
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);

// à voir la méthode de suppression d'article, si on doit rentrer info ou les infos sont récupérées toutes seules
if (isset($_POST['button1'])) {
    if ($db_found) {
        $sql = "SELECT * FROM vendeur";
        if ($pseudo != "") {
            $sql .= " WHERE Nom LIKE '$pseudo'";
        }
    $result = mysqli_query($db_handle, $sql);
    if (mysqli_num_rows($result) == 0) {
    //Vendeur inexistant
    echo "Vendeur inexitant, veuillez vérifier le pseudo rentré <br>";
    } else {
    while ($data = mysqli_fetch_assoc($result) ) {
        $idVendeur = $data['IDVendeur'];
        echo "<br>";
    }
    $sql = "DELETE FROM vendeur";
    $sql .= " WHERE ID = $id";
    $result = mysqli_query($db_handle, $sql);
    echo "vendeur viré du site ! <br>";
    }
}
else {
    echo "Database not found";
    }
}
?>