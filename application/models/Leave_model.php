<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Leave_model extends CI_Model {

    public function __construct() {
        error_reporting(1);
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
        $this->current_date = $this->setting_model->getDateYmd();
    }

    /**
     * This funtion takes id as a parameter and will fetch the record.
     * If id is not provided, then it will fetch all the records form the table.
     * @param int $id
     * @return mixed
     */
    function get($id = null)
    {
        if($id==null)
        {                                 
        $query=$this->db->get("tbl_leave");  
        // $query=$this->db->query("SELECT leave.*,teachers.name as name FROM leave LEFT JOIN teachers ON leave.teacher_id=teachers.id");              
        return $query;
        }

        else
        {            
        $query=$this->db->query("SELECT leave.*,teachers.name as name FROM leave LEFT JOIN teachers ON leave.teacher_id=teachers.id WHERE leave.id='$id'")->row();
        // echo $this->db->last_query(); exit;
        return $query;
        }
    }

      function get_absent()
    {

          $this->db->select("teachers.*,teacher_attendences.created_at as fcdate,DATE_FORMAT(in_time, '%Y-%m-%d %h:%i:%s %p') as a,teacher_attendences.*");
        $this->db->join("teacher_attendences","teachers.id =teacher_attendences.teacher_id",'inner');
         $this->db->like("teacher_attendences.created_at",date("Y-m-d"));
        $this->db->where("teacher_attendences.status !=","");
        $query=$this->db->order_by("teacher_attendences.id","DESC")->get("teachers");        
     
             
           
     
       return $query;
    }

    /**
     * This function will delete the record based on the id
     * @param $id
     */
    public function add($data) {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('student_attendences', $data);
        } else {
            $this->db->insert('student_attendences', $data);
        }
    }

    public function searchAttendence($date) {

        $this->db->select("teachers.*,teacher_attendences.created_at as fcdate,teacher_attendences.*");
        $this->db->join("teacher_attendences","teachers.id =teacher_attendences.teacher_id");     
        $this->db->LIKE("teacher_attendences.created_at",$date);
        $query=$this->db->order_by("teacher_attendences.id","DESC")->get("teachers");          
        return $query;
    }
    

    public function searchAttendenceClassSectionPrepare($class_id, $section_id, $date) {
$query = $this->db->query("select student_sessions.attendence_id,students.firstname,
students.admission_no,student_sessions.date,students.roll_no,
students.lastname,student_sessions.attendence_type_id,
student_sessions.id as student_session_id from students ,
(SELECT student_session.id,student_session.student_id ,
IFNULL(student_attendences.date, 'xxx') as date,
IFNULL(student_attendences.id, 0) as attendence_id,
student_attendences.attendence_type_id FROM `student_session` 
RIGHT JOIN student_attendences ON student_attendences.student_id=student.id 
and student_attendences.date=" . $this->db->escape($date) . " 
and student_session.class_id=" . $this->db->escape($class_id) . " 
and student_session.section_id=" . $this->db->escape($section_id) . ") 
as student_sessions where student_sessions.student_id=students.id");

        return $query->result_array();
    }

}
