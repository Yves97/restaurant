<?php
session_start();
    require '../database.php';
    // var_dump($_SESSION['id']);
    //--> Si l'user n'est pas connecté
    if(!($_SESSION['id'] == NULL)) {
        //--> Selection de l'admin courant
        $query2 = $connexion->prepare("SELECT * FROM admin WHERE id = ?");
        $query2->execute(array($_SESSION['id']));
        $result2 = $query2->fetch();

        $query4 = $connexion->prepare('SELECT *,users.username,food.foodname FROM commande,users,food WHERE commande.userid = users.id AND food.foodname = commande.cfoodname ORDER BY users.username');
        $query4->execute();
        $result4 = $query4->fetchAll();
        // render_array($result4);
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
    <div class="main-home-box">
        <div class="sidebar">
            <h3>Bonjour 
                <span class="admin-user"><?= $result2['username'] ?></span>
            </h3>
            <ul>
                <li>
                    <a href="admin_home.php?id=<?= $_SESSION['id'] ?>">Accueil</a>
                </li>
                <!-- <li>
                    <a href="#">Ajouter un élément</a>
                </li> -->
                <li>
                    <a href="order_list.php?id=<?= $_SESSION['id'] ?>">Liste des commandes</a>
                </li>
                <form action="admin_disconnect.php" method="get">
                    <button type="submit" class="btn-reverse disconnect-btn">Déconnection</button>
                </form>
                
            </ul>
        </div>
        <button class="sidebar-control">=</button>
        <div class="admin-main-content">
            <div class="container title">
                <h3>Liste de tout les aliments</h3>
                <table class="table table-striped table-food">
                    <thead class="item-title">
                        <tr>
                            <th>Nom</th>
                            <th>Numéro de téléphone</th>
                            <th>Commande</th>
                            <th>Nombres de commandes</th>
                            <th>Prix unitaire</th>
                            <th>Précisions</th>
                            <th>Date de commande</th>
                            <th>Prix Total</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($result4 as $key => $value): ?>
                        <tr>
                            <td scope="row"><?= $value['username'] ?></td>
                            <td><?= $value['tel'] ?></td>
                            <td><?= $value['cfoodname'] ?></td>
                            <td><?= $value['numberfood'] ?></td>
                            <td><?= $value['price'] ?></td>
                            <td><?= $value['moreinfo'] ?></td>
                            <td><?= $value['date_add'] ?></td>
                            <td><?= $value['price'] * $value['numberfood'] ?></td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
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

<?php }else{
    header('Location:admin_log.php');   
    }
?>

