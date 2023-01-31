<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Adminpo extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->mkits = $this->load->database('mkits', TRUE);
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'SCO MKITS';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('adminpo/data-sco', $data);
        $this->load->view('templates/footer');
    }

    public function listpts()
    {
        $data['title'] = 'List PTS';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('adminpo/data-pts', $data);
        $this->load->view('templates/footer');
    }

    public function get_ptsActual()
    {
        $this->load->model("m_mkits");
        $rows = $this->m_mkits->getPts();

        $data = array();
        $no = 1;

        foreach ($rows->result() as $r) {
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

    public function detailPts()
    {
        $id = $this->input->post('id');

        $header = $this->mkits->get_where('pts_header', ['idPts' => $id])->result_array();
        $footer = $this->mkits->get_where('pts_detail_aktual', ['idPts' => $id])->result_array();

        $output = '';

        foreach ($header as $h) {
            $output .= '
            <table class="table table-borderless" width="100%">
                <tr>
                    <th>ID PTS</th>
                    <td>:</td>
                    <td>' . $h["idPts"] . '</td>
                    <th>Customer</th>
                    <td>:</td>
                    <td>' . $h["customer_nama"] . '</td>
                </tr>
                <tr>
                    <th>Tgl PTS</th>
                    <td>:</td>
                    <td>' . $h["tgl_create"] . '</td>
                    <th>Tgl. Ambil</th>
                    <td>:</td>
                    <td>' . $h["tgl_ambil"] . '</td>
                </tr>
                <tr>
                    <th>Sales</th>
                    <td>:</td>
                    <td>' . $h["sales"] . '</td>
                    <th>Keterangan</th>
                    <td>:</td>
                    <td>' . $h["keterangan"] . '</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>:</td>
                    <td colspan="4">' . $h["alamat"] . '</td>
                </tr>
            </table>
            <hr>';
            $output .= '<table class="table table-bordered tbdetail" width="100%">
                <thead class="table-warning">
                    <tr>
                        <th>Model</th>
                        <th>Qty</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody class="table-info">';
            foreach ($footer as $f) {
                $output .= '<tr>
                            <td data-sort="true">' . $f["model"] . '</td>
                            <td>' . $f["qty_aktual"] . '</td>
                            <td>' . $f["ket"] . '</td>
                        </tr>';
            }
            $output .= '</tbody></table>';
        }
        echo $output;
    }

    public function getDatamwk($idlix)
    {
        $this->load->model("m_mkits");
        $mwk = $this->m_mkits->dataMwk($idlix);
        $data = array();

        foreach ($mwk->result() as $mk) {
            $data[] = array(
                'id'        => $mk->noso,
                'namacust'  => $mk->customer_nama,
                'totalhrg'  => $mk->uang,
                'status'    => $mk->status,
                'sales'     => $mk->sales,
                'keterangan'    => $mk->keterangan,
                'tgldelivery'   => date_format(date_create($mk->tgl_krm), "d/m/Y"),
                'tglorder'   => date_format(date_create($mk->tgl_po), "d/m/Y")
            );
        }
        print_r(json_encode($data));
    }

    public function detailCo()
    {
        $id = $this->input->post('id');
        $pt = $this->mkits->get_where('salesorder_hdr', ['noso' => $id])->result_array();


        $skus = $this->mkits->get_where('salesorder_dtl', ['noso' => $id])->result_array();

        $this->load->model("m_mkits");
        $total = $this->m_mkits->getTotal($id);
        $rw = $total->row_array();

        $output = '';

        foreach ($pt as $p) {
            $output .= '<div class="card">
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th>No.SCO</th>
                        <th>:</th>
                        <th>' . $p["noso"] . '</th>
                        <th>Sales</th>
                        <th>:</th>
                        <th>' . $p["sales"] . '</th>
                    </tr>
                    <tr>
                        <th>Tgl. SCO</th>
                        <th>:</th>
                        <th>' . $p["tgl_po"] . '</th>
                        <th>Tgl. Kirim (Plan)</th>
                        <th>:</th>
                        <th>' . $p["tgl_krm"] . '</th>
                    </tr>
                </table>
        </div></div></br>';
        }
        $output .= '<div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>SKU</th>
                        <th>Qty</th>
                    </tr>
                </thead>
                <tbody>';
        foreach ($skus as $sk) {
            $output .= "<tr>
                            <td>" . $sk['model'] . "</td>
                            <td>" . number_format($sk['qty'], 0, ".", ".") . "</td>
                        </tr>";
        }
        $output .= '</tbody>
        </table>';
        print_r($output);
    }

    public function poxb()
    {
        $data['title']  = 'PO XB';
        $data['user']   = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $data['pt']     = $this->db->get('tb_perusahaan')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('adminpo/po-xb', $data);
        $this->load->view('templates/footer');
    }
    
    public function exportpoxb()
    {
        $namapt         = $this->input->post('namapt');
        $nama           = $this->db->get_where('tb_perusahaan', ['id_perusahaan' => $namapt])->row_array();
        $tgls           = $this->input->post('tgls');

        $spreadsheet    = new Spreadsheet();
        $sheet          = $spreadsheet->getActiveSheet();

        $style_col = [ //setting untuk header
            'font' => ['bold' => true], // Set font nya jadi bold
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];

        $style_row = [ // setting untuk isi table
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];

        $sheet->setCellValue('A1', "Data PO Kalibaru " . $nama['nama_pt'] . (string)$tgls); // Set kolom A1 dengan tulisan "DATA SISWA"
        $sheet->mergeCells('A1:G1'); // Set Merge Cell pada kolom A1 sampai E1
        $sheet->getStyle('A1')->getFont()->setBold(true); // Set bold kolom A1

        $sheet->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
        $sheet->setCellValue('B3', "SKU"); // Set kolom B3 dengan tulisan "NIS"
        $sheet->setCellValue('C3', "QTY"); // Set kolom C3 dengan tulisan "NAMA"
        $sheet->setCellValue('D3', "No. PO"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
        $sheet->setCellValue('E3', "Tgl. PO"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('F3', "CUSTOMER"); // Set kolom E3 dengan tulisan "ALAMAT"

        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $sheet->getStyle('A3')->applyFromArray($style_col);
        $sheet->getStyle('B3')->applyFromArray($style_col);
        $sheet->getStyle('C3')->applyFromArray($style_col);
        $sheet->getStyle('D3')->applyFromArray($style_col);
        $sheet->getStyle('E3')->applyFromArray($style_col);
        $sheet->getStyle('F3')->applyFromArray($style_col);

        // $m = time(strtotime($tgls));

        // var_dump($m);
        // $tanggal = time();
        $this->load->model("m_adminpo");
        $dtx    = $this->m_adminpo->getExportdata($namapt, $tgls);

        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 4;

        foreach ($dtx->result() as $r) {
            $sheet->setCellValue('A' . $numrow, $no);
            $sheet->setCellValue('B' . $numrow, $r->sku_xb);
            $sheet->setCellValue('C' . $numrow, $r->qty_po);
            $sheet->setCellValue('D' . $numrow, $r->po_id);
            $sheet->setCellValue('E' . $numrow, $r->po_date);
            $sheet->setCellValue('F' . $numrow, $r->po_note);

            $sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('F' . $numrow)->applyFromArray($style_row);

            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
        }

        $sheet->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $sheet->getColumnDimension('B')->setWidth(30); // Set width kolom B
        $sheet->getColumnDimension('C')->setWidth(20); // Set width kolom C
        $sheet->getColumnDimension('D')->setWidth(20); // Set width kolom D
        $sheet->getColumnDimension('E')->setWidth(20); // Set width kolom E
        $sheet->getColumnDimension('F')->setWidth(65); // Set width kolom E

        $sheet->getDefaultRowDimension()->setRowHeight(-1); //auto height

        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE); //orientasi kertas

        // Set judul file excel nya
        $sheet->setTitle("Data PO Kalibaru");

        // Proses file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Data PO XB.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        
    }

    public function tambahpo($id)
    {
        $data['title']  = 'PO XB';
        $data['user']   = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $data['pt']     = $this->db->get('tb_perusahaan')->result_array();
        $data['bilom']  = $this->db->get('tb_bom')->result_array();

        $this->load->model("m_mkits");
        $data['header'] = $this->m_mkits->getsHeader($id)->row_array();
        $data['detail'] = $this->mkits->get_where('salesorder_dtl', ['noso' => $id])->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('adminpo/po-xbadd', $data);
        $this->load->view('templates/footer');
    }

    public function tambahpo_pts()
    {
        $a = $this->uri->segment(3);
        $b = $this->uri->segment(4);
        $id = $a . '/'. $b;
        
        $data['title']  = 'PO XB';
        $data['user']   = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $data['pt']     = $this->db->get('tb_perusahaan')->result_array();
        $data['bilom']  = $this->db->get('tb_bom')->result_array();

        $data['header'] = $this->mkits->get_where('pts_header', ['idPts' => $id])->row_array();
        $data['detail'] = $this->mkits->get_where('pts_detail', ['idPts' => $id])->result_array();

        // var_dump($data['detail']);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('adminpo/po-xbadds', $data);
        $this->load->view('templates/footer');
    }

    public function getSkuXb()
    {
        $id = $this->input->post('id');

        $kets = $this->db->get_where('tb_bom', ['id' => $id])->result_array();
        $data = array();

        foreach ($kets as $k) {
            $data = array(
                'harga' => $k['harga']
            );
        }
        print_r(json_encode($data));
    }
    
    public function saveHeader()
    {
        // var_dump($this->input->post());
        $id_pt  = $this->input->post('namapt');

        $nmpt   = $this->db->get_where('tb_perusahaan', ['id_perusahaan' => $id_pt])->row_array();
        $namapt = $nmpt['nama_pt'];

        $this->load->model("m_adminpo");
        $nopo   = $this->m_adminpo->getDataAkhir($namapt);

        // get No Po dari sini
        foreach ($nopo->result() as $np) {
            $idpo   = $np->idArr;
            $urutan = $idpo;
            $urutan++;
            $a      = "PO";
            $idpo   = $a . "-" . date('Y') . "/" . $namapt . "/" . sprintf("%03s", $urutan);
        }

        $data = [
            'po_id'             => $idpo,
            'po_date'           => date('Y-m-d'),
            'id_perusahaan'     => $id_pt,
            'po_delivery_date'  => $this->input->post('tglkrm'),
            'po_note'           => $this->input->post('keterangan'),
            'created_by'        => $this->input->post('nuser'),
            'acknowlege2'       => $this->input->post('ack2'),
            'acknowlege3'       => $this->input->post('ack3'),
            'acknowlege4'       => $this->input->post('ack4'),
            'acknowlege5'       => $this->input->post('ack5'),
            'noso'              => $this->input->post('sco')
        ];

        $this->db->insert('tb_poheader', $data);

        if (($this->input->post('sco')) != 'Non-SCO') {
            $noso = $this->input->post('sco');
            $this->mkits->set('status_dn', '1');
            $this->mkits->where('noso', $noso);
            $this->mkits->update('salesorder_hdr');
        }
        echo $idpo;
    }

    public function saveHeader_()
    {
        // var_dump($this->input->post());
        $id_pt  = $this->input->post('namapt');

        $nmpt   = $this->db->get_where('tb_perusahaan', ['id_perusahaan' => $id_pt])->row_array();
        $namapt = $nmpt['nama_pt'];

        $this->load->model("m_adminpo");
        $nopo   = $this->m_adminpo->getDataAkhir($namapt);

        // get No Po dari sini
        foreach ($nopo->result() as $np) {
            $idpo   = $np->idArr;
            $urutan = $idpo;
            $urutan++;
            $a      = "PO";
            $idpo   = $a . "-" . date('Y') . "/" . $namapt . "/" . sprintf("%03s", $urutan);
        }

        $data = [
            'po_id'             => $idpo,
            'po_date'           => date('Y-m-d'),
            'id_perusahaan'     => $id_pt,
            'po_delivery_date'  => $this->input->post('tglkrm'),
            'po_note'           => $this->input->post('keterangan'),
            'created_by'        => $this->input->post('nuser'),
            'acknowlege2'       => $this->input->post('ack2'),
            'acknowlege3'       => $this->input->post('ack3'),
            'acknowlege4'       => $this->input->post('ack4'),
            'acknowlege5'       => $this->input->post('ack5'),
            'noso'              => $this->input->post('sco')
        ];

        $this->db->insert('tb_poheader', $data);

        $noso = $this->input->post('sco');
        $this->mkits->set('dn_status', '1');
        $this->mkits->where('idPts', $noso);
        $this->mkits->update('pts_header');
        echo $idpo;
    }

    public function saveDetail()
    {
        $amount = $this->input->post('amount');
        $pajak  = ((11 / 100) * $amount);
        $data = [
            'po_id'     => $this->input->post('idpo'),
            'id_bom'    => $this->input->post('sku'),
            'qty_po'    => $this->input->post('qty'),
            'tax'       => $pajak,
            'price'     => $this->input->post('harga'),
            'amount'    => $this->input->post('amount'),
            'nourut'    => $this->input->post('nourut')
        ];

        $this->db->insert('tb_podetail', $data);
    }

    public function getPO($id)
    {
        $this->load->model("m_adminpo");
        $datapo = $this->m_adminpo->getpoxb($id);
        $data   = array();

        foreach ($datapo->result() as $da) {
            $data[] = array(
                'id_po'     => $da->po_id,
                'note'      => $da->po_note,
                'tglpo'    => $da->po_date,
                'tglkirim'  => date_format(date_create($da->po_delivery_date), "d-m-Y"),
                'qty'       => $da->qtys,
                'status'    => $da->status
            );
        }
        echo json_encode($data);
    }

    public function detailpoxb()
    {
        $uxer = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        
        $id = $this->input->post('id');
        $nopoxb = $id;
        $header = $this->db->get_where('tb_poheader', ['po_id' => $id])->result_array();

        $this->load->model("m_adminpo");
        $detail = $this->m_adminpo->getDetailSku($id);

        $this->load->model("m_adminpo");
        $sums = $this->m_adminpo->getSum($id)->row_array();

        $this->load->model("m_deen");
        $deen = $this->m_deen->sum_dn($nopoxb);

        $html = '';
        foreach ($header as $h) {
            if ($h['status'] == '0') {
                $statu = "On Process";
            } elseif ($h['status'] == '1') {
                $statu = "Half Complete";
            } else {
                $statu = "Complete";
            }
            $html .= '<table class="table table-borderless table-striped" width="100%">
                <tr>
                    <th>No. PO</th>
                    <td>:</td>
                    <td>' . $h['po_id'] . '</td>
                    <td></td>
                    <th>Keterangan</th>
                    <td>:</td>  
                    <td>' . $h["po_note"] . '</td>  
                </tr>
                <tr>
                    <th>Tgl PO</th>
                    <td>:</td>
                    <td>' . $h['po_date'] . '</td>
                    <td></td>
                    <th>Plan kirim</th>
                    <td>:</td>  
                    <td>' . date_format(date_create($h["po_delivery_date"]), "d/m/Y") . '</td>  
                </tr>
                <tr>
                    <th>Referensi</th>
                    <td>:</td>
                    <td>' . $h["noso"] . '</td>
                    <td></td>
                    <th>Status</th>
                    <td>:</td>
                    <td>' . $statu . '</td>
                </tr>
                <tr>
                    <th>Revisi</th>
                    <td>:</td>
                    <td colspan="5">' . 'Revisi-' . $h["revisi"] . '</td>
                </tr>
            </table>
            <hr>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" style="background-color: #FFEFD5">
                    <a class="nav-link active" id="mwk-mtab" data-toggle="tab" href="#tmwk" role="tab" aria-controls="mwk" aria-selected="true">Detail Item</a>
                </li>
                <li class="nav-item" style="background-color: #E6E6FA">
                    <a class="nav-link" id="mwm-mtab" data-toggle="tab" href="#tmwm" role="tab" aria-controls="mwm" aria-selected="false">Data DN</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">';
                if (($uxer['role_id'] == 7) || ($uxer['role_id'] == 1) || ($uxer['role_id'] == 11)) {
                    $html .= '
                    <div class="tab-pane fade show active" id="tmwk" role="tabpanel" aria-labelledby="mwk-mtab">
                        <table id="tbl_detal" class="table table-bordered tbl_detal">
                            <thead>
                                <tr>
                                    <th>SKU</th>
                                    <th>QTY</th>
                                    <th>Harga</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>';
                            foreach ($detail->result() as $d) {
                                $html .= '<tr>
                                    <td>' . $d->sku_xb . '</td>
                                    <td>' . $d->qty_po . '</td>
                                    <td>Rp. ' . number_format($d->price, 0, ".", ".") . '</td>
                                    <td style="text-align: right;">Rp. ' . number_format($d->amount, 0, ".", ".") . '</td>
                                </tr>';
                            }
                            $html .= '
                                <tr>
                                    <th>Total</th>
                                    <th>' . $sums['qty_po'] . '</th>
                                    <th>Rp. ' . number_format($sums['price'], 0, ".", ".") . '</th>
                                    <th style="text-align: right;">Rp. ' . number_format($sums['amount'], 0, ".", ".") . '</th>
                                </tr>
                                <tr>
                                    <th>Tax</th>
                                    <th colspan="3" style="text-align: right;">Rp. ' . number_format($sums['tax'], 0, ".", ".") . '</th>
                                </tr>
                                <tr>
                                    <th>Grand-Total</th>
                                    <th colspan="3" style="text-align: right;">Rp. ' . number_format($sums['tax'] + $sums['amount'], 0, ".", ".") . '</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="tmwm" role="tabpanel" aria-labelledby="mwm-mtab">
                        <table width="100%" class="table table_dn table-striped">
                            <thead>
                                <tr>
                                    <th>No. DN</th>
                                    <th>Tgl. DN</th>
                                    <th>Qty DN</th>
                                </tr>
                            </thead>
                            <tbody>';
                            if ($h['status'] != '0') {
                                foreach ($deen->result() as $dn) {
                                    $html .= '<tr>
                                    <td>' . $dn->dn_id . '</td>
                                    <td>' . date("d/m/Y", $dn->dn_create_date) . '</td>
                                    <td>' . $dn->qty_dn . '</td>
                                </tr>';
                                }
                            } else {
                            $html .= '<tr>
                                    <td colspan="3">Belum ada DN yang dibuat :)</td>
                                </tr>';
                            }
                            $html .= '</tbody>
                        </table>
                    </div>';
                } else {
                    $html .= '
                    <div class="tab-pane fade show active" id="tmwk" role="tabpanel" aria-labelledby="mwk-mtab">
                        <table id="tbl_detal" class="table table-bordered tbl_detal">
                            <thead>
                                <tr>
                                    <th>SKU</th>
                                    <th>QTY</th>
                                </tr>
                            </thead>
                            <tbody>';
                            foreach ($detail->result() as $d) {
                                $html .= '<tr>
                                    <td>' . $d->sku_xb . '</td>
                                    <td>' . $d->qty_po . '</td>
                                </tr>';
                            }
                            $html .= '
                                <tr>
                                    <th>Total</th>
                                    <th>' . $sums['qty_po'] . '</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="tmwm" role="tabpanel" aria-labelledby="mwm-mtab">
                        <table width="100%" class="table table_dn table-striped">
                            <thead>
                                <tr>
                                    <th>No. DN</th>
                                    <th>Tgl. DN</th>
                                    <th>Qty DN</th>
                                </tr>
                            </thead>
                            <tbody>';
                            if ($h['status'] != '0') {
                                foreach ($deen->result() as $dn) {
                                    $html .= '<tr>
                                    <td>' . $dn->dn_id . '</td>
                                    <td>' . date("d/m/Y", $dn->dn_create_date) . '</td>
                                    <td>' . $dn->qty_dn . '</td>
                                </tr>';
                                }
                            } else {
                            $html .= '<tr>
                                    <td colspan="3">Belum ada DN yang dibuat :)</td>
                                </tr>';
                            }
                            $html .= '</tbody>
                        </table>
                    </div>';
                }
            $html .='</div>';
        }

        print_r($html);
    }
    public function printpdf($id)
    {
        $a = $this->uri->segment(3);
        $b = $this->uri->segment(4);
        $c = $this->uri->segment(5);

        $idpo = $a . '/' . $b . '/' . $c;
        $data['poheader']   = $this->db->get_where('tb_poheader', ['po_id' => $idpo])->row_array();

        $this->load->model("m_adminpo");
        $data['podetail']   = $this->m_adminpo->getDetailSku($idpo);
        $data['sums']       = $this->m_adminpo->getSum($idpo)->row_array();

        $this->load->library("Pdf");

        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = $a . $b . $c . ".pdf";
        $this->pdf->load_view('adminpo/laporan_pdf', $data);
    }

    public function completesco()
    {
        $sco = $this->input->post('sco');

        $this->mkits->set('status_dn', '1');
        $this->mkits->where('noso', $sco);
        $this->mkits->update('salesorder_hdr');
    }

    public function completepts()
    {
        $nobl = $this->input->post('sco');

        $this->mkits->set('status_dn', '2');
        $this->mkits->where('idPts', $nobl);
        $this->mkits->update('pts_header');
    }

    public function editpoxb()
    {
        $a = $this->uri->segment(3);
        $b = $this->uri->segment(4);
        $c = $this->uri->segment(5);
        $idpo = $a . '/' . $b . '/' . $c;

        $data['title']  = 'PO XB';
        $data['user']   = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $data['header'] = $this->db->get_where('tb_poheader', ['po_id' => $idpo])->row_array();

        $this->load->model("m_adminpo");
        $data['details'] = $this->m_adminpo->getsdetailpoxb($idpo);

        $data['jums']   = count($data['details']->result_array());

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('adminpo/po-xbedit', $data);
        $this->load->view('templates/footer');
    }

    public function saveEdit()
    {
        var_dump($this->input->post());
        $idpo = $this->input->post('idpo');

        $rev = $this->db->get_where('tb_poheader', ['po_id' => $idpo])->row_array();
        $revs = $rev['revisi'];

        $data = [
            'po_delivery_date'  => $this->input->post('tglkrm'),
            'po_note'       => $this->input->post('keterangan'),
            'acknowlege2'   => $this->input->post('ack2'),
            'acknowlege3'   => $this->input->post('ack3'),
            'acknowlege4'   => $this->input->post('ack4'),
            'acknowlege5'   => $this->input->post('ack5'),
            'revisi'        => $revs + 1,
            'tgl_revisi'    => time(),
            'revisiby'      => $this->input->post('nuser')
        ];
        $this->db->where('po_id', $idpo);
        $this->db->update('tb_poheader', $data);
    }

    public function saveEdit_dtl()
    {
        var_dump($this->input->post());
        $idpo   = $this->input->post('idpo');
        $iditem = $this->input->post('iditem');

        $amount = $this->input->post('amount');
        $pajak  = ((11 / 100) * $amount);

        $data = [
            'qty_po'    => $this->input->post('qty'),
            'price'     => $this->input->post('harga'),
            'tax'       => $pajak,
            'amount'    => $this->input->post('amount')
        ];

        $this->db->where('id', $iditem);
        $this->db->update('tb_podetail', $data);
    }

    public function refreshtable()
    {
        $nopoxb = $this->input->post('id');

        $this->load->model("m_deen");
        $sumx   = $this->m_deen->sum_poxb($nopoxb)->row_array();
        $sumy   = $this->m_deen->sum_dn($nopoxb)->row_array();

        $resul = $sumx['qty_poxb'] - $sumy['qty_dn'];
        if ($resul == '0') { //complete
            $this->db->set('status', '2');
            $this->db->where('po_id', $nopoxb);
            $this->db->update('tb_poheader');
        } else if ($resul < $sumx['qty_poxb']) {
            $this->db->set('status', '1');
            $this->db->where('po_id', $nopoxb);
            $this->db->update('tb_poheader');
        } 
        
        var_dump($resul);
        var_dump($sumx['qty_poxb']);
        var_dump($sumy['qty_dn']);
    }
    public function manualPo()
    {
        $data['title']  = 'PO XB';
        $data['user']   = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $data['pt']     = $this->db->get('tb_perusahaan');
        $data['bilom']  = $this->db->get('tb_bom')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('adminpo/po-xbaddManual', $data);
        $this->load->view('templates/footer');
    }
    
    public function cariSku()
    {
        $searchSku = $this->input->post('searchSku');

        if ($searchSku == NULL) {
            $this->db->select('*');
            $this->db->from('tb_bom');
            $this->db->order_by('sku_xb', 'ASC');
            $this->db->limit(15);
        } else {
            $this->db->select('*');
            $this->db->from('tb_bom');
            $this->db->like('sku_xb', $this->input->post('searchSku'));
            $this->db->order_by('sku_xb', 'ASC');
            $this->db->limit(15);
        }

        $data = array();
        $query = $this->db->get();

        foreach ($query->result() as $q) {
            $data[] = array("id" => $q->id, "text" => $q->sku_xb . " | " . $q->keterangan);
        }

        echo json_encode($data);
    }

    public function cariHarga()
    {
        $sku = $this->input->post('sku');
        // var_dump($this->input->post('sku')); die();

        $harga = $this->db->get_where('tb_bom', ['id' => $sku]);
        $data = [];
        foreach ($harga->result() as $r) {
            array_push($data, $r->harga);
        }

        echo json_encode($data);
    }
}
