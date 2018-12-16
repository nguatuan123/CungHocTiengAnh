	// Setting
	$('#setting-spaceship').on('click', function(){
		$('#setting-menu').toggle();
		$('#setting-menu>div').toggleClass('setting-item-animation');
		$('#setting-spaceship').toggleClass('spaceship-stop');
	})

	// Click outsite
	$(function(){				
				
				var outsite = $(window); // or $box parent container
				var insite = $("#setting-component");
				
				outsite.on("click.Bst", function(event){		
					if ( 
            			insite.has(event.target).length == 0 //checks if descendants of $box was clicked
            			&&
            			!insite.is(event.target) //checks if the $box itself was clicked
          			){
						$('#setting-menu').hide();
						$('#setting-spaceship').addClass('spaceship-stop');
						$('#setting-menu>div').removeClass('setting-item-animation');
					} else {
						return 0;
					}
				});
  
	});