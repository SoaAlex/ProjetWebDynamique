<?php
   ob_start();
?>
<?php
    session_start();
    
    if(!isset($_SESSION["loggedin"])){
        header("location: landingPage.php");
        exit;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Création d'un compte acheteur</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="../CSS/StyleCreation.css">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

        <script type="text/javascript">
            function relais(){
                document.getElementById('affichageRelais1').style.display ='block';
                document.getElementById('affichageRelais2').style.display ='block';
            }
            function Prelais(){
                document.getElementById('affichageRelais1').style.display ='none';
                document.getElementById('affichageRelais2').style.display ='none';
            }

        </script>
    </head>

    <body onLoad="Prelais()">
        
        <?php include 'navbar.php'; ?>
        

		<div class="Titre" style="margin-top: 30px; margin-left: 50px;"><h1>| PROCESSUS DE COMMANDE</h1></div>
		<div class="container-fluid">
		    <div class="row" style="margin-top: 50px;">
		        <div class="col-sm-2" style="height:150px; "></div>
		        <img class="col-sm-1" src="../img/UI/CaddiOrange.png"></img>
		        <img class="col-sm-1" src="../img/UI/DroiteVerte.png"></img>
		        <img class="col-sm-1" src="../img/UI/CamionOrange.png"></img>
		        <img class="col-sm-1" src="../img/UI/DroiteNoir1.png"></img>
		        <img class="col-sm-1" src="../img/UI/CarteBlack.png"></img>
		        <img class="col-sm-1" src="../img/UI/DroiteNoir1.png"></img>
		        <img class="col-sm-1" src="../img/UI/CheckBlack.png"></img>
		    </div>
		</div> 
		<div class="container-fluid">
		    <div class="row" style="margin-top: 20px;">
		        <div class="col-sm-2" style="height:150px;"></div>
		        <div class="col-sm-1" style="width: 20px; height:150px; "><h2>Panier</h2></div>
		        <div class="col-sm-1" style="width: 20px; height:150px; "></div>
		        <div class="col-sm-1" style="width: 20px; height:150px; "><h2>Livraison</h2></div>
		        <div class="col-sm-1" style="width: 20px; height:150px; "></div>
		        <div class="col-sm-1" style="width: 20px; height:150px;"><h2>Paiement</h2></div>
		        <div class="col-sm-1" style="width: 20px; height:150px; "></div>
		        <div class="col-sm-1" style="width: 20px; height:150px; "><h2>Validation</h2></div>
		    </div>
		</div>

        <div class="container-fluid">
            <div class="row" style="margin-top: 20px;"> 
                <div class="col-lg-2 col-md-2 col-sm-2">
                    <h4>| Adresse Enregistrée</h4>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">    
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2">
                    <h4>| Methode d'expédition</h4>
                </div>
            </div>
            <div class="row" style="margin-top: 20px;">      
                <div class="col-lg-2 col-md-2 col-sm-2">
                    <input type="text" class="form-control" id="IDAdresseSave"placeholder=""name="AdresseSave">
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2" >
                    <form action="CommandeCB.php">
                    <div class="btn btn-warning btn-lg btn-block">Valider</div>
                    </form>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2"></div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                   
                    <div class="form-check form-check-inline" style="margin-top: 20px">
                          <input class="form-check-input" type="radio" name="exampleRadios" class="exampleRadios" value="option1" onclick="Prelais()" checked>
                          <label class="form-check-label" for="exampleRadios1" style="width: 200px;  margin-right: 30px;">
                          Express: 10€
                          </label>
                          <input class="form-check-input" type="radio" name="exampleRadios" class="exampleRadios" value="option2" onclick="Prelais()">
                          <label class="form-check-label" for="exampleRadios1" style="width: 200px;  margin-right: 30px;">
                          Standard: 5€
                          </label>
                          <input class="form-check-input" type="radio" name="exampleRadios" class="exampleRadios" value="option3" id="relais" onclick="relais()">
                          <label class="form-check-label" for="exampleRadios1" style="width: 200px;  margin-right: 30px;">
                          Point relais: 3€
                          </label>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 20px;"> 
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <h4>| Nouvelle Adresse</h4><br>
                        <label for="AdresseL1">Adresse Ligne 1</label>
                        <input type="text" class="form-control" id="IDAdresseL1" placeholder="Ex: 8 avenue des Petits Princes" name="AdresseL1">
                        <label for="AdresseL2">Adresse Ligne 2</label>
                        <input type="text" class="form-control" id="IDAdresseL2" placeholder="Ex: Marais" name="AdresseL2">
                        <label for="Ville">Ville</label>
                        <input type="text" class="form-control" id="IDVille" placeholder="Ex: Chamouille" name="Ville">
                        <label for="CodePostal">Code Postal</label>
                        <input type="text" class="form-control" id="IDCodePostal" placeholder="Ex: 75 003" name="CodePostal">
                        <label for="Pays">Pays</label>
                        <input type="text" class="form-control" id="IPays" placeholder="Ex: Guatemala" name="Pays"><br>
                        <label for="Tel">Telephone</label>
                        <input type="text" class="form-control" id="Tel" placeholder="Ex: Guatemala" name="Tel"><br>
                    <div class="btn btn-warning btn-lg btn-block">Valider les informations</button></div>
                </div>
                
                <div class="col-lg-1 col-md-1 col-sm-1"></div>
                
                    <div class="col-lg-4 col-md-4 col-sm-4">        
                     <div id="affichageRelais1" class="Relais"> 
                            <br><hr><h4>| Choix du point de retrait</h4><br>
                            <div class="mon_image">
                                <a href="#"><img src="../img/UI/map.jpg"  style="width: 70%" alt="pc1" /></a>
                            </div>
                     </div>  
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-3"><br><br>
                     <div id="affichageRelais2" class="Relais"> 
                        <label for="AdresseL1">Adresse Ligne 1</label>
                        <input type="text" class="form-control" id="IDAdresseL1" placeholder="Ex: 8 avenue des Petits Princes" name="AdresseL1">
                        
                            
                        <label for="AdresseL2">Adresse Ligne 2</label>
                        <input type="text" class="form-control" id="IDAdresseL2" placeholder="Ex: Marais" name="AdresseL2">
                        
                            
                        <label for="Ville">Ville</label>
                        <input type="text" class="form-control" id="IDVille" placeholder="Ex: Chamouille" name="Ville">
                            
                        
                        <label for="CodePostal">Code Postal</label>
                        <input type="text" class="form-control" id="IDCodePostal" placeholder="Ex: 75 003" name="CodePostal">
                            
                        
                        <label for="Pays">Pays</label>
                        <input type="text" class="form-control" id="ISPays" placeholder="Ex: Guatemala" name="Pays"><br>
                        
                        <div class="btn btn-warning btn-lg btn-block">Valider les informations</button></div><br><br>
                     </div>
                    </div>
                
            </div>
        </div>
    </body>
</html>
