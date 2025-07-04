<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
        $this->current_session_name = $this->setting_model->getCurrentSessionName();
        $this->start_month = $this->setting_model->getStartMonth();
    }

    /**
     * This funtion takes id as a parameter and will fetch the record.
     * If id is not provided, then it will fetch all the records form the table.
     * @param int $id
     * @return mixed
     */
    public function get($id = null) {
        
        $this->db->select("sch_settings.name,admin.*");
        $this->db->join("sch_settings","sch_settings.id=admin.school");
        $this->db->from('admin');
        if ($id != null) {
            $this->db->where('id', $id);
        } else {
            $this->db->order_by('id');
        }
        $query = $this->db->get();
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
        $this->db->delete('admin');
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
            $this->db->update('admin', $data);
        } else {
            $this->db->insert('admin', $data);
        }
    }

    public function checkLogin($data) {
        $this->db->select('id, username, password');
        $this->db->from('admin');
        $this->db->where('email', $data['username']);
        $this->db->where('password', MD5($data['password']));
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function read_user_information($email) {
        $condition = "email =" . "'" . $email . "'";
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function readByEmail($email) {
        $condition = "email =" . "'" . $email . "'";
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    }
    
    
    function get_totalfeepermonth($start_month,$end_month)
    {
        $sql = "SELECT SUM(total_received) as amount,MONTH(paydate) as month ,YEAR(paydate) as year FROM fee_collection where YEAR(paydate) BETWEEN " . $this->db->escape($start_month) . " and " . $this->db->escape($end_month) . " GROUP BY MONTH(paydate)";
        $query = $this->db->query($sql);
        return $query->row();
        
    }
    
        function get_totalinstallpermonth($start_month,$end_month)
    {
        $sql = "SELECT SUM(fee) as amount,MONTH(paydate) as month ,YEAR(paydate) as year FROM studentfee_receive where YEAR(paydate) BETWEEN " . $this->db->escape($start_month) . " and " . $this->db->escape($end_month) . " GROUP BY MONTH(paydate)";
        $query = $this->db->query($sql);
        return $query->row();
        
    }    
    
    function get_totalsummer($start_month,$end_month)
    {
        $sql = "SELECT SUM(pay_amount) as amount,MONTH(paydate) as month ,YEAR(paydate) as year FROM course_fee_receive where YEAR(paydate) BETWEEN " . $this->db->escape($start_month) . " and " . $this->db->escape($end_month) . " GROUP BY MONTH(paydate)";
        $query = $this->db->query($sql);
        return $query->row();
        
    }
    
        function get_totalexppermonth($start_month,$end_month)
    {
        $sql = "SELECT SUM(amount) as amount, MONTH(date) as month ,YEAR(date) as year FROM expenses where YEAR(date) BETWEEN " . $this->db->escape($start_month) . " and " . $this->db->escape($end_month) . " GROUP BY MONTH(date)";
        $query = $this->db->query($sql);
        return $query->row();
        
    }
    
        function get_totalincpermonth($start_month,$end_month)
    {
        $sql = "SELECT SUM(amount) as amount,MONTH(date) as month ,YEAR(date) as year FROM income where YEAR(date) BETWEEN " . $this->db->escape($start_month) . " and " . $this->db->escape($end_month) . " GROUP BY MONTH(date)";
        $query = $this->db->query($sql);
        return $query->row();
        
    }
    
    
        function get_totalsale($start_month,$end_month)
    {
        $sql = "SELECT SUM(total) as amount,MONTH(created_at) as month ,YEAR(created_at) as year FROM sale_detail where YEAR(created_at) BETWEEN " . $this->db->escape($start_month) . " and " . $this->db->escape($end_month) . " GROUP BY MONTH(created_at)";
        $query = $this->db->query($sql);
        return $query->row();
        
    }
    
    
    

    public function updateVerCode($data) {
        $this->db->where('id', $data['id']);
        $query = $this->db->update('admin', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function getAdminByCode($ver_code) {
        $condition = "verification_code =" . "'" . $ver_code . "'";
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function change_password($data) {
        $condition = "id =" . "'" . $data['id'] . "'";
        $this->db->select('password');
        $this->db->from('admin');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function checkOldPass($data) {
        $this->db->where('id', $data['user_id']);
        $this->db->where('password', $data['current_pass']);
        $this->db->where('email', $data['user_email']);
        $query = $this->db->get('admin');
        if ($query->num_rows() > 0)
            return TRUE;
        else
            return FALSE;
    }

    public function saveNewPass($data) {
        $this->db->where('id', $data['id']);
        $query = $this->db->update('admin', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function saveForgotPass($data) {
        $this->db->where('email', $data['email']);
        $query = $this->db->update('admin', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function addReceipt($data) {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('fee_receipt_no', $data);
        } else {
            $this->db->insert('fee_receipt_no', $data);
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }
    }

    public function getMonthlyCollection() {
        $data = explode("-", $this->current_session_name);
        $data_first = $data[0];
        $data_second = substr($data_first, 0, 2) . $data[1];
        $this->start_month;
        $sql = "SELECT SUM(amount+amount_fine-amount_discount) as amount,MONTH(date) as month ,YEAR(date) as year FROM student_fees where YEAR(date) BETWEEN " . $this->db->escape($data_first) . " and " . $this->db->escape($data_second) . " GROUP BY MONTH(date)";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getMonthlyExpense() {
        $data = explode("-", $this->current_session_name);
        $data_first = $data[0];
        $data_second = substr($data_first, 0, 2) . $data[1];
        $this->start_month;
        $sql = "SELECT SUM(amount) as amount,MONTH(date) as month ,YEAR(date) as year FROM expenses where YEAR(date) BETWEEN " . $this->db->escape($data_first) . " and " . $this->db->escape($data_second) . " GROUP BY MONTH(date)";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getCollectionbyDay($date) {
        $sql = 'SELECT SUM(amount+amount_fine-amount_discount) as amount FROM student_fees where date=' . $this->db->escape($date);
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getExpensebyDay($date) {
        $sql = 'SELECT SUM(amount) as amount FROM expenses where date=' . $this->db->escape($date);

        $query = $this->db->query($sql);
        return $query->result_array();
    }

}
