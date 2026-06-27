<?php
class Auth extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
    }
    
    public function login() {
        if ($this->session->userdata('user_id')) {
            redirect('dashboard');
        }
        $this->load->view('auth/login');
    }
    
    public function do_login() {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $user = $this->User_model->get_by_email($email);
        
        // Debugging / backup checking
        if (!$user) {
            $this->session->set_flashdata('error', 'User tidak ditemukan dengan email tersebut');
            redirect('auth/login');
            return;
        }

        if (password_verify($password, $user['password'])) {
            $this->session->set_userdata([
                'user_id' => $user['id'],
                'name' => $user['name'],
                'role' => $user['role'],
                'email' => $user['email']
            ]);
            redirect('dashboard');
        } else {
            $this->session->set_flashdata('error', 'Password yang Anda masukkan salah');
            redirect('auth/login');
        }
    }
    
    public function register() {
        $this->load->view('auth/register');
    }
    
    public function do_register() {
        $this->form_validation->set_rules('name', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/register');
        } else {
            $data = [
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role' => $this->input->post('role') ?: 'user'
            ];
            $this->User_model->create($data);
            redirect('auth/login');
        }
    }
    
    public function logout() {
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}