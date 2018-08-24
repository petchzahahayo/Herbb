<?php

    require '../connect/connectdb.php';
   
    //รับค่าตัวแปรจากฟอร์ม
    $place_id = $_POST['place_id'];
    $owner_id = $_POST['owner_id'];
    $name_id = $_POST['name_id'];
    $place_lat = $_POST['place_lat'];
    $place_lng = $_POST['place_lng'];
        
    //upload image
    $image = $_FILES['place_herbimg']['name'];        
    $ext = pathinfo(($image), PATHINFO_EXTENSION); //นามสกุลของไฟล์
    $new_image_name = 'img_' . uniqid() . "." . $ext;
    $image_path = '../images/';
    $upload_path = $image_path . $new_image_name;
    //uploading
    $sucess = move_uploaded_file($_FILES['place_herbimg']['tmp_name'], $upload_path);
        
    if ($sucess == TRUE) {
        $size = getimagesize($upload_path);
        $width = 500; //*** Fix Width & Heigh (Autu caculate) ***//
        $height = 400;
        $images_orig = imagecreatefromjpeg($upload_path); //resize รูปประเภท JPEG 
        $photoX = imagesx($images_orig);
        $photoY = imagesy($images_orig); 
        $images_fin = imagecreatetruecolor($width, $height); 
        imagecopyresampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY); 
        imagejpeg($images_fin, $upload_path); //ชื่อไฟล์ใหม่ 
        imagedestroy($images_orig);
        imagedestroy($images_fin);       
    }
    else {
        echo $_FILES['place_herbimg']['error'];
        exit();
    }
        
    $place_herbimg = $new_image_name;
    //end upload image
        
    //คำสั่ง sql
    $sql = "INSERT INTO herb_place (place_id, owner_id, name_id,  place_lat, place_lng, place_herbimg)
            VALUES ('$place_id', '$owner_id', '$name_id',  '$place_lat', '$place_lng', '$place_herbimg') ";
    $result = pg_query($db, $sql);
        
    //check 
    if($result){
        header("Location: place_manage.php");
    } 
    else {
        echo pg_last_error($db);
    }
        
    pg_close($db);