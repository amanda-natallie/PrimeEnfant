<?php
ob_start(); defined('BASEPATH') OR exit('No direct script access allowed');

class Field_model extends CI_Model
{

    public function __construct() {
        parent::__construct();
    }

    public function lista_field($id) {
        $this->db->select('*');
        $this->db->from('tbl_fieldOptions');
        $this->db->where('opc_campo',$id);
        $this->db->order_by('opc_id', "DESC");
        return $this->db->get()->result_array();
    }


    public function lista_dados($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_fieldOptions');
        $this->db->where('opc_id',$id);
        $this->db->order_by('opc_id', "DESC");
        return $this->db->get()->result_array();
    }

    public function adicionar($array) {
        $this->db->insert('tbl_fieldOptions', $array);
        return $this->db->insert_id();
    }

    public function excluir($id) {
        $dados['opc_id'] = $id;
        return $this->db->delete("tbl_fieldOptions", $dados);
    }

    public function editar($array) {
        $this->db->set($array);
        $this->db->where('opc_id', $array['opc_id']);
        $this->db->update('tbl_fieldOptions');
        return $this->db->affected_rows();
    }

}
