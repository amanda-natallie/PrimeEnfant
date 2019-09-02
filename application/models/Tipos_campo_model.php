<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Tipos_campo_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    public function lista_tipos() {
        $this->db->select('*');
        $this->db->from('tbl_tipos_campo');
        $this->db->order_by('tip_id', "ASC");
        return $this->db->get()->result_array();
    }
}
