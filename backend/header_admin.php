<?php
session_start();

require '../connect/connectdb.php';

if ($_SESSION['user_id'] == "") {
    echo "กรุณาลงชื่อเข้าสู่ระบบ";
    exit();
}

if ($_SESSION['user_status'] != "admin") {
    echo "This page for Admin only!";
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
        
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">


    <a href="../bootstrap/fonts/glyphicons-halflings-regular.woff"></a>
    <a href="../bootstrap/fonts/glyphicons-halflings-regular.woff2"></a>
</head>
<body>
    <div class="navbar navbar-inverse navbar-static-top">
        <div class="container">
            <a href="" class="navbar-brand">ระบบเก็บข้อมูลสมุนไพร(Admin)</a>
            <button class="navbar-toggle" data-toggle="collapse" data-target=".navHeader">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="collapse navbar-collapse navHeader">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="user_manage.php">
                            <span class="glyphicon glyphicon-user"></span> สมาชิก
                        </a></li>

                    <li><a href="owner_manage.php">
                            <span class="glyphicon glyphicon-th-list"></span> ข้อมูลเจ้าของสถานที่</a></li>
                   
                    <li><a href="herb_manage.php">
                            <span class="glyphicon glyphicon-th-list"></span> ข้อมูลสมุนไพร</a></li>
                    
                     <li><a href="tree_manage.php">
                        <span class="glyphicon glyphicon-th-list"></span> ข้อมูลต้นไม้</a></li>
                   
                    <li><a href="place_manage.php">
                            <span class="glyphicon glyphicon-th-list"></span> ข้อมูลสถานที่สมุนไพร</a></li>
                    
                    <li><a href="place_map.php">
                            <span class="glyphicon glyphicon-map-marker"></span> แผนที่สมุนไพร</a></li>
                    
                    <li><a href="logout.php">
                            <span class="glyphicon glyphicon-log-out"></span>  
                            ออกจากระบบ(<?php echo $result['user_username']; ?>)</a>
                    </li>
                </ul>

        
            </div>
        </div>
    </div>    




