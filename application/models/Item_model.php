<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Item_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function listaItensBySecao($secao) {
        $this->db->select('*');
        $this->db->from('tbl_campos_form');
        $this->db->where('cam_sessao_form', $secao );
        $this->db->order_by('cam_id', "ASC");
        return $this->db->get()->result_array();
    }

    public function lista_item($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_campos_form');
        $this->db->where('cam_id', $id );
        $this->db->order_by('cam_id', "ASC");
        return $this->db->get()->result_array();
    }

    public function lista_tipos()
    {
        $this->db->select('*');
        $this->db->from('tbl_tipos_campo');
        $this->db->order_by('tip_id', "ASC");
        return $this->db->get()->result_array();
    }

    public function adicionar($array) {
        $this->db->insert('tbl_campos_form', $array);
        return $this->db->insert_id();
    }

    public function excluir($id) {
        $dados['cam_id'] = $id;
        return $this->db->delete("tbl_campos_form", $dados);
    }

    public function editar($array,$id) {
        $this->db->set($array);
        $this->db->where('cam_id', $id);
        $this->db->update('tbl_campos_form');
        return $this->db->affected_rows();
    }

}
