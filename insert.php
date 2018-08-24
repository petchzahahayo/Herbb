<?php

    require 'connectdb.php';
    
    //รับค่าจากฟอร์ม
    $owner_name = $_POST['owner_name'];
    $owner_address = $_POST['owner_address'];
    
    //คำสั่ง sql 
    //INSERT INTO table_name (column1, column2, column3,...)
    //VALUES (value1, value2, value3,...)
    $sql = "INSERT INTO herb_owner (owner_name, owner_address)"
            . "VALUES ('$owner_name', '$owner_address')";
    $result = $conn->query($sql); //คำสั่งเพื่อให้ sql ทำงาน
    
    if($result) {
        echo "บันทึกข้อมูลเรียบร้อย";
    } else {
        echo $conn->error;
    }
    