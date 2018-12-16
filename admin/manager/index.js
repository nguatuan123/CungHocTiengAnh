// Slide card
function slideCard(direction, event) {
	var btn_img_event = event.target.id;
	var flip_btn_event = event.target.className;
	if (btn_img_event === 'btn-img' || btn_img_event === 'btn-img-i') {
		$('.img-content-en').toggleClass('d-block');
		$('#btn-img-en>span>i').toggleClass('ni-fat-remove');
		$('#btn-img-en>span>i').toggleClass('ni-image');
		$('.content-text:last').toggleClass("content-text-after");
	} 
	else {
		if (direction == 0) {
			$('#card-en').hide();
			$('#card-vn').show();
			$('#card-vn').addClass('slide-animate');
			$('.guide-bottom').remove();
		}
		if (direction == 1) {
			$('#card-en').show();
			$('#card-vn').hide();x
			$('#card-en').addClass('slide-animate');
			$('#card-en').removeClass('controlls-animate-right');
		}
	}
}

function enKeySlice(number_k) {
	$('#en-key').html(en_key[number_k]);
};

function vnKeySlice(number_k) {
	$('#vn-key').html(vn_key[number_k]);
}

function imgSlide(number_k) {
	if (img_url[number_k].length == 0) {

	}
	if (img_url[number_k].length > 0) {
		$('.img-content-en').attr('style', 'background-image: url("../../' + img_url[number_k] + '")');
	}
}

function controller(direction) {
	$('#card-en').show();
	$('#card-vn').hide();
	$('#card-en').removeClass('slide-animate');

	if (direction == 0) {
		$('#card-en').addClass('controlls-animate-left');
		setTimeout(function () {
			$('#card-en').removeClass('controlls-animate-left');
		}, 440);
		if (index == 0) {
			index = en_key.length - 1;
		} else {
			index--
		}
	}

	if (direction == 1) {
		$('#card-en').addClass('controlls-animate-right');
		setTimeout(function () {
			$('#card-en').removeClass('controlls-animate-right');
		}, 440);
		if (index == en_key.length - 1) {
			index = 0;
		} else {
			index++
		}
	}
	enKeySlice(index);
	vnKeySlice(index);
	imgSlide(index);
	$('.number-controler').html(index + 1);
}


function termContent() {
	for (i = 0; i < en_key.length; i++) {
		let content = "";
		content += '    <div class="row shadow  vocabulary-content">\
					      <h3 class="text-mute pt-5 ml-4 float-left">' + (parseInt(i) + 1) + '</h3>\
					      <div class="terms-key border-right">\
					        <h4 class="text-primary mt-4 text-center">' + en_key[i] + '</h4>\
					      </div>\
					      <div class="terms-key">\
					        <h4 class="text-primary mt-4 text-center">' + vn_key[i] + '</h4>\
					      </div>\
					      <div class="terms-img transform-perspective-right" style="background-image: url(' + "'" + '../../' + img_url[i] + '' + "'" + ')"></div>\
					    </div>';
		$('#terms-content').append(content);
	}
}

var removeCard = function(input){
  $(input).parent().remove();
  for( var i = 0; i < $('.container-2>.voca-area').length; i++){
    $('.card-number>b')[i].innerHTML = i + 1;
  }
}

