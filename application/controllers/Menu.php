<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->library('form_validation');
        $this->load->model('Menu_model');
    }

    public function index()
    {
        $data['title'] = "Menu Management";
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->Menu_model->getAllMenu();
        $this->form_validation->set_rules('menu', 'Nama Menu', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
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

    public function getUbahMenu()
    {
        $id = $this->input->post('id');
        echo json_encode($this->Menu_model->getMenuById($id));
    }

    public function ubahMenu()
    {
        $id = $this->input->post('id');
        $data = ['menu' => $this->input->post('menu')];
        $this->Menu_model->updateMenu($data, $id);
        // $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Update Menu Success</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

        $this->session->set_flashdata('message', 'Menu has been Updated');
        redirect('menu');
    }

    public function hapusMenu($id)
    {
        $this->db->where('id', $id);
        $this->db->update('tb_user_menu', ['is_active' => 0]);
        // $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Menu Deleted</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

        $this->session->set_flashdata('message', 'Menu Deleted');
        redirect('menu');
    }

    public function subMenu()
    {
        $data['title'] = 'Sub Menu Management';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->Menu_model->getAllMenu();
        $data['submenu'] = $this->Menu_model->getAllSubMenu();

        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('url', 'Url', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'menu_id' => $this->input->post('menu_id'),
                'title' => $this->input->post('title'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];

            $this->db->insert('tb_user_sub_menu', $data);
            // $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>New Sub Menu Added</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            $this->session->set_flashdata('message', 'New Sub Menu Added');
            redirect('menu/subMenu');
        }
    }

    public function getUbahSubMenu()
    {
        $id = $this->input->post('id');
        echo json_encode($this->Menu_model->getSubMenuById($id));
    }

    public function ubahSubMenu()
    {
        $id = $this->input->post('id');
        $data = [
            'menu_id' => $this->input->post('menu_id'),
            'title' => $this->input->post('title'),
            'url' => $this->input->post('url'),
            'icon' => $this->input->post('icon'),
            'is_active' => $this->input->post('is_active')
        ];

        $this->Menu_model->updateSubMenu($data, $id);
        // $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Update Sub Menu Success</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

        $this->session->set_flashdata('message', 'Sub Menu has been Updated');
        redirect('menu/subMenu');
    }

    public function hapusSubMenu($id)
    {
        $this->db->where('id', $id);
        $this->db->update('tb_user_sub_menu', ['is_active' => 0]);
        // $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Sub Menu Deleted</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

        $this->session->set_flashdata('message', 'Sub Menu Deleted');
        redirect('menu/subMenu');
    }
}
