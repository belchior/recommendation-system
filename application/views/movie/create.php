<h2><?php echo isset($message) && $message	? $message : ''?></h2>
<?=form_open_multipart("movie/save/", array('autocomplete'=>'off'))?>
	<fieldset>
		<legend>Filme</legend>
		<label class="control-label bold">Diretor</label>
		<div class="control-group">
			<input type="text" name="director" class="span10" maxlength="100" value="<?=set_value('director')?>" required>
			<?=form_error('director')?>
		</div>

		<label class="control-label bold">Título</label>
		<div class="control-group">
			<input type="text" name="title"  class="span10" maxlength="100" value="<?=set_value('title')?>" required>
			<?=form_error('title')?>
		</div>

		<label class="control-label bold">Sinopse</label>
		<div class="control-group">
			<textarea name="synopses" class="span10" rows="10" required><?=set_value('synopses')?></textarea>
			<?=form_error('synopses')?>
		</div>

		<label class="control-label">Generos separados por ponto e vírgula (;)</label>
		<div class="control-group">
			<textarea name="genres" class="span10"><?=set_value('genres')?></textarea>
			<?=form_error('genres')?>
		</div>

		<label class="control-label">Imagem</label>
		<div class="control-group">
			<input type="file" name="logo">
			<?=form_error('logo')?>
		</div>

		<hr>
		<label class="control-label"></label>
		<div class="control-action">
			<input type="submit" value="Alterar filme" class="btn btn-primary" formnovalidate>
		</div>
	</fieldset>
<?=form_close()?>