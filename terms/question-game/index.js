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

	var getInput = function(){
		return $('#input').val();
	}
	
	var question = function(i) {
		var timeleft = 20;
		$("#time").html(20);
		var downloadTimer = setInterval(function(){
		  	$("#time").html(--timeleft);
		  	if(timeleft === 0){
		  		$('.correct').html('<span class="text-danger">time up</span>');
				$('.correct').show();
		    	clearInterval(downloadTimer);
		    	setTimeout(function(){
					return question(i + 1);
		    	}, 800)
			}
		},1000);
		$('#score').html(score);
		$('.correct').hide();
		$('.correct').html('Correct');
		$('#voca-number').html(i + 1);
		$('.result').hide();
		$("#input").val("");
		$('#key-word').html(en_key[i]);

		if ( i === en_key.length ){
			$('.success-component').show();
			$('#success').html(score);
			setTimeout(function(){
				window.location = '../flash-card/?id='+id_key+'';
			}, 2000);
			return 0;
		}

		$('#input').on('keyup', function(){
			keyAudio.play();
			setTimeout(function(){
				keyAudio.pause();
			},50)
			if ( getInput().toUpperCase() === vn_key[i].toUpperCase() ) {
				successAudio.play();
				score += 10;
				$('.result').html('correct');
				$('.result').show();
				$('.correct').show();
				setTimeout(function(){
					clearInterval(downloadTimer);
					return question(i + 1);
				}, 800);
			} 

			else {
				$('.result').html('imcorrect');
				$('.result').show();
				setTimeout(function(){
					$('.result').hide();
				}, 200);
			}
		});
	};
	var keyAudio = document.createElement("audio");
	keyAudio.src = "../../package/sound/keyPress.mp3";
	var successAudio = document.createElement('audio');
	successAudio.src = "../../package/sound/success.mp3";
	var score = 0;
	
	$('#start').on('click', function(){
		$('body').attr('style', 'overflow : hidden');
		$('#game-content').show(200);
		$('body,html').animate({scrollTop: 0}, 800);
		question(0);	
	});

	setTimeout(function(){ $('#greeting').remove();$('.main-content').fadeIn( "slow") }, 3400);