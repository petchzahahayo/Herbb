<?php 
        require 'header_admin.php';        
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div class="container">
            <h2>กรอกข้อมูลสมาชิก</h2>
            <div>
                <!--<a href="frm_user_expert_add.php" class="btn btn-primary">
                    เพิ่มข้อมูลผู้เชี่ยวชาญ
                </a>-->
            </div>
            <br>
            <form action="user_insert.php" method="POST" enctype="multipart/form-data" class="form-horizontal">
                
                <!-- user_prefix -->
                <div class="form-group">
                    <label for="user_prefix" class="col-md-2 control-label">คำนำหน้า :</label>
                    <div class="col-md-10">
                        <label class="radio-inline">
                            <input type="radio" name="user_prefix" value="นาย">
                            นาย
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="user_prefix" value="นาง">
                            นาง
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="user_prefix" value="นางสาว">
                            นางสาว
                        </label>
                    </div>
                </div>
                
                <!-- user_name -->
                <div class="form-group">
                    <label for="user_name" class="col-md-2 control-label">ชื่อ :</label>
                    <div class="col-md-10">
                        <input name="user_name" type="text" class="form-control" placeholder="ชื่อ" required>
                    </div>
                </div>
                
                <!-- user_surname -->
                <div class="form-group">
                    <label for="user_surname" class="col-md-2 control-label">นามสกุล :</label>
                    <div class="col-md-10">
                        <input name="user_surname" type="text" class="form-control" placeholder="นามสกุล" required>
                    </div>
                </div>
                
                <!-- user_address -->
                <div class="form-group">
                    <label for="user_address" class="col-md-2 control-label">ที่อยู่ :</label>
                    <div class="col-md-10">
                        <textarea name="user_address" class="form-control" rows="5" id="comment" required>
                            
                        </textarea>
                    </div>
                </div>
                
                <!-- user_tel -->
                <div class="form-group">
                    <label for="user_tel" class="col-md-2 control-label">เบอร์โทรศัพท์ :</label>
                    <div class="col-md-10">
                        <input name="user_tel" type="text" class="form-control" placeholder="xxx-xxxxxxx" required>
                    </div>
                </div>
                
                <!-- user_username -->
                <div class="form-group">
                    <label for="user_username" class="col-md-2 control-label">ชื่อผู้ใช้ :</label>
                    <div class="col-md-10">
                        <input name="user_username" type="text" class="form-control" placeholder="username" required>
                    </div>
                </div>
                
                <!-- user_password -->
                <div class="form-group">
                    <label for="user_password" class="col-md-2 control-label">รหัสผ่าน :</label>
                    <div class="col-md-10">
                        <input name="user_password" type="password" class="form-control" placeholder="password" required>
                    </div>
                </div>
                
                <!-- user_email -->
                <div class="form-group">
                    <label for="user_email" class="col-md-2 control-label">อีเมล :</label>
                    <div class="col-md-10">
                        <input name="user_email" type="email" class="form-control" placeholder="email" required>
                    </div>
                </div>
                
                <!-- user_status -->
                <div class="form-group">
                    <label for="user_status" class="col-md-2 control-label">สถานะ :</label>
                    <div class="col-md-10">                                              
                        <label class="radio-inline">
                            <input type="radio" name="user_status" value="user" checked>
                            User
                        </label>                        
                        <!--<label class="radio-inline">
                            <input type="radio" name="user_status" value="admin" >
                            Admin
                        </label>  -->                     
                    </div>
                </div>

                <!-- button -->
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                        <a href="user_manage.php" class="btn btn-danger">กลับหน้าหลัก</a>
                    </div>
                </div>
                <br><br>
                
            </form>
            
        </div>
    </body>
</html>
