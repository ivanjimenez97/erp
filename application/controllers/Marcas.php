<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marcas extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('marcas_model');
        $this->load->helper('url_helper');
    }

    public function index()
    {
        $this->load->helper(array('text'));
        
        //pagination
        $this->load->library('pagination');
        $this->config->load('pagination', TRUE);
        $config = $this->config->item('pagination');
        $config['base_url'] = base_url().'marcas/index';
        $page = $this->uri->segment(3, 0);

        $data['title'] = 'Marcas';
        $data['marcas'] = $this->marcas_model->getBrandsList($config['per_page'], $page);
        $config['total_rows'] = $this->marcas_model->getTotalRow();
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('templates/header', $data);
        $this->load->view('marcas/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        
        $data['title'] = 'Agregar nueva Marca';
        
        $this->form_validation->set_rules('name', 'Name', 'required');


            if ($this->form_validation->run() === FALSE)
            {
                $this->load->view('templates/header', $data);
                $this->load->view('marcas/create');
                $this->load->view('templates/footer');

            }
            else
            {
                $this->marcas_model->set_brands();
                $this->load->view('templates/header');
                $this->load->view('marcas/success');
            }
    }

    public function edit($brand_id)
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $data['title'] = 'Editar Taxonomía';

        $this->form_validation->set_rules('name', 'Name', 'required');

        $data['marca'] = $this->marcas_model->getBrandEdit($brand_id);

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('marcas/edit', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            $id = $this->input->post('brand_id');
            if($id)
            {
                $brand_id = $this->uri->segment(3);
                $brand_id = $id; 
            }
            
            $this->marcas_model->editBrand($brand_id);
            $this->load->view('templates/header', $data);
            $this->load->view('marcas/successEdit');
        }

    }

    public function delete($brand_id)
    {
        $this->load->helper(array('form', 'url'));

        $data['marca'] = $this->marcas_model->getBrandDelete($brand_id);
            
        $this->load->view('templates/header', $data);
        $this->load->view('marcas/delete', $data);
        $this->load->view('templates/footer');     
        
        $id = $this->input->post('brand_id');
        if($id)
        {
            $brand_id = $this->uri->segment(3);
            $brand_id = $id; 
            $this->marcas_model->deleteBrand($brand_id);
            redirect(base_url().'marcas/');
        }
    }



}


?>