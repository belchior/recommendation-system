<h2><?php echo isset($message) && $message	? $message : ''?></h2>
<?=form_open('account/save')?>
	<fieldset>
		<legend>Crie sua Conta</legend>

		<label class="control-label">Nome de usuário</label>
		<div class="control-group">
			<input type="text" name="username" maxlength="100" value="<?=set_value('username')?>" required>
			<?=form_error('username')?>
		</div>

		<label class="control-label">Email</label>
		<div class="control-group">
			<input type="email" name="email" maxlength="100" value="<?=set_value('email')?>" required>
			<?=form_error('email')?>
		</div>

		<label class="control-label">Senha</label>
		<div class="control-group">
			<input type="password" name="password" maxlength="100" required>
			<?=form_error('password')?>
		</div>

		<label class="control-label">Selecione seus generos preferidos</label>
		<div class="control-group f-left">
			<?php
			$i=1;
			foreach( $genres as $genre ){
				echo "
					<label>
						<input type='checkbox' name='genres[]' value='{$genre['idgenre']}'>
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
			<input type="submit" value="Criar conta" class="btn btn-primary">
		</div>
	</fieldset>
<?=form_close()?>
