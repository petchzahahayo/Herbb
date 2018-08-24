<?php
        require 'header_admin.php';
        
        //คำสั่ง sql
        $sql = "SELECT * FROM herb_user ORDER BY user_id ASC";
        $result = pg_query($db, $sql)
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>ระบบเก็บข้อมูลสมุนไพร</title>
        <script>
            var url = window.location; 
            // Will only work if string in href matches with location  

           $('ul.nav a[href="'+ url +'"]').parent().addClass('active');    
           // Will also work for relative and absolute hrefs  

           $('ul.nav a').filter(function() { 
                return this.href == url;
           }).parent().addClass('active');
        </script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                
                <div class="col-md-6">
                    <a href="frm_user_admin_add.php" class="btn btn-primary" >
                        <span class="glyphicon glyphicon-plus"> เพิ่มผู้ดูแลระบบ</span>
                    </a>   
                    
                </div>
                
                <div class="col-md-6">
                    <a href="user_manage.php" type="button" class="btn btn-success">
                        <span class="glyphicon glyphicon-th-list"> รายชื่อสมาชิก </span>
                    </a>  
                    <a href="user_expert_manage.php" type="button" class="btn btn-success">
                        <span class="glyphicon glyphicon-th-list"> รายชื่อผู้เชี่ยวชาญ </span>
                    </a>
                </div>
                
            </div>
            
            <h2>ข้อมูลผู้ดูแลระบบ</h2> 
            <table class="table table-bordered">
                <thead>
                    <tr class="info">
                        <!--<th><center>#</center></th>-->
                        <th><center>ชื่อ</center></th>
                        <th><center>สถานะ</center></th>
                        <th><center>ดูข้อมูล</center></th>
                        <th><center>แก้ไข</center></th>
                        <th><center>ลบ</center></th>
                    </tr>
                </thead>
                
                <!-- show data -->
                <?php while($row = pg_fetch_array($result)){ 
                        if ($row['user_status']=='admin') {
                ?>
                <tbody>
                    <tr>
                        <!-- ลำดับ 
                        <td><center><?php echo $row['user_id']; ?></center></td>-->
            
                        <!-- ชื่อ -->
                        <td><center><?php echo $row['user_name'] . " " . $row['user_surname']; ?></center></td>
            
                        <!-- สถานะ -->
                        <td><center><?php echo $row['user_status']; ?></center></td>
            
                        <!-- ดูข้อมูล -->
                        <td><center><a href="show_user_admin_data.php?user_id=<?php echo base64_encode($row['user_id']); ?>" class="btn btn-info btn-md">
                                <span class="glyphicon glyphicon-eye-open"></span>
                        </a></center></td>
                        
                        <!-- edit -->
                        <td><center><a href="frm_user_admin_edit.php?user_id=<?php echo base64_encode($row['user_id']); ?>" class="btn btn-warning btn-md">
                                <span class="glyphicon glyphicon-pencil"></span>
                        </a></center></td>
                        
                        <!-- delete -->
                        <td><center><a href="user_delete.php?user_id=<?php echo base64_encode($row['user_id']); ?>" class="btn btn-danger btn-md">
                                <span class="glyphicon glyphicon-remove"></span>
                        </a></center></td>
                    </tr>
                </tbody>
                <?php }} ?>
            </table>
            
        </div>
    </body>
</html>
