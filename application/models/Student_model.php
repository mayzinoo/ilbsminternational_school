<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Student_model extends CI_Model {

    public function __construct() {
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
    public function insert($tablename,$data)
	{
	 	$this->db->insert($tablename,$data);
	 	return true;
	}
    public function getStudents() {
        $this->db->select('classes.id AS `class_id`,student_session.id as student_session_id,student_session.session_id as sess_id,students.id,
        classes.class,sections.id AS `section_id`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,
        students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode , students.rfid ,students.machine_id ,students.finger_id ,
        students.religion,     students.dob ,students.current_address,    students.permanent_address,IFNULL(students.category_id, 0) as `category_id`,
        IFNULL(categories.category, "") as `category`,students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code , 
        students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,
        students.updated_at,students.father_name,students.gender,users.id as `user_tbl_id`,users.username,users.password as `user_tbl_password`,
        users.is_active as `user_tbl_active`')->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('categories', 'students.category_id = categories.id', 'left');
        $this->db->join('users', 'users.user_id = students.id', 'left');
        $this->db->where('student_session.session_id', $this->current_session);
        $this->db->where('users.role', 'student');

        $this->db->order_by('students.id');

        $query = $this->db->get();
        return $query->result_array();
    }
    public function gethostel(){
        $this->db->group_by("hostel_name");
		$this->db->order_by("hostel_name");
		$query = $this->db->get("hostel");
		if($query->num_rows()<=0)
		{
			$tags['']="..Select..".hide();
		}
		$tags['']="..Select..";
		foreach($query->result() as $row):
			$tags[$row->id]=$row->hostel_name;
		endforeach;
		return $tags;
    }
    public function getRecentRecord($id = null) {
        $this->db->select('classes.id AS `class_id`,classes.class,sections.id AS `section_id`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode ,     students.religion,     students.dob ,students.current_address,    students.permanent_address,students.category_id,    students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.father_name,students.father_phone,students.father_occupation,students.mother_name,students.mother_phone,students.mother_occupation,students.guardian_occupation,students.gender,students.guardian_is')->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
       $this->db->where('student_session.session_id', $this->current_session);
        if ($id != null) {
            $this->db->where('students.id', $id);
        } else {
            
        }
        $this->db->order_by('students.id', 'desc');
        $this->db->limit(5);
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }
    
   function getFpdata($userid,$machineid)
    {
        $query=$this->db->select("students.id as student_id")->get_where("students",array("finger_id"=>$userid,"machine_id"=>$machineid));
         return $query->row();
         
        $this->db->select('classes.id AS `class_id`,students.id as student_id,sections.id AS `section_id`')->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('users', 'users.user_id = students.id', 'left');
        $this->db->where('student_session.session_id', $this->current_session);
        $this->db->where('students.finger_id', $userid);
        $this->db->where('students.machine_id', $machineid);

        $this->db->order_by('students.id');

        $query = $this->db->get();
         return $query->row();

    }


function monthlyattandence_percent($session_id,$student_id)
    {

      $query=$this->db->query("SELECT
                month(student_attendences.created_at) as month,          
          count(if(month(student_attendences.created_at)  != 5 && student_attendences.status = 'Present', 1, NULL))  AS 'totalpresent',
              
            count(if(student_attendences.status = 'Absent', 1, NULL))  AS 'totalabsent',
        count(if(student_attendences.status = 'Leave', 1, NULL))  AS 'totalleave'
          FROM student_attendences 
                    where
                     student_attendences.session_id='$session_id'
                    AND student_attendences.student_id='$student_id'
                    group by month order by id ASC
                    ");

      
  
        return $query;          
        

    }

     function get_school_calendar($session_id)
    {
        $query=$this->db->query(" SELECT att_month,att_day

            FROM school_calendar WHERE school_calendar.session_id='$session_id'");

        return $query;


    }


function studentreport_search()
{
     $query=$this->db->query("SELECT classes.class,
            count(if(students.gender='Male',1, NULL)) as 'maletotal',
            count(if(students.gender='Female', 1, NULL))as 'femaletotal',
            count(students.gender) as 'total',
            IfNull(classes.class,'') 'class'
            FROM students LEFT JOIN student_session ON 
            student_session.student_id = students.id 
            INNER JOIN classes ON
             student_session.class_id = classes.id 
             WHERE students.resign=0 AND student_session.session_id=".$this->db->escape($this->current_session)."
             GROUP BY classes.class WITH ROLLUP ");

   

     return  $query;
         
}
    /**
     * This funtion takes id as a parameter and will fetch the record.
     * If id is not provided, then it will fetch all the records form the table.
     * @param int $id
     * @return mixed
     */
    public function get($id = null) {
        $this->db->select('student_session.transport_fees,student_session.vehroute_id,student_session.inter_class,student_session.session_id as sess_id,student_session.fees_discount,classes.id AS `class_id`,classes.class,classes.level,sections.id AS `section_id`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.resign , students.school , students.pincode ,     students.religion,     students.dob ,students.current_address, students.previous_school,
            students.guardian_is,student_session.school,students.rfid ,students.machine_id ,students.finger_id ,
            students.permanent_address,students.category_id,students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.father_name,students.father_phone,students.father_occupation,students.mother_name,students.mother_phone,students.mother_occupation,students.guardian_occupation,students.gender,students.guardian_is,students.guardian_email')->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->where('student_session.session_id', $this->current_session);
        if ($id != null) {
            $this->db->where('students.id', $id);
        } else {
            $this->db->order_by('student_session.class_id', 'desc');
        }
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    public function search_student() {
        $this->db->select('classes.id AS `class_id`,classes.class,sections.id AS `section_id`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode ,     students.religion,     students.dob ,students.current_address,    students.permanent_address,students.category_id,    students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.father_name,students.father_phone,students.father_occupation,students.mother_name,students.mother_phone,students.mother_occupation,students.guardian_occupation')->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
       $this->db->where('student_session.session_id', $this->current_session);
        if ($id != null) {
            $this->db->where('students.id', $id);
        } else {
        
            $this->db->order_by('students.id');
        }
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }
	
	
	
	 public function searchClassSection($class,$section,$school) {
        $this->db->select('student_session.transport_fees,student_session.vehroute_id,student_session.id as `student_session_id`,student_session.fees_discount,classes.id AS `class_id`,classes.class,sections.id AS `section_id`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode ,     students.religion,     students.dob ,students.current_address, students.previous_school,
            students.guardian_is,
            students.permanent_address,students.category_id,students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.father_name,students.father_phone,students.father_occupation,students.mother_name,students.mother_phone,students.mother_occupation,students.guardian_occupation,students.gender,students.guardian_is,students.guardian_email')->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
       $this->db->where('student_session.session_id', $this->current_session);
		$this->db->where("student_session.class_id",$class);
		$this->db->where("student_session.section_id",$section);
        $this->db->where('students.resign', 0);
      $this->db->where('students.school', $school);
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    public function getstudentdoc($id) {
        $this->db->select()->from('student_doc');
        $this->db->where('student_id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    function searchByInterClass($inter_class)
    {
         $this->db->select('students.id as stuid,student_session.inter_class,student_session.id as student_session_id,students.admission_date,students.admission_no,students.firstname,  students.lastname')->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->where('student_session.session_id', $this->current_session);
        $this->db->where('student_session.inter_class', $inter_class);

        $this->db->order_by('students.id');

        $query = $this->db->get();
        
        
        return $query->result_array();
        

    }

    public function searchByClassSection($class_id = null, $section_id = null,$resign=null,$school=null,$inter_class=null) {
        $this->db->select('classes.id AS `class_id`,student_session.inter_class,student_session.id as student_session_id,student_session.session_id as sessid,
        students.id,classes.class,classes.id as class_id,classes.level,sections.id AS `section_id`,sections.section,students.id,students.admission_no , 
        students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,  
        students.city , students.pincode ,     students.religion,     students.dob ,students.current_address,    students.permanent_address,
        IFNULL(students.category_id, 0) as `category_id`,IFNULL(categories.category, "") as `category`,students.adhar_no,students.samagra_id,
        students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name , students.guardian_relation,students.guardian_phone,
        students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.father_name,students.gender,students.resign,students.school')->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('categories', 'students.category_id = categories.id', 'left');
        $this->db->where('student_session.session_id', $this->current_session);
        if ($class_id != null) {
            $this->db->where('student_session.class_id', $class_id);
        }
        if ($section_id != null) {
            $this->db->where('student_session.section_id', $section_id);
        }
        
         if ($inter_class != null) {
            $this->db->where('student_session.inter_class', $inter_class);
        }
          if ($resign != null) {
            $this->db->where('students.resign', $resign);
        }
        
          if ($school != null) {
            $this->db->where('students.school', $school);
        }
        
        

        $this->db->order_by('students.id');

        $query = $this->db->get();

     
        return $query->result_array();
    }

    public function searchByClassSectionCategoryGenderRte($class_id = null, $section_id = null
    , $category = null, $gender = null) {
        $this->db->select('classes.id AS `class_id`,student_session.id as student_session_id,students.id,classes.class,sections.id AS `section_id`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode ,     students.religion,     students.dob ,students.current_address,    students.permanent_address,students.category_id, categories.category,   students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.father_name,students.gender')->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('categories', 'students.category_id = categories.id');
        $this->db->where('student_session.session_id', $this->current_session);
        if ($class_id != null) {
            $this->db->where('student_session.class_id', $class_id);
        }
        if ($section_id != null) {
            $this->db->where('student_session.section_id', $section_id);
        }
        if ($category != null) {
            $this->db->where('students.category_id', $category);
        }
        if ($gender != null) {
            $this->db->where('students.gender', $gender);
        }
        
        $this->db->order_by('students.id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function searchFullText($searchterm) {
        $this->db->select('classes.id AS `class_id`,student_session.inter_class,students.id,classes.class,sections.id AS `section_id`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode ,     students.religion,     students.dob ,students.current_address,    students.permanent_address,IFNULL(students.category_id, 0) as `category_id`,IFNULL(categories.category, "") as `category`,      students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code ,students.father_name , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.gender,student_session.session_id')->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id','left');
        $this->db->join('sections', 'sections.id = student_session.section_id','left');
        $this->db->join('categories', 'students.category_id = categories.id', 'left');
       $this->db->where('student_session.session_id', $this->current_session);
        $this->db->group_start();
        $this->db->like('students.firstname', $searchterm);
        $this->db->or_like('students.lastname', $searchterm);
        $this->db->or_like('students.guardian_name', $searchterm);
        $this->db->or_like('students.adhar_no', $searchterm);
        $this->db->or_like('students.samagra_id', $searchterm);
        $this->db->or_like('students.roll_no', $searchterm);
        $this->db->or_like('students.admission_no', $searchterm);
        $this->db->or_like('students.rfid', $searchterm);
        $this->db->or_like('students.machine_id', $searchterm);
        $this->db->or_like('students.finger_id', $searchterm);
        $this->db->group_end();
        $this->db->order_by('students.id');
        $query = $this->db->get();
        return $query->result_array();
    }
    

    public function getStudentListBYStudentsessionID($array) {
        $array = implode(',', $array);
        $sql = ' SELECT students.* FROM students INNER join (SELECT * FROM `student_session` WHERE `student_session`.`id` IN (' . $array . ')) as student_session on students.id=student_session.student_id';
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function remove($id) {
        $this->db->trans_start();

        $sql = "SELECT * FROM `users` WHERE childs LIKE '%," . $id . ",%' OR childs LIKE '" . $id . ",%' OR childs LIKE '%," . $id . "' OR childs = " . $id;
        $query = $this->db->query($sql);


        if ($query->num_rows() > 0) {
            $result = $query->row();
            $array_slice = explode(',', $result->childs);
            if (count($array_slice) > 1) {
                $arr = array_diff($array_slice, array($id));
                $update = implode(",", $arr);
                $data = array('childs' => $update);

                $this->db->where('id', $result->id);
                $this->db->update('users', $data);
            } else {
                $this->db->where('id', $result->id);
                $this->db->delete('users');
            }
        }

        $this->db->where('id', $id);
        $this->db->delete('students');

        $this->db->where('student_id', $id);
        $this->db->delete('student_session');



        $this->db->where('user_id', $id);
        $this->db->where('role', 'student');
        $this->db->delete('users');
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return false;
        } else {
            return true;
        }
    }

    public function doc_delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('student_doc');
    }
    
     public function pickup_delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('pickup_person');
    }
    
    
    public function delete($tablename,$field,$value)
	{
		$this->db->where($field,$value);
		$this->db->delete($tablename);
	 	return true;
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
            $this->db->update('students', $data);
        } else {
            $this->db->insert('students', $data);
            return $this->db->insert_id();
        }
    }

    public function add_student_sibling($data_sibling) {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('student_sibling', $data_sibling);
        } else {
            $this->db->insert('student_sibling', $data_sibling);
            return $this->db->insert_id();
        }
    }

    public function add_student_session($data) {
        $this->db->where('session_id', $session_id = $this->setting_model->getCurrentSession());
        $this->db->where('student_id', $data['student_id']);
        $q = $this->db->get('student_session');
        
        if ($q->num_rows() > 0) {
            $rec = $q->row_array();
           
            $this->db->where('id', $rec['id']);
            $this->db->update('student_session', $data);
            
  
        } else {
            $this->db->insert('student_session', $data);
            return $this->db->insert_id();
        }
    }
    public function add_pass_student($data) {
        $this->db->where('session_id', $data['session_id']);
        $this->db->where('student_id', $data['student_id']);
        $q = $this->db->get('pass_student');
        if ($q->num_rows() > 0) {
            $rec = $q->row_array();
            $this->db->where('id', $rec['id']);
            $this->db->update('pass_student', $data);
        } else {
            $this->db->insert('pass_student', $data);
            return $this->db->insert_id();
        }
    }

    public function add_student_session_update($data) {
        $this->db->where('session_id', $data['session_id']);
        $q = $this->db->get('student_session');
        if ($q->num_rows() > 0) {
            $this->db->where('session_id', $student_session);
            $this->db->update('student_session', $data);
        } else {
            $this->db->insert('student_session', $data);
            return $this->db->insert_id();
        }
    }

    public function adddoc($data) {
        $this->db->insert('student_doc', $data);
        return $this->db->insert_id();
    }
    
     public function getpickups($id) {
        $this->db->select()->from('pickup_person');
        $this->db->where('student_id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }
    
  public function addpickup($data) {
        $this->db->insert('pickup_person', $data);
       
        return $this->db->insert_id();
    }

    public function read_siblings_students($ids_comma) {
        $query = $this->db->query('select * from students WHERE id in (' . $ids_comma . ')');
        return $query->result_array();
    }

    public function getAttedenceByDateandClass($date) {
        $sql = "SELECT IFNULL(student_attendences.id, 0) as attencence FROM `student_session`left JOIN student_attendences on student_attendences.student_session_id=student_session.id and student_attendences.date=" . $this->db->escape($date) . " and student_attendences.attendence_type_id != 2 where student_session.class_id=7 and student_session.session_id=$this->current_session";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function searchCurrentSessionStudents() {
        $this->db->select('classes.id AS `class_id`,student_session.id as student_session_id,students.id,classes.class,sections.id AS `section_id`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode ,     students.religion,     students.dob ,students.current_address,    students.permanent_address,IFNULL(students.category_id, 0) as `category_id`,IFNULL(categories.category, "") as `category`,students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.father_name,students.gender')->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('categories', 'students.category_id = categories.id', 'left');
       $this->db->where('student_session.session_id', $this->current_session);

        $this->db->order_by('students.firstname', 'asc');

        $query = $this->db->get();
        return $query->result_array();
    }

    public function searchLibraryStudent($class_id = null, $section_id = null, $school = null, $inter_class = null) {
        $this->db->select('classes.id AS `class_id`,student_session.id as student_session_id,students.id,classes.class,sections.id AS `section_id`,
           IFNULL(libarary_members.id,0) as `libarary_member_id`,
           IFNULL(libarary_members.library_card_no,0) as `library_card_no`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode ,     students.religion,     students.dob ,students.current_address,    students.permanent_address,IFNULL(students.category_id, 0) as `category_id`,IFNULL(categories.category, "") as `category`,students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.father_name,students.gender')->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('categories', 'students.category_id = categories.id', 'left');
        $this->db->join('libarary_members', 'libarary_members.member_id = students.id and libarary_members.member_type = "student"', 'left');


       $this->db->where('student_session.session_id', $this->current_session);
        if ($class_id != null) {
            $this->db->where('student_session.class_id', $class_id);
        }
        if ($section_id != null) {
            $this->db->where('student_session.section_id', $section_id);
        }
        
         if ($school != null) {
            $this->db->where('student_session.school', $school);
        }
        if ($inter_class != null) {
            $this->db->where('student_session.inter_class', $inter_class);
        }
        $this->db->order_by('students.id');

        $query = $this->db->get();
        return $query->result_array();
    }

    public function searchNameLike($searchterm) {
        $this->db->select('classes.id AS `class_id`,students.id,classes.class,sections.id AS `section_id`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode ,     students.religion,     students.dob ,students.current_address,    students.permanent_address,IFNULL(students.category_id, 0) as `category_id`,IFNULL(categories.category, "") as `category`,      students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code ,students.father_name , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.gender,student_session.session_id')->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('categories', 'students.category_id = categories.id', 'left');
       $this->db->where('student_session.session_id', $this->current_session);
        $this->db->group_start();
        $this->db->like('students.firstname', $searchterm);
        $this->db->or_like('students.lastname', $searchterm);
        $this->db->group_end();
        $this->db->order_by('students.id');

        $query = $this->db->get();
        return $query->result_array();
    }

    public function searchGuardianNameLike($searchterm) {
        $this->db->select('classes.id AS `class_id`,students.id,classes.class,sections.id AS `section_id`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode ,     students.religion,     students.dob ,students.current_address,    students.permanent_address,IFNULL(students.category_id, 0) as `category_id`,IFNULL(categories.category, "") as `category`,students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code ,students.father_name , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.gender,students.guardian_email,student_session.session_id')->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('categories', 'students.category_id = categories.id', 'left');
        $this->db->where('student_session.session_id', $this->current_session);
        $this->db->group_start();
        $this->db->like('students.guardian_name', $searchterm);

        $this->db->group_end();
        $this->db->order_by('students.id');

        $query = $this->db->get();
        return $query->result_array();
    }

}
