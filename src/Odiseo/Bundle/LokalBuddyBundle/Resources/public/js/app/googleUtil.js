var GOOGLE_MAP = (function(){

 var placeSearch, autocomplete, map, addressMarked;
 var mapOptions = {
    zoom: 7,
    center: new google.maps.LatLng(18.1987192, -66.3526747),
    disableDefaultUI: true
  }
 
 var _initialize = function(){
    
    // Create the autocomplete object, restricting the search
    // to geographical location types.
    autocomplete = new google.maps.places.Autocomplete(
        /** @type {HTMLInputElement} */(document.getElementById('odiseo_product_address')),
        { types: ['geocode'] });
    // When the user selects an address from the dropdown,
    // populate the address fields in the form.
    google.maps.event.addListener(autocomplete, 'place_changed', function() {
      _localizarAddress(autocomplete.getPlace());

    });

    map = new google.maps.Map(document.getElementById('map_container'),   mapOptions);
}


 var _localizarAddress = function(place) {
	 	
	    //Esto que sigue genera acoplamiento. Separar en móulos, lanzar eventos.
	    $('#odiseo_product_address').attr('value', place.name );
	    $('#odiseo_product_town').attr('value', place.vicinity);
	    $('#odiseo_product_latitud').attr('value', place.geometry.location.lat() );
	    $('#odiseo_product_longitud').attr('value',  place.geometry.location.lng());
	  
	   var location = place.geometry.location
	   if (addressMarked != undefined)
		   addressMarked.setMap(null); 
        
	 	map.setCenter(location);
        map.setZoom(15);
        addressMarked = new google.maps.Marker({
            map: map,
            position: location
        });
        
        
  }
  google.maps.event.addDomListener(window, 'load', _initialize);

  return{
     localizarAddress  : _localizarAddress
  };
})();
