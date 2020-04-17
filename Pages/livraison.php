<?php
//Récupération des données 
 if($_POST['exampleRadios'] == "option3") { 
    $adrL1 = isset($_POST["AdresseL1"])? $_POST["AdresseL12"] : "";
    $adrL2 = isset($_POST["AdresseL2"])? $_POST["AdresseL22"] : "";
    $ville = isset($_POST["Ville"])? $_POST["Ville2"] : "";
    $CP = isset($_POST["CP"])? $_POST["CP2"] : "";
    $pays = isset($_POST["pays"])? $_POST["pays2"] : "";
    $tel = isset($_POST["tel"])? $_POST["tel2"] : "";
  } else{ 
    $adrL1 = isset($_POST["AdresseL1"])? $_POST["AdresseL1"] : "";
    $adrL2 = isset($_POST["AdresseL2"])? $_POST["AdresseL2"] : "";
    $ville = isset($_POST["Ville"])? $_POST["Ville"] : "";
    $CP = isset($_POST["CP"])? $_POST["CP"] : "";
    $pays = isset($_POST["pays"])? $_POST["pays"] : "";
    $tel = isset($_POST["tel"])? $_POST["tel"] : "";
  }

$PSAcheteur = isset($_SESSION["username"])? $_SESSION["username"] : "";
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
}
else {
echo "Database not found";
}
}
?>