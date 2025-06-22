<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Inventory_model extends CI_Model {

    public function __construct() {
        error_reporting(1);
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
        $this->current_date = $this->setting_model->getDateYmd();
         $this->load->helper('file');
        $this->load->library('upload');
    }

    function lectured_courses()
    {
        $this->db->select("lectured_courses.*,teachers.name as teacher_name"); 
        $this->db->join("teachers","teachers.id=lectured_courses.teacher",'left');
        $query=$this->db->order_by("lectured_courses.id","DESC")->get("lectured_courses");        
        return $query;
    }
    
    function courses_subject()
    {
        $this->db->select("courses_subject.*,teachers.name as teacher_name"); 
        $this->db->join("teachers","teachers.id=courses_subject.teacher",'left');
        $query=$this->db->order_by("courses_subject.id","DESC")->get("courses_subject");        
        return $query;
    }
    
    function courses_register()
    {
         $this->db->select("courses_register.*,lectured_courses.title as title"); 
        $this->db->join("lectured_courses","lectured_courses.id=courses_register.lecture_course_id",'left');
        $query=$this->db->order_by("courses_register.id","DESC")->get("courses_register");        
        return $query;
    }
    
    function grab_student()
    {
        $this->db->order_by("firstname");

				$query = $this->db->get("students");

				if($query->num_rows()<=0)

				{

					$tags['']="..Select..";

				}

				$tags['']="..select..";

				foreach($query->result() as $row):

					$tags[$row->id]=$row->firstname.$row->lastname;

				endforeach;

				return $tags;
    }
    
    function get_itemname()
    {
        $this->db->order_by("id");

				$query = $this->db->get("stock");

				if($query->num_rows()<=0)

				{

					$tags['']="..Select..";

				}

				$tags['']="..select..";

				foreach($query->result() as $row):

					$tags[$row->id]=$row->name;

				endforeach;

				return $tags;
    }
    
    function get_data($form,$id)
    {
        
        $row=$this->db->get_where($form,array("id"=>$id))->row();
        return $row;
       
    }
    
    
    function course_fee_balance()
    {
        $this->db->select("course_fee_balance.*,students.firstname as fname,students.lastname as lname,lectured_courses.title as lctitle"); 
        $this->db->join("students","students.id=course_fee_balance.student_id",'left');
        $this->db->join("lectured_courses","lectured_courses.id=course_fee_balance.lecture_course_id",'left');
        $query=$this->db->order_by("course_fee_balance.id","DESC")->get("course_fee_balance");        
        return $query;
    }
    
    
    function course_fee_receive()
    {
        $this->db->select("course_fee_receive.*,students.firstname as fname,students.lastname as lname,lectured_courses.title as lctitle"); 
        $this->db->join("students","students.id=course_fee_receive.student_id",'left');
        $this->db->join("lectured_courses","lectured_courses.id=course_fee_receive.lecture_course_id",'left');
        $query=$this->db->order_by("course_fee_receive.id","DESC")->get("course_fee_receive");        
        return $query;
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
    
    
    function img_upload($files)
		{
		
		ini_set('upload_max_filesize','30M');
		ini_set('post_max_size','30M');
    
			if(!$files)
			{
				return false;
			}
			
			else{		
				$path=base_url()."uploads/student_images/";
				//$config['file_ext']	=
				$config['overwrite']=TRUE;
			 	$config['upload_path']=$path;	
			 	$config['remove_spaces'] = TRUE;	

			   	$config['allowed_types'] = 'gif|jpg|png|jpeg|xlsx|pdf|docx|doc';				   			
				
					$this->load->library('upload');
					$this->upload->initialize($config);
					if(!$this->upload->do_upload($files))
					{
												
						echo $this->upload->display_errors();
						exit;
						
					}

					else
					{							
						
						 return true;

					}
				}
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


