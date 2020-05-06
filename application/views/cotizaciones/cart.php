<script src="<?= base_url('assets/js/productos.js') ?>"></script>
<script src="<?= base_url('assets/js/cotizaciones.js') ?>"></script>
<div>
        <h4><?php echo $title; ?></h4>
        <hr>
        
</div>
<?php echo validation_errors(); ?>
<?php if(isset($error)){print $error;}?>
<?php echo form_open_multipart('cotizaciones/cart'); ?>
    <div class="form-group row">
        <div class="col-5">
            <label for="client" class="col-form-label">Cliente:</label>
            <select class="form-control form-control-sm" name="client" id="client">
                <option value="0">Selecciona un Cliente</option>
            
        <?php
        
            foreach ($clientes as $cliente)
            {
                echo '<option value="'.$cliente['client_id'].'">'.$cliente['name'].'</option>';
            }

        ?>
        </select>
        </div>
        <div class="col-3">
            <label for="foliocliente" class="col-form-label">Folio-Cliente:</label>
            <input type="text" class="form-control form-control-sm" name="foliocliente" value=""/>
        </div>
        <div class="col-4">
            <label for="area_cliente" class="col-form-label">Area del Cliente:</label>
            <select class="form-control form-control-sm" name="area_cliente" id="area_cliente">
                <option value="">Cliente no seleccionado.</option>
                               <option value="">Cliente no seleccionado.</option>
                <?php 
                foreach ($clientarea as $area) {
                     echo '<option value="'.$area['taxterm_id'].'">'.$area['term'].'</option>';
                }
                    

                 ?>
            </select>
        </div>
    </div>
<div id="result">
        
    <!--Aqui se van a cargar los labels e inputs que que serviran
        para desplegar informacion acerca del cliente cuando el
        usuario seleccione un cliente en el select.-->



</div>

<!--<div id="notice">
    Aqui se mostrara un aviso en caso de que el cliente no tenga area.
</div>-->




<div class="table-responsive-sm">
<table class="cotizacionesList table table-sm table-hover mw-100">
<thead class="thead-dark table-bordered">	
	<tr>
        <th>Ops</th>
        <th># de Partida</th>		
		<th>Imagen</th>
        <th>Nombre</th>
		<th>Categoria</th>		
		<th>Precio lista</th>
        <th>Precio unitario</th>
		<th>Cantidad</th>
        <th>Total</th>     
	</tr>
</thead>


<tbody class="table-bordered">
    <?php 
        $i=1;
    ?>
    <?php foreach ($productos as $product) : ?>
        
        <tr>

            <td>
                <div class=""><a href="" class="productselected btn btn-outline-danger" data-toggle="modal" data-target="#deleteAProduct" data-id-producto="<?php echo $product['product_id']; ?>" id="productselected"><i class="fas fa-trash"></i></a></div>
            </td>

            

            <td>
                <?php 

                    echo $i++;

                 ?>
            </td>
                
            <td><img src="<?php echo base_url().'uploads/imagenes/'.$product['image']; ?>" class="img-fluid img-thumbnail"/></td>
            <td class="font-weight-normal text-justify"><?php echo $product['name']; ?>, DESCRIPCIÓN: <?php echo $product['description'] ?>, MARCA: <?php echo $product['nameb']; ?></td>

            <td class="font-weight-normal text-justify"><?php echo $product['term']; ?></td>
            
            <td class="preciob font-weight-normal text-justify" id="preciob">
                <div class="input-group mb-3 d-flex bd-highlight">
                    <div class="input-group-prepend">
                        <span class="input-group-text">$</span>
                    </div>
                    <input data-inputmask="'alias': 'currency'" type="text" class="listprice form-control" value="<?php echo $product['price']; ?>" readonly/>
                            
                </div>
            </td>
            <?php $preciou = $product['price']; ?>

            <td>
                    <div class="input-group mb-3 d-flex bd-highlight">
                            <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                            </div>
                            <input data-inputmask="'alias': 'currency'" type="text" class="preciou form-control" data-producto-id="<?php echo $product['product_id']; ?>" id="preciou-<?php echo $product['product_id']; ?>" name="producto[<?php echo $product['product_id']; ?>][unit_price]" value="<?php echo $preciou; ?>" step="0.01" min="1.00"/>

                    </div>

            </td>
            <td>   
                    <input type="number" class="quantity form-control" data-producto-id="<?php echo $product['product_id']; ?>" id="quantity-<?php echo $product['product_id']; ?>" name="producto[<?php echo $product['product_id']; ?>][quantity]" value="1" min="1">
                    
            </td>
            <?php $precioapagar = $preciou?>
            <td >
                    <div class="input-group mb-3 d-flex bd-highlight">
                            <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                            </div>
                            <input data-inputmask="'alias': 'currency'" type="text" class="precioapagar form-control" data-producto-id="<?php echo $product['product_id']; ?>" id="precioapagar-<?php echo $product['product_id']; ?>" style="text-align: right;" name="producto[<?php echo $product['product_id']; ?>][pricetopay]" value="<?php echo $precioapagar;?>" step="0.01" readonly/>
                    </div>
                     
            </td>

        </tr>
        
