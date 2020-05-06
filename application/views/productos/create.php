<h4><?php echo $title; ?></h4>
<hr>

<script src="<?= base_url('assets/js/productos.js') ?>"></script>

<?php echo validation_errors(); ?>
<?php if(isset($error)){print $error;}?>
<?php echo form_open_multipart('productos/create'); ?>
<div class="form-group row">
    <label for="name" class="col-sm-1 col-form-label">Nombre:</label><div class="col-sm-4">
		<input type="input" class="form-control form-control-sm" name="name" />
	</div>
</div>
<div class="form-group row">
	<label for="image" class="col-sm-1 col-form-label">Imagen:</label>
	<div class="col-sm-10">
		<input type="file" class="form-control-file" name="image" id="image">
	</div>
</div>
<div class="form-group row">
	<div class="col-4">
	<select class="form-control form-control-sm" name="term" id="term">
		<option value="0">Selecciona una Categoría</option>

	<?php
	foreach ($categoria as $cat)
	{
		echo '<option value="'.$cat['term_id'].'">'.$cat['term'].'</option>';
	}

		?>
	</select>
	</div>
	
	<div class="col-4">
		<select class="form-control form-control-sm" name="subterm" id="subterm">
		   	<option value="0">Selecciona una Sub Categoría</option>
		</select>
	</div>
</div>

<div class="form-group row">
	<div class="col-4">
    <select class="form-control form-control-sm" name="unit" id="unit">
    	<option value="0">Selecciona una Unidad</option>
    		<?php

	foreach ($unidades as $unidad)
	{
			echo '<option value="'.$unidad->unit_id.'">'.$unidad->name.'</option>';
	}


	 ?>
    </select>
	</div>
	
	<div class="col-4">
    <select class="form-control form-control-sm" name="brand" id="brand">
    	<option value="0">Selecciona una Marca</option>
    	<?php
		foreach ($marcas as $marca)
		{
			echo '<option value="'.$marca->brand_id.'">'.$marca->name.'</option>';
		}
	 	?>
    </select>
	</div>
</div>

<div class="form-group row">
	<div class="form-group col-sm-4">
	    <label for="price" class="col-form-label">Precio:</label>
		<div class="col-sm">
	    	<input type="number" class="form-control form-control-sm" name="price">
	    </div>
	</div>
	
	<div class="form-group col-sm-4">
	    <label for="barcode" class="col-form-label">Cod. Barras</label><br>
	    <div class="col-sm">
	    	<input type="number" class="form-control form-control-sm" name="barcode">
		</div>
	</div>
</div>
<div class="form-group row">
	<label for="description" class="col-sm-1 col-form-label">Descripción</label><br>
	<div class="col-sm-4">
		<textarea name="description" class="form-control form-control-sm" id="description" cols="50" rows="3"></textarea>
	</div>
</div>

<div class="form-group row">
	
	<div class="col-4">
    	<a class="btn btn-link" href="<?php echo base_url('productos/'); ?>">Cancelar</a>
	</div>
	<div class="col">
    	<input type="submit" name="submit" value="Guardar" class="btn btn-success" />
    </div>	

</div>
    
</form>
<script>

</script>