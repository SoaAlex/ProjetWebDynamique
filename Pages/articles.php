<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Liste d'article</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="../CSS/Panier.css">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    </head>

    <body>
        <?php include 'navbar.php'; ?>

        <div id="content-wrapper" style="margin-top: 2%;">
            <div class="container" >
                <div class="row">
                    <!-- CONNEXION A LA BDD ET AFFICHAGE DE TOUT LES ARTICLES -->
                    <?php
                        $database = "bddebay";
                        $db_handle = mysqli_connect('localhost', 'root','');
                        $db_found = mysqli_select_db($db_handle, $database);

                        if($db_found){
                            $sql = "SELECT * FROM article";
                            $result = mysqli_query($db_handle, $sql);
                            if(mysqli_num_rows($result) !=0){
                                while($data = mysqli_fetch_assoc($result)){
                                    //Verif si article pas commandé
                                    if($data['#IDCommande'] == NULL){
                                        //Trouver image
                                        $IDArticle = $data['IDArticle'];
                                        $sql_img = "SELECT CheminImg AS CheminImg FROM `image` WHERE `#IDArticle`=$IDArticle";
                                        $result_img = mysqli_query($db_handle, $sql_img);
                                        $dataImg = mysqli_fetch_assoc($result_img);
                                        echo '
                                        <div class="col-lg-4 col-md-2 col-sm-12">
                                            <div class="box-article">
                                            <a href="http://localhost/ProjetWebDynamique/Pages/produit.php?IDArticle=' . $data['IDArticle'] . '">'.
                                            '<img src="'. $dataImg['CheminImg'] .'" style="width: 100%;" class="img-fluid">'.
                                            '</a>'.
                                            '<h2 style="margin-left: 5%;">'. $data['Nom'] . '</h2>';
                                        
                                        $IDVendeur = $data['#IDVendeur'];
                                        $sql_vend = "SELECT Pseudo AS PseudoVend FROM `Vendeur` WHERE `IDVendeur`=$IDVendeur";
                                        $result_vend = mysqli_query($db_handle, $sql_vend);
                                        $dataVend = mysqli_fetch_assoc($result_vend);
                                        echo '
                                            <img src="../img/UI/CaddiOrange.png" style="width: 8%; margin-left: 5%; margin-right: 3%;">'. $dataVend['PseudoVend'].
                                            '<p style="margin: 5%;">'. $data['Description']. '</p>';
                                        if($data['VenteBestOffer'] == 1 && $data['VenteImmediat'] == 0){
                                            echo '<img src="../img/UI/NegoOrange.png" style="width: 10%; margin:5%;"> <span class="typeVente">NEGOCIATION</span>';
                                        }
                                        if($data['VenteEnchere'] == 1){
                                            echo '<img src="../img/UI/enchère.png" style="width: 10%; margin:5%;"> <span class="typeVente">ENCHERE</span>';
                                        } 
                                        if($data['VenteImmediat'] == 1 && $data['VenteBestOffer'] == 0) {
                                            echo '<img src="../img/UI/immediat.png" style="width: 5%; margin:5%;"> <span class="typeVente">ACHAT IMMEDIAT</span>';
                                        }
                                        if($data['VenteImmediat'] == 1 && $data['VenteBestOffer'] == 1) {
                                            echo '<img src="../img/UI/immediat.png" style="width: 5%; margin:5%;"> <span class="typeVente">ACHAT IMMEDIAT</span>';
                                            echo '<div style="margin-top: -10%; margin-left: -3%;"> <img src="../img/UI/NegoOrange.png" style="width: 10%; margin:5%;"> <span class="typeVente">NEGOCIATION</span> </div>';
                                        }
                                        echo '
                                            </span>'.
                                            '<div class="prixArticle">'.$data['Prix'] . '€' . '</div>'.
                                            '</div>'.
                                        '</div>';
                                    }
                                }
                            }
                        }
                    ?>

                </div>
            </div>
        </div>

        <?php include 'footer.php'; ?>

    </body>
</html>
