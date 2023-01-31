<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_gudang extends CI_Model
{
    public function listBarang()
    {
        $sql = "SELECT
        IFNULL((SELECT SUM(qty_mutasi) FROM tb_mutasi b WHERE jenis_mutasi='minus' AND b.model = a.model AND b.status = '0' AND (b.source = 'g75' OR b.destination = 'g75')), '0') AS minus_75,
        IFNULL((SELECT SUM(qty_mutasi) FROM tb_mutasi b WHERE jenis_mutasi='plus' AND b.model = a.model AND b.status = '0' AND (b.source = 'g75' OR b.destination = 'g75')), '0') AS plus_75,
        IFNULL((SELECT SUM(qty_mutasi) FROM tb_mutasi b WHERE jenis_mutasi='minus' AND b.model = a.model AND b.status = '0' AND (b.source = 'a50' OR b.destination = 'a50')), '0') AS minus50,
        IFNULL((SELECT SUM(qty_mutasi) FROM tb_mutasi b WHERE jenis_mutasi='plus' AND b.model = a.model AND b.status = '0' AND (b.source = 'a50' OR b.destination = 'a50')), '0') AS plus_50,
        IFNULL((SELECT SUM(qty_mutasi) FROM tb_mutasi b WHERE jenis_mutasi='mutation' AND b.model = a.model AND b.status = '0' AND (b.source = 'g75' AND b.destination = 'a50')), '0') AS g75_to_a50,
        IFNULL((SELECT SUM(qty_mutasi) FROM tb_mutasi b WHERE jenis_mutasi='mutation' AND b.model = a.model AND b.status = '0' AND (b.source = 'a50' AND b.destination = 'g75')), '0') AS a50_to_g75,
        a.*
        FROM tb_barang a";
        $query = $this->db->query($sql);
        return $query;
    }

    public function listMutasi()
    {
        $this->db->select('*');
        $this->db->from('tb_mutasi');
        $this->db->order_by('created_date', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    public function getdataItem($itemCode)
    {
        $this->db->select('*');
        $this->db->from('tb_barang');
        $this->db->where('code_barang', $itemCode);
        $query = $this->db->get();

        return $query;
    }

    public function get_mutasi($skus)
    {
        $this->db->select("*");
        $this->db->from('tb_mutasi');
        $this->db->where('status', '0');
        $this->db->where('model', $skus);
        $this->db->order_by('created_date', 'DESC');

        $query = $this->db->get();
        return $query;
    }

    public function spesifikMutasi($id = null){
        $this->db->select('*');
        $this->db->from('tb_history_mutasi');
        $this->db->where('code_barang', $id);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();

        return $query;
    }
}
