<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_menu extends CI_Model
{
    public function selectMenu()
    {
        $this->db->SELECT('*');
        $this->db->FROM('user_menu');
        $this->db->ORDER_BY('id', 'DESC');
        $query = $this->db->get();

        return $query;
    }

    public function selectsubMenu()
    {
        $query = "SELECT `user_sub_menu`.*, `user_menu`.`menu`
                FROM `user_sub_menu` JOIN `user_menu`
                ON `user_sub_menu`.`menu_id` = `user_menu`.`id`";
        $query = $this->db->query($query);
        return $query;
    }

    public function selectRole()
    {
        $this->db->SELECT('*');
        $this->db->FROM('user_role');
        $this->db->ORDER_BY('role_id', 'DESC');
        $query = $this->db->get();

        return $query;
    }
}