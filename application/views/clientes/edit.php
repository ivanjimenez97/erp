<h2><?php echo $title; ?> <a href="/clientes/"><button class="btn btn-primary">Ver Clientes</button></a> </h2>
<hr>
<script src="<?= base_url('assets/js/clientes_create.js') ?>"></script>
<?php echo validation_errors(); ?>

<?php echo form_open('clientes/edit'); ?>



<form class="form-control">
    
<div class="form-group row">
        <div class="col-5">
            <label for="name" class="col-form-label">Nombre completo:</label>
            <input type="input" name="name" id="name" placeholder="Nombre" autofocus required class="form-control form-control-sm" value="<?php echo $cliente['cliente'];?>"/>          
        </div>

        <div class="col-5">
            <label for="nombre_fiscal" class="col-form-label">Nombre fiscal:</label>
            <input class="form-control form-control-sm" name="fiscal_name" id="fiscal_name" placeholder="Nombre fiscal" required value="<?php echo $cliente['fiscal_name'];?>"/>         
        </div>
        
    </div>

    <div class="form-group row">
        <div class="col-5">
        <label for="rfc" class="col-form-label">RFC:</label>
        <input class="form-control form-control-sm" name="rfc" id="rfc" required value="<?php echo $cliente['rfc'];?>"/>
        </div>

        <div class="col-5">
            <label for="direccion" class="col-form-label">Colonia</label>
            <input class="form-control form-control-sm" name="col" id="col" placeholder="Colonia" required value="<?php echo $cliente['col'];?>"/>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-5">
            <label for="direccion" class="col-form-label">Calle</label>
            <input class="form-control form-control-sm" name="calle" id="calle" placeholder="Calle" required value="<?php echo $cliente['calle'];?>"/>  
        </div>
        <div class="col-5">
            <label for="direccion" class="col-form-label">Código postal</label>
            <input class="form-control form-control-sm" name="cp" id="cp" placeholder="Código postal" required value="<?php echo $cliente['cp'];?>"/>         
        </div>

    </div>

    <div class="form-group row">
        <div class="col-5">
            <label for="estado" class="col-form-label">Estado:</label>
            <select class="form-control form-control-sm" name="estado" id="estado" required>
                <option value="0">Seleccione un estado</option>

            <?php 
            foreach ($estados as $estado) 
            {
                if ($estado['estado_id'] == $cliente['e_id']) {
                    echo '<option value="'.$estado['estado_id'].'" Selected>'.$estado['name'].'</option>';
                }
                else
                {
                echo '<option value="'.$estado['estado_id'].'">'.$estado['name'].'</option>';
                }
            }
            ?>       
            </select>         
        </div>

        <div class="col-5">
            <label for="municipio" class="col-form-label">Municipio:</label>
            <select class="form-control form-control-sm" name="municipio" id="municipio" required>
            <?php 
            //echo '<option value="'.$cliente['municipio_id'].'" Selected>'.$cliente['municipio'].'</option>';
            foreach ($municipio as $mun)
            {
                if ($mun['municipio_id'] == $cliente['m_id']) {
                echo '<option value="'.$mun['municipio_id'].'" Selected>'.$mun['name'].'</option>';
                }
                else
                {
                echo '<option value="'.$mun['municipio_id'].'">'.$mun['name'].'</option>';
                }
            }
   
            ?>            
            </select>           
        </div>
    </div>

    <div class="form-group row">
        <div class="col-5">
            <label for="email" class="col-form-label">Email:</label>
            <input type="email" class="form-control form-control-sm" name="email" id="email" placeholder="Correo electrónico" required value="<?php echo $cliente['email'];?>"/>
        </div>

        <div class="col-5">
            <label for="contacto" class="col-form-label">Contacto</label>
            <input class="form-control form-control-sm" name="contact" id="contact" placeholder="Contacto" required value="<?php echo $cliente['contact'];?>"/>         
        </div>

    </div>

    <div class="form-group row">
        <div class="col-5">
            <label for="tel" class="col-form-label">Telefono</label>
            <input class="form-control form-control-sm" name="tel" id="tel" placeholder="Teléfono" required value="<?php echo $cliente['tel'];?>"/>
        </div>

        <div class="col-5">
            <label for="clientarea" class="col-form-label">Area del Cliente</label>
            <select name="clientarea[][area]" multiple="multiple" class=" form-control form-control-sm" required>
                <option value="0">Selecciona una opción</option>
                <?php 

                foreach ($clientarea as $area) {
                    if (array_key_exists($area['term_id'], $areasaved)) 
                    {
                        echo '<option value="'.$area['term_id'].'" Selected>'.$area['term'].'</option>';
                    }
                        echo '<option value="'.$area['term_id'].'">'.$area['term'].'</option>';
                    }    

                ?>
            </select>              
        </div>
    </div>
  <div class="form-group row"> 
        <input type="hidden" name="client_id" id="client_id" value="<?php echo $cliente['client_id']; ?>">
        <input type="hidden" name="address_id" id="address_id" value="<?php echo $cliente['address_id']; ?>">
        
        <div class="col-5">
            <a class="btn btn-link" href="<?php echo base_url('clientes/'); ?>">Cancelar</a>
        </div>
        <div class="col">
            <input type="submit" name="submit" value="Editar" class="btn btn-success" />
        </div>
        
    </div>
 
</form>




