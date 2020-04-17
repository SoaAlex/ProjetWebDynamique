<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Création d'un compte acheteur</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="../CommandeValidation.css">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    </head>

    <body>
		<?php include 'navbar.php'; ?>

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

		<div class="Sous_Titre" style="margin-left: 20px;"><h3>| Articles</h3></div>

		<div class="container">
        	<div class="row">
    			<div class="col-lg-4 col-md-2 col-sm-12">
        			<div class="box-article">
            			<img src="img/image1.jpg" style="width: 100%;">
            			<h2 style="margin-left: 5%;">BitCoin</h2>
            			<img src="img/CaddiOrange.png" style="width: 8%; margin-left: 5%; margin-right: 3%;">M.Collectionneur
            			<p style="margin: 5%;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  
            			</p>
            			<img src="img/NegoOrange.png" style="width: 10%; margin:5%;"> <span class="typeVente">ENCHERE</span>
            			<span class="prixArticle">2 000€</span>
        			</div>
    			</div>
	    		<div class="col-lg-4 col-md-2 col-sm-12">
	       			<div class="box-article">
	           			<img src="img/image2.jpg" style="width: 344px; height: 260px;">
	            		<h2 style="margin-left: 5%;">Anneau</h2>
	            		<img src="img/CaddiOrange.png" style="width: 8%; margin-left: 5%; margin-right: 3%;">M.Collectionneur
	            		<p style="margin: 5%;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  
	            		</p>
	            		<img src="img/NegoOrange.png" style="width: 10%; margin:5%;"> <span class="typeVente">NEGOCIATION</span>
	            		<span class="prixArticle">3 000€</span>
	        		</div>
	    		</div>
    
    			<div class="col-lg-4 col-md-2 col-sm-12"></div>

			</div>
		</div>
		<div class="container">
        	<div class="row" style="margin-top: 20px;">

    			<div class="col-lg-4 col-md-2 col-sm-12">
					<h3>| Adresse de livraison</h3>
                    <div class="decale"></div>
					<p>Adresse Ligne 1 : 37 Quai Grenelle<br><br>
					Adresse Ligne 2 : Beaugrenelle<br><br>
                    Ville : Paris<br><br>
                    Code Postal : 75 015<br><br>
                    Pays : France<br><br>
                    Téléphone : 07-07-07-07-07</p>
                <br><br><br>
            </div>

    			<div class="col-lg-4 col-md-2 col-sm-12">
    				<h3>| Moyen de payement</h3>
                    <div class="decale"></div>
					<p>Type carte :<br> <br>
					Numéro de carte : XXXX XXXX XXX9 9782<br><br>
                    3 derniers chiffres:   XXX <br><br>
                    Nom du détenteur: HINA MANOLO</p></div>

    			<div class="col-lg-4 col-md-2 col-sm-12">
					<h3>| Facturation</h3>
					<p>
                    <div class="bordure">Sous-total : 5 000€</div>
                    <div class="bordure">Livraison : 15€</div>
                    <div class="text">TOTAL : 5 015€</p></div>
                </div>
					
			</div>
		</div>

		<div class="container">
			<button type="button" class="btn btn-warning btn-lg btn-block">Valider la commande</button>
            <br><br>
    </body>
</html>