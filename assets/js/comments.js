$(function(){

	$.ajax({
		type: 'get',
		dataType: 'html',
		url: base_url('comment/get/'+$('.movie .box-rate')[0].dataset.movieid),
		beforeSend: function(){
			$('.comment-box').html('<p class="t-center"><img src="'+IMG_DIR+'load.png" alt="load GIF"></p>');
		},
		success: function(comments){
			$('.comment-box').html(comments);

			$.ajax({
				type: 'get',
				dataType: 'html',
				url: base_url('account/islogged'),
				success: function(islogged){
					if( !islogged ){
						$('.make-comment textarea').attr('disabled', 'disabled');
						$('.make-comment button').attr('disabled', 'disabled');
					}
				}
			});
		}
	});

	$('.comment-box').on('click', '.make-comment .bt-send', function(e){
		e.preventDefault();
		$.ajax({
			type: 'post',
			data: {
				comment: $('.make-comment textarea').val(), 
				idmovie: $('.movie .box-rate')[0].dataset.movieid,
				csrf_test_name: $('.make-comment input[name=csrf_test_name]').val()
			},
			dataType: 'json',
			url: base_url('comment/insert'),
			success: function(comment){
				var html =
					'<div class="comment">'+
						'<label>'+comment.username+
							'<span class="muted"> - '+comment.datetime+'</span>'+
						'</label>'+
						'<blockquote><p>'+comment.comment+'</p></blockquote>'+
					'</div>'
				;
				$('.comments-list').append(html);
				$('.make-comment textarea').val('');
				alert('Obrigado por comentar');
			}
		});
	});

});