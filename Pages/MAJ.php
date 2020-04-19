<?php 
//MAJ A chaque connexion admin ou tous les matins
$database = "bddebay";
$db_handle = mysqli_connect('localhost', 'root','');
$db_found = mysqli_select_db($db_handle, $database);

///////////////1) Verfi si des articles ont dépasés leurs dates limite d'enchère et accepter la meilleure offre
$sql_art = "SELECT * FROM article WHERE dateLim < CURDATE() AND VenteEnchere=1";
$result_art = mysqli_query($db_handle, $sql_art);

//Pour chaque article
while($data_art = mysqli_fetch_assoc($result_art)){
    $IDArticle = $data_art['IDArticle'];
    $sql_ench = "SELECT * 
                 FROM enchere 
                 WHERE `#IDArticle`=$IDArticle AND Accepte=0
                 ORDER BY MontantMaxAcheteur DESC";
    $result_ench = mysqli_query($db_handle, $sql_ench);
    
    //Maj accepté
    while($data_ench = mysqli_fetch_assoc($result_ench)){
        //On accepte l'enchère de la meilleure offre
        $IDEnch = $data_ench['IDEnchere'];
        $sql_maj = "UPDATE enchere
        SET Accepte=1
        WHERE IDEnchere=$IDEnch";
        mysqli_query($db_handle, $sql_maj);
    break;
    }    
}

///////////2) 

//Fini, retour à la page départ
header("Location: landingPage.php");

?>