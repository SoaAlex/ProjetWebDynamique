<?php
//Récupération des données  !!!! Les clés étrangères ? 
$nom = isset($_POST["nom"])? $_POST["nom"] : "";
$prenom = isset($_POST["prenom"])? $_POST["prenom"] : "";
$mail = isset($_POST["mail"])? $_POST["mail"] : "";
$password = isset($_POST["password"])? $_POST["password"] : "";
$CGU = isset($_POST["CGU"])? $_POST["CGU"] : "";


//identifier votre BDD
$database = "ebayece";
//connectez-vous de votre BDD
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);

//Ajout de l'article

if (isset($_POST['button1'])) {
    if ($db_found) {
    $sql = "SELECT * FROM acheteur";
        if ($mail !="" AND $password !="") {
        $sql .= " WHERE  Mail LIKE '$mail' OR Password LIKE '$password'" ;
        }
    $result = mysqli_query($db_handle, $sql);

    //vérification Acheteur déjà existant ou informations déjà prises
    if (mysqli_num_rows($result) == 0) {
        $sql = "INSERT INTO acheteur(nom, prenom, mail, password, CGU)
        VALUES('$nom','$prenom','$mail','$password', '$CGU')";
        echo "Nouveau Compte Acheteur créé <br>";
        } 
    else {
        // Informations déjà utilisée
    echo "Veuillez choisir d'autres informations de connexion";
        }
}
else {
echo "Database not found";
}
}
?>