<?php 
        require 'header_expert.php';
        
        //รับข้อมูล
        $place_id = $_GET['place_id'];
        
        //คำสั่ง sql herb_owner
        $sqlOwner = "SELECT herb_owner.owner_name
                    FROM herb_owner
                    INNER JOIN herb_place
                    ON herb_owner.owner_id = herb_place.owner_id
                    WHERE place_id='$place_id'";
        $resultOwner = pg_query($db, $sqlOwner);
        
        //คำสั่ง sql herb_data
        $sqlData = "SELECT *
                    FROM herb_name
                    INNER JOIN herb_data
                    ON herb_name.name_id = herb_data.name_id
                    INNER JOIN herb_typename
                    ON herb_data.type_id = herb_typename.type_id
                    INNER JOIN herb_place
                    ON herb_name.name_id = herb_place.name_id
                    WHERE place_id='$place_id'";
        $resultData = pg_query($db, $sqlData);
        
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
    </head>
    <body>
        <div class="container">
            <h2>ข้อมูลสถานที่</h2>
            <table class="table table-bordered">
                
                <!-- show data -->
                
                <tr>
                    <th class="info">ชื่อ</th>
                    <?php while($rowOwner = pg_fetch_array($resultOwner)){ ?>
                        <td><?php echo $rowOwner['owner_name']; ?></td>
                    <?php } ?>
                </tr>
                
                <tr>
                    <th class="info">ประเภทสมุนไพร</th>
                    <?php while($rowData = pg_fetch_array($resultData)){ ?>
                        <td><?php echo $rowData['type_name']; ?></td>                    
                </tr>
                
                <tr>
                    <th class="info">ชื่อสมุนไพร</th>                    
                        <td><?php echo $rowData['name_th']; ?></td>                    
                </tr>
                <tr>
                            <th class="info">รูปภาพ</th>
                            <td><img src="../images/<?php echo $rowData['place_herbimg']; ?>" style="width:100px;height:100px;"></td>
                        </tr>
                <?php } ?>
                <!-- map -->
                <tr>
                    <th class="info">สถานที่</th>
                        <td>
                            
                            <div id="map" style="width: 300px; height: 300px;"></div>
                            <script>
                              var map;
                              var array_json = <?php echo $json ?>;
                              //alert(array_json[0].place_herb_lat);
                              
                              function initMap() 
                              {
                                var uluru = {lat: 14.96404430, lng: 101.94755060};
                                map = new google.maps.Map(document.getElementById('map'), {
                                  zoom: 8,
                                  center: uluru
                                });
                                selectLocation();
                              }
                              
                              var marker = [];
                              function selectLocation()
                              {
                                  for(var i=0; i < array_json.length; i++){
                                      var place_lat = array_json[i].place_lat;
                                      var place_lng = array_json[i].place_lng;
                                      var latlng = new google.maps.LatLng(place_lat, place_lng);
                                      //alert(place_herb_lat + place_herb_ng);
                                      var markeroption = {map: map, html: "", position: latlng};
                                      var marker = new google.maps.Marker(markeroption);
                                  } 
                              }
                              
                            </script>
                            <script async defer
                            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB8IYs5Jihd3Qgx6oY8BzwY5SZzQHlfwCI&callback=initMap">
                            </script>
 
                        </td>
                </tr>
                
            </table>
            
            <a href="place_manage.php" class="btn btn-danger" >
                กลับหน้าหลัก
            </a>
        </div>    
    </body>
</html>

