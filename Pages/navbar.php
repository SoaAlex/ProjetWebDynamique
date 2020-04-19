<!-- BARRE DE NAVIGATION INSPIREE DU TP7-->
<nav class="navbar navbar-expand-md">
            <a class="navbar-brand" href="landingPage.php"><img class="img-fluid navbar-img" src="../img/UI/logo.png" style="width: 120px; height: 80px;"></a> 
            <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#main-navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse Cstart" id="main-navigation">
                <ul class="navbar-nav">
                    <?php if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === false)
                    echo'
                        <li class="nav-item"><a class="nav-link" href="articles.php">CATEGORIES</a></li>
                    ';
                    else{
                        echo'<li class="nav-item"><a class="nav-link" href="articles.php">ACHETER</a></li>';
                    }
                    ?>
                    <?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $_SESSION['user_type'] != "Acheteur")//Pas vendre si acheteur
                    echo '<li class="nav-item"><a class="nav-link" href="AjoutProduit.php">VENDRE</a></li>'
                    ?>
                </ul>
            </div>
            <div class="collapse navbar-collapse Cend" id="main-navigation">
                <ul class="navbar-nav">
                    <form class="form-inline my-2 my-lg-0" method="POST" action="produit.php">
                        <input class="form-control mr-sm-2" type="text" name="nomArt" placeholder="Nom de l'article..." aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>
                    </form>
                    <?php if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === false) //Deco/Conn
                    echo'
                    <li class="nav-item"><a class="nav-link" href="CreationAcheteur.php">
                        Inscription
                    </a></li>
                    <li class="nav-item"><a class="nav-link" href="Connexion.php">
                        Connexion
                    </a></li>'
                    ?>
                    <?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $_SESSION['user_type'] == "Acheteur") //Panier que si acheteur
                        echo'
                        <li class="nav-item"><a class="nav-link" href="panier.php">
                        <img class="img-fluid navbar-img" src="../img/UI/PanierBlanc.png" style="width: 20px; margin-right: 5px;">PANIER
                        </a></li>
                        '
                    ?>
                    <?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) //Que si Co
                        echo'
                        <li class="nav-item"><a class="nav-link" href="Notification.php">
                            <img class="img-fluid navbar-img" src="../img/UI/notif.png" style="width: 20px; margin-right: 5px;">
                        </a></li>
                        <li class="nav-item"><a class="nav-link" href="ComptePerso.php">
                            <img class="img-fluid navbar-img" src="../img/UI/account.png" style="width: 20px; margin-right: 5px;">
                        </a></li>'
                    ?>
                </ul>
            </div>
        </nav>