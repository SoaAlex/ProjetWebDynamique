<?php
session_start();
//Récupération des données 
    $numCarte = isset($_POST["numCB"])? $_POST["numCB"] : "";
    $numCarte = str_replace(' ', '', $numCarte); //enlève les espaces
    $dExp = isset($_POST["Expira"])? $_POST["Expira"] : "";
    $nom = isset($_POST["Acheteur"])? $_POST["Acheteur"] : "";
    $secu = isset($_POST["Secu"])? $_POST["Secu"] : "";
    $type = isset($_POST["TypeCarte"])? $_POST["TypeCarte"] : "";
    $ID = $_SESSION['userID'];
   
//identifier votre BDD
$database = "bddebay";
//connectez-vous de votre BDD
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);
$_SESSION["CBInsufisant"] = 0;

//Vérification existence CB

if (isset($_POST['button1'])) {

    if ($db_found) {
        $sql = "SELECT * FROM cartebancaire";
        if ($numCarte != "") {
        $sql .= " WHERE NumCarte LIKE '$numCarte'";
            if ($dExp != "") {
            $sql .= " AND DateExpiration LIKE '$dExp'";
                if ($nom!= "") {
                $sql .= " AND NomAffiche LIKE '%$nom%'";
                    if ($secu!= "") {
                    $sql .= " AND CodeSecur LIKE '$secu'";
                        if ($type!= "") {
                        $sql .= " AND TypeCarte LIKE '%$type%'";
                            if($ID!="")
                            {
                                $sql .= " AND `#IDAcheteur`=$ID";
                                $_SESSION['numCarte'] = $numCarte;
                            }
                        }
                    }
                }
            }     
        }   
        
        $result = mysqli_query($db_handle, $sql);
        //Résultats Requête SQL
        if (mysqli_num_rows($result) == 0) {
            $_SESSION["CBInsufisant"] = 1;
            header('Location: CommandeCB.php');
            } 
        else {
            $data = mysqli_fetch_assoc($result);
            $_SESSION['SoldeRestant']=$data['Solde'];
            $sql = "SELECT * FROM cartebancaire WHERE NumCarte LIKE '$numCarte' AND CodeSecur LIKE '$secu'";
            $result = mysqli_query($db_handle, $sql);
            $row = mysqli_fetch_assoc($result);
            $_SESSION['IDCB'] = $row['IDCB'];
            $_SESSION["CBInsufisant"] = 0;
            header('Location: CommandeValidation.php');    
            }
            
}
else {
echo "Database not found";
}
}
?>