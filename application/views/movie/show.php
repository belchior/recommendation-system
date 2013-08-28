<?php
// die(var_dump($movie));
?>
<section class="f-left movie">
	<h1><?=$movie['title']?></h1>
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
	<p class="movie-synopses t-justify">
		<img class="img-rounded f-left movie-logo" src="<?=IMG_DIR . $movie['logo']?>" alt="<?=$movie['title']?>" width="214" height="317">
		<?=$movie['synopses']?>
	</p>
	<table class="table table-bordered table-condensed" style="background-color: #c9c9c9;">
		<tr class="table-success t-center">
			<th colspan="2">Ficha técnica</th>
		</tr>
		<tr>
			<td>Título</td>
			<td><?=$movie['title']?></td>
		</tr>
		<tr>
			<td>Ano de publicação</td>
			<td><?=$movie['year']?></td>
		</tr>
		<tr>
			<td>Diretor</td>
			<td><?=$movie['director']?></td>
		</tr>
		<tr>
			<td>Generos</td>
			<td><?=$movie['genres']?></td>
		</tr>
		<tr>
			<td>Avaliação média</td>
			<td><?=$movie['rating'] ? "{$movie['rating']} / 5" : 'Não avaliado'?></td>
		</tr>
	</table>
</section>