<?php

        require '../connect/connectdb.php';
        
        //รับค่าตัวแปรจากฟอร์ม
        $name_id = $_POST['name_id'];
        $name_th = $_POST['name_th'];
        $alphabet_id = $_POST['alphabet_id'];
        
        //คำสั่ง sql        
        $sql = "INSERT INTO herb_name (name_id, name_th, alphabet_id) 
                VALUES ('$name_id', '$name_th', '$alphabet_id') 
               ";
        $result = pg_query($db, $sql);
        
        //check 
        if($result){
            //echo "Complete";
            header("Location: herb_manage.php");
        } else {
            echo pg_last_error($db);
        }
        
        pg_close($db);