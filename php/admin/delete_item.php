<?php
session_start();
require '../database.php';
// var_dump($_GET['foodname']);
// var_dump($_SESSION['id']);
    $query4 = $connexion->prepare('DELETE FROM food WHERE foodname = ?');
    $query4->execute(array($_GET['foodname']));
    header('Location:admin_home.php?id='.$_SESSION['id']);