<h4><?php echo $title; ?></h4>
<hr>

<script src="<?= base_url('assets/js/productos.js') ?>"></script>

<?php echo validation_errors(); ?>
<?php if(isset($error)){print $error;}?>
	<?php echo form_open_multipart('productos/edit'); ?>
	<div class="form-group row">
	    <label for="name" class="col-sm-1 col-form-label">Nombre:</label><div class="col-sm-4">
			<input type="input" class="form-control form-control-sm" name="name" value="<?php echo $product['name'];?>" />
		</div>
	</div>

	<div class="form-group row">

			<label for="image" class="col-sm-1 col-form-label">Cambiar Imagen:</label>

		<div class="col-sm-4">
			<input type="file" class="form-control-file" name="image" id="image" value="<?php echo $product['image'];?>">
		</div>
		<div class="col-sm-2 auto">
			<img src="<?php echo base_url().'uploads/imagenes/'.$product['image']; ?>" alt="Responsive image" class="img-fluid img-thumbnail" width="200px"/>
		</div>		
	</div>
	<div class="form-group row">

		<div class="col-4">
		<label for="name" class="col-form-label">Categoría:</label>
		<select class="form-control form-control-sm" name="term" id="term">
			<option value="0">Selecciona una Categoría</option>
			
		<?php
		
			foreach ($categoria as $cat)
			{
				if ($cat['term_id'] == $product['categoria_id']) {
					echo '<option value="'.$cat['term_id'].'" Selected>'.$cat['term'].'</option>';
				}
				else
				{
				echo '<option value="'.$cat['term_id'].'">'.$cat['term'].'</option>';
				}
			}

		?>
		</select>
		</div>
		
		<div class="col-4">
			<label for="name" class="col-form-label">Sub Categoría:</label>
		    <select class="form-control form-control-sm" name="subterm" id="subterm">
		    	<option value="0">Selecciona una Sub Categoría</option>
		   	<?php

		   	 	echo '<option value="'.$product['term_id'].'" Selected>'.$product['term'].'</option>';			
			/*foreach($taxonomyterms as $taxterms)
			{
				echo '<option value="'.$taxterms['term_id'].'">'.$taxterms['term'].'</option>';
			}*/

		    	 ?>
		    </select>
		</div>
	</div>

	<div class="form-group row">
		<div class="col-4">
	    <select class="form-control form-control-sm" name="unit" id="unit">
	    	<option value="0">Selecciona una Unidad</option>

	    <?php
		if ($unit = $product['unit_id']) 
		{
			echo '<option value="'.$product['unit_id'].'" Selected>'.$product['nameu'].'</option>';
		}
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
	    if ($brand = $product['brand_id']) 
		{
			echo '<option value="'.$product['brand_id'].'" Selected>'.$product['nameb'].'</option>';
		}
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
		    	<input type="number" class="form-control form-control-sm" name="price" value="<?php echo $product['price']; ?>">
		    </div>
		</div>
		
		<div class="form-group col-sm-4">
		    <label for="barcode" class="col-form-label">Cod. Barras</label><br>
		    <div class="col-sm">
		    	<input type="number" class="form-control form-control-sm" name="barcode" value="<?php echo $product['barcode']; ?>">
			</div>
		</div>
	</div>
	<div class="form-group row">
		<label for="description" class="col-sm-1 col-form-label">Descripción</label><br>
		<div class="col-sm-4">
			<textarea name="description" class="form-control form-control-sm" id="description" cols="60" rows="4"><?php echo $product['description']; ?></textarea>
		</div>
	</div>

	<div class="form-group row">
	    	<input type="hidden" name="pid" id="pid" value="<?php echo $product['product_id']; ?>" />
		<div class="col-4">
	    	<a class="btn btn-link" href="<?php echo base_url('productos/'); ?>">Cancelar</a>
		</div>
		<div class="col">
	    	<input type="submit" name="edit" value="Editar" class="btn btn-success" />
	    </div>	
	</div>
	    
	</form>

<script>

</script>