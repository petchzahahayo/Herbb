<?php
        require '../connect/connectdb.php';
    
        //รับค่า h_id
        $user_id = base64_decode($_GET['user_id']);
        
        //คำสั่ง sql เพื่อลบ
        $sql = "DELETE FROM herb_user WHERE user_id='$user_id'";
        $result = pg_query($db, $sql);
        
        if($result){
            header("location: user_manage.php");
        } else {
            echo pg_last_error($db);
        }
        
        pg_close($db);

