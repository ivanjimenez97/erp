<div>
        <h4><?php echo $title; ?></h4>
        <hr>
                <div class="text-center">
                <a class="btn btn-success" href="<?php echo base_url('taxonomy/create'); ?>"><i class="fas fa-plus"></i> Nueva Taxonomía</a>
                </div>
                <div>
                        <?php echo $pagination; ?>
                </div>
</div>
<hr>

<div class="table-responsive-sm">
<table class="table-taxonomy table table-sm table-hover table-bordered mw-100">
<thead class="thead-dark">	
	<tr>
                <th>Nombre</th>
		<th>Descripción</th>
		<th>Opciones</th>
	</tr>
</thead>
<?php foreach ($taxonomy as $tax): ?>
<tbody>
        <tr>
                <th class="font-weight-normal text-justify"><?php echo $tax['name']; ?></th>
        	<th class="font-weight-normal text-justify"><?php echo word_limiter($tax['description'], 20); ?></th>
        	<th>
        		<div class=""><a class="btn btn-warning" href="<?php echo base_url('taxonomy/edit/'.$tax['tid']); ?>"><i class="fas fa-pen"></i></a></div>
        		<div class=""><a class="btn btn-danger" href="<?php echo base_url('taxonomy/delete/'.$tax['tid']); ?>"><i class="far fa-trash-alt"></i></a></div>
        	</th>
        </tr>
</tbody>
<?php endforeach; ?>
</table>
                <div>
                        <?php echo $pagination; ?>
                </div>
</div>