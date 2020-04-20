<?php
    session_start();

    $database = "bddebay";
    $db_handle = mysqli_connect('localhost', 'root','');
    $db_found = mysqli_select_db($db_handle, $database);

    //Si search bar
    if(isset($_POST["nomArt"])){
        $nomArt = $_POST["nomArt"];
        $sql_find = "SELECT * FROM article WHERE Nom LIKE '%$nomArt%' LIMIT 1";
        $result = mysqli_query($db_handle, $sql_find);
        $data_find = mysqli_fetch_assoc($result);
        if(mysqli_num_rows($result) == 0){
            header("location: aucunResult.php");
        }
        else{
            $IDArticle = $data_find["IDArticle"];
        }
    }
    else{ //Si depuis page articles.php
        $IDArticle = $_SESSION['IDArticle'] = $_GET['IDArticle'];
    }
    
    if($db_found){
        //Trouver Article
        $sql = "SELECT * FROM `article` WHERE `IDArticle`=$IDArticle";
        $result = mysqli_query($db_handle, $sql);
        $data = mysqli_fetch_assoc($result);
        //Trouver image
        $sql_img = "SELECT CheminImg AS CheminImg FROM `image` WHERE `#IDArticle`=$IDArticle";
        $result_img = mysqli_query($db_handle, $sql_img);
        $dataImg = mysqli_fetch_assoc($result_img);
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Page Produit</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="../CSS/StyleCreation.css">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    </head>

    <body>
        <?php include 'navbar.php'; ?>

        <div class="container features">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <h1 class="feature-title titre-prod"><?php echo $data['Nom']?></h1>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                        <?php 
                        if($data['VenteBestOffer'] == 1 && $data['VenteImmediat'] == 0){
                            echo '<img src="../img/UI/NegoOrange.png" style="width: 10%; margin:5%;"> <span class="prodVente">NEGOCIATION</span>';
                        }
                        if($data['VenteEnchere'] == 1){
                            echo '<img src="../img/UI/enchère.png" style="width: 10%; margin:0%;"> <span class="prodVente">ENCHERE</span>';
                        } 
                        if($data['VenteImmediat'] == 1 && $data['VenteBestOffer'] == 0) {
                            echo '<img src="../img/UI/immediat.png" style="width: 10%; margin:5%;"> <span class="prodVente">ACHAT IMMEDIAT</span>';
                        }
                        if($data['VenteImmediat'] == 1 && $data['VenteBestOffer'] == 1) {
                            echo '<img src="../img/UI/immediat.png" style="width: 5%; margin:5%;"> <span class="prodVente">ACHAT IMMEDIAT</span>';
                            echo '<div style="margin-top: -10%; margin-left: -3%;"> <img src="../img/UI/NegoOrange.png" style="width: 10%; margin:5%;"> <span class="prodVente">NEGOCIATION</span> </div>';
                        }
                        ?>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <h1 class="feature-title prix-prod"><?php echo $data['Prix']?>€</h1>
                        </div>
                    </div>

                    <img src="<?php echo $dataImg['CheminImg'];?>" class="img-produit img-fluid">
                    <p style="margin-left:10%; margin-right: 10%; margin-top:2%; margin-bottom:2%; font-size:2em;">
                        <?php echo $data['Description']; ?>
                    </p>
                    <form method="POST" action="ajoutPanier.php" style="display: <?php if(!isset($_SESSION['user_type'])){
                            echo 'none';}
                            else if($_SESSION['user_type'] != 'Acheteur'){
                                echo 'none';}
                            ?> ">
                    <?php 
                        if($data['VenteBestOffer'] == 1 && $data['VenteImmediat'] == 0){
                            echo '<input type="number" class="form-control" id="prixNego" placeholder="Quel Prix souhaitez vous négocier ?" name="prixNego" required>';
                            echo '<button type="submit" class="btn btn-primary btn-block" name="buttonNego">Négocier</button>';
                        }
                        if($data['VenteEnchere'] == 1){
                            echo '<input type="number" class="form-control" id="prixEnchere" placeholder="Quel Prix souhaitez vous enchérir ?" name="prixEnchere" required>';
                            echo '<button type="submit" class="btn btn-primary btn-block" name="buttonEnchere">Enchérir</button>';
                        } 
                        if($data['VenteImmediat'] == 1 && $data['VenteBestOffer'] == 0) {
                            echo '<button type="submit" class="btn btn-primary btn-block" name="buttonImmediat">Ajouter au panier</button>';
                        }
                        if($data['VenteImmediat'] == 1 && $data['VenteBestOffer'] == 1) {
                            echo'
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <input type="number" class="form-control" id="prixNego" placeholder="Quel Prix souhaitez vous négocier ?" name="prixNego">
                                        <button type="submit" class="btn btn-primary btn-block" name="buttonNego">Négocier</button>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <button type="submit" class="btn btn-primary btn-block" name="buttonImmediat" style="height:100%; margin-top:0%;">Ajouter au panier</button>
                                    </div>
                                </div
                            ';
                        }

                    ?>
                    </form>
                </div>
            </div>
        </div>

    <?php include 'footer.php'; ?>

    </body>
</html>
