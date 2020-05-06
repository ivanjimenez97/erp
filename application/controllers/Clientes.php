<?php



class Clientes extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('clientes_model');
                $this->load->helper('url_helper');
        }

        public function index()
        {
            $this->load->helper(array('text'));
            $this->load->library('pagination'); 
            
            $this->config->load('pagination', TRUE);
            $config = $this->config->item('pagination');
            $config['base_url'] = base_url().'clientes/index';
    
            $page = $this->uri->segment(3, 0);

            $data['title'] = 'Clientes';
            $data['clientes'] = $this->clientes_model->getClientsList($config['per_page'], $page);
            $config['total_rows'] = $this->clientes_model->getTotalRow();
            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();
                        
            $this->load->view('templates/header', $data);
            $this->load->view('clientes/index', $data);
            $this->load->view('templates/footer');
        }
 
        public function view($client_id = NULL)
        {
                $data['cliente'] = $this->clientes_model->get_clients($client_id);


                if (empty($data['cliente']))
                {
                        show_404();
                }

                $data['name'] = $data['cliente']['name'];

                $this->load->view('templates/header', $data);
                $this->load->view('clientes/view', $data);
                $this->load->view('templates/footer');
        }

        public function create()
        {

            //Obteniendo data del modelo para pasarlo a la vista
            $data['estados'] = $this->clientes_model->fetch_estados();

        
            $this->load->helper('form');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('name', 'Name', 'required');
            $data['title'] = 'Crear Cliente';

           $data['clientarea'] = $this->clientes_model->getAreas();
        
            if ($this->form_validation->run() === FALSE)
            {
                  
                $this->load->view('templates/header', $data);
                $this->load->view('clientes/create', $data);
                $this->load->view('templates/footer');

            }
            else
            {
                
                $this->clientes_model->setClients();
                $this->load->view('templates/header');
                $this->load->view('clientes/success');
                $this->load->view('templates/footer');
            }

            
           
        }


        //Funcion para eliminar un client
        public function delete($client_id){

                $this->load->helper(array('form', 'url'));
                $data['cliente'] =  $this->clientes_model->get_clients($client_id);

                $this->load->view('templates/header', $data);
                $this->load->view('clientes/delete', $data);
                $this->load->view('templates/footer');

                $id = $this->input->post('client_id');

                if($id) {
                        $client_id = $this->uri->segment(3);
                        $client_id = $id;
                        $this->clientes_model->deleteClient($client_id);
                        redirect(base_url().'clientes/index');
                }

        }

        public function edit($client_id)
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $data['title'] = 'Editar Cliente';
        

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('fiscal_name', 'Fiscal_name', 'required');
        $this->form_validation->set_rules('rfc', 'Rfc', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('contact', 'Contact', 'required');
        $this->form_validation->set_rules('tel', 'Tel', 'required');
        $this->form_validation->set_rules('col', 'Col', 'required');
        $this->form_validation->set_rules('calle', 'Calle', 'required');
        $this->form_validation->set_rules('cp', 'Cp', 'required');
        //$this->form_validation->set_rules('municipio_id', 'Municipio_id', 'required');
        



        $data['cliente'] = $this->clientes_model->getClientEdit($client_id);
        $data['estados'] = $this->clientes_model->fetch_estados();
        $data['address'] = $this->clientes_model->getAdressEdit();
        $data['municipio'] = $this->clientes_model->getMunicipios();
        $data['clientarea'] = $this->clientes_model->getAreas();
        $data['areasaved'] = $this->clientes_model->getAreasEdit($client_id);
        
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('clientes/edit', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            $id = $this->input->post('client_id');
            $aid = $this->input->post('address_id');
            if($id)
            {
                $client_id = $this->uri->segment(3);
                $client_id = $id;
                $address_id= $aid;
            }
            
            $this->clientes_model->editClient($client_id,$address_id);
            $this->load->view('templates/header', $data);
            $this->load->view('clientes/successEdit');
            $this->load->view('templates/footer');
        }

    }

    function getMunicipiosPorEstado()
    {
        //opcion 1
        if($this->input->post('estado'))
        {
            echo $this->clientes_model->getMunicipiosSelect($this->input->post('estado'));
        }
    }    
      

}


?>