<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Campos_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function lista_campos() {
        $this->db->select('*');
        $this->db->from('tbl_tipos_campo');
        $this->db->order_by('tip_id', "DESC");
        return $this->db->get()->result_array();
    }


    public function lista_campo($id) {
        $this->db->select('*');
        $this->db->from('tbl_tipos_campo');
        $this->db->where('tip_id', $id);
        return $this->db->get()->result_array();
    }

    public function adicionar($array) {
        $this->db->insert('tbl_tipos_campo', $array);
        return $this->db->insert_id();
    }

    public function excluir($id) {
        $dados['tip_id'] = $id;
        return $this->db->delete("tbl_tipos_campo", $dados);
    }

    public function editar($array) {
        $this->db->set($array);
        $this->db->where('tip_id', $array['tip_id']);
        $this->db->update('tbl_tipos_campo');
        return $this->db->affected_rows();
    }

}
