var geocoder;
var map;
var marker;
var infowindow = new google.maps.InfoWindow({size: new google.maps.Size(150,50)});
function initialize() {

    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(18.52043,73.856744);
    var mapOptions = {
        zoom: 8,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
    google.maps.event.addListener(map, 'click', function() {
        infowindow.close();
    });
}

function clone(obj){
    if(obj == null || typeof(obj) != 'object') return obj;
    var temp = new obj.constructor();
    for(var key in obj) temp[key] = clone(obj[key]);
    return temp;
}


function geocodePosition(pos) {
    geocoder.geocode({
        latLng: pos
    }, function(responses) {
        if (responses && responses.length > 0) {
            console.log('DRAG RESPONSE');
            var latlong = responses[0]['geometry']['location'];
          //  alert(responses[0].formatted_address)
            update_address_fields_data(responses[0]['address_components'],latlong,responses[0].formatted_address)
            console.log(responses)
            marker.formatted_address = responses[0].formatted_address;

        } else {
            marker.formatted_address = 'Cannot determine address at this location.';
        }
        infowindow.setContent(marker.formatted_address+"<br>coordinates: "+marker.getPosition().toUrlValue(6));
        infowindow.open(map, marker);
    });
}

function codeAddress() {
    var address = document.getElementById('address').value;
    geocoder.geocode( { 'address': address}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {

            console.log('----------------------');
            console.log(results);
            var latlong = results[0]['geometry']['location'];
           // alert(results[0].formatted_address)
            update_address_fields_data(results[0]['address_components'],latlong,results[0].formatted_address)
            console.log('==========================')

            map.setCenter(results[0].geometry.location);
            if (marker) {
                marker.setMap(null);
                if (infowindow) infowindow.close();
            }
            marker = new google.maps.Marker({
                map: map,
                draggable: true,
                position: results[0].geometry.location
            });
            google.maps.event.addListener(marker, 'dragend', function() {
                // updateMarkerStatus('Drag ended');
                geocodePosition(marker.getPosition());
            });
            google.maps.event.addListener(marker, 'click', function() {
                if (marker.formatted_address) {
                    infowindow.setContent(marker.formatted_address+"<br>coordinates: "+marker.getPosition().toUrlValue(6));
                } else  {
                    infowindow.setContent(address+"<br>coordinates: "+marker.getPosition().toUrlValue(6));
                }
                infowindow.open(map, marker);
            });
            google.maps.event.trigger(marker, 'click');
        } else {
            alert('Geocode was not successful for the following reason: ' + status);
        }
    });
}


function update_address_fields_data(addressComponents,latlong,formatted_address){



    var cityEl, countryEl, postcodeEl, regionEl, latE1, lngE1;
    countryEl = jQuery('#custom-address_country');
    regionEl = jQuery('#custom-address_region');
    cityEl = jQuery('#custom-address_city');
    postcodeEl = jQuery('#custom-address_postcode');
    latE1 = jQuery('#custom-address_lat');
    lngE1 = jQuery('#custom-address_lng');
    countryEl.val('');
    regionEl.val('');
    postcodeEl.val('');
    latE1.val('');
    lngE1.val('');
    cityEl.val('');


    var cnt_latlong = 0
    _.each(latlong,function(latlong_v,latlong_k){

        if(cnt_latlong==0){
            jQuery('#custom-address_lat').val(latlong_v);
        }
        else{
            jQuery('#custom-address_lng').val(latlong_v);
        }
        cnt_latlong = cnt_latlong + 1;
    })
   /* commented on 29july2015  jQuery('#custom-address_lat').val(latlong['G']);
    jQuery('#custom-address_lng').val(latlong['K']); */

    
    jQuery('#address').val(formatted_address);


    _.each(addressComponents, function(addr) {
        if (addr.types.indexOf('country') >= 0) {
            countryEl.val(addr.long_name);
        }
        if (addr.types.indexOf('administrative_area_level_1') >= 0) {
            regionEl.val(addr.long_name);
        }
        if (!regionEl.val() && addr.types.indexOf('administrative_area_level_2') >= 0) {
            regionEl.val(addr.long_name);
        }
        if (addr.types.indexOf('postal_town') >= 0) {
            cityEl.val(addr.long_name);
        }

        if (!cityEl.val() && addr.types.indexOf('administrative_area_level_2') >= 0) {
            cityEl.val(addr.long_name);
        }
        if (addr.types.indexOf('postal_code') >= 0) {
            postcodeEl.val(addr.long_name);
        }
    });

}



jQuery(document).ready(function(){
    initialize();
    setTimeout(function(){codeAddress()},300)
})