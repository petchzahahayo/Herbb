var map;
var iconBase = 'http://www.herbnrv.com/images/icon/';
//map
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
                url: iconBase + 'map-icon-blue.png'
            }
        });
    }
} // end function