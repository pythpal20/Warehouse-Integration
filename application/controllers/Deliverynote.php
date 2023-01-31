<?php

use PHPUnit\Util\Json;

defined('BASEPATH') or exit('No direct script access allowed');

class Deliverynote extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->mkits = $this->load->database('mkits', TRUE);
        is_logged_in();
    }

    public function draft()
    {
        $data['title'] = 'Delivery Note (Draft)';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('deliverynote/dn-draft', $data);
        $this->load->view('templates/footer');
    }

    public function pickticket()
    {
        $data['title'] = 'Pick Ticket Done';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('deliverynote/pt-done', $data);
        $this->load->view('templates/footer');
    }

    public function ptsact()
    {
        $data['title'] = 'PT Sample';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('deliverynote/pts-done', $data);
        $this->load->view('templates/footer');
    }

    public function getbl($id)
    {
        $this->load->model("m_mkits");
        $nobl = $this->m_mkits->getBLs($id);
        $data = array();

        foreach ($nobl->result() as $nb) {
            $data[] = array(
                'nobl'      => $nb->no_bl,
                'customer'  => $nb->customer_nama,
                'dd'        => date_format(date_create($nb->tgl_delivery), "d/m/Y H:i"),
                'kenek'     => $nb->sopir
            );
        }
        echo json_encode($data);
    }

    public function getPts()
    {
        $rows = $this->mkits->get_where('pts_header', ['dn_status' => '1']);
        $data = array();
        $no= 1;

        foreach($rows->result() AS $r){
            $data[] = array(
                'no'    => $no++,
                'id'    => $r->idPts,
                'customer'  => $r->customer_nama,
                'sales' => $r->sales,
                'tglambil'  => $r->tgl_ambil,
                'tglcreate'  => date_format(date_create($r->tgl_create), "Y-m-d"),
                'status'    => $r->status
            );
        }
        print_r(json_encode($data));
    }

    public function detailbL()
    {
        $id     = $this->input->post('id');
        $noco   = str_replace("BL", "CO", $id);

        $this->load->model('m_mkits');
        $header     = $this->m_mkits->get_header($noco)->row_array();
        $details    = $this->m_mkits->get_detail($noco);

        $output     = '';
        $output    .= '<table class="table table-bordered" width="100%">
            <tr>
                <th>No. PO</th>
                <th>' . $header["No_Co"] . '</th>
            </tr>
            <tr>
                <th>No. SCO</th>
                <th>' . $header["noso"] . '</th>
            </tr>
            <tr>
                <th>No. Invoice</th>
                <th>' . $header["no_fa"] . '</th>
            </tr>
            <tr>
                <th>Customer</th>
                <th>' . $header["customer_nama"] . '</th>
            </tr>
            <tr>
                <th>Kota</th>
                <th>' . $header["wilayah_nama"] . '</th>
            </tr>
            <tr>
                <th>Kendaraan</th>
                <th>' . $header["jenis"] . '<i class="fas fa-fw fa-arrow-right"></i>' . $header["nopol"] . '</th>
            </tr>
        </table>
        <table class="table table-bordered table-hover tb_dtls" width="100%">
            <thead>
                <tr>
                    <th>SKU</th>
                    <th>Qty. Kirim</th>
                    <th>Qty. Diterima</th>
                </tr>
            </thead>
            <tbody>';
        foreach ($details->result() as $dt) {
            $output .= '
                    <tr>
                        <td>' . $dt->model . '</td>
                        <td>' . number_format($dt->qty_request, 0, ".", ".") . '</td>
                        <td>' . number_format($dt->qty_kirim, 0, ".", ".") . '</td>
                    </tr>';
        }
        $output .= '</tbody></table>';
        print_r($output);
    }

    public function makedn($id)
    {
        $noco = str_replace("BL", "CO", $id);
        $data['header'] = $this->mkits->get_where('customerorder_hdr_delivery', ['No_Co' => $noco])->row_array();
        $data['sku'] = $this->mkits->get_where('customerorder_dtl_delivery', ['No_Co' => $noco])->result_array();

        $data['title'] = 'Delivery Note (Create)';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('deliverynote/dn-create', $data);
        $this->load->view('templates/footer');
    }

    public function makedns()
    {
        // get id FROM URL/ Uri
        $a = $this->uri->segment(3);
        $b = $this->uri->segment(4);

        // join uri
        $id = $a . '/' . $b; 

        $data['header'] = $this->mkits->get_where('pts_header', ['idPts' => $id])->row_array();
        $data['sku'] = $this->mkits->get_where('pts_detail_aktual', ['idPts' => $id])->result_array();

        $data['title'] = 'Delivery Note (Create)';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('deliverynote/dn-creates', $data);
        $this->load->view('templates/footer');
    }
    public function createDns()
    {
        // var_dump($this->input->post());
        $pt     = $this->input->post('xpt');
        $id_pt  = $this->input->post('idpt');

        $this->load->model("m_deen");
        $nopo = $this->m_deen->getUrutan($id_pt);

        $this->mkits->set('dn_status', '1');
        $this->mkits->where('no_bl', $this->input->post('nobl'));
        $this->mkits->update('customerorder_hdr_delivery');

        foreach ($nopo->result() as $np) {
            $urutan   = $np->idArr;
            $urutan = $urutan + 1;
            $huruf = "DN";
            $idPo = $huruf . '-' . $pt . date('ymd') . '-' . sprintf("%04s", $urutan);
        }

        $data = [
            'dn_id'             => $idPo,
            'dn_create_date'    => time(),
            'dn_issued_by'      => $this->input->post('uname'),
            'dn_status'         => '0',
            'id_perusahaan'     => $this->input->post('idpt'),
            'no_bl'             => $this->input->post('nobl'),
            'tgl_kirim'         => $this->input->post('tglkirim'),
            'enduser'           => $this->input->post('enduser'),
            'id_poxb'           => $this->input->post('poxb'),
            'no_sj'             => $this->input->post('surjat')
        ];


        $this->db->insert('tb_dn_header', $data);

        echo $idPo;
    }
    
    public function createDnx()
    {
        // var_dump($this->input->post());
        $pt     = $this->input->post('xpt');
        $id_pt  = $this->input->post('idpt');

        $this->load->model("m_deen");
        $nopo = $this->m_deen->getUrutan($id_pt);

        $this->mkits->set('dn_status', '2');
        $this->mkits->where('idPts', $this->input->post('nobl'));
        $this->mkits->update('pts_header');

        foreach ($nopo->result() as $np) {
            $urutan   = $np->idArr;
            $urutan = $urutan + 1;
            $huruf = "DN";
            $idPo = $huruf . '-' . $pt . date('ymd') . '-' . sprintf("%04s", $urutan);
        }

        $data = [
            'dn_id'             => $idPo,
            'dn_create_date'    => time(),
            'dn_issued_by'      => $this->input->post('uname'),
            'dn_status'         => '0',
            'id_perusahaan'     => $this->input->post('idpt'),
            'no_bl'             => $this->input->post('nobl'),
            'tgl_kirim'         => $this->input->post('tglkirim'),
            'enduser'           => $this->input->post('enduser'),
            'id_poxb'           => $this->input->post('poxb'),
            'no_sj'             => $this->input->post('surjat')
        ];


        $this->db->insert('tb_dn_header', $data);

        echo $idPo;
    }

    public function dn_detail()
    {
        $amount = $this->input->post('amt');
        $pajak  = ((11 / 100) * $amount);

        $data = [
            'dn_id'         => $this->input->post('idpo'),
            'id_bom'        => $this->input->post('skus'),
            'qty'           => $this->input->post('qty'),
            'item_price'    => $this->input->post('prc'),
            'item_tax'      => $pajak,
            'amount'        => $this->input->post('amt'),
            'note'          => $this->input->post('ket'),
            'urutan'        => $this->input->post('urutan')
        ];

        $this->db->insert('tb_dn_detail', $data);
    }

    public function getDataDN($id)
    {
        $this->load->model("m_deen");
        $dns = $this->m_deen->headerDn($id);
        $data = array();

        foreach ($dns->result() as $d) {
            $data[] = array(
                'id'    => $d->dn_id,
                'date'  => date("d/m/Y", $d->dn_create_date),
                'bl'    => $d->no_bl,
                'cust'  => $d->enduser,
                'tglkrm' => $d->tgl_kirim,
                'user'  => explode(" ", $d->dn_issued_by)[0],
                'poxb'  => $d->id_poxb
            );
        }
        print_r(json_encode($data));
    }

    public function detailDn()
    {
        $uxer = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

        $id = $this->input->post('id');

        $header = $this->db->get_where('tb_dn_header', ['dn_id' => $id])->result_array();
        $detail = $this->db->get_where('tb_dn_detail', ['dn_id' => $id, 'qty >' => '0'])->result_array();

        $this->load->model("m_deen");
        $sums = $this->m_deen->getsums($id)->row_array();;

        $output = '';

        foreach ($header as $h) {
            $idpt = $h["id_perusahaan"];
            $pt = $this->db->get_where('tb_perusahaan', ['id_perusahaan' => $idpt])->row_array();
            $output .= '<table class="table table-borderless table-striped">
            <tr>
                <th>No. DN</th>
                <th>:</th>
                <th>' . $h["dn_id"] . '</th>
                <th>No. PO XB</th>
                <th>:</th>
                <th>' . $h["id_poxb"] . '</th>
            </tr>
            <tr>
                <th>PT</th>
                <th>:</th>
                <th>' . $pt["atasnama"] . '</th>
                <th>End User</th>
                <th>:</th>
                <th>' . $h["enduser"] . '</th>
            </tr>
            <tr>
                <th>Tgl. DN</th>
                <th>:</th>
                <th>' . date("Y-m-d", $h["dn_create_date"]) . '</th>
                <th>Tgl. Kirim</th>
                <th>:</th>
                <th>' . $h["tgl_kirim"] . '</th>
            </tr>
            <tr>
                <th>No. BL</th>
                <th>:</th>
                <th>' . $h["no_bl"] . '</th>
                <th>Issued By</th>
                <th>:</th>
                <th>' . $h["dn_issued_by"] . '</th>
            </tr>
        </table>';
        }
        if ($uxer['role_id'] != 3) {
            $output .= '
        <table class="table table-bordered tbdetail">
            <thead>
                <tr>
                    <th>Model</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>';
            foreach ($detail as $d) {
                $brg = $this->db->get_where('tb_bom', ['id' => $d["id_bom"]])->row_array();
                $output .= '<tr>
                <td>' . $brg["sku_xb"] . '</td>
                <td>' . number_format($d["qty"], 0, ".", ".") . '</td>
                <td>Rp. ' . number_format($d["item_price"], 0, ".", ".") . '</td>
                <td style="text-align: right">Rp. ' . number_format($d["amount"], 0, ".", ".") . '</td>
            </tr>';
            }
            $output .= '</tbody>
            <tfoot>
                <tr>
                    <th>Total</th>
                    <th>' . number_format($sums["qty"], 0, ".", ".") . '</th>
                    <th>Rp. ' . number_format($sums["item_price"], 0, ".", ".") . '</th>
                    <th style="text-align: right">Rp. ' . number_format($sums["amount"], 0, ".", ".") . '</th>
                </tr>
                <tr>
                    <th>Tax</th>
                    <th style="text-align: right" colspan="3">Rp. ' . number_format($sums["item_tax"], 0, ".", ".") . '</th>
                </tr>
                <tr>
                    <th>Gran Total</th>
                    <th style="text-align: right" colspan="3">Rp. ' . number_format($sums["item_tax"] + $sums["amount"], 0, ".", ".") . '</th>
                </tr>
            </tfoot>
        </table>';
        } else {
            $output .= '
        <table class="table table-bordered tbdetail">
            <thead>
                <tr>
                    <th>Model</th>
                    <th>Qty</th>
                </tr>
            </thead>
            <tbody>';
            foreach ($detail as $d) {
                $brg = $this->db->get_where('tb_bom', ['id' => $d["id_bom"]])->row_array();
                $output .= '<tr>
                <td>' . $brg["sku_xb"] . '</td>
                <td>' . number_format($d["qty"], 0, ".", ".") . '</td>
            </tr>';
            }
            $output .= '</tbody>
            <tfoot>
                <tr>
                    <th>Total</th>
                    <th>' . number_format($sums["qty"], 0, ".", ".") . '</th>
                </tr>
            </tfoot>
        </table>';
        }
        echo $output;
    }

    public function printpo($id)
    {
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model("m_deen");
        $data['header'] = $this->m_deen->getdnHeader($id)->row_array();
        $data['detail'] = $this->m_deen->getdnDetail($id)->result_array();
        $data['sums']   = $this->m_deen->getsums($id)->row_array();
        $this->load->library("pdf");

        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->filename = $id . ".pdf";
        $this->pdf->load_view('deliverynote/dn_download', $data);
    }

    public function unduhpo($id)
    {
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model("m_deen");
        $data['header'] = $this->m_deen->getdnHeader($id)->row_array();
        $data['detail'] = $this->m_deen->getdnDetail($id)->result_array();
        $data['sums']   = $this->m_deen->getsums($id)->row_array();
        $this->load->library("pdf");

        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->filename = $id . ".pdf";
        $this->pdf->load_view('deliverynote/dn_download_gudang', $data);
    }

    public function confirmdn()
    {
        $users  = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model("m_deen");

        $id     = $this->input->post('dnid');
        // $noref  = $this->input->post('noref');
        $nopoxb = $this->input->post('nopox');

        $sumx   = $this->m_deen->sum_poxb($nopoxb)->row_array();
        $sumy   = $this->m_deen->sum_dn($nopoxb)->row_array();

        $resul = $sumx['qty_poxb'] - $sumy['qty_dn'];
        if ($resul == '0') {
            $this->db->set('status', '2');
            $this->db->where('po_id', $nopoxb);
            $this->db->update('tb_poheader');
        } else if ($resul < $sumx['qty_poxb']) {
            $this->db->set('status', '1');
            $this->db->where('po_id', $nopoxb);
            $this->db->update('tb_poheader');
        }

        $data = [
            'dn_status'     => '1',
            'confirmed_by'  => $users["user_nama"],
            'confirmed_date' => time()
        ];

        $this->db->set($data);
        $this->db->where('dn_id', $id);
        $this->db->update('tb_dn_header');
    }

    public function success()
    {
        $data['title'] = 'DN Payment List';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('deliverynote/dn-success', $data);
        $this->load->view('templates/footer');
    }

    public function dnComplete($id)
    {
        $this->load->model("m_deen");
        $dnc    = $this->m_deen->headerDnc($id);
        $data   = array();

        foreach ($dnc->result() as $d) {
            $data[] = array(
                'id'    => $d->dn_id,
                'date'  => date("d/m/Y", $d->dn_create_date),
                'bl'    => $d->no_bl,
                'cust'  => $d->enduser,
                'tglkrm' => $d->tgl_kirim,
                'user'  => explode(" ", $d->dn_issued_by)[0],
                'poxb'  => $d->id_poxb,
                'status'=> $d->dn_status
            );
        }
        print_r(json_encode($data));
    }

    public function completBL() {
        $nobl = $this->input->post('nobl');

        $this->mkits->set('dn_status', '1');
        $this->mkits->where('no_bl', $nobl);
        $this->mkits->update('customerorder_hdr_delivery');
    }
}
