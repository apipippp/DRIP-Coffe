<?php
class Dashboard extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }
    }
    
    public function index() {
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