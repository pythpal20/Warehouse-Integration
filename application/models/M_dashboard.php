<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_dashboard extends CI_Model
{
    public function getDatamutasiminus()
    {
        $sql = "SELECT b.model, SUM(a.qty_update) AS total_keluar
        FROM tb_history_mutasi a
        JOIN tb_barang b ON a.`code_barang` = b.code_barang
        WHERE a.kategori = 'minus' AND YEAR(FROM_UNIXTIME(a.approval_at)) = YEAR(CURRENT_DATE())
        GROUP BY a.code_barang LIMIT 5";

        $query  = $this->db->query($sql);
        return $query->result_array();
    }
}
