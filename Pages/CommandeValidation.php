<?php
   ob_start();
?>
<?php
    session_start();
	$userID = $_SESSION['userID'];
	$userAdresse = $_SESSION['adresse'];
    $database = "bddebay";
    $db_handle = mysqli_connect('localhost', 'root','');
    $db_found = mysqli_select_db($db_handle, $database);
    $adresse = $_SESSION['adresse'];
    $solde=$_SESSION['SoldeRestant'];

    if($db_found){
        $sql = "SELECT * FROM choixarticles WHERE `#IDAcheteur`=$userID";
        $result = mysqli_query($db_handle, $sql);
        $TOTAL = $_SESSION['liv'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
        <title>Validation</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="../CSS/StyleCreation.css">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

        <script type="text/javascript">

            function Solde(total){
                
                var solde = <?php echo json_encode($solde); ?>;

                if(solde >= total)
                {
                    window.location = "CommandeMerci.php";
                }
                else{
                    document.getElementById('MnqArgent').style.display ='block';
                }
            }
        </script>
    </head>

    <body>
<<<<<<< HEAD
		<?php include 'navbar.php'; ?>

=======
	<?php include 'navbar.php'; ?>
>>>>>>> ft_adrien_69
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

		<div class="Sous_Titre" style="margin-left: 20px;"><h3>| Articles</h3></div>

		<div class="container">
        	<div class="row">
    			<?php 
                            while($data = mysqli_fetch_assoc($result)){
                                $article = $data["#IDArticle"];
                                $sql_article = "SELECT * FROM article WHERE `IDArticle`=$article";
                                $sql_nego = "SELECT * FROM negociation WHERE `#IDArticle`=$article";
                                $result_negociation = mysqli_query($db_handle, $sql_nego);
                                $result_article = mysqli_query($db_handle, $sql_article);
                                $data_article = mysqli_fetch_assoc($result_article);

                                if(mysqli_num_rows($result_negociation)==0)
                                {
                                    if($data_article['VenteImmediat'] == 1){
                                        //Ajout au total
                                        $TOTAL += $data_article['Prix'];
    
                                        //Recherche image article
                                        $sql_img = "SELECT CheminImg AS CheminImg FROM `image` WHERE `#IDArticle`=$article";
                                        $result_img = mysqli_query($db_handle, $sql_img);
                                        $dataImg = mysqli_fetch_assoc($result_img);
    
                                        //Affichage si conditions remplies
                                        echo '
                                        <div class="col-lg-4 col-md-2 col-sm-12">
                                            <div class="box-article">
                                            <a href="http://localhost/ProjetWebDynamique/Pages/produit.php?IDArticle=' . $data_article['IDArticle'] . '">'.
                                            '<img src="'. $dataImg['CheminImg'] .'" style="width: 100%;" class="img-fluid">'.
                                            '</a>'.
                                            '<h2 style="margin-left: 5%;">'. $data_article['Nom'] . '</h2>';
                                        
                                        $IDVendeur = $data_article['#IDVendeur'];
                                        $sql_vend = "SELECT Pseudo AS PseudoVend FROM `Vendeur` WHERE `IDVendeur`=$IDVendeur";
                                        $result_vend = mysqli_query($db_handle, $sql_vend);
                                        $dataVend = mysqli_fetch_assoc($result_vend);
                                        echo '
                                            <img src="../img/UI/CaddiOrange.png" style="width: 8%; margin-left: 5%; margin-right: 3%;">'. $dataVend['PseudoVend'].
                                            '<p style="margin: 5%;">'. $data_article['Description']. '</p>';
                                        if($data_article['VenteBestOffer'] == 1 && $data_article['VenteImmediat'] == 0){
                                            echo '<img src="../img/UI/NegoOrange.png" style="width: 10%; margin:5%;"> <span class="typeVente">NEGOCIATION</span>';
                                        }
                                        if($data_article['VenteEnchere'] == 1){
                                            echo '<img src="../img/UI/enchère.png" style="width: 10%; margin:5%;"> <span class="typeVente">ENCHERE</span>';
                                        } 
                                        if($data_article['VenteImmediat'] == 1 && $data_article['VenteBestOffer'] == 0) {
                                            echo '<img src="../img/UI/immediat.png" style="width: 5%; margin:5%;"> <span class="typeVente">ACHAT IMMEDIAT</span>';
                                        }
                                        if($data_article['VenteImmediat'] == 1 && $data_article['VenteBestOffer'] == 1) {
                                            echo '<img src="../img/UI/immediat.png" style="width: 5%; margin:5%;"> <span class="typeVente">ACHAT IMMEDIAT</span>';
                                            echo '<div style="margin-top: -10%; margin-left: -3%;"> <img src="../img/UI/NegoOrange.png" style="width: 10%; margin:5%;"> <span class="typeVente">NEGOCIATION</span> </div>';
                                        }
                                        echo '
                                            </span>'.
                                            '<div class="prixArticle">'.$data_article['Prix'] . '€' . '</div>'.
                                            '</div>'.
                                        '</div>';
                                    }

                                }
                               
                            }

                        ?>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12">
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <?php echo'<div>Votre Commande sera livrée à l\'adresse : ' .$adresse['AdrLigne1']. '</div>'?>
                            <h1>TOTAL: <?php echo $TOTAL ?>€</h1> 
                           <?php $_SESSION['Total']=$TOTAL ?>
                            <form method="POST" action="AttrArticle.php"> 
                                <button type="submit" class="btn btn-primary btn-block" name='button1' onclick="Solde(<?php echo json_encode($TOTAL); ?>)">COMMANDER</button>
                            </form>
                            <div id='MnqArgent' style="display:none">Valeur de la commande supérieure au Solde de votre CB <br> 
                            <button type="submit" class="btn btn-primary btn-block" onclick="header('Location: landingPage.php')">Retour à la page d'accueil</button></div>
                            <br> <br> <br>
                        </div>
                    </div>
                    <hr>
			</div>
		</div>

    </body>
</html>