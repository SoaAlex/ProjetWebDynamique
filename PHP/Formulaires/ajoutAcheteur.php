<?php
//Récupération des données  !!!! Les clés étrangères ? 
$nom = isset($_POST["nom"])? $_POST["nom"] : "";
$prenom = isset($_POST["prenom"])? $_POST["prenom"] : "";
$mail = isset($_POST["mail"])? $_POST["mail"] : "";
$password = isset($_POST["psw"])? $_POST["psw"] : "";
$adrL1 = isset($_POST["adrL1"])? $_POST["adrL1"] : "";
$adrl2 = isset($_POST["adrL2"])? $_POST["adrL2"] : "";
$ville = isset($_POST["ville"])? $_POST["ville"] : "";
$CP = isset($_POST["CP"])? $_POST["CP"] : "";
$pays = isset($_POST["pays"])? $_POST["pays"] : "";
$tel = isset($_POST["tel"])? $_POST["tel"] : "";
$CGU = isset($_POST["CGUCheck"])? $_POST["CGUCheck"] : "";



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
        $sql = "INSERT INTO acheteur(nom, prenom, mail, password, CGUCheck)
        VALUES('$nom','$prenom','$mail','$password', '$CGU')";
        $sql = "INSERT INTO adresse(adrl1, adrl2, ville, CP, pays, tel)
        VALUES('$adrl1','$adrL2','$ville','$CP','$pays','$tel')";
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