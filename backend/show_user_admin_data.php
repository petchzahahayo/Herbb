<?php 
        require 'header_admin.php';

        //รับข้อมูล
        $user_id = base64_decode($_GET['user_id']);

        $sql = "SELECT * FROM herb_user WHERE user_id='$user_id'";
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
            <h2>ข้อมูลผู้ดูแลระบบ</h2>
            <table class="table table-bordered">
                
                <!-- show data -->
                <?php while ($row = pg_fetch_array($result)){ ?>
                <tr>
                    <th class="info">ชื่อ</th>
                    <td><?php echo $row['user_prefix'].$row['user_name']; ?></td>
                </tr>
                
                <tr>
                    <th class="info">นามสกุล</th>
                    <td><?php echo $row['user_surname']; ?></td>
                </tr>
                
                <?php if ($row['user_status'] == 'expert') { ?>
                <tr>
                    <th class="info">คุณวุฒิ </th>
                    <td><?php echo $row['user_edu']; ?></td>
                </tr>
                
                <tr>
                    <th class="info">สาขาที่เชียวชาญ</th>
                    <td><?php echo $row['user_expert']; ?></td>
                </tr>
                
                <tr>
                    <th class="info">สถานที่ทำงาน</th>
                    <td><?php echo $row['user_workplace']; ?></td>
                </tr>
                <?php } ?>
                
                <tr>
                    <th class="info">ที่อยู่</th>
                    <td><?php echo $row['user_address']; ?></td>
                </tr>
                
                <tr>
                    <th class="info">เบอร์โทรศัพท์</th>
                    <td><?php echo $row['user_tel']; ?></td>
                </tr>

                <tr>
                    <th class="info">ชื่อผู้ใช้</th>
                    <td><?php echo $row['user_username']; ?></td>
                </tr>
                
                <!--<tr>
                    <th class="info">รหัสผ่าน</th>
                    <td><?php echo $row['user_password']; ?></td>
                </tr>-->
                
                <tr>
                    <th class="info">อีเมล</th>
                    <td><?php echo $row['user_email']; ?></td>
                </tr>
                
                <tr>
                    <th class="info">สถานะ</th>
                    <td><?php echo $row['user_status']; ?></td>
                </tr>
                
                <?php } ?>
            </table>

            <a href="user_admin_manage.php" class="btn btn-danger" >
                กลับหน้าหลัก</span>
            </a>
            
        </div>    
    </body>
</html>

