<?php
        require 'header_admin.php';
        
        //คำสั่ง sql
        $sql = "SELECT * FROM herb_owner ORDER BY owner_id ASC";
        $result = pg_query($db, $sql)
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
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
            <a href="frm_owner_add.php" class="btn btn-primary" >
                <span class="glyphicon glyphicon-plus"> เพิ่มเจ้าของ</span>
            </a>
            
            <h2>ข้อมูลเจ้าของ</h2> 
            <table class="table table-bordered">
                <thead>
                    <tr class="info">
<!--                        <th><center>#</center></th>-->
                        <th><center>ชื่อ</center></th>
                        <th><center>ดูข้อมูล</center></th>
                        <th><center>แก้ไข</center></th>
                        <th><center>ลบ</center></th>
                    </tr>
                </thead>
                
                <!-- show data -->
                <?php while($row = pg_fetch_array($result)){ ?>
                <tbody>
                    <tr>
                        <!-- ชื่อ -->
                        <td><center><?php echo $row['owner_name']; ?></center></td>
            
                        <!-- ดูข้อมูล -->
                        <td><center><a href="show_owner_data.php?owner_id=<?php echo $row['owner_id']; ?>" class="btn btn-info btn-md">
                                <span class="glyphicon glyphicon-eye-open"></span>
                        </a></center></td>
                        
                        <!-- edit -->
                        <td><center><a href="frm_owner_edit.php?owner_id=<?php echo $row['owner_id']; ?>" class="btn btn-warning btn-md">
                                <span class="glyphicon glyphicon-pencil"></span>
                        </a></center></td>
                        
                        <!-- delete -->
                        <td><center><a href="owner_delete.php?owner_id=<?php echo $row['owner_id']; ?>" class="btn btn-danger btn-md">
                                <span class="glyphicon glyphicon-remove"></span>
                        </a></center></td>
                    </tr>
                </tbody>
                <?php } ?>
            </table>
            
        </div>
    </body>
</html>
