<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Taxonomyterms extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('taxonomy_model','taxonomyterms_model'));
        $this->load->helper('url_helper');
    }

    public function index()
    {
        $this->load->helper(array('text'));


        //pagination
        $this->load->library('pagination');
        $this->config->load('pagination', TRUE);
        $config = $this->config->item('pagination');
        $config['base_url'] = base_url().'taxonomyterms/index';
        $page = $this->uri->segment(3, 0);

        $data['title'] = 'Listado de Términos de Taxonomía';
        $data['taxonomyterms'] = $this->taxonomyterms_model->getTaxonomytermsList($config['per_page'], $page);
        $config['total_rows'] = $this->taxonomyterms_model->getTotalRow();
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        

        $this->load->view('templates/header', $data);
        $this->load->view('taxonomyterms/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Crear Nuevo Término';

        $this->form_validation->set_rules('term', 'Term', 'required');
        $this->form_validation->set_rules('tid', 'Tid', 'required');
        $this->form_validation->set_rules('parent', 'Parent', 'required');
        //consulta de taxonomy
        $data['tax'] = $this->taxonomy_model->get_tax();

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('taxonomyterms/create', $data);
            $this->load->view('templates/footer');

        }
        else
        {
            $this->taxonomyterms_model->set_taxonomyterms();
            $this->load->view('templates/header', $data);
            $this->load->view('taxonomyterms/success');
            $this->load->view('templates/footer');
        }
    }

    function getAllTaxtermbyparent()
    {
            //opcion 1
        if($this->input->post('tid'))
        {
            echo $this->taxonomyterms_model->get_all_taxtermquery($this->input->post('tid'));
        }
            
    }

    public function edit($term_id)
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $data['title'] = 'Editar Término';

        $this->form_validation->set_rules('term', 'Term', 'required');
        $this->form_validation->set_rules('tid', 'Tid', 'required');
        $this->form_validation->set_rules('parent', 'Parent', 'required');

        $data['taxterm'] = $this->taxonomyterms_model->getTaxonomytermEdit($term_id);
        //var_dump($data['taxterm']);
        $data['tax'] = $this->taxonomyterms_model->getTaxonomyEdit();

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('taxonomyterms/edit', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            $id = $this->input->post('term_id');
            if($id)
            {
                $term_id = $this->uri->segment(3);
                $term_id = $id; 
            }
            
            $this->taxonomyterms_model->editTaxonomyterm($term_id);
            $this->load->view('templates/header', $data);
            $this->load->view('taxonomyterms/successEdit');
            $this->load->view('templates/footer');
        }

    }

    public function delete($term_id)
    {
        $this->load->helper(array('form', 'url'));
        $data['taxterm'] = $this->taxonomyterms_model->getTaxtermDelete($term_id);
            
        $this->load->view('templates/header', $data);
        $this->load->view('taxonomyterms/delete', $data);
        $this->load->view('templates/footer');

        $id = $this->input->post('term_id');       
        
        if ($id) 
        {
            $term_id = $this->uri->segment(3);
            $term_id = $id;
            $this->taxonomyterms_model->deleteTaxterm($term_id);
            redirect(base_url().'taxonomyterms/index');
        }
    }

}


?>