<script src="<?= base_url('assets/js/productos.js') ?>"></script>
<div>
        <h4><?php echo $title; ?></h4>
        <hr>
                <div class="text-center">
                <a class="btn btn-success" href="<?php echo base_url('productos/create'); ?>"><i class="fas fa-plus"></i> Nuevo Producto</a>
                </div>
                <div>
                        <?php echo $pagination; ?>
                </div>
</div>
<hr>

<div class="table-responsive-sm"  id="productList">
<table class="table table-sm table-hover table-bordered mw-100">
<thead class="thead-dark">	
	<tr>		
		<th>Imagen</th>
                <th>Nombre</th>
		<th>Descripción</th>
		<th>Categoria</th>		
		<th>Marca</th>
		<th>Precio</th>
		<th>Opciones</th>
	</tr>
</thead>
<?php foreach ($productos as $product) : ?>
<tbody>
        <tr>
        	<th><img src="<?php echo base_url().'uploads/imagenes/'.$product['image']; ?>" class="img-fluid img-thumbnail"/></th>
                <th class="font-weight-normal text-justify"><?php echo $product['name']; ?></th>

        	<th class="md font-weight-normal text-justify"><?php echo word_limiter($product['description'], 20); ?></th>
        	<th class="font-weight-normal text-justify"><?php echo $product['term']; ?></th>
        	<th class="font-weight-normal text-justify"><?php echo $product['nameb']; ?></th>
        	<th class="font-weight-normal text-justify">$<?php echo $product['price']; ?></th>
        	<th>
        		<div class="">
                                <a class="btn btn-warning" href="<?php echo base_url('productos/edit/'.$product['product_id']); ?>">
                                        <i class="fas fa-pen"></i>
                                </a>
                        </div>
        		<div class="">
                                <a class="btn btn-danger" href="<?php echo base_url('productos/delete/'.$product['product_id']); ?>">
                                        <i class="far fa-trash-alt"></i>
                                </a>
                        </div>
                        <div class="">
                                <button class="addToCart btn btn-primary" data-id-producto="<?php echo $product['product_id']; ?>">
                                        <i class="fas fa-cart-plus"></i>
                                </button>
                        </div>
        	</th>
        </tr>
</tbody>
<?php endforeach; ?>
</table>
                <div>
                        <?php echo $pagination; ?>
                </div>
</div>