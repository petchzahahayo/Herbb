<?php
        require 'header_expert.php';
        
        //รับค่า
        $user_id = $_GET['user_id'];
        
        //คำสั่ง sql
        $sql = "SELECT * FROM herb_user WHERE user_id='$user_id'";
        $result = pg_query($db, $sql);
        $row = pg_fetch_array($result);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div class="container">
            <h2>แก้ไขข้อมูลสมาชิก</h2>
            <br>
            <form action="user_edit.php" method="POST" enctype="multipart/form-data" class="form-horizontal">
                
                <!-- user_prefix -->
                <div class="form-group">
                    <label for="user_prefix" class="col-md-2 control-label">คำนำหน้า :</label>
                    <div class="col-md-10">
                        <label class="radio-inline">
                            <input type="radio" name="user_prefix" value="นาย"  <?php if($row['user_prefix']=="นาย") echo "checked"; ?>>
                            นาย
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="user_prefix" value="นาง"  <?php if($row['user_prefix']=="นาง") echo "checked"; ?>>
                            นาง
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="user_prefix" value="นางสาว"  <?php if($row['user_prefix']=="นางสาว") echo "checked"; ?>>
                            นางสาว
                        </label>
                    </div>
                </div>
                
                <!-- user_name -->
                <div class="form-group">
                    <label for="user_name" class="col-md-2 control-label">ชื่อ :</label>
                    <div class="col-md-10">
                        <input name="user_name" type="text" class="form-control" value="<?php echo $row['user_name']; ?>">
                    </div>
                </div>
                
                <!-- user_surname -->
                <div class="form-group">
                    <label for="user_surname" class="col-md-2 control-label">นามสกุล :</label>
                    <div class="col-md-10">
                        <input name="user_surname" type="text" class="form-control" value="<?php echo $row['user_surname']; ?>">
                    </div>
                </div>
                
                <!-- user_address -->
                <div class="form-group">
                    <label for="user_address" class="col-md-2 control-label">ที่อยู่ :</label>
                    <div class="col-md-10">
                        <textarea name="user_address" class="form-control" rows="5" id="comment">
                            <?php echo $row['user_address']; ?>
                        </textarea>
                    </div>
                </div>
                
                <!-- user_tel -->
                <div class="form-group">
                    <label for="user_tel" class="col-md-2 control-label">เบอร์โทรศัพท์ :</label>
                    <div class="col-md-10">
                        <input name="user_tel" type="text" class="form-control" value="<?php echo $row['user_tel']; ?>">
                    </div>
                </div>
                
                <!-- user_username -->
                <div class="form-group">
                    <label for="user_username" class="col-md-2 control-label">ชื่อผู้ใช้ :</label>
                    <div class="col-md-10">
                        <input name="user_username" type="text" class="form-control" value="<?php echo $row['user_username']; ?>">
                    </div>
                </div>
                
                <!-- user_password -->
                <div class="form-group">
                    <label for="user_password" class="col-md-2 control-label">รหัสผ่าน :</label>
                    <div class="col-md-10">
                        <input name="user_password" type="password" class="form-control" value="<?php echo $row['user_password']; ?>">
                    </div>
                </div>
                
                <!-- user_email -->
                <div class="form-group">
                    <label for="user_email" class="col-md-2 control-label">อีเมล :</label>
                    <div class="col-md-10">
                        <input name="user_email" type="email" class="form-control" value="<?php echo $row['user_email']; ?>">
                    </div>
                </div>

                <!-- button -->
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input name="user_id" type="hidden" value="<?php echo $row['user_id']; ?>">
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                        <a href="user_manage.php?user_id=<?php echo $row['user_id']; ?>" class="btn btn-danger">กลับหน้าหลัก</a>
                    </div>
                </div>
                <br><br>
                
            </form>
            
        </div>
    </body>
</html>
