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
        $this->load->model("ocorrencias_model", "moco");
    }

    public function index()
    {

        $cliente = $this->session->userdata('userlogado');
        $this->formulario = $this->moco->lista_formularios();
        $dados['p'] = $this->session->userdata('userlogado')->user_permissao;
        $dados['param'] = NULL;
        $dados['formulario'] = $this->formulario;
        $dados['title'] = "Gerenciar respostas";
        $dados['subtitle'] = " responstas do formularios";

        render_template("ocorrencia/ver", $dados);

    }


    public function cadastrar($id)
    {
        $cliente = $this->session->userdata('userlogado');

        $Campos = $this->mresp->Campos($id);

        $arr_formulario = [];

        $ocorrencias = [
            "oco_cliente" => $cliente->user_id,
            "oco_formulario" => $id,
            "oco_status" => 0,
        ];

        $success = false;

        for ($i = 0; $i < sizeof($Campos); $i++) {
            if ($Campos[$i]['cam_mandatory']) {
                $this->form_validation->set_rules($Campos[$i]['cam_name'], $Campos[$i]['cam_validation_message'], 'required');
                if ($this->form_validation->run() == FALSE) {
                    $success = false;
                    break;
                } else {

                    $resposta = [
                        'res_resposta' => $this->input->post($Campos[$i]['cam_name']),
                        'res_campo' => $Campos[$i]['cam_id'],
                        'res_cliente' => $cliente->user_id
                    ];
                    array_push($arr_formulario, $resposta);

                    $success = true;
                }
            } else {

                $resposta = [
                    'res_resposta' => $this->input->post($Campos[$i]['cam_name']),
                    'res_campo' => $Campos[$i]['cam_id'],
                    'res_cliente' => $cliente->user_id
                ];
                array_push($arr_formulario, $resposta);

                $success = true;
            }

        }
        if ($success) {

            foreach ($arr_formulario as $arr_formulario) {

                $retorno = $this->mresp->adicionar($arr_formulario);

            }

            if ($retorno) {

                $this->moco->adicionar($ocorrencias);

                $urlRetorno = "responder/";

                redirect(base_url($urlRetorno));

            } else {

                $this->montarFormulario($id);

            }
        } else {

            $this->montarFormulario($id);

        }
    }
}
