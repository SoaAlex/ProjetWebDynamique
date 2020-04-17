<?php
//Récupération des données 
$adrL1 = isset($_POST["adrL1"])? $_POST["adrL1"] : "";
$adrL2 = isset($_POST["adrL2"])? $_POST["adrL2"] : "";
$ville = isset($_POST["ville"])? $_POST["ville"] : "";
$CP = isset($_POST["CP"])? $_POST["CP"] : "";
$pays = isset($_POST["pays"])? $_POST["pays"] : "";
$tel = isset($_POST["tel"])? $_POST["tel"] : "";

//identifier votre BDD
$database = "bddebay";
//connectez-vous de votre BDD
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);

//Ajout de l'acheteur

if (isset($_POST['button1'])) {

    if ($CGU =="") {
        $CGU = 0;
    }
    
    if ($db_found) {
    $sql = "SELECT * FROM acheteur";
        if ($mail !="") {
        $sql .= " WHERE  Mail LIKE '$mail'" ;
        }
    $result = mysqli_query($db_handle, $sql);

    //vérification Acheteur déjà existant ou informations déjà prises
    if (mysqli_num_rows($result) == 0) {
        $sql2 = "INSERT INTO `acheteur` (`Nom`, `Prenom`, `Mail`, `Password`, `CGU`)
        VALUES('$nom','$prenom','$mail','$password',$CGU)";

    if (mysqli_query($db_handle, $sql2)) {
            echo "<br> Compte Acheteur créé <br>";
        } else {
            echo "Error: " . $sql2 . "<br>" . mysqli_error($db_handle);
        }
        } 
    else {
        // Informations déjà utilisée
    echo "Veuillez choisir d'autres informations de connexion";
        }

        $sql = "SELECT IDAcheteur FROM acheteur WHERE Mail LIKE '$mail'";
        $result = mysqli_query($db_handle, $sql);
        $row = mysqli_fetch_assoc($result);
        $IDAcheteur= $row['IDAcheteur'];

     $sql3 = "INSERT INTO `adresse` (`AdrLigne1`, `AdrLigne2`, `Ville`, `CodePostal`, `Pays`,`NumTel`,`#IDAcheteur`)
        VALUES('$adrL1','$adrL2','$ville',$CP,'$pays',$tel,$IDAcheteur)";

    if (mysqli_query($db_handle, $sql3)) {
            echo "<br> Adresse Ajoutee créé <br>";
        } else {
            echo "Error: " . $sql3 . "<br>" . mysqli_error($db_handle);
        }
}
else {
echo "Database not found";
}
}
?>