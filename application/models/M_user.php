<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_user extends CI_Model
{
    public function getuserActive()
    {
        $this->db->select('*');
        $this->db->from('tb_user');
        $this->db->join('user_role', 'tb_user.role_id = user_role.role_id');
        $this->db->where('tb_user.is_active', '1');
        $this->db->order_by('tb_user.user_id', 'DESC');
        $query = $this->db->get();

        return $query;
    }
    public function getusernonActive()
    {
        $this->db->select('*');
        $this->db->from('tb_user');
        $this->db->join('user_role', 'tb_user.role_id = user_role.role_id');
        $this->db->where('tb_user.is_active', '0');
        $this->db->order_by('tb_user.user_id', 'DESC');
        $query = $this->db->get();

        return $query;
    }
}