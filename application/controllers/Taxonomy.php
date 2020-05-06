<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Taxonomy extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('taxonomy_model');
        $this->load->helper('url_helper');
    }

    public function index()
    {
        $this->load->helper(array('text'));
        
//Pagination
        $this->load->library('pagination');
        $this->config->load('pagination', TRUE);
        $config = $this->config->item('pagination');
        $config['base_url'] = base_url().'taxonomy/index';
        $page = $this->uri->segment(3, 0);
            
        $data['title'] = 'Listado de Taxonomías';
        $data['taxonomy'] = $this->taxonomy_model->getTaxonomyList($config['per_page'], $page);
        $config['total_rows'] = $this->taxonomy_model->getTotalRow();
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        
        $this->load->view('templates/header', $data);
        $this->load->view('taxonomy/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Crear nueva Taxonomía';

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');


        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('taxonomy/create');
            $this->load->view('templates/footer');
        }
        else
        {
            $this->taxonomy_model->set_taxonomy();
            $this->load->view('templates/header', $data);
            $this->load->view('taxonomy/success');
            $this->db->view('templates/footer');
        }
    }

    public function edit($tid)
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $data['title'] = 'Editar Taxonomía';

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');

        $data['tax'] = $this->taxonomy_model->getTaxonomyEdit($tid);

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('taxonomy/edit', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            $id = $this->input->post('tid');
            if($id)
            {
                $tid = $this->uri->segment(3);
                $tid = $id; 
            }
            
            $this->taxonomy_model->editTaxonomy($tid);
            $this->load->view('templates/header', $data);
            $this->load->view('taxonomy/successEdit');
            $this->load->view('templates/footer');
        }

    }

    public function delete($tid)
    {
        $this->load->helper(array('form', 'url'));

        $data['tax'] = $this->taxonomy_model->getTaxonomyDelete($tid);
            
        $this->load->view('templates/header', $data);
        $this->load->view('taxonomy/delete', $data);
        $this->load->view('templates/footer');     
        
        $id = $this->input->post('tid');
        if($id)
        {
            $tid = $this->uri->segment(3);
            $tid = $id; 
            $this->taxonomy_model->deleteTaxonomy($tid);
            redirect(base_url().'taxonomy/');
        }
    }


}


?>