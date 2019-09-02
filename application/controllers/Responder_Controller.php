<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Responder_Controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logado')) {
            redirect(base_url('login'));
        }
        $this->load->model("responder_model", "mresp");
        $this->load->model("formularios_model", "mform");
    }

    public function index()
    {
        $cliente = $this->session->userdata('userlogado');
        $this->formulario = $this->mresp->lista_formularios();
        $dados['p'] = $this->session->userdata('userlogado')->user_permissao;
        $dados['param'] = NULL;
        $dados['formulario'] = $this->formulario;
        $dados['title'] = "Gerenciar respostas";
        $dados['subtitle'] = " responstas do formularios";

        render_template("responder/ver", $dados);
    }

    public function montarFormulario($id)
    {
        $this->formulario = $this->mresp->montarFormulario($id, $this->session->userdata('userlogado')->user_id);
        $dados['p'] = $this->session->userdata('userlogado')->user_permissao;
        $dados['param'] = $id;
        $dados['formularioMontado'] = $this->formulario;
        $dados['title'] = "Gerenciar respostas";
        $dados['subtitle'] = " responstas do formularios";

        print_r($this->formulario);
        die;       
        render_template("responder/ver", $dados);
    }

    public function cadastrar()
    {
        $cliente = $this->session->userdata('userlogado');
        $Campos = $this->mresp->Campos($this->input->post('form_id'));
        for ($i = 0; $i < sizeof($Campos); $i++) {
            $arr_formulario = [
                'res_resposta' => $this->input->post($Campos[$i]['cam_name']),
                'res_campo' => $Campos[$i]['cam_id'],
                'res_cliente' => $cliente->user_id
            ];
            $retornoCad = $this->mresp->adicionar($arr_formulario);
        }
        if ($retornoCad) {
            $urlRetorno = "responder/";
            redirect(base_url($urlRetorno));
        } else {
            $this->montarFormulario($this->input->post('form_id'));
        }
    }
}
