<?php


class Municipios extends CI_controller {

   

    public function getMunicipios() {

        $estado_id = $this->input->post('estado_id');


        echo $this->clientes_model->fetch_municipios($estado_id);

    }

}


?>