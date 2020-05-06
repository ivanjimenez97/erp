<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('productos_model','taxonomy_model','taxonomyterms_model', 'unidades_model', 'marcas_model'));
        $this->load->helper('url_helper');
    }

    public function index()
    {
        $this->load->helper(array('text'));
        $this->load->library('pagination');        

        $this->config->load('pagination', TRUE);
        $config = $this->config->item('pagination');
        $config['base_url'] = base_url().'productos/index';

        $page = $this->uri->segment(3, 0);
        
        $data['title'] = 'Listado de Productos';
        $data['productos'] = $this->productos_model->getProductsList($config['per_page'], $page);
        $config['total_rows'] = $this->productos_model->getTotalRow();
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        

        $this->load->view('templates/header', $data);
        $this->load->view('productos/index', $data);
        $this->load->view('templates/footer');
    }

    /*public function view($product_id = NULL)
    {
        $data['product'] = $this->productos_model->get_products($product_id);

        if (empty($data['product']))
        {
            show_404();
        }

        $data['name'] = $data['product']['name'];

        $this->load->view('templates/header', $data);
        $this->load->view('productos/view', $data);
        $this->load->view('templates/footer');
    }*/

    public function create()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $data['title'] = 'Agregar un producto nuevo';



        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('term', 'Term', 'required');
        $this->form_validation->set_rules('unit', 'Unit', 'required');
        $this->form_validation->set_rules('brand', 'Brand', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');
        //$this->form_validation->set_rules('image', 'Image', 'required');
        $this->form_validation->set_rules('barcode', 'Barcode', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');       
        //consulta de Categoria(taxonomyterms)
        $data['categoria'] = $this->productos_model->getCategoryProduct();
        //consulta de las unidades
        $data['unidades'] = $this->unidades_model->getAllUnits();
        //consulta de las marcas para mostrar en el select
        $data['marcas'] = $this->marcas_model->getAllBrands();
            
        


        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('productos/create', $data);
            $this->load->view('templates/footer');
        }
        else
        {   //configuration from upload library
            $config['upload_path'] = './uploads/imagenes/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '10240';
            $config['max_width'] = '5024';
            $config['max_height'] = '5008';
            
            $this->load->library('upload',$config);
            
            //opcion 2
            //$this->upload->initialize($config); 
            if(!$this->upload->do_upload('image'))
            {
                $error = array('error' => $this->upload->display_errors());
                // This image is uploaded by deafult if the selected image in not uploaded
                //$image = 'noproducts.jpg';
                echo $error['error'];
            }
            else
            {
                $dataImage = $this->upload->data();
                $image = $dataImage['file_name'];
                $this->productos_model->setProducts($image);
            }

            $this->load->view('templates/header');
            $this->load->view('productos/success');   
            $this->load->view('templates/footer');

        }

    }

    public function edit($product_id)
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $data['title'] = 'Editar Producto';


        $data['product'] = $this->productos_model->getProductEdit($product_id);
        $data['name'] = $data['product']['name'];

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('term', 'Term', 'required');
        $this->form_validation->set_rules('unit', 'Unit', 'required');
        $this->form_validation->set_rules('brand', 'Brand', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');
        //$this->form_validation->set_rules('image', 'Image', 'required');
        $this->form_validation->set_rules('barcode', 'Barcode', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        //estas variables sirven para ayudar a mostrar los datos que estan en la bd
        //de acuerdo al id muestra en los select los datos que tiene ese producto.

        //consulta de taxonomy
        //$data['catselected'] = $this->productos_model->getCategoryProductEdit2();
        $data['categoria'] = $this->productos_model->getCategoryProductEdit();
 
        //consulta de taxonomyterms
        $data['taxonomyterms'] = $this->productos_model->getSubCategoryQuery($this->input->post('term'));
        //consulta de las unidades
        $data['unidades'] = $this->unidades_model->getAllUnits();
        //consulta de las marcas para mostrar en el select
        $data['marcas'] = $this->marcas_model->getAllBrands();
            
        
        

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('productos/edit', $data);
            $this->load->view('templates/footer');
        }
        else
        {   //configuration from upload library
            $config['upload_path'] = './uploads/imagenes/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '10240';
            $config['max_width'] = '5024';
            $config['max_height'] = '5008';
            
            $this->load->library('upload',$config);
            $id = $this->input->post('pid');
            //opcion 2
            //$this->upload->initialize($config); 
            if(!$this->upload->do_upload('image'))
            {
                /*$error = array('error' => $this->upload->display_errors());
                // This image is uploaded by deafult if the selected image in not uploaded
                //$image = 'noproducts.jpg';
                echo $error['error'];*/
                if($id)
                {
                    $product_id = $this->uri->segment(3);
                    $product_id = $id; 
                }
                
                //$dataImage = $this->upload->data();
                //$image = $dataImage['file_name'];
                $this->productos_model->editProduct2($product_id);
            }
            else
            {
                if($id)
                {
                    $product_id = $this->uri->segment(3);
                    $product_id = $id; 
                }
                
                $dataImage = $this->upload->data();
                $image = $dataImage['file_name'];
                $this->productos_model->editProduct($product_id, $image);
            }
            $this->load->view('templates/header'); 
            $this->load->view('productos/successEdit');  
            $this->load->view('templates/footer');
  
            //redirect(base_url().'productos/index');
        }

    }    

    function getAllTaxtermbyparent()
    {
        //opcion 1
        if($this->input->post('tid'))
        {
            echo $this->productos_model->get_all_taxtermquery($this->input->post('tid'));
        }
    }

    public function delete($product_id)
    {
        $this->load->helper(array('form', 'url'));
        $data['product'] = $this->productos_model->get_products($product_id);
            
        $this->load->view('templates/header', $data);
        $this->load->view('productos/delete', $data);
        $this->load->view('templates/footer');

        $id = $this->input->post('pid');       
        
        if ($id) 
        {
            $product_id = $this->uri->segment(3);
            $product_id = $id;
            $this->productos_model->deleteProduct($product_id);
            redirect(base_url().'productos/index');
        }
    }

    function getCategoryProductParent()
    {
        //opcion 1
        if($this->input->post('term'))
        {
            echo $this->productos_model->getSubCategoryQuery($this->input->post('term'));
        }
    }

    /*function getCategoryProductCat()
    {
        //opcion 1
        if($this->input->post('subterm'))
        {
            echo $this->productos_model->getCategoryProductEdit($this->input->post('subterm'));
        }
    }*/
 
}


?>