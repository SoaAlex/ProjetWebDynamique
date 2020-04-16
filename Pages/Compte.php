<?php
   ob_start();
   session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Page d'accueil</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="../CSS/StyleCreation.css">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    </head>

    <body>
        <!-- BARRE DE NAVIGATION INSPIREE DU TP7-->
        <nav class="navbar navbar-expand-md"><!-- ManqueS lienS -->
            <a class="navbar-brand" href="landingPage.html"><img class="img-fluid navbar-img" src="../img/UI/logo.png" style="width: 120px; height: 80px;"></a> 
            <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#main-navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse Cstart" id="main-navigation">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="#">CATEGORIES</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">ACHETER</a></li>
                    <?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
                    echo '<li class="nav-item"><a class="nav-link" href="/HTML/Formulaires/AjoutProduit.html">VENDRE</a></li>'
                    ?>
                </ul>
            </div>
            <div class="collapse navbar-collapse Cend" id="main-navigation">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="#">
                        <img class="img-fluid navbar-img" src="../img/UI/loupe.png" style="width: 20px; margin-right: 5px;">
                    </a></li>
                    <?php if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === false)
                    echo'
                    <li class="nav-item"><a class="nav-link" href="CreationAcheteur.html">
                        Inscription
                    </a></li>
                    <li class="nav-item"><a class="nav-link" href="Connexion.php">
                        Connexion
                    </a></li>'
                    ?>
                    <?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
                        echo'
                        <li class="nav-item"><a class="nav-link" href="panierHTML.php">
                        <img class="img-fluid navbar-img" src="../img/UI/PanierBlanc.png" style="width: 20px; margin-right: 5px;">PANIER
                        </a></li>
                        <li class="nav-item"><a class="nav-link" href="#">
                            <img class="img-fluid navbar-img" src="../img/UI/loupe.png" style="width: 20px; margin-right: 5px;">
                        </a></li>
                        <li class="nav-item"><a class="nav-link" href="#">
                            <img class="img-fluid navbar-img" src="../img/UI/notif.png" style="width: 20px; margin-right: 5px;">
                        </a></li>
                        <li class="nav-item"><a class="nav-link" href="#">
                            <img class="img-fluid navbar-img" src="../img/UI/account.png" style="width: 20px; margin-right: 5px;">
                        </a></li>'
                    ?>
                </ul>
            </div>
        </nav>

        <div id="content-wrapper">
            <div class="container">
                <h3>| Informations du compte</h3>

                <form action="Deconnexion.php">
                    <button type="submit" class="btn btn-primary btn-block">DECONNEXION</button>
                </form>
        </div>
        </div>