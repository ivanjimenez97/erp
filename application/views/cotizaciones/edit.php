<script src="<?= base_url('assets/js/productos.js') ?>"></script>
<script src="<?= base_url('assets/js/cotizaciones.js') ?>"></script>
<div id="encabezado">
        <img src="<?php echo base_url('assets/img/membrete.jpg'); ?>" alt="">
        <h4><?php echo $title; ?></h4>
        <h4 id="titleprint"><?php echo $titleprint; ?></h4>
        <hr>
        
</div>
<div class="row" id="box">
    <div class="col-8" id="box2"></div>
    <div class="col-4" id="quotedetails">
        <label>Fecha: <?php date_default_timezone_set("America/Mexico_City");
 echo date("Y-m-d, h:i:s a", $cotizacion['date']); ?></label>
        <br>
        <label>Número de Folio: <?php echo $cotizacion['cotizacion_id']; ?></label>
        
        
    
    </div>
</div>

<?php echo validation_errors(); ?>
<?php if(isset($error)){print $error;}?>
<?php echo form_open_multipart('cotizaciones/edit'); ?>

    <div class="clientinf form-group row">
        <div class="subclientinf col-6" id="cajaclientes">
            <label for="client" class="">Cliente:</label>
            <select class="form-control form-control-sm" name="client" id="client">
                <option value="0">Selecciona un Cliente</option>
            
        <?php
        
            foreach ($clientes as $cliente)
            {
                if($cliente['client_id'] == $cotizacion['clientidquote'])
                {
                    echo '<option value="'.$cliente['client_id'].'" Selected>'.$cliente['name'].'</option>';
                }
                else
                {
                    echo '<option value="'.$cliente['client_id'].'">'.$cliente['name'].'</option>';
                }
            }

        ?>
        </select>
        </div>
        <div class="subclientinf col-3" id="cajaclientes2">
            <label for="foliocliente" class="">Folio-Cliente:</label>
            <input type="text" class="form-control form-control-sm" name="foliocliente" value="<?php echo $cotizacion['clientfolio']; ?>"/>
        </div>
        <div class="subclientinf col-3">
            <label for="area_cliente" class="">Area del Cliente:</label>
            <select class="form-control form-control-sm" name="area_cliente" id="area_cliente">
                <option value="">Cliente no seleccionado.</option>
                <?php 
                foreach ($clientarea as $area) {
                    if($area['taxterm_id'] == $cotizacion['areacliente'])
                    {
                        echo '<option value="'.$area['taxterm_id'].'" Selected>'.$area['term'].'</option>';
                    }
                    else
                    {
                     echo '<option value="'.$area['taxterm_id'].'">'.$area['term'].'</option>';
                    }
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
        
<br>         
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
<tbody class="">
    <?php 
    //aqui se le asigna un valor a esta variable para que posteriomente
    //se use en la columna de numero de partida
        $i=1;
    ?> 
<?php foreach ($productos as $product) : ?>

        <tr class="table-bordered">
            <td>
                <div class=""><a href="" class="deleteItemQuote btn btn-outline-danger" data-id-itemquote="<?php echo $product['itemq_id']; ?>" id="deleteItemQuote" data-toggle="modal" data-target="#DeleteProduct"><i class="fas fa-trash"></i></a></div>
            </td>
            <td>
                <?php 

                    echo $i++;

                 ?>
            </td>
            <td><img src="<?php echo base_url().'uploads/imagenes/'.$product['image']; ?>" class="img-fluid img-thumbnail"/></td>
            <td class="font-weight-normal text-justify"><?php echo $product['name']; ?>, DESCRIPCIÓN: <?php echo $product['description'] ?>, MARCA: <?php echo $product['nameb']; ?></td>

            <td class="font-weight-normal text-justify"><?php echo $product['term']; ?></td>
            <td class="preciob font-weight-normal text-justify" id="preciob"><div class="input-group mb-3 d-flex bd-highlight">
                    <div class="input-group-prepend">
                        <span class="input-group-text">$</span>
                    </div>
                    <input data-inputmask="'alias': 'currency'" type="text" class="listprice form-control" value="<?php echo $product['price']; ?>" readonly/></div>
            </td>
            

            <td>
                    <div class="input-group mb-3 d-flex bd-highlight">
                            <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                            </div>
                            <input data-inputmask="'alias': 'currency'" type="text" class="preciou form-control" data-producto-id="<?php echo $product['product_id']; ?>" id="preciou-<?php echo $product['product_id']; ?>" name="producto[<?php echo $product['product_id']; ?>][unit_price]" value="<?php echo $product['unit_price']; ?>" step="0.01" />

                    </div>

            </td>
            <td>   
                    <input type="number" class="quantity form-control" data-producto-id="<?php echo $product['product_id']; ?>" id="quantity-<?php echo $product['product_id']; ?>" name="producto[<?php echo $product['product_id']; ?>][quantity]" value="<?php echo $product['quantity']; ?>" min="1">
                    
            </td>
            
            <td >
                    <div class="input-group mb-3 d-flex bd-highlight">
                            <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                            </div>
                            <input data-inputmask="'alias': 'currency'" type="text" class="precioapagar form-control" data-producto-id="<?php echo $product['product_id']; ?>" id="precioapagar-<?php echo $product['product_id']; ?>" style="text-align: right;" name="producto[<?php echo $product['product_id']; ?>][pricetopay]" value="<?php echo $product['pricetopay']; ?>" step="0.01" readonly/>
                    </div>
                     
            </td>
        </tr>
        


<?php endforeach; ?>
<!--</tbody>-->
<!--<tfoot class="">-->
        <tr align="center" class="tfoot">    
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>&nbsp;</td>
                <td class="table-bordered">Subtotal:</td>
                <td class="table-bordered">
                        <div class="input-group mb-3 d-flex bd-highlight">
                                <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                                </div>
                                <input data-inputmask="'alias': 'currency'" type="text" class="subtotal form-control" id="subtotal" name="subtotal" style="text-align: right;" value="<?php echo $cotizacion['subtotal']; ?>" step="0.01" readonly />
                        </div>
                </td>
        </tr>
        <tr align="center" class="tfoot">    
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
                                <input data-inputmask="'alias': 'currency'" type="text" class="iva form-control" id="iva" name="iva" style="text-align: right;" value="<?php echo $cotizacion['iva']; ?>" step="0.01" readonly />
                        </div>
                </td>
        </tr>
        <tr align="center" class="tfoot">    
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
                                <input data-inputmask="'alias': 'currency'" type="text" class="total form-control" id="total" name="total" style="text-align: right;" value="<?php echo $cotizacion['total']; ?>" step="0.01" readonly />
                        </div>
                </td>
        </tr>

</tbody>


</table>
  <?php //echo $aviso; ?>
  <label for="" id="firmaencargado"><?php echo $firmaencargado; ?></label>


<div class="description form-group row">       
    <div class="col-7">
            <label for="description" class="">Descripción:</label>
            <textarea name="description" class="form-control form-control-sm" id="description" style="width: 100%;" rows="7"><?php echo $cotizacion['description']; ?></textarea>
    </div>
</div>


<!-- Modal Clean List-->
<div class="botones form-group row justify-content-center">
        <input type="hidden" name="cid" id="cid" value="<?php echo $cotizacion['cotizacion_id']; ?>" />
        <div class="col-3">
                <a class="btn btn-link" href="<?php echo base_url('cotizaciones/'); ?>">Cancelar</a>
        </div>

        <div class="col-3">
                <input type="submit" name="editar" id="editar" class="btn btn-success" value="Editar" />
        </div>    
        <div class="col-3">
                <a href="#" name="imprimir" class="btn btn-outline-primary" onclick="window.print();">Imprimir</a>
        </div>    
</div>
</div>
</form>
<!-- Modal to Delete a Product from Cart Saved-->
<div class="modal fade" id="DeleteProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        <a class="confirmDeleteProduct col btn btn-danger" href="">Si</a>
      </div>
    </div>
  </div>
</div>