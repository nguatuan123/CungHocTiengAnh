// Controller // // // // // / /// // / / // / // / // // / //
	// Controller Function() ------------------------------------
	var login_ajax = function(username, pass, cus_check_login, direction){
		$('#load-circle').show();
		if (direction === 0) {
			var url = 'model/login-process/login-process.php';
		}
		if (direction === 1) {
			var url = '../model/login-process/login-process.php';
		}
		if(direction === 2){
			var url = '../../model/login-process/login-process.php';
		}
		var form_data = new FormData();
		form_data.append('username', username);
		form_data.append('pass', pass);
		form_data.append('cus_check_login', cus_check_login);
		form_data.append('direction', direction);
		$.ajax({
	        url: url, // point to server-side PHP script 
	        dataType: 'text', // what to expect back from the PHP script, if anything
	        cache: false,
	        contentType: false,
	        processData: false,
	        data: form_data,
	        type: 'post',
	        success: function(result) {
	        	$('#load-circle').hide();
	            $('#result').html(result);
	        }
	    });
	}