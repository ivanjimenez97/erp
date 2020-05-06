<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unidades extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('unidades_model');
        $this->load->helper('url_helper');
    }

    public function index()
    {
        $this->load->helper(array('text'));
        
        //pagination
        $this->load->library('pagination');
        $this->config->load('pagination', TRUE);
        $config = $this->config->item('pagination');
        $config['base_url'] = base_url().'unidades/index';
        $page = $this->uri->segment(3, 0);        
        
        //$data['page_title'] = 'Unidades';
        $data['title'] = 'Listado de Unidades';
        $data['unidades'] = $this->unidades_model->getUnitsList($config['per_page'], $page);
        $config['total_rows'] = $this->unidades_model->getTotalRow();
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('templates/header', $data);
        $this->load->view('unidades/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Agregar una nueva Unidad';

        $this->form_validation->set_rules('name', 'Name', 'required');


        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('unidades/create');
            $this->load->view('templates/footer');
        }
        else
        {
            $this->unidades_model->set_units();
             $this->load->view('templates/header');
            $this->load->view('unidades/success');
        }
    }
    
    public function edit($unit_id)
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $data['title'] = 'Editar Unidad';

        $this->form_validation->set_rules('name', 'Name', 'required');


        $data['unidad'] = $this->unidades_model->getUnitEdit($unit_id);

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('unidades/edit', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            $id = $this->input->post('unit_id');
            if($id)
            {
                $unit_id = $this->uri->segment(3);
                $unit_id = $id; 
            }
            
            $this->unidades_model->editUnit($unit_id);
            $this->load->view('templates/header', $data);
            $this->load->view('unidades/successEdit');
        }

    }

    public function delete($unit_id)
    {
        $this->load->helper(array('form', 'url'));

        $data['unidad'] = $this->unidades_model->getUnitDelete($unit_id);
            
        $this->load->view('templates/header', $data);
        $this->load->view('Unidades/delete', $data);
        $this->load->view('templates/footer');     
        
        $id = $this->input->post('unit_id');
        if($id)
        {
            $unit_id = $this->uri->segment(3);
            $unit_id = $id; 
            $this->unidades_model->deleteUnit($unit_id);
            redirect(base_url().'unidades/');
        }
    }

}


?>
