<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_adminpo extends CI_Model
{
    public function getDataAkhir($namapt)
    {
        $sql    = "SELECT MAX(SUBSTRING(po_id,13)) AS idArr FROM tb_poheader WHERE SUBSTR(po_id, 9,3) = '$namapt'";
        $query  = $this->db->query($sql);
        return $query;
    }

    public function getpoxb($id)
    {
        $this->db->select("tb_poheader.*, tb_perusahaan.nama_pt, tb_perusahaan.id_perusahaan, SUM(tb_podetail.qty_po) AS qtys");
        $this->db->from('tb_poheader');
        $this->db->join('tb_podetail', 'tb_poheader.po_id = tb_podetail.po_id');
        $this->db->join('tb_perusahaan', 'tb_poheader.id_perusahaan = tb_perusahaan.id_perusahaan');
        $this->db->where('tb_poheader.id_perusahaan', $id);
        $this->db->group_by('tb_podetail.po_id', $id);
        $this->db->order_by('tb_poheader.po_id', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    public function getDetailSku($id)
    {
        $this->db->select('tb_podetail.*, tb_bom.sku_xb, tb_bom.keterangan');
        $this->db->from('tb_podetail');
        $this->db->join('tb_bom', 'tb_podetail.id_bom = tb_bom.id');
        $this->db->where('tb_podetail.po_id', $id);
        $this->db->where('tb_podetail.qty_po !=', '0');
        $this->db->order_by('tb_podetail.nourut', 'asc');
        $query = $this->db->get();

        return $query;
    }

    public function getSum($id)
    {
        $this->db->select_sum('qty_po');
        $this->db->select_sum('price');
        $this->db->select_sum('amount');
        $this->db->select_sum('tax');
        $this->db->where('po_id', $id);

        $query = $this->db->get('tb_podetail');
        return $query;
    }

    public function getsdetailpoxb($idpo)
    {
        $this->db->select('tb_podetail.*, tb_bom.sku_xb');
        $this->db->from('tb_podetail');
        $this->db->join('tb_bom', 'tb_podetail.id_bom = tb_bom.id');
        $this->db->where('tb_podetail.po_id', $idpo);
        $this->db->order_by('tb_podetail.nourut','ASC');

        $query = $this->db->get();
        return $query;
    }
    
    public function getExportdata($namapt = NULL, $tgls = NULL)
    {
        
        $this->db->select('tb_bom.sku_xb, tb_podetail.qty_po, tb_poheader.po_id, tb_poheader.po_date, tb_poheader.po_delivery_date, tb_poheader.po_note');
        $this->db->from('tb_podetail');
        $this->db->join('tb_poheader', 'tb_podetail.po_id = tb_poheader.po_id');
        $this->db->join('tb_bom', 'tb_podetail.id_bom = tb_bom.id');
        $this->db->where('tb_poheader.id_perusahaan', $namapt);
        $this->db->where('tb_poheader.po_date', $tgls);
        $this->db->order_by('tb_poheader.po_id', 'DESC');

        $query = $this->db->get();
        return $query;
    }
}
