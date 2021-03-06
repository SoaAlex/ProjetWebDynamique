<?php
    session_start();
    
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === false){
        header("location: Connexion.php");
        exit;
}
?>

<head>
        <title>Ajouter un produit</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="../CSS/StyleCreation.css">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

        <script type="text/javascript">
            function blocage1(){
            if(document.getElementById('inEncheres').checked == true)
            {
                document.getElementById('inAchatImmediat').disabled = true;
                document.getElementById('inBestOffer').disabled = true;
                document.getElementById('prixAff').innerHTML = "Prix de départ de l'enchere (en €)";
            }
            else{
                document.getElementById('inAchatImmediat').disabled = false;
                document.getElementById('inBestOffer').disabled = false;
            }
            }

            function blocage2(){
            if(document.getElementById('inAchatImmediat').checked==true||document.getElementById('inBestOffer').checked==true)
            {
                document.getElementById('inEncheres').disabled = true;
                document.getElementById('prixAff').innerHTML = "Prix de vente (en €)";
            }
            else
            {
                document.getElementById('inEncheres').disabled = false;
            }
            }
        </script>
    </head>

    <body>
        <?php include 'navbar.php'; ?>
        <!DOCTYPE html>

        <div class="container features">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <h1 class="feature-title">Mise en vente d'un produit</h1>

                    <form method="POST" action="ajoutArticle.php"> 
                        <h4>| Informations produit</h4>

                        <!-- Inspiré de https://getbootstrap.com/docs/4.0/components/forms/ -->
                        <div class="form-group">
                            <label for="inNom">Nom du produit</label>
                            <input type="text" class="form-control" id="inNom" placeholder="Ex: Pièces de monnaie" name="nom" required>
                        </div>

                        <label>Type de produit:&nbsp;&nbsp;&nbsp;</label>
                        <div class="form-group">
                            <div class="custom-control custom-radio custom-control-inline">
                                    <input class="form-check-input" type="radio" name="typeProd" id="inFerrailleOuTresor" value="FerrailleOuTresor">
                                    <label class="form-check-label" for="inFerrailleOuTresor">Ferraille ou Trésor</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                    <input class="form-check-input" type="radio" name="typeProd" id="inMusee" value="Musee">
                                    <label class="form-check-label" for="inMusee">Musée</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                    <input class="form-check-input" type="radio" name="typeProd" id="inVIP" value="VIP">
                                    <label class="form-check-label" for="inVIP">Accessoires VIP</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inDesc">Description</label>
                            <textarea class="form-control" name="description" id="inDesc" rows="5">Mon produit est...</textarea>
                        </div>
                        <div class="form-group">
                            <label>Type de vente</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="VenteEnchere" id="inEncheres" onclick="blocage1()" value=1>
                                <label class="form-check-label" for="inEncheres">Encheres</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="VenteImmediat" id="inAchatImmediat" onclick="blocage2()" value=1>
                                <label class="form-check-label" for="inAchatImmediat">Achat Immediat</label>
                            </div>
                            <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="VenteBestOffer" id="inBestOffer" onclick="blocage2()" value=1>
                                <label class="form-check-label" for="inBestOffer">BestOffer</label>
                            </div>      
                          </div>

                        <div class="form-group">
                            <label for="inPrix" id="prixAff">Prix (en €)</label>
                            <input type="number" class="form-control" id="inPrix" placeholder="Ex: 500" name="prix" required>
                        </div>
                        <div class="form-group">
                            <label for="inDateLim">Date Limite</label>
                            <input type="date" class="form-control" id="inDateLim" name="dateLim" required>
                        </div>

                        <label>Ajout de photos/video</label>
                        <div class="form-row">
                            <div class="col">
                                <label for="inImg1">Image 1</label>
                                <input type="text" class="form-control-file" name="img1" id="inImg1" required>
                            </div>
                            <div class="col">
                                <label for="inImg2">Image 2</label>
                                <input type="text" class="form-control-file" name="img2">
                            </div>

                            <div class="col">
                                <label for="inImg3">Image 3</label>
                                <input type="text" class="form-control-file" name="img3">
                            </div>

                            <div class="form-group">
                                <label for="inVid">Lien Youtube vers la vidéo</label>
                                <input type="text" class="form-control" id="inVid" placeholder="" name="video">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block" name="button1">Soumettre</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php include 'footer.php'; ?>

    </body>
</html>