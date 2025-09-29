<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MEntri extends CI_Model
{

    protected $table = 't_entri';
    protected $table_detail = 't_entri_detail';
    protected $id = 'id';

    public function get($where=NULL) {
        $this->db->distinct();
        $this->db->select("$this->table.*");
        if (!empty($where)) {
            $this->db->where($where);
        }
        $this->db->from($this->table);
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->result_array();
        }
    }

    public function getDetail($where=NULL) {
        $this->db->distinct();
        $this->db->select("$this->table_detail.*, DATE_FORMAT(tgl, '%d-%m-%Y') tglnya");
        if (!empty($where)) {
            $this->db->where($where);
        }
        $this->db->from($this->table_detail);
        $this->db->order_by("tgl,id", "asc");
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->result_array();
        }
    }

    function insert($data){
        $this->db->insert($this->table, $data);
    }

    function update($id, $data){
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    function delete($id){
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
        if($this->db->affected_rows()>0){
           return true;
        }else{
           return false;
        }
    }

    function deleteDetail($id){
        $this->db->where($this->id, $id);
        $this->db->delete($this->table_detail);
        if($this->db->affected_rows()>0){
           return true;
        }else{
           return false;
        }
    }

    function deleteAllDetail($id){
        $this->db->where('fk_entri_id', $id);
        $this->db->delete($this->table_detail);
    }

}
