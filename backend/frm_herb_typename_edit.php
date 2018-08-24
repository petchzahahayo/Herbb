<?php 
        require 'header_admin.php';
        
        $type_id = $_GET['type_id'];
        
        //name
        $sql_typename = "SELECT * FROM herb_typename WHERE type_id='$type_id'";
        $res_typename = pg_query($db, $sql_typename);
        $row_typename = pg_fetch_array($res_typename);
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
            <h2>แก้ไขประเภทสมุนไพร</h2>
            <br>
            <form action="herb_typename_edit.php" method="POST" enctype="multipart/form-data" class="form-horizontal">
                
                <!-- type_name -->
                <div class="form-group">
                    <label for="type_name" class="col-md-2 control-label">ประเภทสมุนไพร :</label>
                    <div class="col-md-10">
                        <input name="type_name" type="text" class="form-control" value="<?php echo $row_typename['type_name']; ?>">
                    </div>
                </div>   
                
                <!-- type_details -->
                <div class="form-group">
                    <label for="type_details" class="col-md-2 control-label">รายละเอียด :</label>
                    <div class="col-md-10">
                        <textarea name="type_details" class="form-control" rows="5">
                            <?php echo $row_typename['type_details']; ?>
                        </textarea>
                    </div>
                </div>

                <!-- button -->
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input name="type_id" type="hidden" value="<?php echo $row_typename['type_id']; ?>">
                        <button type="submit" class="btn btn-primary">แก้ไข</button>
                        <a href="herb_typename_manage.php" class="btn btn-danger">กลับหน้าหลัก</a>
                    </div>
                </div>
                
            </form>
            
        </div>
    </body>
</html>
