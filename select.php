<?php 
        require 'header.php';
        require 'connectdb.php';
        
        /* คำสั่ง sql ดึงข้อมูลมาแสดงจากฐานข้อมูล
        SELECT * FROM table_name
         */
        $sql = "SELECT * FROM herb_owner";
        $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            
            <table class="table">
                <!-- หัวตาราง -->
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Edit</th>
                </tr>
                
                <!-- ดึงข้อมูลมาจากฐานข้อมูล -->
                <?php 
                        while($row = $result->fetch_array()){
                ?>
 
                <tr>
                    <td><?php echo $row['owner_id'] ?></td>
                    <td><?php echo $row['owner_name'] ?></td>
                    <td><?php echo $row['owner_address'] ?></td>
                    <td><a href="form_edit.php?owner_id=<?php echo $row['owner_id'] ?>">Edit</a></td>
                </tr>
                
                <?php 
                        }
                ?>
                
            </table>
            
        </div>
    </body>
</html>
