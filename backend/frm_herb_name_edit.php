<?php 
        require 'header_admin.php';
        
        $name_id = $_GET['name_id'];
        
        //name
        $sql_name = "SELECT * FROM herb_name WHERE name_id='$name_id'";
        $res_name = pg_query($db, $sql_name);
        $row_name = pg_fetch_array($res_name);
        
        //alphabet
        $sql_alphabet = "SELECT * FROM herb_alphabet";
        $res_alphabet = pg_query($db, $sql_alphabet);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src="script.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="container">
            <h2>แก้ไขชื่อสมุนไพร</h2>
            <br>
            <form action="herb_name_edit.php" method="POST" enctype="multipart/form-data" class="form-horizontal">
                
                <!-- name_th -->
                <div class="form-group">
                    <label for="name_th" class="col-md-2 control-label">ชื่อสมุนไพร :</label>
                    <div class="col-md-10">
                        <input name="name_th" type="text" class="form-control" value="<?php echo $row_name['name_th']; ?>">
                    </div>
                </div>   
                
                <!-- alphabet -->
                <div class="form-group">
                    <label for="alphabet_id" class="col-md-2 control-label">หมวดตัวอักษร :</label>
                    <div class="col-md-10">
                        <select name="alphabet_id" id="alphabet_id" class="form-control">
                                    <!-- ดึงข้อมูลจากฐานข้อมูล -->
                                    <?php
                                        while($row_alphabet = pg_fetch_row($res_alphabet))
                                        {
                                            if ($row_alphabet[0] == $row_name['alphabet_id']) {
                                                echo "<option value='$row_alphabet[0]' selected>$row_alphabet[1]</option>"; 
                                            }
                                            echo "<option value='$row_alphabet[0]'>$row_alphabet[1]</option>"; 
                                        }
                                    ?>
                        </select>
                    </div>
                </div>

                <!-- button -->
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input name="name_id" type="hidden" value="<?php echo $row_name['name_id']; ?>">
                        <button type="submit" class="btn btn-primary">แก้ไข</button>
                        <a href="herb_name_manage.php" class="btn btn-danger">กลับหน้าหลัก</a>
                    </div>
                </div>
                
            </form>
            
        </div>
    </body>
</html>
