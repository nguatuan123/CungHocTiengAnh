// UPLOAD Voca
var upload_voca = function(file_data, en_key, vn_key, name, count, last_time) {
    var form_data = new FormData();
    form_data.append('file', file_data);
    form_data.append('en', en_key);
    form_data.append('vn', vn_key);
    form_data.append('name', name);
    form_data.append('count', count);
    form_data.append('end', last_time);
    $.ajax({
        url: '../../model/admin/create/voca-upload.php', // point to server-side PHP script 
        dataType: 'text', // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function(php_script_response) {
                $('#result').append(php_script_response);
                $('#load-circle').hide();
        }
    });
}

var check = function(input, name){
  if ( parseInt(input) === 0 ){
     for (var i = 0; i < $(".container-2>.row").length; i++) {
        var file_voca_upload = $('.img_vo')[i].files[0];
        var en_key = $('.en_key')[i].value;
        var vn_key = $('.vn_key')[i].value;
        upload_voca(file_voca_upload, en_key, vn_key, name, i, parseInt($(".container-2>.row").length) - 1);
      }
  }
  else{
    return 0;
  }
}

var term_update = function(name, file_data, username, date) {
    $('#load-circle').show();
    var form_data = new FormData();
    form_data.append('name', name);
    form_data.append('file', file_data);
    form_data.append('username', username);
    form_data.append('date', date);
    $.ajax({
        url: '../../model/admin/create/term-upload.php', // point to server-side PHP script 
        dataType: 'text', // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function(php_script_response) {
            $('#result').html(php_script_response);
            check(php_script_response, name);
        }

    });
}

function readURL(input) {

    if (input.files && input.files[0]) {

        var reader = new FileReader();

        reader.onload = function(e) {
            $(input)
                .parent().parent()
                .children('.preview_js')
                .attr('style', 'background-image: url("' + e.target.result + '");display: block');
            $(input).show;
        };
        reader.readAsDataURL(input.files[0]);
    }
}

var removeFileTitle = function(target){
    $(target).parent().attr('style', '');
}

var removeCard = function(input){
  $(input).parent().remove();
  for( var i = 0; i < $('.container-2>.row').length; i++){
    document.getElementsByClassName('card-number')[i].innerHTML = i + 1;
  }
}

var card = "";
for (var i = 1; i <= 2; i++) {
    card += '\
  <div class="row bg-white shadow mt-5">\
      <h3 class="text-mute mt-4 ml-5 float-left font-weight-bold card-number">' + i + '</h3>\
      <i class="fas fa-trash-alt pointer recicle_bin" onclick="removeCard(this)"></i>\
      <div class="TE float-left">\
        <input type="text" class="card-small en_key" placeholder="Từ vựng.." autocomplete="off"><br>\
        <span class="text-mute"><b>Tiếng Anh</b></span>\
      </div>\
      \
      <label class="float-left" style="font-size: 24px; position: absolute; left: 50.9%; margin-top: 2%">\
        <i class="ni ni-image"></i>\
        <input type="file" name="file[]" class="inputfile img_vo" accept="image/*" onchange="readURL(this);" />\
      </label>\
     \
      <div class="TV float-left">\
        <input type="text" class="card-small vn_key" placeholder="Nghĩa.." autocomplete="off"><br>\
        <span class="text-mute"><b>Tiếng Việt</b></span>\
      </div>\
      <div class="preview pointer preview_js">\
        <i class="ni ni-fat-remove remove_file" onclick="removeFileTitle(this)"></i>\
      </div>\
    </div>\
    <p class="text-danger text-center result"></p>';
    $('.container-2').html(card);
};

$('#add-card').on('click', function() {
    var num_H3 = $(".container-2>.row").length;
    num_H3 += 1;
    $('.container-2').append('\
  <div class="row bg-white shadow mt-5">\
      <h3 class="text-mute mt-4 ml-5 float-left font-weight-bold card-number">' + num_H3 + '</h3>\
      <i class="fas fa-trash-alt pointer recicle_bin" onclick="removeCard(this)"></i>\
      <div class="TE float-left">\
        <input type="text" class="card-small en_key" placeholder="Từ vựng.." autocomplete="off"><br>\
        <span class="text-mute"><b>Tiếng Anh</b></span>\
      </div>\
      \
      <label class="float-left" style="font-size: 24px; position: absolute; left: 50.9%; margin-top: 2%">\
        <i class="ni ni-image"></i>\
        <input type="file" name="file[]" class="inputfile img_vo" accept="image/*" onchange="readURL(this);" />\
      </label>\
     \
      <div class="TV float-left">\
        <input type="text" class="card-small vn_key" placeholder="Nghĩa.." autocomplete="off"><br>\
        <span class="text-mute"><b>Tiếng Việt</b></span>\
      </div>\
      <div class="preview pointer preview_js">\
        <i class="ni ni-fat-remove remove_file" onclick="removeFileTitle(this)""></i>\
      </div>\
    </div>\
    <p class="text-danger text-center result"></p>')
})

$('#create').on('click', function() {
    if ( !$('#title').val() || $('#img_tt').prop('files')[0] === undefined) {
        document.getElementsByClassName('result')[0].innerHTML = 'Fill in';
        return 0;
    }

    for (var i = 0; i < $(".container-2>.row").length; i++) {
        var en_key = $('.en_key')[i].value;
        var vn_key = $('.vn_key')[i].value;
        document.getElementsByClassName('result')[i + 1].innerHTML = '';
        if ( !en_key || !vn_key) {
          document.getElementsByClassName('result')[i + 1].innerHTML = 'Fill in';
          return 0;
        }
    }
    
    var name = $('#title').val();
    var file_term_upload = $('#img_tt').prop('files')[0];
    var date = ('' + new Date().getDate() + '-') + ('' + (new Date().getMonth() + 1) + '-') + ('' + new Date().getFullYear() + '');

    document.getElementsByClassName('result')[0].innerHTML = '';
    term_update(name, file_term_upload, username, date); // Update to term
});

