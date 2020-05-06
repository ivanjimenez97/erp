<script src="<?= base_url('assets/js/cotizaciones.js') ?>"></script>
<div>
        <h4><?php echo $title; ?></h4>
        <hr>
                <div class="text-center">
                <a class="btn btn-success" href="<?php echo base_url('cotizaciones/cart'); ?>"><i class="fas fa-plus"></i> Nuevo Cotizacion</a>
                </div>
                <div>
                        <?php echo $pagination; ?>
                </div>
</div>
<hr>

<div class="table-responsive-sm">
<table class="indexlist table table-sm table-hover table-bordered mw-100">
<thead class="thead-dark">	
	<tr>	
                <th>Cliente</th>	
		<th>Descripción</th> 
                <th>Total</th>
		<th>Fecha</th>		
		<th>Opciones</th>
	</tr>
</thead>
<?php foreach ($cotizaciones as $cotizacion) : ?>
<tbody>
        <tr>
                <td class="font-weight-normal text-justify"><?php echo $cotizacion['clientname']; ?></td>
        	<td class="md font-weight-normal text-justify"><?php echo word_limiter($cotizacion['description'], 20); ?></td>

        	<td class="font-weight-normal text-justify">
                        <div class="input-group mb-3 d-flex bd-highlight">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input data-inputmask="'alias': 'currency'" type="text" class="totallist form-control" value="<?php echo $cotizacion['total']; ?>" readonly/>
                        </div>
                </td>
        	<td class="font-weight-normal text-justify"><?php date_default_timezone_set("America/Mexico_City");
 echo date("Y-m-d, h:i:s a", $cotizacion['date']); ?></td>
        	<td align="center">
        		<div class=""><a class="btn btn-warning" href="<?php echo base_url('cotizaciones/edit/'.$cotizacion['quote_id']); ?>"><i class="fas fa-pen"></i></a></div>
        		<div class=""><a class="btn btn-danger" href="<?php echo base_url('cotizaciones/delete/'.$cotizacion['quote_id']); ?>"><i class="far fa-trash-alt"></i></a></div>
        	</td>
        </tr>
</tbody>
<?php endforeach; ?>
</table>
                <div>
                        <?php echo $pagination; ?>
                </div>
</div>