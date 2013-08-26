<!DOCTYPE html>
<html>
<head>
	<title>Sistema de Recomendação</title>
	<meta charset="utf-8">
	<link type="text/css" rel="stylesheet" href="<?=TP_DIR?>twitterbootstrap/css/bootstrap.min.css">
	<link type="text/css" rel="stylesheet" href="<?=CSS_DIR?>main.css">
	<script type="text/javascript" src="<?=TP_DIR?>jquery-2.0.1.min.js"></script>
	<script async="async" type="text/javascript" src="<?=TP_DIR?>twitterbootstrap/js/bootstrap.min.js"></script>
	<script async="async" type="text/javascript" src="<?=JS_DIR?>main.js"></script>
</head>
<body>
	<div class="main">
		<header>
			<h1>Sistema de Recomendação</h1>
			<?php echo isset($login) ? $login : ''?>
		</header>
		<article>
			<?php echo isset($content) ? $content : ''?>
		</article>
		<aside>
			<?php
			if( isset($recommendations) && is_array($recommendations)){
				?>
				<h2 class="t-center">Recomendações</h2>
				<div class="recommendation">
					<div class="slider">
						<ul>
							<?php
							foreach( $recommendations as $rec ){
								?>
								<li>
									<h3><?=$rec['title']?></h3>
									<div class="box-rate" data-movieid="<?=$rec['idmovie']?>">
										<?php
										for( $i=1; $i<=5; $i++ ){
											$star = $rec['rating'] >= $i ? 'star-visited.png' : 'star.png';
											echo "
											<a href='#' class='rate'>
												<img alt='estrela' src='".IMG_DIR.$star."' width='30' height='30'>
											</a>
											";
										}
										?>
									</div>
									<img src="<?=IMG_DIR.$rec['logo']?>" alt="imagem" width="214" height="317">
								</li>
								<?php
							}
							?>
						</ul>
						<a href="#" class="back"><i class="icon-circle-arrow-left"></i></a>
						<a href="#" class="forward"><i class="icon-circle-arrow-right"></i></a>
					</div>
				</div>
				<?php
			}
			?>
		</aside>
		<footer></footer>
	</div>
</body>
</html>