<?=form_open('login', array('class' => 'login'))?>
	<div class="hide">
		<label>Email</label>
		<input type="text" name="email" maxlength="100">
		<label>Senha</label>
		<input type="password" name="password" maxlength="45">
		<label></label>
	</div>
	<input type="submit" class="btn btn-primary btn-mini" value="Entrar">
<?=form_close()?>