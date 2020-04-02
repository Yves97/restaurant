<?php
session_start();
    require 'database.php';

    //--> Traitement des informations reçues du formulaire
    if(!empty($_POST) && isset($_POST)){
        $username = secure_data($_POST['username']);
        $tel = secure_data($_POST['tel']);
        $email = filter_var(secure_data($_POST['email']),FILTER_VALIDATE_EMAIL);
        $password = secure_data($_POST['password']);

        if($username == null || $tel == null || $email == null || $password == null){
            $err = '<h3 class="err-msg">Impossible de s\'inscrire</h3>';
        }
        else{
            $query = $connexion->prepare("INSERT INTO users(username,tel,email,password) VALUES(?,?,?,?)");
            $result = $query->execute(array($username,$tel,$email,$password));
            header("Location:login.php");
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
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>HyviFood</title>
</head>
<body>
    <header id="header">
        <nav class="navbar navbar-expand-sm fixed-top">
            <a class="navbar-brand" href="../index.php">HyviFood</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                aria-expanded="false" aria-label="Toggle navigation"></button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="login.php">Me connecter</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="ownOrderList.html">Voir mes commandes</a>
                    </li> -->
                </ul>
            </div>
        </nav>
        <div class="welcome-box"  style="background: url('../images/img2.jpg') center no-repeat;background-size: cover;">
            <div class="welcome-text">
                <h3><?php $register = 'Inscription'; echo $register;?></h3>
                <div id="scroll-invitation">
                    <a href="#register"><span></span></a>
                </div>
            </div>
        </div>
    </header>
    <section id="register">
        <div class="container">
            <h3>Enregistrement</h3>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Exercitationem modi quas enim natus voluptatum iure voluptates cum optio fugiat rem suscipit aliquid, voluptas recusandae error veniam aspernatur, nemo omnis! Dignissimos?</p>
            <div class="register-form">
                <form action="" method="POST">
                    <?php
                        if(isset($err)){
                            echo $err;
                        }
                    ?>
                    <div class="form-group">
                        <input class="input_contact" type="text" name="username" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <input class="input_contact" type="text" name="tel" placeholder="Numéro de téléphone">
                    </div>
                    <div class="form-group">
                        <input class="input_contact" type="email" name="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input class="input_contact" type="text" name="password" placeholder="Votre Mot de Passe">
                    </div>
                    <button type="submit" class="btn-more">Soumettre</button>
                </form>
                <h4> J'ai deja un compte me 
                    <a href="login.php">
                        <button class="btn-reverse">Connecter</button>
                    </a>
                </h4>
            </div>
            
        </div>
    </section>
    <footer id="footer">
        <div class="container">
            <h3>&copy;Copyright HyVyFood 2020</h3>
        </div>
    </footer>
    <!--***JS ressources***-->
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <!-- <script src="js/vue.js"></script> -->
    <script src="../js/main.js"></script>
</body>
</html>