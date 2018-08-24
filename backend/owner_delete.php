<?php
        
        require '../connect/connectdb.php';
        require 'function.php';
    
        //รับค่า h_id
        $owner_id = $_GET['owner_id'];
        
        //delete image
        $sql_image = "SELECT owner_image FROM herb_owner WHERE owner_id='$owner_id'";
        $path = 'image_owner/';
        deleteImage($sql_image, $path);
        
        //คำสั่ง sql เพื่อลบ
        $sql = "DELETE FROM herb_owner WHERE owner_id='$owner_id'";
        $result = pg_query($db, $sql);
        
        if($result){
            header("location: owner_manage.php");
        } else {
            echo pg_last_error($db);
        }
        
        pg_close($db);

