<?php
    require 'header.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>
        <link rel="stylesheet" href="css/style.css">

    </head>

    <body>
        
        <div class="wrapper">
            <form action="check_login.php" method="POST" class="form-signin" >       
                <h3 class="form-signin-heading">ลงชื่อเพื่อเข้าสู่ระบบ</h3>
                <input type="text" class="form-control" name="user_username" placeholder="ชื่อผู้ใช้" required autofocus />
                <input type="password" class="form-control" name="user_password" placeholder="รหัสผ่าน" required/>      
                
                <button class="btn btn-lg btn-primary btn-block" type="submit">เข้าสู่ระบบ</button>   
                <!--<button class="btn btn-lg btn-danger btn-block" type="submit">
                    <a href="frm_register.php">ลงทะเบียน</a>
                </button>
                -->
            </form>
        </div>
        <br>
        <!-- footer -->
        <?php require 'footer.php'; ?>
    </body>
</html>
