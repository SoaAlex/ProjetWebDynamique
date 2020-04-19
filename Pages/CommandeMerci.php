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


    <?php 

    //identifier votre BDD
    $database = "bddebay";
    //connectez-vous de votre BDD
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, $database);

    $ID = $_SESSION['userID'];
    $sql = "SELECT Mail FROM acheteur";
    if ($_SESSION['userID'] != "") {
        $sql .= " WHERE IDAcheteur LIKE '$ID'";
         }
    $result = mysqli_query($db_handle, $sql);
    $mail = mysqli_fetch_assoc($result);

    $message = "Bonjour ".$_SESSION["username"].", votre commande sur le site EbayEce à bien été prise en compte. La livraison de vos achats est prévue pour le " .date('Y-m-d', strtotime('+1 week'))." Nous vous remercions de votre confiance";

    
    //mail($mail['Mail'],'Commande passée',$message,'From: noreply @ ebayece.fr'); ?>


		<div class="Titre" style="margin-top: 30px; margin-left: 50px;"><h1>| PROCESSUS DE COMMANDE</h1></div>

        <div class="container-fluid">
            <div class="row" >
                <div class="col-sm-5"></div>
                <div class="col-sm-4">
<<<<<<< HEAD
                    <img src="img/CheckGreen.png" style="margin-left: 50px;"><br>
                    <div class="Merci" style="margin-right: 600px;">Merci
                    </div>
                </div>
                <div class="Texte">
                    Votre commande N°J24B1B083PL a bien été enregistrée.<br>
                    Sa livraison est prévu pour le 28/04/2020.<br><br>
=======
                    <img src="../img/UI/CheckGreen.png" style="margin-left: -40px; margin-bottom:-50px; width:40%"><br>
                    <div class="Merci" style="margin-right: 600px;"><br> Merci
                    </div>
                </div>
                <div class="Texte">
                    Votre commande a bien été enregistrée.<br>
                    Sa livraison est prévue pour le <?php echo  date('Y-m-d', strtotime('+1 week'));?>.<br><br>
>>>>>>> ft_adrien_69

                    Vous allez recevoir un mail récapitulatif prochainement.<br>
                    Vous pouvez suivre à tout moment l'état de votre commande sur votre compte dans la rubrique "Commandes en cours".
                </div>
<<<<<<< HEAD
                
            </div>
        </div> 
	
    </body>
</html>
=======
            </div>
        </div> 
    </body>
</html>
>>>>>>> ft_adrien_69
