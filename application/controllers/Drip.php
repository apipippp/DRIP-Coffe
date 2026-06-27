<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Drip
 * Controller untuk user biasa (pelanggan)
 * Menangani halaman: Home, Menu, Antrian, Riwayat
 */
class Drip extends CI_Controller {

    // Constructor - Load model, helper & library
    public function __construct() {
        parent::__construct();
        $this->load->model('MenuModel');
        $this->load->model('OrderModel');
        $this->load->helper('url');
        $this->load->library('session');
    }

    // Redirect ke halaman home
    public function index() {
        $this->home();
    }

    // Halaman beranda/landing page
    public function home() {
        $data['title'] = 'Home - DRIP* Coffee';
        $this->load->view('layouts/header', $data);
        $this->load->view('drip/home');
        $this->load->view('layouts/footer');
    }

    // Halaman menu - tampilkan semua menu dari database
    public function menu() {
        $data['menus'] = $this->MenuModel->getAllMenu();
        $data['title'] = 'Menu - DRIP* Coffee';
        
        $this->load->view('layouts/header', $data);
        $this->load->view('drip/menu', $data);
        $this->load->view('layouts/footer');
    }

    // Halaman tracking antrian/pesanan aktif
    public function antrian() {
        $user_id = $this->session->userdata('user_id');
        $data['active_order'] = null;
        
        if ($user_id) {
            $data['active_order'] = $this->OrderModel->getActiveOrder();
        } else {
            $session_order = $this->session->userdata('current_order');
            if ($session_order) {
                $this->db->where('id', $session_order['id']);
                $data['active_order'] = $this->db->get('orders')->row_array();
            }
        }
        
        $data['title'] = 'Antrian - DRIP* Coffee';
        $this->load->view('layouts/header', $data);
        $this->load->view('drip/antrian', $data);
        $this->load->view('layouts/footer');
    }

    // Halaman riwayat pesanan user
    public function riwayat() {
        $user_id = $this->session->userdata('user_id');
        $data['orders'] = [];
        
        if ($user_id) {
            $data['orders'] = $this->OrderModel->getOrderHistory();
        }
        
        $data['title'] = 'Riwayat - DRIP* Coffee';
        $this->load->view('layouts/header', $data);
        $this->load->view('drip/riwayat', $data);
        $this->load->view('layouts/footer');
    }
}
        // Jika tidak login, riwayat kosong (akan diisi oleh localStorage via JS)
        
        $data['title'] = 'Riwayat - DRIP* Coffee';
        $this->load->view('layouts/header', $data);
        $this->load->view('drip/riwayat', $data);
        $this->load->view('layouts/footer');
    }
}
