<?php ob_start(); defined('BASEPATH') OR exit('No direct script access allowed');

class Formularios_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logado')) {
            redirect(base_url('login'));
        }
        $this->load->model("formularios_model", "mform");
    }

    public function index() {
        $this->formulario = $this->mform->lista_formularios();
        $dados['p'] = $this->session->userdata('userlogado')->user_permissao;
        $dados['formulario'] = $this->formulario;
        $dados['title'] = "Gerenciar Formulario";
        $dados['subtitle'] = " formularios do site";

        render_template("formulario/ver", $dados);
    }

    public function inserir() {
        $dados['title'] = "Admin";
        $dados['subtitle'] = "formularios";
        render_template("formulario/cadastrar", $dados);
    }

    public function cadastrar() {
        $this->form_validation->set_rules('form_nome', "IDENTIFICAÇÃO DO FOMRULÁRIO", array('required', 'min_length[3]'));
        if ($this->form_validation->run() == FALSE) {
            $this->inserir();
        } else {
            $arr_formulario = [
                'form_nome' => $this->input->post('form_nome')
            ];
            $retornoCad = $this->mform->adicionar($arr_formulario);

            if ($retornoCad) {
                $urlRetorno = "formulario";
                redirect(base_url($urlRetorno));
            } else {
                $this->inserir();
            }
        }
    }

    public function salvar_alteracoes() {
        $id = $this->input->post('form_id');
        $this->form_validation->set_rules('form_nome', "IDENTIFICAÇÃO DO FOMRULÁRIO", array('required', 'min_length[3]'));
        if ($this->form_validation->run() == FALSE) {
            $this->editar($id);
        } else {
            $arr_formulario = [
                'form_id' => $id,
                'form_nome' => $this->input->post('form_nome')
            ];
            $retornoCad = $this->mform->editar($arr_formulario);
            if ($retornoCad) {
                $urlRetorno = "formulario";
                redirect(base_url($urlRetorno));
            } else {
                $this->editar();
            }
        }
    }

    public function excluir($id) {
        if ($this->mform->excluir($id)) {
            redirect(base_url("formulario"));
        } else {
            $this->index();
        }
    }

    public function editar($id) {
        $dados['formulario'] = $this->mform->lista_formulario($id);
        $dados['title'] = "Admin";
        $dados['subtitle'] = " Formularios";
        $this->load->view('backend/template/html-header', $dados);
        $this->load->view('backend/template/template');
        $this->load->view('backend/formulario/editar');
        $this->load->view('backend/template/footer');
        $this->load->view('backend/template/html-footer');
    }

}
