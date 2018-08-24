<?php

    require 'connectdb.php';
    
    //รับค่า
    $owner_id = $_POST['owner_id'];
    $owner_name = $_POST['owner_name'];
    $owner_address = $_POST['owner_address'];
    
    $sql = "UPDATE herb_owner "
            . "SET owner_name = '$owner_name', owner_address = '$owner_address'"
            . "WHERE owner_id = '$owner_id'";
    $result = $conn->query($sql);
    
    if($result){
        echo "UpdateComplete";
    } else {
        echo $conn->error;
    }