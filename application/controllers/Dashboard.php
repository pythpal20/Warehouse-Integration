<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model("m_dashboard");
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model("m_bom");
        $jlh = $this->m_bom->getAllbom();
        $data['jlh'] = count($jlh->result_array());
        $data['qpo'] = $this->db->count_all_results('tb_poheader');

        $this->db->like('status', '0');
        $this->db->from('tb_mutasi');
        $data['jumlah_mutasi'] = $this->db->count_all_results();

        $this->db->like('dn_status', '0');
        $this->db->from('tb_dn_header');
        $data['sdn'] = $this->db->count_all_results();

        $data['grafone'] = $this->m_dashboard->getDatamutasiminus();



        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('index', $data);
        $this->load->view('templates/footer');
    }
    public function myProfil()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('nohp', 'No HP', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
            'valid_email' => 'email format harus benar'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'trim|min_length[6]|matches[password2]', [
            'matches' => 'Password tidak sama!',
            'min_length' => 'Password terlalu pendek, min 6 Karakter'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Dashboard';
            $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
            $data['profil'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('myProfil', $data);
            $this->load->view('templates/footer');
        } else {
            // var_dump($this->input->post());
            // die();
            $id = $this->input->post('id');
            $nama = $this->input->post('nama');
            $email = $this->input->post('email');
            $nohp = $this->input->post('nohp');
            $password = $this->input->post('password1');

            if (isset($password)) {
                $data = [
                    'email' => htmlspecialchars($email),
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                    'user_nama' => htmlspecialchars($nama),
                    'user_nohp' => htmlspecialchars($nohp),
                ];
                $this->db->set($data);
                $this->db->where('user_id', $id);
                $this->db->update('tb_user');
            } else {
                $data = [
                    'email' => htmlspecialchars($email),
                    'user_nama' => htmlspecialchars($nama),
                    'user_nohp' => htmlspecialchars($nohp),
                ];
                $this->db->set($data);
                $this->db->where('user_id', $id);
                $this->db->update('tb_user');
            }

            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil</strong> User baru sudah ditambahkan.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>'
            );
            redirect('dashboard');
        }
    }
}
