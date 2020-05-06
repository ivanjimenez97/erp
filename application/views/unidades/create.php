<h4><?php echo $title; ?></h4>
<hr>
<?php echo validation_errors(); ?>

<?php echo form_open('unidades/create'); ?>
<div class="form-group row">
    <div class="col-1">
    	<label for="name" class="col-sm-2 col-form-label">Nombre:</label>
    </div>	
    <div class="col-sm-3">
    	<input type="input" class="form-control form-control-sm" name="name" /><br />
    </div>
</div>

<div class="form-group row">
	<div class="col-3">
		<a class="btn btn-link" href="<?php echo base_url('unidades/'); ?>">Cancelar</a>
	</div>
	<div class="col">
	    <input type="submit" name="submit" value="Crear" class="btn btn-success"/>
	</div>
</div>

</form>