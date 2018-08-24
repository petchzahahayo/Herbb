<?php

    require '../connect/connectdb.php';
        
    //รับค่าตัวแปรจากฟอร์ม
    if ($_POST) {
        
        $name_th = $_POST['name_th'];
        //echo $name_th."<br>";
        $sql = "SELECT * FROM herb_name where name_th='$name_th'";
        $query = pg_query($db, $sql);
        while ($row = pg_fetch_array($query)) 
        {
            //echo $row['name_id'];
            $name_id = $row['name_id'];
        }
        //echo $name_id;
                    
        $user_id = $_POST['user_id'];
        $place_id = $_POST['place_id'];
        $owner_id = $_POST['owner_id'];
        //$name_id = $_POST['name_id'];
        $place_lat = $_POST['place_lat'];
        $place_lng = $_POST['place_lng'];
        
        //upload image
        $ext = pathinfo(($_FILES['place_herbimg']['name']), PATHINFO_EXTENSION); //นามสกุลของไฟล์
        $new_image_name = 'img_' . uniqid() . "." . $ext;
        $image_path = '../images/';
        $upload_path = $image_path . $new_image_name;
        
        //uploading
        $sucess = move_uploaded_file($_FILES['place_herbimg']['tmp_name'], $upload_path);
        
        if ($sucess == TRUE) {
            $size = getimagesize($upload_path);
            $width = 500; 
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
            echo '<script>
                    alert("ไม่สามารถอัพโหลดรูปภาพได้");
                    window.location="frm_place_add.php";
                  </script>';
            exit();
        }
        
        $place_herbimg = $new_image_name;
        //end upload image
        
        //คำสั่ง sql
        $sql = "INSERT INTO herb_place (place_id, owner_id, name_id,  place_lat, place_lng, place_herbimg, user_id)"
                . "VALUES ('$place_id', '$owner_id', '$name_id', '$place_lat', '$place_lng', '$place_herbimg', '$user_id')";
        $result = pg_query($db, $sql);
        
        //check 
        if($result){
            //echo "Complete";
            header("Location: place_manage.php");
        } else {
            echo pg_last_error($db);
        }
        
        pg_close($db);
    }
    /*if ($_POST)
    {
        $name_th = $_POST['name_th'];
        echo $name_th."<br>";
        $sql = "SELECT * FROM herb_name where name_th='$name_th'";
        $query = pg_query($db, $sql);
        while ($row = pg_fetch_array($query)) 
        {
            echo $row['name_id'];
            $name_id = $row['name_id'];
        }
        echo $name_id;
    }*/