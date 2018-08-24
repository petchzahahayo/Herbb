var map;
var infowindow;
var marker;
var iconBase = 'http://www.herbnrv.com/images/icon/';

function initMap()
{
    var center = {lat: 14.96404430, lng: 101.94755060};
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 13,
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
        //console.log(array_json2[i].name_th);

        if (type_name == 'ไม้ต้น(Tree)') {
            if (name_th == 'กฤษณา') {
                var typeA = name_th;
                var posA = new google.maps.LatLng(place_lat, place_lng);
                var contentA = 'ประเภท: ' + type_name + '<br>' +
                'ชื่อ: ' + name_th + '<br>' +
                'ตำแหน่ง: ' + place_lat + ', ' + place_lng;
            } //if
            else if (name_th == 'คงคาเดือด') {
                var typeB = name_th;
                var posB = new google.maps.LatLng(place_lat, place_lng);
                var contentB = 'ประเภท: ' + type_name + '<br>' +
                'ชื่อ: ' + name_th + '<br>' +
                'ตำแหน่ง: ' + place_lat + ', ' + place_lng;
            } //else if
            else if (name_th == 'จำปี') {
                var typeC = name_th;
                var posC = new google.maps.LatLng(place_lat, place_lng);
                var contentC = 'ประเภท: ' + type_name + '<br>' +
                'ชื่อ: ' + name_th + '<br>' +
                'ตำแหน่ง: ' + place_lat + ', ' + place_lng;
            } //else if
        } // if

        else if (type_name == 'ไม้ล้มลุก(herbaceous)') {
            if (name_th == 'กลอย') {
                var typeA = name_th;
                var posA = new google.maps.LatLng(place_lat, place_lng);
            } //if
            else if (name_th == 'จอก') {
                var typeB = name_th;
                var posB = new google.maps.LatLng(place_lat, place_lng);
            } //else if
        } // else if

        else if (type_name == 'ไม้พุ่ม(Shrubs)') {
            if (name_th == 'คนทีเขมา') {
                var typeA = name_th;
                var posA = new google.maps.LatLng(place_lat, place_lng);
                var contentA = 'ประเภท: ' + type_name + '<br>' +
                'ชื่อ: ' + name_th + '<br>' +
                'ตำแหน่ง: ' + place_lat + ', ' + place_lng;
            } //if
            else if (name_th == 'ขมิ้นดง') {
                var typeB = name_th;
                var posB = new google.maps.LatLng(place_lat, place_lng);
                var contentB = 'ประเภท: ' + type_name + '<br>' +
                'ชื่อ: ' + name_th + '<br>' +
                'ตำแหน่ง: ' + place_lat + ', ' + place_lng;
            } //else if
        } // else if

        else if (type_name == 'ไม้เลื้อยมีเนื้อไม้(Woody climber)') {
            if (name_th == 'กรุงเขมา') {
                var typeA = name_th;
                var posA = new google.maps.LatLng(place_lat, place_lng);
                var contentA = 'ประเภท: ' + type_name + '<br>' +
                'ชื่อ: ' + name_th + '<br>' +
                'ตำแหน่ง: ' + place_lat + ', ' + place_lng;
            } //if 
            else if (name_th == 'ขมิ้นต้น') {
                var typeB = name_th;
                var posB = new google.maps.LatLng(place_lat, place_lng);
                var contentB = 'ประเภท: ' + type_name + '<br>' +
                'ชื่อ: ' + name_th + '<br>' +
                'ตำแหน่ง: ' + place_lat + ', ' + place_lng;
            } //else if
        } // else if

        else if (type_name == 'ไม้เลื้อยไม่มีเนื้อไม้(Herbaceous climber)') {
            if (name_th == 'ขนุน') {
                var typeA = name_th;
                var posA = new google.maps.LatLng(place_lat, place_lng);
                var contentA = 'ประเภท: ' + type_name + '<br>' +
                'ชื่อ: ' + name_th + '<br>' +
                'ตำแหน่ง: ' + place_lat + ', ' + place_lng;
            } //if 
            else if (name_th == 'กล้วย') {
                var typeB = name_th;
                var posB = new google.maps.LatLng(place_lat, place_lng);
                var contentB = 'ประเภท: ' + type_name + '<br>' +
                'ชื่อ: ' + name_th + '<br>' +
                'ตำแหน่ง: ' + place_lat + ', ' + place_lng;
            } //else if
        } // else if
        else if (type_name == 'ไม้รอเลื้อย(Scandent)') {
            if (name_th == 'คนทา') {
                var typeA = name_th;
                var posA = new google.maps.LatLng(place_lat, place_lng);
                var contentA = 'ประเภท: ' + type_name + '<br>' +
                'ชื่อ: ' + name_th + '<br>' +
                'ตำแหน่ง: ' + place_lat + ', ' + place_lng;
            } //if 
            else if (name_th == 'งิ้ว') {
                var typeB = name_th;
                var posB = new google.maps.LatLng(place_lat, place_lng);
                var contentB = 'ประเภท: ' + type_name + '<br>' +
                'ชื่อ: ' + name_th + '<br>' +
                'ตำแหน่ง: ' + place_lat + ', ' + place_lng;
            } //else if
        } // else if

        var location = [
            {
                content: contentA,
                title: typeA,
                position: posA,
                icon: {
                    url: iconBase + 'map-icon-blue.png'
                }
            },
            {
                content: contentB,
                title: typeB,
                position: posB,
                icon: {
                    url: iconBase + 'map-icon-green.png'
                }
            },
            {
                content: contentC,
                title: typeC,
                position: posC,
                icon: {
                    url: iconBase + 'map-icon-pink.png'
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