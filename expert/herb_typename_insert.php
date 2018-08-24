<?php

    require '../connect/connectdb.php';
    
    $type_id = $_POST['type_id'];
    $type_name = $_POST['type_name'];
    $type_details = $_POST['type_details'];
    
    //คำสั่ง sql        
        $sql = "INSERT INTO herb_typename (type_id, type_name, type_details) 
                VALUES ('$type_id', '$type_name', '$type_details') 
               ";
        $result = pg_query($db, $sql);
        
        //check 
        if($result){
            //echo "Complete";
            header("Location: herb_typename_manage.php");
        } else {
            echo pg_last_error($db);
        }
        
        pg_close($db);

