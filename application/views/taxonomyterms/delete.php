<div>
<h5>¿Estas seguro que desea eliminar este Término?</h5>
<hr>
	<div class="form-group row">
		<label for="term" class="col-sm-1 col-form-label">Término:</label><div class="col-sm-4">
			<label class="font-weight-normal text-justify" for=""><?php echo $taxterm['term']; ?></label>
		</div>
	</div>

	<div class="form-group row">
		<label for="name" class="col-sm-1 col-form-label">Taxonomía:</label><div class="col-sm-4">
			<label for=""><?php echo $taxterm['name']; ?></label>
		</div>
	</div>

	
	    <form action="<?php echo base_url();?>taxonomyterms/delete" method="post">
<div class="form-group row">
	    <input type="hidden" name="term_id" id="term_id" value="<?php echo $taxterm['term_id']; ?>">

		<div class="col-2">
	    	<a class="btn btn-link" href="<?php echo site_url('taxonomyterms/'); ?>">Cancelar</a>
	    </div>	
		<div class="col">
	    	<input type="submit" name="submit" value="Eliminar" class="btn btn-danger" name="delete" id="delete"/>
	    </div>	
	    
	</div>
	    </form>


</div>