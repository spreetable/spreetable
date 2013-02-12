$(function() {
    $('#showoptional').on('click', function(event) {
    	event.preventDefault();
    	if($('.otherOptions').is(":visible")) {
    		$('.otherOptions').hide();
    	} else {
    		$('.otherOptions').slideDown('slow');
    	}
    });
});