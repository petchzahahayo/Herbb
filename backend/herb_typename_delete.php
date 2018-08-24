<?php

    require 'header_admin.php'; 
    
    $type_id = $_GET['type_id'];
    
    //sql DELETE
    $sql_del_typename = "DELETE FROM herb_typename WHERE type_id='$type_id'";
    $res_del_typename = pg_query($db, $sql_del_typename);
    
    if ($res_del_typename) {
        header ("Location: herb_typename_manage.php");
    } 
    else {
        echo "Can not Delete";
        //header ("Location: herb_typename_manage.php");
    }