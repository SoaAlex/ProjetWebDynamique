<?php
    //identifier votre BDD
    $database = "article";

    //connectez-vous dans votre BDD
    //Rappel: votre serveur = localhost | votre login = root |votre password = <rien>
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, $database);

    if ($db_found) {
        $reponse = $bdd->query('SELECT * FROM article');
        while ($donnees = $reponse->fetch())
        {
            echo "<div class='row'>";
            for($i=0;$i<3;$i++){
                echo "<div class='col-md-4'>";
                echo $donnees['#CheminImage']; //ici tu peux aller récupérer du contenu dans ta bdd...
                echo "</div>";    
            }
        }
    }
?> Test push 
<?php
echo "</div>";

$reponse->closeCursor(); // Termine le traitement de la requête
?>