<?php
session_start();
    require '../database.php';
    // var_dump($_SESSION['id']);
    //--> Si l'user n'est pas connecté
    if(!($_SESSION['id'] == NULL)) {
        // var_dump($_SESSION['id']);
        //--> Selection de l'admin courant
        $query3 = $connexion->prepare("SELECT * FROM food WHERE id = ?");
        $query3->execute(array($_GET['id']));
        $result3 = $query3->fetch();
        // var_dump($result3['id']);
        // var_dump($_GET['id']);
        // var_dump($_GET['id']);
        // $_SESSION['id'] = $result3;
        // var_dump($_SESSION['id']);
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
    <div class="main-home-delete">
        <div class="container title">
            <h3>Etes vous sur de vouloir supprimez ?</h3>
            <div class="box-delete-info">
                <div style="width:100%;height:70vh;background:linear-gradient(rgba(0, 0, 0, 0),rgba(0, 0, 0, 0.712)),url('../../images/<?= $result3['imgfood'] ?>') center no-repeat;background-size:100%;position: relative;padding: 1rem;">
                    <div class="box-delete-action">
                        <p><?= $result3['foodname'] ?></p>
                        <p><?= $result3['price'] ?></p>
                        <a href="delete_item.php?foodname=<?= $result3['foodname'] ?>">
                            <button class="btn-admin btn-delete">Supprimer</button>
                        </a>
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

