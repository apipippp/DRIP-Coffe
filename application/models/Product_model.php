<?php
class Product_model extends CI_Model {
    public function get_all() {
        return $this->db->get('menu_items')->result_array();
    }
    
    public function get_by_category($cat) {
        $this->db->where('category', $cat);
        return $this->db->get('menu_items')->result_array();
    }
    
    public function get($id) {
        return $this->db->get_where('menu_items', ['id' => $id])->row_array();
    }
    
    public function create($data) {
        return $this->db->insert('menu_items', $data);
    }
    
    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('menu_items', $data);
    }
    
    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete('menu_items');
    }
}