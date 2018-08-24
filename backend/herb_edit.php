<?php

    require '../connect/connectdb.php';

    //รับค่าตัวแปรจากฟอร์ม
    $data_id = $_POST['data_id'];
    $type_id = $_POST['type_id'];
    $name_id = $_POST['name_id'];
    $data_name_eng = $_POST['data_name_eng'];
    $data_name_sci = $_POST['data_name_sci'];
    $data_detail = $_POST['data_detail'];
    $data_medicine = $_POST['data_medicine'];
    $data_properties = $_POST['data_properties'];

    //คำสั่ง sql เพื่อ update ข้อมูล
    $sql = "UPDATE herb_data 
                SET type_id = '$type_id',
                name_id='$name_id', 
                data_name_eng='$data_name_eng', 
                data_name_sci='$data_name_sci',
                data_detail='$data_detail', 
                data_medicine='$data_medicine', 
                data_properties='$data_properties'
                WHERE data_id='$data_id' ";
    $result = pg_query($sql);

    if ($result) {
        //echo "Upload Complete";
        header("location: herb_manage.php");
    } else {
        echo "Error = " . pg_last_error($db);
    }

    pg_close($db);

        
        
        