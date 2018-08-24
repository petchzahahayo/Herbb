<?php
    require 'header_admin.php';

    //name
    $sql_typename = "SELECT MAX(type_id) FROM herb_typename";
    $res_typename = pg_query($db, $sql_typename);
    $row_typename = pg_fetch_row($res_typename);
    $row_typename1 = $row_typename[0];
    $row_typename2 = $row_typename1 + 1;
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div class="container">
            <h2>กรอกชื่อประเภทสมุนไพร</h2>
            <br>
            <form action="herb_typename_insert.php" method="POST" enctype="multipart/form-data" class="form-horizontal">
                
                <!-- type_id -->
                <input name="type_id" type="hidden" class="form-control" value="<?php echo $row_typename2; ?>">


                <!-- type_name -->
                <div class="form-group">
                    <label for="type_name" class="col-md-2 control-label">ชื่อประเภทสมุนไพร :</label>
                    <div class="col-md-10">
                        <input name="type_name" type="text" class="form-control">
                    </div>
                </div>  
                
                <!-- type_details -->
                <div class="form-group">
                    <label for="type_details" class="col-md-2 control-label">รายละเอียด :</label>
                    <div class="col-md-10">
                        <textarea name="type_details" class="form-control" rows="5">
                            
                        </textarea>
                    </div>
                </div>  

                <!-- button -->
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                        <a href="herb_typename_manage.php" class="btn btn-danger">กลับหน้าหลัก</a>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>
