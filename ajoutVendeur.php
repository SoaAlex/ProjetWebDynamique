<?php
//Récupération des données  !!!! Les clés étrangères ? 
$pseudo = isset($_POST["pseudo"])? $_POST["pseudo"] : "";
$mail = isset($_POST["mail"])? $_POST["mail"] : "";
$password = isset($_POST["password"])? $_POST["password"] : "";
$CheminImage = isset($_POST["CheminImage"])? $_POST["CheminImage"] : "";

//identifier votre BDD
$database = "ebayece";
//connectez-vous de votre BDD
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);

//Ajout de l'article

if (isset($_POST['button1'])) {
    if ($db_found) {
    $sql = "SELECT * FROM vendeur";
        if ($pseudo != "" AND $mail !="" AND $password !="") {
        $sql .= " WHERE Pseudo LIKE '$pseudo' OR Mail LIKE '$mail' OR Password LIKE '$password'" ;
        }
    $result = mysqli_query($db_handle, $sql);

    //vérification Vendeur déjà existant ou informations déjà prises
    if (mysqli_num_rows($result) == 0) {
        $sql = "INSERT INTO vendeur(pseudo, mail, password, CheminImage)
        VALUES('$pseudo', '$mail', '$password', '$CheminImage')";
        echo "Nouveau Compte Vendeur crée <br>";
        } 
    else {
        // Informations déjà utilisée
    echo "Veuillez choisir d'autres informations de connexion";
        }
}
else {
echo "Database not found";
}
?>