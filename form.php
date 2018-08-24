<?php 
        require 'header.php';
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
            
            <form action="insert.php" method="post">
                <div class="form-group">
                    
                    <label>ชื่อ: </label>
                    <input name="owner_name" type="text" required>
                    
                    <label>ที่อยู่: </label>
                    <input name="owner_address" type="text" required>
                    
                    <input type="submit" value="ตกลง">
                    
                </div>
            </form>
            
        </div>
        
    </body>
</html>
