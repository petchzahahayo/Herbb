<?php 
        require 'header_expert.php';
        
        //alphabet
        $sql_alphabet = "SELECT * FROM herb_alphabet";
        $res_alphabet = pg_query($db, $sql_alphabet);
        
        //name
        $sql_name = "SELECT MAX(name_id) FROM herb_name";
        $res_name = pg_query($db, $sql_name);
        $row_name = pg_fetch_row($res_name);
        $row_name1 = $row_name[0];
        $row_name2 = $row_name1 + 1;
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
            <h2>กรอกชื่อสมุนไพร</h2>
            <br>
            <form action="herb_name_insert.php" method="POST" enctype="multipart/form-data" class="form-horizontal">
                
                <!-- name_id -->
                <div class="form-group">
                    <label for="name_id" class="col-md-2 control-label">ลำดับ :</label>
                    <div class="col-md-10">
                        <input name="name_id" type="text" class="form-control" value="<?php echo $row_name2; ?>" readonly>
                    </div>
                </div>
                
                <!-- name_th -->
                <div class="form-group">
                    <label for="name_th" class="col-md-2 control-label">ชื่อสมุนไพร :</label>
                    <div class="col-md-10">
                        <input name="name_th" type="text" class="form-control">
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
                                            echo "<option value='$row_alphabet[0]'>$row_alphabet[1]</option>"; 
                                        }
                                    ?>
                        </select>
                    </div>
                </div>

                <!-- button -->
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                        <a href="herb_name_manage.php" class="btn btn-danger">กลับหน้าหลัก</a>
                    </div>
                </div>
                
            </form>
            
        </div>
    </body>
</html>
