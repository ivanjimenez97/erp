<?php
class Auth extends CI_Controller {

        public function index()
        {
               

                $this->load->view('headers/libreria_auth');
                $this->load->view('auth/login');
        }
}
