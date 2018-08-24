<?php
        require '../connect/connectdb.php';
        
        //รับค่า h_id
        $data_id = $_GET['data_id'];

        //sqlDelete Image
        $sql_image = "SELECT data_image FROM herb_data WHERE data_id='$data_id'";
        $res_image = pg_query($db, $sql_image);
        $data_image = pg_fetch_row($res_image);
        $file_name = $data_image[0];
        
        unlink("../images/" . $file_name);
        
        //คำสั่ง sql เพื่อลบ
        $sql_delete = "DELETE FROM herb_data WHERE data_id='$data_id'";
        $result_delete = pg_query($db, $sql_delete);
        
        if($result_delete){
            header("location: herb_manage.php");
        } else {
            echo pg_last_error($db);
        }
        
        pg_close($db);