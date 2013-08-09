<h2><?php echo isset($message) && $message	? $message : ''?></h2>
<?=form_open('account/save')?>
	<fieldset>
		<legend>Crie sua Conta</legend>
		<label>Nome de usuário</label>
		<input type="text" name="username" maxlength="100" value="<?=set_value('username')?>">
		<?=form_error('username')?>

		<label>Email</label>
		<input type="email" name="email" maxlength="100" value="<?=set_value('email')?>">
		<?=form_error('email')?>

		<label>Senha</label>
		<input type="password" name="password" maxlength="100">
		<?=form_error('password')?>

		<label>Informe seus filmes preferidos separados por ponto e vírgula (;)</label>
		<textarea name="preferences"><?=set_value('preferences')?></textarea>
		<?=form_error('preferences')?>

		<label></label>
		<input type="submit" value="Criar conta" class="btn btn-primary">
	</fieldset>
<?=form_close()?>
