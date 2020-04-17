<?php
   ob_start();
   session_start();
?>

<?php
    $user_type = '';
    $mail_error = '';
    $psw_error = '';
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){

    $mail = isset($_POST['mail']) ? $_POST['mail'] : '';
    $psw = isset($_POST['psw']) ? $_POST['psw'] : '';

    if($mail == ''){
        $mail_error = "Veuillez rentrer un mail valide";
    }
    if($psw == ''){
        $psw_error = "Veuillez rentrer un mot de passe valide";
    }

    $database = "bddebay";
    $db_handle = mysqli_connect('localhost', 'root','');
    $db_found = mysqli_select_db($db_handle, $database);

    if($db_found && $mail != '' && $psw != ''){
        //Trouver acheteur
        $sql = "SELECT Mail AS Mail, Nom AS Nom, IDAcheteur as IDAcheteur FROM acheteur WHERE Mail='$mail' AND Password='$psw'";
        $result = mysqli_query($db_handle, $sql);

        if(mysqli_num_rows($result) == 0){
            //Trouver Vendeur
            $sql = "SELECT Mail AS Mail, Pseudo AS Pseudo, IDVendeur as IDVendeur FROM vendeur WHERE Mail='$mail' AND Password='$psw'";
            $result = mysqli_query($db_handle, $sql);

            if(mysqli_num_rows($result) == 0){
                //Trouver admin
                $sql = "SELECT Mail AS Mail, Nom AS Nom, IDAdmin as IDAdmin FROM administrateur WHERE Mail='$mail' AND Password='$psw'";
                $result = mysqli_query($db_handle, $sql);
                if(mysqli_num_rows($result) == 0){
                    $mail_error = "Utilisateur non trouvé";
                    $psw_error = "Mot de passe ou mail incorrect";
                }
                else{
                    $data = mysqli_fetch_assoc($result);
                    $_SESSION['username'] = $data['Nom'];
                    $_SESSION["userID"] = $data['IDAdmin'];
                    $_SESSION['loggedin'] = true;
                    $_SESSION['usermail'] = $mail;
                    $_SESSION['user_type'] = 'Admin';
                    header("Location: landingPage.php");
                }
            }
            else{
                $data = mysqli_fetch_assoc($result);
                $_SESSION['username'] = $data['Pseudo'];
                $_SESSION["userID"] = $data['IDVendeur'];
                $_SESSION['loggedin'] = true;
                $_SESSION['usermail'] = $mail;
                $_SESSION['user_type'] = 'Vendeur';
                header("Location: landingPage.php");
            }
        }
        else{
            $data = mysqli_fetch_assoc($result);
            $_SESSION["username"] = $data['Nom'];
            $_SESSION["userID"] = $data['IDAcheteur'];
            $_SESSION['loggedin'] = true;
            $_SESSION['valid'] = true;
            $_SESSION['usermail'] = $mail;
            $_SESSION['user_type'] = 'Acheteur';
            header("Location: landingPage.php");
        }
    }
    else{
        $mail_error = "Veuillez nous excuser, la Base De Données n'a pas été trouvée !";
    }
    mysqli_close($db_handle);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Connexion</title>
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
                    <h1 style="text-align: center;">Connexion</h1>

                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"> <!-- Manque lien -->
                        <h4>| Identifiants</h4>

                        <!-- Inspiré de https://getbootstrap.com/docs/4.0/components/forms/ -->
                        <div class="form-group" id="divMail">
                            <label for="inMail">Adresse mail</label>
                            <input type="email" class="form-control <?php echo (!empty($mail_error)) ? 'is-invalid' : '' ?>" id="inMail" placeholder="Ex: jean.moulin@edu.ece.fr" name="mail" required>
                            <span class="help-block"> <?php echo $mail_error ?></span>
                        </div>
                        <div class="form-group" id="formPsw">
                            <label for="inPsw">Mot de passe</label>
                            <input type="password" class="form-control <?php echo (!empty($psw_error)) ? 'is-invalid' : '' ?>" id="inPsw" placeholder="" name="psw" required>
                            <span class="help-block"> <?php echo $psw_error ?></span>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Connexion</button>
                    </form>
                </div>
            </div>
        </div>
    </body>

</html>