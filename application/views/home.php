<?php 
foreach( $movies as $movie ){
	?>
	<section class="f-left movie">
		<h2><?="{$movie['title']} - {$movie['genre']}"?></h2>
		<div class="t-right box-rate" data-movieid="<?=$movie['idmovie']?>">
			<?php
			for( $i=1; $i <= 5; $i++ ){
				$star = 'star.png';
				if( $movie['rating'] >= $i ){
					$star = $movie['userRating'] ? 'star-user-visited.png' : 'star-visited.png';
				}
				echo "<a href='#' class='rate'><img alt='estrela' src='".IMG_DIR.$star."' width='30' height='30'></a>";
			}
			?>
		</div>
		<p class="t-justify movie-synopses">
			<img class="movie-logo f-left" alt="imagem" src="<?=IMG_DIR . $movie['logo']?>" width="200" height="200">
			<?=$movie['synopses']?>
		</p>
		<a href="#" class="t-right leia-mais">leia mais</a>
	</section>
	<?php
}
?>