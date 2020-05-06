<div>
<h5>¿Está seguro que desea eliminar este cliente?</h5>
	<div class="form-group row">
		<label for="name" class="col-sm-2 col-form-label">Nombre:</label><div class="col-sm-4">
			<label class="font-weight-normal text-justify col-form-label" for=""><?php echo $cliente['name']; ?></label>
		</div>
	</div>

	<div class="form-group row">
		<label for="fiscal_name" class="col-sm-2 col-form-label">Nombre fiscal:</label>
		<div class="col-sm-4">
			<label class="font-weight-normal text-justify col-form-label" for="fiscal_name"><?php echo $cliente['fiscal_name']; ?></label>
		</div>
	</div>

	<div class="form-group row">
		<label for="rfc" class="col-sm-2 col-form-label">RFC:</label><div class="col-sm-4">
			<label class="font-weight-normal text-justify col-form-label"name="rfc" id="rfc" rows="6"><?php echo $cliente['rfc']; ?></label>
		</div>
	</div>	
		
    <form action="<?php echo base_url();?>clientes/delete" method="post">
    	<div class="form-group row">
	    	<input type="hidden" name="client_id" id="client_id" value="<?php echo $cliente['client_id']; ?>">
	    	<div class="col-3">
				<a class="btn btn-primary" href="<?php echo site_url('clientes/'); ?>">Cancelar</a>
	    	</div>
	    	<div class="col">
	    		<input type="submit" name="submit" value="Eliminar" class="btn btn-danger" name="delete" id="delete"/>
	    	</div>
	    	
    	</div>
    </form>

</div>
