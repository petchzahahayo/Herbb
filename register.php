<?php

    require 'connect/connectdb.php';
    
    $user_username = $_POST['user_username'];
    $user_password = $_POST['user_password'];
    $user_email = $_POST['user_email'];
    //$user_dateadd = date("Y-m-d H:i:s");
    
    //เข้ารหัส login_password
    $key = 'sfdjak;nvkio[eirujgtf049u15678465wefqawe';
    $hash_login_password = hash_hmac('sha256', $user_password, $key); // login_password
    
    $query = "INSERT INTO herb_user(user_username, user_password, user_email) "
            . "VALUES ('$user_username', '$hash_login_password', '$user_email')";
    $result = pg_query($db, $query);
    
    if($result){
        header("Location: index.php");
    } else {
        echo "Error -> " . pg_last_error($db);
    }
    
    pg_close($db);
    