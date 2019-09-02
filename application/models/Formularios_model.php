<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Formularios_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
 
    public function lista_formularios() {
        $this->db->select('*');
        $this->db->from('tbl_forms');
        $this->db->order_by('form_id', "DESC");
        return $this->db->get()->result_array();
    }


    public function lista_formulario($id) {
        $this->db->select('*');
        $this->db->from('tbl_forms');
        $this->db->where('form_id', $id);
        return $this->db->get()->result_array();
    }

    public function adicionar($array) {
        $this->db->insert('tbl_forms', $array);
        return $this->db->insert_id();
    }

    public function excluir($id) {
        $dados['form_id'] = $id;
        return $this->db->delete("tbl_forms", $dados);
    }

    public function editar($array) {
        $this->db->set($array);
        $this->db->where('form_id', $array['form_id']);
        $this->db->update('tbl_forms');
        return $this->db->affected_rows();
    }

}
