<div>
    <h3><?php echo $title; ?></h3>
    <hr>
        <div class="text-center">
            <a class="btn btn-success" href="<?php echo site_url('taxonomyterms/create'); ?>"><i class="fas fa-plus"></i> Nuevo Término</a>
        </div>
    <div>
        <?php echo $pagination; ?>
    </div>
</div>
<hr>

<div class="table-responsive-sm">
<table class="table table table-sm table-hover table-bordered mw-100">
<thead class="thead-dark">	
	<tr>
        <th>Term</th>
		<th>Taxonomía</th>
		<th>Opciones</th>
	</tr>
</thead>
<?php foreach ($taxonomyterms as $taxterm) : ?>
<tbody>
    <tr>
    	<th class="font-weight-normal text-justify"><?php echo $taxterm['term']; ?></th>
        <th class="font-weight-normal text-justify"><?php echo $taxterm['name']; ?></th>
        <th>
        	<div class=""><a class="btn btn-warning" href="<?php echo base_url('taxonomyterms/edit/'.$taxterm['term_id']); ?>"><i class="fas fa-pen"></i></a></div>
        	<div class=""><a class="btn btn-danger" href="<?php echo base_url('taxonomyterms/delete/'.$taxterm['term_id']); ?>"><i class="far fa-trash-alt"></i></a></div>
       	</th>
    </tr>
</tbody>

<?php endforeach; ?>
</table>
    <div>
        <?php echo $pagination; ?>
    </div>
</div>