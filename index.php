<?php
session_start();
require 'php/database.php';
    if(isset($_GET['id']) && isset($_SESSION['id'])){
    // require 'php/register.php';
    $query = $connexion->prepare("SELECT * FROM food");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    
    $query3 = $connexion->prepare("SELECT * FROM users WHERE id = ?");
    $query3->execute(array($_GET['id']));
    $result3 = $query3->fetch();
    $_SESSION['id'] = $result3['id']
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!--***CSS ressources***-->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>HyviFood</title>
</head>
<body>
    <header id="header">
        <nav class="navbar navbar-expand-sm fixed-top">
            <a class="navbar-brand" href="<?= $_SERVER['PHP_SELF'] ?>">HyviFood</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                aria-expanded="false" aria-label="Toggle navigation"></button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="php/register.php">S'enregister</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="php/ownOrderList.php?id=<?= $_SESSION['id'] ?>">Voir mes commandes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="php/order.php?id=">Passer une commande</a>
                    </li>
                </ul>
                <p class="username"><?= 'Hello!  '.$result3['username'] ?></p>
            </div>
            <div>
                <form action="php/disconnect.php" method="GET">
                    <button type="submit">deconnection</button>
                </form>
            </div>
        </nav>
        <div class="welcome-box" style="background: url('images/img2.jpg') center no-repeat;background-size: cover;">
            <div class="welcome-text">
                <h3>Bienvenu(e) Chez HiVyFood</h3>
            </div>
        </div>
    </header>
    <section id="about">
        <div class="about-content">
            <div class="about-text">
                <div class="sticky-text">
                    <h3>A Propos</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat esse est, voluptates eius nesciunt ratione reprehenderit labore illum unde qui eligendi quaerat? Neque alias animi, eum nesciunt iure nostrum tempora.</p>
                    <a href="#">
                        <button class="btn-more">En Savoir Plus</button>
                    </a>
                </div>
            </div>
            <div style="height:100vh;width:100%;background: url('images/img10.jpg') center no-repeat;background-size: cover;flex:1"></div>
        </div>
    </section>
    <section id="enjoy">
        <div class="enjoy-content">
            <div class="about-text">
                <div class="sticky-text">
                    <h3>Bon Appetit !</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat esse est, voluptates eius nesciunt ratione reprehenderit labore illum unde qui eligendi quaerat? Neque alias animi, eum nesciunt iure nostrum tempora.</p>
                </div>
            </div>
            <div style="height:100vh;width:100%;background: url('images/img6.jpg') center no-repeat;background-size: cover;flex:1"></div>
        </div>
    </section>
    <section id="foods">
        <div class="container">
            <h3>Nos Plats</h3>
            <div class="main-food-cards">
                <div class="row">
                <?php foreach($result as $key => $value): ?>
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="card-food" style="background: linear-gradient(rgba(0,0,0,.1),rgba(0,0,0,.8)),url(images/<?= $value['imgfood'] ?>) center no-repeat;background-size: cover;">
                                <div class="card-info">
                                    <h3><?=  $value['foodname'] ?></h3>
                                    <p><?= $value['price'] ?></p>
                                    <!-- <a href="#">
                                        <button class="btn-more">Commander</button>
                                    </a> -->
                                </div>
                            </div>
                        </div>
                <?php endforeach ?>
                </div>
            </div>
        </div>
    </section>
    <footer id="footer">
        <div class="container">
            <h3>&copy;Copyright HyVyFood 2020</h3>
        </div>
    </footer>
    <!--***JS ressources***-->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- <script src="js/vue.js"></script> -->
    <script src="js/main.js"></script>
</body>
</html>

<?php 
    }
    else{
        header('Location:php/register.php');
    }  
    
?>