<?php 
session_start();
    require 'database.php';
    // var_dump($_SESSION['id']);
    if(isset($_SESSION['id'])){
        $joinquery = "SELECT commande.cfoodname, commande.numberfood ,commande.userid, users.id FROM commande,users WHERE commande.userid = ? AND users.id = ?";
        $query5 = $connexion->prepare($joinquery);
        $query5->execute(array($_SESSION['id'],$_GET['id']));
        $result5 = $query5->fetchAll();
        $_SESSION['resultid'] = $result5;
        // render_array($_SESSION['resultid']);


        // $query_al = $connexion->prepare("SELECT * FROM food WHERE food.id = ? AND food.foodname =");
        // $query_al->execute(array($_SESSION['id']));
        // $result_al = $query_al->fetchAll(PDO::FETCH_ASSOC);
        // render_array($result_al);

        $query = $connexion->prepare("SELECT commande.cfoodname,commande.userid, food.foodname, food.price , users.username FROM commande, food, users WHERE commande.cfoodname = food.foodname AND commande.id = (users.id = ?) AND commande.userid = ?");
        $query->execute(array($_SESSION['id'],$_GET['id']));
        $result = $query->fetch();
        // session_destroy();
        // render_array($result);
    //-------------------------------------------///

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
    <section id="own-order">
        <div class="container">
            <h3>Mes commandes</h3>
            <table class="table table-striped ">
                <thead>
                    <tr>
                        <th>Nom Du Plat</th>
                        <th>Nombre de commandes</th>
                        <th>Prix Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($result5 as $key => $value): ?>
                        <tr>
                            <td scope="row"><?= $value['cfoodname'] ?></td>
                            <td><?= $value['numberfood'] ?></td>
                            <td><?=  $value['numberfood'] * $result['price'] ?></td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
            </table>
            <a href="../index.php?id=<?= $_SESSION['id'] ?>">
                <button class="btn-more">Retour a la page d'accueil</button>
            </a>
        </div>
        
    </section>
    <!--***JS ressources***-->
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <!-- <script src="js/vue.js"></script> -->
    <script src="../js/main.js"></script>
</body>
</html>

<?php } else{
        header('Location:login.php');
}
?>