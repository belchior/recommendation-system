<?php
$attributes = array('username', 'email', 'password', 'preferences');
foreach( $attributes as $attr ){
	$value = set_value($attr);
	if( $value ){
		$user[$attr] = $value;
	}
}
?>
<h2><?php echo isset($message) && $message	? $message : ''?></h2>
<?=form_open('account/save')?>
	<fieldset>
		<legend>Altere sua Conta</legend>
		<label>Nome de usuário</label>
		<input type="text" name="username" maxlength="100" value="<?=$user['username']?>">
		<?=form_error('username')?>

		<label>Email</label>
		<input type="email" name="email" maxlength="100" value="<?=$user['email']?>">
		<?=form_error('email')?>

		<?php
		$passwordBox = $passwordLink = $value = '';
		if( $validatePassword ){
			$passwordLink = 'hide';
			$value = '1';
		} else {
			$passwordBox = 'hide';
		}
		?>
		<label>Senha</label>
		<a href="#" class="password-link <?=$passwordLink?>">alterar senha</a>
		<div class="password-box <?=$passwordBox?>">
			<input type="password" name="password" maxlength="100" value="<?=$user['password']?>">
			<input type="hidden" name="validatePassword" value="<?=$value?>">
			<?=form_error('password')?>
		</div>

		<label>Informe seus filmes preferidos separados por ponto e vírgula (;)</label>
		<textarea name="preferences"><?=$user['preferences']?></textarea>
		<?=form_error('preferences')?>

		<label></label>
		<input type="submit" value="Alterar conta" class="btn btn-primary">
	</fieldset>
<?=form_close()?>