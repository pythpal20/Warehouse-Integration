<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Administrator extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Menu Setting';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $data['menux'] = $this->db->get('user_menu')->result_array();
        // echo 'Selamat datang ' . $data['user']['nama_lengkap'] . ' di FP Rewards';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('administrator/index', $data);
        $this->load->view('templates/footer');
    }

    public function userRole()
    {
        $data['title'] = 'User Role';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $data['menux'] = $this->db->get('user_menu')->result_array();
        // echo 'Selamat datang ' . $data['user']['nama_lengkap'] . ' di FP Rewards';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('administrator/user_roles', $data);
        $this->load->view('templates/footer');
    }
    
    public function setAccess($id)
    {
        $data['title'] = 'User Role';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get_where('user_role', ['role_id' => $id])->row_array();

        $this->db->where('id !=', 2);
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['jumlah'] = count($data['menu']);
        
    
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('administrator/role-access', $data);
        $this->load->view('templates/footer');

    }

    public function getRoles()
    {
        $this->load->model("m_menu");
        $role = $this->m_menu->selectRole();
        $data = array();
        $no = 1;

        foreach ($role->result() as $r) {
            $data[] = array(
                'no'    => $no++,
                'id'    => $r->role_id,
                'role'  => $r->role,
                'ket'   => $r->keterangan
            );
        }
        print_r(json_encode($data));
    }

    public function simpanRole()
    {
        
        $data = [
            'role' => $this->input->post('nrole'),
            'keterangan' => $this->input->post('nketerangan')
        ];

        $result = $this->db->get_where('user_role', $data);

        if($result->num_rows() > 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Roles ini sudah ada!</div>');
        } else {
            $this->db->insert('user_role', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Role baru ditambahkan!</div>');
        }

    }
    /**
     * Prose ubah roles pada group roles
     */
    public function editRole()
    {
        $id = $this->input->post('xid');

        $data = [
            'role' => $this->input->post('xrole'),
            'keterangan' => $this->input->post('xketerangan')
        ];

        $this->db->set($data);
        $this->db->where('role_id', $id);
        $this->db->update('user_role');
        $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">Role telah diupdate!</div>');
    }

    public function user_menu()
    {
        $this->load->model("m_menu");
        $menus = $this->m_menu->selectMenu();
        $data = array();
        $no = 1;

        foreach ($menus->result() as $mn) {
            $data[] = array(
                'no'    => $no++,
                'id'    => $mn->id,
                'menu'  => $mn->menu
            );
        }
        print_r(json_encode($data));
    }

    public function user_submenu()
    {
        $this->load->model("m_menu");
        $submenu = $this->m_menu->selectsubMenu();
        $data = array();
        $no = 1;

        foreach ($submenu->result() as $sm) {
            $data[] = array(
                'no'        => $no++,
                'title'     => $sm->title,
                'menu'      => $sm->menu,
                'url'       => $sm->url,
                'icon'      => $sm->icon,
                'active'    => $sm->is_active,
                'id'        => $sm->id
            );
        }
        print_r(json_encode($data));
    }

    public function simpanMenu()
    {
        $data = [
            'menu' => $this->input->post('namaMenu')
        ];
        $this->db->insert('user_menu', $data);
    }

    public function ubahMenu(){
        // var_dump($this->input->post());
        $id = $this->input->post('id');
        $nama = $this->input->post('xnamaMenu');

        $this->db->set('menu', $nama);
        $this->db->where('id', $id);
        $this->db->update('user_menu');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu sudah diubah!</div>');
    }

    public function hapusMenu()
    {
        $id = $this->input->post('id');

        $this->db->where('id', $id);
        $this->db->delete('user_menu');

        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Menu sudah dihapus!</div>');
    }

    public function simpansubMenu()
    {
        // var_dump($this->input->post());
        $data = [
            'menu_id' => $this->input->post('menu_root'),
            'title' => $this->input->post('title'),
            'url' => $this->input->post('urls'),
            'icon' => $this->input->post('icon'),
            'is_active' => $this->input->post('isactive')
        ];
        $this->db->insert('user_sub_menu', $data);
    }

    public function changeaccess(){
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Access Changed!</div>');
    }
}
