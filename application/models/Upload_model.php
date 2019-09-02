<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Upload_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function lista_uploads() {
        $this->db->select('*');
        $this->db->from('tbl_uploads');
        $this->db->order_by('upl_id', "DESC");
        return $this->db->get()->result_array();
    }

    public function lista_upload($id) {
        $this->db->select('*');
        $this->db->from('tbl_uploads');
        $this->db->where('upl_id', $id);
        return $this->db->get()->result_array();
    }

    public function adicionar($array) {
        $this->db->insert('tbl_uploads', $array);
        return $this->db->insert_id();
    }

    public function excluir($id) {
        $dados['upl_id'] = $id;
        return $this->db->delete("tbl_uploads", $dados);
    }
}
