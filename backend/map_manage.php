<?php 
        require 'header_admin.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <style>
            #map {
                height: 450px;
                width: 100%;
                margin:auto;
            }
        </style>
    </head>
    <body>
            <div class="container">
                    
            <h3>แผนที่สมุนไพร</h3>

            <!-- กำหนดขนาดแผนที่ -->
            <center><div id="map"></div></center>

            <script>
                //ฟังชันแสดงแผนที่
                function initMap() 
                {
                    var uluru = {lat: 14.951142, lng: 102.178896}; //กำหนดกึ่งกลางแผนที่
                    var map = new google.maps.Map(document.getElementById('map'), {
                        zoom: 15,
                        center: uluru, //แสดงกึ่งกลางแผนที่
                        mapTypeId: 'roadmap' //ประเภทแผนที่
                    });

                    //marker
                    var marker = new google.maps.Marker({
                        map: map,
                        position: uluru
                    });
                }
            </script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
            <script async defer
                    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBjSSLVC9Mpi8wMLUoJNb-zSrHzlGkXYPs&callback=initMap">
            </script>
        </div>
    </body>
</html>
<br><br>
