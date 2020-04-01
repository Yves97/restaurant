<?php
    $server = "localhost";
    $dbname = "hyvifood";
    $username = "root";
    $password = "";

    try{
        $connexion = new PDO("mysql:host=$server;dbname=$dbname",$username,$password);
        $connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
        // echo "connexion a la base de donnée réussit";
    }
    catch(PDOException $e){
        echo 'Impossible de se connecter la base donnée'.$e->getMessage();
    }

    function render_array($array_name){
        echo '<pre>';
        echo print_r($array_name);
        echo '</pre>';
    }
    
    function secure_data($data){
        $data = htmlspecialchars($data);
        $data = stripcslashes($data);
        $data = trim($data);
        return $data;
    }