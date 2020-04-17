<?php
    session_start();
    
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === false){
        header("location: Connexion.php");
        exit;
    }
    $page;
    if($_SERVER['PHP_SELF'] == "ComptePerso.php") $page = "ComptePerso.php";
    if($_SERVER['PHP_SELF'] == "CompteHistorique.php") $page = "CompteHistorique.php";

    //Recherche info user
    $userID = $_SESSION['userID'];
    $database = "bddebay";
    $db_handle = mysqli_connect('localhost', 'root','');
    $db_found = mysqli_select_db($db_handle, $database);

    if($_SESSION['user_type'] == "Acheteur" ) $sql = "SELECT * FROM acheteur WHERE 'IDAcheteur'=$userID";
    if($_SESSION['user_type'] == "Vendeur" ) $sql = "SELECT * FROM vendeur WHERE 'IDVendeur'=$userID";
    if($_SESSION['user_type'] == "Admin" ) $sql = "SELECT * FROM administrateur WHERE 'IDAdmin'=$userID";

    $result = mysqli_query($db_handle, $sql);
    $data = mysqli_fetch_assoc($result);
    $data['Pseudo']
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Votre compte</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="../CSS/StyleCreation.css">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    </head>

    <body>
        <?php include 'navbar.php'; ?>
        <nav class="navbar navbar-expand-md" style="background-color:#f59d42;">
            <div class="collapse navbar-collapse Cstart" id="main-navigation">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link">
                        Coordonnées
                    </a></li>
                    <li class="nav-item"><a class="nav-link" href="CompteHistorique.php">
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
            <div class="row" style="margin-top: 40px;"> 
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <h2>| Informations Personnelles</h2><br>
                        <?php if($_SESSION['user_type'] == 'Vendeur') echo '<h4>Pseudo:'. $data['Pseudo'] . '</h4>'; ?>
                        <?php if($_SESSION['user_type'] != 'Vendeur') echo '<h4>Nom:'. $data['Nom'] . '</h3>'; ?>
                        <?php if($_SESSION['user_type'] != 'Vendeur') echo '<h4>Prenom:'. $data['Prenom'] . '</h4>'; ?>
                        <h4>Adresse Mail: <?php echo $data['Mail'];?></h4>
                        <h4>Mot de passe: ••••</h4>

                </div>
                <div class="col-lg-4 col-md-4 col-sm-3"> 
                    <h2>| Photo de Profil</h2>  
                    <div class="mon_image">
                        <a href="#"><img src="img/tete.png"  style="width: auto; height: 300px; margin-left: -20px;" alt="pc1" /></a>    
                    </div>
                    <button type="button" class="bouton" style="width: 275px; height: 40px; background-color: orange; border-color: orange;">Upload</button>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-3">
                    <h2>| Adresse</h2>
                </div>
            </div>
            <div class="row" style="margin-top: 40px;"> 
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <form action="Deconnexion.php">
                        <button type="submit" class="btn btn-primary btn-block" style="width: 100%;">DECONNEXION</button>
                    </form>
            </div>
            </div>
        </div>
        <?php include 'footer.php'; ?>
    </body>
</html>
