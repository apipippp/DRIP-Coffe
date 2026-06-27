<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Drip
 * Controller untuk user biasa (pelanggan)
 * Menangani halaman: Home, Menu, Antrian, Riwayat
 */
class Drip extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        // Load model yang dibutuhkan
        $this->load->model('MenuModel');
        $this->load->model('OrderModel');
        
        // Load helper URL untuk base_url()
        $this->load->helper('url');
        
        // Load session (sudah otomatis di autoload.php, tapi amankan)
        $this->load->library('session');
    }

    /**
     * Default index -> redirect ke home
     */
    public function index() {
        $this->home();
    }

    /**
     * Halaman Home / Landing Page
     * URL: http://coldnighter3.test/
     *      http://coldnighter3.test/drip/home
     */
    public function home() {
        $data['title'] = 'Home - DRIP* Coffee';
        $this->load->view('layouts/header', $data);
        $this->load->view('drip/home');
        $this->load->view('layouts/footer');
    }

    /**
     * Halaman Menu
     * URL: http://coldnighter3.test/menu
     *      http://coldnighter3.test/drip/menu
     */
    public function menu() {
        // Ambil semua data menu dari database
        $data['menus'] = $this->MenuModel->getAllMenu();
        $data['title'] = 'Menu - DRIP* Coffee';
        
        $this->load->view('layouts/header', $data);
        $this->load->view('drip/menu', $data);
        $this->load->view('layouts/footer');
    }

    /**
     * Halaman Antrian
     * URL: http://coldnighter3.test/antrian
     *      http://coldnighter3.test/drip/antrian
     */
    public function antrian() {
        // Cek apakah user sedang login
        $user_id = $this->session->userdata('user_id');
        $data['active_order'] = null;
        
        if ($user_id) {
            // Ambil pesanan aktif user ini (status pending/preparing/ready)
            $data['active_order'] = $this->OrderModel->getActiveOrder();
        } else {
            // Jika guest, ambil pesanan aktif terakhir dari session PHP jika ada
            $session_order = $this->session->userdata('current_order');
            if ($session_order) {
                // Ambil status terbaru dari database berdasarkan ID di session
                $this->db->where('id', $session_order['id']);
                $data['active_order'] = $this->db->get('orders')->row_array();
            }
        }
        
        $data['title'] = 'Antrian - DRIP* Coffee';
        $this->load->view('layouts/header', $data);
        $this->load->view('drip/antrian', $data);
        $this->load->view('layouts/footer');
    }

    /**
     * Halaman Riwayat Pesanan
     * URL: http://coldnighter3.test/riwayat
     *      http://coldnighter3.test/drip/riwayat
     */
    public function riwayat() {
        $user_id = $this->session->userdata('user_id');
        $data['orders'] = [];
        
        if ($user_id) {
            // Ambil semua riwayat pesanan user ini
            $data['orders'] = $this->OrderModel->getOrderHistory();
        }
        // Jika tidak login, riwayat kosong (akan diisi oleh localStorage via JS)
        
        $data['title'] = 'Riwayat - DRIP* Coffee';
        $this->load->view('layouts/header', $data);
        $this->load->view('drip/riwayat', $data);
        $this->load->view('layouts/footer');
    }
}
