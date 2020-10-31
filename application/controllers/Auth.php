<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Login Page';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login', $data);
            $this->load->view('templates/auth_footer');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $email = htmlspecialchars($this->input->post('email', true));
        $password = $this->input->post('password', true);
        $user = $this->db->get_where('tb_user', ['email' => $email])->row_array();

        if ($user) {
            if ($user['is_active'] == 1) {
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        $this->session->set_flashdata('message', 'Login Success');
                        redirect('admin');
                    } else {
                        $this->session->set_flashdata('message', 'Login Success');
                        redirect('user');
                    }
                } else {
                    // $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password</div>');

                    $this->session->set_flashdata('warning', 'Wrong password');
                    redirect('auth');
                }
            } else {
                // $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">This email has not been activated</div>');

                $this->session->set_flashdata('warning', 'This email has not been activated');
                redirect('auth');
            }
        } else {
            // $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">This email is not registered</div>');

            $this->session->set_flashdata('warning', 'This email is not registered');
            redirect('auth');
        }
    }

    public function registration()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tb_user.email]');
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]', [
            'min_length' => 'Password too short',
            'matches' => 'Password dont matches'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'User Registration';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration', $data);
            $this->load->view('templates/auth_footer');
        } else {
            $email = $this->input->post('email', true);
            $data = [
                'name' => $this->input->post('name', true),
                'email' => $email,
                'password' => password_hash($this->input->post('password1', true), PASSWORD_DEFAULT),
                'image' => 'default.jpg',
                'role_id' => 2,
                'is_active' => 1,
                'date_created' => time()
            ];

            // siapkan token
            $token = base64_encode(random_bytes(32));

            $user_token = [
                'email' => $email,
                'token' => $token,
                'date_created' => time()
            ];

            // $this->db->insert('tb_user', $data);
            // $this->db->insert('tb_user_token', $user_token);
            // $this->_sendEmail($token, 'verify');
            $this->_sendEmail();
            // $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulation your account has been<strong> Created</strong>, please login</div>');

            $this->session->set_flashdata('message', 'Congratulation your account has been Created, please login');
            redirect('auth');
        }
    }

    private function _sendEmail($token, $type)
    {
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            // 'smtp_user' => 'projectmy1020@gmail.com',
            'smtp_user' => 'dadanhendri80@gmail.com',
            'smtp_pass' => 'abughazi80',
            'smtp_port' => '465',
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n",
            'validation' => TRUE
        ];

        $this->load->library('email', $config);

        $this->email->from('dadanhendri80@gmail.com', 'Perisai Husada');
        $this->email->to($this->input->post('email'));
        // if ($type == 'verify') {
        //     $this->email->subject('Account Verification');
        //     $this->email->message('Click this link to verify your account:<a href="' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . $token . '">Activate</a>');
        // }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
        }
    }


    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        // $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You have been logout</div>');

        $this->session->set_flashdata('message', 'You have been logout');
        redirect('auth');
    }

    public function blocked()
    {
        $this->load->view('auth/blocked');
    }
}
