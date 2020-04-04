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
        
        $query3 = $connexion->prepare("SELECT * FROM food");
        $query3->execute();
        $result3 = $query3->fetchAll();
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
                            <th>Nom Du Plat</th>
                            <th>Prix</th>
                            <th>images</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($result3 as $key => $value): ?>
                            <tr>
                                <td scope="row"><?= $value['foodname'] ?></td>
                                <td><?= $value['price'] ?></td>
                                <td>
                                    <div style="background:url('../../images/<?= $value['imgfood'] ?>') center no-repeat;background-size: cover;height: 3rem;width: 3rem;"></div>
                                </td>
                                <td>
                                    <a href="admin_delete.php?id=<?= $value['id'] ?>">
                                        <button class="btn-admin btn-delete">Supprimer</button>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <!-- Button trigger modal 1 -->
                <div class="text-right">
                    <button type="button" class="btn-admin btn-add" data-toggle="modal" data-target="#modelId">
                        Ajouter un aliment
                    </button>
                </div>
                <!-- Modal 1-->
                <div class="modal fade custom-modal" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="item-add-title">Ajout D'un plat</h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                            <div class="modal-body">
                                <div class="admin-add-card">
                                    <form action="add_item.php" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <input type="text" name="foodname" class="input-add" id="" placeholder="Nom du plat">
                                        </div>
                                        <div class="form-group">
                                            <input type="number" name="price" class="input-add" id="" placeholder="prix">
                                        </div>
                                        <div class="form-group">
                                            <label for="imgfood">Image du plat</label>
                                            <input type="file"  name="imgfood" placeholder="image du plat" class="input-add" id="imgfood">
                                        </div>
                                        <button type="submit" class="btn-admin btn-add">Ajouter</button>
                                    </form>
                                    <?php if(isset($errimg)){
                                        echo $errimg;
                                    }  ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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

<?php } else{
    header('Location:admin_log.php');   
    }
?>

