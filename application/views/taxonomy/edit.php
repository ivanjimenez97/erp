<h4><?php echo $title; ?></h4>
<hr>
<?php echo validation_errors(); ?>

<?php echo form_open('taxonomy/edit'); ?>

<div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label">Nombre:</label>
    <div class="col-sm-4">
    	<input type="input" class="form-control form-control-sm" name="name" value="<?php echo $tax['name']; ?>" /><br />
    </div>
</div> 

<div class="form-group row">
	<label for="description" class="col-sm-2 col-form-label">Descripción:</label><br>
	<div class="col-sm-4">
		<textarea name="description" class="form-control form-control-sm" id="description" cols="50" rows="3"><?php echo $tax['description']; ?></textarea>
	</div>
</div>

<div class="form-group row">
	<input type="hidden" name="tid" id="tid" value="<?php echo $tax['tid']; ?>" />
	<div class="col-5">
		<a class="btn btn-link" href="<?php echo site_url('taxonomy/'); ?>">Cancelar</a>
	</div>
	<div class="col">
		<input type="submit" name="submit" value="Editar" class="btn btn-success" />
	</div>
</div>

</form>