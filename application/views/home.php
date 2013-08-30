<div class="form-search t-center" style="margin-top: 25px;">
	<input 	type="search" name="search" class="span4" placeholder="Faça sua pesquisa aqui"
			value="<?=isset($search) ? $search : ''?>">
  	<button type="button" class="btn btn-success bt-search">Pesquisar</button>
</div>
	
<?php
if( isset($movies) && is_array($movies) && $movies ){
	foreach( $movies as $movie ){
		?>
		<section class="f-left movie">
			<h2>
				<a href="<?=base_url('movie/alter/'.$movie['url'])?>"><?="{$movie['title']}"?></a>
			</h2>
			<h5><?=$movie['genres']?></h5>
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
				<a href="<?=base_url('movie/show/'.$movie['url'])?>">
					<img class="img-rounded movie-logo f-left" alt="imagem" src="<?=IMG_DIR . $movie['logo']?>" width="214" height="317">
				</a>
				<?=$movie['synopses']?>
			</p>
			<a href="<?=base_url('movie/show/'.$movie['url'])?>" class="t-right leia-mais">leia mais</a>
		</section>
		<?php
	}
} else {
	echo '<h4 class="t-center">Nenhum resultado foi encontrado</h4>';
}
?>