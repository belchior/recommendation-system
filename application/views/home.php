<?php 
foreach( $posts as $post ){
	?>
	<section class="f-left post" data-postid="<?=$post['idpost']?>">
		<h2><?=$post['title']?></h2>
		<div class="t-right box-rate">
			<?php
			for( $i=1; $i <= 5; $i++ ){
				$star = 'star.png';
				if( $post['rating'] >= $i ){
					$star = $post['userRating'] ? 'star-user-visited.png' : 'star-visited.png';
				}
				echo "<a href='#' class='rate'><img alt='estrela' src='".IMG_DIR.$star."' width='30' height='30'></a>";
			}
			?>
		</div>
		<p class="t-justify post-text">
			<img class="post-img f-left" alt="imagem" src="<?=IMG_DIR . $post['image']?>" width="200" height="200">
			<?=$post['content']?>
		</p>
		<a href="#" class="t-right leia-mais">leia mais</a>
	</section>
	<?php
}
?>