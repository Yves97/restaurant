<?php
session_start();
    require '../database.php';
    if(!empty($_POST) && isset($_POST)){
        $email = secure_data($_POST['email']);
        $password = secure_data($_POST['password']);

        //---> cas d'erreur
        if ($email == '' || $password == ''){
            $err = '<p class="err-msg">ces deux champs sont à remplir</p>';
        }
        //---> cas de success du traitement
        else{
            $query = $connexion->prepare("SELECT * FROM admin WHERE email = ? AND password = ?");
            $query->execute(array($email,$password));
            $result = $query->fetch();
            $_SESSION['id'] = $result['id'];
            // var_dump($_SESSION['id']);
            // var_dump($_POST['id']);
            if($result == false){
                $err2 = '<p class="err-msg">Désolé vous n\'êtes sûrement pas l\'administrateur</p>';
            }
            else{
                header('Location:admin_home.php?id='.$_SESSION['id']);
            }
            
            // var_dump($_SESSION['id']);
            // header('Location:admin_home.php');
            // render_array($result);
        }
    }


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!--***CSS ressources***-->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/style.css">
    <title>HyviFood</title>
</head>
<body>
    <div class="main-login-box">
        <div class="admin-login-card">
            <div class="admin-card-message">
                <h3>HiVyFood - ADMIN</h3>
            </div>
            <div class="admin-card-form">
                <form action="" method="POST">
                    <div class="form-group">
                        <input type="email" name="email" class="admin-input"  placeholder="Entrez votre email">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="admin-input"  placeholder="Entrez votre mot de passe">
                    </div>
                    <button type="submit" class="btn-admin">Se Connecter</button>
                    <!-- <button type="reset" >Effacer</button> -->
                </form>
                <?php if(isset($err)){echo $err;}?>
                <?php if(isset($err2)){echo $err2;} ?>
            </div>
        </div>
    </div>
    <!--***JS ressources***-->
    <script src="../../js/jquery.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <!-- <script src="js/vue.js"></script> -->
    <script src="../../js/main.js"></script>
</body>
</html>

