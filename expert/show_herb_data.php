<?php 
        require 'header_expert.php';
        
        //รับข้อมูล
        $data_id = $_GET['data_id'];

        $sql = "select * from herb_data 
                INNER JOIN herb_typename
                ON herb_data.type_id = herb_typename.type_id
                INNER JOIN herb_name
                ON herb_data.name_id = herb_name.name_id
                WHERE data_id='$data_id'";
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
                    <th class="info">ประเภทสมุนไพร</th>
                    <td><?php echo $row['type_name']; ?></td>
                </tr>                               
                
                <tr>
                    <th class="info">ชื่อสมุนไพร</th>
                    <td><?php echo $row['name_th']; ?></td>
                </tr>

                <tr>
                    <th class="info">ชื่อภาษาอังกฤษ</th>
                    <td><?php echo $row['data_name_eng']; ?></td>
                </tr>
                
                <tr>
                    <th class="info">ชื่อวิทยาศาสตร์</th>
                    <td><?php echo $row['data_name_sci']; ?></td>
                </tr>
                
                <tr>
                    <th class="info">ลักษณะของพืช</th>
                    <td><?php echo $row['data_detail']; ?></td>
                </tr>
                
                <tr>
                    <th class="info">ส่วนที่ใช้ทำยา</th>
                    <td><?php echo $row['data_medicine']; ?></td>
                </tr>
                
                <tr>
                    <th class="info">สรรพคุณ</th>
                    <td><?php echo $row['data_properties']; ?></td>
                </tr>
                
                <?php } ?>
            </table>
            <!--
            <a href="frm_herb_add.php" class="btn btn-primary" >
                <span class="glyphicon glyphicon-plus"> เพิ่มสมุนไพร</span>
            </a>-->
            <a href="herb_manage.php" class="btn btn-danger">กลับหน้าหลัก</a>
        </div>    
    </body>
</html>

