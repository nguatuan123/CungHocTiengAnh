var register_ajax = function(firstName, lastName, username, email, password, gender){
    $('#load-circle').show();
	var form_data = new FormData();
    form_data.append('firstName', firstName);
    form_data.append('lastName', lastName);
	form_data.append('username', username);
	form_data.append('email', email);
	form_data.append('password', password);
	form_data.append('gender', gender);
	$.ajax({
        url: '../model/register/register.php', // point to server-side PHP script 
        dataType: 'text', // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function(result) {
            $('#load-circle').hide();
            $('#res-result').html(result);
        }
    });
}

