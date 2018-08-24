<?php

require '../connect/connectdb.php';
require 'function.php';

//upload image      
if (is_uploaded_file($_FILES['owner_image']['tmp_name'])) {
    
    //รับค่าตัวแปรจากฟอร์ม frm_user_edit
    $owner_id = $_POST['owner_id'];
    $owner_name = $_POST['owner_name'];
    $owner_address = $_POST['owner_address'];
    $owner_age = $_POST['owner_age'];
    $owner_education = $_POST['owner_education'];
    $owner_career = $_POST['owner_career'];
    $owner_revenue = $_POST['owner_revenue'];
    $owner_health = $_POST['owner_health'];
    $owner_career2 = $_POST['owner_career2'];
    $owner_health2 = $_POST['owner_health2'];

    //edit image
    $sql_image = "SELECT owner_image FROM herb_owner WHERE owner_id='$owner_id'";
    $res_image = pg_query($db, $sql_image);
    $row_image = pg_fetch_row($res_image);
    $image_old = $row_image[0];

    unlink("../images/owner/" . $image_old);
    
    //update image
    $image_ext = pathinfo(basename($_FILES['owner_image']['name']), PATHINFO_EXTENSION);
    $new_image_name = 'img_' . uniqid() . "." . $image_ext;
    $image_path = "../images/owner/";
    $img_upload_path = $image_path . $new_image_name;
    $success = move_uploaded_file($_FILES['owner_image']['tmp_name'], $img_upload_path);
    $owner_image = $new_image_name;
    //end upload image  

    //คำสั่ง sql เพื่อ update ข้อมูล
    $sql = "UPDATE herb_owner 
                    SET owner_name='$owner_name',
                        owner_address='$owner_address', 
                        owner_age = '$owner_age',
                        owner_education = '$owner_education',
                        owner_career = '$owner_career',
                        owner_revenue = '$owner_revenue',
                        owner_health = '$owner_health',
                        owner_image = '$owner_image',
                        owner_career2 = '$owner_career2',
                        owner_health2 = '$owner_health2'    
                    WHERE owner_id='$owner_id'";
    $result = pg_query($sql);

    if ($result) {
        //echo "Upload Complete";
        header("location: owner_manage.php");
    } else {
        echo "Error = " . pg_last_error($db);
    }

    pg_close($db);
}
else 
{
    //รับค่าตัวแปรจากฟอร์ม frm_user_edit
    $owner_id = $_POST['owner_id'];
    $owner_name = $_POST['owner_name'];
    $owner_address = $_POST['owner_address'];
    $owner_age = $_POST['owner_age'];
    $owner_education = $_POST['owner_education'];
    $owner_career = $_POST['owner_career'];
    $owner_revenue = $_POST['owner_revenue'];
    $owner_health = $_POST['owner_health'];
    $owner_career2 = $_POST['owner_career2'];
    $owner_health2 = $_POST['owner_health2'];
    
    //คำสั่ง sql เพื่อ update ข้อมูล
    $sql = "UPDATE herb_owner 
                    SET owner_name='$owner_name',
                        owner_address='$owner_address', 
                        owner_age = '$owner_age',
                        owner_education = '$owner_education',
                        owner_career = '$owner_career',
                        owner_revenue = '$owner_revenue',
                        owner_health = '$owner_health',
                        owner_career2 = '$owner_career2',
                        owner_health2 = '$owner_health2'    
                    WHERE owner_id='$owner_id'";
    $result = pg_query($sql);

    if ($result) {
        //echo "Upload Complete";
        header("location: owner_manage.php");
    } else {
        echo "Error = " . pg_last_error($db);
    }

    pg_close($db);
}
        