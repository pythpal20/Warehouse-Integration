<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_deen extends CI_Model
{
    public function getUrutan($id_pt)
    {
        $sql    = "SELECT MAX(kode) AS idArr
        FROM (SELECT CAST(urutan AS INT) AS kode FROM (SELECT SUBSTRING(dn_id, 14, 9) AS urutan FROM tb_dn_header WHERE id_perusahaan ='$id_pt') AS tabel_a) AS table_b";

        $query  = $this->db->query($sql);
        return $query;
    }

    public function headerDn($id)
    {
        $this->db->select('*');
        $this->db->from('tb_dn_header');
        $this->db->where('id_perusahaan', $id);
        $this->db->where('dn_status', '0');
        $this->db->order_by('dn_create_date', 'DESC');

        $query = $this->db->get();
        return $query;
    }

    public function headerDnc($id)
    {
        $this->db->select('*');
        $this->db->from('tb_dn_header');
        $this->db->where('id_perusahaan', $id);
        $this->db->where('dn_status !=', '0');
        $this->db->order_by('dn_create_date', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    public function getsums($id)
    {
        $this->db->select_sum('qty');
        $this->db->select_sum('item_price');
        $this->db->select_sum('amount');
        $this->db->select_sum('item_tax');
        $this->db->where('dn_id', $id);

        $query = $this->db->get('tb_dn_detail');
        return $query;
    }

    public function getdnHeader($id)
    {
        $this->db->select('tb_dn_header.*, tb_perusahaan.atasnama');
        $this->db->from('tb_dn_header');
        $this->db->join('tb_perusahaan', 'tb_dn_header.id_perusahaan = tb_perusahaan.id_perusahaan');
        $this->db->where('tb_dn_header.dn_id', $id);
        $query = $this->db->get();
        return $query;
    }

    public function getdnDetail($id)
    {
        $this->db->select('tb_dn_detail.*, tb_bom.sku_xb');
        $this->db->from('tb_dn_detail');
        $this->db->join('tb_bom', 'tb_dn_detail.id_bom = tb_bom.id');
        $this->db->where('tb_dn_detail.dn_id', $id);
        $this->db->where('tb_dn_detail.qty >', '0');
        $this->db->order_by('tb_dn_detail.urutan', 'asc');
        $query = $this->db->get();
        return $query;
    }

    public function sum_poxb($nopoxb)
    {
        $sql = "SELECT SUM(qty_po) AS qty_poxb FROM tb_podetail WHERE po_id = '$nopoxb'";
        $query = $this->db->query($sql);
        return $query;
    }

    public function sum_dn($nopoxb)
    {
        $sql = "SELECT a.dn_id,dn_create_date, SUM(b.qty) AS qty_dn FROM tb_dn_header a
        JOIN tb_dn_detail b ON a.dn_id = b.dn_id
        WHERE a.id_poxb = '$nopoxb'";

        $query = $this->db->query($sql);
        return $query;
    }

    public function dataDn_payment($id)
    {
        $sql = "SELECT a.dn_id, a.dn_create_date, a.no_bl, a.tgl_kirim, a.dn_issued_by, a.id_poxb, a.dn_status, SUM(b.amount) AS nilai_awal,
        SUM(b.item_tax) AS nilai_tax, 
        (SELECT SUM(nom_payment) FROM tb_payment_received WHERE dn_id = a.dn_id) AS nilai_akhir
        FROM tb_dn_header a 
        JOIN tb_dn_detail b ON a.dn_id = b.dn_id 
        WHERE a.dn_status BETWEEN '1' AND '2' 
        AND a.id_perusahaan = '$id'
        GROUP BY a.dn_id 
        ORDER BY a.dn_id DESC";

        $query = $this->db->query($sql);
        return $query;
    }

    public function dataDn_paid($id)
    {
        $sql = "SELECT a.dn_id, a.dn_create_date, a.no_bl, a.tgl_kirim, a.dn_issued_by, a.id_poxb, a.dn_status, SUM(b.amount) AS nilai_awal,
        SUM(b.item_tax) AS nilai_tax, 
        (SELECT SUM(nom_payment) FROM tb_payment_received WHERE dn_id = a.dn_id) AS nilai_akhir
        FROM tb_dn_header a 
        JOIN tb_dn_detail b ON a.dn_id = b.dn_id 
        WHERE a.dn_status = '3'
        AND a.id_perusahaan = '$id'
        GROUP BY a.dn_id 
        ORDER BY a.dn_id DESC";
        
        $query = $this->db->query($sql);
        return $query;
    }

    public function sumPayment($id)
    {
        $this->db->select_sum('nom_payment');
        $this->db->where('dn_id', $id);
        $query = $this->db->get('tb_payment_received');
        return $query;
    }

}
