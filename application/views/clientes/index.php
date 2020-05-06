<div>
        <h2><?php echo $title; ?>  </h2>
        <hr>
        <div class="text-center">
        
        <a class="btn btn-success" href="<?php echo base_url('clientes/create'); ?>"><i class="fas fa-plus"></i> Nuevo Cliente</a>
        </div>
</div>
        <div> 
        <?php echo $pagination; ?> 
        </div>

<hr>
<div class="table-responsive-sm"  id="ClientesList">
<table class="table table-sm table-hover table-bordered mw-100">
        <thead class="thead-dark">
                <tr>
                        <th>Empresa</th>
                        <th>Email</th>
                        <th>Localidad</th>
                        <th>Contacto</th>
                        <th>Teléfono</th>
                        <th>Acción</th>
                </tr>   
        </thead>

        <?php foreach ($clientes as $cliente): ?>
        <tbody>
                
                <tr>
                        <td> <?php echo $cliente['cliente']; ?></td>
                        <td> <?php echo $cliente['email']; ?></td>
                        <td> <?php echo $cliente['municipio'].','.$cliente['estado']; ?></td>
                        <td> <?php echo $cliente['contact']; ?></td>
                        <td> <?php echo $cliente['tel']; ?></td>
                        
                        <td>
                            <div class=""><a class="btn btn-warning" href="<?php echo base_url('clientes/edit/'.$cliente['client_id']); ?>"><i class="fas fa-pen"></i></a></div>
                            <div class=""></div><a class="btn btn-danger" href="<?php echo base_url('clientes/delete/'.$cliente['client_id']); ?>"><i class="fas fa-trash"></i></a></div>
                        </td>
                </tr>
                <?php endforeach; ?>
        </tbody>
</table>
        
        <div> 
        <?php echo $pagination; ?> 
        </div>
</div>

      

