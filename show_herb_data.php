<?php 
        require 'header.php';
        require 'connect/connectdb.php';
        
        //รับข้อมูล
        $data_id = $_GET['data_id'];

        $sql = "SELECT * FROM herb_data WHERE data_id='$data_id' ORDER BY data_id ASC";
        $result = pg_query($db, $sql);
        
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div class="container">
            <h2>ข้อมูลสมุนไพร</h2>
            <table class="table table-bordered">
                
                <!-- show data -->
                <?php while ($row = pg_fetch_array($result)){ ?>
                <tr>
                    <th class="info">ชื่อ</th>
                    <td><?php echo $row['data_name_common'] ?></td>
                </tr>
                
                <tr>
                    <th class="info">ชื่อภาษาอังกฤษ</th>
                    <td><?php echo $row['data_name_eng'] ?></td>
                </tr>
                
                <tr>
                    <th class="info">ชื่อวิทยาศาสตร์</th>
                    <td><?php echo $row['data_name_sci'] ?></td>
                </tr>
                
                <tr>
                    <th class="info">ลักษณะของพืช</th>
                    <td><?php echo $row['data_detail'] ?></td>
                </tr>
                
                <tr>
                    <th class="info">ส่วนที่ใช้ทำยา</th>
                    <td><?php echo $row['data_medicine'] ?></td>
                </tr>
                
                <tr>
                    <th class="info">สรรพคุณ</th>
                    <td><?php echo $row['data_properties'] ?></td>
                </tr>
                
               <tr>
                    <th class="info">รูปภาพ</th>
                    <td><img src="images/<?php echo $row['data_image']; ?>" style="width:100px;height:100px;"></td>
                </tr>
                
                <?php } ?>
            </table>
            <a href="herb_manage.php" class="btn btn-primary" >
                <span class="glyphicon glyphicon-home"> กลับหน้าแรก</span>
            </a>

        </div>    
    </body>
</html>

<?php
    require 'footer.php';
?>
