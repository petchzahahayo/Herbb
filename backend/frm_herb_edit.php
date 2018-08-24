<?php
        require 'header_admin.php';
        
        //รับค่า
        $data_id = $_GET['data_id'];
        
        //คำสั่ง sql
        $sql = "SELECT * FROM herb_data WHERE data_id='$data_id'";
        $result = pg_query($db, $sql);
        $row = pg_fetch_array($result);
        
        //herb_data
        $sqlData = "SELECT * FROM herb_name";
        $resData = pg_query($db, $sqlData);
        
        //sql herb_type
        $sqlType = "SELECT * FROM herb_typename";
        $queryType = pg_query($db, $sqlType);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div class="container">
            <h2>แก้ไขข้อมูลสมุนไพร</h2>
            <br>
            <form action="herb_edit.php" method="POST" enctype="multipart/form-data" class="form-horizontal">
                
                <!-- herb_type -->
                <div class="form-group">
                    <label for="type_id" class="col-md-2 control-label">ประเภทสมุนไพร :</label>
                    <div class="col-md-10">
                        <select name="type_id" id="owner_id" class="form-control">
                            
                            <!-- ดึงข้อมูลจากฐานข้อมูล -->
                            <?php
                            while ($rowType = pg_fetch_row($queryType)) {
                                if ($rowType[0] == $row['type_id']) {
                                    echo "<option value='$rowType[0]' selected>$rowType[1]</option>";
                                } else {
                                    echo "<option value='$rowType[0]'>$rowType[1]</option>";
                                }
                            }
                            ?>
                                    
                        </select>
                    </div>
                </div>
                
                <!-- name_th -->
                <div class="form-group">
                    <label for="name_id" class="col-md-2 control-label">ชื่อสมุนไพร :</label>
                    <div class="col-md-10">
                        <select name="name_id" class="form-control">

                            <!-- ดึงข้อมูลจากฐานข้อมูล -->
                            <?php
                            while ($rowData = pg_fetch_row($resData)) {
                                if ($rowData[0] == $row['name_id']) {
                                    echo "<option value='$rowData[0]' selected>$rowData[1]</option>";
                                } else {
                                    echo "<option value='$rowData[0]'>$rowData[1]</option>";
                                }
                            }
                            ?>

                        </select>
                    </div>
                </div>
                
                <!-- name_eng -->
                <div class="form-group">
                    <label class="col-md-2 control-label">ชื่อภาษาอังกฤษ :</label>
                    <div class="col-md-10">
                        <input name="data_name_eng" type="text" class="form-control" value="<?php echo $row['data_name_eng']; ?>">
                    </div>
                </div>
                
                <!-- name_sci -->
                <div class="form-group">
                    <label class="col-md-2 control-label">ชื่อวิทยาศาสตร์ :</label>
                    <div class="col-md-10">
                        <input name="data_name_sci" type="text" class="form-control" value="<?php echo $row['data_name_sci']; ?>">
                    </div>
                </div>
                
                <!-- data_detail -->
                <div class="form-group">
                    <label class="col-md-2 control-label">ลักษณะของพืช :</label>
                    <div class="col-md-10">
                        <textarea name="data_detail" class="form-control" rows="5">
                            <?php echo $row['data_detail']; ?>
                        </textarea>
                    </div>
                </div>
                
                <!-- data_medicine -->
                <div class="form-group">
                    <label class="col-md-2 control-label">ส่วนที่ใช้ทำยา :</label>
                    <div class="col-md-10">
                        <input name="data_medicine" type="text" class="form-control" value="<?php echo $row['data_medicine']; ?>">
                    </div>
                </div>
                
                <!-- data_properties -->
                <div class="form-group">
                    <label class="col-md-2 control-label">สรรพคุณ :</label>
                    <div class="col-md-10">
                        <textarea name="data_properties" class="form-control" rows="5">
                            <?php echo $row['data_properties']; ?>
                        </textarea>
                    </div>
                </div>
                
                <!-- button -->
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input type="hidden" name="data_id" value="<?php echo $row['data_id'] ?>">
                        <button type="submit" class="btn btn-primary">แก้ไข</button>
                        <a href="herb_manage.php" class="btn btn-danger">กลับหน้าหลัก</a>
                    </div>
                </div>
                
            </form>
        </div>
    </body>
</html>
