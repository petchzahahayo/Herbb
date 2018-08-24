<?php 
        require 'header_expert.php';
        
        //sql herb_type
        $sqlType = "SELECT * FROM herb_typename";
        $queryType = pg_query($db, $sqlType);
        
        //sql herb_name
        $sql_name = "SELECT * FROM herb_name";
        $res_name = pg_query($db, $sql_name);
        
        //herb_data
        $sql_data = "SELECT MAX(data_id) FROM herb_data";
        $res_data = pg_query($db, $sql_data);
        $row_data = pg_fetch_row($res_data);
        $row_data1 = $row_data[0];
        $row_data2 = $row_data1 + 1;
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
            <h2>กรอกข้อมูลสมุนไพร</h2>
            <br>
            <form action="herb_insert.php" method="POST" enctype="multipart/form-data" class="form-horizontal">
                
                <!-- data_id -->
                <div class="form-group">
                    <label for="data_id" class="col-md-2 control-label">ลำดับ :</label>
                    <div class="col-md-10">
                        <input name="data_id" type="text" class="form-control" value="<?php echo $row_data2; ?>" readonly>
                    </div>
                </div>
                
                <!-- herb_type -->
                <div class="form-group">
                    <label for="type_id" class="col-md-2 control-label">ประเภทสมุนไพร :</label>
                    <div class="col-md-10">
                        <select name="type_id" id="owner_id" class="form-control">
                                    <!-- ดึงข้อมูลจากฐานข้อมูล -->
                                    <?php
                                        while($rowType = pg_fetch_row($queryType))
                                        {
                                            echo "<option value='$rowType[0]'>$rowType[1]</option>"; 
                                        }
                                    ?>
                        </select>
                    </div>
                </div>
                
                <!-- alphabet -->
                <div class="form-group">
                    <label for="alphabet" class="col-md-2 control-label">ชื่อสมุนไพร :</label>
                    <div class="col-md-10">
                            <select name="alphabet" id="alphabet" class="form-control">
                                <option value="">--เลือกตัวอักษร--</option>
                                
                                    <!-- ดึงข้อมูลจากฐานข้อมูล -->
                                    <?php
                                        $sql_alphabet = "SELECT * FROM herb_alphabet";
                                        $res_alphabet = pg_query($db, $sql_alphabet);
                                    
                                        while($row_alphabet = pg_fetch_array($res_alphabet))
                                        {
                                            $alphabet_id = $row_alphabet['alphabet_id'];
                                            $alphabet_th = $row_alphabet['alphabet_th'];
                                            echo "<option value='$alphabet_id'>$alphabet_th</option>";
                                        }
                                    ?>
                                
                            </select>
                    </div>
                </div>

                <!-- data_name_eng -->
                <div class="form-group">
                    <label for="data_name_eng" class="col-md-2 control-label">ชื่อภาษาอังกฤษ :</label>
                    <div class="col-md-10">
                        <input name="data_name_eng" type="text" class="form-control">
                    </div>
                </div>
                
                <!-- data_name_sci -->
                <div class="form-group">
                    <label for="data_name_sci" class="col-md-2 control-label">ชื่อวิทยาศาสตร์ :</label>
                    <div class="col-md-10">
                        <input name="data_name_sci" type="text" class="form-control">
                    </div>
                </div>
                
                <!-- data_detail -->
                <div class="form-group">
                    <label for="data_detail" class="col-md-2 control-label">ลักษณะของพืช :</label>
                    <div class="col-md-10">
                        <textarea name="data_detail" class="form-control" rows="5"></textarea>
                    </div>
                </div>
                
                <!-- data_medicine -->
                <div class="form-group">
                    <label for="data_medicine" class="col-md-2 control-label">ส่วนที่ใช้ทำยา :</label>
                    <div class="col-md-10">
                        <textarea name="data_medicine" class="form-control" rows="5"></textarea>
                    </div>
                </div>
                
                <!-- data_properties -->
                <div class="form-group">
                    <label for="data_properties" class="col-md-2 control-label">สรรพคุณ :</label>
                    <div class="col-md-10">
                        <textarea name="data_properties" class="form-control" rows="5"></textarea>
                    </div>
                </div>

                <!-- button -->
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                        <a href="herb_manage.php" class="btn btn-danger">กลับหน้าหลัก</a>
                    </div>
                </div>
                <br><br>
                
            </form>
            
        </div>
    </body>
</html>
