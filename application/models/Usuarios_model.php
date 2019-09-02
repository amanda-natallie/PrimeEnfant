<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_model extends CI_Model {

    public $user_id;
    public $user_nome;
    public $user_email;
    public $user_senha;

    public function __construct() {
        parent::__construct();
    }

    public function lista_usuarios() {
        $this->db->order_by("user_nome", "DESC");
        return $this->db->get("tbl_usuarios")->result();
    }

   
    public function lista_usuario($id) {
        $this->db->select("*");
        $this->db->from("tbl_usuarios");
        $this->db->where("user_id", $id);
        return $this->db->get()->result();
    }

    public function adicionar($nome, $telefone, $email, $senha, $permissao) {
        $dados['user_nome'] = $nome;
        $dados['user_email'] = $email;
        $dados['user_telefone'] = $telefone;
        $dados['user_senha'] = sha1(md5($senha));
        $dados['user_permissao'] = $permissao;
        return $this->db->insert("tbl_usuarios", $dados);
    }

    public function excluir($id) {
        $dados['user_id'] = $id;
        return $this->db->delete("tbl_usuarios", $dados);
    }

    public function editar($id, $nome, $telefone, $email, $senha, $permissao) {
        $dados['user_id'] = $id;
        $dados['user_nome'] = $nome;
        $dados['user_email'] = $email;
        $dados['user_telefone'] = $telefone;
        $dados['user_senha'] = sha1(md5($senha));
        $dados['user_permissao'] = $permissao;
        $this->db->where("user_id", $id);
        return $this->db->update("tbl_usuarios", $dados);
    }

}
