<?php
    $mail = isset($_POST['mail']) ? $_POST['mail'] : '';
    $psw = isset($_POST['psw']) ? $_POST['psw'] : '';
    
    $userType;

    if($mail == ''){
        /*echo '<script type="text/javascript">
        document.getElementByID(inMail).classList.add("is-invalid");
        document.getElementByID(divMail).innerHTML = "<div class="valid-feedback">Veuillez rentrer un mail</div>
        </script>';*/
        echo "MAIL EMPTY";
        exit();
    }
    if($psw == ''){
        echo 'PSW EMPTY';
        exit();
    }

    $database = "bddebay";
    $db_handle = mysqli_connect('localhost', 'root','');
    $db_found = mysqli_select_db($db_handle, $database);

    if($db_found && $mail != '' && $psw != ''){
        //Trouver acheteur
        $sql = "SELECT Mail, Password FROM acheteur WHERE Mail='$mail' AND Password='$psw'";
        $result = mysqli_query($db_handle, $sql);
        if(mysqli_num_rows($result) == 0){
            //Trouver Vendeur
            $sql = "SELECT Mail, Password FROM vendeur WHERE Mail='$mail' AND Password='$psw'";
            $result = mysqli_query($db_handle, $sql);
            if(mysqli_num_rows($result) == 0){
                $sql = "SELECT Mail, Password FROM administrateur WHERE Mail='$mail' AND Password='$psw'";
                $result = mysqli_query($db_handle, $sql);
                //Trouver admin
                if(mysqli_num_rows($result) == 0){
                    //USER NOT FOUND
                    echo "UTILISATEUR NON TROUVEE"; //Comment montrer qu'on trouve pas ?
                    header("Location: ../../HTML/Formulaires/Connexion.html");
                }
                else{
                    $_SESSION['loggedin'] = true;
                    $_SESSION['username'] = $mail;
                    $userType = "admin";
                    header("Location: ../../HTML/LandingPage.html");
                    exit();
                }
            }
            else{
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $mail;
                $userType = "vendeur";
                header("Location: ../../HTML/LandingPage.html");
                exit();
            }
        }
        else{
            $_SESSION['loggedin'] = true;
            $_SESSION['valid'] = true;
            $_SESSION['username'] = $mail;
            $userType = "acheteur";
            echo "logged as acheteur";
            header("Location: ../../HTML/LandingPage.html");
            exit();
        }
    }
    else{
        echo "DB NOT FOUND";
    }
?>