function readURL(input) {

    if (input.files && input.files[0]) {

        var reader = new FileReader();

        reader.onload = function(e) {
            $(input)
                .parent().parent()
                .children('.preview')
                .attr('style', 'background-image: url("' + e.target.result + '");display: block');
            $(input).show;
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function removeFile(input){
	$(input).parent().attr('style', '');
}

var x = 0;
var index = 0;

$(document).ready(function () {
	enKeySlice(index);
	vnKeySlice(index);
	imgSlide(index);
	termContent();
	$('#card-en').show();
})


for (var i = 0; i < en_key.length; i++) {

	var card = "";
    card += '\
  	<div class="row bg-white shadow mt-5 voca-area">\
      	<h3 class="text-mute mt-4 ml-4 float-left card-number"><b>' + (parseInt(i) + 1) + '</b></h3>\
      	<i class="fas fa-trash-alt pointer recicle_bin" onclick="removeVoca('+id_key[i]+')"></i>\
      	<div class="TE float-left">\
        	<input type="text" class="card-small en_key" placeholder="Từ vựng.." autocomplete="off" value="'+en_key[i]+'"><br>\
        	<span class="text-mute"><b>Tiếng Anh</b></span>\
      	</div>\
      	\
      	<label class="float-left" style="font-size: 24px; position: absolute; left: 50%; margin-top: 2%" data-toggle="tooltip" data-placement="top" title="Thêm hình ảnh">\
        	<i class="ni ni-image"></i>\
        	<input type="file" name="file[]" class="inputfile img_vo" accept="image/*" onchange="readURL(this);" />\
      	</label>\
     	\
      	<div class="TV float-left">\
        	<input type="text" class="card-small vn_key" placeholder="Nghĩa.." autocomplete="off" value="'+vn_key[i]+'"><br>\
        	<span class="text-mute"><b>Tiếng Việt</b></span>\
      	</div>\
      	<div class="preview pointer" style="background-image: url(&quot;../../' + img_url[i] + '&quot;); display: block;">\
        	<i class="ni ni-fat-remove" onclick="removeFile(this)"></i>\
      	</div>\
    </div>\
    <p class="text-danger text-center result"></p>';
    $('.container-2').append(card);
};

$('#add-card').on('click', function() {
    var num_H3 = parseInt($(".container-2>.row:last>h3").text());
    var num_H3_a = num_H3 + 1;
    $('.container-2').append('\
  <div class="row bg-white shadow mt-5 voca-area">\
      <h3 class="text-mute mt-4 ml-4 float-left card-number"><b>' + num_H3_a + '</b></h3>\
      <i class="fas fa-trash-alt pointer recicle_bin" onclick="removeCard(this)"></i>\
      <div class="TE float-left">\
        <input type="text" class="card-small en_key" placeholder="Từ vựng.." autocomplete="off"><br>\
        <span class="text-mute"><b>Tiếng Anh</b></span>\
      </div>\
      \
      <label class="float-left" style="font-size: 24px; position: absolute; left: 50%; margin-top: 2%" data-toggle="tooltip" data-placement="top" title="Thêm hình ảnh">\
        <i class="ni ni-image"></i>\
        <input type="file" name="file[]" class="inputfile img_vo" accept="image/*" onchange="readURL(this);" />\
      </label>\
     \
      <div class="TV float-left">\
        <input type="text" class="card-small vn_key" placeholder="Nghĩa.." autocomplete="off"><br>\
        <span class="text-mute"><b>Tiếng Việt</b></span>\
      </div>\
      <div class="preview pointer">\
        <i class="ni ni-fat-remove" onclick="removeFile(this)"></i>\
      </div>\
    </div>\
    <p class="text-danger text-center result"></p>');
})


$('#update').on('click', function() {
    for (var i = 0; i < parseInt($(".container-2>.row").length) - 1; i++) {
    	var en_key = $('.en_key')[i].value;
        var vn_key = $('.vn_key')[i].value;
        document.getElementsByClassName('result')[i].innerHTML = '';
        if ( !en_key || !vn_key ) {
    		document.getElementsByClassName('result')[i].innerHTML = 'Fill in';
        	return 0;
        }
	}
 	for (var i = 0; i < parseInt($(".container-2>.row").length) - 1; i++){
		var en_key = $('.en_key')[i].value;
        var vn_key = $('.vn_key')[i].value;
        var file_voca_upload = $('.img_vo')[i].files[0];
        upload_voca(file_voca_upload, en_key, vn_key, name_key[0], id_key[i], img_url[i], i, parseInt($(".container-2>.row").length) - 1);
	}
});
