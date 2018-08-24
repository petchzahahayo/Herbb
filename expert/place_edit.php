<?php

require '../connect/connectdb.php';

//upload image      
if (is_uploaded_file($_FILES['place_herbimg']['tmp_name'])) {
    
    $name_th = $_POST['name_th'];
    $sql1 = "SELECT * FROM herb_name where name_th='$name_th'";
    $query = pg_query($db, $sql1);
    while ($row = pg_fetch_array($query)) 
    {
        $name_id = $row['name_id'];
    }
    
    //รับค่าตัวแปรจากฟอร์ม 
    $place_id = $_POST['place_id'];
    //$owner_id = $_POST['owner_id'];
    //$name_id = $_POST['name_id'];
    $user_id = $_POST['user_id'];
    
    //delete old image
    $sql_image = "SELECT place_herbimg FROM herb_place WHERE place_id='$place_id'";
    $res_image = pg_query($db, $sql_image);
    $row_image = pg_fetch_row($res_image);
    $image_old = $row_image[0];

    unlink("../images/" . $image_old);

    //update image
    $image_ext = pathinfo(basename($_FILES['place_herbimg']['name']), PATHINFO_EXTENSION);
    $new_image_name = 'img_' . uniqid() . "." . $image_ext;
    $image_path = "../images/";
    $img_upload_path = $image_path . $new_image_name;
    $success = move_uploaded_file($_FILES['place_herbimg']['tmp_name'], $img_upload_path);
    $place_herbimg = $new_image_name;
    //end upload image  
      
    //คำสั่ง sql เพื่อ update ข้อมูล
    $sql = "UPDATE herb_place 
                    SET 
                        name_id = '$name_id',
                        place_herbimg = '$place_herbimg',
                        user_id = '$user_id'
                    WHERE place_id='$place_id'";
    $result = pg_query($sql);


    if ($result) {
        //echo "Upload Complete";
        header("location: place_manage.php");
    } else {
        echo "Error = " . pg_last_error($db);
    }

    pg_close($db);
} 
else 
{
    $name_th = $_POST['name_th'];
    $sql1 = "SELECT * FROM herb_name where name_th='$name_th'";
    $query = pg_query($db, $sql1);
    while ($row = pg_fetch_array($query)) 
    {
        $name_id = $row['name_id'];
    }
    //รับค่าตัวแปรจากฟอร์ม 
    $place_id = $_POST['place_id'];
    //$owner_id = $_POST['owner_id'];
    //$name_id = $_POST['name_id'];
    $user_id = $_POST['user_id'];
    
    //คำสั่ง sql เพื่อ update ข้อมูล
    $sql = "UPDATE herb_place 
                    SET 
                        name_id = '$name_id',
                        user_id = '$user_id'
                    WHERE place_id='$place_id'";
    $result = pg_query($sql);


    if ($result) {
        //echo "Upload Complete";
        header("location: place_manage.php");
    } else {
        echo "Error = " . pg_last_error($db);
    }

    pg_close($db);
}
        