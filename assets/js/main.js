$(function(){
	function base_url(segment){
		return 'http://localhost/tcc/'+segment;
	}

//	console.log();	
	var IMG_DIR = 'assets/img/';
	var oldStars = Array();
	$('.rate')
		.on('mouseenter', function(){
			var rates = $(this).prevAll();
			for (var i = 0; i < rates.length; i++){
				oldStars[i] = $(rates[i]).find('img').attr('src');
				$(rates[i]).find('img').attr('src', IMG_DIR+'star-hover.png');
			}
			oldStars[rates.length] = $(this).find('img').attr('src');
			$(this).find('img').attr('src', IMG_DIR+'star-hover.png');
		})
		.on('mouseleave', function(){
			var rates = $(this).prevAll();
			for (var i = 0; i < rates.length; i++){
				$(rates[i]).find('img').attr('src', oldStars[i]);
			}
			$(this).find('img').attr('src', oldStars[i]);
		})
		.on('click', function(e){
			e.preventDefault();
			var rates = $(this).parent().children();
			var myPosition = $(this).prevAll().length;
			var movie = $(this).parents('.box-rate')[0].dataset.movieid;
			
			var value = myPosition+1;
			
			
			for (var i = 0; i < rates.length; i++) {
				if( i <= myPosition ){
					$(rates[i]).find('img').attr('src', IMG_DIR+'star-user-visited.png');
					oldStars[i] = IMG_DIR+'star-user-visited.png';
				} else {
					$(rates[i]).find('img').attr('src', IMG_DIR+'star.png');
					oldStars[i] = IMG_DIR+'star.png';
				}
			};

			$.ajax({
				type: 'get',
				dataType: 'html',
				url: base_url('rate/thismovie/'+movie+'/'+value),
				success: function(ret){
					if( !ret ){
						alert('Ocoreu um problema ao salvar sua nota.');
					}
					
				}
			});
		});

	$('.login')
		.on('mouseenter', function(){
			$(this).find('.hide').slideDown();
			$('input[name=username]').focus();
		})
		.on('mouseleave', function(){
			$(this).find('.hide').slideUp();	
		});	

	$('.password-link').on('click', function(e){
		e.preventDefault();
		$('.password-link').hide();
		$('.password-box').show();
		$('input[name=validatePassword]').val('1');
		$('input[name=password]').focus();
	});
	
	$(window).on('scroll', function(e){
		if( $(this).scrollTop() > 80 ){
			$('.recommendation').css('position', 'fixed');
		} else {
			$('.recommendation').css('position', 'inherit');
		}
	});
	
	// slider
	$('.slider ul').css('width', (300 * $('.slider ul').children().length)+'px' );
	$('.slider .back').on('click', function(e){
		e.preventDefault();
		var value = 300 + (1 * $('.slider ul').css('margin-left').split('px')[0]);
		value = value > 0 ? '-'+(Math.abs($('.slider ul').css('width').split('px')[0]) - 300) : value;
		$('.slider ul').animate({'margin-left': value}, 600);
	});
	$('.slider .forward').on('click', function(e){
		e.preventDefault();
		var value = -300 + (1 * $('.slider ul').css('margin-left').split('px')[0]);
		value = Math.abs(value) < Math.abs($('.slider ul').css('width').split('px')[0]) ? value : 0;
		$('.slider ul').animate({'margin-left': value}, 600);
	});
	
	$('.more-movies').on('click', function(){
		$('body').animate({scrollTop:0}, 600);
	});

});