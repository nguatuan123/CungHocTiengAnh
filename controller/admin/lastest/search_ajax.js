var search_ajax = function(key){
	var form_data = new FormData();
	form_data.append('key', key);
	$.ajax({
		url: '../../model/admin/lastest/search_progess.php', // point to server-side PHP script 
        dataType: 'text', // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function(result) {
            $('#result').html(result);
        }
	})
}