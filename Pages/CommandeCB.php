<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Création d'un compte acheteur</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="../CSS/CommandeCB.css.css">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>



    </head>

    <body>
        <!-- BARRE DE NAVIGATION INSPIREE DU TP7-->
        <nav class="navbar navbar-expand-md"><!-- ManqueS lienS -->
            <a class="navbar-brand" href="#"><img class="img-fluid navbar-img" src="img/Logo.png" style="width: 120px; height: 70px;"></a> 
            <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#main-navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse Cstart" id="main-navigation">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="#">CATEGORIES</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">ACHETER</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">VENDRE</a></li>
                </ul>
            </div>
            <div class="collapse navbar-collapse Cend" id="main-navigation">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="#">
                        <img class="img-fluid navbar-img" src="img/PanierBlanc.png" style="width: 20px; margin-right: 5px;">PANIER
                    </a></li>
                    <li class="nav-item"><a class="nav-link" href="#">
                        <img class="img-fluid navbar-img" src="img/loupe.png" style="width: 20px; margin-right: 5px;">
                    </a></li>
                    <li class="nav-item"><a class="nav-link" href="#">
                        <img class="img-fluid navbar-img" src="img/notif.png" style="width: 20px; margin-right: 5px;">
                    </a></li>
                    <li class="nav-item"><a class="nav-link" href="#">
                        <img class="img-fluid navbar-img" src="img/account.png" style="width: 20px; margin-right: 5px;">
                    </a></li>
                </ul>
            </div>
        </nav>

		<div class="Titre" style="margin-top: 30px; margin-left: 50px;"><h1>| PROCESSUS DE COMMANDE</h1></div>
		<div class="container-fluid">
		    <div class="row" style="margin-top: 50px;">
		        <div class="col-sm-2" style="height:150px; "></div>
		        <img class="col-sm-1" src="img/CaddiOrange.png" style="width: 20px; height:150px; "></img>
		        <img class="col-sm-1" src="img/DroiteVerte.png" style="width: 20px; height:150px; "></img>
		        <img class="col-sm-1" src="img/CamionOrange.png" style="width: 20px; height:150px; "></img>
		        <img class="col-sm-1" src="img/DroiteVerte1.png" style="width: 20px; height:150px; "></img>
		        <img class="col-sm-1" src="img/CarteOrange.png" style="width: 20px; height:150px; "></img>
		        <img class="col-sm-1" src="img/DroiteVerte.png" style="width: 20px; height:150px; "></img>
		        <img class="col-sm-1" src="img/CheckGreen.png" style="width: 20px; height:150px; "></img>
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
                        <h4>| Carte Enregistré</h4>
                        <input type="text" class="form-control" id="CB"  placeholder="XXXX XXXX XXX9 9872" name="numeroCBSave"><br>
                        <div class="btn btn-warning btn-lg btn-block">Valider</button></div>
                        </div>

                        <br><hr><h4>| Nouvelle carte</h4>
                        <div class="form-group">
                            <label for="CBnew">Numéro de la carte</label>
                            <input type="text" class="form-control" id="CBnew" placeholder="Ex: XXXX XXXX XXX9 9872" name="numeroCBNew">
                        </div>
                        <div class="form-group">
                            <label for="Secu">3 Chiffes de sécurité </label>
                            <input type="text" class="form-control" id="Secu" placeholder="Ex: 123" name="C_Secu">
                        </div>
                        <div class="form-group">
                            <label for="Exp">Date d'expiration</label>
                            <input type="text" class="form-control" id="Exp" placeholder="Ex: 07/22" name="Expira">
                        </div>
                        <div class="form-group">
                            <label for="IDAcheteur">Détenteur de la carte</label>
                            <input type="text" class="form-control" id="IDAcheteur" placeholder="Ex: Jean Lasalle" name="Acheteur">
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="blankRadio" id="blankRadio1" value="option1">
                            <img class="img-fluid" src="img/AmericanExpress.png" style="width: 200px;  margin-right: 40px;">

                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="blankRadio" id="blankRadio2" value="option2">
                            <img class="img-fluid" src="img/MasterCard.png" style="width: 200px;  margin-right: 40px;">

                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="blankRadio" id="blankRadio3" value="option3" >
                            <img class="img-fluid" src="img/Visa.png" style="width: 200px;  margin-right: 40px;">

                        </div>

                        <div class="btn btn-warning btn-lg btn-block">Valider les informations</button></div>
                    </div>
                </div>
            </div>
        </div>

        
    </body>
</html>
