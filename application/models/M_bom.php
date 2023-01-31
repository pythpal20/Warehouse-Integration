<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_bom extends CI_Model
{
    public function getAllbom(){
        $this->db->select('*');
        $this->db->from('tb_bom');
        $this->db->order_by('created_date', 'desc');
        $query = $this->db->get();

        return $query;
    }

    public function updateBom($data, $code)
    {
        $this->db->update('tb_bom', $data, ['id' => $code]);
    }
}