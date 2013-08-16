<?php
$attributes = array('username', 'email', 'password');
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

		<label class="control-label">Nome de usuário</label>
		<div class="control-group">
			<input type="text" name="username" maxlength="100" value="<?=$user['username']?>">
			<?=form_error('username')?>
		</div>

		<label class="control-label">Email</label>
		<div class="control-group">
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
		</div>

		<label class="control-label">Senha</label>
		<div class="control-group">
			<a href="#" class="password-link <?=$passwordLink?>">alterar senha</a>
			<div class="password-box <?=$passwordBox?>">
				<input type="password" name="password" maxlength="100">
				<input type="hidden" name="validatePassword" value="<?=$value?>">
				<?=form_error('password')?>
			</div>
		</div>

		<label class="control-label">Selecione seus generos preferidos</label>
		<div class="control-group f-left">
			<?php
			$i=1;
			foreach( $genres as $genre ){
				$checked = '';
				foreach( $user['genres'] as $userGenre ){
					if( $genre['idgenre'] == $userGenre['idgenre'] ){
						$checked = 'checked';
						break;
					}
				}
				echo "
					<label>
						<input type='checkbox' name='genres[]' value='{$genre['idgenre']}' {$checked}>
						{$genre['genre']}
					</label>
				";
				if( $i++ == 6 ){
					echo '</div><div class="control-group f-left">';
				}
			}
			echo form_error('genres');
			?>
		</div>

		<label class="control-label clear"></label>
		<div class="form-actions">
			<input type="submit" value="Alterar conta" class="btn btn-primary">
			<a href="<?=base_url()?>" class="btn">voltar para home</a>
		</div>
	</fieldset>
<?=form_close()?>