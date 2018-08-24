<?php
require 'header_admin.php';

$owner_id = $_GET['owner_id'];
//คำสั่ง sql
$sql = "SELECT * FROM herb_owner WHERE owner_id='$owner_id'";
$result = pg_query($db, $sql);
$row = pg_fetch_array($result);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>ระบบเก็บข้อมูลสมุนไพร</title>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
                
        <style type="text/css">
            /* css กำหนดความกว้าง ความสูงของแผนที่ */
            #map_canvas { 
                width:100%;
                height:400px;
                margin:auto;
                /*  margin-top:100px;*/
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h2>แก้ไขข้อเจ้าของสมุนไพร</h2>
            <br>
            <form action="owner_edit.php" method="POST" enctype="multipart/form-data" class="form-horizontal">

                <!-- owner_name -->
                <div class="form-group">
                    <label for="owner_name" class="col-md-2 control-label">ชื่อ :</label>
                    <div class="col-md-10">
                        <input name="owner_name" type="text" class="form-control" value="<?php echo $row['owner_name']; ?>">
                    </div>
                </div>

                <!-- owner_address -->
                <div class="form-group">
                    <label for="owner_address" class="col-md-2 control-label">ที่อยู่ :</label>
                    <div class="col-md-10">
                        <textarea name="owner_address" class="form-control" rows="5">
                            <?php echo $row['owner_address']; ?>
                        </textarea>
                    </div>
                </div>

                <!-- owner_image -->
                <div class="form-group">
                    <label for="owner_image" class="col-md-2 control-label">รูปภาพ :</label>
                    <div class="col-md-10">
                        <img src="../images/owner/<?php echo $row['owner_image']; ?>" style="width:150px;height:150px;"><br><br>
                        <input type="file" name="owner_image" accept="image/*">
                    </div>
                </div>

                <!-- owner_age -->
                <div class="form-group">
                    <label for="owner_age" class="col-md-2 control-label">อายุ :</label>
                    <div class="col-md-10">
                        <label class="radio-inline"><input type="radio" name="owner_age" value="ต่ำกว่า 20 ปี" <?php if ($row['owner_age'] == 'ต่ำกว่า 20 ปี') echo "checked"; ?>>ต่ำกว่า 20 ปี</label>
                        <label class="radio-inline"><input type="radio" name="owner_age" value="21 - 30 ปี" <?php if ($row['owner_age'] == '21 - 30 ปี') echo "checked"; ?>>21 - 30 ปี</label>
                        <label class="radio-inline"><input type="radio" name="owner_age" value="31 - 40 ปี" <?php if ($row['owner_age'] == '31 - 40 ปี') echo "checked"; ?>>31 - 40 ปี</label>
                        <label class="radio-inline"><input type="radio" name="owner_age" value="41 - 50 ปี" <?php if ($row['owner_age'] == '41 - 50 ปี') echo "checked"; ?>>41 - 50 ปี</label>
                        <label class="radio-inline"><input type="radio" name="owner_age" value="50 ปีขึ้นไป" <?php if ($row['owner_age'] == '50 ปีขึ้นไป') echo "checked"; ?>>50 ปีขึ้นไป</label>
                    </div>
                </div>

                <!-- owner_education -->
                <div class="form-group">
                    <label for="owner_education" class="col-md-2 control-label">การศีกษา :</label>
                    <div class="col-md-10">
                        <label class="radio-inline"><input type="radio" name="owner_education" value="ต่ำกว่า ม.3" <?php if ($row['owner_education'] == 'ต่ำกว่า ม.3') echo "checked"; ?>>ต่ำกว่า ม.3</label>
                        <label class="radio-inline"><input type="radio" name="owner_education" value="ม.3" <?php if ($row['owner_education'] == 'ม.3') echo "checked"; ?>>ม.3</label>
                        <label class="radio-inline"><input type="radio" name="owner_education" value="ม.6" <?php if ($row['owner_education'] == 'ม.6') echo "checked"; ?>>ม.6</label>
                        <label class="radio-inline"><input type="radio" name="owner_education" value="ป.ตรี" <?php if ($row['owner_education'] == 'ป.ตรี') echo "checked"; ?>>ป.ตรี</label>
                        <label class="radio-inline"><input type="radio" name="owner_education" value="ป.โท" <?php if ($row['owner_education'] == 'ป.โท') echo "checked"; ?>>ป.โท</label>
                        <label class="radio-inline"><input type="radio" name="owner_education" value="ป.เอก" <?php if ($row['owner_education'] == 'ป.เอก') echo "checked"; ?>>ป.เอก</label>
                    </div>
                </div>

                <!-- owner_career -->
                <div class="form-group">
                    <label for="owner_career" class="col-md-2 control-label">อาชีพ :</label>
                    <div class="col-md-10">
                        <label class="radio-inline"><input type="radio" name="owner_career" value="รับราชการ" <?php if ($row['owner_career'] == 'รับราชการ') echo "checked"; ?>>รับราชการ</label>
                        <label class="radio-inline"><input type="radio" name="owner_career" value="พนักงานรัฐวิสาหกิจ" <?php if ($row['owner_career'] == 'พนักงานรัฐวิสาหกิจ') echo "checked"; ?>>พนักงานรัฐวิสาหกิจ</label>
                        <label class="radio-inline"><input type="radio" name="owner_career" value="พนังานเอกชน" <?php if ($row['owner_career'] == 'พนังานเอกชน') echo "checked"; ?>>พนังานเอกชน</label>
                        <label class="radio-inline"><input type="radio" name="owner_career" value="รับจ้างทั่วไป" <?php if ($row['owner_career'] == 'รับจ้างทั่วไป') echo "checked"; ?>>รับจ้างทั่วไป</label>
                        <label class="radio-inline"><input type="radio" name="owner_career" value="นักเรียน นักศึกษา" <?php if ($row['owner_career'] == 'นักเรียน นักศึกษา') echo "checked"; ?>>นักเรียน นักศึกษา</label>
                        <label class="radio-inline"><input type="radio" name="owner_career" value="ค้าขาย" <?php if ($row['owner_career'] == 'ค้าขาย') echo "checked"; ?>>ค้าขาย</label>
                        <label class="radio-inline">
                            <input type="radio" name="owner_career" value="อื่นๆ" <?php if ($row['owner_career'] == 'อื่นๆ') echo "checked"; ?>>อื่นๆ (โปรดระบุ) </label>
                            <input type="text" name="owner_career2" value="<?php echo $row['owner_career2']; ?>"> 
                        </label>
                    </div>
                </div>

                <!-- owner_revenue-->
                <div class="form-group">
                    <label for="owner_revenue" class="col-md-2 control-label">รายได้ :</label>
                    <div class="col-md-10">
                        <label class="radio-inline"><input type="radio" name="owner_revenue" value="ต่ำกว่า 5,000 บาท" <?php if ($row['owner_revenue'] == 'ต่ำกว่า 5,000 บาท') echo "checked"; ?>>ต่ำกว่า 5,000 บาท</label>
                        <label class="radio-inline"><input type="radio" name="owner_revenue" value="5,001 - 10,000 บาท" <?php if ($row['owner_revenue'] == '5,001 - 10,000 บาท') echo "checked"; ?>>5,001 - 10,000 บาท</label>
                        <label class="radio-inline"><input type="radio" name="owner_revenue" value="10,001 - 15,000 บาท" <?php if ($row['owner_revenue'] == '10,001 - 15,000 บาท') echo "checked"; ?>>10,001 - 15,000 บาท</label>
                        <label class="radio-inline"><input type="radio" name="owner_revenue" value="15,001 - 20,000 บาท" <?php if ($row['owner_revenue'] == '15,001 - 20,000 บาท') echo "checked"; ?>>15,001 - 20,000 บาท</label>
                        <label class="radio-inline"><input type="radio" name="owner_revenue" value="20,001 บาท ขึ้นไป" <?php if ($row['owner_revenue'] == '20,001 บาท ขึ้นไป') echo "checked"; ?>>20,001 บาท ขึ้นไป</label>
                    </div>
                </div>

                <!-- owner_health-->
                <div class="form-group">
                    <label for="owner_health" class="col-md-2 control-label">โรคประจำตัว :</label>
                    <div class="col-md-10">
                        <label class="radio-inline"><input type="radio" name="owner_health" value="ไม่มี" <?php if ($row['owner_health'] == 'ไม่มี') echo "checked"; ?>>ไม่มี</label>
                        <label class="radio-inline">
                            <input type="radio" name="owner_health" value="มี" <?php if ($row['owner_health'] == 'มี') echo "checked"; ?>>มี (โปรดระบุ) </label>
                            <input type="text" name="owner_health2" value="<?php echo $row['owner_health2']; ?>">
                        </label>
                    </div>
                </div>

                <!-- Map -->
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <div id="map_canvas"></div>
                    </div>
                </div>

                <!-- googleMap -->
                <?php
                    $sqlPosition = "SELECT * FROM herb_owner WHERE owner_id='$owner_id'";
                    $resultPosition = pg_query($db, $sqlPosition);
                    $arr_json = array();
                    while ($rowPosition = pg_fetch_array($resultPosition)) {
                        $owner_lat = $rowPosition['owner_lat'];
                        $owner_lng = $rowPosition['owner_lng'];

                        //array
                        $arr = array();
                        $arr['owner_lat'] = $owner_lat;
                        $arr['owner_lng'] = $owner_lng;

                        array_push($arr_json, $arr);
                    }
                    $json = json_encode($arr_json);
                    //print_r($arr_json);
                    pg_close($db);
                ?>

                <script>
                              var map;
                              var array_json = <?php echo $json ?>;
                              //alert(array_json[0].place_herb_lat);
                              
                              function initMap() 
                              {
                                var uluru = {lat: 14.96404430, lng: 101.94755060};
                                map = new google.maps.Map(document.getElementById('map_canvas'), {
                                  zoom: 8,
                                  center: uluru
                                });
                                selectLocation();
                              }
                              
                              var marker = [];
                              function selectLocation()
                              {
                                  for(var i=0; i < array_json.length; i++){
                                      var owner_lat = array_json[i].owner_lat;
                                      var owner_lng = array_json[i].owner_lng;
                                      var latlng = new google.maps.LatLng(owner_lat, owner_lng);
                                      //alert(owner_lat + owner_lng);
                                      var markeroption = {map: map, html: "", position: latlng};
                                      var marker = new google.maps.Marker(markeroption);
                                  } 
                              }
                              
                              
                              
                            </script>
                
<script async defer
                        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB8IYs5Jihd3Qgx6oY8BzwY5SZzQHlfwCI&callback=initMap">
                </script>
                <!-- button -->
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input type="hidden" name="owner_id" value="<?php echo $row['owner_id'] ?>">
                        <button type="submit" class="btn btn-primary">แก้ไข</button>
                        <a href="owner_manage.php" class="btn btn-danger">กลับหน้าหลัก</a>
                    </div>
                </div>
                <br><br>

            </form>
        </div>
    </body>
</html>
