<h2><?php echo $title; ?> <a href="/clientes/"><button class="btn btn-primary">Ver Clientes</button></a> </h2>
<hr>
<script src="<?= base_url('assets/js/clientes_create.js') ?>"></script>
<?php echo validation_errors(); ?>


<?php echo form_open('clientes/create'); ?>



<form class="form-control"> 
    <div class="form-group row">
        <div class="col-5">
            <label for="name" class="col-form-label">Nombre completo:</label>
            <input type="input" name="name" id="name" placeholder="Nombre" autofocus required class="form-control form-control-sm"/>          
        </div>

        <div class="col-5">
            <label for="nombre_fiscal" class="col-form-label">Nombre fiscal:</label>
            <input class="form-control form-control-sm" name="fiscal_name" id="fiscal_name" placeholder="Nombre fiscal" required/>         
        </div>
        
    </div>

    <div class="form-group row">
        <div class="col-5">
        <label for="rfc" class="col-form-label">RFC:</label>
        <input class="form-control form-control-sm" name="rfc" id="rfc" required />
        </div>

        <div class="col-5">
            <label for="direccion" class="col-form-label">Colonia</label>
            <input class="form-control form-control-sm" name="col" id="col" placeholder="Colonia" required/>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-5">
            <label for="direccion" class="col-form-label">Calle</label>
            <input class="form-control form-control-sm" name="calle" id="calle" placeholder="Calle" required/>  
        </div>
        <div class="col-5">
            <label for="direccion" class="col-form-label">Código postal</label>
            <input class="form-control form-control-sm" name="cp" id="cp" placeholder="Código postal" required/>         
        </div>

    </div>

    <div class="form-group row">
        <div class="col-5">
            <label for="estado" class="col-form-label">Estado:</label>
            <select class="form-control form-control-sm" name="estado" id="estado">
                <option value="">Seleccione un estado</option>

           <?php 
            foreach ($estados as $estado) 
            {
                echo '<option value="'.$estado['estado_id'].'">'.$estado['name'].'</option>';
            }
            ?>
       
            </select>         
        </div>

        <div class="col-5">
            <label for="estado" class="col-form-label">Municipio:</label>
            <select class="form-control form-control-sm" name="municipio" id="municipio" required>
            
            </select>           
        </div>
    </div>

    <div class="form-group row">
        <div class="col-5">
            <label for="email" class="col-form-label">Email:</label>
            <input type="email" class="form-control form-control-sm" name="email" id="email" placeholder="Correo electrónico" required/>
        </div>

        <div class="col-5">
            <label for="contacto" class="col-form-label">Contacto</label>
            <input class="form-control form-control-sm" name="contact" id="contact" placeholder="Contacto" required/>         
        </div>

    </div>

    <div class="form-group row">

    </div>

    <div class="form-group row">
        <div class="col-5">
            <label for="tel" class="col-form-label">Telefono</label>
            <input class="form-control form-control-sm" name="tel" id="tel" placeholder="Teléfono" required/>
        </div>

        <div class="col-5">
            <label for="clientarea" class="col-form-label">Area del Cliente</label>
            <select name="clientarea[][area]" id="" multiple="multiple" class=" form-control form-control-sm" required>
                <option value="0">Selecciona una opción</option>
                <?php 

                    foreach ($clientarea as $area) {
                        echo '<option value="'.$area['term_id'].'">'.$area['term'].'</option>';
                    }

                ?>
            </select>              
        </div>
    </div>

 <div class="form-group row">
    
    <div class="col-5">
        <a class="btn btn-link" href="<?php echo base_url('clientes/'); ?>">Cancelar</a>
    </div>
    <div class="col">
        <input type="submit" name="submit" value="Guardar" class="btn btn-success" />
    </div>  

</div>   
 


   
</form>