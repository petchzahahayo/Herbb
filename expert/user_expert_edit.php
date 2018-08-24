<?php

require '../connect/connectdb.php';

if ($_POST)
{
    //รับค่าตัวแปรจากฟอร์ม
    $user_id = $_POST['user_id'];
    $user_prefix = pg_escape_string($db, $_POST['user_prefix']);
    $user_name = pg_escape_string($db, $_POST['user_name']);
    $user_surname = pg_escape_string($db, $_POST['user_surname']);
    $user_edu = pg_escape_string($db, $_POST['user_edu']);
    $user_expert = pg_escape_string($db, $_POST['user_expert']);
    $user_workplace = pg_escape_string($db, $_POST['user_workplace']);
    $user_address = pg_escape_string($db, $_POST['user_address']);
    $user_tel = pg_escape_string($db, $_POST['user_tel']);
    $user_username = pg_escape_string($db, $_POST['user_username']);   
    $user_email = pg_escape_string($db, $_POST['user_email']);
    $user_status = pg_escape_string($db, $_POST['user_status']);

    //password
    $user_password = pg_escape_string($db, $_POST['user_password']);

    $sqlPassword = "SELECT * FROM herb_user WHERE user_id = '$user_id' ";
    $queryPassword = pg_query($db, $sqlPassword);
    $rowPassword = pg_fetch_array($queryPassword);

    if ($user_password !== $rowPassword['user_password'])
    {
        $key = 'sfdjak;nvkio[eirujgtf049u15678465wefqawe';
        $hash_login_password = hash_hmac('sha256', $user_password, $key); // login_password
        $user_password = $hash_login_password;
    }
    //password
           
    //คำสั่ง sql เพื่อ update ข้อมูล
    $sql = "UPDATE herb_user 
                        SET user_prefix='$user_prefix',
                            user_name='$user_name',
                            user_surname='$user_surname',
                            user_edu='$user_edu',    
                            user_expert='$user_expert',
                            user_workplace='$user_workplace',   
                            user_address='$user_address',
                            user_tel='$user_tel',
                            user_username='$user_username', 
                            user_password='$user_password', 
                            user_email='$user_email',
                            user_status='$user_status'    
                        WHERE user_id='$user_id'";
    $result = pg_query($sql);

    if ($result) {
        echo '<script>
                        alert("บันทึกข้อมูลเรียบร้อยแล้ว");
                        window.location="user_manage.php?user_id=' . base64_encode($_POST['user_id']) . '";
                      </script>';
        //echo "Upload Complete";
        //header("location: user_manage.php");
    } else {
        echo "Error = " . pg_last_error($db);
    }

    pg_close($db);
}
