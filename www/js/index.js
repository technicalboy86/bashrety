$(document).ready(function () {

     //   navigator.geolocation.getCurrentPosition(onSuccess, onError, { enableHighAccuracy: true });
                          
});

function onSuccess(position) {
    var clientPosition = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
    var myOptions = {
    center: clientPosition,
    zoom: 14,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    callback: function () { }
    };
    
    map_element = document.getElementById("map_canvas");
    map = new google.maps.Map(map_element, myOptions);
    
    var mapwidth = $(window).width();
    var mapheight = $(window).height() - 100;
    $("#map_canvas").height(mapheight);
    $("#map_canvas").width(mapwidth);
    google.maps.event.trigger(map, 'resize');
    
    currentLocationMarker = new google.maps.Marker({
                                                   position: clientPosition,
                                                   animation: google.maps.Animation.DROP,
                                                   title:"You!",
                                                   });
    
    currentLocationMarker1 = new google.maps.Marker({
                                                    position: new google.maps.LatLng(43.02, 129.7841619731),
                                                    animation: google.maps.Animation.DROP,
                                                    title:"Restaurant!"
                                                    });
    
    var infowindow = new google.maps.InfoWindow();
    
    google.maps.event.addListener(currentLocationMarker, 'click', function() {
                                  infowindow.setContent(this.title);
                                  infowindow.open(map, this);
                                  });
    
    google.maps.event.addListener(currentLocationMarker1, 'click', function() {
                                  infowindow.setContent(this.title);
                                  infowindow.open(map, this);
                                  });
    
    
    currentLocationMarker.setMap(map);
    currentLocationMarker1.setMap(map);
    
    
    alert("Your position :" + position.coords.latitude +"/"+ position.coords.longitude);
    var origin = JSON.parse('{"Longitude":43.02,"Latitude":129.7841619731}');
    var destination = JSON.parse('{"Longitude":'+ position.coords.latitude + ',"Latitude":'+position.coords.longitude+'}');
    var distance = calculateDistance(origin, destination);
    
    
    alert("distance :"+ distance + "Km");
    
    
    
}

function calculateDistance(p1, p2) {
    var erdRadius = 6371;
    
    p1.Longitude = p1.Longitude * (Math.PI / 180);
    p1.Latitude = p1.Latitude * (Math.PI / 180);
    p2.Longitude = p2.Longitude * (Math.PI / 180);
    p2.Latitude = p2.Latitude * (Math.PI / 180);
    
    var x0 = p1.Longitude * erdRadius * Math.cos(p1.Latitude);
    var y0 = p1.Latitude * erdRadius;
    
    var x1 = p2.Longitude * erdRadius * Math.cos(p2.Latitude);
    var y1 = p2.Latitude * erdRadius;
    
    var dx = x0 - x1;
    var dy = y0 - y1;
    
    return Math.sqrt((dx * dx) + (dy * dy));
}