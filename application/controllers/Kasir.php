<?php
class Kasir extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('user_id') || $this->session->userdata('role') != 'kasir') {
            redirect('auth/login');
        }
        $this->load->model('Product_model');
        $this->load->model('Order_model');
        $this->load->model('Transaction_model');
    }
    
    public function index() {
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');
        $tab = $this->input->get('tab');
        $data['orders'] = $this->Order_model->get_all_pending();
        $data['processing_orders'] = $this->Order_model->get_all_processing();
        $data['completed_orders'] = $this->Order_model->get_all_completed();
        $data['daily_revenue'] = $this->Order_model->get_daily_completed_revenue($start_date, $end_date);
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['active_tab'] = $tab ?: ($start_date || $end_date ? 'revenue' : 'pending');
        $this->load->view('templates/header_kasir');
        $this->load->view('kasir/dashboard', $data);
        $this->load->view('templates/footer_kasir');
    }
    
    public function revenue_detail($date) {
        $data['date'] = $date;
        $data['orders'] = $this->Order_model->get_completed_by_date($date);
        $total_revenue = 0;
        foreach ($data['orders'] as $o) $total_revenue += $o['total'];
        $data['total_revenue'] = $total_revenue;
        $this->load->view('kasir/revenue_detail', $data);
    }
    
    public function order_detail($order_id) {
        $data['order'] = $this->Order_model->get_with_items($order_id);
        $this->load->view('kasir/order_detail', $data);
    }
    
    public function proses($order_id) {
        $order = $this->Order_model->get($order_id);
        if ($order && $order['status'] == 'pending') {
            $this->Order_model->update_status($order_id, 'processing');
        }
        redirect('kasir');
    }
    
    public function add_item() {
        // AJAX: tambah item ke pesanan
    }
    
    public function remove_item() {
        // AJAX
    }
    
    public function print_struk($order_id) {
        // Generate PDF atau window.print
        $data['order'] = $this->Order_model->get_with_items($order_id);
        $this->load->view('kasir/struk', $data);
    }
    
    public function bayar($order_id) {
        $order = $this->Order_model->get($order_id);
        if ($order && $order['status'] == 'processing') {
            $data = [
                'order_id' => $order_id,
                'kasir_id' => $this->session->userdata('user_id'),
                'total' => $order['total'],
                'payment_method' => $order['payment_method'] ?: 'cash',
                'status' => 'paid'
            ];
            $this->Transaction_model->create($data);
            $this->Order_model->update_status($order_id, 'completed');
        }
        redirect('kasir');
    }
}