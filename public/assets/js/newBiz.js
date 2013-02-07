$(function() {
	var geocoder = new google.maps.Geocoder();
	
	function geocodePosition(pos) {
	  geocoder.geocode({
	    latLng: pos
	  }, function(responses) {
	    if (responses && responses.length > 0) {
	      updateMarkerAddress(responses[0].formatted_address);
	    } else {
	      updateMarkerAddress('No se puede determinar la direccion');
	    }
	  });
	}
	
	function updateMarkerPosition(latLng) {
	  document.getElementById('coordinates').value = [
	    latLng.lat(),
	    latLng.lng()
	  ].join(', ');
	}
	
	function updateMarkerAddress(str) {
	  document.getElementById('address').value = str;
	}
	
	function initialize() {
	  var latLng = new google.maps.LatLng(32.53378399190336, -117.02930969677737);
	  var map = new google.maps.Map(document.getElementById('mapCanvas'), {
	    zoom: 8,
	    center: latLng,
	    mapTypeId: google.maps.MapTypeId.ROADMAP
	  });
	  var marker = new google.maps.Marker({
	    position: latLng,
	    title: 'Point A',
	    map: map,
	    draggable: true
	  });
	  updateMarkerPosition(latLng);
	  geocodePosition(latLng);
	  google.maps.event.addListener(marker, 'dragstart', function() {
	    updateMarkerAddress('Calculando...');
	  });
	  google.maps.event.addListener(marker, 'drag', function() {
	    updateMarkerPosition(marker.getPosition());
	  });
	  google.maps.event.addListener(marker, 'dragend', function() {
	    geocodePosition(marker.getPosition());
	  });
	}
	
	google.maps.event.addDomListener(window, 'load', initialize);


    /**
     * Ocultar o mostrar el tipo de cocina cuando el negocio es restaurante
     */
    $('#id_businesses_type').on('change', function(event){
    	if($('#id_businesses_type option:selected').text() == 'Restaurante') {
    		$('#bizcuisines-label').show();
    		$('#bizcuisines').show();
    	} else {
    		$('#bizcuisines-label').hide();
    		$('#bizcuisines').hide();
    	}
    });
    /**
     * Ocultar o mostrar los campos opcionales
     */
    $('#showoptional').on('click', function(event) {
    	event.preventDefault();
    	if($('.otherOptions').is(":visible")) {
    		$('.otherOptions').hide();
    	} else {
    		$('.otherOptions').slideDown('slow');
    	}
    });
    /**
     * Autocompletado de zonas
     */
     $('#bizzone').autocomplete({
         source: '/biz/getzones/',
         minLength: 3,
         messages: {
             noResults: null,
             results: function() {}
         }
     });
     /**
      * Autocompletado de nombres de negociosos existentes
      */
     $('#name').autocomplete({
         source: '/biz/getbusinesses/',
         minLength: 3,
         messages: {
             noResults: null,
             results: function() {}
         }
     });
     /**
      * Verifica si un negocio existe
      */
     $('#name').on('change', function(event) {
    	 $('#bizexist').remove();
    	 $.ajax({
    		 dataType: 'json',
    		 type: 'POST',
    		 url: "/biz/existbusiness/",
    		 data: {name: $('#name').val()},
    		 success: function ( response ) {
				if(response.status == true) {
			    	 $('#name').before("<div id='bizexist'>Ya existe este negocio</div>");
				}
			}
		});
     });
 });