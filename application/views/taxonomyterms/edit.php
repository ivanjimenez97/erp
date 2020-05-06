<h4><?php echo $title; ?></h4>

<hr>

<script src="<?= base_url('assets/js/taxonomy-terms.js') ?>"></script>

<?php echo validation_errors(); ?>


<?php echo form_open('taxonomyterms/edit'); ?>

<div class="form-group row">
    <label for="term" class="col-sm-1 col-form-label">Término:</label>
    <div class="col-sm-3">
    	<input type="input" class="form-control form-control-sm" name="term" value="<?php echo $taxterm['term']; ?>" />
    </div>
</div>     

<div class="form-group row">
	<div class="col-4">
		<label for="term" class="col-form-label">Taxonomía:</label>
		<select name="tid" id="tid" class="form-control form-control-sm">
			<option value="0" selected>Selecciona una Taxonomía</option>

		<?php

		foreach ($tax as $taxonomy)
		{
			if ($taxonomy['tid'] == $taxterm['taxtid']) 
			{
				echo '<option value="'.$taxonomy['tid'].'" Selected>'.$taxonomy['name'].'</option>';
			}
			else
			{
			echo '<option value="'.$taxonomy['tid'].'">'.$taxonomy['name'].'</option>';
			}
		}

		 ?>
		</select>
	</div>
</div>

<div class="form-group row">
	<div class="col-5">
		<div class="input-group-prepend">
			<div class="input-group-text">
				<input type="checkbox" name="show_options" id="show_options" onchange="javascript:mostrarInput()" class="form-control-sm"/>

				<label for="show_options" class="col-sm-2 col-form-label">Asignar taxonomía padre</label>
			</div>
		</div>
	</div>
</div>

<div class="form-group row">
	<div class="col-4">
		<select name="parent" id="parent" class="form-control form-control-sm" style="display:none;"><!--display:none;-->
			<?php 

			if ($taxterm['catid'] == $taxterm['parent']) {
				echo '<option value="'.$taxterm['catid'].'" Selected>'.$taxterm['cat'].'</option>';
			}
			elseif($taxterm['parent'] == 0){
				echo '<option value="0" Selected>Este Término no tiene parent.</option>';
			}

			 ?>
		</select>
	</div>
</div>
<div class="form-group row">
	
	<input type="hidden" name="term_id" id="term_id" value="<?php echo $taxterm['term_id']; ?>" />
	
	<div class="col-3">
		<a class="btn btn-link" href="<?php echo site_url('taxonomyterms/'); ?>">Cancelar</a>
	</div>
	<div class="col">
    	<input type="submit" name="submit" value="Guardar" class="btn btn-success"/>
    </div>
</div>
</form>
