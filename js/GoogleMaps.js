 
 		var markers = [];
	   var longitud = -102.052022695716;
	   var latitud = 19.408381064744464;
function initMap(){
	
	  
$(document).ready(function () {
	
	
	
   
     var haightAshbury = {lat: 19.408381064744464, lng: -102.052022695716};

       var map = new google.maps.Map(document.getElementById('map'), {
         center: {lat: 19.408381064744464, lng: -102.052022695716},
         zoom: 16,
        
         
       });

     // This event listener will call addMarker() when the map is clicked.
     map.addListener('click', function(event) {
    	 deleteMarkers();
         addMarker(event.latLng);
     
     });

     // Adds a marker at the center of the map.
     addMarker(haightAshbury);
  

   // Adds a marker to the map and push to the array.
   function addMarker(location) {
     var marker = new google.maps.Marker({
       position: location,
       map: map
     });
     markers.push(marker);
    
     longitud = marker.getPosition().lng();
     latitud =  marker.getPosition().lat();
   }

   // Sets the map on all markers in the array.
   function setMapOnAll(map) {
     for (var i = 0; i < markers.length; i++) {
       markers[i].setMap(map);
     }
   }

   // Removes the markers from the map, but keeps them in the array.
   function clearMarkers() {
     setMapOnAll(null);
   }

   // Shows any markers currently in the array.
   function showMarkers() {
     setMapOnAll(map);
   }

   // Deletes all markers in the array by removing references to them.
   function deleteMarkers() {
     clearMarkers();
     markers = [];
   }
   
});}
