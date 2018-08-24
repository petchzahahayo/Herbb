<?php

        require '../connect/connectdb.php';
        
        //รับค่าตัวแปรจากฟอร์ม
        $place_id = $_POST['place_id'];
        $owner_id = $_POST['owner_id'];
        $alphabet = $_POST['name_id'];
        $place_lat = $_POST['place_lat'];
        $place_lng = $_POST['place_lng'];
        
        //upload image
        $ext = pathinfo(($_FILES['place_herbimg']['name']), PATHINFO_EXTENSION); //นามสกุลของไฟล์
        $new_image_name = 'img_' . uniqid() . "." . $ext;
        $image_path = '../images/';
        $upload_path = $image_path . $new_image_name;
        //uploading
        $sucess = move_uploaded_file($_FILES['place_herbimg']['tmp_name'], $upload_path);
        
        if ($sucess==FALSE) {
            echo "ไม่สามารถเพิ่มรูปภาพได้";
            exit();
        }
        
        $place_herbimg = $new_image_name;
        //end upload image
        
        //คำสั่ง sql
        $sql = "INSERT INTO herb_place (place_id, owner_id, name_id,  place_lat, place_lng, place_herbimg)"
                . "VALUES ('$place_id','$owner_id', '$alphabet',  '$place_lat', '$place_lng', '$place_herbimg') ";
        $result = pg_query($db, $sql);
        
        //check 
        if($result){
            //echo "Complete";
            header("Location: place_manage.php");
        } else {
            echo pg_last_error($db);
        }
        
        pg_close($db);

