<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    </head> 
    <body>
        <div class="container">

            <div class="page-header ">
                <h1>ระบบเก็บข้อมูลสมุนไพร</h1>      
            </div>

            <h2>ลงทะเบียน</h2>

            <form action="register.php" method="post" class="form-horizontal">

                <!-- username -->
                <div class="form-group">
                    <label for="user_username" class="control-label col-xs-2">ชื่อผู้ใช้: </label>
                    <div class="col-xs-10">
                        <input type="text" name="user_username" required autofocus class="form-control">
                    </div>
                </div>

                <!-- password -->
                <div class="form-group">
                    <label for="user_password" class="control-label col-xs-2">รหัสผ่าน: </label>
                    <div class="col-xs-10">
                        <input type="password" name="user_password" required class="form-control">
                    </div>
                </div>

                <!-- email -->
                <div class="form-group">
                    <label for="user_email" class="control-label col-xs-2">อีเมล์: </label>
                    <div class="col-xs-10">
                        <input type="email" name="user_email" required class="form-control">
                    </div>
                </div>

                <!-- button -->
                <div class="form-group">
                    <label class="control-label col-xs-2"></label>
                    <div class="col-xs-10">
                        <button class="btn btn-lg btn-primary" type="submit">ลงทะเบียน</button>   
                        <a href="index.php" class="btn btn-lg btn-danger">กลับหน้าหลัก</a>
                    </div>
                </div>

            </form>

        </div>

    </body>
</html>
