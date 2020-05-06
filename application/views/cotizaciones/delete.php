<div>
<h5>¿Estas seguro que desea eliminar esta Cotización?</h5>
	<div class="form-group row">
		<div class="col-1">
			<label for="client" class="">Cliente:</label>
		</div>
		<div class="col-4">
			<label class="font-weight-normal text-justify" for="" rows="6"><?php echo $cotizacion['clientname']; ?></label>
		</div>
	</div>

	<div class="form-group row">
		<div class="col-1">
			<label for="name" class="">Descripción:</label>
		</div>
		<div class="col-4">
			<label class="font-weight-normal text-justify" for="" rows="6"><?php echo $cotizacion['qdescription']; ?></label>
		</div>
	</div>

	<div class="form-group row">
		<div class="col-sm-1">
			<label for="name" class="">Fecha:</label>
		</div>
		<div class="col-sm-4">
			<label for=""><?php date_default_timezone_set("America/Mexico_City"); echo date("Y-m-d, h:i:s a", $cotizacion['date']); ?></label>
		</div>
	</div>

	<div class="form-group row">
		<div class="col-1">
			<label for="name" class="">Total:</label>
		</div>
		<div class="col-4">
			<label class="font-weight-normal text-justify" name="total" id="total">$ <?php echo $cotizacion['total']; ?></label>
		</div>
	</div>	
		
	<form action="<?php echo base_url();?>cotizaciones/delete" method="post">
	    <div class="form-group row">
	    	<input type="hidden" name="cid" id="cid" value="<?php echo $cotizacion['quote_id']; ?>">
			<div class="col-4">
	    		<a class="btn btn-link" href="<?php echo base_url('cotizaciones/'); ?>">Cancelar</a>
			</div>
			<div class="col">
	    		<input type="submit" name="submit" value="Eliminar" class="btn btn-danger" name="delete" id="delete"/>
	    	</div>
		</div>
	</form>
	    

</div>