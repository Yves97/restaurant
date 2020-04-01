<?php
session_start();
    require 'database.php';
    if(!empty($_POST) && isset($_POST))
    {
        $email = secure_data($_POST['email']);
        $password = secure_data($_POST['password']);

        if ($email == '' || $password == '')
        {
            $err = '<h2 class="err-msg">Merci de bien remplir ces deux champs</h2>';
        }
        else
        {
            $request = $connexion->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
            $request->execute(array($email, $password));
            $result2 = $request->fetch();
            // render_array($result2);
            $_SESSION['id'] = $result2['id'];
            header('Location:../index.php?id='.$_SESSION['id']);
            //var_dump($tab);
            //$_SESSION = $tab;
            // header("Location:index.php?id=".$_SESSION['id']);
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
                    <!-- <li class="nav-item active">
                        <a class="nav-link" href="#">Commander</a>
                    </li> -->
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="ownOrderList.html">Voir mes commandes</a>
                    </li> -->
                </ul>
            </div>
        </nav>
        <div class="welcome-box"  style="background: url('../images/img2.jpg') center no-repeat;background-size: cover;">
            <div class="welcome-text">
            <h3><?php $login = 'Connexion'; echo $login;?></h3>
            </div>
        </div>
    </header>
    <section id="register">
        <div class="container">
            <h3>Connection</h3>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Exercitationem modi quas enim natus voluptatum iure voluptates cum optio fugiat rem suscipit aliquid, voluptas recusandae error veniam aspernatur, nemo omnis! Dignissimos?</p>
            <div class="register-form">
                <form action="" method="POST">
                    <div class="form-group">
                        <input class="input_contact" type="email" name="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input class="input_contact" type="password" name="password" placeholder="Votre Mot de Passe">
                    </div>
                    <button type="submit" class="btn-more">Se Connecter</button>
                </form>
                <?php
                    if(isset($err)){
                        echo $err;
                    }
                ?>
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

