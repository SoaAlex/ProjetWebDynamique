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
<html>
    <head>
        <title>Création d'un compte acheteur</title>
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
                    <h1 style="text-align:center;">Créer un compte acheteur</h1>

                    <form method="POST" action="ajoutAcheteur.php"> 
                        <h4>| Informations personelles</h4>

                        <div class="form-group"> <!-- Inspiré de https://getbootstrap.com/docs/4.0/components/forms/ -->
                            <label for="inNom">Nom</label>
                            <input type="text" class="form-control" id="inNom" aria-describedby="nomHelp" placeholder="Ex: Jean" name="nom" required>
                        </div>
                        <div class="form-group">
                            <label for="inPrenom">Prenom</label>
                            <input type="text" class="form-control" id="inPrenom" placeholder="Ex: Moulin"  name="prenom" required>
                        </div>
                        <div class="form-group">
                            <label for="inMail">Adresse mail</label>
                            <input type="email" class="form-control" id="inMail" placeholder="Ex: jean.moulin@edu.ece.fr" name="mail" required>
                        </div>
                        <div class="form-group">
                            <label for="inPsw">Mot de passe</label>
                            <input type="password" class="form-control" id="inPsw" placeholder="" name="psw" required>
                        </div>

                        <br><hr><h4>| Adresse</h4>
                        <div class="form-group">
                            <label for="inAdrL1">Adresse Ligne 1</label>
                            <input type="text" class="form-control" id="inAdrL1" placeholder="Ex: 37 Quai de Grenelle" name="adrL1">
                        </div>
                        <div class="form-group">
                            <label for="inAdrL1">Adresse Ligne 2</label>
                            <input type="text" class="form-control" id="inAdrL2" placeholder="Ex: Immeuble Pollux" name="adrL2">
                        </div>
                        <div class="form-group">
                            <label for="inVille">Ville</label>
                            <input type="text" class="form-control" id="inVille" placeholder="Ex: Paris" name="ville">
                        </div>
                        <div class="form-group">
                            <label for="inCP">Code Postal</label>
                            <input type="number" class="form-control" id="inCP" placeholder="Ex: 75015" name="CP">
                        </div>
                        <div class="form-group">
                            <label for="inPays">Pays</label>
                            <input type="text" class="form-control" id="inPays" placeholder="Ex: France" name="pays">
                        </div>
                        <div class="form-group">
                            <label for="inNum">Numéro de téléphone</label>
                            <input type="number" class="form-control" id="inNum" placeholder="Ex: 0706050303" name="tel">
                        </div>
                        <!-- Insipiré de https://mdbootstrap.com/docs/jquery/forms/file-input/ -->
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="CGUCheck" value=1>
                            <label class="form-check-label" for="exampleCheck1"  >
                                Acceptez-vous les conditions générales de vente ?<br>
                                Notamment, vous vous engagez à payer chaque article que vous enchérissez.
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block" name="button1">Inscription</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
