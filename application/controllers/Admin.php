<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Menu_model');
        $this->load->model('User_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function role()
    {
        $data['title'] = "Role";
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get('tb_user_role')->result_array();
        $this->form_validation->set_rules('role', 'Nama Role', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'role' => $this->input->post('role'),
                'is_active' => 1,
                'date_created' => time()
            ];
            $this->db->insert('tb_user_role', $data);
            // $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>New Role Added</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

            $this->session->set_flashdata('message', 'New Role Added');
            redirect('admin/role');
        }
    }

    public function roleAccess($id)
    {
        $data['title'] = "Role";
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->where('id!=', 1);
        $this->db->where('is_active', 1);
        $data['menu'] = $this->db->get_where('tb_user_menu')->result_array();
        $data['role'] = $this->db->get_where('tb_user_role', ['id' => $id])->row_array();
        $this->form_validation->set_rules('role', 'Nama Role', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/role-access', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'menu' => $this->input->post('menu'),
                'is_active' => 1,
                'date_create' => time()
            ];
            $this->db->insert('tb_user_menu', $data);
            // $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>New Menu Added</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

            $this->session->set_flashdata('message', 'New Menu Added');
            redirect('menu');
        }
    }

    public function getRoleById()
    {
        $id = $this->input->post('id');
        $role = $this->db->get_where('tb_user_role', ['id' => $id])->row_array();
        echo json_encode($role);
    }

    public function editRole()
    {
        $id = $this->input->post('id');
        $role = $this->input->post('role');
        $this->db->set('role', $role);
        $this->db->where('id', $id);
        $this->db->update('tb_user_role');

        // $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Update Role Success</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

        $this->session->set_flashdata('message', 'Role has been Updated');
        redirect('admin/role');
    }

    public function deleteRole($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tb_user_role');
        // $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Delete Role Success</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

        $this->session->set_flashdata('message', 'Role has been Deleted');
        redirect('admin/role');
    }

    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('tb_user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('tb_user_access_menu', $data);
        } else {
            $this->db->delete('tb_user_access_menu', $data);
        }
        // $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Access Changed</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

        $this->session->set_flashdata('message', 'Access Changed');
    }

    public function user()
    {
        $data['title'] = 'User Management';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata['email']])->row_array();
        $data['role'] = $this->db->get('tb_user_role')->result_array();
        $data['users'] = $this->User_model->getAllUser();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/user', $data);
        $this->load->view('templates/footer');
    }

    public function hapusUser($id)
    {
        $this->db->set('is_active', 0);
        $this->db->where('id', $id);
        $this->db->update('tb_user');

        // $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>User Deleted</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

        $this->session->set_flashdata('message', 'User Deleted');
        redirect('admin/user');
    }

    public function getUser()
    {
        $id = $this->input->post('id');
        echo json_encode($this->User_model->getUserById($id));
    }

    public function ubahUser()
    {
        $id = $this->input->post('id', true);
        $nama = $this->input->post('name', true);
        // $email = $this->input->post('email', true);
        $password1 = $this->input->post('password1');
        if (empty($password1)) {
            $password = $this->input->post('password');
        } else {
            $password = password_hash($this->input->post('password1', true), PASSWORD_DEFAULT);
        }
        $role_id = $this->input->post('role_id', true);
        $is_active = $this->input->post('is_active', true);

        $data = [
            "name" => $nama,
            // "email" => $email,
            "password" => $password,
            "role_id" => $role_id,
            "is_active" => $is_active
        ];

        $this->User_model->updateUser($id, $data);
        // $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Update User Success</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

        $this->session->set_flashdata('message', 'This User has been Updated');
        redirect('admin/user');
    }
}
