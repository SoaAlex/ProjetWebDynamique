<?php
   ob_start();
?>
<?php
    session_start();
    
    $userID = $_SESSION['userID'];
    $database = "bddebay";
    $db_handle = mysqli_connect('localhost', 'root','');
    $db_found = mysqli_select_db($db_handle, $database);

    if($db_found){
        $sql = "SELECT * FROM adresse WHERE `#IDAcheteur`=$userID LIMIT 1";
        $result = mysqli_query($db_handle, $sql);
        $data = mysqli_fetch_assoc($result);
        $_SESSION['adresse']=$data;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Commande</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="../CSS/StyleCreation.css">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

        <!-- Du jQuerry gratuit -->
        <script type="text/javascript">
            $(document).ready(function(){
                //Par défaut
                $('#affichageRelais1').css('display', 'block');
                $('#affichageRelais2').css('display', 'none');
                $('#affichageRelais3').css('display', 'none');

                //Si clique sur Express, on affiche pas les PR
                $('#Express').click(function(){
                    $('#affichageRelais1').css('display', 'block');
                    $('#affichageRelais2').css('display', 'none');
                    $('#affichageRelais3').css('display', 'none');
                });
                $('#Standard').click(function(){//Sur Standard, pareil
                    $('#affichageRelais1').css('display', 'block');
                    $('#affichageRelais2').css('display', 'none');
                    $('#affichageRelais3').css('display', 'none');
                });
                $('#PR').click(function(){//Sur Point Relais, on affiche
                    $('#affichageRelais1').css('display', 'none');
                    $('#affichageRelais2').css('display', 'block');
                    $('#affichageRelais3').css('display', 'block');
                });
            });
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
                 <?php echo' <p>'.$data["AdrLigne1"].'</p>' ?>
                 </div> 
                 <div class="col-lg-2 col-md-2 col-sm-2" >
                 <form method="POST" action="livraison.php">
                 <button type="submit" class="btn btn-primary btn-block" name="button3">Valider</button>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2"></div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                   
                   
                    <div class="form-check form-check-inline" style="margin-top: 20px">
                   
                          <input class="form-check-input" type="radio" name="Livraison" id="Express" class="exampleRadios" value=10 onclick="Prelais()" checked>
                          <label class="form-check-label" for="exampleRadios1" style="width: 200px;  margin-right: 30px;">
                          Express: 10€
                          </label>
                          <input class="form-check-input" type="radio" name="Livraison" id="Standard" class="exampleRadios" value=5 onclick="Prelais()">
                          <label class="form-check-label" for="exampleRadios1" style="width: 200px;  margin-right: 30px;">
                          Standard: 5€
                          </label>
                          <input class="form-check-input" type="radio" name="Livraison" id="PR" class="exampleRadios" value=3 onclick="relais()">
                          <label class="form-check-label" for="exampleRadios1" style="width: 130px;  margin-right: 30px;">
                          Point relais: 3€
                          </label>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 20px;"> 
                <div class="col-lg-4 col-md-4 col-sm-4">
                
                    <div id="affichageRelais1"> 
                    
                        <h4>| Nouvelle Adresse</h4><br>
                            <label for="AdresseL1">Adresse Ligne 1</label>
                            <input type="text" class="form-control" id="IDAdresseL1" placeholder="Ex: 8 avenue des Petits Princes" name="AdresseL1">
                            <label for="AdresseL2">Adresse Ligne 2</label>
                            <input type="text" class="form-control" id="IDAdresseL2" placeholder="Ex: Marais" name="AdresseL2">
                            <label for="Ville">Ville</label>
                            <input type="text" class="form-control" id="IDVille" placeholder="Ex: Chamouille" name="Ville">
                            <label for="CodePostal">Code Postal</label>
                            <input type="number" class="form-control" id="IDCodePostal" placeholder="Ex: 75 003" name="CP">
                            <label for="Pays">Pays</label>
                            <input type="text" class="form-control" id="IPays" placeholder="Ex: Guatemala" name="pays"><br>
                            <label for="Tel">Telephone</label>
                            <input type="text" class="form-control" id="Tel" placeholder="" name="tel"><br>
                            <button type="submit" class="btn btn-primary btn-block" name="button1">Valider les informations</button>
                        <br>
                        </form>
                    </div>
                </div>
                
                <div class="col-lg-1 col-md-1 col-sm-1"></div>
                
                    <div class="col-lg-4 col-md-4 col-sm-4">        
                     <div id="affichageRelais2" class="Relais"> 
                            <br><hr><h4>| Choix du point de retrait</h4><br>
                            <div class="mon_image">
                                <a href="#"><img src="../img/UI/map.jpg"  style="width: 70%" alt="pc1" /></a>
                            </div>
                     </div>  
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-3"><br><br>
                     <div id="affichageRelais3" class="Relais"> 
                     <form method="POST" action="livraison.php">
                        <label for="AdresseL1">Adresse Ligne 1</label>
                        <input type="text" class="form-control" id="IDAdresseL1" placeholder="Ex: 8 avenue des Petits Princes" name="AdresseL12">
                        
                            
                        <label for="AdresseL2">Adresse Ligne 2</label>
                        <input type="text" class="form-control" id="IDAdresseL2" placeholder="Ex: Marais" name="AdresseL22">
                        
                            
                        <label for="Ville">Ville</label>
                        <input type="text" class="form-control" id="IDVille" placeholder="Ex: Chamouille" name="Ville2">
                            
                        
                        <label for="CodePostal">Code Postal</label>
                        <input type="text" class="form-control" id="IDCodePostal" placeholder="Ex: 75 003" name="CP2">
                            
                        
                        <label for="Pays">Pays</label>
                        <input type="text" class="form-control" id="ISPays" placeholder="Ex: Guatemala" name="pays2"><br>

                        <label for="Tel">Telephone</label>
                        <input type="text" class="form-control" id="Tel" placeholder="" name="tel2"><br>
                        
                        <button type="submit" class="btn btn-primary btn-block" name="button2">Valider les informations</button>
                    </form>
                     </div>
                    </div>
                
            </div>
        </div>
    </body>
</html>