<?php endforeach; ?>
</tbody>



        <tr align="right">    
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="table-bordered">Subtotal:</td>
                <td class="table-bordered">
                        <div class="input-group mb-3 d-flex bd-highlight">
                                <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                                </div>
                                <input data-inputmask="'alias': 'currency'" type="text" class="subtotal form-control" id="subtotal" name="subtotal" style="text-align: right;" step="0.01" readonly>
                        </div>
                </td>
        </tr>
        <tr align="right">    
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td></td>
                <td class="table-bordered">Iva:</td>
                <td class="table-bordered">
                        <div class="input-group mb-3 d-flex bd-highlight">
                                <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                                </div>
                                <input data-inputmask="'alias': 'currency'" type="text" class="iva form-control" id="iva" name="iva" style="text-align: right;" step="0.01" readonly>
                        </div>
                </td>
        </tr>
        <tr align="right">    
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td></td>
                <td class="table-bordered">Total:</td>
                <td class="table-bordered">
                        <div class="input-group mb-3 d-flex bd-highlight">
                                <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                                </div>       
                                <input data-inputmask="'alias': 'currency'" type="text" class="total form-control" id="total" name="total" style="text-align: right;" step="0.01" readonly>
                        </div>
                </td>
        </tr>

<?php echo $aviso; ?>

</table>


<div class="form-group row">
    <div class="col-7">
            <label for="description" class="col-form-label">Descripción:</label>
            <textarea name="description" class="form-control" id="description" style="width: 100%; height: 100px;">Tiempo de entrega:
Vigencia:
Comentarios:</textarea>
    </div>
</div>

<div class="form-group row justify-content-center">
        <div class="col-2">
                <a class="btn btn-link" href="<?php echo base_url('cotizaciones/index'); ?>">Listado de Cot.</a>
        </div>
        <div class="col-sm-2">
                <a class="btn btn-outline-danger" href="" id="cleanCart" data-toggle="modal" data-target="#ModalDelete">Limpiar</a>
        </div>
        <div class="col-sm-2">
                <input type="submit" name="guardar" id="guardar" class="btn btn-success" value="Guardar" />
        </div>    
  
</div>
</div>
</form>
<!-- Modal Clean List-->
<div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" align="center">Atención!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ¿Esta seguro que desea limpiar esta cotización?
      </div>
      <div class="modal-footer">
        <button type="button" class="col btn btn-secondary" data-dismiss="modal">No</button>
        <div class="col-sm-3"></div>
        <a class="col btn btn-danger" href="<?php echo base_url('cotizaciones/cleanCart'); ?>">Si</a>
      </div>
    </div>
  </div>
</div>

<!--Modal Delete a product-->
<div class="modal fade" id="deleteAProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" align="center">Atención!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ¿Esta seguro que desea eliminar este producto de la cotización?
      </div>
      <div class="modal-footer">
        <button type="button" class="col btn btn-secondary" data-dismiss="modal">No</button>
        <div class="col-sm-3"></div>
        <a class="deleteProduct col btn btn-danger" href="" id="deleteProduct">Si</a>
      </div>
    </div>
  </div>
</div>