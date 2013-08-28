$(function(){
	function base_url(segment){
		return 'http://localhost/tcc/'+segment;
	}

	var IMG_DIR = base_url('assets/img/');
	var oldStars = Array();
	
	/**	Home **/
	$('article')
		.on('mouseenter', '.rate', function(){
			var rates = $(this).prevAll();
			for (var i = 0; i < rates.length; i++){
				oldStars[i] = $(rates[i]).find('img').attr('src');
				$(rates[i]).find('img').attr('src', IMG_DIR+'star-hover.png');
			}
			oldStars[rates.length] = $(this).find('img').attr('src');
			$(this).find('img').attr('src', IMG_DIR+'star-hover.png');
		})
		.on('mouseleave', '.rate', function(){
			var rates = $(this).prevAll();
			for (var i = 0; i < rates.length; i++){
				$(rates[i]).find('img').attr('src', oldStars[i]);
			}
			$(this).find('img').attr('src', oldStars[i]);
		})
		.on('click', '.rate', function(e){
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
	
	// search
	$('article').on('click', '.bt-search', function(){
		var search = $('input[name=search]').val();
		if( !search ){
			return false;
		}
		$.ajax({
			type: 'get',
			dataType: 'html',
			url: base_url('search/'+encodeURI(search)),
			beforeSend: function(){
				$('.form-search').append(
					'<img src="'+base_url('assets/img/load.png')+'" alt="GIF load" width="30" height="30">'
				);
			},
			success: function(html){
				if( !html ){
					html = 'Nenhum resultado encontrado';
				}
				
				$('article').html(html);
			},
			complete: function(){
				$('.form-search img').remove();
			}
		});
	});
	$('article').on('keypress', 'input[name=search]', function(e){
		console.log(e.which);
		if( e.which == 13 ){
			$('.bt-search').trigger('click');
		}
	});
	
	/** User **/
	$('.password-link').on('click', function(e){
		e.preventDefault();
		$('.password-link').hide();
		$('.password-box').show();
		$('input[name=validatePassword]').val('1');
		$('input[name=password]').focus();
	});

});