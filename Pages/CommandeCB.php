<?php
   ob_start();
?>
<?php
    session_start();
    
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        header("location: landingPage.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
        <title>CB</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="../CSS/StyleCreation.css">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    </head>

    <body>
    <?php include 'navbar.php'; ?>

		<div class="Titre" style="margin-top: 30px; margin-left: 50px;"><h1>| PROCESSUS DE COMMANDE</h1></div>
		<div class="container-fluid">
		    <div class="row" style="margin-top: 50px;">
		        <div class="col-sm-2" style="height:150px; "></div>
		        <img class="col-sm-1" src="../img/UI/CaddiOrange.png" style="width: 20px; height:150px; "></img>
		        <img class="col-sm-1" src="../img/UI/DroiteVerte.png" style="width: 20px; height:150px; "></img>
		        <img class="col-sm-1" src="../img/UI/CamionOrange.png" style="width: 20px; height:150px; "></img>
		        <img class="col-sm-1" src="../img/UI/DroiteVerte1.png" style="width: 20px; height:150px; "></img>
		        <img class="col-sm-1" src="../img/UI/CarteOrange.png" style="width: 20px; height:150px; "></img>
		        <img class="col-sm-1" src="../img/UI/DroiteNoir1.png" style="width: 20px; height:150px; "></img>
		        <img class="col-sm-1" src="../img/UI/CheckBlack.png" style="width: 20px; height:150px; "></img>
		    </div>
		</div>
		<div class="container-fluid">
		    <div class="row" style="margin-top: 20px;">
		        <div class="col-sm-2" style="height:150px;"></div>
		        <div class="col-sm-1" style="width: 20px; height:150px; "><h2>Panier</h2></div>
		        <div class="col-sm-1" style="width: 20px; height:150px; "></div>
		        <div class="col-sm-1" style="width: 20px; height:150px; "><h2>Livraison</h2></div>
		        <div class="col-sm-1" style="width: 20px; height:150px; "></div>
		        <div class="col-sm-1" style="width: 20px; height:150px; "><h2>Paiement</h2></div>
		        <div class="col-sm-1" style="width: 20px; height:150px; "></div>
		        <div class="col-sm-1" style="width: 20px; height:150px; "><h2>Validation</h2></div>
		    </div>
		</div>



        <div class="container features">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="form-group"> <!-- Inspiré de https://getbootstrap.com/docs/4.0/components/forms/ -->
                      <!--  <h4>| Carte Enregistrée</h4>
                        <input type="text" class="form-control" id="CB"  placeholder="XXXX XXXX XXX9 9872" name="numeroCBSave"><br>
                        <div class="btn btn-warning btn-lg btn-block">Valider</button></div>
                        </div>
                    -->
                        <h4>| Informations Carte Bancaire</h4>
                        <form method="POST" action="Cb.php">
                        <div class="form-group">
                            <label for="CBnew">Numéro de la carte</label>
                            <input type="text" class="form-control" id="CBnew" placeholder="Ex: XXXX XXXX XXX9 9872" name="numCB" required>
                        </div>
                        <div class="form-group">
                            <label for="Exp">Date d'expiration</label>
                            <input type="text" class="form-control" id="Exp" placeholder="Ex: 07/22" name="Expira" required>
                        </div>
                        <div class="form-group">
                            <label for="IDAcheteur">Détenteur de la carte</label>
                            <input type="text" class="form-control" id="IDAcheteur" placeholder="Ex: Jean Lasalle" name="Acheteur" required>
                        </div>
                        <div class="form-group">
                            <label for="Secu">Code de sécurité </label>
                            <input type="text" class="form-control" id="Secu" placeholder="Ex: 123" name="Secu" required>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="TypeCarte" value="American">
                            <img class="img-fluid" src="../img/UI/AmericanExpress.png" style="width: 200px;  margin-right: 40px;">

                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="TypeCarte" value="MasterCard">
                            <img class="img-fluid" src="../img/UI/MasterCard.png" style="width: 200px;  margin-right: 40px;">
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="TypeCarte" value="Visa" >
                            <img class="img-fluid" src="../img/UI/Visa.png" style="width: 200px;  margin-right: 40px;">

                        </div>

                        <button type="submit" class="btn btn-primary btn-block" name="button1">Valider les informations</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>

        
    </body>
</html>
