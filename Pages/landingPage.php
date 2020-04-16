<?php
   ob_start();
   session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Page d'accueil</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="../CSS/landing.css">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    </head>

    <body>
        <?php include 'navbar.php'; ?>
        
        <!-- Carroussel inspiré de https://getbootstrap.com/docs/4.1/components/carousel/ -->
        <div id="carousel-background" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
            <li data-target="#" data-slide-to="0" class="active"></li>
            <li data-target="#" data-slide-to="1"></li>
            <li data-target="#" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="../img/UI/background3.jpg" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="../img/UI/background4.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="../img/UI/background1.jpg" alt="Third slide">
            </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
            </a>
        </div>

        <div id="content-wrapper">
            <div class="container">
                <h1 style="text-align: center; color: white;">BIENVENUE 
                <?php 
                    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
                    {
                        echo $_SESSION["username"]. "<br>";
                        echo 'Profil ' . $_SESSION['user_type'];

                    }
                    else{
                        echo "SUR EBAYECE";
                    }
                ?>
            </h1>
            </div>
        </div>

        <?php include 'footer.php'; ?>

    </body>
</html>