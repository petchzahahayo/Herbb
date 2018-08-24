<?php
require 'header_admin.php';

//sql search
@$search = $_POST['search'];
$s = '%' . $search . '%';
$sqlSearch = "  SELECT herb_place.place_id, *  FROM herb_place
                    INNER JOIN herb_name  
                    ON herb_place.name_id = herb_name.name_id
                    INNER JOIN herb_data
                    ON herb_name.name_id = herb_data.name_id
                    INNER JOIN herb_typename
                    ON herb_data.type_id = herb_typename.type_id
                    WHERE type_name  LIKE '$s' and herb_name.name_th NOT IN ('ก9999')
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

                                <!-- show data -->
                                <?php
                                $arr_json = array();
                                while ($rowSearch = pg_fetch_array($resultSearch)) {
                                    echo '<option value="' . $rowSearch['place_id'] . '">' . $rowSearch['name_th'] . '</option>';

                                    $type_name = $rowSearch['type_name'];
                                    $name_th = $rowSearch['name_th'];
                                    $place_lat = $rowSearch['place_lat'];
                                    $place_lng = $rowSearch['place_lng'];
                                    $place_herbimg = $rowSearch['place_herbimg'];

                                    //array
                                    $arr = array();
                                    $arr['type_name'] = $type_name;
                                    $arr['name_th'] = $name_th;
                                    $arr['place_lat'] = $place_lat;
                                    $arr['place_lng'] = $place_lng;
                                    $arr['place_herbimg'] = $place_herbimg;

                                    array_push($arr_json, $arr);
                                }
                                $json = json_encode($arr_json); //chang array to json                                   
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
                            <?php //print_r($json); ?>
                        </div>
                    </div><!-- col-md-3 -->
                </div> <!-- row -->

                <script>
                    var array_json2 = <?php echo $json ?>;
                    console.log(array_json2);
                    var map;
                    var infowindow;
                    var marker;
                    //var iconBase = 'http://127.0.0.1/herbnrv/images/icon/';
                    var iconBase = 'http://www.phimai-angkorwat.com/herb/images/icon/';
                    var img = 'http://www.phimai-angkorwat.com/herb/images/';
                    
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
                        for (var i = 0; i < array_json2.length; i++) {
                            var type_name = array_json2[i].type_name;
                            var name_th = array_json2[i].name_th;
                            var place_lat = array_json2[i].place_lat;
                            var place_lng = array_json2[i].place_lng;
                            var place_herbimg = array_json2[i].place_herbimg;
                            
                            var content =   'ประเภท: ' + type_name + '<br>' +
                                            'ชื่อ: ' + name_th + '<br>' +
                                            '<div><img src="' + img + place_herbimg + '" style="width:200px;height:200px;"></div>';

                            if (type_name === 'ไม้ต้น(Tree)') {
                                if (name_th === array_json2[i].name_th) {
                                    var typeA = name_th;
                                    //console.log('ไม้ต้น(Tree)= ' + name_th);
                                    var posA = new google.maps.LatLng(place_lat, place_lng);
                                    var contentA = content;
                                } //if            
                            } // ไม้ต้น(Tree)
                            
                            else if(type_name === 'ไม้ล้มลุก(herbaceous)') {
                                if (name_th === array_json2[i].name_th) {
                                    var typeB = name_th;
                                    var posB = new google.maps.LatLng(place_lat, place_lng);
                                    var contentB = content;
                                }                              
                            } // ไม้ล้มลุก(herbaceous)
                            
                            else if(type_name === 'ไม้พุ่ม(Shrubs)') {
                                if (name_th === array_json2[i].name_th) {
                                    var typeC = name_th;
                                    var posC = new google.maps.LatLng(place_lat, place_lng);
                                    var contentC = content;
                                }                              
                            } // ไม้พุ่ม(Shrubs)
                            
                            else if (type_name === 'ไม้เลื้อยมีเนื้อไม้(Woody climber)') {
                                if (name_th === array_json2[i].name_th) {
                                    var typeD = name_th;
                                    var posD = new google.maps.LatLng(place_lat, place_lng);
                                    var contentD = content;
                                } //if 
                            } // ไม้เลื้อยมีเนื้อไม้(Woody climber)
                            
                            else if (type_name === 'ไม้เลื้อยไม่มีเนื้อไม้(Herbaceous climber)') {
                                if (name_th === array_json2[i].name_th) {
                                    var typeE = name_th;
                                    var posE = new google.maps.LatLng(place_lat, place_lng);
                                    var contentE = content;
                                }
                            } //ไม้เลื้อยไม่มีเนื้อไม้(Herbaceous climber
                            
                            else if (type_name === 'ไม้รอเลื้อย(Scandent)') {
                                if (name_th === array_json2[i].name_th) {
                                    var typeF = name_th;
                                    var posF = new google.maps.LatLng(place_lat, place_lng);
                                    var contentF = content;
                                }
                            } // ไม้รอเลื้อย(Scandent)

                            var location = [
                                {
                                    content: contentA,
                                    title: typeA,
                                    position: posA,
                                    icon: {
                                        url: iconBase + 'icon_blue.png'
                                    }
                                },
                                {
                                    content: contentB,
                                    title: typeB,
                                    position: posB,
                                    icon: {
                                        url: iconBase + 'icon_red.png'
                                    }
                                },
                                {
                                    content: contentC,
                                    title: typeC,
                                    position: posC,
                                    icon: {
                                        url: iconBase + 'icon_green.png'
                                    }
                                },
                                {
                                    content: contentD,
                                    title: typeD,
                                    position: posD,
                                    icon: {
                                        url: iconBase + 'icon_yellow.png'
                                    }
                                },
                                { 
                                    content: contentE,
                                    title: typeE,
                                    position: posE,
                                    icon: {
                                        url: iconBase + 'icon_purple.png'
                                    }
                                },
                                {
                                    content: contentF,
                                    title: typeF,
                                    position: posF,
                                    icon: {
                                        url: iconBase + 'icon_pink.png'
                                    }
                                }
                            ];

                            location.forEach(function (element) {
                                var marker = new google.maps.Marker({
                                    position: element.position,
                                    map: map,
                                    title: element.title,
                                    icon: element.icon,
                                    html: element.content
                                });

                                google.maps.event.addListener(marker, 'click', function () {
                                    infowindow.setContent(this.html);
                                    infowindow.open(map, this);
                                });
                            });

                        }// end for
                    } // end function					
                </script> 

                <script async defer
                        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB8IYs5Jihd3Qgx6oY8BzwY5SZzQHlfwCI&callback=initMap">
                </script>
            </div>
    </body>
</html>

