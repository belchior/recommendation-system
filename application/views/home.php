<?=form_open_multipart("login", array('class'=>'form-search t-center', 'style'=>'margin-top: 80px;'))?>
	<input type="search" name="search" class="span4" placeholder="Faça sua pesquisa aqui">
  	<input type="submit" class="btn btn-success" value="Pesquisar">
<?php
echo form_close();
foreach( $movies as $movie ){
	?>
	<section class="f-left movie">
		<h2>
			<a href="<?=base_url('movie/alter/'.normalize_url($movie['title']))?>"><?="{$movie['title']}"?></a>
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
			<img class="movie-logo f-left" alt="imagem" src="<?=IMG_DIR . $movie['logo']?>" width="214" height="317">
			<?=$movie['synopses']?>
		</p>
		<a href="#" class="t-right leia-mais">leia mais</a>
	</section>
	<?php
}
?>
<label class="t-center"><a href="#" class="btn more-movies">Mais filmes</a></label>