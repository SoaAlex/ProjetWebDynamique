<?php
    session_start();
    
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === false){
        header("location: Connexion.php");
        exit;
    }

    $userID = $_SESSION["userID"];
    $database = "bddebay";
    $db_handle = mysqli_connect('localhost', 'root','');
    $db_found = mysqli_select_db($db_handle, $database);

    if($_SESSION['user_type'] == "Acheteur"){
        $sql_nego = "SELECT * FROM negociation WHERE `#IDAcheteur`=$userID";
        $result_nego = mysqli_query($db_handle, $sql_nego);
    }
    else if($_SESSION['user_type'] == "Vendeur"){
        $sql_nego = "SELECT * FROM negociation WHERE `#IDVendeur`=$userID";
        $result_nego = mysqli_query($db_handle, $sql_nego);
    }

    $dernierTour = '';
    $afficher = 'none';
    $but = 0;

?>

<!DOCTYPE html>
<html>
    <head>
        <title></title>
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
            <!-- NEGOCIATION (Vendeur/Acheteur) -->
            <div style="display: <?php if($_SESSION['user_type'] == 'Admin') echo 'none';?>">
            <h2>| Négociations à répondre</h2>
                        <?php
                            //Pour chaque négo
                            while($data_nego = mysqli_fetch_assoc($result_nego)){ 
                                if($data_nego['NBNego'] != 9)  {//Si c'est le dernier tour de l'acheteur
                                    $dernierTour = 'none';
                                }
                                if((($data_nego['NBNego'] % 2 != 0) || ($data_nego['NBNego'] == 1)) && ($_SESSION['user_type'] == "Acheteur")){ //Si c'est au tour de l'acheteur
                                    $afficher = '';
                                }
                                if(($data_nego['NBNego'] % 2 == 0) && ($_SESSION['user_type'] == "Vendeur")){ //Si c'est au tour de l'acheteur
                                    $afficher = '';
                                }

                                //Recherche image article
                                $article = $data_nego['#IDArticle'];
                                $sql_img = "SELECT CheminImg AS CheminImg FROM `image` WHERE `#IDArticle`=$article";
                                $result_img = mysqli_query($db_handle, $sql_img);
                                $dataImg = mysqli_fetch_assoc($result_img);

                                //Recherche IDVendeur
                                $sql_article = $sql_vend = "SELECT * FROM `article` WHERE `IDArticle`=$article";
                                $result_article = mysqli_query($db_handle, $sql_article);
                                $data_article = mysqli_fetch_assoc($result_article);

                                //Recherche Vendeur
                                $IDVendeur = $data_article['#IDVendeur'];
                                $sql_vend = "SELECT Pseudo AS PseudoVend FROM `Vendeur` WHERE `IDVendeur`=$IDVendeur";
                                $result_vend = mysqli_query($db_handle, $sql_vend);
                                $dataVend = mysqli_fetch_assoc($result_vend);
                                ?>

                                <!--Affichage-->
                                <div class="row" style="display:<?php echo $afficher;?>">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="box-article">
                                            <a href="http://localhost/ProjetWebDynamique/Pages/produit.php?IDArticle= <?php echo $data_article['IDArticle']; ?> ">
                                            <img src="<?php echo $dataImg['CheminImg'];?>" style="width: 100%;" class="img-fluid">
                                            </a>
                                            <h1 style="margin-left: 5%;"> <?php echo $data_article['Nom']; ?></h1>

                                            <?php echo '
                                                <img src="../img/UI/CaddiOrange.png" style="width: 8%; margin-left: 5%; margin-right: 3%;"> <span style="font-size: x-large;">'. $dataVend['PseudoVend']. '</span>'.
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
                                            } ?>
                                            <div class="prixArticle"> <?php echo $data_article['Prix']; ?>€</div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12"> 
                                        <h1>Dernière offre proposée par <?php if($_SESSION['user_type'] == 'Acheteur'){echo 'le vendeur';} else{echo "l'acheteur";} ?>: </h1>
                                        <h1 style="text-align: center; font-size:5em; color:#DF6D14;"><?php echo $data_nego['DerniereOffre'];?>€</h1>
                                        <form method="POST" action="negociation.php">
                                            <div class="form-group">
                                                <input type="submit" name="BA<?php echo $data_nego['IDNego'];?>" value="ACCEPTER" class="btn btn-primary btn-block" style="width: 100%; background-color:green; border: solid 3px green;">
                                                <br>
                                                <input type="text" class="form-control <?php if($dernierTour == '') echo 'is-invalid';?>" style="width:100%; margin-bottom:-2%;" placeholder="Entre ici votre nouvelle offre" name="derniereOffre">
                                                <div class="invalid-feedback" style="width:100%; margin-top:2%; display:<?php echo $dernierTour?>;">
                                                    ATTENTION: Il s'agit de votre dernière offre !
                                                </div>
                                                <input type="submit" name="BN<?php echo $data_nego['IDNego'];?>" value="PROPOSER UNE NOUVELLE OFFRE" class="btn btn-primary btn-block" style="width: 100%; background-color:#DF6D14; border: solid 3px #DF6D14;">
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <?php }?>
            </div>

            <!-- ENCHERES (Admin) -->
            <div style="display: <?php if($_SESSION['user_type'] == 'Admin') echo 'none';?>">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        
                    </div>
                </div>
            </div>
        </div>

        <?php include 'footer.php'; ?>
    </body>
</html>
