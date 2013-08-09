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
		<aside></aside>
		<footer></footer>
	</div>
</body>
</html>