<?php

require '../connect/connectdb.php';
require 'function.php';

if($_POST) {
    //รับค่าตัวแปรจากฟอร์ม
    $owner_name = $_POST['owner_name'];
    $owner_address = $_POST['owner_address'];
    $owner_age = $_POST['owner_age'];
    $owner_education = $_POST['owner_education'];
    $owner_career2 = $_POST['owner_career2'];
    $owner_health2 = $_POST['owner_health2'];

    if (!empty($_POST['owner_career'])) {
        $owner_career = $_POST['owner_career'];
    } else {
        $owner_career = $_POST['owner_career2'];
    }

    $owner_revenue = $_POST['owner_revenue'];

    if (!empty($_POST['owner_health'])) {
        $owner_health = $_POST['owner_health'];
    } else {
        $owner_health = $_POST['owner_health2'];
    }

    $owner_lat = $_POST['owner_lat'];
    $owner_lng = $_POST['owner_lng'];

    //upload image
    /*$imgName = $_FILES['owner_image']['name'];
    $imgTmp = $_FILES['owner_image']['tmp_name'];
    $path = '../images/owner/';
    $owner_image = insertImage($imgName, $path, $imgTmp);*/
    $ext = pathinfo(($_FILES['owner_image']['name']), PATHINFO_EXTENSION); //นามสกุลของไฟล์
    $new_image_name = 'img_' . uniqid() . "." . $ext;
    $image_path = '../images/owner/';
    $upload_path = $image_path . $new_image_name;
    
    //uploading
    $sucess = move_uploaded_file($_FILES['owner_image']['tmp_name'], $upload_path);
    
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
                    window.location="frm_owner_add.php";
                  </script>';
            exit();
        }
        
        $owner_image = $new_image_name;
        //end upload image

    //คำสั่ง sql
    $sql = "INSERT INTO herb_owner (owner_name, owner_address, owner_age, owner_education, 
                    owner_career, owner_revenue, owner_health, owner_image, owner_lat, owner_lng,owner_career2,owner_health2)
                    VALUES ('$owner_name', '$owner_address', '$owner_age', '$owner_education', '$owner_career', 
                    '$owner_revenue', '$owner_health', '$owner_image', '$owner_lat', '$owner_lng','$owner_career2','$owner_health2') ";
    $result = pg_query($db, $sql);

    //check 
    if ($result) {
        //echo "Complete";
        header("Location: owner_manage.php");
    } else {
        echo pg_last_error($db);
    }

    pg_close($db);
}

