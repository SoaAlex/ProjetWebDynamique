<?php
session_start();
//Récupération des données 
    $adrL1 = isset($_POST["AdresseL1"])? $_POST["AdresseL1"] : "";
    $nom = isset($_POST["nom"])? $_POST["nom"] : "";
    $adrL2 = isset($_POST["AdresseL2"])? $_POST["AdresseL2"] : "";
    $ville = isset($_POST["Ville"])? $_POST["Ville"] : "";
    $CP = isset($_POST["CP"])? $_POST["CP"] : "";
    $pays = isset($_POST["pays"])? $_POST["pays"] : "";
    $tel = isset($_POST["tel"])? $_POST["tel"] : "";
    $PSAcheteur = isset($_SESSION["username"])? $_SESSION["username"] : "";
    $liv = isset($_POST["Livraison"])? $_POST["Livraison"] : "";

    $adrL12 = isset($_POST["AdresseL12"])? $_POST["AdresseL12"] : "";
    $nom2 = isset($_POST["nom2"])? $_POST["nom2"] : "";
    $adrL22 = isset($_POST["AdresseL22"])? $_POST["AdresseL22"] : "";
    $ville2 = isset($_POST["Ville2"])? $_POST["Ville2"] : "";
    $CP2 = isset($_POST["CP2"])? $_POST["CP2"] : "";
    $pays2 = isset($_POST["pays2"])? $_POST["pays2"] : "";
    $tel2 = isset($_POST["tel2"])? $_POST["tel2"] : "";
//identifier votre BDD
$database = "bddebay";
//connectez-vous de votre BDD
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);

//Ajout de l'adresse

if (isset($_POST['button1'])) {

    if ($db_found) {
        $sql = "SELECT IDAcheteur FROM acheteur WHERE Nom LIKE '$PSAcheteur'";
        $result = mysqli_query($db_handle, $sql);
        $row = mysqli_fetch_assoc($result);
        $IDAcheteur = $row['IDAcheteur'];

     $sql3 = "INSERT INTO `adresse` (`AdrLigne1`, `AdrLigne2`, `Ville`, `CodePostal`, `Pays`,`NumTel`,`#IDAcheteur`)
        VALUES('$adrL1','$adrL2','$ville',$CP,'$pays',$tel,$IDAcheteur)";

    if (mysqli_query($db_handle, $sql3)) {
            echo "<br> Adresse Ajoutee <br>";
        } else {
            echo "Error: " . $sql3 . "<br>" . mysqli_error($db_handle);
        }
        
        $sql = "SELECT `IDAdresse` FROM `adresse` WHERE AdrLigne1 LIKE '$adrL1' AND Ville LIKE '$ville'";
        $result = mysqli_query($db_handle, $sql);
        $row = mysqli_fetch_assoc($result);
        $IDAdresse = $row['IDAdresse'];

        $sql5 = "INSERT INTO `commande` (`Date`,`FraisLivraison`,`#IDAcheteur`,`#IDAdresse`)
        VALUES(CURDATE(),$liv,$IDAcheteur,$IDAdresse)";

        if (mysqli_query($db_handle, $sql5)) {
            echo "<br> Commande Créée<br>";
            } else {
        echo "Error: " . $sql5 . "<br>" . mysqli_error($db_handle);
            }       

}
else {
echo "Database not found";
}
}
if (isset($_POST['button2'])) {

    if ($db_found) {
        $sql = "SELECT IDAcheteur FROM acheteur WHERE Nom LIKE '$PSAcheteur'";
        $result = mysqli_query($db_handle, $sql);
        $row = mysqli_fetch_assoc($result);
        $IDAcheteur = $row['IDAcheteur'];

     $sql4 = "INSERT INTO `adresse` (`AdrLigne1`, `AdrLigne2`, `Ville`, `CodePostal`, `Pays`,`NumTel`,`#IDAcheteur`)
        VALUES('$adrL12','$adrL22','$ville2',$CP2,'$pays2',$tel2,$IDAcheteur)";

    if (mysqli_query($db_handle, $sql4)) {
            echo "<br> Adresse Ajoutee <br>";
        } else {
            echo "Error: " . $sql4 . "<br>" . mysqli_error($db_handle);
        }
}
else {
echo "Database not found";
}
}
?>