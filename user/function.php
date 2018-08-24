<?php
    //$query = คำสั่ง sql
    function pagination($query)
    {
        //กำหนดจำนวนหน้า
        $perpage = 10;
        
        //เช็คว่าเป็นค่าว่างหรือไม่
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } 
        else {
            $page = 1;
        }
        
        $start = ($page - 1) * $perpage;        
        $result = pg_query(" $query limit {$perpage} offset {$start}");
        return $result;
    } // function
    
    function paginationBar($query)
    {
        //กำหนดจำนวนหน้า
        $perpage = 10;

        $result = pg_query($query);
        $total_record = pg_num_rows($result);
        $total_page = ceil($total_record / $perpage);
        return $total_page;
    } // function
    
    function insertImage($imgName, $path, $imgTmp)
    {
        //upload image
        $ext = pathinfo(($imgName), PATHINFO_EXTENSION); //นามสกุลของไฟล์
        $new_image_name = 'img_' . uniqid() . "." . $ext;
        $image_path = $path;
        $upload_path = $image_path . $new_image_name;
        //uploading
        $sucess = move_uploaded_file($imgTmp, $upload_path);
        
        if ($sucess==FALSE) {
            echo "ไม่สามารถเพิ่มรูปภาพได้";
            exit();
        }
        
        return $new_image_name;
    } // function
    
    function editImage($sql_image, $path, $imgName, $imgTmp)
    {      
        //delete image_old
        $query_image = pg_query($sql_image);
        $row_image = pg_fetch_row($query_image);
        $image_old = $row_image[0];
        unlink($path . $image_old);
        
        //upload image
        $ext = pathinfo(($imgName), PATHINFO_EXTENSION); //นามสกุลของไฟล์
        $new_image_name = 'img_' . uniqid() . "." . $ext;
        $image_path = $path;
        $upload_path = $image_path . $new_image_name;
        //uploading
        $sucess = move_uploaded_file($imgTmp, $upload_path);
        
        if ($sucess==FALSE) {
            echo "ไม่สามารถเพิ่มรูปภาพได้";
            exit();
        }
        
        return $new_image_name;
    } // function
    
    function deleteImage($sql_image, $path)
    {
        //delete image_old
        $query_image = pg_query($sql_image);
        $row_image = pg_fetch_row($query_image);
        $image_old = $row_image[0];
        unlink($path . $image_old);
    } // function
    
