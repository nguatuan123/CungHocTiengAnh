var addTag = function(id){
    $('#load-circle').show();
	var form_data = new FormData();
    form_data.append('id', id);
    $.ajax({
        url: '../../model/term/addTag.php', // point to server-side PHP script 
        dataType: 'text', // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function(result) {
            $('#load-circle').hide();
            $('#tag-result').html(result);
        }
    });
}

var leaveTag = function(id, name, direction){
    $('#load-circle').show();
    var form_data = new FormData();
    form_data.append('id', id);
    form_data.append('name', name);
    form_data.append('direction', direction);
    $.ajax({
        url: '../../model/term/leaveTag.php', // point to server-side PHP script 
        dataType: 'text', // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function(result) {
            $('#load-circle').hide();
            $('#tag-result').html(result);
        }
    });
}