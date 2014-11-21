window.StamprallyApi = (function($) {
    function getSpots(success, error) {
	$.ajax({
	    type : "GET",
	    url : 'json/notes.json',
	    dataType : 'json',
	    success : success,
	    error : error
	    
	});

    }
    return {
	getSpots : getSpots
    };
})(window.jQuery);