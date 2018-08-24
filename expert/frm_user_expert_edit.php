<?php 
        require 'header_expert.php';    
        
        $user_id = base64_decode($_GET['user_id']);
        
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
            <h2>แก้ไขข้อมูลผู้เชี่ยวชาญ</h2>
            <br>
            <form action="user_expert_edit.php" method="POST" enctype="multipart/form-data" class="form-horizontal">
                
                <!-- user_prefix -->
                <div class="form-group">
                    <label for="user_prefix" class="col-md-2 control-label">ตำแหน่งวิชาการ :</label>
                    <div class="col-md-10">
                        <label class="checkbox-inline">
                            <input type="radio" name="user_prefix" value="นาย" <?php if($row['user_prefix']=='นาย') echo "checked"; ?> required>
                            นาย
                        </label>
                        <label class="checkbox-inline">
                            <input type="radio" name="user_prefix" value="นาง" <?php if($row['user_prefix']=='นาง') echo "checked"; ?> required>
                            นาง
                        </label>
                        <label class="checkbox-inline">
                            <input type="radio" name="user_prefix" value="นางสาว" <?php if($row['user_prefix']=='นางสาว') echo "checked"; ?> required>
                            นางสาว
                        </label>
                        <label class="checkbox-inline">
                            <input type="radio" name="user_prefix" value="ศาสตราจารย์" <?php if($row['user_prefix']=='ศาสตราจารย์') echo "checked"; ?> required>
                            ศาสตราจารย์ 
                        </label>
                        <label class="checkbox-inline">
                            <input type="radio" name="user_prefix" value="รองศาสตราจารย์" <?php if($row['user_prefix']=='รองศาสตราจารย์') echo "checked"; ?> required>
                            รองศาสตราจารย์
                        </label>
                        <label class="checkbox-inline">
                            <input type="radio" name="user_prefix" value="ผู้ช่วยศาสตราจารย์" <?php if($row['user_prefix']=='ผู้ช่วยศาสตราจารย์') echo "checked"; ?> required>
                            ผู้ช่วยศาสตราจารย์
                        </label>
                        <label class="checkbox-inline">
                            <input type="radio" name="user_prefix" value="ดร." <?php if($row['user_prefix']=='ดร.') echo "checked"; ?> required>
                            ดร.
                        </label>
                    </div>
                </div>
                
                <!-- user_name -->
                <div class="form-group">
                    <label for="user_name" class="col-md-2 control-label">ชื่อ :</label>
                    <div class="col-md-10">
                        <input name="user_name" type="text" class="form-control" value="<?php echo $row['user_name']; ?>" required> 
                    </div>
                </div>
                
                <!-- user_surname -->
                <div class="form-group">
                    <label for="user_surname" class="col-md-2 control-label">นามสกุล :</label>
                    <div class="col-md-10">
                        <input name="user_surname" type="text" class="form-control" value="<?php echo $row['user_surname']; ?>" required>
                    </div>
                </div>
                
                <!-- user_edu -->
                <div class="form-group">
                    <label for="user_edu" class="col-md-2 control-label">คุณวุฒิ :</label>
                    <div class="col-md-10">
                        <input name="user_edu" type="text" class="form-control" value="<?php echo $row['user_edu']; ?>" required>
                    </div>
                </div>
                
                <!-- user_expert -->
                <div class="form-group">
                    <label for="user_expert" class="col-md-2 control-label">สาขาที่เชียวชาญ :</label>
                    <div class="col-md-10">
                        <input name="user_expert" type="text" class="form-control" value="<?php echo $row['user_expert']; ?>" required>
                    </div>
                </div>
                
                <!-- user_workplace -->
                <div class="form-group">
                    <label for="user_workplace" class="col-md-2 control-label">สถานที่ทำงาน :</label>
                    <div class="col-md-10">
                        <input name="user_workplace" type="text" class="form-control" value="<?php echo $row['user_workplace']; ?>" required>
                    </div>
                </div>
                
                <!-- user_address -->
                <div class="form-group">
                    <label for="user_address" class="col-md-2 control-label">ที่อยู่ :</label>
                    <div class="col-md-10">
                        <textarea name="user_address" class="form-control" rows="5" id="comment" required>
                                    <?php echo $row['user_address']; ?>
                        </textarea>
                    </div>
                </div>
                
                <!-- user_tel -->
                <div class="form-group">
                    <label for="user_tel" class="col-md-2 control-label">เบอร์โทรศัพท์ :</label>
                    <div class="col-md-10">
                        <input name="user_tel" type="text" class="form-control" value="<?php echo $row['user_tel']; ?>" required>
                    </div>
                </div>
                
                <!-- user_username -->
                <div class="form-group">
                    <label for="user_username" class="col-md-2 control-label">ชื่อผู้ใช้ :</label>
                    <div class="col-md-10">
                        <input name="user_username" type="text" class="form-control" value="<?php echo $row['user_username']; ?>" required>
                    </div>
                </div>
                
                <!-- user_password -->
                <div class="form-group">
                    <label for="user_password" class="col-md-2 control-label">รหัสผ่าน :</label>
                    <div class="col-md-10">
                        <input name="user_password" type="password" class="form-control" value="<?php echo $row['user_password']; ?>" required>
                    </div>
                </div>
                
                <!-- user_email -->
                <div class="form-group">
                    <label for="user_email" class="col-md-2 control-label">อีเมล :</label>
                    <div class="col-md-10">
                        <input name="user_email" type="email" class="form-control" value="<?php echo $row['user_email']; ?>" required>
                    </div>
                </div>
                
                <!-- user_status -->
                <div class="form-group">
                    <label for="user_status" class="col-md-2 control-label">สถานะ :</label>
                    <div class="col-md-10">                                              
                        <label class="radio-inline">
                            <input type="radio" name="user_status" value="expert" <?php if($row['user_status']=='expert') echo "checked"; ?> required>
                            Expert
                        </label>                                                                                                 
                    </div>
                </div>

                <!-- button -->
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input name="user_id" type="hidden" value="<?php echo $row['user_id']; ?>">
                        <button type="submit" class="btn btn-primary">แก้ไข</button>
                        <a href="user_manage.php?user_id=<?php echo base64_encode($row['user_id']); ?>" class="btn btn-danger" >
                            กลับหน้าหลัก</span>
                        </a>
                    </div>
                </div>
                <br><br>
                
            </form>
            
        </div>
    </body>
</html>
