<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Install_model extends CI_Model {

    public function __construct() {
        error_reporting(1);
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
        $this->current_date = $this->setting_model->getDateYmd();
         $this->load->helper('file');
        $this->load->library('upload');
    }

    function install_plan()
    {
        $this->db->select("install_plan.*,classes.class as class, sessions.session"); 
        $this->db->join("classes","classes.id=install_plan.class_id",'left');
        $this->db->join("sessions","sessions.id=install_plan.session_id",'left');
        $query=$this->db->order_by("install_plan.id","DESC")->get("install_plan");        
        return $query;
    }
    
    function courses_subject()
    {
        $this->db->select("courses_subject.*,teachers.name as teacher_name"); 
        $this->db->join("teachers","teachers.id=courses_subject.teacher",'left');
        $query=$this->db->order_by("courses_subject.id","DESC")->get("courses_subject");        
        return $query;
    }
    
    function install_student()
    {
         $this->db->select("install_student.*,install_plan.name as name, students.firstname as fname,students.lastname as lname,sessions.session"); 
        $this->db->join("install_plan","install_plan.id=install_student.install_plan_id",'left');
        $this->db->join("students","students.id=install_student.student_id",'left');
        $this->db->join("sessions","sessions.id=install_student.session_id","left");
        $query=$this->db->order_by("install_student.id","DESC")->get("install_student");        
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
    
    function getClass()
    {
            $this->db->order_by("class");

				$query = $this->db->get("classes");

				if($query->num_rows()<=0)

				{

					$tags['']="..Select..";

				}

				$tags['']="..select..";

				foreach($query->result() as $row):

					$tags[$row->id]=$row->class;

				endforeach;

				return $tags;
    }
    
    
     function getFeegroup()
    {
            $this->db->order_by("name");

				$query = $this->db->get("fee_groups");

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
    
    
    function getSession()
    {
            $this->db->order_by("session");

				$query = $this->db->get("sessions");

				if($query->num_rows()<=0)

				{

					$tags['']="..Select..";

				}

				$tags['']="..select..";

				foreach($query->result() as $row):

					$tags[$row->id]=$row->session;

				endforeach;

				return $tags;
    }
    
    function getInstallPlans()
    {
        $session_id=$this->setting_model->getCurrentSession();
        $this->db->order_by("id");

                $this->db->where("session_id",$session_id);
				$query = $this->db->get("install_plan");

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
        if($form=="install_student")
        {
            $this->db->select("install_student.*,students.firstname as fname, students.lastname as lname"); 
            $this->db->join("students","students.id=install_student.student_id",'left');
            $query=$this->db->get_where($form,array("install_student.id"=>$id))->row();
            return $query;
        }
        
        else
        {
        $row=$this->db->get_where($form,array("id"=>$id))->row();
        return $row;
        }
    }
    
    
    function studentfee_balance()
    {
        $this->db->select("studentfee_balance.*,students.firstname as fname,students.lastname as lname,install_plan.name as name"); 
        $this->db->join("students","students.id=studentfee_balance.student_id",'left');
        $this->db->join("install_plan","install_plan.id=studentfee_balance.install_plan_id",'left');
        $query=$this->db->order_by("studentfee_balance.id","DESC")->get("studentfee_balance");        
        return $query;
    }
    
    
    function studentfee_receive()
    {
        $this->db->select("studentfee_receive.*,students.firstname as fname,students.lastname as lname,install_plan.name as name"); 
        $this->db->join("students","students.id=studentfee_receive.student_id",'left');
        $this->db->join("install_plan","install_plan.id=studentfee_receive.install_plan_id",'left');
        $query=$this->db->order_by("studentfee_receive.id","DESC")->get("studentfee_receive");        
        return $query;
    }
    
        function studentfee_receive_single($sid)
    {
        $this->db->select("studentfee_receive.*,students.firstname as fname,students.lastname as lname,install_plan.name as name"); 
        $this->db->join("students","students.id=studentfee_receive.student_id",'left');
        $this->db->join("install_plan","install_plan.id=studentfee_receive.install_plan_id",'left');
        $this->db->where('studentfee_receive.student_id',$sid);
        $query=$this->db->order_by("studentfee_receive.id","DESC")->get("studentfee_receive");        
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


