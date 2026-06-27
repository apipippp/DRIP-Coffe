<?php
class Dashboard extends CI_Controller
{

    // Constructor - Cek autentikasi session
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }
    }

    // Redirect ke dashboard sesuai role (admin/kasir/user)
    public function index()
    {
        $role = $this->session->userdata('role');
        if ($role == 'admin') {
            redirect('admin');
        } elseif ($role == 'kasir') {
            redirect('kasir');
        } else {
            redirect('/');
        }
    }
}