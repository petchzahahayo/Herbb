<?php

    require 'header_admin.php';      
    
    $name_id = $_GET['name_id'];
    
    $sql_name = "SELECT * FROM herb_name WHERE name_id='$name_id'";
    $res_name = pg_query($db, $sql_name);
    $row_name = pg_fetch_array($res_name);
    //echo $row_name['name_th'];
    //sql DELETE
    $sql_del_name = "DELETE FROM herb_name WHERE name_id='$name_id'";
    $res_del_name = pg_query($db, $sql_del_name);
    
    if ($res_del_name) {
        header ("Location: herb_name_manage.php");
    } 
    else {
        echo "Can not Delete";
    }
    