<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Imagem_model extends CI_Model {

      public function __construct() {
        parent::__construct();
    }

    public function lista_imagem_geral() {
        $this->db->select('*');
        $this->db->from('tbl_imagens');
        $this->db->order_by('img_id', "DESC");
        return $this->db->get()->result_array();
    }
    public function lista_imagem_porPagina($id) {
        $this->db->select('*');
        $this->db->from('tbl_imagens');
        $this->db->where('img_pagina', $id);
        $this->db->order_by('img_id', "DESC");
        return $this->db->get()->result_array();
    }

    public function lista_imagem($id) {
        $this->db->select('*');
        $this->db->from('tbl_imagens');
        $this->db->where('img_id', $id);
        return $this->db->get()->result_array();
    }

    public function adicionar($array) {
        $this->db->insert('tbl_imagens', $array);
        return $this->db->insert_id();
    }

    public function excluir($id) {
        $dados['img_id'] = $id;
        return $this->db->delete("tbl_imagens", $dados);
    }

    public function editar($array) {
        $this->db->set($array);
        $this->db->where('img_id', $array['img_id']);
        $this->db->update('tbl_imagens');
        return $this->db->affected_rows();
    }

}
