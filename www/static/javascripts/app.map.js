App.map = {
	
    addMap:function(mId)
    {
        var clientPosition = new google.maps.LatLng(43.02, 129.7841619731);
        var myOptions = {
        	center: clientPosition,
            zoom: 14,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            callback: function () { }
        };
                  
        map_element = document.getElementById(mId);
        map = new google.maps.Map(map_element, myOptions);
                  
        var mapwidth = $(window).width();
        var mapheight = $(window).height()-100;
        $("#"+mId).height(mapheight);
        $("#"+mId).width(mapwidth);
        google.maps.event.trigger(map, 'resize');
                 
        currentLocationMarker = new google.maps.Marker({
        	position: clientPosition,
            animation: google.maps.Animation.DROP,
            title:"Name : Jin Jin \n Street : Tumen",
        });
                  
        var infowindow = new google.maps.InfoWindow();
                  
        google.maps.event.addListener(currentLocationMarker, 'click', function() {
              //infowindow.setContent(this.title);
              //infowindow.open(map, this);
              Lungo.Notification.html('<div class="map_message"> <div class="map_message_title"><h4>Name</h4><div>Jin Jin</div><h4>Detail</h4></div><div class="map_message_detail">Lorem ipsum dolor Lrem ipsum dolor Lrem ipsum dolor Lrem ipsum dolor Lrem ipsum dolor Lrem ipsum dolor Lrem ipsum dolor Lrem ipsum dolor Lorem ips</div><input type="button" value="Going" onclick="alert(\'Going\');"/><input type="button" value="Navigate" onclick="alert(\'Navigate\');"/></div>', "Close");
        });
                  
        currentLocationMarker.setMap(map);

    }
}
