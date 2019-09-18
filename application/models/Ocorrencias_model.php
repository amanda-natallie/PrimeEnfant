<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ocorrencias_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function lista_ocorrencias() {
        $this->db->select('*');
        $this->db->from('tbl_ocorrencias');
        $this->db->join('tbl_usuarios','user_id = oco_cliente','left');
        $this->db->join('tbl_forms','form_id = oco_formulario','left');
        $this->db->order_by('oco_id', "DESC");
        return $this->db->get()->result_array();
    }


    public function lista_ocorrenciasByUser($clienteId) {
        $this->db->select('*');
        $this->db->from('tbl_ocorrencias');
        $this->db->join('tbl_usuarios','user_id = oco_cliente','left');
        $this->db->join('tbl_forms','form_id = oco_formulario','left');
        $this->db->where('oco_cliente', $clienteId);
        return $this->db->get()->result_array();
    }

    public function respostas($ocoId)
    {
        $this->db->select('user_nome as cliente ,form_nome as formulario, ses_nome as sessao, cam_label as campo, res_resposta as resposta, res_id as respostaId');
        $this->db->from('tbl_ocorrencias');
        $this->db->join('tbl_usuarios','user_id = oco_cliente','left');
        $this->db->join('tbl_forms','form_id = oco_formulario','left');
        $this->db->join('tbl_sessao_form','ses_id_form = oco_formulario','left');
        $this->db->join('tbl_campos_form','cam_sessao_form = ses_id','left');
        $this->db->join('tbl_respostas',' res_ocorrencia = oco_id','left');
        $this->db->where('oco_id', $ocoId);
        return $this->db->get()->result_array();

    }

    public function buscaCampos($campoId)
    {
        $this->db->select('*');
        $this->db->from('tbl_respostas');
        $this->db->join('tbl_campos_form','cam_id = res_campo','left');
        $this->db->where('res_id', $campoId);
        return $this->db->get()->result_array();
    }

    public function buscaResposta($respostaId)
    {
        $this->db->select('*');
        $this->db->from('tbl_respostas');
        $this->db->join('tbl_campos_form','res_campo = cam_id','left');
        $this->db->join('tbl_tipos_campo','tip_id = cam_tipo','left');
        $this->db->where('res_id', $respostaId);
        return $this->db->get()->result_array();
    }

    public function buscaOpcoes($idCampo)
    {
        $this->db->select('*');
        $this->db->from('tbl_fieldOptions');
        $this->db->where('opc_campo', $idCampo);
        return $this->db->get()->result_array();
    }

    public function adicionar($array) {
        $this->db->insert('tbl_ocorrencias', $array);
        return $this->db->insert_id();
    }

    public function atualizar($data)
    {
        $this->db->set($data);
        $this->db->where('oco_id', $data['oco_id']);
        $this->db->update('tbl_ocorrencias');
        return $this->db->affected_rows();

    }

    public function excluir($id) {
        $dados['oco_id'] = $id;
        return $this->db->delete("tbl_ocorrencias", $dados);
    }

    public function editar($array) {
        $this->db->set($array);
        $this->db->where('res_id', $array['res_id']);
        $this->db->update('tbl_respostas');
        return $this->db->affected_rows();
    }

}
