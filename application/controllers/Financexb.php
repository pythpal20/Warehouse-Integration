<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Financexb extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->mkits = $this->load->database('mkits', TRUE);
        is_logged_in();
    }

    public function dnlist()
    {
        $this->form_validation->set_rules('dnid', 'ID DN', 'trim|required');
        $this->form_validation->set_rules('tglb', 'Tgl Setoran', 'trim|required');
        $this->form_validation->set_rules('nomb', 'Nominal', 'trim|required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'List DN';
            $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('financexb/dnlist', $data);
            $this->load->view('templates/footer');
        } else {
            $id     = $this->input->post('dnid');
            $tgl    = $this->input->post('tglb');
            $uang   = $this->input->post('nomb');
            $ref    = $this->input->post('norf');
            $user   = $this->input->post('nuser');

            $this->load->model("m_deen");
            $rows   = $this->m_deen->getsums($id)->row_array();
            $amount = $rows['amount'];
            $tax    = $rows['item_tax'];

            $cols   = $this->m_deen->sumPayment($id)->row_array();
            $tot    = $cols['nom_payment'] + $uang;

            $total      = $amount + $tax;
            $selisih    = $total - $tot;


            $data = [
                'id_payment'    => $this->input->post('code'),
                'dn_id'         => $id,
                'nom_payment'   => $uang,
                'reference'     => $ref,
                'payment_date'  => $tgl,
                'input_date'    => time(),
                'inputby'       => $user
            ];

            if ($selisih == 0) {
                $this->db->set('dn_status', '3');
                $this->db->where('dn_id', $id);
                $this->db->update('tb_dn_header');

                $this->db->insert('tb_payment_received', $data);
            } elseif ($selisih > 0) {
                $this->db->set('dn_status', '2');
                $this->db->where('dn_id', $id);
                $this->db->update('tb_dn_header');

                $this->db->insert('tb_payment_received', $data);
            }

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pembayaran baru ditambahkan!</div>');
            redirect('financexb/dnlist');
        }
    }

    public function dataDN($id)
    {
        $this->load->model("m_deen");
        $dnc    = $this->m_deen->dataDn_payment($id);
        $data   = array();

        foreach ($dnc->result() as $d) {
            $data[] = array(
                'id'        => $d->dn_id,
                'date'      => date("d/m/Y", $d->dn_create_date),
                'bl'        => $d->no_bl,
                'tglkrm'    => $d->tgl_kirim,
                'user'      => explode(" ", $d->dn_issued_by)[0],
                'poxb'      => $d->id_poxb,
                'status'    => $d->dn_status,
                'nomawal'   => $d->nilai_awal + $d->nilai_tax,
                'nomakhir'  => $d->nilai_akhir
            );
        }
        print_r(json_encode($data));
    }

    public function paidDN($id)
    {
        $this->load->model("m_deen");
        $dnp    = $this->m_deen->dataDn_paid($id);
        $data   = array();

        foreach ($dnp->result() as $d) {
            $data[] = array(
                'id'        => $d->dn_id,
                'date'      => date("d/m/Y", $d->dn_create_date),
                'bl'        => $d->no_bl,
                'tglkrm'    => $d->tgl_kirim,
                'user'      => explode(" ", $d->dn_issued_by)[0],
                'poxb'      => $d->id_poxb,
                'status'    => $d->dn_status,
                'nomawal'   => $d->nilai_awal + $d->nilai_tax,
                'nomakhir'  => $d->nilai_akhir
            );
        }
        print_r(json_encode($data));
    }

    public function detailDn()
    {
        $uxer = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

        $id = $this->input->post('id');

        $header = $this->db->get_where('tb_dn_header', ['dn_id' => $id])->result_array();
        $detail = $this->db->get_where('tb_dn_detail', ['dn_id' => $id])->result_array();

        $this->load->model("m_deen");
        $sums = $this->m_deen->getsums($id)->row_array();

        $pay = $this->db->get_where('tb_payment_received', ['dn_id' =>$id])->result_array();

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
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" style="background-color: #FFEFD5">
                    <a class="nav-link active" id="mwk-mtab" data-toggle="tab" href="#tmwk" role="tab" aria-controls="mwk" aria-selected="true">Detail Item</a>
                </li>
                <li class="nav-item" style="background-color: #E6E6FA">
                    <a class="nav-link" id="mwm-mtab" data-toggle="tab" href="#tmwm" role="tab" aria-controls="mwm" aria-selected="false">Data Pembayaran</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="tmwk" role="tabpanel" aria-labelledby="mwk-mtab">
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
                    </table>
                </div>
                <div class="tab-pane fade" id="tmwm" role="tabpanel" aria-labelledby="mwm-mtab">
                    <table class="table table-bordered tbpayments" width="100%">
                        <thead>
                            <tr>
                                <th>Payment Date</th>
                                <th>Nominal</th>
                                <th>User</th>
                            </tr>
                        </thead>
                        <tbody>';
                        foreach($pay as $p) {
                            $output .='<tr>
                                <td>' . $p["payment_date"] . '</td>
                                <td>Rp. ' . number_format($p["nom_payment"], 0, ".", ".") . '</td>
                                <td>' . $p["inputby"] . '</td>
                            </tr>';
                        }
                        $output .='</tbody>
                    </table>
                </div>
            </div>';
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

    public function paymentcomplete()
    {
        $data['title'] = 'DN (Complete Payment)';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('financexb/dnlist_paid', $data);
        $this->load->view('templates/footer');
    }
}
