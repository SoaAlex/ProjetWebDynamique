<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Liste d'article</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="../CSS/Panier.css">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    </head>

    <body>
        <?php include 'navbar.php'; ?>
        <h4 style="margin-left:3px">| Comptes Vendeur</h4>
        <div style="margin-left:10px">

         <?php $database = "bddebay";
         $db_handle = mysqli_connect('localhost', 'root','');
         $db_found = mysqli_select_db($db_handle, $database);
        
         $sql = "SELECT * FROM vendeur";
         $result = mysqli_query($db_handle, $sql);
         $result = mysqli_query($db_handle, $sql);
        while ($data = mysqli_fetch_assoc($result)) {
        echo "Pseudo: " . $data['Pseudo'] . "<br>";
        echo "Adresse Mail: " . $data['Mail'] . "<br> <br>";
        } ?>
        <form method="POST" action="SupprimerVendeur.php">
             <label for="inNom">Pseudo du Vendeur à supprimer</label>
             <input type="text" class="form-control" id="inPseudo"  name="pseudo" style="width:300px" required>  
             <button type="submit" class="btn btn-primary btn-block" name="button" style="width:300px; margin-left:50px" >Supprimer le vendeur du site</button>
        </form>
         </div>
        <br> <br> <br> <br> <br> <br> <br> <br> <br>
         <?php include 'footer.php'; ?>

    </body>
</html>
