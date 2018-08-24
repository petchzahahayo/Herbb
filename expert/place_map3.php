<?php
require 'header_expert.php';

//sql search
@$search = $_POST['search'];
$s = '%' . $search . '%';
$sqlSearch = "  SELECT *  FROM herb_place
                    INNER JOIN herb_name  
                    ON herb_place.name_id = herb_name.name_id
                    INNER JOIN herb_data
                    ON herb_name.name_id = herb_data.name_id
                    INNER JOIN herb_typename
                    ON herb_data.type_id = herb_typename.type_id
                    WHERE type_name  LIKE '$s' 
                 ";
$resultSearch = pg_query($db, $sqlSearch);
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

                <div class="col-md-3">
                    <form action="place_map2.php" method="post" >
                        <div class="input-group">  

                            <select name="search" id="search" class="form-control">
                                <option>-- เลือกประเภทสมุนไพร --</option>

                                <!-- ดึงข้อมูลจากฐานข้อมูล -->
                                <?php
                                //sql herb_type
                                $sqlType = "SELECT * FROM herb_typename";
                                $queryType = pg_query($db, $sqlType);
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
                    <form action="place_map3.php" method="post" >
                        <div class="input-group">
                            <select name="place_id" class="form-control">
                                <option>---เลือกสมุนไพร---</option>                               
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
                            <p><img src="../images/icon/icon_red.png"> = ไม้ล้มลุก, 
                                <img src="../images/icon/icon_blue.png"> = ไม้ต้น,
                                <img src="../images/icon/icon_green.png"> = ไม้พุ่ม,
                                <img src="../images/icon/icon_yellow.png"> = ไม้เลื้อยมีเนื้อไม้,
                                <img src="../images/icon/icon_purple.png"> = ไม้เลื้อยไม่มีเนื้อไม้,
                                <img src="../images/icon/icon_pink.png"> = ไม้รอเลื้อย
                            </p>
                        </div>
                    </div> <!-- col-md-9 -->

                    <div class="col-md-3">
                        <div class="sidebar-module">
                            <?php
                            //sql name_id
                            $place_id = $_POST['place_id'];
                            $sqlNameId = "  SELECT *  FROM herb_place
                                                INNER JOIN herb_name  
                                                ON herb_place.name_id = herb_name.name_id
                                                INNER JOIN herb_data
                                                ON herb_name.name_id = herb_data.name_id
                                                INNER JOIN herb_typename
                                                ON herb_data.type_id = herb_typename.type_id
                                                WHERE place_id='$place_id' 
                                             ";
                            $resNameId = pg_query($db, $sqlNameId);

                            while ($rowNameId = pg_fetch_array($resNameId)) {
                                echo '<div class="well">';
                                echo "<h4>รายละเอียดสมุนไพร</h4>";
                                echo $rowNameId['name_th'] . "<br>" . "<br>";
                                echo '<img src="../images/' . $rowNameId['place_herbimg'] . '" style="width:200px;height:200px;">' . "<br>";
                                echo '</div>';

                                //sql
                                $name = $rowNameId['name_th'];
                                $sqlNameTh = "  SELECT * FROM herb_place 
                                                    INNER JOIN herb_name  
                                                    ON herb_place.name_id = herb_name.name_id
                                                    WHERE name_th='$name'";
                                $queryNameTh = pg_query($sqlNameTh);
                                $arrNameJson = array();
                                while ($rowName = pg_fetch_array($queryNameTh)) {
                                    $arrName = array();
                                    $arrName['name_th'] = $rowName['name_th'];
                                    $arrName['place_lat'] = $rowName['place_lat'];
                                    $arrName['place_lng'] = $rowName['place_lng'];
                                    array_push($arrNameJson, $arrName);
                                }
                                $json = json_encode($arrNameJson);
                                //print_r($json);
                            }
                            ?>   

                        </div>
                    </div><!-- col-md-3 -->
                </div> <!-- row -->

                <script>
                    var arrNameJson = <?php echo $json ?>;
                    var map;
                    var iconBase = 'http://www.phimai-angkorwat.com/herb/images/icon/';
                    var img = 'http://www.phimai-angkorwat.com/herb/images/';
//map
                    function initMap()
                    {
                        var center = {lat: 14.96404430, lng: 101.94755060};
                        map = new google.maps.Map(document.getElementById('map'), {
                            zoom: 8,
                            center: center
                        });
                        infowindow = new google.maps.InfoWindow();
                        selectLocation();
                    } // end function

                    function selectLocation()
                    {
                        for (var i = 0; i < arrNameJson.length; i++) {
                            var name_th = arrNameJson[i].name_th;
                            var place_lat = arrNameJson[i].place_lat;
                            var place_lng = arrNameJson[i].place_lng;
                            var latlng = new google.maps.LatLng(place_lat, place_lng);
                            //console.log(name_th);
                            var marker = new google.maps.Marker({
                                map: map,
                                position: latlng,
                                icon: {
                                    url: iconBase + 'icon_blue.png'
                                }
                            });
                        }
                    } // end function
                </script>
                <script async defer
                        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB8IYs5Jihd3Qgx6oY8BzwY5SZzQHlfwCI&callback=initMap">
                </script>
            </div>
    </body>
</html>

