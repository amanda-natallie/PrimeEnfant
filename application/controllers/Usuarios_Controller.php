<?php ob_start(); defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('usuarios_model', 'Muser');
        $this->usuarios = $this->Muser->lista_usuarios();
    }

    public function index() {
        if (verificaPermissao($this->session->userdata('logado'), $this->session->userdata('userlogado')->user_permissao, 2) == 0) {
            exit;
        } else {
            $dados['usuarios'] = $this->usuarios;
            $dados['title'] = "PrimeEnfant";
            $dados['subtitle'] = "Usuário";

            $this->load->view('backend/template/html-header', $dados);
            $this->load->view('backend/template/template');
            $this->load->view('backend/usuario/ver');
            $this->load->view('backend/template/html-footer');
        }
    }

    public function pag_login() {
        $dados['title'] = "PrimeEnfant";
        $dados['subtitle'] = "Logar no sistema";

        $this->load->view('backend/template/template-login', $dados);
        $this->load->view('backend/login');
    }

    public function pag_cadastro() {
        $dados['title'] = "PrimeEnfant";
        $dados['subtitle'] = "Cadastrar-se no sistema";

        $this->load->view('backend/template/template-login', $dados);
        $this->load->view('backend/cadastro');
    }

    public function login() {

        $this->form_validation->set_rules('user-usuario', "EMAIL", array('required', 'min_length[3]'));
        $this->form_validation->set_rules('user-senha', "SENHA", array('required', 'min_length[3]'));

        if ($this->form_validation->run() == FALSE) {
            $this->pag_login();
        } else {

            $usuario = $this->input->post("user-usuario");
            $senha = $this->input->post("user-senha");
            $this->db->where('user_email', $usuario);
            $this->db->where('user_senha', sha1(md5($senha)));
            $userlogado = $this->db->get("tbl_usuarios")->result();
            if (count($userlogado) == 1) {
                $dadosSessao['userlogado'] = $userlogado[0];
                $dadosSessao['logado'] = TRUE;
                $this->session->set_userdata($dadosSessao);
                redirect(base_url());
            } else {
                $dadosSessao['userlogado'] = NULL;
                $dadosSessao['logado'] = FALSE;
                $this->session->set_userdata($dadosSessao);
                $this->session->set_flashdata('erro_login', 'E-mail ou senha incorretos. Tente novamente ou redefina sua senha clicando em "Esqueci minha senha".');
                redirect(base_url("login"));
            }
        }
    }

    public function logout() {
        $dadosSessao['userlogado'] = NULL;
        $dadosSessao['logado'] = FALSE;
        $this->session->set_userdata($dadosSessao);
        redirect(base_url("login"));
    }

    public function inserir() {
        if (verificaPermissao($this->session->userdata('logado'), $this->session->userdata('userlogado')->user_permissao, 2) == false) {
            exit;
        } else {
            $dados['permissao'] = $this->session->userdata('userlogado')->user_permissao;
            $dados['title'] = "PrimeEnfant";
            $dados['subtitle'] = "Usuário";

            $this->load->view('backend/template/html-header', $dados);
            $this->load->view('backend/template/template');
            $this->load->view('backend/usuario/cadastrar');
            $this->load->view('backend/template/html-footer');
        }
    }

    public function cadastrar($origem) {
        /* origem 1 é do formulario dentro do painel, 2 é da tela de cadastro fora do painel */
        $this->form_validation->set_rules('user_nome', "nome do usuário", array('required', 'min_length[3]'));
        $this->form_validation->set_rules('user_email', "email", array('trim', 'required', 'valid_email', 'is_unique[tbl_usuarios.user_email]', 'min_length[3]'));
        $this->form_validation->set_rules('user_telefone', "telefone", array('required', 'min_length[10]'));
        $this->form_validation->set_rules('user_senha', "senha", array('required', 'min_length[3]'));
        $this->form_validation->set_rules('user_senha_conf', "confirmação de senha", array('required', 'min_length[3]', 'matches[user_senha]'));
        if ($this->form_validation->run() == FALSE) {
            if ($origem == 1) {$this->cadastro();} else {$this->pag_cadastro();}
        } else {
            $nome = $this->input->post('user_nome');
            $email = $this->input->post('user_email');
            $telefone = $this->input->post('user_telefone');
            $senha = $this->input->post('user_senha');
            if ($origem == 1) { $permissao = $this->input->post('user_permissao');}else{$permissao = 3; }
            if ($this->Muser->adicionar($nome, $telefone, $email, $senha, $permissao)) {
                if ($origem == 1) {redirect(base_url("usuarios"));} else {
                    $this->session->set_flashdata('cadastrado_com_sucesso', 'Cadastro realizado com sucesso. <a href="'. base_url().'">Clique aqui e faça login para continuar</a>".');
                    $this->pag_cadastro();}
            } else {
                if ($origem == 1) {$this->cadastro();} else {$this->pag_cadastro();}
            }
        }
    }

    public function editar($id) {
        if (verificaPermissao($this->session->userdata('logado'), $this->session->userdata('userlogado')->user_permissao, 2, $id) == false) {
            exit;
        } else {
            $dados['usuario'] = $this->Muser->lista_usuario($id);
            $dados['permissao'] = $this->session->userdata('userlogado')->user_permissao;
            $dados['title'] = "PrimeEnfant";
            $dados['subtitle'] = "Usuário";

            $this->load->view('backend/template/html-header', $dados);
            $this->load->view('backend/template/template');
            $this->load->view('backend/usuario/editar');
            $this->load->view('backend/template/html-footer');
        }
    }

    public function salvar_alteracoes() {
        $id = $this->input->post('user_id');


        $this->form_validation->set_rules('user_nome', "NOME DO USUÁRIO", array('required', 'min_length[3]'));
        $this->form_validation->set_rules('user_email', "EMAIL DO USUÁRIO", array('trim', 'required', 'valid_email', 'min_length[3]'));
        $this->form_validation->set_rules('user_senha', "SENHA DO USUÁRIO", array('required', 'min_length[3]'));
        $this->form_validation->set_rules('user_senha_conf', "CONFIRMAÇÃO DA SENHA", array('required', 'min_length[3]', 'matches[user_senha]'));

        if ($this->form_validation->run() == FALSE) {
            $this->editar($id);
        } else {

            $nome = $this->input->post('user_nome');
            $email = $this->input->post('user_email');
            $telefone = $this->input->post('user_telefone');
            $senha = $this->input->post('user_senha');
            $permissao = $this->input->post('user_permissao');

            if ($this->Muser->editar($id, $nome, $telefone, $email, $senha, $permissao)) {
                if($permissao == 3) {
                    $this->session->set_flashdata("alterado_com_sucesso", "Dados Alterados com Sucesso.");
                   $this->editar($id);
                }else{
                    redirect(base_url("usuarios"));
                }
            } else {
                $this->editar($id);
            }
        } 
    }

    public function excluir($id) {

        if ($this->Muser->excluir($id)) {
            redirect(base_url("usuarios"));
        } else {
            $this->index();
        }
    }
    

}
