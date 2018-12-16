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

// Controller // // // // // / /// // / / // / // / // // / //
	// Controller Active -----------------------------------------
	$('#login').on('click', function(){
		var username = $("#username").val();
		var pass_value 	= $("#pass").val();
		var custom_check_login 	= $("input:checkbox:not(:checked)").val();
		login_ajax(username, pass_value, custom_check_login, 2);
	})

// Slide card
function slideCard(direction, event) {
	var btn_img_event = event.target.id;
	var flip_btn_event = event.target.className;
	if (btn_img_event == 'btn-img') {
		$('.img-content-en').toggleClass('d-block');
		$('#btn-img-en>span>i').toggleClass('ni-fat-remove');
		$('#btn-img-en>span>i').toggleClass('ni-image');
		$('.content-text:last').toggleClass("content-text-after")
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
var x = 0;
var index = 0;

$(document).ready(function () {
	enKeySlice(index);
	vnKeySlice(index);
	imgSlide(index);
	termContent();
	$('#card-en').show();
})