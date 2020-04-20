<?php
    session_start();
    
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === false){
        header("location: Connexion.php");
        exit;
    }
    //$page;
    //if($_SERVER['PHP_SELF'] == "ComptePerso.php") $page = "ComptePerso.php";
    //if($_SERVER['PHP_SELF'] == "CompteHistorique.php") $page = "CompteHistorique.php";

    //Recherche info user
    $userID = $_SESSION['userID'];
    $user_type = $_SESSION['user_type'];
    $database = "bddebay";
    $db_handle = mysqli_connect('localhost', 'root','');
    $db_found = mysqli_select_db($db_handle, $database);

    if($_SESSION['user_type'] == "Acheteur" ) $sql = "SELECT * FROM acheteur WHERE IDAcheteur=$userID";
    if($_SESSION['user_type'] == "Vendeur" ) $sql = "SELECT * FROM vendeur WHERE IDVendeur=$userID";
    if($_SESSION['user_type'] == "Admin" ) $sql = "SELECT * FROM administrateur WHERE IDAdmin=$userID";

    $result = mysqli_query($db_handle, $sql);
    $data = mysqli_fetch_assoc($result);

    //Recherche adresse
    $sql_adr = "SELECT * FROM adresse WHERE `#IDAcheteur`=$userID";
    $result_adr = mysqli_query($db_handle, $sql_adr);
    $data_adr = mysqli_fetch_assoc($result_adr);

    //Recherche image
    $sql_img = "SELECT * FROM image WHERE `#IDVendeur`=$userID";
    $result_img = mysqli_query($db_handle, $sql_img);
    $i = 0;
    while($data_img = mysqli_fetch_assoc($result_img)){
        if($i == 0) {$data_img1 = $data_img; $i++;}
        else{$data_img2 = $data_img; $i = 0;}
    }
    $img2 = '';
    if($user_type == 'Vendeur'){
        $img2 = $data_img2['CheminImg'];
    }
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

    <body >
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
                    <!--<li class="nav-item"><a class="nav-link" href="ComptePaiement.php">
                        Vos moyens de paiement
                    </a></li>
                    <li class="nav-item"><a class="nav-link" href="CompteSUivi.php">
                        Commandes en cours
                    </a></li>-->
                </ul>
            </div>
        </nav>

        <div style="margin-top:-2.35%; background-size: cover; background-image: url('<?php echo $img2?>'); ">
        <div class="container-fluid" style="background-color : RGBa(255, 255, 255, 0.5); margin-top: 40px;" >
            <div class="row"> 
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <h2>| Informations Personnelles</h2><br>
                    <table>
                        <tr style="display: <?php if($_SESSION['user_type'] != 'Vendeur') echo 'none';?>;">
                            <td><h4>Pseudo: </h4></td>
                            <td><h4><?php if($_SESSION['user_type'] == 'Vendeur') echo '<h4>Pseudo: '. $data['Pseudo']; ?></h4></td>
                        </tr>
                        <tr style="display: <?php if($_SESSION['user_type'] == 'Vendeur') echo 'none';?>;">
                            <td><h4>Nom: </td>
                            <td><h4><?php echo $data['Nom'];?></h4></td>
                        </tr>
                        <tr style="display: <?php if($_SESSION['user_type'] == 'Vendeur') echo 'none';?>;">
                            <td><h4>Prenom : <h4></td>
                            <td><h4><?php echo $data['Prenom'];?></h4></td>
                        </tr>
                        <tr>
                            <td><h4>Adresse Mail : <h4></td>
                            <td><h4><?php echo $data['Mail'];?></h4></td>
                        </tr>
                        <tr>
                            <td><h4>Mot de Passe: </h4></td>
                            <td><h4>••••</h4></td>
                        </tr>
                        <tr style="display: <?php if($_SESSION['user_type'] != 'Acheteur') echo 'none';?>;">
                            <td><h4>CGU: </h4></td>
                            <td><h4><?php if($data['CGU']){echo 'Accepté';} else{echo 'Refusé';}?></h4></td>
                        </tr>
                    </table>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-3" style="display: <?php if($_SESSION['user_type'] != 'Vendeur') echo 'none';?>;"> 
                    <h2>| Photo de Profil</h2>  
                    <img src="<?php echo $data_img1['CheminImg'];?>">
                    <!--<button type="button" class="btn btn-primary btn-block">Upload</button>-->
                </div>

                <div class="col-lg-4 col-md-4 col-sm-3"style="display: <?php if($_SESSION['user_type'] != 'Acheteur') echo 'none';?>;">
                    <h2>| Adresse</h2>
                    <table>
                        <tr>
                            <td><h4>Adresse Ligne 1: </h4></td>
                            <td><h4><?php echo $data_adr['AdrLigne1'];?></h4></td>
                        </tr>
                        <tr>
                            <td><h4>Adresse Ligne 2: </td>
                            <td><h4><?php echo $data_adr['AdrLigne2'];?></h4></td>
                        </tr>
                        <tr>
                            <td><h4>Ville : <h4></td>
                            <td><h4><?php echo $data_adr['Ville'];?></h4></td>
                        </tr>
                        <tr>
                            <td><h4>Code Postal : <h4></td>
                            <td><h4><?php echo $data_adr['CodePostal'];?></h4></td>
                        </tr>
                        <tr>
                            <td><h4>Pays: </h4></td>
                            <td><h4><?php echo $data_adr['Pays'];?></h4></td>
                        </tr>
                        <tr>
                            <td><h4>Numéro de téléphone: </h4></td>
                            <td><h4><?php echo $data_adr['NumTel'];?></h4></td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="row" style="margin-top: 40px;"> 
                <div class="col-lg-12 col-md-12 col-sm-12" style="margin-bottom: 1%;">
                    <form action="Deconnexion.php">
                        <button type="submit" class="btn btn-primary btn-block" style="width: 100%;">DECONNEXION</button>
                    </form>
            </div>
            </div>
        </div>
        </div>
        <?php include 'footer.php'; ?>
    </body>
</html>
