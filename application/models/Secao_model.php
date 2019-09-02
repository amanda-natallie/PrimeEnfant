<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Secao_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function lista_secoes()
    {
        $this->db->select('ses_id as ses_id, ses_nome as ses_nome, (SELECT form_nome FROM tbl_forms WHERE form_id = ses_id_form) as ses_form');
        $this->db->from('tbl_sessao_form');
        $this->db->join('tbl_forms', 'form_id = ses_id_form', 'left');
        $this->db->order_by('ses_id', "DESC");
        return $this->db->get()->result_array();
    }

    public function lista_secaoByForm($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_sessao_form');
        $this->db->join('tbl_forms', 'form_id = ses_id_form');
        $this->db->where('form_id', $id);
        return $this->db->get()->result_array();
    }

    public function lista_secao($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_sessao_form');
        $this->db->join('tbl_forms', 'form_id = ses_id_form', 'left');
        $this->db->where('ses_id', $id);
        return $this->db->get()->result_array();
    }

    public function lista_formulario()
    {
        $this->db->select('*');
        $this->db->from('tbl_forms');
        $this->db->order_by('form_id', "ASC");
        return $this->db->get()->result_array();
    }

    public function adicionar($array)
    {
        $this->db->insert('tbl_sessao_form', $array);
        return $this->db->insert_id();
    }

    public function excluir($id)
    {
        $dados['ses_id'] = $id;
        return $this->db->delete("tbl_sessao_form", $dados);
    }

    public function editar($array)
    {
        $this->db->set($array);
        $this->db->where('ses_id', $array['ses_id']);
        $this->db->update('tbl_sessao_form');
        return $this->db->affected_rows();
    }

}
