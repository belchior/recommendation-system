<?php
$attributes = array('title', 'synopses', 'logo', 'director');
foreach( $attributes as $attr ){
	$value = set_value($attr);
	if( $value ){
		$movie[$attr] = $value;
	}
}
?>
<h2><?php echo isset($message) && $message	? $message : ''?></h2>
<?=form_open_multipart("movie/save/{$movie['url']}", array('autocomplete'=>'off'))?>
	<input type="hidden" name="idmovie" value="<?=$movie['idmovie']?>">
	<fieldset>
		<legend>Filme</legend>
		<label class="control-label bold">Diretor</label>
		<div class="control-group">
			<input type="text" name="director" class="span10" maxlength="100" value="<?=$movie['director']?>" required>
			<?=form_error('director')?>
		</div>

		<label class="control-label bold">Título</label>
		<div class="control-group">
			<input type="text" name="title" class="span10" maxlength="100" value="<?=$movie['title']?>" required>
			<?=form_error('title')?>
		</div>

		<label class="control-label bold">Ano</label>
		<div class="control-group">
			<input 	type="text" name="year" class="span1" maxlength="4" value="<?=$movie['year']?>" required
					pattern="\d{4}" title="Infore o ano do filme com 4 dígitos">
			<?=form_error('year')?>
		</div>

		<label class="control-label bold">Sinopse</label>
		<div class="control-group">
			<textarea name="synopses" class="span10" rows="10" required><?=$movie['synopses']?></textarea>
			<?=form_error('synopses')?>
		</div>

		<label class="control-label">Selecione generos para esse filme</label>
		<div class="control-group f-left">
			<?php
			$i = 1;
			foreach( $genres as $genre ){
				$checked = '';
				foreach( $movie['genres'] as $movieGenre ){
					if( $genre['idgenre'] == $movieGenre['idgenre'] ){
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
				if( $i++ == 5 ){
					echo '</div><div class="control-group f-left m-left">';
				}
			}
			?>
			<?=form_error('genres')?>
		</div>

		<label class="control-label clear">Imagem</label>
		<div class="control-group">
			<input type="file" name="logo" size="20">
			<?=form_error('logo')?>
		</div>

		<label class="control-label"></label>
		<div class="form-actions">
			<input type="submit" value="Alterar filme" class="btn btn-primary">
			<a href="<?=base_url()?>" class="btn">voltar para home</a>
		</div>
	</fieldset>
<?=form_close()?>