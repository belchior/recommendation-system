<?=form_open_multipart("login", array('class'=>'navbar-form pull-right'))?>
	<input class="span2" type="text" name="email" placeholder="Email">
	<input class="span2" type="password" name="password" placeholder="Senha">
	<button type="submit" class="btn">Entrar</button>	
<?=form_close()?>