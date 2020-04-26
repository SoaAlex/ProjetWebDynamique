<?php
    session_start();
    
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === false){  //Si pas connecté
        header("location: Connexion.php");
        exit;
    }

    $userID = $_SESSION["userID"];
    $database = "bddebay";
    $db_handle = mysqli_connect('localhost', 'root','');
    $db_found = mysqli_select_db($db_handle, $database);
    
    for($i=0; $i< 200; $i++){
        $BA = 'BA';
        $BN = 'BN';

        //Si nego acceptée
        $BA .= $i;
        if(isset($_POST["$BA"])){
            $sql_nego = "SELECT * FROM negociation WHERE `#IDVendeur`=$userID AND `IDNego`=$i";
            $result_nego = mysqli_query($db_handle, $sql_nego);
            $data_nego = mysqli_fetch_assoc($result_nego);
            $NBNego = $data_nego['NBNego'];

            //Créer commande
            if($_SESSION['user_type'] == "Acheteur"){
                //MAJ Nego
                $sql = "UPDATE negociation 
                SET Accepte = 1
                WHERE IDNego=$i";
                $result = mysqli_query($db_handle, $sql);
                header("Location: http://localhost/ProjetWebDynamique/Pages/CommandeLivraison.php");
            }
            else{
                //MAJ Nego
                $sql_nego = "SELECT * FROM negociation WHERE `#IDVendeur`=$userID AND `IDNego`=$i";
                $result_nego = mysqli_query($db_handle, $sql_nego);
                $data_nego = mysqli_fetch_assoc($result_nego);
                $NBNego = $data_nego['NBNego'];
                $NBNego++;
                $sql = "UPDATE negociation
                        SET NBNego=$NBNego, Accepte=1
                        WHERE IDNego=$i ";
                mysqli_query($db_handle, $sql);
               header("Location: http://localhost/ProjetWebDynamique/Pages/Notification.php");
            }
        }

        //Si nego tjr en cours
        $BN .= $i;
        if(isset($_POST[$BN])){
            $derniereOffre = $_POST['derniereOffre'];
            $sql_nego = "SELECT * FROM negociation WHERE `IDNego`=$i";
            $result_nego = mysqli_query($db_handle, $sql_nego);
            $data_nego = mysqli_fetch_assoc($result_nego);
            $NBNego = $data_nego['NBNego'];

            //Si offre (5) max atteint
            if($NBNego == 10){
                //Delete Nego 
                $sql_del = "DELETE FROM negociation WHERE `IDNego`=$i";
                $result_nego =mysqli_query($db_handle, $sql_del);
                //Delete Panier
                $result_nego = mysqli_query($db_handle, $sql_del);
                $IDArticle = $data_nego['#IDArticle'];
                $sql_del = "DELETE FROM choixarticles WHERE `#IDArticle`=$IDArticle AND `#IDAcheteur`=$userID";
                $result_nego =mysqli_query($db_handle, $sql_del);
            }
            else{
                //MAJ Nego
                echo "nbnego" . $NBNego;
                echo "derniere" . $derniereOffre;
                $NBNego++;
                $sql = "UPDATE negociation
                        SET NBNego=$NBNego, DerniereOffre=$derniereOffre
                        WHERE IDNego=$i ";
                mysqli_query($db_handle, $sql);
            }
            header("Location: http://localhost/ProjetWebDynamique/Pages/Notification.php");
        }
    }
?>