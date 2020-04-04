<?php
    require '../database.php';
    if(!empty($_POST) && isset($_POST)){
        if(isset($_FILES['imgfood'])){
            $foodname = secure_data($_POST['foodname']);
            $price = filter_var(secure_data($_POST['price']), FILTER_VALIDATE_INT);
            
            if( (isset($_FILES['imgfood']) && $_FILES['imgfood']['error'] == 0) && ($foodname != '' || $price != '') ){
                
                if($_FILES['imgfood']['size'] <= 5000000 && $_FILES['imgfood'] != ''){
                    
                    $infosfichier = pathinfo($_FILES['imgfood']['name']);
                    // die(var_dump($infosfichier));
                    $extension_upload = $infosfichier['extension'];
                    
                    $extension_autorisees = array('jpg', 'jpeg', 'gif', 'png');
                    
                    if(in_array($extension_upload,$extension_autorisees)){

                        move_uploaded_file($_FILES['imgfood']['tmp_name'],'../../images/'.basename($_FILES['imgfood']['name']));

                        $query4 = $connexion->prepare('INSERT INTO food(foodname,price,imgfood) VALUES(?,?,?)');
                        $result4 = $query4->execute(array($foodname,$price,$_FILES['imgfood']['name']));
                        header('Location:admin_home.php');
                        }
                        // else{
                        //     echo 'D';
                        // }
                    // }else{
                    //     echo 'D';
                    // }
                // }else{
                //     echo 'votre fichier est trop lourd et/ou ne laissez aucun champ vide';
                //     $errimg = '';
                // }
            }
            // else {
            //     echo 'B';
            // }
        }
        // else{
        //     echo 'A';
        //     // echo $err = '<p class="err-msg">Fichier non chargé</p>';
        // }
        }
    }
