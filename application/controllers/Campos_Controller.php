<?php
ob_start(); defined('BASEPATH') OR exit('No direct script access allowed');

class Campos_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logado')) {
            redirect(base_url('login'));
        }
        $this->load->model("campos_model", "mcamp");
    }

    public function index() {

        $this->campos = $this->mcamp->lista_campos();
        $dados['p'] = $this->session->userdata('userlogado')->user_permissao;
        $dados['campos'] = $this->campos;
        $dados['title'] = "Gerenciar Campos";
        $dados['subtitle'] = " campos do formulário";

        render_template("campos/ver", $dados);
    }

    public function inserir() {
        $dados['title'] = "Admin";
        $dados['subtitle'] = "campos";
        render_template("campos/cadastrar", $dados);
    }

    public function cadastrar() {
        $this->form_validation->set_rules('tip_nome', "IDENTIFICAÇÃO DO CAMPO", array('required', 'min_length[3]'));
        $this->form_validation->set_rules('tip_codigo', "IDENTIFICAÇÃO DO INPUT", array('required', 'min_length[3]'));
        if ($this->form_validation->run() == FALSE) {
            $this->inserir();
        } else {
            $arr_campos = [
                'tip_nome' => $this->input->post('tip_nome'),
                'tip_codigo' => $this->input->post('tip_codigo')
            ];
            $retornoCad = $this->mcamp->adicionar($arr_campos);

            if ($retornoCad) {
                $urlRetorno = "campos/inserir/";
                redirect(base_url($urlRetorno));
            } else {
                $this->inserir();
            }
        }
    }

    public function salvar_alteracoes() {
        $id = $this->input->post('tip_id');
        $this->form_validation->set_rules('tip_nome', "IDENTIFICAÇÃO DO CAMPO", array('required', 'min_length[3]'));
        $this->form_validation->set_rules('tip_codigo', "IDENTIFICAÇÃO DO INPUT", array('required', 'min_length[3]'));
        if ($this->form_validation->run() == FALSE) {
            $this->editar($id);
        } else {
            $arr_campos = [
                'tip_id' => $id,
                'tip_nome' => $this->input->post('tip_nome'),
                'tip_codigo' => $this->input->post('tip_codigo')
            ];
            $retornoCad = $this->mform->editar($arr_campos);
            if ($retornoCad) {
                $urlRetorno = "campos";
                redirect(base_url($urlRetorno));
            } else {
                $this->editar();
            }
        }
    }

    public function excluir($id) {
        if ($this->mcamp->excluir($id)) {
            redirect(base_url("campos"));
        } else {
            $this->index();
        }
    }

    public function editar($id) {
        $dados['campos'] = $this->mcamp->lista_campo($id);
        $dados['title'] = "Admin";
        $dados['subtitle'] = "Campos";
        $this->load->view('backend/template/html-header', $dados);
        $this->load->view('backend/template/template');
        $this->load->view('backend/campos/editar');
        $this->load->view('backend/template/footer');
        $this->load->view('backend/template/html-footer');
    }


}
