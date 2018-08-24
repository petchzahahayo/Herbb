<?php

    require '../connect/connectdb.php';
    
    //รับข้อมูล
    $name_id = $_POST['name_id'];
    $name_th = $_POST['name_th'];
    $alphabet_id = $_POST['alphabet_id'];
    
    //sql Update
    $sql_up_name = "UPDATE herb_name
                    SET name_id='$name_id', 
                        name_th='$name_th',
                        alphabet_id=$alphabet_id
                        WHERE name_id='$name_id'
                   ";
    $res_up_name = pg_query($db, $sql_up_name);
    
    if ($res_up_name) {
        header ("Location: herb_name_manage.php");
    } 
    else {
        echo "Can not Update";
    }
    

