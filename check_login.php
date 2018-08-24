<?php

    // Start the session
    session_start();

    require 'connect/connectdb.php';

    $user_username = pg_escape_string($_POST['user_username']);
    $user_password = pg_escape_string($_POST['user_password']);

    //เข้ารหัส login_password
    $key = 'sfdjak;nvkio[eirujgtf049u15678465wefqawe';
    $hash_login_password = hash_hmac('sha256', $user_password, $key); // login_password
    
    //Sql Query
    $sql = "SELECT * from herb_user WHERE user_username='$user_username' and user_password='$hash_login_password'";
    $query = pg_query($db, $sql);
    $result = pg_fetch_array($query);
    
    if ($result) {
        // Set session variables
        $_SESSION['user_id'] = $result['user_id'];
        $_SESSION['user_status'] = $result['user_status'];

        session_write_close();

        if ($result['user_status'] == 'admin') {
            header("Location:backend/user_manage.php");
        } 
        elseif($result['user_status'] == 'expert') {
            header("Location:expert/herb_manage.php");
        } 
        else {
            header("Location:user/place_manage.php");
        }
    } 
    else {
        echo '<script>
                alert("ชื่อ หรือ รหัสผ่าน ไม่ถูกต้อง");
                window.location="frm_login.php";
              </script>'; 
    }

    pg_close($db);
