<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Field_Controller extends CI_Controller
{

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logado')) {
            redirect(base_url('login'));
        }
        $this->load->model("field_model", "mfield");
        $this->load->model("item_model", "mitem");
    }

    public function index($id) {

        $this->campos = $this->mfield->lista_field($id);
        $dados['p'] = $this->session->userdata('userlogado')->user_permissao;
        $dados['field'] = $this->campos;
        $dados['id'] = $id;
        $dados['title'] = "Gerenciar Opções";
        $dados['subtitle'] = " campos do formulário";

        render_template("field/ver", $dados);
    }

    public function inserir($id) {
        $dados['title'] = "Admin";
        $dados['subtitle'] = "opções";
        $dados['campo'] = $id;
        render_template("field/cadastrar", $dados);
    }

    public function cadastrar($id) {
        $this->form_validation->set_rules('opc_label', "IDENTIFICAÇÃO DO LABEL", array('required', 'min_length[3]'));
        $this->form_validation->set_rules('opc_value', "IDENTIFICAÇÃO DO VALOR", array('required', 'min_length[3]'));
        $this->campo = $this->mitem->getTipoCampo($id);
        if ($this->form_validation->run() == FALSE) {
            $this->inserir($id);
        } else {
            $arr_campos = [
                'opc_label' => $this->input->post('opc_label'),
                'opc_value' => $this->input->post('opc_value'),
                'opc_campo' => $id,
                'opc_tipo' => $this->campo[0]['cam_tipo']
            ];
            $retornoCad = $this->mfield->editar($arr_campos);

            if ($retornoCad) {
                $urlRetorno = "field/inserir/".$id;
                redirect(base_url($urlRetorno));
            } else {
                $this->inserir($id);
            }
        }
    }

    public function salvar_alteracoes($id,$campo) {
        $this->form_validation->set_rules('opc_label', "IDENTIFICAÇÃO DO LABEL", array('required', 'min_length[3]'));
        $this->form_validation->set_rules('opc_value', "IDENTIFICAÇÃO DO VALOR", array('required', 'min_length[3]'));
        $this->campo = $this->mitem->getTipoCampo($id);
        if ($this->form_validation->run() == FALSE) {
            $this->editar($id);
        } else {
            $arr_campos = [
                'opc_label' => $this->input->post('opc_label'),
                'opc_value' => $this->input->post('opc_value'),
                'opc_id' => $id,
            ];

            $retornoCad = $this->mfield->editar($arr_campos);

            if ($retornoCad) {
                $urlRetorno = "field/".$campo;
                redirect(base_url($urlRetorno));
            } else {
                $this->editar($id);
            }
        }
    }

    public function editar($id,$campo) {
        $dados['field'] = $this->mfield->lista_dados($id);
        $dados['title'] = "Admin";
        $dados['subtitle'] = "Opções";
        $dados['id'] = $id;
        $dados['campo'] = $campo;
        $this->load->view('backend/template/html-header', $dados);
        $this->load->view('backend/template/template');
        $this->load->view('backend/field/editar');
        $this->load->view('backend/template/footer');
        $this->load->view('backend/template/html-footer');
    }

    public function excluir($id,$campo) {
        if ($this->mfield->excluir($id)) {
            redirect(base_url("field/".$campo));
        } else {
            $this->index();
        }
    }


}

