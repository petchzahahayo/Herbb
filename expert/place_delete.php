<?php
        
        require '../connect/connectdb.php';
    
        //รับค่า h_id
        $place_id = $_GET['place_id'];
        
        //คำสั่ง sql เพื่อลบ
        $sql = "DELETE FROM herb_place WHERE place_id='$place_id'";
        $result = pg_query($db, $sql);
        
        if($result){
            header("location: place_manage.php");
        } else {
            echo pg_last_error($db);
        }
        
        pg_close($db);

