<?php


class Municipios extends CI_controller {

    public function __construct()
    {
            parent::__construct();
            $this->load->model('clientes_model');
            $this->load->helper('url_helper');
    }

    // public function __construct() {
    //     parent::__construct();
    // }

    public function getMunicipios() {

        $estado_id = $this->input->post('estado_id');


        echo $this->clientes_model->fetch_municipios($estado_id);

    }

}


?>