<?php

        require '../connect/connectdb.php';
        
        //รับค่าตัวแปรจากฟอร์ม
        $user_prefix = pg_escape_string($db, $_POST['user_prefix']);
        $user_name = pg_escape_string($db, $_POST['user_name']);
        $user_surname = pg_escape_string($db, $_POST['user_surname']);
        $user_address = pg_escape_string($db, $_POST['user_address']);
        $user_tel = pg_escape_string($db, $_POST['user_tel']);
        $user_username = pg_escape_string($db, $_POST['user_username']);
        $user_password = pg_escape_string($db, $_POST['user_password']);
        $user_email = pg_escape_string($db, $_POST['user_email']);
        $user_status = pg_escape_string($db, $_POST['user_status']);
        
        //เข้ารหัส login_password
        $key = 'sfdjak;nvkio[eirujgtf049u15678465wefqawe';
        $hash_login_password = hash_hmac('sha256', $user_password, $key); // login_password
        
        //คำสั่ง sql
        $query = "  INSERT INTO herb_user(user_prefix, user_name, user_surname, user_address, user_tel, user_username, user_password, user_email, user_status) 
                    VALUES ('$user_prefix' ,'$user_name','$user_surname','$user_address', '$user_tel','$user_username', '$hash_login_password', '$user_email', '$user_status')";
        $result = pg_query($db, $query);
        
        //check 
        if($result){
            echo '<script>
                alert("บันทึกข้อมูลเรียบร้อย");
                window.location="user_admin_manage.php";
              </script>';
            //header("Location: user_manage.php");
        } else {
            echo pg_last_error($db);
        }
        
        pg_close($db);