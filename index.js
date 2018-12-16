// Makup // / / // / / // // // // / // / / // / / / / // / / /
	// Enter to Submit
	$(function() {
	    $('#login-form').each(function() {
	        $(this).find('input').keypress(function(e) {
	            // Enter pressed?
	            if(e.which == 10 || e.which == 13) {
	                $('#login').click();
	            }
	        });
	    });
	});

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

	// Sider thumb scroll
	$(window).on("load",function() {
		$(window).scroll(function(e){
			var scrollTop = $(window).scrollTop();
			var docHeight = $(document).height();
			var winHeight = $(window).height();
			var scrollPercent = (scrollTop) / (docHeight - winHeight);
			var scrollPercentRounded = Math.round(scrollPercent*50);
				$('.thumb-controls').animate({top : ''+scrollPercentRounded+'%'}, 10)
		});
	});
		
// Controller // // // // // / /// // / / // / // / // // / //
	// Controller Active -----------------------------------------
	$('#login').on('click', function(){
		var username = $("#username").val();
		var pass_value 	= $("#pass").val();
		var custom_check_login 	= $("input:checkbox:not(:checked)").val();
		login_ajax(username, pass_value, custom_check_login, 0);
	})