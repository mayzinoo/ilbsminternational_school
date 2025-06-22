<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Inter_class_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * This funtion takes id as a parameter and will fetch the record.
     * If id is not provided, then it will fetch all the records form the table.
     * @param int $id
     * @return mixed
     */
    public function get($id = null) {
        $this->db->select()->from('inter_class');
        if ($id != null) {
            $this->db->where('id', $id);
        } else {
            $this->db->order_by('id');
        }
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array(); // single row
        } else {
            return $query->result_array(); // array of result
        }
    }

    /**
     * This function will delete the record based on the id
     * @param $id
     */
    public function remove($id) {
        $this->db->where('id', $id);
        $this->db->delete('inter_class');
    }

   
    public function add($data) {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('inter_class', $data);
        } else {
            $this->db->insert('inter_class', $data);
        }
    }
    

}
