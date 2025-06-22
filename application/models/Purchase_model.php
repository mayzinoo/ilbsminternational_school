<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Purchase_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
    }

    /**
     * This funtion takes id as a parameter and will fetch the record.
     * If id is not provided, then it will fetch all the records form the table.
     * @param int $id
     * @return mixed
     */
    public function search($location=null,$text = null, $start_date = null, $end_date = null) {


        if (!empty($location)) {
            $this->db->select("location.location as ltext,teachers.name as tname,salary.*");
            $this->db->join('teachers', 'teachers.id = salary.teacher_id',"RIGHT");
            $this->db->join("location","teachers.location=location.id","INNER");
            $this->db->where("teachers.location",$location);
            $query = $this->db->get("salary");
         
            return $query->result_array();
        }

        if (!empty($text)) {
            $this->db->select("location.location as ltext,teachers.name as tname,salary.*");
            $this->db->join('teachers', 'teachers.id = salary.teacher_id');
            $this->db->join("location","location.id=teachers.location");

            $this->db->like('salary.name', $text);
            $query = $this->db->get("salary");
            return $query->result_array();
        } else {
            $this->db->select("location.location as ltext,teachers.name as tname,salary.*");
            $this->db->join('teachers', 'teachers.id = salary.teacher_id');
            $this->db->join("location","location.id=teachers.location");
            $this->db->where('salary.date >=', $start_date);
            $this->db->where('salary.date <=', $end_date);
            $query = $this->db->get("salary");
            return $query->result_array();
        }

       
    }

    public function get($id = null) {
      
        if ($id != null) {
            $this->db->where('purchase_header.id', $id);
        } 
        // else {
        //     $this->db->select("location.location as ltext,teachers.name as tname,salary.*");
        //     $this->db->join("teachers","teachers.id=salary.teacher_id");
        //     $this->db->join("location","location.id=teachers.location");
        //     $this->db->order_by('salary.id', 'DESC');            
        // }
        $query = $this->db->get("purchase_header");
        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    /**
     * This function will delete the record based on the id
     * @param $id
     */
    public function remove($id) {
        $this->db->where('id', $id);
        $this->db->delete('expenses');
    }

    /**
     * This function will take the post data passed from the controller
     * If id is present, then it will do an update
     * else an insert. One function doing both add and edit.
     * @param $data
     */
    public function add($data) {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('salary', $data);
        } else {
            $this->db->insert('salary', $data);
            return $this->db->insert_id();
        }

    }

    public function check_Exits_group($data) {
        $this->db->select('*');
        $this->db->from('expenses');
        $this->db->where('session_id', $this->current_session);
        $this->db->where('feetype_id', $data['feetype_id']);
        $this->db->where('class_id', $data['class_id']);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return false;
        } else {
            return true;
        }
    }

    public function getTypeByFeecategory($type, $class_id) {
        $this->db->select('expenses.id,expenses.session_id,expenses.amount,expenses.documents,expenses.note,expense_head.class,feetype.type')->from('expenses');
        $this->db->join('expense_head', 'expenses.class_id = expense_head.id');
        $this->db->join('feetype', 'expenses.feetype_id = feetype.id');
        $this->db->where('expenses.class_id', $class_id);
        $this->db->where('expenses.feetype_id', $type);
        $this->db->where('expenses.session_id', $this->current_session);
        $this->db->order_by('expenses.id');
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getTotalSalaryBydate($date) {
        $query = 'SELECT sum(amount) as `amount` FROM `expenses` where date=' . $this->db->escape($date);
        $query = $this->db->query($query);
        return $query->row();
    }

    public function getTotalSalaryBwdate($date_from, $date_to) {
        $query = 'SELECT sum(amount) as `amount` FROM `expenses` where date between ' . $this->db->escape($date_from) . ' and ' . $this->db->escape($date_to);

        $query = $this->db->query($query);
        return $query->row();
    }

}
