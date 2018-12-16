// UPLOAD Voca
var removeTerm = function(id, term){
    $('#load-circle').show();
  	var form_data = new FormData();
  	form_data.append('id', id);
    form_data.append('name', term);
  	$.ajax({
      	url : '../../model/admin/manager/delete.php',
      	dataType: 'text', // what to expect back from the PHP script, if anything
      	cache: false,
      	contentType: false,
      	processData: false,
      	data: form_data,
      	type: 'post',
      	success: function(php_script_response) {
            $('#load-circle').hide();
          	$('#direction').append(php_script_response);
      	}
    });
}

var removeVoca = function(id){
  $('#load-circle').show();
  var form_data = new FormData();
  form_data.append('id', id);
  $.ajax({
      url : '../../model/admin/manager/remove-voca.php',
      dataType: 'text', // what to expect back from the PHP script, if anything
      cache: false,
      contentType: false,
      processData: false,
      data: form_data,
      type: 'post',
      success: function(php_script_response) {
          $('#load-circle').hide();
          $('#direction').append(php_script_response);
      }
    });
}


var upload_voca = function(file_data, en_key, vn_key, name, id_key, url_img_od, key_press, key_done) {
    $('#load-circle').show();
    var form_data = new FormData();
    form_data.append('file', file_data);
    form_data.append('en', en_key);
    form_data.append('vn', vn_key);
    form_data.append('name', name);
    form_data.append('id', id_key);
    form_data.append('url_img_old', url_img_od);
    form_data.append('key_press', key_press);
    form_data.append('key_done', key_done);
    $.ajax({
        url: '../../model/admin/manager/voca-upload.php', // point to server-side PHP script 
        dataType: 'text', // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function(php_script_response) {
            $('#load-circle').hide();
            $('#direction').append(php_script_response);
        }
    });
}

