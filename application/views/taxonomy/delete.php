<div>
<h5>¿Estas seguro que desea eliminar esta Taxonomía?</h5>
<hr>
	<div class="form-group row">
		<label for="name" class="col-sm-2 col-form-label">Nombre:</label><div class="col-sm-4">
			<label class="font-weight-normal text-justify" for=""><?php echo $tax['name']; ?></label>
		</div>
	</div>


	<div class="form-group row">
		<label for="name" class="col-sm-2 col-form-label">Descripción:</label>
		<div class="col-sm-4">
			<label class="font-weight-normal text-justify" name="description" id="description" rows="6"><?php echo $tax['description']; ?></label>
		</div>
	</div>	
	
	<form action="<?php echo base_url();?>taxonomy/delete" method="post">
	    <div class="form-group row">
	    	<input type="hidden" name="tid" id="tid" value="<?php echo $tax['tid']; ?>">
			<div class="col-3">
				<a class="btn btn-link" href="<?php echo base_url('taxonomy/'); ?>">Cancelar</a>
	    	</div>
	    	<div class="col">
	    		<input type="submit" name="submit" value="Eliminar" class="btn btn-danger" name="delete" id="delete"/>
	    	</div>

		</div>
	</form>
	
</div>