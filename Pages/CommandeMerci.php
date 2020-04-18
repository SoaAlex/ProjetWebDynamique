<!DOCTYPE html>
<html lang="en">
<?php
   ob_start();
?>
<?php
    session_start();
?>

<head>
        <title>Création d'un compte acheteur</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="../CSS/CommandeMerci.css">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    </head>

    <body>
    <?php include 'navbar.php'; ?>


    <?php mail($to_email_address,$subject,$message,[$headers],[$parameters]); ?>

    
		<div class="Titre" style="margin-top: 30px; margin-left: 50px;"><h1>| PROCESSUS DE COMMANDE</h1></div>

        <div class="container-fluid">
            <div class="row" >
                <div class="col-sm-5"></div>
                <div class="col-sm-4">
                    <img src="../img/UI/CheckGreen.png" style="margin-left: -40px; margin-bottom:-50px; width:40%"><br>
                    <div class="Merci" style="margin-right: 600px;"><br> Merci
                    </div>
                </div>
                <div class="Texte">
                    Votre commande a bien été enregistrée.<br>
                    Sa livraison est prévue pour le <?php echo  date('Y-m-d', strtotime('+1 week'));?>.<br><br>

                    Vous allez recevoir un mail récapitulatif prochainement.<br>
                    Vous pouvez suivre à tout moment l'état de votre commande sur votre compte dans la rubrique "Commandes en cours".
                </div>
            </div>
        </div> 
    </body>
</html>