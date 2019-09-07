<?php ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Ocorrencias_Controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logado')) {
            redirect(base_url('login'));
        }
        $this->load->model("ocorrencias_model", "moco");
    }

    public function index()
    {
        $dados['p'] = $this->session->userdata('userlogado')->user_permissao;
        $dados['p'] = 1 ? $this->ocorrencias = $this->moco->lista_ocorrencias() : $this->ocorrencias->moco->lista_ocorrenciasByUser($this->session->userdata('userlogado')->user_id);
        $dados['ocorrencias'] = $this->ocorrencias;
        $dados['title'] = "Gerenciar Solicitações";
        $dados['subtitle'] = " Solicitações de cadastro";

        render_template("ocorrencia/ver", $dados);
    }

    public function inserir()
    {
        $dados['title'] = "Admin";
        $dados['subtitle'] = "ocorrencias";
        render_template("ocorrencia/cadastrar", $dados);
    }

    public function cadastrar($id)
    {

        $Campos = $this->moco->buscaCampos($id);

        $i = 0;

        $success = false;

        if ($Campos[$i]['cam_mandatory']) {
            $this->form_validation->set_rules($Campos[$i]['cam_name'], $Campos[$i]['cam_validation_message'], 'required');
            if ($this->form_validation->run() == FALSE) {
                $success = false;
            } else {

                $resposta = [
                    'res_resposta' => $this->input->post($Campos[$i]['cam_name']),
                    'res_id' => $id
                ];
                array_push($arr_formulario, $resposta);

                $success = true;
            }
        } else {

            $resposta = [
                'res_resposta' => $this->input->post($Campos[$i]['cam_name']),
                'res_id' => $id,
            ];

            $success = true;
        }

        if ($success) {

           $this->moco->editar($resposta);


            $urlRetorno = "ocorrencia";

            redirect(base_url($urlRetorno));

        } else {

            $this->editar($id);

        }
    }


    public function visualizar($id)
    {
        $respostas = $this->moco->respostas($id);
        $formulario = $respostas[0]['formulario'];
        $cliente = $respostas[0]['cliente'];
        $dados['respostas'] = $respostas;
        $dados['formulario'] = $formulario;
        $dados['cliente'] = $cliente;
        $dados['title'] = "Gerenciar Resposta";
        $dados['subtitle'] = " Resposta do formulario do site";

        render_template("ocorrencia/visualizar", $dados);

    }

    public function salvar_alteracoes($id)
    {
        $this->form_validation->set_rules('form_nome', "IDENTIFICAÇÃO DO FOMRULÁRIO", array('required', 'min_length[3]'));
        if ($this->form_validation->run() == FALSE) {
            $this->editar($id);
        } else {
            $arr_formulario = [
                'oco_id' => $id,
            ];
            $retornoCad = $this->mform->editar($arr_formulario);
            if ($retornoCad) {
                $urlRetorno = "ocorrencia";
                redirect(base_url($urlRetorno));
            } else {
                $this->editar($id);
            }
        }
    }

    public function excluir($id)
    {
        if ($this->mform->excluir($id)) {
            redirect(base_url("ocorrencia"));
        } else {
            $this->index();
        }
    }

    public function status($status,$ocoId)
    {
        $data = [
            'oco_id' => $ocoId,
            'oco_status' => $status
        ];

       $this->moco->atualizar($data);
        $urlRetorno = "ocorrencia";
        redirect(base_url($urlRetorno));

    }

    public function editar($id)
    {
        $dados['resposta'] = $this->moco->buscaResposta($id);
        print_r($dados['resposta']);
        die;
        $dados['opcoes'] = $this->moco->buscaOpcoes($dados['resposta'][0]['cam_id']);
        $dados['id'] = $id;
        $dados['title'] = "Admin";
        $dados['subtitle'] = " Solicitações";
        $this->load->view('backend/template/html-header', $dados);
        $this->load->view('backend/template/template');
        $this->load->view('backend/ocorrencia/editar');
        $this->load->view('backend/template/footer');
        $this->load->view('backend/template/html-footer');
    }

}
