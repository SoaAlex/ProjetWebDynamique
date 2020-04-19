<?php
    session_start();
    
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === false){
        header("location: Connexion.php");
        exit;
    }

    //Recherche info commande
    $userID = $_SESSION['userID'];
    $database = "bddebay";
    $db_handle = mysqli_connect('localhost', 'root','');
    $db_found = mysqli_select_db($db_handle, $database);

    $sql ="SELECT * FROM commande WHERE `#IDAcheteur`=$userID";
    $result = mysqli_query($db_handle, $sql);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Votre compte</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="../CSS/Panier.css">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    </head>

    <body>
        <?php include 'navbar.php'; ?>
        <!-- sous navbar -->
        <nav class="navbar navbar-expand-md" style="background-color:#f59d42;">
            <div class="collapse navbar-collapse Cstart" id="main-navigation">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="ComptePerso.php">
                        Coordonnées
                    </a></li>
                    <li class="nav-item"><a class="nav-link">
                        Historique de commande
                    </a></li>
                    <li class="nav-item"><a class="nav-link" href="ComptePaiement.php">
                        Vos moyens de paiement
                    </a></li>
                    <li class="nav-item"><a class="nav-link" href="CompteSUivi.php">
                        Commandes en cours
                    </a></li>
                </ul>
            </div>
        </nav>

        <div class="container-fluid">
            <?php 
                //Pour chaque commandes
                while($data_com = mysqli_fetch_assoc($result)){
                    echo '<div class="row" style="margin:2%;">';
                        echo '<div class="col-lg-12 col-md-12 col-sm-12">';
                            echo '<h2>| Commande N° '. $data_com['IDCommande'] .'</h2><br>';

                            echo '<h3>Articles:</h3>';
                            echo '<div class="row">';
                                echo '<div class="col-lg-4 col-md-4 col-sm-12">';
                                    //Recherche articles commande
                                    $IDCommande = $data_com['IDCommande'];
                                    $sql = "SELECT * FROM article WHERE `#IDCommande`=$IDCommande";
                                    $result_article = mysqli_query($db_handle, $sql);

                                    //Recherche adresse commande
                                    $IDAdresse = $data_com['#IDAdresse'];
                                    $sql_adr = "SELECT * FROM adresse WHERE `IDAdresse`=$IDAdresse";
                                    $result_adr = mysqli_query($db_handle, $sql_adr);
                                    $data_adr = mysqli_fetch_assoc($result_adr);
                                    
                                    //Recherche Carte
                                    $IDCB = $data_com['#IDCB'];
                                    $sql_cb = "SELECT * FROM cartebancaire WHERE `IDCB`=$IDCB";
                                    $result_cb = mysqli_query($db_handle, $sql_cb);
                                    $data_cb = mysqli_fetch_assoc($result_cb);

                                    //Pour chaque article, l'afficher
                                    while($data_article = mysqli_fetch_assoc($result_article)){
                                        //Recherche image article
                                        $article = $data_article['IDArticle'];
                                        $sql_img = "SELECT CheminImg AS CheminImg FROM `image` WHERE `#IDArticle`=$article";
                                        $result_img = mysqli_query($db_handle, $sql_img);
                                        $dataImg = mysqli_fetch_assoc($result_img);

                                        echo 
                                        '<div class="box-article">
                                            <a href="http://localhost/ProjetWebDynamique/Pages/produit.php?IDArticle=' . $data_article['IDArticle'] . '">'.
                                            '<img src="'. $dataImg['CheminImg'] .'" style="width: 100%;" class="img-fluid">'.
                                            '</a>'.
                                            '<h2 style="margin-left: 5%;">'. $data_article['Nom'] . '</h2>';
                                        
                                            $IDVendeur = $data_article['#IDVendeur'];
                                            $sql_vend = "SELECT Pseudo AS PseudoVend FROM `Vendeur` WHERE `IDVendeur`=$IDVendeur";
                                            $result_vend = mysqli_query($db_handle, $sql_vend);
                                            $dataVend = mysqli_fetch_assoc($result_vend);
                                            echo '
                                                <img src="../img/UI/CaddiOrange.png" style="width: 8%; margin-left: 5%; margin-right: 3%;">'. $dataVend['PseudoVend'].
                                                '<p style="margin: 5%;">'. $data_article['Description']. '</p>';
                                            if($data_article['VenteBestOffer'] == 1 && $data_article['VenteImmediat'] == 0){
                                                echo '<img src="../img/UI/NegoOrange.png" style="width: 10%; margin:5%;"> <span class="typeVente">NEGOCIATION</span>';
                                            }
                                            if($data_article['VenteEnchere'] == 1){
                                                echo '<img src="../img/UI/enchère.png" style="width: 10%; margin:5%;"> <span class="typeVente">ENCHERE</span>';
                                            } 
                                            if($data_article['VenteImmediat'] == 1 && $data_article['VenteBestOffer'] == 0) {
                                                echo '<img src="../img/UI/immediat.png" style="width: 5%; margin:5%;"> <span class="typeVente">ACHAT IMMEDIAT</span>';
                                            }
                                            if($data_article['VenteImmediat'] == 1 && $data_article['VenteBestOffer'] == 1) {
                                                echo '<img src="../img/UI/immediat.png" style="width: 5%; margin:5%;"> <span class="typeVente">ACHAT IMMEDIAT</span>';
                                                echo '<div style="margin-top: -10%; margin-left: -3%;"> <img src="../img/UI/NegoOrange.png" style="width: 10%; margin:5%;"> <span class="typeVente">NEGOCIATION</span> </div>';
                                            }
                                            echo '
                                                <div class="prixArticle">'.$data_article['Prix'] . '€' . '</div>'.
                                                '</div>'.
                                        '</div>';
                                    }
                                echo '</div>';

                            echo '<div class="row">';
                                echo '<div class="col-lg-3 col-md-3 col-sm-12">';
                                    echo '<h3>Adresse de Livraison: </h3>';
                                    echo '
                                        <table>
                                        <tr>
                                            <td><h5>Adresse Ligne 1: </h5></td>
                                            <td><h5>'. $data_adr["AdrLigne1"]. '</h5></td>
                                        </tr>
                                        <tr>
                                            <td><h5>Adresse Ligne 2: </h5></td>
                                            <td><h5>'. $data_adr["AdrLigne2"]. '</h5></td>
                                        </tr>
                                        <tr>
                                            <td><h5>Ville : <h5></td>
                                            <td><h5>' . $data_adr["Ville"]. '</h5></td>
                                        </tr>
                                        <tr>
                                            <td><h5>Code Postal : <h5></td>
                                            <td><h5> '. $data_adr["CodePostal"] . '</h5></td>
                                        </tr>
                                        <tr>
                                            <td><h5>Pays: </h5></td>
                                            <td><h5>'. $data_adr["Pays"] . '</h5></td>
                                        </tr>
                                        <tr>
                                            <td><h5>Numéro de téléphone: </h5></td>
                                            <td><h5>' . $data_adr["NumTel"] . '</h5></td>
                                        </tr>
                                    </table>';
                                echo '</div>';

                                echo '<div class="col-lg-3 col-md-3 col-sm-12">';
                                    echo '<h3>Moyen de paiement</h3>';
                                    $finCarte = "XXXX XXXX XXXX ";
                                    $finCarte .= substr($data_cb['NumCarte'], 12,15);
                                    echo 'Numéro de carte: ' . $finCarte;  
                                echo '</div>';

                                echo '<div class="col-lg-3 col-md-3 col-sm-12">';
                                echo '<h3>Facturation</h3>';      
                                        $sousTotal = $data_com['Total'] - $data_com['FraisLivraison'];
                                        echo 'Sous-Total: ' . $sousTotal . '€ <br><hr>';
                                        echo 'Livraison: ' . $data_com['FraisLivraison'] . '€ <br><hr>';
                                        echo 'TOTAL: <strong>' . $data_com['Total'] . '</strong>€ ';
                                echo '</div>';

                                echo '<div class="col-lg-3 col-md-3 col-sm-12">';
                                echo '<h3>Date</h3>';
                                    echo $data_com['Date'];
                                echo '</div>';

                            echo '</div>';
                            echo '<hr>';
                            
                            echo '</div>';
                    echo '</div>';
                }
            ?>
        </div>

        <div class="row" style="margin:1%;"> 
            <div class="col-lg-12 col-md-12 col-sm-12" style="margin-bottom: 2%;">
                <form action="Deconnexion.php">
                    <button type="submit" class="btn btn-primary btn-block" style="width: 100%;">DECONNEXION</button>
                </form>
            </div>
        </div>

        <?php include 'footer.php'; ?>
    </body>
</html>
