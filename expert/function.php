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


