
// Direction URLauthor
var direction_URLuser = function(event, direc_terms, direc_user) {
	var ele_event = event.target.className;
	if (ele_event === "user-url") {
		window.location = direc_user;
	}
	else {
		window.location = direc_terms;
	}
}
// Enter to Submit
	$(function() {
	    $('#form-search').each(function() {
	        $(this).find('input').keypress(function(e) {
	            // Enter pressed?
	            if(e.which == 10 || e.which == 13) {
	            	var key = $('#search').val();
	            	search_ajax(key);
	            }
	        });
	    });
	});
