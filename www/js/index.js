$(document).ready(function () {

     //   navigator.geolocation.getCurrentPosition(onSuccess, onError, { enableHighAccuracy: true });
                          
});

function looksLikeMail(str) {
    var lastAtPos = str.lastIndexOf('@');
    var lastDotPos = str.lastIndexOf('.');
    return (lastAtPos < lastDotPos && lastAtPos > 0 && str.indexOf('@@') == -1 && lastDotPos > 2 && (str.length - lastDotPos) > 2);
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