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
    for (var i = 0; i < array_json.length; i++) {
        var type_name = array_json[i].type_name;
        var name_th = array_json[i].name_th;
        var place_lat = array_json[i].place_lat;
        var place_lng = array_json[i].place_lng;

        if (type_name == 'ไม้ต้น(Tree)') {
            var posTypeTree = type_name;
            var posTree = new google.maps.LatLng(place_lat, place_lng);
        } 
        else if (type_name == 'ไม้ล้มลุก(herbaceous)') {
            var posTypeherbaceous = type_name;
            var posHerbaceous = new google.maps.LatLng(place_lat, place_lng);
        }
        else if (type_name == 'ไม้พุ่ม(Shrubs)') {
            var posTypeShrubs = type_name;
            var posShrubs = new google.maps.LatLng(place_lat, place_lng);
        }
        else if (type_name == 'ไม้เลื้อยมีเนื้อไม้(Woody climber)') {
            var posTypeWoodyClimber = type_name;
            var posWoodyClimber = new google.maps.LatLng(place_lat, place_lng);
        }
        else if (type_name == 'ไม้เลื้อยไม่มีเนื้อไม้(Herbaceous climber)') {
            var posTypeHerbaceousClimber = type_name;
            var posHerbaceousClimber = new google.maps.LatLng(place_lat, place_lng);
        }
        else if (type_name == 'ไม้รอเลื้อย(Scandent)') {
            var posTypeScandent = type_name;
            var posScandent = new google.maps.LatLng(place_lat, place_lng);
        }
        
        var location = [
            { //ไม้ต้น
                title: posTypeTree,
                position: posTree,
                icon: {
                    url: iconBase + 'map-icon-blue.png'
                }
            },
            { //ไม้ล้มลุก
                title: posTypeherbaceous,
                position: posHerbaceous,
                icon: {
                    url: iconBase + 'map-icon-red.png'
                }
            }, 
            { //ไม้พุ่ม
                title: posTypeShrubs,
                position: posShrubs,
                icon: {
                    url: iconBase + 'map-icon-green.png'
                }
            }, 
            { //ไม้เลื้อยมีเนื้อไม้
                title: posTypeWoodyClimber,
                position: posWoodyClimber,
                icon: {
                    url: iconBase + 'map-icon-yellow.png'
                }
            }, 
            { //ไม้เลื้อยไม่มีเนื้อไม้
                title: posTypeHerbaceousClimber,
                position: posHerbaceousClimber,
                icon: {
                    url: iconBase + 'map-icon-purple.png'
                }
            }, 
            { //ไม้รอเลื้อย
                title: posTypeScandent,
                position: posScandent,
                icon: {
                    url: iconBase + 'map-icon-pink.png'
                }
            }
        ];
        
        var content =   'ประเภท: ' + type_name + '<br>' +
                        'ชื่อ: ' + name_th + '<br>' +
                        'ตำแหน่ง: ' + place_lat + ', ' + place_lng;
        
        location.forEach(function(element){
            var marker = new google.maps.Marker({
                 position: element.position,
                 map: map,
                 title: element.title,
                 icon: element.icon,
                 html: content
            }); 
            
            google.maps.event.addListener(marker, 'click', function () {
                infowindow.setContent(this.html);
                infowindow.open(map, this);
            });
        });

    }// end for
} // end function


