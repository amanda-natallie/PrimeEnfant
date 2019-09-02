<?php
ob_start(); defined('BASEPATH') OR exit('No direct script access allowed');

class Secao_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logado')) {
            redirect(base_url('login'));
        }
        $this->load->model("formularios_model","mform");
        $this->load->model("secao_model", "msec");
    }

    public function index($id) {

        $this->secao = $this->msec->lista_secaoByForm($id);
        $this->formulario = $this->mform->lista_formulario($id);
        
        $dados['p'] = $this->session->userdata('userlogado')->user_permissao;
        $dados['secao'] = $this->secao;
        $dados['form'] = $this->formulario[0];
        $dados['title'] = "Gerenciar Seções do Formulário ".$dados['form']['form_nome'];
        $dados['subtitle'] = $dados['form']['form_nome'];
        $dados['formulario']= $this->msec->lista_formulario();


        render_template("secao/ver", $dados);
    }

    public function inserir($id) {
        $dados['title'] = "Admin";
        $dados['subtitle'] = "secao";
        $dados['form'] = $id;
        $dados['formulario']= $this->msec->lista_formulario();
        render_template("secao/cadastrar", $dados);
    }

    public function cadastrar($id) {
        $this->form_validation->set_rules('ses_nome', "IDENTIFICAÇÃO DO SECAO", array('required', 'min_length[3]'));
        if ($this->form_validation->run() == FALSE) {
            $this->inserir($id);
        } else {
            $arr_sessao = [
                'ses_nome' => $this->input->post('ses_nome'),
                'ses_id_form' => $this->input->post('ses_id_form')
            ];
            $retornoCad = $this->msec->adicionar($arr_sessao);

            if ($retornoCad) {
                $urlRetorno = "secao/" . $id;
                redirect(base_url($urlRetorno));
            } else {
                $this->inserir($id);
            }
        }
    }

    public function salvar_alteracoes($id,$form) {
        $id = $id;
        $this->form_validation->set_rules('ses_nome', "IDENTIFICAÇÃO DO FOMRULÁRIO", array('required', 'min_length[3]'));
        if ($this->form_validation->run() == FALSE) {
            $this->editar($id);
        } else {
            $arr_sessao = [
                'ses_id' => $id,
                'ses_nome' => $this->input->post('ses_nome'),
            ];
            $retornoCad = $this->msec->editar($arr_sessao);
            if ($retornoCad) {
                $urlRetorno = "secao/".$form;
                redirect(base_url($urlRetorno));
            } else {
                $this->editar($id);
            }
        }
    }

    public function excluir($id, $form) {
        if ($this->msec->excluir($id)) {
            redirect(base_url("secao/".$form));
        } else {
            $this->index();
        }
    }

    public function editar($id) {
        $dados['secao'] = $this->msec->lista_secao($id);
        $dados['title'] = "Admin";
        $dados['subtitle'] = " Seção";
//        $dados['form'] = $form;
        $dados['formulario']= $this->msec->lista_formulario();
        $this->load->view('backend/template/html-header', $dados);
        $this->load->view('backend/template/template');
        $this->load->view('backend/secao/editar');
        $this->load->view('backend/template/footer');
        $this->load->view('backend/template/html-footer');
    }

}
