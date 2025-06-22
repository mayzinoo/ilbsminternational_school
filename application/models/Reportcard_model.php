<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reportcard_model extends CI_Model {

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
    public function get($id = null) {

              
        $this->db->select("students.*,reportcard.created_at as fcdate,DATE_FORMAT(in_time, '%Y-%m-%d %h:%i:%s %p') as a,reportcard.*,classes.class,sections.section");
        $this->db->join("reportcard","students.id =reportcard.student_id",'inner');
        $this->db->join("student_session","students.id =student_session.student_id",'inner');
        $this->db->join("classes","student_session.class_id =classes.id","inner");
        $this->db->join("sections","student_session.section_id =sections.id","inner");
        $this->db->like("student_session.created_at",date("Y"),'after');
        $query=$this->db->order_by("reportcard.id","DESC")->get("students");          
     
       return $query;
    
    }

    public function reportcard_front($sudent_id)
    {

              
        $this->db->select("students.*,reportcard.created_at as fcdate,DATE_FORMAT(in_time, '%Y-%m-%d %h:%i:%s %p') as a,reportcard.*,classes.class,sections.section");
        $this->db->join("reportcard","students.id =reportcard.student_id",'inner');
        $this->db->join("student_session","students.id =student_session.student_id",'inner');
        $this->db->join("classes","student_session.class_id =classes.id","inner");
        $this->db->join("sections","student_session.section_id =sections.id","inner");
        $this->db->like("student_session.created_at",date("Y"),'after');
        $query=$this->db->order_by("reportcard.id","DESC")->get_where("students",array("reportcard.student_id"=>$student_id));          
     
       return $query;
    }


    public function searchByClassSection($class,$section,$month)
    {

              
        $this->db->select("students.*,activity_results.created_at as fcdate,activity_results.*,classes.class,sections.section");
        $this->db->join("activity_results","students.id =activity_results.student_id",'inner');
        $this->db->join("student_session","students.id =student_session.student_id",'inner');
        $this->db->join("classes","student_session.class_id =classes.id","inner");
        $this->db->join("sections","student_session.section_id =sections.id","inner");
        $query=$this->db->order_by("activity_results.id","DESC")->get("students");     
            
     
        return $query->result_array();
    }


    



    
    public function check_exit($class,$section,$month)
    {
        $this->db->where("class_id",$class);
        $this->db->where("section_id",$section);
        $this->db->where("month",$month);
        $qry=$this->db->get("activity_results");

        return $qry;
    }

    public function reportcard_back($id)
    {

        $this->db->select("students.*,reportcard.created_at as fcdate,DATE_FORMAT(in_time, '%Y-%m-%d %h:%i:%s %p') as a,reportcard.*,classes.class,sections.section");
        $this->db->join("reportcard","students.id =reportcard.student_id",'inner');
        $this->db->join("student_session","students.id =student_session.student_id",'inner');
        $this->db->join("classes","student_session.class_id =classes.id","inner");
        $this->db->join("sections","student_session.section_id =sections.id","inner");
        $this->db->like("student_session.created_at",date("Y"),'after');
        $query=$this->db->order_by("reportcard.id","DESC")->get_where("students",array("reportcard.student_id"=>$student_id));          
     
       return $query;
    }
	
	function get_grades($avg)
	
	{
		
		$row=$this->db->query("SELECT name FROM grades WHERE mark_from<='$avg' AND mark_upto>='$avg'")->row();
		return $row;
	}

    
    /**
     * This function will delete the record based on the id
     * @param $id
     */
    public function remove($id) {
        $this->db->where('id', $id);
        $this->db->delete('exams');
    }
	
	
	
	 function rpcards($id,$exam_id)
    {

        
		$query=$this->db->query("SELECT exam_results.*,exam_schedules.* FROM exam_results INNER JOIN exam_schedules
                            ON exam_results.exam_schedule_id=exam_schedules.id INNER JOIN exams ON exam_schedules.exam_id=exams.id WHERE exam_results.student_id='$id' AND exams.id='$exam_id'");
				
							
		return $query;
							
		
		
		
		
    }


         function rpback($id,$month)
    {

      
        $query=$this->db->query("SELECT activity_results.* FROM activity_results  WHERE activity_results.student_id='$id' AND activity_results.month='$month'");
                
                            
        return $query;
                            
        
        
        
        
    }
	
	function reportcard_head()
	{
		$query=$this->db->get("reportcard_head")->row();
		return $query;
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
            $this->db->update('exams', $data);
        } else {
            $this->db->insert('exams', $data);
            return $this->db->insert_id();
        }
    }

    function add_exam_schedule($data) {
        $this->db->where('exam_id', $data['exam_id']);
        $this->db->where('teacher_subject_id', $data['teacher_subject_id']);
        $q = $this->db->get('exam_schedules');
        if ($q->num_rows() > 0) {
            $result = $q->row_array();
            $this->db->where('id', $result['id']);
            $this->db->update('exam_schedules', $data);
        } else {
            $this->db->insert('exam_schedules', $data);
        }
    }

}
