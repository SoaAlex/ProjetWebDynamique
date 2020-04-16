<?php
    session_start();
    
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === false){
        header("location: Connexion.php");
        exit;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Ajouter un produit</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="../CSS/StyleCreation.css">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    </head>

    <body>
        <?php include 'navbar.php'; ?>

        <div class="container features">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <h1 class="feature-title">Mise en vente d'un produit</h1>

                    <form method="POST" action="#"> <!-- Manque lien -->
                        <h4>| Informations produit</h4>

                        <!-- Inspiré de https://getbootstrap.com/docs/4.0/components/forms/ -->
                        <div class="form-group">
                            <label for="inNom">Nom du produit</label>
                            <input type="text" class="form-control" id="inNom" placeholder="Ex: Pièces de monnaie" name="nom">
                        </div>

                        <label>Type de produit:&nbsp;&nbsp;&nbsp;</label>
                        <div class="form-group">
                            <div class="custom-control custom-radio custom-control-inline">
                                    <input class="form-check-input" type="radio" name="typeProd" id="inFerrailleOuTresor">
                                    <label class="form-check-label" for="inFerrailleOuTresor">Ferraille ou Trésor</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                    <input class="form-check-input" type="radio" name="typeProd" id="inMusee">
                                    <label class="form-check-label" for="inMusee">Musée</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                    <input class="form-check-input" type="radio" name="typeProd" id="inVIP">
                                    <label class="form-check-label" for="inVIP">Accessoires VIP</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inDesc">Description</label>
                            <textarea class="form-control" name="descripiton" id="inDesc" rows="5">Mon produit est...</textarea>
                        </div>

                        <div class="form-group">
                            <label>Type de vente</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="typeProd" id="inFerrailleOuTresor">
                                <label class="form-check-label" for="inFerrailleOuTresor">Ferraille ou Trésor</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="typeProd" id="inMusee">
                                <label class="form-check-label" for="inMusee">Musée</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="typeProd" id="inVIP">
                                <label class="form-check-label" for="inVIP">Accessoires VIP</label>
                            </div>      
                        </div>

                        <div class="form-group">
                            <label for="inPrix">Prix de départ</label>
                            <input type="number" class="form-control" id="inPrix" placeholder="Ex: 500€" name="prixDep">
                        </div>
                        <div class="form-group">
                            <label for="inDateLim">Date Limite</label>
                            <input type="date" class="form-control" id="inDateLim" name="dateLim">
                        </div>

                        <label>AJout de photos/video</label>
                        <div class="form-row">
                            <div class="col">
                                <label for="inImg1">Image 1</label>
                                <input type="file" class="form-control-file" name="img1" id="inImg1">
                            </div>
                            <div class="col">
                                <label for="inImg2">Image 2</label>
                                <input type="file" class="form-control-file" name="img2">
                            </div>
                            <div class="col">
                                <label for="inVid">Video (optionel)</label>
                                <input type="file" class="form-control-file" name="video">
                              </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Soumettre</button>
                    </form>
                </div>
            </div>
        </div>

        <?php include 'footer.php'; ?>

    </body>
</html>