<!DOCTYPE html>
<html>
<head>
	<title>Sistema de Recomendação</title>
	<meta charset="utf-8">
	<link type="text/css" rel="stylesheet" href="<?=TP_DIR?>twitterbootstrap/css/bootstrap.min.css">
	<link type="text/css" rel="stylesheet" href="<?=CSS_DIR?>main.css">
</head>
<body>
	<header>
		<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
					<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="brand" href="#">Sistema de Recomendação</a>
					<div class="nav-collapse collapse">
						<ul class="nav">
              				<li><a href="<?=base_url()?>">Home</a></li>
              			</ul>
						<?=isset($login) ? $login : ''?>
					</div>
				</div>
			</div>
	    </div>
	</header>
	<div class="container">
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
									<h4><?=$rec['title']?></h4>
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
									<img class="img-rounded" src="<?=IMG_DIR.$rec['logo']?>" alt="imagem" width="214" height="317">
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
	</div>
	<footer>
		<div class="container">Sistema de Recomendações - Belchior Oliveira</div>
	</footer>
	<script type="text/javascript" src="<?=TP_DIR?>jquery-2.0.1.min.js"></script>
	<script type="text/javascript" src="<?=TP_DIR?>twitterbootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?=JS_DIR?>main.js"></script>
</body>
</html>