<?php 
session_start();
    require 'database.php';
    // var_dump($_SESSION['id']);
    $query3 = $connexion->prepare("SELECT * FROM users WHERE id = ?");
    $query3->execute(array($_SESSION['id']));
    $result3 = $query3->fetch();

    $query = $connexion->prepare("SELECT * FROM food");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    
    if(!empty($_POST) && isset($_POST))
    {
        $cfoodname = secure_data($_POST['cfoodname']);
        // $get_food_name = $_GET['cfoodname'];
        // var_dump(die($cfoodname));
        $numberfood = filter_var(secure_data($_POST['numberfood']), FILTER_VALIDATE_INT);
        $moreinfo = secure_data($_POST['moreinfo']);
        if (empty($numberfood))
        {
            $err = '<h3 class="err-msg">Une erreur a du se produire </h3>';
        }
        else
        {
            $query4 = $connexion->prepare("INSERT INTO commande(cfoodname,numberfood,moreinfo,userid) VALUES(?,?,?,?)");
            $result4 = $query4->execute(array($cfoodname,$numberfood,$moreinfo,$_SESSION['id']));
            header("Location:ownOrderList.php?id=".$_SESSION['id']);
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
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>HyviFood</title>
</head>
<body>
    <header id="header">
        <nav class="navbar navbar-expand-sm fixed-top">
            <a class="navbar-brand" href="../index.php?id=<?= $result3['id'] ?>">HyviFood</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                aria-expanded="false" aria-label="Toggle navigation"></button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="register.html">S'enregister</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#">Voir mes commandes</a>
                    </li> -->
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#">Passer une commande</a>
                    </li> -->
                </ul>
            </div>
        </nav>
        <div class="welcome-box"  style="background: url('../images/img2.jpg') center no-repeat;background-size: cover;">
            <div class="welcome-text">
                <h3><?php $order = 'Commande'; echo $order;?></h3>            
            </div>
        </div>
    </header>
    <section id="order">
        <div class="handler-box">
            <div class="form-add">
                <form method="POST" action="">
                    <h3>Commandes de <?= $result3['username']   ?></h3>
                    <div class="form-group">
                        <label for="nameFood">Choix de votre plat</label>
                        <select  id="foodName" class="form-input" name="cfoodname">
                            <?php foreach($result as $key => $value): ?>
                                <option value="<?= $value['foodname'] ?>"><?= $value['foodname'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tit">Nombre de plat</label>
                        <input type="number"  name="numberfood" class="form-input" id="tit">
                    </div>
                    <div class="form-group">
                        <label for="content">Des Précisons ?</label>
                        <textarea name="moreinfo" class="form-input" id="content" cols="30" rows="5" "></textarea>
                    </div>
                    <button type="submit" class="btn-more">Commander</button>
                </form>
            </div>
            <div class="bg-image">
                <?php if(isset($err)){
                    echo $err;
                }
                else{
                    echo "<h3>Merci pour Votre Commande</h3>";
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