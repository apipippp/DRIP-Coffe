<?php

class Admin extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('user_id') || $this->session->userdata('role') != 'admin') {
            redirect('auth/login');
        }
        $this->load->model('Product_model');
        $this->load->model('Transaction_model');
        $this->load->model('User_model');
        $this->load->model('Order_model');
    }
    
    public function index() {
        $selected_date = $this->input->get('date') ?: date('Y-m-d');
        $month_start = date('Y-m-01 00:00:00');
        $month_end = date('Y-m-t 23:59:59');

        $data['selected_date'] = $selected_date;
        $data['total_income'] = $this->Transaction_model->get_summary($month_start, $month_end)['total'] ?? 0;
        $data['selected_income'] = $this->Order_model->get_completed_revenue_by_date($selected_date);
        $data['selected_orders'] = $this->Order_model->get_completed_by_date($selected_date);
        $data['daily_data'] = $this->Transaction_model->get_daily_summary($selected_date);
        $this->load->view('templates/header_admin');
        $this->load->view('admin/dashboard', $data);
        $this->load->view('templates/footer_admin');
    }

    public function orders_recap() {
        $data['orders'] = $this->Order_model->get_all_completed();
        $data['total_revenue'] = $this->Order_model->sum_revenue();
        $data['total_orders'] = count($data['orders']);
        $this->load->view('templates/header_admin');
        $this->load->view('admin/orders_recap', $data);
        $this->load->view('templates/footer_admin');
    }
    
    public function products() {
        $data['products'] = $this->Product_model->get_all();
        $this->load->view('templates/header_admin');
        $this->load->view('admin/products', $data);
        $this->load->view('templates/footer_admin');
    }
    
    public function add_product() {
        // Upload gambar
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('image')) {
            $upload_data = $this->upload->data();
            $image_url = base_url('uploads/' . $upload_data['file_name']);
        } else {
            $image_url = null;
        }
        $data = [
            'name' => $this->input->post('name'),
            'category' => $this->input->post('category'),
            'price' => $this->input->post('price'),
            'description' => $this->input->post('description'),
            'image_url' => $image_url
        ];
        $this->Product_model->create($data);
        redirect('admin/products');
    }
    
    public function edit_product($id) {
        // Similar
    }
    
    public function delete_product($id) {
        $this->Product_model->delete($id);
        redirect('admin/products');
    }
    
    public function users() {
        $data['users'] = $this->User_model->get_all();
        $this->load->view('templates/header_admin');
        $this->load->view('admin/users', $data);
        $this->load->view('templates/footer_admin');
    }
}
