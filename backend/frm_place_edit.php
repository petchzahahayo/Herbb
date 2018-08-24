<?php
        require 'header_admin.php';

        $place_id = $_GET['place_id'];

        //herb_owner
        $sqlOwner = "SELECT * FROM herb_owner";
        $resOwner = pg_query($db, $sqlOwner);

        //herb_data
        $sqlData = "SELECT * FROM herb_name";
        $resData = pg_query($db, $sqlData);

        //herb_place
        $sqlPlace = "SELECT * FROM herb_place WHERE place_id='$place_id'";
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
    </head>
    <body>
        <div class="container">
            <h2>แก้ไขข้อมูลสมุนไพร</h2>
            <br>
            <form action="place_edit.php" method="POST" enctype="multipart/form-data" class="form-horizontal">

                <!-- owner_name -->
                <div class="form-group">
                    <label for="owner_id" class="col-md-2 control-label">ชื่อ :</label>
                    <div class="col-md-10">
                        <select name="owner_id" id="owner_id" class="form-control">

                            <!-- ดึงข้อมูลจากฐานข้อมูล -->
                            <?php
                            while ($rowOwner = pg_fetch_row($resOwner)) {
                                if ($rowOwner[0] == $rowPlace['owner_id']) {
                                    echo "<option value='$rowOwner[0]' selected>$rowOwner[1]</option>";
                                } else {
                                    echo "<option value='$rowOwner[0]'>$rowOwner[1]</option>";
                                }
                            }
                            ?>

                        </select>
                    </div>
                </div>

                <!-- name_id -->
                <div class="form-group">
                    <label for="name_id" class="col-md-2 control-label">ชื่อสมุนไพร :</label>
                    <div class="col-md-10">
                        <select name="name_id" class="form-control">

                            <!-- ดึงข้อมูลจากฐานข้อมูล -->
                            <?php
				while ($rowData = pg_fetch_row($resData)) {
                                    if ($rowData[0] == $rowPlace['name_id']) {
					echo "<option value='$rowData[0]' selected>$rowData[1]</option>";
                                    } 
                                    else {
					echo "<option value='$rowData[0]'>$rowData[1]</option>";
                                    }
				}
                            ?>

                        </select>
						
                    </div>
                </div>

                <!-- images -->
                <div class="form-group">
                    <label for="place_herbimg" class="col-md-2 control-label">รูปภาพ :</label>
                    <div class="col-md-10">
                        <img src="../images/<?php echo $rowPlace['place_herbimg']; ?>" style="width:150px;height:150px;"><br><br>
                        <input type="file" name="place_herbimg">
                    </div>
                </div>
                
				
				
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <div class="text-center" id="map" style="width: 300px; height: 300px;"></div>
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
                    </div>
                </div>

                <!-- button -->
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input type="hidden" name="place_id" value="<?php echo $rowPlace['place_id'] ?>">
                        <button name="edit_btn" type="submit" class="btn btn-primary">แก้ไข</button>
                        <a href="place_manage.php" class="btn btn-danger">กลับหน้าหลัก</a>
                    </div>
                </div>
                <br><br>

            </form>

        </div>
    </body>
</html>
