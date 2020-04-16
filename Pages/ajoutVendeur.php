<?php
//Récupération des données  !!!! Les clés étrangères ? 
$pseudo = isset($_POST["pseudo"])? $_POST["pseudo"] : "";
$mail = isset($_POST["mail"])? $_POST["mail"] : "";
$password = isset($_POST["psw"])? $_POST["psw"] : "";
$imgProfil = isset($_POST["imgProfil"])? $_POST["imgProfil"] : "";
$imgFond = isset($_POST["imgFond"])? $_POST["imgFond"] : "";

//identifier votre BDD
$database = "bddebay";
//connectez-vous de votre BDD
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);

//Ajout de l'acheteur

if (isset($_POST['button1'])) {
    
    if ($db_found) {
        $sql = "SELECT * FROM vendeur";
        if ($mail !="") {
        $sql .= " WHERE  Mail LIKE '$mail'" ;
        }
    $result = mysqli_query($db_handle, $sql);

    //vérification Acheteur déjà existant ou informations déjà prises
    if (mysqli_num_rows($result) == 0) {
        $sql2 = "INSERT INTO `vendeur` (`Pseudo`, `Mail`,`Password`)
        VALUES('$pseudo','$mail','$password')";

    if (mysqli_query($db_handle, $sql2)) {
            echo "<br> Compte Vendeur créé <br>";
        } else {
            echo "Error: " . $sql2 . "<br>" . mysqli_error($db_handle);
        }
        } 
    else {
        // Informations déjà utilisée
    echo "Veuillez choisir d'autres informations de connexion";
        }

        $sql = "SELECT IDVendeur FROM vendeur WHERE Pseudo LIKE '$pseudo'";
        $result = mysqli_query($db_handle, $sql);
        $row = mysqli_fetch_assoc($result);
        $IDVendeur = $row['IDVendeur'];

        $sql3 = "INSERT INTO `image` (`CheminImg`,`Nom`,`#IDVendeur`)
        VALUES(NULL,'$pseudo',NULL,$IDVendeur)";

        if (mysqli_query($db_handle, $sql3)) {
            echo "<br> Image profil Ajoutée<br>";
        } else {
            echo "Error: " . $sql3 . "<br>" . mysqli_error($db_handle);
        }
        

        $sql4 = "INSERT INTO `image` (`CheminImg`,`Nom`,`#IDVendeur`)
        VALUES(NULL,'$pseudo',NULL, $IDVendeur)";

        if (mysqli_query($db_handle, $sql4)) {
            echo "<br> Image Fond Ajoutée<br>";
        } else {
            echo "Error: " . $sql3 . "<br>" . mysqli_error($db_handle);
        }
}
else {
echo "Database not found";
}
}
?>