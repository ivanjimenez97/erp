<div>
<h5>¿Estas seguro que desea eliminar esta Marca?</h5>
<hr>
	<div class="form-group row">
		<label for="name" class="col-sm-2 col-form-label">Nombre:</label><div class="col-sm-4">
			<label class="font-weight-normal text-justify" for=""><?php echo $marca['name']; ?></label>
		</div>
	</div>

	
	<form action="<?php echo base_url();?>marcas/delete" method="post">
		<div class="form-group row">
			<input type="hidden" name="brand_id" id="brand_id" value="<?php echo $marca['brand_id']; ?>" />
			<div class="col-2">
				<a class="btn btn-link" href="<?php echo base_url('marcas/'); ?>">Cancelar</a>
			</div>
			<div class="col">
			    <input type="submit" name="submit" value="Eliminar" class="btn btn-danger"/>
			</div>
		</div>
	</form>


</div>
