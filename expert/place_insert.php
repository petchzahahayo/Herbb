<?php

        require '../connect/connectdb.php';
        
        //รับค่าตัวแปรจากฟอร์ม
        $owner_id = $_POST['owner_id'];
        $data_id = $_POST['data_id'];
        $place_herb_lat = $_POST['place_herb_lat'];
        $place_herb_lng = $_POST['place_herb_lng'];
        $user_id = $_POST['user_id'];
        
        //คำสั่ง sql
        $sql = "INSERT INTO herb_place (owner_id, data_id, place_herb_lat, place_herb_lng, user_id)
                VALUES ('$owner_id', '$data_id', '$place_herb_lat', '$place_herb_lng', '$user_id') ";
        $result = pg_query($db, $sql);
        
        //check 
        if($result){
            //echo "Complete";
            header("Location: place_manage.php");
        } else {
            echo pg_last_error($db);
        }
        
        pg_close($db);

