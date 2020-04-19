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
            $article = $data["#IDArticle"];
            $sql_article = "SELECT * FROM article WHERE `IDArticle`=$article";
            $result_article = mysqli_query($db_handle, $sql_article);
            $sql_nego = "SELECT * FROM negociation WHERE `#IDArticle`=$article AND `#IDAcheteur`=$userID";
            $result_negociation = mysqli_query($db_handle, $sql_nego);
            $data_article = mysqli_fetch_assoc($result_article);
            $IDAcheteur = $_SESSION['userID'];

            //Achat immédiat et négo OU Achat Immédiat
            if(mysqli_num_rows($result_negociation)==0)
            {
                $liv= $_SESSION['liv'];
                $article2= $data_article['IDArticle'];
                $IDAdr=$adresse['IDAdresse'];
                $Tot=$_SESSION['Total'];
                $IDCB=$_SESSION['IDCB'];

                if($data_article['VenteImmediat'] == 1){
                    //Màj Article
                    $sql5 = "INSERT INTO `commande` (`Date`,`FraisLivraison`,`Total`,`#IDAcheteur`,`#IDAdresse`,`#IDCB`)
                    VALUES(CURDATE(),$liv,$Tot,$IDAcheteur,$IDAdr,$IDCB)";
                    mysqli_query($db_handle, $sql5);

                    $sql1 = "SELECT * FROM commande WHERE FraisLivraison=$liv AND Total=$Tot AND `#IDAcheteur`=$IDAcheteur";
                    $result2 = mysqli_query($db_handle, $sql1);
                    $row = mysqli_fetch_assoc($result2);
                    $IDComm = $row['IDCommande'];
                    $sql2 ="UPDATE article SET `#IDCommande`= $IDComm WHERE IDArticle=$article2";
                    mysqli_query($db_handle, $sql2);
                    $sql3 = "DELETE FROM choixarticles WHERE `#IDArticle`=$article2";
                    mysqli_query($db_handle, $sql3);                 
                }
                else{
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