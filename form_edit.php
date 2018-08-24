<?php 
        require 'header.php';
        require 'connectdb.php';
        
        //รับค่าตัวแปร
        $owner_id = $_GET['owner_id'];
        
        $sql = "SELECT * FROM herb_owner WHERE owner_id = $owner_id";
        $result = $conn->query($sql);
        $row = $result->fetch_array();
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
            
            <form action="edit.php" method="post">
                <div class="form-group">
                    <h2>แก้ไข</h2>
                    <label>ชื่อ: </label>
                    <input name="owner_name" type="text" value="<?php echo $row['owner_name']; ?>">
                    
                    <label>ที่อยู่: </label>
                    <input name="owner_address" type="text" value="<?php echo $row['owner_address']; ?>">
                    
                    <input type="hidden" name="owner_id" value="<?php echo $row['owner_id'] ?>">
                    <input type="submit" value="แก้ไข">
                    
                </div>
            </form>
            
        </div>
        
    </body>
</html>
