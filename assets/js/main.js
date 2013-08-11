$(function(){
	function base_url(segment){
		return 'http://localhost/tcc/'+segment;
	}

	function rate(post, value){
		var boxRate = post.find('.rate');
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
			var post = $(this).parents('.post')[0].dataset.postid;
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
				url: base_url('rate/thisPost/'+post+'/'+value),
				success: function(ret){
					if( ret ){
						// alert(ret);
					} else {
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




});