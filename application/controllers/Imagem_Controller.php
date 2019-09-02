<?php

ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Imagem_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logado')) {
            redirect(base_url('login'));
        }
        
    }

    public function index($id) {

        $this->imagem = $this->mimg->lista_imagem_porPagina($id);
        $dados['p'] = $this->session->userdata('userlogado')->user_permissao;
        $dados['i'] = $id;
        $dados['imagem'] = $this->imagem;
        $dados['title'] = "Gerenciar Texto";
        $dados['subtitle'] = " imagem do site";

        $this->load->view('backend/template/html-header', $dados);
        $this->load->view('backend/template/template');
        $this->load->view('backend/imagem/ver');
        $this->load->view('backend/template/footer');
        $this->load->view('backend/template/html-footer');
    }

    public function inserir() {


        $dados['title'] = "Admin";
        $dados['subtitle'] = " Slide";
        $this->load->view('backend/template/html-header', $dados);
        $this->load->view('backend/template/template');
        $this->load->view('backend/imagem/cadastrar');
        $this->load->view('backend/template/footer');
        $this->load->view('backend/template/html-footer');
    }

    public function cadastrar() {
        ini_set('upload_max_filesize', '20M');
        
        
        $this->form_validation->set_rules('img_localizacao', "LOCALIZAÇÃO DA IMAGEM", array('required'));
        $this->form_validation->set_rules('img_alt', "TEXTO ALTERNATIVO", array('required'));
        $this->form_validation->set_rules('img_title', "TITULO DA IMAGEM", array('required'));
        $this->form_validation->set_rules('img_pagina', "PAGINA", array('required'));

        if (isset($_FILES['img_imagem']) && $_FILES['img_imagem'] != "") {
            $nomeImagem = remove_accents($this->input->post('img_title'));
            $caminho = "assets/upload/imagem";
            $caminho = remove_accents($caminho);
            if (!file_exists($caminho)) {
                mkdir($caminho, 0777, true);
            }$titulo2 = $nomeImagem . strtotime(date('d-m-Y H:i:s'));
            $retornoFrente = do_upload($caminho, 'img_imagem', $titulo2);
            if (isset($retornoFrente["error"])) {
                $retornoFrente = "assets/upload/imagem/background_padrao.jpg";
            } else {
                $retornoFrente = $caminho . "/" . $retornoFrente;
            }
        }

        if ($this->form_validation->run() == FALSE) {
            $this->inserir();
        } else {
            $arr_imagem = [
                'img_localizacao' => $this->input->post('img_localizacao'),
                'img_alt' => $this->input->post('img_alt'),
                'img_title' => $this->input->post('img_title'),
                'img_pagina' => $this->input->post('img_pagina'),
                'img_imagem' => $retornoFrente,
            ];
            $retornoCad = $this->mimg->adicionar($arr_imagem);
            if ($retornoCad) {
                redirect(base_url("imagem/1"));
            } else {
                $this->inserir();
            }
        }
    }

    public function salvar_alteracoes() {
        $id = $this->input->post('img_id');
        ini_set('upload_max_filesize', '20M');
        
        
        $this->form_validation->set_rules('img_localizacao', "LOCALIZAÇÃO DA IMAGEM", array('required'));
        $this->form_validation->set_rules('img_alt', "TEXTO ALTERNATIVO", array('required'));
        $this->form_validation->set_rules('img_title', "TITULO DA IMAGEM", array('required'));


        if (isset($_FILES['img_imagem']) && $_FILES['img_imagem'] != "") {
            foreach ($this->mimg->lista_imagem($id) as $img) {
                if (file_exists(base_url() . $img["img_imagem"]) ) {
                    unlink($img["img_imagem"]);
                }
            }

            $nomeImagem = remove_accents($this->input->post('img_title'));
            $caminho = "assets/upload/imagem";
            $caminho = remove_accents($caminho);
            if (!file_exists($caminho)) {
                mkdir($caminho, 0777, true);
            }
            $titulo2 = $nomeImagem . strtotime(date('d-m-Y H:i:s'));
            $retornoFrente = do_upload($caminho, 'img_imagem', $titulo2);
            if (isset($retornoFrente["error"])) {
                $retornoFrente = "assets/upload/imagem/background_padrao.jpg";
            } else {
                $retornoFrente = $caminho . "/" . $retornoFrente;
            }
        }

        if ($this->form_validation->run() == FALSE) {
            $this->editar();
        } else {
            $arr_imagem = [
                'img_id' => $id,
                'img_localizacao' => $this->input->post('img_localizacao'),
                'img_alt' => $this->input->post('img_alt'),
                'img_title' => $this->input->post('img_title'),
                'img_pagina' => $this->input->post('img_pagina'),
                'img_imagem' => $retornoFrente,
            ];
            $retornoCad = $this->mimg->editar($arr_imagem);
            if ($retornoCad) {
                redirect(base_url("imagem/1"));
            } else {
                $this->editar();
            }
        }
    }

    public function excluir($id) {



        if ($this->mimg->excluir($id)) {
            foreach ($this->mimg->lista_imagem($id) as $img) {
                if (file_exists(base_url() . $img["img_imagem"])) {
                    unlink($img["img_imagem"]);
                }
            }
            redirect(base_url("imagem/1"));
        } else {
            $this->index();
        }
    }

    public function editar($id) {
        $dados['imagem'] = $this->mimg->lista_imagem($id);
        $dados['title'] = "Admin";
        $dados['subtitle'] = " Slide";
        $this->load->view('backend/template/html-header', $dados);
        $this->load->view('backend/template/template');
        $this->load->view('backend/imagem/editar');
        $this->load->view('backend/template/footer');
        $this->load->view('backend/template/html-footer');
    }

}
