<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias_model extends CI_Model {

    public $cat_id;
    public $cat_nome;

    public function __construct() {
        parent::__construct();
    }

    public function lista_categorias() {
        $this->db->order_by("cat_nome", "DESC");                                                  
        return $this->db->get("tbl_categorias")->result();
    }
    public function lista_titulo($id) {
        $this->db->select("cat_nome");   
        $this->db->from("tbl_categorias");   
        $this->db->where("cat_id", $id);   
        return $this->db->get()->result();
    }
    public function lista_categoria($id) {
        $this->db->select("*");   
        $this->db->from("tbl_categorias");   
        $this->db->where("cat_id", $id);   
        return $this->db->get()->result();
    }
    public function adicionar($nome){
        $dados['cat_nome'] = $nome;
        return $this->db->insert("tbl_categorias", $dados);
    }
    public function excluir($id){
        $dados['cat_id'] = $id;
        return $this->db->delete("tbl_categorias", $dados);
    }
    public function editar($id, $nome){
        $dados['cat_id'] = $id;
        $dados['cat_nome'] = $nome;
        $this->db->where("cat_id", $id);
        return $this->db->update("tbl_categorias", $dados);
    }
}
