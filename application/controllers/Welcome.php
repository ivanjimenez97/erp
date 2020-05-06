<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	/* function_construct(){
		parent::_construct();
	}
	function index(){
		if (!$this->tank_auth->is_logged_in()){
			redirect('/auth/login/');
		}
		else {
			$data['user_id']= $this->tank_auth->get_user_id();
			$data['username']=$this->tank_auth->get_username();
			
		}
	} */

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('templates/header.php');
		$this->load->view('clientes/index.php');
		$this->load->view('templates/footer.php');
		
	}
}
