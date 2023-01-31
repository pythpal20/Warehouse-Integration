<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    // public function __construct()
    // {
    //     parent::__construct();
    //     is_logged_in();
    // }

    public function Index()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'XB | Login';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            // validasi ketika sukses
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('tb_user', ['email' => $email, 'is_active' => '1'])->row_array();

        //jika user ada
        if ($user) {
            if (password_verify($password, $user['password'])) {
                $data = [
                    'email'         => $user['email'],
                    'role_id'       => $user['role_id'],
                    'nama_lengkap'  => $user['user_nama'],
                    'is_activ'      => $user['is_active']
                ];
                $this->session->set_userdata($data);
                // if ($user['role_id'] == 1) {
                redirect('dashboard');
                // } else {
                //     redirect('user');
                // }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email atau Password Salah!</div>');
                redirect('auth');
            }
        } else {
            //tidak user
            $this->session->set_flashdata(
                'message', 
                'swal.fire({
                    title: "Gagal Login",
                    text: "Email tidak terdaftar atau password salah",
                    icon: "error",
                    showCancelButton: false,
                    confirmButtonText: "OKE"
                });'
            );
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->unset_userdata('user_nama');
        $this->session->unset_userdata('is_active');

        $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Anda Sudah Logout!</div>');
        redirect('auth');
    }

    public function blocked()
    {
        $this->load->view('auth/blocked');
    }
}
