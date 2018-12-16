$('a:last').hide();
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
	
// Controller Active -----------------------------------------
	// Login
	$('#login').on('click', function(){
		var usernameLogin = $("#username-login").val();
		var pass_value 	= $("#pass-login").val();
		var custom_check_login 	= $("input:checkbox:not(:checked)").val();
		login_ajax(usernameLogin, pass_value, custom_check_login, 1);
	})

	//Register
	$('#register').on('click', function(){
		var firstName = $('#first-name-regis').val();
		var lastName = $('#last-name-regis').val();
		var password = $("#password-regis").val();
		var confirm_password = $("#confirm-password");
		var username 	= $('#username-regis').val();
		var email 		= $('#email-regis').val();
		var gender = $('input[name=custom-radio-1]:checked').val();
		if (password === '' && confirm_password.val() === ''){return 0};
		if(password.length < 8) {return 0};
		if(password != confirm_password.val()) {
		    confirm_password[0].setCustomValidity("Passwords Don't Match");
		} 
		else {
			register_ajax(firstName, lastName, username, email, password, gender);
		}
	})