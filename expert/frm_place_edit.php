<?php
        require 'header_expert.php';

        $place_id = $_GET['place_id'];

        //herb_owner
        $sqlOwner = "SELECT * FROM herb_owner";
        $resOwner = pg_query($db, $sqlOwner);

        //herb_data
        $sqlData = "SELECT * FROM herb_name";
        $resData = pg_query($db, $sqlData);

        //herb_place
        $sqlPlace = "SELECT * FROM herb_place 
                    INNER JOIN herb_name
                    on herb_place.name_id = herb_name.name_id
                    WHERE place_id='$place_id'";
        $resPlace = pg_query($db, $sqlPlace);
        $rowPlace = pg_fetch_array($resPlace);
        
        //sql herb_place lat,lng
        $sql = "SELECT * FROM herb_place WHERE place_id='$place_id'";
        $result = pg_query($db, $sql);
        
        $arr_json = array();
        
        while($row = pg_fetch_array($result)){
            $place_lat = $row['place_lat'];
            $place_lng = $row['place_lng'];

            //array
            $arr = array();
            $arr['place_lat'] = $place_lat;
            $arr['place_lng'] = $place_lng;
            
            array_push($arr_json, $arr);
        }
        $json = json_encode($arr_json);
        //print_r($arr_json);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="../bootstrap/js/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
        <script src="../bootstrap/js/jquery-ui.min.js" type="text/javascript"></script>
        <script>
            $(function() {
                $('#name_th').autocomplete({
                    source: 'autocomplete.php',
                    autoFocus: true
                });
            });
        </script>
    </head>
    <body>
        <div class="container">
            <h2>แก้ไขข้อมูลสมุนไพร</h2>
            <br>
            <form action="place_edit.php" method="POST" enctype="multipart/form-data" class="form-horizontal">

                <!-- user_id -->
                <input name="user_id" type="hidden" value="<?php echo $_SESSION['user_id'] ?>">

                <!-- name_th -->
                <div class="form-group">
                    <label for="name_id" class="col-md-2 control-label">ชื่อสมุนไพร :</label>
                    <div class="col-md-10">                        
                        <input name="name_th" id="name_th" type="text" class="form-control" value="<?php echo $rowPlace['name_th'];  ?>" required>
                    </div>
                </div>

                <!-- images -->
                <div class="form-group">
                    <label for="img" class="col-md-2 control-label">รูปภาพ :</label>
                    <div class="col-md-10">
                        <img src="../images/<?php echo $rowPlace['place_herbimg']; ?>" style="width:150px;height:150px;"><br><br>
                        <input type="file" name="place_herbimg">
                    </div>
                </div>
                                
                <!-- button -->
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input type="hidden" name="place_id" value="<?php echo $rowPlace['place_id'] ?>">
                        <button name="edit_btn" type="submit" class="btn btn-success">แก้ไข</button>
                        <a href="place_manage.php" class="btn btn-danger">กลับหน้าหลัก</a>
                    </div>
                </div>
                <br><br>

            </form>

        </div>
    </body>
</html>
