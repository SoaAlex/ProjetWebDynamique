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
        <title>Votre compte</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="../CSS/StyleCreation.css">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    </head>

    <body>
        <?php include 'navbar.php'; ?>

        <div id="content-wrapper">
            <div class="container">
                <h3>| Informations du compte</h3>

                <form action="Deconnexion.php">
                    <button type="submit" class="btn btn-primary btn-block">DECONNEXION</button>
                </form>
            </div>
        </div>
        <?php include 'footer.php'; ?>
    </body>
</html>
