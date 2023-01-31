<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }
    
    public function activeUser()
    {
        //view halaman data user aktif
        $data['title'] = 'User Active';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/user-active', $data);
        $this->load->view('templates/footer');
    }
    
    public function nonactiveUser()
    {
        $data['title'] = 'User Deleted';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
    
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/user-nonaktif', $data);
        $this->load->view('templates/footer');
    }

    public function userActive()
    {
        //ambil data user aktif dalam bentuk json
        $this->load->model("m_user");
        $user = $this->m_user->getuserActive();
        $data = array();

        $no = 1;

        foreach ($user->result() as $rs) {
            $data[]  = array(
                'no' => $no++,
                'email' => $rs->email,
                'nama' => $rs->user_nama,
                'nohp' => $rs->user_nohp,
                'tgl_registrasi' => date('d M Y', $rs->date_created),
                'role_id' => $rs->role_id,
                'role_name' => $rs->role,
                'id' => $rs->user_id . "|" . $rs->role_id
            );
        }
        print_r(json_encode($data));
    }
    public function usernonActive()
    {
        //ambil data user aktif dalam bentuk json
        $this->load->model("m_user");
        $user = $this->m_user->getusernonActive();
        $data = array();

        $no = 1;

        foreach ($user->result() as $rs) {
            $data[]  = array(
                'no' => $no++,
                'email' => $rs->email,
                'nama' => $rs->user_nama,
                'nohp' => $rs->user_nohp,
                'tgl_registrasi' => date('d M Y', $rs->date_created),
                'role_id' => $rs->role_id,
                'role_name' => $rs->role,
                'id' => $rs->user_id . "|" . $rs->role_id
            );
        }
        print_r(json_encode($data));
    }

    public function addUser()
    {
        //tambahkan user baru
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tb_user.email]', [
            'is_unique' => 'Email ini sudah terdaftar!',
            'valid_email' => 'format harus benar!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]', [
            'matches' => 'Password tidak sama!',
            'min_length' => 'Password terlalu pendek, min 6 Karakter'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
        $this->form_validation->set_rules('nohp', 'No. HP', 'required|trim');
        $this->form_validation->set_rules('userRole', 'User Role', 'required');


        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Add User';
            $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
            $data['role'] = $this->db->get('user_role')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/tambah-user', $data);
            $this->load->view('templates/footer');
        } else {
            $nama = $this->input->post('nama');
            $email = $this->input->post('email');
            $nohp = $this->input->post('nohp');
            $userRole = $this->input->post('userRole');
            $password = $this->input->post('password1');

            $data = [
                'email' => htmlspecialchars($email),
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'user_nama' => htmlspecialchars($nama),
                'user_nohp' => htmlspecialchars($nohp),
                'role_id' => $userRole,
                'is_active' => '1',
                'job_location' => $this->input->post('loktask'),
                'date_created' => time()
            ];

            $this->db->insert('tb_user', $data);
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil</strong> User baru sudah ditambahkan.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>'
            );
            redirect('user/addUser');
        }
    }

    public function actUser()
    {
        //non-aktifkan user atau aktifkan user
        $actID = $this->input->post('act');
        $idUser = $this->input->post('id');

        if ($actID == '0') { //action hapus
            $this->db->set('is_active', '0');
            $this->db->where('user_id', $idUser);
            $this->db->update('tb_user');
        } elseif ($actID == '1') { //action kembalikan akun
            $this->db->set('is_active', '1');
            $this->db->where('user_id', $idUser);
            $this->db->update('tb_user');
        }
    }
}
