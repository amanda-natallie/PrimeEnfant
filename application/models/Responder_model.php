<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Responder_model extends CI_Model
{

    public $cat_id;
    public $cat_nome;

    public function __construct()
    {
        parent::__construct();
    }

    public function lista_formularios()
    {
        $this->db->select('*');
        $this->db->from('tbl_forms');
        $this->db->order_by('form_id', "DESC");
        return $this->db->get()->result_array();
    }

    public function montarFormulario($id, $cliente)
    {
        $this->db->select('t.* , s.*, c.*, f.* , tc.*, (SELECT COUNT(res_id) FROM tbl_respostas WHERE res_campo = cam_id AND res_cliente = ' . $cliente . ' ) as valida');
        $this->db->from('tbl_forms as t');
        $this->db->join('tbl_sessao_form as s', 'form_id = ses_id_form', 'left');
        $this->db->join('tbl_campos_form as c', 'ses_id = cam_sessao_form', 'left');
        $this->db->join('tbl_tipos_campo as tc', 'tip_id = cam_tipo', 'left');
        $this->db->join('tbl_fieldOptions as f', 'opc_id = cam_id', 'left');
        $this->db->where('form_id', $id);
        return $this->db->get()->result_array();
    }

    public function montarOpcoes($id)
    {
        $this->db->select('t.*');
        $this->db->from('tbl_fieldOptions as t');
        $this->db->where('opc_campo', $id);
        return $this->db->get()->result_array();
    }


    public function Campos($form_id)
    {
        $this->db->select('c.cam_id, c.cam_name, c.cam_validation_message, c.cam_mandatory');
        $this->db->from('tbl_forms as t');
        $this->db->join('tbl_sessao_form as s', 'form_id = ses_id_form', 'left');
        $this->db->join('tbl_campos_form as c', 'ses_id = cam_sessao_form', 'left');
        $this->db->where('form_id', $form_id);
        return $this->db->get()->result_array();
    }

    public function adicionar($data)
    {
        $dados['res_cliente'] = $data['res_cliente'];
        $dados['res_campo'] = $data['res_campo'];
        $dados['res_resposta'] = $data['res_resposta'];
        return $this->db->insert("tbl_respostas", $dados);
    }

    public function excluir($id)
    {
        $dados['cat_id'] = $id;
        return $this->db->delete("tbl_categorias", $dados);
    }

    public function editar($id, $nome)
    {
        $dados['cat_id'] = $id;
        $dados['cat_nome'] = $nome;
        $this->db->where("cat_id", $id);
        return $this->db->update("tbl_categorias", $dados);
    }
}
