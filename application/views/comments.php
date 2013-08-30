<div class="bg-white make-comment">
	<?=form_open()?>
		<label>Faça um comentário <span class="username cl-blue"><?=isset($username) ? $username : ''?></span></label>
		<textarea maxlength="500"></textarea>
		<button type="button" class="btn btn-success bt-send">Enviar</button>
	<?=form_close()?>
</div>
<div class="bg-white comments-list">
	<h3>Comentários</h3>
	<?php
	if( isset($comments) && is_array($comments) ){
		foreach( $comments as $comment ){
			?>
			<div class="comment">
				<label><?=$comment['username']?>
					<span class="muted"> - <?=dateTimeBr($comment['datetime'])?></span>
				</label>
				<blockquote><p><?=$comment['comment']?></p></blockquote>
			</div>
			<?php
		}
	}
	?>
</div>