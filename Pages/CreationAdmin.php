<?php
   ob_start();
   session_start();
 
    if($_SESSION["user_type"] != "Admin"){ //Il faut être admin pour créer un compte
        header("location: landingPage.php");
        exit;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Création d'un compte Admin</title>
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
                    <h1 class="feature-title">Créer un compte Admin</h1>

                    <form method="POST" action="#"> <!-- Manque lien -->
                        <h4>| Informations admin</h4>

                        <div class="form-group"> <!-- Inspiré de https://getbootstrap.com/docs/4.0/components/forms/ -->
                            <label for="inNom">Nom</label>
                            <input type="text" class="form-control" id="inNom" aria-describedby="nomHelp" placeholder="Ex: Jean" name="nom">
                        </div>
                        <div class="form-group"> 
                            <label for="inPrenom">Prenom</label>
                            <input type="text" class="form-control" id="inPrenom" aria-describedby="nomHelp" placeholder="Ex: Jean" name="nom">
                        </div>
                        <div class="form-group">
                            <label for="inMail">Adresse mail</label>
                            <input type="email" class="form-control" id="inMail" placeholder="Ex: jean.moulin@edu.ece.fr" name="mail">
                        </div>
                        <div class="form-group">
                            <label for="inPsw">Mot de passe</label>
                            <input type="password" class="form-control" id="inPsw" placeholder="" name="psw">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Inscription</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>