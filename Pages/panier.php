<?php
   session_start();
 
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === false){
        header("location: landingPage.php");
        exit;
    }

    $userID = $_SESSION['userID'];
    $database = "bddebay";
    $db_handle = mysqli_connect('localhost', 'root','');
    $db_found = mysqli_select_db($db_handle, $database);

    if($db_found){
        $sql = "SELECT * FROM choixArticles WHERE `#IDAcheteur`=$userID";
        $result = mysqli_query($db_handle, $sql);
        $TOTAL = 0;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Votre Panier</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="../CSS/Panier.css">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    </head>

    <body>
        <?php include 'navbar.php'; ?>

        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <h1>PANIER</h1><br>
                    <h2>| Achats immédiats</h2>
                    <div class="row">
                        <?php 
                            while($data = mysqli_fetch_assoc($result)){
                                //Trouver donner article
                                $article = $data["#IDArticle"];
                                $sql_article = "SELECT * FROM article WHERE `IDArticle`=$article";
                                $result_article = mysqli_query($db_handle, $sql_article);
                                $data_article = mysqli_fetch_assoc($result_article);

                                if($data_article['VenteImmediat'] == 1){
                                    //Ajout au total
                                    $TOTAL += $data_article['Prix'];

                                    //Recherche image article
                                    $sql_img = "SELECT CheminImg AS CheminImg FROM `image` WHERE `#IDArticle`=$article";
                                    $result_img = mysqli_query($db_handle, $sql_img);
                                    $dataImg = mysqli_fetch_assoc($result_img);

                                    //Affichage si conditions remplies
                                    echo '
                                    <div class="col-lg-4 col-md-2 col-sm-12">
                                        <div class="box-article">
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
                                        </span>'.
                                        '<div class="prixArticle">'.$data_article['Prix'] . '€' . '</div>';
                                        ?> 
                                            <a href="DelArticle.php?IDArticle=<?php echo $data_article['IDArticle']; ?>">
                                            <button type="submit" class="btn btn-primary btn-block">SUPPRIMER</button> </a>
                                        <?php 
                                    echo '</div>'.
                                    '</div>';
                                }
                            }

                        ?>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12">
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <h1>TOTAL: <?php echo $TOTAL ?>€</h1>
                            <form action="CommandeLivraison.php">
                                <button type="submit" class="btn btn-primary btn-block" <?php if($TOTAL == 0) echo 'disabled'; ?>>COMMANDER</button>
                            </form>
                        </div>
                    </div>
                    <hr>

                    <br><br>
                    <h2>| Enchères en cours</h2>
                    <div class="row">
                    <?php 
                        //Relancer la requete
                        $sql = "SELECT * FROM choixArticles WHERE `#IDAcheteur`=$userID";
                        $result = mysqli_query($db_handle, $sql);
                        while($data = mysqli_fetch_assoc($result)){
                            //Trouver donner article
                            $article = $data["#IDArticle"];
                            $sql_article = "SELECT * FROM article WHERE `IDArticle`=$article";
                            $result_article = mysqli_query($db_handle, $sql_article);
                            $data_article = mysqli_fetch_assoc($result_article);

                            if($data_article['VenteEnchere'] == 1){
                                //Recherche image article
                                $sql_img = "SELECT CheminImg AS CheminImg FROM `image` WHERE `#IDArticle`=$article";
                                $result_img = mysqli_query($db_handle, $sql_img);
                                $dataImg = mysqli_fetch_assoc($result_img);

                                //Affichage si conditions remplies
                                echo '
                                <div class="col-lg-4 col-md-2 col-sm-12">
                                    <div class="box-article">
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
                                    </span>'.
                                    '<div class="prixArticle">'.$data_article['Prix'] . '€' . '</div>';
                                    ?> 
                                    <a href="DelArticle.php?IDArticle=<?php echo $data_article['IDArticle']; ?>">
                                    <button type="submit" class="btn btn-primary btn-block">SUPPRIMER</button> </a>
                                    <?php 
                                    echo '</div>'.
                                '</div>';
                            }
                        }
                    ?>
                    </div><br><br>

                    <h2>| Négociation en cours</h2>
                    <div class="row">
                    <?php 
                        //Relancer la requete
                        $sql = "SELECT * FROM choixArticles WHERE `#IDAcheteur`=$userID";
                        $result = mysqli_query($db_handle, $sql);
                        while($data = mysqli_fetch_assoc($result)){
                            //Trouver donner article
                            $article = $data["#IDArticle"];
                            $sql_article = "SELECT * FROM article WHERE `IDArticle`=$article";
                            $result_article = mysqli_query($db_handle, $sql_article);
                            $data_article = mysqli_fetch_assoc($result_article);

                            /*//Recherche si article en négo
                            $sql_nego = "SELECT * FROM Negociation WHERE `#IDArticle`=$article AND `#IDAcheteur`=$userID";
                            $result_nego = mysqli_query($db_handle, $sql_nego);
                            if(mysqli_num_rows($result_nego)) {$isNego == 1;}*/                     

                            if($data_article['VenteBestOffer'] == 1){
                                //Recherche image article
                                $sql_img = "SELECT CheminImg AS CheminImg FROM `image` WHERE `#IDArticle`=$article";
                                $result_img = mysqli_query($db_handle, $sql_img);
                                $dataImg = mysqli_fetch_assoc($result_img);

                                //Affichage si conditions remplies
                                echo '
                                <div class="col-lg-4 col-md-2 col-sm-12">
                                    <div class="box-article">
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
                                    </span>'.
                                    '<div class="prixArticle">'.$data_article['Prix'] . '€' . '</div>';
                                    ?> 
                                    <a href="DelArticle.php?IDArticle=<?php echo $data_article['IDArticle']; ?>">
                                    <button type="submit" class="btn btn-primary btn-block">SUPPRIMER</button> </a>
                                    <?php 
                                    echo '</div>'.
                                '</div>';
                            }
                        }
                    ?>
                    </div><br><br>
                </div>
            </div>
        </div>

        <?php include 'footer.php'; ?>

    </body>

</html>