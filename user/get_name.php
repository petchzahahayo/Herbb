<?php
    require '../connect/connectdb.php';

    $alphabet_id = $_GET['alphabet_id'];

    $sql_name = "SELECT * FROM herb_name WHERE alphabet_id={$alphabet_id}";
    $res_name = pg_query($db, $sql_name);
?>    

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
    </head>

    <body>
            
                <div class="form-group">
                    <div class="col-md-10">
                        <select name="name_id" id="name_th" class="form-control">
                            <option value="">--เลือกชื่อสมุนไพร--</option>

                            <?php
                            while ($row_name = pg_fetch_array($res_name)) {
                                echo '<option value="' . $row_name['name_id'] . '">' . $row_name['name_th'] . '</option>';
                            }
                            ?>

                        </select>
                    </div>
                </div>
            
    </body>
</html>