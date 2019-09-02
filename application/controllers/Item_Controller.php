<?php ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Item_Controller extends CI_Controller
{

    public function __construct(){
        parent::__construct();
        if (!$this->session->userdata('logado')) {
            redirect(base_url('login'));
        }
        $this->load->model("formularios_model", "mform");
        $this->load->model("secao_model", "mses");
        $this->load->model("item_model", "mitem");
        $this->load->model("tipos_campo_model", "mcampos");
    }

    public function index($secao) {
        $dados['p'] = $this->session->userdata('userlogado')->user_permissao;
        $dados['dados_secao'] = $this->mses->lista_secao($secao)[0];
        $dados['campos'] = $this->mitem->listaItensBySecao($secao);
        $dados['secao'] = $secao;
        $dados["secoes"] = $this->mses->lista_secaoByForm($dados['dados_secao']['form_id']);
        $dados['title'] = "Gerenciar Formulário: ".$dados['dados_secao']['form_nome'];
        $dados['subtitle'] = " Campos do formulário: ".$dados['dados_secao']['form_nome'];
       
        render_template("item/ver", $dados);
        
    }

    public function inserir($id){
        $this->tipos = $this->mcampos->lista_tipos();
        $dados['title'] = "Inserir";
        $dados['subtitle'] = "Campo";
        $dados['secao'] = $id;
        $dados['tipos'] = $this->tipos;
        render_template("item/cadastrar", $dados);
    }

    public function cadastrar($id){
        $this->form_validation->set_rules('cam_tipo', "Tipo obrigatório", array('required'));
        $this->form_validation->set_rules('cam_label', "Label do campo", array('required', 'min_length[3]'));
        $this->form_validation->set_rules('cam_validation_message', "mensagem de validação do campo", array('required', 'min_length[3]'));
        if ($this->form_validation->run() == FALSE) {
            $this->inserir($id);
        } else {
            $arr_item = [
                'cam_sessao_form' => $this->input->post('cam_sessao_form'),
                'cam_tipo' => $this->input->post('cam_tipo'),
                'cam_label' => $this->input->post('cam_label'),
                'cam_validation_message' => $this->input->post('cam_validation_message'),
                'cam_opt1' => $this->input->post('cam_opt1'),
                'cam_opt2' => $this->input->post('cam_opt2'),
                'cam_opt3' => $this->input->post('cam_opt3'),
                'cam_opt4' => $this->input->post('cam_opt4')

            ];
            $retornoCad = $this->mitem->adicionar($arr_item);

            if ($retornoCad) {
                $urlRetorno = "campo/inserir/".$id;
                redirect(base_url($urlRetorno));
            } else {
                $this->inserir($id);
            }
        }
    }

    public function salvar_alteracoes(){
        $id = $this->input->post('form_id');
        $this->form_validation->set_rules('form_nome', "IDENTIFICAÇÃO DO FOMRULÁRIO", array('required', 'min_length[3]'));
        if ($this->form_validation->run() == FALSE) {
            $this->editar($id);
        } else {
            $arr_item = [
                'form_id' => $id,
                'form_nome' => $this->input->post('form_nome')
            ];
            $retornoCad = $this->mitem->editar($arr_item);
            if ($retornoCad) {
                $urlRetorno = "campo";
                redirect(base_url($urlRetorno));
            } else {
                $this->editar();
            }
        }
    }

    public function excluir($id,$secao){
        if ($this->mitem->excluir($id)) {
            redirect(base_url("campo/".$secao));
        } else {
            $this->index();
        }
    }

    public function editar($id, $form){
        $dados['item'] = $this->mitem->lista_item($id);
        $this->tipos = $this->mitem->lista_tipos();
        $dados['title'] = "Editar";
        $dados['subtitle'] = " Campo";
        $dados['form'] = $form;
        $dados['tipos'] = $this->tipos;
        $this->load->view('backend/template/html-header', $dados);
        $this->load->view('backend/template/template');
        $this->load->view('backend/item/editar');
        $this->load->view('backend/template/footer');
        $this->load->view('backend/template/html-footer');
    }

}
