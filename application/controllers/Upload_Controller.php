<?php ob_start(); defined('BASEPATH') OR exit('No direct script access allowed');

class Upload_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logado')) {
            redirect(base_url('login'));
        }
        $this->load->model("upload_model", "mupl");
    }

    public function index() {

        $this->upload = $this->mupl->lista_uploads();
        $dados['p'] = $this->session->userdata('userlogado')->user_permissao;
        $dados['uploads'] = $this->upload;
        $dados['title'] = "Gerenciar Imagens Diversas do Site";
        $dados['subtitle'] = " uploads de imagens diversas do site";

        $this->load->view('backend/template/html-header', $dados);
        $this->load->view('backend/template/template');
        $this->load->view('backend/upload/ver');
        $this->load->view('backend/template/footer');
        $this->load->view('backend/template/html-footer');
    }

    public function inserir() {
        $dados['title'] = "Admin";
        $dados['subtitle'] = " Imagens";
        $this->load->view('backend/template/html-header', $dados);
        $this->load->view('backend/template/template');
        $this->load->view('backend/upload/cadastrar');
        $this->load->view('backend/template/footer');
        $this->load->view('backend/template/html-footer');
    }

    public function cadastrar() {
        ini_set('upload_max_filesize', '20M');
        
        $this->form_validation->set_rules('upl_descricao', "DESCRIÇÃO DA IMAGEM", array('required'));

        if (isset($_FILES['upl_arquivo']) && $_FILES['upl_arquivo'] != "") {
            $nomeImagem = remove_accents($this->input->post('upl_descricao'));
            $caminho = "assets/upload/uploads";
            $caminho = remove_accents($caminho);
            if (!file_exists($caminho)) {
                mkdir($caminho, 0777, true);
            }$titulo2 = $nomeImagem . strtotime(date('d-m-Y H:i:s'));
            $retornoFrente = do_upload($caminho, 'upl_arquivo', $titulo2);
            if (isset($retornoFrente["error"])) {
                echo "Erro: ". $retornoFrente["error"] ."<a href='". base_url()."upload'>Clique aqui para voltar.</a>";
                die();
            } else {
                $retornoFrente = $caminho . "/" . $retornoFrente;
            }
        }

        if ($this->form_validation->run() == FALSE) {
            $this->inserir();
        } else {
            $arr_upload = [
                'upl_descricao' => $this->input->post('upl_descricao'),
                'upl_arquivo' => $retornoFrente,
                'upl_linkdireto' => base_url() . $retornoFrente,
            ];
            $retornoCad = $this->mupl->adicionar($arr_upload);
            if ($retornoCad) {
                redirect(base_url("upload"));
            } else {
                $this->inserir();
            }
        }
    }

    public function salvar_alteracoes() {
        $id = $this->input->post('img_id');
        ini_set('upload_max_filesize', '20M');
        
        
        $this->form_validation->set_rules('upl_descricao', "LOCALIZAÇÃO DA IMAGEM", array('required'));
        $this->form_validation->set_rules('img_alt', "TEXTO ALTERNATIVO", array('required'));
        $this->form_validation->set_rules('upl_descricao', "TITULO DA IMAGEM", array('required'));


        if (isset($_FILES['upl_arquivo']) && $_FILES['upl_arquivo'] != "") {
            foreach ($this->mupl->lista_upload($id) as $img) {
                if (file_exists(base_url() . $img["upl_arquivo"]) ) {
                    unlink($img["upl_arquivo"]);
                }
            }

            $nomeImagem = remove_accents($this->input->post('upl_descricao'));
            $caminho = "assets/upload/upload";
            $caminho = remove_accents($caminho);
            if (!file_exists($caminho)) {
                mkdir($caminho, 0777, true);
            }
            $titulo2 = $nomeImagem . strtotime(date('d-m-Y H:i:s'));
            $retornoFrente = do_upload($caminho, 'upl_arquivo', $titulo2);
            if (isset($retornoFrente["error"])) {
                $retornoFrente = "assets/upload/upload/background_padrao.jpg";
            } else {
                $retornoFrente = $caminho . "/" . $retornoFrente;
            }
        }

        if ($this->form_validation->run() == FALSE) {
            $this->editar();
        } else {
            $arr_upload = [
                'img_id' => $id,
                'upl_descricao' => $this->input->post('upl_descricao'),
                'img_alt' => $this->input->post('img_alt'),
                'upl_descricao' => $this->input->post('upl_descricao'),
                'img_pagina' => $this->input->post('img_pagina'),
                'upl_arquivo' => $retornoFrente,
            ];
            $retornoCad = $this->mupl->editar($arr_upload);
            if ($retornoCad) {
                redirect(base_url("upload/1"));
            } else {
                $this->editar();
            }
        }
    }

    public function excluir($id) {
        if ($this->mupl->excluir($id)) {
            foreach ($this->mupl->lista_upload($id) as $img) {
                if (file_exists($img["upl_arquivo"])) {
                    unlink($img["upl_arquivo"]);
                }
            }
            redirect(base_url("upload"));
        } else {
            $this->index();
        }
    }
}
