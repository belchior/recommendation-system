<?php
$attributes = array('title', 'synopses', 'logo', 'genres', 'director');
foreach( $attributes as $attr ){
	$value = set_value($attr);
	if( $value ){
		$movie[$attr] = $value;
	}
}
?>
<h2><?php echo isset($message) && $message	? $message : ''?></h2>
<?=form_open_multipart("movie/save/{$movie['idmovie']}", array('autocomplete'=>'off'))?>
	<fieldset>
		<legend>Filme</legend>
		<label class="control-label bold">Diretor</label>
		<div class="control-group">
			<input type="text" name="director" class="span10" maxlength="100" value="<?=$movie['director']?>" required>
			<?=form_error('director')?>
		</div>

		<label class="control-label bold">Título</label>
		<div class="control-group">
			<input type="text" name="title"  class="span10" maxlength="100" value="<?=$movie['title']?>" required>
			<?=form_error('title')?>
		</div>

		<label class="control-label bold">Sinopse</label>
		<div class="control-group">
			<textarea name="synopses" class="span10" rows="10" required><?=$movie['synopses']?></textarea>
			<?=form_error('synopses')?>
		</div>

		<label class="control-label">Generos separados por ponto e vírgula (;)</label>
		<div class="control-group">
			<textarea name="genres" class="span10"><?=$movie['genres']?></textarea>
			<?=form_error('genres')?>
		</div>

		<label class="control-label">Imagem</label>
		<div class="control-group">
			<input type="file" name="logo" size="20">
			<?=form_error('logo')?>
		</div>

		<hr>
		<label class="control-label"></label>
		<div class="control-action">
			<input type="submit" value="Alterar filme" class="btn btn-primary">
		</div>
	</fieldset>
<?=form_close()?>