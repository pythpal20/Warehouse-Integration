<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_mkits extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->mkits = $this->load->database('mkits', TRUE);
    }

    public function getdataSku($search = NULL)
    {
        if (!isset($search)) {
            $this->mkits->select('*');
            $this->mkits->from('master_produk');
            $this->mkits->order_by('model', 'desc');
            $query = $this->mkits->get();

            return $query;
        } else {
            $this->mkits->select('*');
            $this->mkits->from('master_produk');
            $this->mkits->like('model', $search);
            $this->mkits->or_like('barcode', $search);
            $this->mkits->order_by('model', 'desc');
            $query = $this->mkits->get();

            return $query;
        }
    }

    public function dataMwk($idlix)
    {
        $sql = "SELECT 
            a.noso,
            a.tgl_po,
            a.tgl_krm,
            c.customer_nama,
            SUM(b.harga_total) AS uang,
            a.status,
            a.sales,
            a.keterangan
        FROM salesorder_hdr a
        JOIN salesorder_dtl b ON a.noso = b.noso
        JOIN master_customer c ON a.customer_id = c.customer_id
        WHERE a.id_perusahaan = '$idlix' AND a.aproval_finance ='1' AND a.co_status = '0' AND a.status_dn='0'
        GROUP BY b.noso ORDER BY a.noso DESC";
        $query = $this->mkits->query($sql);

        return $query;
    }

    public function getTotal($id)
    {
        $sql = "SELECT SUM(qty_kirim) AS total_qty, SUM(price) AS totalprice, SUM(amount) AS totalamount, SUM(diskon) AS diskons, SUM(ppn) as ppns, SUM(harga_total) AS total_semua
        FROM customerorder_dtl
        WHERE No_Co = '$id'";

        $query = $this->mkits->query($sql);

        return $query;
    }

    public function getPicktTicket($id)
    {
        $this->mkits->SELECT('*');
        $this->mkits->FROM('customerorder_hdr');
        $this->mkits->WHERE('id_perusahaan', $id);
        $this->mkits->order_by('No_Co', 'DESC');

        $query = $this->mkits->get();
        return $query;
    }

    public function getBLs($id = NULL)
    {
        $this->mkits->select('customerorder_hdr_delivery.*, customerorder_hdr.id_perusahaan');
        $this->mkits->from('customerorder_hdr_delivery');
        $this->mkits->join('customerorder_hdr', 'customerorder_hdr_delivery.No_Co = customerorder_hdr.No_Co');
        $this->mkits->WHERE('customerorder_hdr.id_perusahaan', $id);
        $this->mkits->WHERE('customerorder_hdr_delivery.status_delivery', '3');
        $this->mkits->WHERE('customerorder_hdr_delivery.dn_status', '0');
        $this->mkits->order_by('customerorder_hdr_delivery.No_Co', 'DESC');

        $query = $this->mkits->get();
        return $query;
    }

    public function get_detail($noco)
    {
        $this->mkits->select('*');
        $this->mkits->from('customerorder_dtl_delivery');
        $this->mkits->where('No_Co', $noco);
        $this->mkits->order_by('no_urut', 'ASC');

        $query  = $this->mkits->get();
        return $query;
    }

    public function get_header($noco)
    {
        $this->mkits->select('customerorder_hdr_delivery.*, master_customer.customer_nama, master_wilayah.wilayah_nama');
        $this->mkits->from('customerorder_hdr_delivery');
        $this->mkits->join('master_customer', 'customerorder_hdr_delivery.customer_id=master_customer.customer_id');
        $this->mkits->join('master_wilayah', 'master_customer.customer_kota = master_wilayah.wilayah_id');
        $this->mkits->where('customerorder_hdr_delivery.No_Co', $noco);
        $query = $this->mkits->get();
        return $query;
    }

    public function getsHeader($id)
    {
        $this->mkits->select('salesorder_hdr.*, master_customer.customer_nama, list_perusahaan.atasnama');
        $this->mkits->from('salesorder_hdr');
        $this->mkits->join('master_customer', 'salesorder_hdr.customer_id = master_customer.customer_id');
        $this->mkits->join('list_perusahaan', 'salesorder_hdr.id_perusahaan = list_perusahaan.id_perusahaan');
        $this->mkits->where('salesorder_hdr.noso', $id);
        $query = $this->mkits->get();
        return $query;
    }

    public function getPts()
    {
        $this->mkits->select('*');
        $this->mkits->from('pts_header');
        $this->mkits->where('app_admin', '1');
        $this->mkits->where('app_akunting', '1');
        $this->mkits->where('status !=', '3');
        $this->mkits->where('dn_status !=', '1');
        $this->mkits->order_by('idPts', 'DESC');
        $query = $this->mkits->get();

        return $query;
    }
}
