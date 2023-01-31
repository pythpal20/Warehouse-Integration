<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bofmat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }
    public function index()
    {
        //tampilkan tabel Bill Of Material
        $data['title'] = 'Bill Of Material';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $data['menux'] = $this->db->get('user_menu')->result_array();
        // echo 'Selamat datang ' . $data['user']['nama_lengkap'] . ' di FP Rewards';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('bofmat/jabu', $data);
        $this->load->view('templates/footer');
    }

    public function addNew()
    {
        $this->form_validation->set_rules('skua', 'SKU MK', 'trim|required');
        $this->form_validation->set_rules('skub', 'SKU XB', 'trim|required');
        $this->form_validation->set_rules('harga', 'Harga', 'trim|required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Bill Of Material';
            $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('bofmat/form-baru', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'id'            => $this->input->post('code'),
                'sku_mk'        => $this->input->post('skua'),
                'sku_xb'        => $this->input->post('skub'),
                'harga'         => $this->input->post('harga'),
                'keterangan'    => $this->input->post('keterangan'),
                'status'        => '1',
                'created_by'    => $this->input->post('useri'),
                'created_date'  => time()
            ];

            $this->db->insert('tb_bom', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">B.O.M baru ditambahkan!</div>');
            redirect('bofmat');
        }
    }

    public function editBom($id = NULL)
    {
        $this->form_validation->set_rules('skua', 'SKU MK', 'trim|required');
        $this->form_validation->set_rules('skub', 'SKU XB', 'trim|required');
        $this->form_validation->set_rules('harga', 'Harga', 'trim|required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Bill Of Material';
            $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

            $data['bom'] = $this->db->get_where('tb_bom', ['id' => $id])->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('bofmat/form-edit', $data);
            $this->load->view('templates/footer');

        } else {
            $code = $this->input->post('code');
            $data = array(
                'sku_mk'        => $this->input->post('skua'),
                'sku_xb'        => $this->input->post('skub'),
                'harga'         => $this->input->post('harga'),
                'keterangan'    => $this->input->post('keterangan')
            );

            $this->load->model("m_bom");
            $this->m_bom->updateBom($data, $code);

            $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">B.O.M telah diedit!</div>');
            redirect('bofmat');
        }
    }

    public function getBomList()
    {
        $this->load->model("m_bom");
        $bom = $this->m_bom->getAllbom();
        $data = array();
        $no = 1;

        foreach ($bom->result() as $b) {
            $data[] = array(
                'no' => $no++,
                'id' => $b->id,
                'skumk' => $b->sku_mk,
                'skuxb' => $b->sku_xb,
                'harga' => $b->harga,
                'tgl'   => date('d/m/Y', $b->created_date)
            );
        }

        print_r(json_encode($data));
    }

    public function getsku()
    {
        $search = $this->input->post('searchNama');

        $this->load->model("m_mkits");
        $sku = $this->m_mkits->getdataSku($search);
        $data = array();

        foreach ($sku->result() as $s) {
            $data[] = array(
                "id" => $s->model,
                "text" => $s->model
            );
        }
        echo json_encode($data);
    }
}
