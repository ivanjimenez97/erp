<div>
        <h3><?php echo $title; ?></h3>
                <div class="text-center">
                <a class="btn btn-success" href="<?php echo site_url('marcas/create'); ?>"><i class="fas fa-plus"></i> Nueva Marca</a>
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
		<th>Opciones</th>
	</tr>
</thead>
<?php foreach ($marcas as $marca): ?>
<tbody>
        <tr>
            <th class="font-weight-normal text-justify"><?php echo $marca['name']; ?></th>
        	<th>
        		<div class=""><a class="btn btn-warning" href="<?php echo base_url('marcas/edit/'.$marca['brand_id']); ?>"><i class="fas fa-pen"></i></a></div>
        		<div class=""><a class="btn btn-danger" href="<?php echo base_url('marcas/delete/'.$marca['brand_id']); ?>"><i class="far fa-trash-alt"></i></a></div>
        	</th>
        </tr>
</tbody>
<?php endforeach; ?>
</table>
                <div>
                        <?php echo $pagination; ?>
                </div>
</div>