<?php ob_start(); defined('BASEPATH') OR exit('No direct script access allowed');

class Home_Controller extends CI_Controller {
        
        public function __construct() {
            parent::__construct();
           if(!$this->session->userdata('logado')){
                redirect(base_url('login'));
            }
        }
    
	public function index()	{                
                $dados['title'] = "Admin";
                $dados['subtitle'] = " Página inicial";
                
		render_template("home", $dados);
	}
}
