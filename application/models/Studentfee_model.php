<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Studentfee_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
        $this->current_date = $this->setting_model->getDateYmd();
    }

    public function getStudentFeesArray($ids = null, $student_session_id) {
        $query = "SELECT feemasters.id as feemastersid, feemasters.amount as amount,IFNULL(student_fees.id, 'xxx') as invoiceno,IFNULL(student_fees.payment_mode, 'xxx') as payment_mode,IFNULL(student_fees.amount_discount, 'xxx') as discount,IFNULL(student_fees.amount_fine, 'xxx') as fine, IFNULL(student_fees.date, 'xxx') as date,feetype.type ,feecategory.category FROM feemasters LEFT JOIN (select student_fees.id,student_fees.payment_mode,student_fees.feemaster_id,student_fees.amount_fine,student_fees.amount_discount,student_fees.date,student_fees.student_session_id from student_fees , student_session where student_fees.student_session_id=student_session.id and student_session.id=" . $this->db->escape($student_session_id) . ") as student_fees ON student_fees.feemaster_id=feemasters.id LEFT JOIN feetype ON feemasters.feetype_id = feetype.id LEFT JOIN feecategory ON feetype.feecategory_id = feecategory.id where feemasters.id IN (" . $ids . ")";

        $query = $this->db->query($query);
        return $query->result_array();
    }

    public function getTotalCollectionBydate($date) {
        $sql = "SELECT sum(amount) as `amount`, SUM(amount_discount) as `amount_discount` ,SUM(amount_fine) as `amount_fine` FROM `student_fees` where date=" . $this->db->escape($date);
        $query = $this->db->query($sql);
        return $query->row();
    }

    public function getStudentFees($id = null) {
        $this->db->select('feecategory.category,student_fees.id as `invoiceno`,student_fees.date,student_fees.id,student_fees.amount,student_fees.amount_discount,student_fees.amount_fine,student_fees.created_at,feetype.type')->from('student_fees');
        $this->db->join('student_session', 'student_session.id = student_fees.student_session_id');
        $this->db->join('feemasters', 'feemasters.id = student_fees.feemaster_id');
        $this->db->join('feetype', 'feetype.id = feemasters.feetype_id');
        $this->db->join('feecategory', 'feetype.feecategory_id = feecategory.id');
        $this->db->where('student_session.student_id', $id);
        $this->db->where('student_session.session_id', $this->current_session);
        $this->db->order_by('student_fees.id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getFeeByInvoice($id = null) {
        $this->db->select('feecategory.category,student_fees.date,student_fees.payment_mode,student_fees.id as `student_fee_id`,student_fees.amount,student_fees.amount_discount,student_fees.amount_fine,student_fees.created_at,classes.class,sections.section,feetype.type,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode ,     students.religion,students.dob ,students.current_address,    students.permanent_address,students.category_id,    students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name, students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.rte')->from('student_fees');
        $this->db->join('student_session', 'student_session.id = student_fees.student_session_id');
        $this->db->join('feemasters', 'feemasters.id = student_fees.feemaster_id');
        $this->db->join('feetype', 'feetype.id = feemasters.feetype_id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('feecategory', 'feetype.feecategory_id = feecategory.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('students', 'students.id = student_session.student_id');
        $this->db->where('student_fees.id', $id);
        $this->db->where('student_session.session_id', $this->current_session);
        $this->db->order_by('student_fees.id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getTodayStudentFees() {
        $this->db->select('student_fees.date,student_fees.id,student_fees.amount,student_fees.amount_discount,student_fees.amount_fine,student_fees.created_at,classes.class,sections.section,students.firstname,students.lastname,students.admission_no,students.roll_no,students.dob,students.guardian_name,feetype.type')->from('student_fees');
        $this->db->join('student_session', 'student_session.id = student_fees.student_session_id');
        $this->db->join('feemasters', 'feemasters.id = student_fees.feemaster_id');
        $this->db->join('feetype', 'feetype.id = feemasters.feetype_id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('students', 'students.id = student_session.student_id');
        $this->db->where('student_fees.date', $this->current_date);
        $this->db->where('student_session.session_id', $this->current_session);
        $this->db->order_by('student_fees.id');
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * This function will delete the record based on the id
     * @param $id
     */
    public function remove($id) {
        $this->db->where('id', $id);
        $qry=$this->db->delete("fee_collection");
        if($qry)
        {
        $this->db->where('header_id', $id);
        $this->db->delete("fee_collection_details");
        }
       
    }



    function getnoPaidfeesearch($class=null, $section=null,$school=null,$search_text=null)
    {

            $this->db->select("fee_collection.*,students.*,classes.class,sections.section");
            $this->db->join("fee_collection","students.id =fee_collection.student_id",'inner');
            $this->db->join("student_session","students.id =student_session.student_id",'inner');
            $this->db->join("classes","student_session.class_id =classes.id","inner");
            $this->db->join("sections","student_session.section_id =sections.id","inner");
            
            if($class !=null)
            {
            $this->db->where("student_session.class_id",$class);

            }
            
             if($section !=null)
            {
            
             $this->db->where("student_session.section_id",$section);

            }

             if($school !=null)
            {
            
             $this->db->where("students.school",$school);

            }
            
            
          //  $this->db->like("fee_collection.created_at",date("Y"),'after');
            $query=$this->db->order_by("fee_collection.created_at")->get("students");
            
           return $query->result_array();
    }



    function getPaidfeesearch($class=null, $section=null,$school=null,$from=null,$to=null)
    {

            $this->db->select("fee_collection.*,students.*,classes.class,sections.section");
            $this->db->join("fee_collection","students.id =fee_collection.student_id",'inner');
            $this->db->join("student_session","students.id =student_session.student_id",'inner');
            $this->db->join("classes","student_session.class_id =classes.id","inner");
            $this->db->join("sections","student_session.section_id =sections.id","inner");
            
            if($class !=null)
            {
            $this->db->where("student_session.class_id",$class);

            }
            
             if($section !=null)
            {
            
             $this->db->where("student_session.section_id",$section);

            }

             if($school !=null)
            {
            
             $this->db->where("students.school",$school);

            }

             if($from !=null && $to !=null)
            {
            
            $this->db->where('paydate >=', $from);
            $this->db->where('paydate <=', $to);
            }
            
            
            
          //  $this->db->like("fee_collection.created_at",date("Y"),'after');
            $query=$this->db->order_by("fee_collection.created_at")->get("students");
            
           return $query->result_array();
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
            $this->db->update('student_fees', $data);
        } else {
            $this->db->insert('student_fees', $data);
            return $this->db->insert_id();
        }
    }

    public function getDueStudentFees($feegroup_id = null, $fee_groups_feetype_id = null, $class_id = null, $section_id = null) {

        $query = "SELECT IFNULL(student_fees_deposite.id, 0) as student_fees_deposite_id, IFNULL(student_fees_deposite.fee_groups_feetype_id, 0) as fee_groups_feetype_id, IFNULL(student_fees_deposite.amount_detail, 0) as amount_detail, student_fees_master.id as `fee_master_id`,fee_groups_feetype.feetype_id ,fee_groups_feetype.amount,fee_groups_feetype.due_date, `classes`.`id` AS `class_id`, `student_session`.`id` as `student_session_id`, `students`.`id`, `classes`.`class`, `sections`.`id` AS `section_id`, `sections`.`section`, `students`.`id`, `students`.`admission_no`, `students`.`roll_no`, `students`.`admission_date`, `students`.`firstname`, `students`.`lastname`, `students`.`image`, `students`.`mobileno`, `students`.`email`, `students`.`state`, `students`.`city`, `students`.`pincode`, `students`.`religion`, `students`.`dob`, `students`.`current_address`, `students`.`permanent_address`, IFNULL(students.category_id, 0) as `category_id`, IFNULL(categories.category, '') as `category`, `students`.`adhar_no`, `students`.`samagra_id`, `students`.`bank_account_no`, `students`.`bank_name`, `students`.`ifsc_code`, `students`.`guardian_name`, `students`.`guardian_relation`, `students`.`guardian_phone`, `students`.`guardian_address`, `students`.`is_active`, `students`.`created_at`, `students`.`updated_at`, `students`.`father_name`, `students`.`rte`, `students`.`gender` FROM `students` JOIN `student_session` ON `student_session`.`student_id` = `students`.`id` JOIN `classes` ON `student_session`.`class_id` = `classes`.`id` JOIN `sections` ON `sections`.`id` = `student_session`.`section_id` LEFT JOIN `categories` ON `students`.`category_id` = `categories`.`id` INNER JOIN student_fees_master on student_fees_master.student_session_id=student_session.id and student_fees_master.fee_session_group_id=" . $this->db->escape($feegroup_id) . " LEFT JOIN student_fees_deposite on student_fees_deposite.student_fees_master_id=student_fees_master.id and student_fees_deposite.fee_groups_feetype_id=" . $this->db->escape($fee_groups_feetype_id) . "  INNER JOIN fee_groups_feetype on fee_groups_feetype.id = " . $this->db->escape($fee_groups_feetype_id) . " WHERE `student_session`.`session_id` = " . $this->current_session . " AND `student_session`.`class_id` = " . $this->db->escape($class_id) . " AND `student_session`.`section_id` = " . $this->db->escape($section_id) . " ORDER BY `students`.`id`";
        $query = $this->db->query($query);
        return $query->result_array();
    }

    public function getDueFeeBystudent($class_id = null, $section_id = null, $student_id = null) {
        $query = "SELECT feemasters.id as feemastersid, feemasters.amount as amount,IFNULL(student_fees.id, 'xxx') as invoiceno,IFNULL(student_fees.amount_discount, 'xxx') as discount,IFNULL(student_fees.amount_fine, 'xxx') as fine,IFNULL(student_fees.payment_mode, 'xxx') as payment_mode,IFNULL(student_fees.date, 'xxx') as date,feetype.type ,feecategory.category,student_fees.description FROM feemasters LEFT JOIN (select student_fees.id,student_fees.feemaster_id,student_fees.payment_mode,student_fees.amount_fine,student_fees.amount_discount,student_fees.date,student_fees.student_session_id,student_fees.description  from student_fees , student_session where student_fees.student_session_id=student_session.id and student_session.student_id=" . $this->db->escape($student_id) . " and student_session.class_id=" . $this->db->escape($class_id) . " and student_session.section_id=" . $this->db->escape($section_id) . ") as student_fees ON student_fees.feemaster_id=feemasters.id JOIN feetype ON feemasters.feetype_id = feetype.id JOIN feecategory ON feetype.feecategory_id = feecategory.id  where  feemasters.class_id=" . $this->db->escape($class_id) . " and feemasters.session_id=" . $this->db->escape($this->current_session);
        $query = $this->db->query($query);
        return $query->result_array();
    }

    public function getDueFeeBystudentSection($class_id = null, $section_id = null, $student_session_id = null) {
        $query = "SELECT feemasters.id as feemastersid, feemasters.amount as amount,IFNULL(student_fees.id, 'xxx') as invoiceno,IFNULL(student_fees.amount_discount, 'xxx') as discount,IFNULL(student_fees.amount_fine, 'xxx') as fine, IFNULL(student_fees.date, 'xxx') as date,feetype.type ,feecategory.category FROM feemasters LEFT JOIN (select student_fees.id,student_fees.feemaster_id,student_fees.amount_fine,student_fees.amount_discount,student_fees.date,student_fees.student_session_id from student_fees , student_session where student_fees.student_session_id=student_session.id and student_session.id=" . $this->db->escape($student_session_id) . " ) as student_fees ON student_fees.feemaster_id=feemasters.id LEFT JOIN feetype ON feemasters.feetype_id = feetype.id LEFT JOIN feecategory ON feetype.feecategory_id = feecategory.id  where  feemasters.class_id=" . $this->db->escape($class_id) . " and feemasters.session_id=" . $this->db->escape($this->current_session);
        $query = $this->db->query($query);
        return $query->result_array();
    }

    public function getFeesByClass($class_id = null, $section_id = null, $student_id = null) {
        $query = "SELECT feemasters.id as feemastersid, feemasters.amount as amount,IFNULL(student_fees.id, 'xxx') as invoiceno,IFNULL(student_fees.amount_discount, 'xxx') as discount,IFNULL(student_fees.amount_fine, 'xxx') as fine, IFNULL(student_fees.date, 'xxx') as date,feetype.type ,feecategory.category FROM feemasters LEFT JOIN (select student_fees.id,student_fees.feemaster_id,student_fees.amount_fine,student_fees.amount_discount,student_fees.date,student_fees.student_session_id from student_fees , student_session where student_fees.student_session_id=student_session.id and student_session.student_id=" . $this->db->escape($student_id) . " and student_session.class_id=" . $this->db->escape($class_id) . " and student_session.section_id=" . $this->db->escape($section_id) . ") as student_fees ON student_fees.feemaster_id=feemasters.id LEFT JOIN feetype ON feemasters.feetype_id = feetype.id LEFT JOIN feecategory ON feetype.feecategory_id = feecategory.id  where  feemasters.class_id=" . $this->db->escape($class_id) . " and feemasters.session_id=" . $this->db->escape($this->current_session);
        $query = $this->db->query($query);
        return $query->result_array();
    }

    public function getFeeBetweenDate($start_date, $end_date) {

        $this->db->select('student_fees.date,student_fees.id,student_fees.amount,student_fees.amount_discount,student_fees.amount_fine,student_fees.created_at,students.rte,classes.class,sections.section,students.firstname,students.lastname,students.admission_no,students.roll_no,students.dob,students.guardian_name,feetype.type')->from('student_fees');
        $this->db->join('student_session', 'student_session.id = student_fees.student_session_id');
        $this->db->join('feemasters', 'feemasters.id = student_fees.feemaster_id');
        $this->db->join('feetype', 'feetype.id = feemasters.feetype_id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('students', 'students.id = student_session.student_id');
        $this->db->where('student_fees.date >=', $start_date);
        $this->db->where('student_fees.date <=', $end_date);
        $this->db->where('student_session.session_id', $this->current_session);
        $this->db->order_by('student_fees.id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getStudentTotalFee($class_id, $student_session_id) {
        $query = "SELECT a.totalfee,b.fee_deposit,b.payment_mode  FROM ( SELECT COALESCE(sum(amount),0) as totalfee FROM `feemasters` WHERE session_id =$this->current_session and class_id=" . $this->db->escape($class_id) . ") as a, (select COALESCE(sum(amount),0) as fee_deposit,payment_mode from student_fees WHERE student_session_id =" . $this->db->escape($student_session_id) . ") as b";
        $query = $this->db->query($query);
        return $query->row();
    }

    
    function get_editdata($id)
    {
        $this->db->select("fee_collection.*,fee_collection_details.*,fee_groups.name as fgname");
        $this->db->join("fee_collection_details","fee_collection.id =fee_collection_details.header_id",'inner');
        $this->db->join("fee_groups","fee_collection_details.feegroup_id =fee_groups.id",'inner');
        // $this->db->group_by("fee_collection_details.feegroup_id");
        $this->db->order_by("fee_collection_details.feegroup_id");
        $this->db->where("fee_collection.id",$id);
        $query=$this->db->get("fee_collection");
        return $query;
      
    }


    function get($status=null,$class=0,$section=0)
    {
       
            $this->db->select("students.*,fee_collection.paydate as fcdate,fee_collection.*,classes.class,sections.section");
            $this->db->join("fee_collection","students.id =fee_collection.student_id",'inner');
            $this->db->join("student_session","students.id =student_session.student_id",'inner');
            $this->db->join("classes","student_session.class_id =classes.id","inner");
            $this->db->join("sections","student_session.section_id =sections.id","inner");
            
            if($class !=0)
            {
            $this->db->where("fee_collection.class",$class);

            }
             if($section !=0)
            {
             $this->db->where("fee_collection.section",$section);
            }
            
            $this->db->where("student_session.session_id",$this->current_session);
            
            $this->db->like("student_session.created_at",date("Y"),'after');
            $query=$this->db->order_by("fee_collection.created_at","DESC")->get("students");
            
           
           return $query->result_array();

   
        
       
    }
    
    
    function getBalance($status=null,$class=0,$section=0)
    {
      
        //     $this->db->select("balance_fee.*,classes.class,sections.section,fee_groups.amount as total_amount, students.admission_no,students.firstname,students.lastname,students.father_name");
        //     $this->db->join("students","students.id =balance_fee.student_id","left");
        //     $this->db->join("student_session","students.id =balance_fee.student_id","inner");
        //     $this->db->join("classes","balance_fee.class_id =classes.id","inner");
        //     $this->db->join("sections","student_session.section_id =sections.id");
        //     $this->db->join("fee_groups","balance_fee.feegroup_id=fee_groups.id");
            
        //     // if($class !=0)
        //     // {
        //     // $this->db->where("fee_collection.class",$class);
        //     // }
            
        //     // if($section !=0)
        //     // {
            
        //     //  $this->db->where("fee_collection.section",$section);

        //     // }
            
        //   //  $this->db->like("student_session.created_at",date("Y"),'after');
          
        //     $query=$this->db->order_by("balance_fee.created_at")->get("balance_fee");
        
            $session_id=$this->setting_model->getCurrentSession();
            $query=$this->db->query("SELECT balance_fee.*,classes.class,sections.section,fee_groups.amount as total_amount, students.admission_no,students.firstname,students.lastname,students.father_name,fee_groups.id as feegroup_id FROM balance_fee LEFT JOIN students ON balance_fee.student_id=students.id INNER JOIN student_session ON students.id=student_session.student_id JOIN sections ON student_session.section_id =sections.id LEFT JOIN classes ON balance_fee.class_id=classes.id LEFT JOIN fee_groups ON balance_fee.feegroup_id=fee_groups.id WHERE student_session.session_id='$session_id'");
            // echo $query->num_rows(); exit;
            return $query->result_array();

    }
    
    
    
    function getBalanceById($mid)
    {
            $session_id=$this->setting_model->getCurrentSession();
            
            // $this->db->select("students.*,classes.class,sections.section,balance_fee.status as status,balance_fee.id as bid,balance_fee.payment_for as payment_for,fee_groups.amount as total_amount");
            // $this->db->join("student_session","students.id =student_session.student_id",'inner');
            // $this->db->join("classes","student_session.class_id =classes.id","inner");
            // $this->db->join("sections","student_session.section_id =sections.id","inner");
            // $this->db->join("balance_fee","students.id=balance_fee.student_id","inner");
            // $this->db->join("fee_groups","balance_fee.feegroup_id=fee_groups.id");
            
            
            // $this->db->where("balance_fee.mid",$mid);
            // $this->db->like("student_session.created_at",date("Y"),'after');
            // $query=$this->db->order_by("balance_fee.created_at")->get("students");
            
            $query=$this->db->query("SELECT balance_fee.*,classes.class,sections.section,fee_groups.amount as total_amount, students.admission_no,students.firstname,students.lastname,students.father_name,fee_groups.id as feegroup_id FROM balance_fee LEFT JOIN students ON balance_fee.student_id=students.id INNER JOIN student_session ON students.id=student_session.student_id JOIN sections ON student_session.section_id =sections.id LEFT JOIN classes ON balance_fee.class_id=classes.id LEFT JOIN fee_groups ON balance_fee.feegroup_id=fee_groups.id WHERE student_session.session_id='$session_id' AND balance_fee.mid='$mid'");
            
           return $query->result_array();
    }
	
	
	
	 function studentfeesMonthlyReport($status=0,$month)
    {
      
        if($status==1)
        {
            $this->db->select("students.*,fee_collection.paydate as fcdate,fee_collection.*,classes.class,sections.section");
            $this->db->join("fee_collection","students.id =fee_collection.student_id",'inner');
            $this->db->join("student_session","students.id =student_session.student_id",'inner');
            $this->db->join("classes","student_session.class_id =classes.id","inner");
            $this->db->join("sections","student_session.section_id =sections.id","inner");
            $this->db->where("fee_collection.status",$status);
			$this->db->where("fee_collection.payment_for",$month);
            $this->db->like("fee_collection.created_at",date("Y"),'after');
            $query=$this->db->order_by("fee_collection.created_at")->get("students");
            
        }   

        else
        {
            $this->db->select("students.*,classes.class,sections.section");
            $this->db->join("student_session","students.id =student_session.student_id",'inner');
            $this->db->join("classes","student_session.class_id =classes.id","inner");
            $this->db->join("sections","student_session.section_id =sections.id","inner");
            $this->db->like("fee_collection.created_at",date("Y"),'after');
            $this->db->group_by("student_session.student_id");
			$this->db->where("fee_collection.payment_for",$month);
            $query=$this->db->order_by("students.admission_no")->get("students");
        
        }
        
        return $query->result_array();
    }

   
    function getEachstudentFee($stu_id)
    {            $session_id=$this->setting_model->getCurrentSession();

         $this->db->select("students.*,fee_collection.paydate as fcdate,fee_collection.*,classes.class,sections.section");
        $this->db->join("fee_collection","students.id =fee_collection.student_id",'inner');
        $this->db->join("student_session","students.id =student_session.student_id",'inner');
        $this->db->join("classes","student_session.class_id =classes.id","inner");
        $this->db->join("sections","student_session.section_id =sections.id","inner");
        $this->db->where("student_session.session_id",$session_id);
        $this->db->where("fee_collection.student_id",$stu_id);
        $this->db->where("fee_collection.paydate>","2019-02");
        $query=$this->db->order_by("fee_collection.paydate")->get("students");
    
            return $query;
	}


function studentfeesMonthlyreportSearch($status,$month,$class=NULL,$section=NUll,$search_text=NULL,$school=NULL)
	{

		$this->db->select("students.*,fee_collection.paydate as fcdate,fee_collection.*,classes.class,sections.section");
        $this->db->join("fee_collection","students.id =fee_collection.student_id",'inner');
        $this->db->join("student_session","students.id =student_session.student_id",'inner');
        $this->db->join("classes","student_session.class_id =classes.id","inner");
        $this->db->join("sections","student_session.section_id =sections.id","inner");
         if($class!=NULL)
        {
            $this->db->where("student_session.class_id",$class);

        }
        if($section!=NULL)
        {
        $this->db->where("student_session.section_id",$section);
        
        }

         if($search_text!=NULL)
        {
        $this->db->where("students.admission_no",$search_text);
        
        }

        if($school!=NULL)
        {
        $this->db->where("students.school",$school);
        
        }
      
		$this->db->where("fee_collection.payment_for",$month);
		$this->db->like("fee_collection.created_at",date("Y"));
        $this->db->where("fee_collection.status",$status);
        $query=$this->db->order_by("students.admission_no")->get("students");
		
	   
        return $query->result_array();
		
    }
	
	
	
function studentfeesYearlyReport($status,$year)
	{
		
		$this->db->select("students.*,fee_collection.paydate as fcdate,fee_collection.*,classes.class,sections.section");
        $this->db->join("fee_collection","students.id =fee_collection.student_id",'inner');
        $this->db->join("student_session","students.id =student_session.student_id",'inner');
        $this->db->join("classes","student_session.class_id =classes.id","inner");
        $this->db->join("sections","student_session.section_id =sections.id","inner");
       	$this->db->like("fee_collection.created_at",$year);
        $this->db->where("fee_collection.status",$status);
        $query=$this->db->order_by("fee_collection.paydate","ASC")->get("students");
		
        return $query->result_array();
		
    }
	
	
	
function studentfeesYearlyreportSearch($status,$year,$class=NULL,$section=NULL,$search_text=NULL,$school=NULL)
	{
		
		$this->db->select("students.*,fee_collection.paydate as fcdate,fee_collection.*,classes.class,sections.section");
        $this->db->join("fee_collection","students.id =fee_collection.student_id",'inner');
        $this->db->join("student_session","students.id =student_session.student_id",'inner');
        $this->db->join("classes","student_session.class_id =classes.id","inner");
        $this->db->join("sections","student_session.section_id =sections.id","inner");
         if($class!=NULL)
        {
            $this->db->where("student_session.class_id",$class);

        }
        if($section!=NULL)
        {
        $this->db->where("student_session.section_id",$section);
        
        }

        if($search_text!=NULL)
        {
        $this->db->where("students.admission_no",$search_text);
        
        }
        
         if($school!=NULL)
        {
        $this->db->where("students.school",$school);
        
        }

		$this->db->like("fee_collection.created_at",$year);
        $this->db->where("fee_collection.status",$status);
        $query=$this->db->order_by("fee_collection.paydate","ASC")->get("students");
		
	   
        return $query->result_array();
		
    }



    
function studentfeesDailyReport($status,$day)
    {
        
        $this->db->select("students.*,fee_collection.paydate as fcdate,fee_collection.*,classes.class,sections.section");
        $this->db->join("fee_collection","students.id =fee_collection.student_id",'inner');
        $this->db->join("student_session","students.id =student_session.student_id",'inner');
        $this->db->join("classes","student_session.class_id =classes.id","inner");
        $this->db->join("sections","student_session.section_id =sections.id","inner");
        $this->db->like("fee_collection.paydate",$day);
        $this->db->where("fee_collection.status",$status);
        
        $query=$this->db->order_by("fee_collection.payment_for","DESC")->get("students");
      
        return $query->result_array();
        
    }
    
    
    
function studentfeesDailyreportSearch($status,$day,$class=NULL,$section=NULL,$search_text=NULL,$school=NULL)
    {
        
        $this->db->select("students.*,fee_collection.paydate as fcdate,fee_collection.*,classes.class,sections.section");
        $this->db->join("fee_collection","students.id =fee_collection.student_id",'inner');
        $this->db->join("student_session","students.id =student_session.student_id",'inner');
        $this->db->join("classes","student_session.class_id =classes.id","inner");
        $this->db->join("sections","student_session.section_id =sections.id","inner");
        if($class!=NULL)
        {
            $this->db->where("student_session.class_id",$class);

        }
        if($section!=NULL)
        {
        $this->db->where("student_session.section_id",$section);
        
        }
         if($search_text!=NULL)
        {
        $this->db->where("students.admission_no",$search_text);
        
        }
        
         if($school!=NULL)
        {
        $this->db->where("students.school",$school);
        
        }
        $this->db->like("fee_collection.paydate",$day);
        $this->db->where("fee_collection.status",$status);
        $query=$this->db->order_by("fee_collection.payment_for","DESC")->get("students");
 
   
        return $query->result_array();
        
    }

    
	

}
