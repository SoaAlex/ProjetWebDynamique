<?php
//Ce fichier s'occupe de créer une commande en mettant à jour l'attribut #IDCommande des articles correspondant
//Et de supprimer les enchères/négo une fois commandés, avec le prix adéquat
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

            $liv= $_SESSION['liv'];
            $article2= $data_article['IDArticle'];
            $IDAdr=$adresse['IDAdresse'];
            $IDCB=$_SESSION['IDCB'];
            $Nego = 0;
            $Ench = 0;

            $sql12 = "SELECT * FROM negociation WHERE `#IDArticle`=$article2";
            $result12 = mysqli_query($db_handle, $sql12);
            $row12 = mysqli_fetch_assoc($result12);
            $Nego = $row12['Accepte'];

            $sql13 = "SELECT * FROM enchere WHERE `#IDArticle`=$article2 AND `#IDAcheteur`=$userID";
            $result13 = mysqli_query($db_handle, $sql13);
            $row13 = mysqli_fetch_assoc($result13);
            $Ench = $row13['Accepte'];
            $Tot = 0;

            if($data_article['VenteImmediat'] == 1){
                $Tot=$_SESSION['Total'] - $liv;
                //On crée la commande
                $sql5 = "INSERT INTO `commande` (`Date`,`FraisLivraison`,`Total`,`#IDAcheteur`,`#IDAdresse`,`#IDCB`)
                VALUES(CURDATE(),$liv,$Tot,$IDAcheteur,$IDAdr,$IDCB)";
                mysqli_query($db_handle, $sql5);

                //On regarde quel ID elle a
                $sql1 = "SELECT * FROM commande WHERE FraisLivraison=$liv AND Total=$Tot AND `#IDAcheteur`=$IDAcheteur";
                $result2 = mysqli_query($db_handle, $sql1);
                $row2 = mysqli_fetch_assoc($result2);
                $IDComm = $row2['IDCommande'];
                
                //On dit que l'article a été commandé
                $sql2 ="UPDATE article SET `#IDCommande`= $IDComm WHERE IDArticle=$article2";
                mysqli_query($db_handle, $sql2);

                //On supprime du panier
                $sql3 = "DELETE FROM choixarticles WHERE `#IDArticle`=$article2";
                mysqli_query($db_handle, $sql3);                 
            }
            else if($Nego == 1){
                //On crée la commande
                $Tot=$row12['DerniereOffre'];
                $sql7 = "INSERT INTO `commande` (`Date`,`FraisLivraison`,`Total`,`#IDAcheteur`,`#IDAdresse`,`#IDCB`)
                VALUES(CURDATE(),$liv,$Tot,$IDAcheteur,$IDAdr,$IDCB)";
                mysqli_query($db_handle, $sql7);

                //On regarde quel ID elle a
                $sql1 = "SELECT * FROM commande WHERE FraisLivraison=$liv AND Total=$Tot AND `#IDAcheteur`=$IDAcheteur";
                $result2 = mysqli_query($db_handle, $sql1);
                $row2 = mysqli_fetch_assoc($result2);
                $IDComm = $row2['IDCommande'];
                
                //On dit que l'article a été commandé
                $sql2 ="UPDATE article SET `#IDCommande`= $IDComm WHERE IDArticle=$article2";
                mysqli_query($db_handle, $sql2);

                //On supprime du panier et on supprime toutes les négo pour cette article
                $sql3 = "DELETE FROM choixarticles WHERE `#IDArticle`=$article2";
                mysqli_query($db_handle, $sql3);
                $sql_del = "DELETE FROM negociation WHERE `#IDArticle`=$article2";
                mysqli_query($db_handle, $sql_del);              
                

            }
            else if($Ench == 1){//Si c'est une enchère
                //On cherche toutes les enchères pour cette article avec son max
                $sql_max = "SELECT * FROM enchere WHERE `#IDArticle`=$article2 ORDER BY MontantMaxAcheteur DESC";
                $result_max = mysqli_query($db_handle, $sql_max);
                $j = 0;
                $max1 = 0;
                $max2 = 0;
                while($data_max = mysqli_fetch_assoc($result_max)){
                    if($j==0) {
                        $max1 = $data_max["MontantMaxAcheteur"];
                    
                    }
                    if($j==1){ 
                        $max2 = $data_max["MontantMaxAcheteur"];
                    break;
                    }
                    $j++;
                }
                $Tot = $max2 + 1;

                //On crée la commande
                $sql7 = "INSERT INTO `commande` (`Date`,`FraisLivraison`,`Total`,`#IDAcheteur`,`#IDAdresse`,`#IDCB`)
                         VALUES(CURDATE(),$liv,$Tot,$IDAcheteur,$IDAdr,$IDCB)";
                mysqli_query($db_handle, $sql7);

                //On regarde quel ID elle a
                $sql1 = "SELECT * FROM commande WHERE FraisLivraison=$liv AND Total=$Tot AND `#IDAcheteur`=$IDAcheteur";
                $result2 = mysqli_query($db_handle, $sql1);
                $row2 = mysqli_fetch_assoc($result2);
                $IDComm = $row2['IDCommande'];

                //On dit que l'article a été commandé
                $sql2 ="UPDATE article SET `#IDCommande`= $IDComm WHERE IDArticle=$article2";
                mysqli_query($db_handle, $sql2);

                //On supprime du panier et on supprime l'enchère
                $sql3 = "DELETE FROM choixarticles WHERE `#IDArticle`=$article2";
                mysqli_query($db_handle, $sql3);
                $sql_del = "DELETE FROM enchere WHERE `#IDArticle`=$article2";
                mysqli_query($db_handle, $sql_del);
            }
        }
        //MAJ Solde CB
        $sql_cb = "SELECT * FROM cartebancaire WHERE `#IDAcheteur`=$userID";
        $result_cb = mysqli_query($db_handle, $sql_cb);
        $data_cb = mysqli_fetch_assoc($result_cb);
        $nouvSolde = $data_cb['Solde'] - $Tot;
        $sql_cb = "UPDATE cartebancaire
                   SET Solde=$nouvSolde;
                   WHERE `#IDAcheteur`=$userID";
        mysqli_query($db_handle, $sql_cb);
        header('Location: CommandeMerci.php');
    }
    else{
        header('Location: CommandeValidation.php');
    }
    
}
?>