<div>
<h5>¿Estas seguro que desea eliminar este producto?</h5>
	<div class="form-group row">
		<label for="name" class="col-sm-1 col-form-label">Nombre:</label><div class="col-sm-4">
			<label class="font-weight-normal text-justify" for=""><?php echo $product['name']; ?></label>
		</div>
	</div>

	<div class="form-group col-sm-5">
		<div class="">
			<img src="<?php echo base_url().'uploads/imagenes/'.$product['image']; ?>" alt="Responsive image" class="img-fluid img-thumbnail rounded mx-auto d-block" width="200px"/>
		</div>		
	</div>

	<div class="form-group row">
		<label for="name" class="col-sm-1 col-form-label">Precio:</label><div class="col-sm-4">
			<label for=""><?php echo $product['price']; ?></label>
		</div>
	</div>

	<div class="form-group row">
		<label for="name" class="col-sm-1 col-form-label">Descripción:</label><div class="col-sm-4">
			<label class="font-weight-normal text-justify" name="description" id="description" rows="6"><?php echo $product['description']; ?></label>
		</div>
	</div>	
		
	<form action="<?php echo base_url();?>productos/delete" method="post">
	    <div class="form-group row">
	    	<input type="hidden" name="pid" id="pid" value="<?php echo $product['product_id']; ?>">
			<div class="col-4">
	    		<a class="btn btn-link" href="<?php echo site_url('productos/'); ?>">Cancelar</a>
			</div>
			<div class="col">
	    		<input type="submit" name="submit" value="Eliminar" class="btn btn-danger" name="delete" id="delete"/>
	    	</div>
		</div>
	</form>
	    

</div>