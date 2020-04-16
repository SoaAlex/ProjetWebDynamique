<?php
   session_start();
 
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === false){
        header("location: landingPage.php");
        exit;
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
                    <h2>| Achats possibles</h2>
                    <div class="row">
                        <div class="col-lg-4 col-md-2 col-sm-12">
                            <?php include '../PHP/panier.php'; ?>
                        </div>
                    </div><br><br>

                    <h2>| Enchères en cours</h2>
                    <div class="row">
                        <div class="col-lg-4 col-md-2 col-sm-12">
                            <div class="box-article">
                                <img src="../img/Articles/anneau.jpg" style="width: 100%;">
                                <h2 style="margin-left: 5%;">Anneau</h2>
                                <img src="../img/UI/CaddiOrange.png" style="width: 8%; margin-left: 5%; margin-right: 3%;">M.Collectionneur
                                <p style="margin: 5%;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                                    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                                </p>
                                <img src="../img/UI/NegoOrange.png" style="width: 10%; margin:5%;"> <span class="typeVente">NEGOCIATION</psan>
                                <span class="prixArticle">200€</span>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-2 col-sm-12">
                            <div class="box-article">
                                <img src="../img/Articles/anneau.jpg" style="width: 100%;">
                                <h2 style="margin-left: 5%;">Anneau</h2>
                                <img src="../img/UI/CaddiOrange.png" style="width: 8%; margin-left: 5%; margin-right: 3%;">M.Collectionneur
                                <p style="margin: 5%;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                                    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                                </p>
                                <img src="../img/UI/NegoOrange.png" style="width: 10%; margin:5%;"> <span class="typeVente">NEGOCIATION</psan>
                                <span class="prixArticle">200€</span>
                            </div>
                        </div>
                        
                        <div class="col-lg-4 col-md-2 col-sm-12">
                            
                        </div>
                    </div><br><br>

                    <h2>| Négociation en cours</h2>

                </div>
        </div>

        <?php include 'footer.php'; ?>

    </body>
</html>