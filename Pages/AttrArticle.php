<?php
session_start();
$userID = $_SESSION["userID"];
$userAdresse = $_SESSION["adresse"];
$database = "bddebay";
$db_handle = mysqli_connect('localhost', 'root','');
$db_found = mysqli_select_db($db_handle, $database);
$adresse = $_SESSION['adresse'];
$solde=$_SESSION['SoldeRestant'];



//identifier votre BDD
$database = "bddebay";
//connectez-vous de votre BDD
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);

//Ajout de l'article
if (isset($_POST['button1'])) {


    if ($_SESSION['Total'] < $_SESSION['SoldeRestant'])
    {
        $sql = "SELECT * FROM choixarticles WHERE `#IDAcheteur`=$userID";
        $result = mysqli_query($db_handle, $sql);
        $TOTAL = $_SESSION['liv'];

        while($data = mysqli_fetch_assoc($result)){
            echo 'Test Nouvel Item ';
            $article = $data["#IDArticle"];
            $sql_article = "SELECT * FROM article WHERE `IDArticle`=$article";
            $result_article = mysqli_query($db_handle, $sql_article);
            $sql_nego = "SELECT * FROM negociation WHERE `#IDArticle`=$article AND `#IDAcheteur`=$userID";
            $result_negociation = mysqli_query($db_handle, $sql_nego);
            echo $data["#IDArticle"];
            $data_article = mysqli_fetch_assoc($result_article);
            $IDAcheteur = $_SESSION['userID'];

            if(mysqli_num_rows($result_negociation)==0)
            {
                $liv= $_SESSION['liv'];
                $article= $data_article['IDArticle'];
                $IDAdr=$adresse['IDAdresse'];
                $Tot=$_SESSION['Total'];

                if($data_article['VenteImmediat'] == 1){
                    //Màj Article
                    $sql5 = "INSERT INTO `commande` (`Date`,`FraisLivraison`,`Total`,`#IDAcheteur`,`#IDAdresse`)
                    VALUES(CURDATE(),$liv,$Tot,$IDAcheteur,$IDAdr)";
                    mysqli_query($db_handle, $sql5);

                    $sql = "SELECT * FROM commande WHERE FraisLivraison=$liv AND Total=$Tot AND `#IDAcheteur`=$IDAcheteur";
                    $result2 = mysqli_query($db_handle, $sql);
                    $row = mysqli_fetch_assoc($result2);
                    $IDComm = $row['IDCommande'];
                    $sql ="UPDATE article SET `#IDCommande`= $IDComm WHERE IDArticle=$article";
                    mysqli_query($db_handle, $sql);
                    echo 'Test valide ';
                  
                }
                else{
                    echo 'Test Non valide ';
                }
    
            }
           
        }
        header('Location: CommandeMerci.php');
    }
    else{
        header('Location: CommandeValidation.php');
    }
    
}
?>