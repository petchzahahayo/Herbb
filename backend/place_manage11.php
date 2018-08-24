<?php
    require 'header_admin.php';

    //sql search
    @$search = $_POST['search'];
    //echo "--------------------------------------" . $search;
    $s = '%' . $search . '%';
    $sqlSearch = "  SELECT *  FROM herb_place
                        INNER JOIN herb_name  
                        ON herb_place.name_id = herb_name.name_id
                        INNER JOIN herb_data
                        ON herb_name.name_id = herb_data.name_id
                        INNER JOIN herb_typename
                        ON herb_data.type_id = herb_typename.type_id
                        INNER JOIN herb_owner
                        ON herb_place.owner_id = herb_owner.owner_id
                        WHERE type_name  LIKE '$s' AND name_th NOT IN ('ก9999')
                     ";
    $resultSearch = pg_query($db, $sqlSearch);

    //sql herb_type
    $sqlType = "SELECT * FROM herb_typename";
    $queryType = pg_query($db, $sqlType);

    //sql name_id
    @$place_id = $_GET['place_id'];
    $sqlNameId = "SELECT *  FROM herb_place
                        INNER JOIN herb_name  
                        ON herb_place.name_id = herb_name.name_id
                        INNER JOIN herb_data
                        ON herb_name.name_id = herb_data.name_id
                        INNER JOIN herb_typename
                        ON herb_data.type_id = herb_typename.type_id
                        INNER JOIN herb_owner
                        ON herb_place.owner_id = herb_owner.owner_id
                        WHERE place_id='$place_id'";
    @$resNameId = pg_query($db, $sqlNameId);
    @$rowNameId = pg_fetch_array($resNameId);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
            #map {
                height: 450px;
                width: 100%;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">

                <!-- ปุ่มเพิ่มสมุนไพร -->
                <div class="col-md-6">
                    <a href="frm_place_add.php" class="btn btn-primary" >
                        <span class="glyphicon glyphicon-plus"> เพิ่มสมุนไพร</span>
                    </a>
                </div>

                <div class="col-md-3">
                    <form action="place_manage.php" method="post" >
                        <div class="input-group">  

                            <select name="search" id="search" class="form-control">
                                <option>-- เลือกประเภทสมุนไพร --</option>

                                <!-- ดึงข้อมูลจากฐานข้อมูล -->
                                <?php
                                while ($rowType = pg_fetch_row($queryType)) {
                                    echo "<option value='$rowType[1]'>$rowType[1]</option>";
                                }
                                ?>
                            </select>

                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-success">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </span>
                        </div>                         
                    </form>
                </div>

                <div class="col-md-3"> 
                    <form action="place_manage.php" method="GET" >
                        <div class="input-group">
                            <select name="place_id" class="form-control">
                                <option>---เลือกสมุนไพร---</option>

                                <!-- show data -->
                                <?php
                                $arr_json = array();
                                while ($rowSearch = pg_fetch_array($resultSearch)) {
                                    echo '<option value="' . $rowSearch['place_id'] . '">' . $rowSearch['name_th'] . '</option>';

                                    $type_name = $rowSearch['type_name'];
                                    $type1 = $type_name;
                                    $name_th = $rowSearch['name_th'];
                                    $place_lat = $rowSearch['place_lat'];
                                    $place_lng = $rowSearch['place_lng'];
                                    $place_herbimg = $rowSearch['place_herbimg'];

                                    //array
                                    $arr = array();
                                    $arr['type_name'] = $type_name;
                                    $arr['type1'] = $type1;
                                    $arr['name_th'] = $name_th;
                                    $arr['place_lat'] = $place_lat;
                                    $arr['place_lng'] = $place_lng;
                                    $arr['place_herbimg'] = $place_herbimg;
                                    //print_r($arr['type_name']);
                                    array_push($arr_json, $arr);
                                }
                                $json = json_encode($arr_json);
                                //print_r($json);
                                ?>    
                            </select>

                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-success">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </span>
                        </div>
                    </form>
                </div>
                
                <br><br>
                <!-- แผนที่ -->
                <div class="row">
                    <div class="col-md-9">
                        <div id="map"></div><br>
                        <div class="well">
                            <h4>รายละเอียดประเภทสมุนไพร</h4>
                            <p><img src="../images/icon/map-icon-red.png"> = ไม้ล้มลุก, 
                                <img src="../images/icon/map-icon-blue.png"> = ไม้ต้น,
                                <img src="../images/icon/map-icon-green.png"> = ไม้พุ่ม,
                                <img src="../images/icon/map-icon-yellow.png"> = ไม้เลื้อยมีเนื้อไม้,
                                <img src="../images/icon/map-icon-purple.png"> = ไม้เลื้อยไม่มีเนื้อไม้,
                                <img src="../images/icon/map-icon-pink.png"> = ไม้รอเลื้อย
                            </p>
                        </div>
                    </div> <!-- col-md-8 -->

                    <div class="col-md-3">
                        <div class="sidebar-module">
                            <?php echo $rowNameId['name_th']; ?><br>
                            <?php echo '<img src="../images/' . $rowNameId['place_herbimg'] . '">' ?>
                        </div>
                    </div><!-- col-md-3 -->
                </div> <!-- row -->
                <?php //print_r($json); ?>
                <script>
                   var array_json = <?= $json ?>;
                </script>
                <script src="place_map11.js"></script>
                <script async defer
                    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB8IYs5Jihd3Qgx6oY8BzwY5SZzQHlfwCI&callback=initMap">
                </script>
            </div>
    </body>
</html>

