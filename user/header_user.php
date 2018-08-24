<?php
session_start();

require '../connect/connectdb.php';

if ($_SESSION['user_id'] == "") {
    echo "กรุณาลงชื่อเข้าสู่ระบบ";
    exit();
}

if ($_SESSION['user_status'] != "user") {
    echo "This page for User only!";
    exit();
}

$sql = "SELECT * FROM herb_user WHERE user_id = '" . $_SESSION['user_id'] . "' ";
$query = pg_query($db, $sql);
$result = pg_fetch_array($query);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ระบบเก็บข้อมูลสมุนไพร</title>
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <script>
            if (location.protocol !== 'https:')
            {
                location.href = 'https:' + window.location.href.substring(window.location.protocol.length);
            }//if
        </script>
    </head>
    <body>
        <div class="navbar navbar-inverse navbar-static-top">
            <div class="container">
                <a href="" class="navbar-brand">ระบบเก็บข้อมูลสมุนไพร (ผู้ใช้ทั่วไป)</a>
                <button class="navbar-toggle" data-toggle="collapse" data-target=".navHeader">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse navHeader">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <?php $q = base64_encode($result['user_id']) ?>
                            <a href="user_manage.php?user_id=<?php echo $q; ?>">
                                <span class="glyphicon glyphicon-pencil"> แก้ไขข้อมูลส่วนตัว</span>
                            </a>
                        </li> 
                        <li>
                            <a href="place_manage.php">
                                <span class="glyphicon glyphicon-th-list"> ข้อมูลสมุนไพร</span>
                            </a>
                        </li>
                        <li>
                            <a href="owner_manage.php">
                                <span class="glyphicon glyphicon-th-list"> กรอกข้อมูลเจ้าของสมุนไพร</span>
                            </a>
                        </li>
                        <li><a href="logout.php">
                                <span class="glyphicon glyphicon-log-out"></span>  
                                ออกจากระบบ(<?php echo $result['user_username']; ?>)</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>    





