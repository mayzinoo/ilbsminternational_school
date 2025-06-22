<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Course extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('smsgateway');
        $this->load->library('mailsmsconf');
        error_reporting(1);
        $this->load->helper('file');
        $this->load->library('auth');
        $this->lang->load('message', 'english');
        $this->load->model("Common_model");
        $this->load->model("Course_model");
    }

    function index() {
        $data["for"]=date("F");
        $data["title"]="";
        $data["duration"]="";
        $data["fees"]="";
        $this->session->set_userdata('top_menu', 'Courses');
        $this->session->set_userdata('sub_menu', 'Course/index');
        $data["school"]=$this->Common_model->grab_school();
        if($this->uri->segment(3)=="search")
        {
            $title=$this->input->post("title");
            $duration=$this->input->post("duration");
            $fees=$this->input->post("fees");
            
            $this->db->select("lectured_courses.*,teachers.name as teacher_name"); 
            $this->db->join("teachers","teachers.id=lectured_courses.teacher",'left');
            if($this->input->post("title")!="")
            {
            $this->db->like("lectured_courses.title",$title);
            }
            if($this->input->post("duration")!="")
            {
            $this->db->like("lectured_courses.duration",$duration);
            }
            if($this->input->post("fees")!="")
            {
            $this->db->where("lectured_courses.fees",$fees);
            }
            $data['resultlist']=$this->db->order_by("lectured_courses.id","DESC")->get("lectured_courses");
            $data["title"]=$title;
            $data["duration"]=$duration;
            $data["fees"]=$fees;
            
        }
        else
        {
            $resultlist = $this->Course_model->lectured_courses();
            $data['resultlist'] =$resultlist;
        }
        
        $this->load->view('layout/header', $data);
        $this->load->view('course/lectured_courses', $data);
        $this->load->view('layout/footer', $data);
    }
    


    function insert_data() {
        $form=$this->uri->segment(3);
        $data["courselists"]=$this->Course_model->grab_lecture_course();
        $data["studentlist"]=$this->Course_model->grab_student();
        $data["teacherlist"]=$this->Common_model->grab_teacher();
        $this->load->view('layout/header', $data);
        $this->load->view('course/'.$form, $data);
        $this->load->view('layout/footer', $data);
    }
    
    function edit_data() {
        $form=$this->uri->segment(3);
        $id=$this->uri->segment(4);
        $data["row"]=$this->Course_model->get_data($form,$id);
        $data["teacherlist"]=$this->Common_model->grab_teacher();
        $data["studentlist"]=$this->Course_model->grab_student();
        $data["courselists"]=$this->Course_model->grab_lecture_course();
        $this->load->view('layout/header', $data);
        $this->load->view('course/edit_'.$form.'_form', $data);
        $this->load->view('layout/footer', $data);
    }
    
    
     function delete_data() {

        $form=$this->uri->segment(3);
        $id=$this->uri->segment(4);
        $this->db->where("id",$id);
        $this->db->delete($form);
        if($form=="lectured_courses")
        {
            redirect("Course/index");
        }
        else
        {
            redirect("Course/".$form);
        }
    }


    function courses_subject()
    {
        $data["for"]=date("F");
        $data["teacher_id"]="";
        $data["subject"]="";
        $data["teacherlist"]=$this->Common_model->grab_teacher();
        $this->session->set_userdata('top_menu', 'Courses');
        $this->session->set_userdata('sub_menu', 'Course/courses_subject');
        // $data["school"]=$this->Common_model->grab_school();
        if($this->uri->segment(3)=="search")
        {
            $teacher_id=$this->input->post("teacher_id");
            $subject=$this->input->post("subject");

            $this->db->select("courses_subject.*,teachers.name as teacher_name,lectured_courses.title as name"); 
            $this->db->join("teachers","teachers.id=courses_subject.teacher",'left');
            $this->db->join("lectured_courses","lectured_courses.id=courses_subject.lectured_course_id",'left');
             
            if($this->input->post("teacher_id")!="")
            {
            $this->db->where("courses_subject.teacher",$teacher_id);
            }
            if($this->input->post("subject")!="")
            {
            $this->db->like("courses_subject.subject",$subject);
            }
           
            $data['resultlist']=$this->db->order_by("courses_subject.id","DESC")->get("courses_subject"); 
            $data["teacher_id"]=$teacher_id;
            $data["subject"]=$subject;

        }
        else
        {
        $resultlist = $this->Course_model->courses_subject();
        $data['resultlist'] =$resultlist;
        }
       
        $this->load->view('layout/header', $data);
        $this->load->view('course/courses_subject', $data);
        $this->load->view('layout/footer', $data);
    }
    
    
    function courses_register()
    {
        $data["for"]=date("F");
        $data["student_id"]="";
        $data["course_id"]="";
        $data["courselists"]=$this->Course_model->grab_lecture_course();
        $data["studentlist"]=$this->Course_model->grab_student();
        $data["teacherlist"]=$this->Common_model->grab_teacher();
        
        $this->session->set_userdata('top_menu', 'Courses');
        $this->session->set_userdata('sub_menu', 'Course/courses_register');
        // $data["school"]=$this->Common_model->grab_school();
        
        if($this->uri->segment(3)=="search")
        {
            $student_id=$this->input->post("student_id");
            $course_id=$this->input->post("course_id");

            $this->db->select("courses_register.*,lectured_courses.title as title"); 
            $this->db->join("lectured_courses","courses_register.lecture_course_id=lectured_courses.id",'left');
        
            if($this->input->post("student_id")!="")
            {
            $this->db->where("courses_register.student_id",$student_id);
            }
            if($this->input->post("course_id")!="")
            {
            $this->db->where("courses_register.lecture_course_id",$course_id);
            }
           
            $data['resultlist']=$this->db->order_by("courses_register.id","DESC")->get("courses_register");
            $data["student_id"]=$student_id;
            $data["course_id"]=$course_id;
        }
        else
        {
        $resultlist = $this->Course_model->courses_register();
        $data['resultlist'] =$resultlist;
        }
        
        $this->load->view('layout/header', $data);
        $this->load->view('course/courses_register', $data);
        $this->load->view('layout/footer', $data);
    }
    
    
    function course_fee_balance()
    {
        $data["for"]=date("F");
        $data["fromdate"]="";
        $data["todate"]="";
        $this->session->set_userdata('top_menu', 'Courses');
        $this->session->set_userdata('sub_menu', 'Course/course_fee_balance');
        // $data["school"]=$this->Common_model->grab_school();
        
        if($this->uri->segment(3)=="search")
        {
            $fromdate=date("Y-m-d",strtotime($this->input->post("fromdate")));
            $todate=date("Y-m-d",strtotime($this->input->post("todate")));

            $this->db->select("course_fee_balance.*,students.firstname as fname,students.lastname as lname,lectured_courses.title as lctitle"); 
        $this->db->join("students","students.id=course_fee_balance.student_id",'left');
        $this->db->join("lectured_courses","lectured_courses.id=course_fee_balance.lecture_course_id",'left');
        
        
            if($this->input->post("fromdate")!="" && $this->input->post("todate")!="")
            {
            $this->db->where("course_fee_balance.due_date >=",$fromdate);
            $this->db->where("course_fee_balance.due_date <=",$todate);
            }
            
            $data['resultlist']=$this->db->order_by("course_fee_balance.id","DESC")->get("course_fee_balance");
            
            $data["fromdate"]=$fromdate;
            $data["todate"]=$todate;
        }
        else
        {
        $resultlist = $this->Course_model->course_fee_balance();
        $data['resultlist'] =$resultlist;
        }
        
        $this->load->view('layout/header', $data);
        $this->load->view('course/course_fee_balance', $data);
        $this->load->view('layout/footer', $data);
    }
    
    function course_fee_receive()
    {
        $data["for"]=date("F");
        $data["fromdate"]="";
        $data["todate"]="";
        $this->session->set_userdata('top_menu', 'Courses');
        $this->session->set_userdata('sub_menu', 'Course/course_fee_receive');
        // $data["school"]=$this->Common_model->grab_school();
        
        if($this->uri->segment(3)=="search")
        {
            $fromdate=date("Y-m-d",strtotime($this->input->post("fromdate")));
            $todate=date("Y-m-d",strtotime($this->input->post("todate")));

            $this->db->select("course_fee_receive.*,students.firstname as fname,students.lastname as lname,lectured_courses.title as lctitle"); 
            $this->db->join("students","students.id=course_fee_receive.student_id",'left');
            $this->db->join("lectured_courses","lectured_courses.id=course_fee_receive.lecture_course_id",'left');
             
        
            if($this->input->post("fromdate")!="" && $this->input->post("todate")!="")
            {
            $this->db->where("course_fee_receive.paydate >=",$fromdate);
            $this->db->where("course_fee_receive.paydate <=",$todate);
            }
            
            $data['resultlist']=$this->db->order_by("course_fee_receive.id","DESC")->get("course_fee_receive");   
            
            $data["fromdate"]=$fromdate;
            $data["todate"]=$todate;
        }
        else
        {
        $resultlist = $this->Course_model->course_fee_receive();
        $data['resultlist'] =$resultlist;
        }
        
        $this->load->view('layout/header', $data);
        $this->load->view('course/course_fee_receive', $data);
        $this->load->view('layout/footer', $data);
    }
    
    
    function create_course() {
        
        $title=$this->input->post("title");
        $description=$this->input->post("description");
        $teacher=$this->input->post("teacher");
        $start_date=date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('start_date')));
        $end_date=date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('end_date')));
        $duration=$this->input->post("duration");
        $certificate=$this->input->post("certificate");
        $fees=$this->input->post("fees");
        
        $data=array("title"=>$title,
                    "description"=>$description,
                    "teacher"=>$teacher,
                    "start_date"=>$start_date,
                    "end_date"=>$end_date,
                    "duration"=>$duration,
                    "certificate"=>$certificate,
                    "fees"=>$fees);
        $query=$this->db->insert("lectured_courses",$data);
        if($query)
        {
            
        }
        else
        {
            $err= $this->db->error();
            echo $err["message"];
        }
        
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Successfully Saved</div>');
        redirect(base_url()."Course/insert_data/lectured_courses_form");
        // $data["teacherlist"]=$this->Common_model->grab_teacher();
        // $this->load->view('layout/header', $data);
        // $this->load->view('course/lectured_courses_form', $data);
        // $this->load->view('layout/footer', $data);
    }
    
    
    function update_course()
    {
        $id=$this->input->post("id");
        $title=$this->input->post("title");
        $description=$this->input->post("description");
        $teacher=$this->input->post("teacher");
        $start_date=date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('start_date')));
        $end_date=date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('end_date')));
        $duration=$this->input->post("duration");
        $certificate=$this->input->post("certificate");
        $fees=$this->input->post("fees");
        
        $data=array("title"=>$title,
                    "description"=>$description,
                    "teacher"=>$teacher,
                    "start_date"=>$start_date,
                    "end_date"=>$end_date,
                    "duration"=>$duration,
                    "certificate"=>$certificate,
                    "fees"=>$fees);
                    
                    $this->db->where("id",$id);
        $query=$this->db->update("lectured_courses",$data);
        if($query)
        {
            
        }
        else
        {
            $err= $this->db->error();
            echo $err["message"];
        }
        
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Successfully Updated</div>');
        redirect(base_url()."Course/edit_data/lectured_courses/".$id);
    }
    
    
    function create_courses_subject() {
        
        $subject=$this->input->post("subject");
        $description=$this->input->post("description");
        $teacher=$this->input->post("teacher");
        $lectured_course_id=$this->input->post("lecture_course_id");
       
        $data=array("lectured_course_id"=>$lectured_course_id,
                    "subject"=>$subject,
                    "description"=>$description,
                    "teacher"=>$teacher
                    );
        $query=$this->db->insert("courses_subject",$data);
        if($query)
        {
            
        }
        else
        {
            $err= $this->db->error();
            echo $err["message"];
        }
        
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Successfully Saved</div>');
        redirect(base_url()."Course/insert_data/courses_subject_form");
    }
    
    
    function update_courses_subject()
    {
        $id=$this->input->post("id");
        $subject=$this->input->post("subject");
        $description=$this->input->post("description");
        $teacher=$this->input->post("teacher");
        $lectured_course_id=$this->input->post("lecture_course_id");
        $data=array("lectured_course_id"=>$lectured_course_id,
                    "subject"=>$subject,
                    "description"=>$description,
                    "teacher"=>$teacher
                    );
        $this->db->where("id",$id);         
        $query=$this->db->update("courses_subject",$data);
        if($query)
        {
            
        }
        else
        {
            $err= $this->db->error();
            echo $err["message"];
        }
        
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Successfully Updated</div>');
        redirect(base_url()."Course/edit_data/courses_subject/".$id);
    }
    
    
    
    function create_courses_register() {
        $photo="";
        $student_id=$this->input->post("student_id");
        $name=$this->input->post("name");
        $nrc=$this->input->post("nrc");
        $parent=$this->input->post("parent");
        $phone=$this->input->post("phone");
        $address=$this->input->post("address");
        $email=$this->input->post("email");
        $lecture_course_id=$this->input->post("lecture_course_id");
        $register_date=date("Y-m-d",strtotime($this->input->post("register_date")));
        $start_date=date("Y-m-d",strtotime($this->input->post("start_date")));
        $end_date=date("Y-m-d",strtotime($this->input->post("end_date")));
        $fees=$this->input->post("fees");
        if($_FILES["student_photo"]["name"] !=""){
                $p=$this->Course_model->img_upload('student_photo');
			    $p=str_replace(" ","_",$_FILES['student_photo']['name']);
			    $photo="uploads/student_images/".$photo;
            }
            else
            {   
                $photo=$this->input->post("photoselect");
            }
       
       
        $data=array("student_id"=>$student_id,
                    "name"=>$name,
                    "nrc"=>$nrc,
                    "parent"=>$parent,
                    "phone"=>$phone,
                    "address"=>$address,
                    "email"=>$email,
                    "lecture_course_id"=>$lecture_course_id,
                    "register_date"=>$register_date,
                    "start_date"=>$start_date,
                    "end_date"=>$end_date,
                    );
        $query=$this->db->insert("courses_register",$data);
        if($query)
        {
            $cfbdata=array("lecture_course_id"=>$lecture_course_id,
                            "student_id"=>$student_id,
                            "fees"=>$fees,
                            "due_date"=>$start_date,
                            "final_fees"=>$fees,
                            "balance"=>$fees
            );
            
            $this->db->insert("course_fee_balance",$cfbdata);
        }
        else
        {
            $err= $this->db->error();
            echo $err["message"];
        }
        
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Successfully Saved</div>');
        redirect(base_url()."Course/insert_data/courses_register_form");
    }
    
    
    function update_courses_register()
    {
        $id=$this->input->post("id");
        $photo="";
        $student_id=$this->input->post("student_id");
        $name=$this->input->post("name");
        $nrc=$this->input->post("nrc");
        $parent=$this->input->post("parent");
        $phone=$this->input->post("phone");
        $address=$this->input->post("address");
        $email=$this->input->post("email");
        $lecture_course_id=$this->input->post("lecture_course_id");
        $register_date=date("Y-m-d",strtotime($this->input->post("register_date")));
        $start_date=date("Y-m-d",strtotime($this->input->post("start_date")));
        $end_date=date("Y-m-d",strtotime($this->input->post("end_date")));
        $fees=$this->input->post("fees");
        
    //     if($_FILES["student_photo"]["name"] !=""){
    //             $p=$this->Course_model->img_upload('student_photo');
			 //   $p=str_replace(" ","_",$_FILES['student_photo']['name']);
			 //   $photo="uploads/student_images/".$p;
    //         }
    //         else
    //         {   
    //             $photo=$this->input->post("image");
    //         }
       
       
        $data=array("student_id"=>$student_id,
                    "name"=>$name,
                    "nrc"=>$nrc,
                    "parent"=>$parent,
                    "phone"=>$phone,
                    "address"=>$address,
                    "email"=>$email,
                    "lecture_course_id"=>$lecture_course_id,
                    "register_date"=>$register_date,
                    "start_date"=>$start_date,
                    "end_date"=>$end_date,
                    );
            $this->db->where("id",$id);         
        $query=$this->db->update("courses_register",$data);
        if($query)
        {
            
        }
        else
        {
            $err= $this->db->error();
            echo $err["message"];
        }
        
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Successfully Updated</div>');
        redirect(base_url()."Course/edit_data/courses_register/".$id);
    }
    
    
    function insert_receive() {
        $dpercent=0;
        $discount=0;
        $feebalance_id=$this->input->post("id"); 
        $pay_amt=$this->input->post("pay_amt");
        $balance=$this->input->post("balance");
        $dpercent=$this->input->post("dpercent");
        $discount=$this->input->post("discount");
        $paydate=date("Y-m-d",strtotime($this->input->post("paydate")));
        $start_date=date("Y-m-d",strtotime($this->input->post("start_date")));
        // echo $paydate; exit;
        $fees=$this->input->post("final_fees");
        
        $row=$this->db->query("SELECT * FROM course_fee_balance WHERE id=$feebalance_id ");
        if($row->num_rows()==1)
        {
            $result=$row->row();
            $lecture_course_id=$result->lecture_course_id;
            $student_id=$result->student_id;
            $fees=$fees - $discount;
        
        $data=array("lecture_course_id"=>$lecture_course_id,
                    "student_id"=>$student_id,
                    "fees"=>$fees,
                    "paydate"=>$paydate,
                    "pay_amount"=>$pay_amt,
                    "balance"=>$balance
                    );
                    
            $query=$this->db->insert("course_fee_receive",$data);
            if($query)
            {
                if($dpercent != 0 || $discount != 0)
                {
                    $ddata=array("dpercent"=>$dpercent,
                                 "discount"=>$discount
                                );
                $this->db->where("id",$feebalance_id);
                $this->db->update("course_fee_balance",$ddata);
                }
                
                $paytotal=$result->pay_amount+$pay_amt;
                $data=array(
                        "pay_amount"=>$paytotal,
                        "balance"=>$balance
                                );
                $this->db->where("id",$feebalance_id);
                $this->db->update("course_fee_balance",$data);
                
                if($balance==0)
                {   
                    $this->db->where("id",$feebalance_id);
                    $this->db->delete("course_fee_balance");
                }
            }
            else
            {
                $err= $this->db->error();
                echo $err["message"];
            }
        
        }
        
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Successfully Saved</div>');
        redirect(base_url()."Course/course_fee_receive");
    }
    

    function pdf() {
        $this->load->helper('pdf_helper');
    }

    function Paidsearch() {
        $data['title'] = 'Student Search';
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $button = $this->input->post('search');
        $data["school"]=$this->Common_model->grab_school();

        if ($this->input->server('REQUEST_METHOD') == "GET") {

            $data['resultlist'] =$this->student_model->getallstus();

            $this->load->view('layout/header', $data);
            $this->load->view('studentfee/studentfeePaidlist', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $class = $this->input->post('class_id');
            $section = $this->input->post('section_id');
            $search = $this->input->post('search');
            $status = $this->input->post('status');
            $search_text = $this->input->post('search_text');
            $school = $this->input->post('school');
            $from = $this->input->post('from');
            $to = $this->input->post('to');


            if (isset($search)) {


                $resultlist = $this->studentfee_model->getPaidfeesearch($class, $section,$school,$from,$to);
                $data['resultlist'] = $resultlist;
                $this->load->view('layout/header', $data);
                $this->load->view('studentfee/studentfeePaidlist', $data);
                $this->load->view('layout/footer', $data);

            }
        }
    }


      function noPaidsearch() {
        $data['title'] = 'Student Search';
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $button = $this->input->post('search');
        $data["school"]=$this->Common_model->grab_school();

        if ($this->input->server('REQUEST_METHOD') == "GET") {

            $data['resultlist'] =$this->student_model->getallstus();

            $this->load->view('layout/header', $data);
            $this->load->view('studentfee/studentfeeNoPaidlist', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $class = $this->input->post('class_id');
            $section = $this->input->post('section_id');
            $search = $this->input->post('search');
            $status = $this->input->post('status');
            $search_text = $this->input->post('search_text');
            $school = $this->input->post('school');

            if (isset($search)) {

                $resultlist = $this->studentfee_model->getnoPaidfeesearch($class, $section,$school,$search_text);
                $data['resultlist'] = $resultlist;

                $this->load->view('layout/header', $data);
                $this->load->view('studentfee/studentfeeNoPaidlist', $data);
                $this->load->view('layout/footer', $data);
            }
        }
    }

    function feesearch() {
        $this->session->set_userdata('top_menu', 'Fees Collection');
        $this->session->set_userdata('sub_menu', 'studentfee/feesearch');
        $data['title'] = 'student fees';
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $feesessiongroup = $this->feesessiongroup_model->getFeesByGroup();

        $data['feesessiongrouplist'] = $feesessiongroup;
        $this->form_validation->set_rules('feegroup_id', 'Fee Group', 'trim|required|xss_clean');

        $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('studentfee/studentSearchFee', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data['student_due_fee'] = array();
            $feegroup_id = $this->input->post('feegroup_id');
            $feegroup = explode("-", $feegroup_id);
            $feegroup_id = $feegroup[0];
            $fee_groups_feetype_id = $feegroup[1];
            $class_id = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');
            $student_due_fee = $this->studentfee_model->getDueStudentFees($feegroup_id, $fee_groups_feetype_id, $class_id, $section_id);
            if (!empty($student_due_fee)) {
                foreach ($student_due_fee as $student_due_fee_key => $student_due_fee_value) {
                    $amt_due = $student_due_fee_value['amount'];
                    $a = json_decode($student_due_fee_value['amount_detail']);
                    if (!empty($a)) {
                        $amount = 0;
                        foreach ($a as $a_key => $a_value) {
                            $amount = $amount + $a_value->amount;
                        }
                        if ($amt_due <= $amount) {
                            unset($student_due_fee[$student_due_fee_key]);
                        } else {

                            $student_due_fee[$student_due_fee_key]['amount_detail'] = $amount;
                        }
                    }
                }
            }

            $data['student_due_fee'] = $student_due_fee;
            $this->load->view('layout/header', $data);
            $this->load->view('studentfee/studentSearchFee', $data);
            $this->load->view('layout/footer', $data);
        }
    }

    

    function reportbyname() {
        $this->session->set_userdata('top_menu', 'Fees Collection');
        $this->session->set_userdata('sub_menu', 'studentfee/reportbyname');
        $data['title'] = 'student fees';
        $data['title'] = 'student fees';
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        if ($this->input->server('REQUEST_METHOD') == "GET") {
            $this->load->view('layout/header', $data);
            $this->load->view('studentfee/reportByName', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
            $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
            $this->form_validation->set_rules('student_id', 'Student', 'trim|required|xss_clean');
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('layout/header', $data);
                $this->load->view('studentfee/reportByName', $data);
                $this->load->view('layout/footer', $data);
            } else {
                $data['student_due_fee'] = array();
                $class_id = $this->input->post('class_id');
                $section_id = $this->input->post('section_id');
                $student_id = $this->input->post('student_id');
                $student = $this->student_model->get($student_id);
                $data['student'] = $student;
                $student_due_fee = $this->studentfeemaster_model->getStudentFees($student['student_session_id']);
                $student_discount_fee = $this->feediscount_model->getStudentFeesDiscount($student['student_session_id']);
                $data['student_discount_fee'] = $student_discount_fee;
                $data['student_due_fee'] = $student_due_fee;
                $data['class_id'] = $class_id;
                $data['section_id'] = $section_id;
                $data['student_id'] = $student_id;
                $category = $this->category_model->get();
                $data['categorylist'] = $category;
                $this->load->view('layout/header', $data);
                $this->load->view('studentfee/reportByName', $data);
                $this->load->view('layout/footer', $data);
            }
        }
    }

    function reportbyclass() {
        $data['title'] = 'student fees';
        $data['title'] = 'student fees';
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        if ($this->input->server('REQUEST_METHOD') == "GET") {
            $this->load->view('layout/header', $data);
            $this->load->view('studentfee/reportByClass', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $student_fees_array = array();
            $class_id = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');
            $student_result = $this->student_model->searchByClassSection($class_id, $section_id);
            $data['student_due_fee'] = array();
            if (!empty($student_result)) {
                foreach ($student_result as $key => $student) {
                    $student_array = array();
                    $student_array['student_detail'] = $student;
                    $student_session_id = $student['student_session_id'];
                    $student_id = $student['id'];
                    $student_due_fee = $this->studentfee_model->getDueFeeBystudentSection($class_id, $section_id, $student_session_id);
                    $student_array['fee_detail'] = $student_due_fee;
                    $student_fees_array[$student['id']] = $student_array;
                }
            }
            $data['class_id'] = $class_id;
            $data['section_id'] = $section_id;
            $data['student_fees_array'] = $student_fees_array;
            $this->load->view('layout/header', $data);
            $this->load->view('studentfee/reportByClass', $data);
            $this->load->view('layout/footer', $data);
        }
    }

    function view($id) {
        $data['title'] = 'studentfee List';

        $student_id=$this->uri->segment(4);
        $student = $this->student_model->get($student_id);
        $data['student'] = $student;

        $studentfee = $this->studentfee_model->get_editdata($id);
        
        $data['studentfee'] = $studentfee;
        $this->load->view('layout/header', $data);
        $this->load->view('studentfee/studentfeeShow', $data);
        $this->load->view('layout/footer', $data);
    }


   
    function printvoc($id) {
        $data['title'] = 'studentfee List';

        $student_id=$this->uri->segment(4);
        $student = $this->student_model->get($student_id);
        $schid=$student["school"];

        $data['student'] = $student;

        $studentfee = $this->studentfee_model->get_editdata($id);
        $setting_result = $this->setting_model->getsettinglistByid($schid);
        $data['settinglist'] = $setting_result;
        $data['studentfee'] = $studentfee;

        $this->load->view('studentfee/studentfeePrint', $data);
        
    }

    function deleteFee() {

        $invoice_id = $this->input->post('main_invoice');
        $sub_invoice = $this->input->post('sub_invoice');
        if (!empty($invoice_id)) {
            $this->studentfee_model->remove($invoice_id, $sub_invoice);
        }
        $array = array('status' => 'success', 'result' => 'success');
        echo json_encode($array);
    }

    function deleteStudentDiscount() {

        $discount_id = $this->input->post('discount_id');
        if (!empty($discount_id)) {
            $data = array('id' => $discount_id, 'status' => 'assigned', 'payment_id' => "");
            $this->feediscount_model->updateStudentDiscount($data);
        }
        $array = array('status' => 'success', 'result' => 'success');
        echo json_encode($array);
    }


    function create($id) {
		
		 date_default_timezone_set("Asia/Rangoon");
		 $created_at= date("Y-m-d H:i:s");

        $data['title'] = 'Student Detail';
        $this->form_validation->set_rules('class_id', 'Class ID', 'trim|required|xss_clean');
        
        if ($this->form_validation->run() == FALSE) {

            $this->load->view('layout/header', $data);
            $this->load->view('studentfee/studentAddfee', $data);
            $this->load->view('layout/footer', $data);
        } else {
        
        $class_id=$this->input->post("class_id");
        $feegroupid=$this->input->post("feegroupid");
        
        // $feegrouprow=$this->db->get_where("fee_groups",array("id"=>"$feegroupid"))->row();
        // $row=$this->db->get_where("student_session",array("class_id"=>$class_id));
          
       for($j=0;$j<12;$j++)
       {
          
        if($this->input->post("month".$j) != "")
        {
            
            $row=$this->db->get_where("student_session",array("class_id"=>$class_id))->result_array();
            
            foreach($row as $totalrow)
            {
            
            $data = array(
                'class_id' => $class_id,
                "student_id"=>$totalrow['student_id'],
                'feegroup_id' => $feegroupid,
                'payment_for' => $this->input->post('month'.$j),
                'status' => 0,             
                'created_at' => $created_at,   
            );

           
            $qry=$this->db->insert("balance_fee",$data);          
            //  $header_id=$this->db->insert_id();
             
            //     $data2=array(
            //                 "header_id"=>$header_id,
            //                 'created_at' => $created_at,
            //         );

            //     $qry=$this->db->insert("balance_fee_details",$data2);
                 if($qry)
           {

           }
           else
           {
            $err= $this->db->error();
            echo $err["message"];
           }

            }
         }            
        }

            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Set Balance added successfully</div>');
           redirect(base_url()."admin/feegroup");
           // $this->printvoc($header_id);
        }
    }
    
    
    function payment_method()
    {
        $this->session->set_userdata('top_menu', 'Fees Collection');
        $this->session->set_userdata('sub_menu', 'studentfee/payment_method');
        $data['title'] = 'student fees';
        $data['title_list'] = 'Recent Payment Method';
         $this->form_validation->set_rules(
                'payment', 'Payment Method', 'required'
                );
        if ($this->form_validation->run() == FALSE) {
            
        } else {
            $data = array(
                'payment' => $this->input->post('payment'),
            );
            $this->db->insert("payment_method",$data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Payment Method added successfully</div>');
            redirect('studentfee/payment_method');
        }
        $payment = $this->db->get("payment_method");
        $data['paymentlists'] = $payment->result_array();
        
        $this->load->view('layout/header', $data);
        $this->load->view('admin/feegroup/payment_method_list', $data);
        $this->load->view('layout/footer', $data);
    
    }
    
    
        function edit_payment() {
        $this->session->set_userdata('top_menu', 'Fees Collection');
        $this->session->set_userdata('sub_menu', 'studentfee/payment_method');
        $id=$this->uri->segment(3);
        $data['payment'] = $this->db->get_where("payment_method",array("id"=>$id))->row();
        $payment = $this->db->get("payment_method");
        $data['paymentlists'] = $payment->result_array();
        $this->form_validation->set_rules(
                'payment', 'Payment Method', 'required'
                );

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/feegroup/payment_method_edit', $data);
            $this->load->view('layout/footer', $data);
        } else {
            
            $id=$this->input->post("id");
            $data = array(
                'payment' => $this->input->post('payment'),
            );
           $this->db->where("id",$id);
           $this->db->update("payment_method",$data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Payment Method updated successfully</div>');
            redirect('studentfee/payment_method');
        }
    }
    
    function delete_payment()
    {
        $id=$this->uri->segment(3); 
        $qrl=$this->db->delete('payment_method', array('id' => $id)); 
        redirect('studentfee/payment_method');
    }


    function addfee($id) {
        $bid=$this->uri->segment(4);
        $data['title'] = 'Student Detail';
        $student = $this->student_model->get($id);
        $data['student'] = $student;

        $data['id'] = $id;
        
        $data["paymenttype"]=$this->Common_model->grab_paymenttype();
        $data["feegroups"]=$this->Common_model->grab_feegroup();
        $data['monthlist'] = $this->customlib->getMonthDropdown();
        $data['monthlists'] = $this->customlib->getMonthLists();
        // $data['monthlist'] = $this->customlib->getMonthDropdown();
        $data['row']=$this->db->query("SELECT balance_fee.*,fee_groups.amount as amount FROM balance_fee LEFT JOIN fee_groups ON balance_fee.feegroup_id=fee_groups.id WHERE balance_fee.id='$bid'")->row();
        
        $this->load->view('layout/header', $data);
        $this->load->view('balancefee/balanceAddfee', $data);
        $this->load->view('layout/footer', $data);
    }

    function deleteTransportFee() {
        $id = $this->input->post('feeid');
        $this->studenttransportfee_model->remove($id);
        $array = array('status' => 'success', 'result' => 'success');
        echo json_encode($array);
    }

  function delete() {
        $id=$this->uri->segment(4);
        $form=$this->uri->segment(3);
        $this->db->where("id",$id);
        $this->db->delete($form);
        redirect('Course/'.$form);
    }
   


    function edit($id) {

        $data['title'] = 'Edit studentfees';
        $data['id'] = $id;
        $student_id=$this->uri->segment(4);
        $student = $this->student_model->get($student_id);
        $data['student'] = $student;
        $data['monthlist'] = $this->customlib->getMonthDropdown();
        $data["paymenttype"]=$this->Common_model->grab_paymenttype();

        $studentfee = $this->studentfee_model->get_editdata($id);
        $data['studentfee'] = $studentfee;
        $data["feegroups"]=$this->Common_model->grab_feegroup();

        $this->form_validation->set_rules('feegroup[]', 'Fee Group', 'trim|required|xss_clean');
        $this->form_validation->set_rules('discount[]', 'Discount', 'trim|required|xss_clean');
        $this->form_validation->set_rules('receive[]', 'Receive', 'trim|required|xss_clean');
        $this->form_validation->set_rules('alltotal', 'alltotal', 'trim|required|xss_clean');
        $this->form_validation->set_rules('date', 'date', 'trim|required|xss_clean');
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('studentfee/studentfeeEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {
             $paydate= date("Y-m-d",strtotime($this->input->post('date'))).date(", h:i:s");
            $data = array(
                'total_amount' => $this->input->post('alltotal'),
                'total_received' => $this->input->post('alltotal'),
                'paydate' => $paydate,
                'payment_for' => $this->input->post('payment_for'),
                'payment_mode' => $this->input->post('payment_method'),   
                'authority'=> $this->customlib->getAdminSessionUserName()
            );

            $this->db->where("id",$id);
            $this->db->update("fee_collection",$data);          
            $this->db->where("header_id",$id)->delete("fee_collection_details");


            $amount=$this->input->post("amount");
            $receive=$this->input->post("receive");
            $discount=$this->input->post("discount");
            $feegroup=$this->input->post("feegroup");

            for($i=0;$i<count($amount);$i++)
            {
                $data=array(
                            "header_id"=>$id,
                            "feegroup_id"=>$feegroup[$i],
                            "amount"=>$amount[$i],
                            "amount_discount"=>$discount[$i],
                            "receive"=>$receive[$i],
                            'date' => date("Y-m-d",strtotime($this->input->post('date')))
                    );

                $qry=$this->db->insert("fee_collection_details",$data);
                 if($qry)
           {

           }
           else
           {
            $err= $this->db->error();
            echo $err["message"];
           }

            }



            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Fees Collection added successfully</div>');
            redirect('Studentfee/index/1');
        }
    }

    function addstudentfee() {

        $this->form_validation->set_rules('student_fees_master_id', 'Fee Master', 'required|trim|xss_clean');
        $this->form_validation->set_rules('fee_groups_feetype_id', 'Student', 'required|trim|xss_clean');
        $this->form_validation->set_rules('amount', 'Amount', 'required|trim|xss_clean');
        $this->form_validation->set_rules('amount_discount', 'Discount', 'required|trim|xss_clean');
        $this->form_validation->set_rules('amount_fine', 'Fine', 'required|trim|xss_clean');
        $this->form_validation->set_rules('payment_mode', 'Payment Mode', 'required|trim|xss_clean');
        if ($this->form_validation->run() == false) {
            $data = array(
                'amount' => form_error('amount'),
                'student_fees_master_id' => form_error('student_fees_master_id'),
                'fee_groups_feetype_id' => form_error('fee_groups_feetype_id'),
                'amount_discount' => form_error('amount_discount'),
                'amount_fine' => form_error('amount_fine'),
                'payment_mode' => form_error('payment_mode'),
            );
            $array = array('status' => 'fail', 'error' => $data);
            echo json_encode($array);
        } else {
            $collected_by = " Collected By: " . $this->customlib->getAdminSessionUserName();
            $json_array = array(
                'amount' => $this->input->post('amount'),
                'date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date'))),
                'amount_discount' => $this->input->post('amount_discount'),
                'amount_fine' => $this->input->post('amount_fine'),
                'description' => $this->input->post('description') . $collected_by,
                'payment_mode' => $this->input->post('payment_mode')
            );
            $data = array(
                'student_fees_master_id' => $this->input->post('student_fees_master_id'),
                'fee_groups_feetype_id' => $this->input->post('fee_groups_feetype_id'),
                'amount_detail' => $json_array
            );

            $send_to = $this->input->post('guardian_phone');
            $email = $this->input->post('guardian_email');
            $inserted_id = $this->studentfeemaster_model->fee_deposit($data, $send_to);

            $sender_details = array('invoice' => $inserted_id, 'contact_no' => $send_to, 'email' => $email);
            $this->mailsmsconf->mailsms('fee_submission', $sender_details);

            $array = array('status' => 'success', 'error' => '');
            echo json_encode($array);
        }
    }

    function printFeesByName() {
        $data = array('payment' => "0");

        $record = $this->input->post('data');
        $invoice_id = $this->input->post('main_invoice');
        $sub_invoice_id = $this->input->post('sub_invoice');
        $student_session_id = $this->input->post('student_session_id');
        $setting_result = $this->setting_model->get();
        $data['settinglist'] = $setting_result;
        $student = $this->studentsession_model->searchStudentsBySession($student_session_id);

        $fee_record = $this->studentfeemaster_model->getFeeByInvoice($invoice_id, $sub_invoice_id);
        $data['student'] = $student;
        $data['sub_invoice_id'] = $sub_invoice_id;
        $data['feeList'] = $fee_record;
        $this->load->view('print/printFeesByName', $data);
    }

    function printFeesByGroup() {
        $fee_groups_feetype_id = $this->input->post('fee_groups_feetype_id');
        $fee_master_id = $this->input->post('fee_master_id');
        $fee_session_group_id = $this->input->post('fee_session_group_id');
        $setting_result = $this->setting_model->get();
        $data['settinglist'] = $setting_result;
        $data['feeList'] = $this->studentfeemaster_model->getDueFeeByFeeSessionGroupFeetype($fee_session_group_id, $fee_master_id, $fee_groups_feetype_id);

        $this->load->view('print/printFeesByGroup', $data);
    }

    function printFeesByGroupArray() {
        $setting_result = $this->setting_model->get();
        $data['settinglist'] = $setting_result;
        $record = $this->input->post('data');
        $record_array = json_decode($record);
        $fees_array = array();
        foreach ($record_array as $key => $value) {
            $fee_groups_feetype_id = $value->fee_groups_feetype_id;
            $fee_master_id = $value->fee_master_id;
            $fee_session_group_id = $value->fee_session_group_id;
            $feeList = $this->studentfeemaster_model->getDueFeeByFeeSessionGroupFeetype($fee_session_group_id, $fee_master_id, $fee_groups_feetype_id);
            $fees_array[] = $feeList;
        }
        $data['feearray'] = $fees_array;
        $this->load->view('print/printFeesByGroupArray', $data);
    }

    function searchpayment() {
        $this->session->set_userdata('top_menu', 'Fees Collection');
        $this->session->set_userdata('sub_menu', 'studentfee/searchpayment');
        $data['title'] = 'Edit studentfees';


        $this->form_validation->set_rules('paymentid', 'Payment ID', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            
        } else {
            $paymentid = $this->input->post('paymentid');
            $invoice = explode("/", $paymentid);

            if (array_key_exists(0, $invoice) && array_key_exists(1, $invoice)) {
                $invoice_id = $invoice[0];
                $sub_invoice_id = $invoice[1];
                $feeList = $this->studentfeemaster_model->getFeeByInvoice($invoice_id, $sub_invoice_id);
                $data['feeList'] = $feeList;
                $data['sub_invoice_id'] = $sub_invoice_id;
            } else {
                $data['feeList'] = array();
            }
        }
        $this->load->view('layout/header', $data);
        $this->load->view('studentfee/searchpayment', $data);
        $this->load->view('layout/footer', $data);
    }

    function addfeegroup() {
        $this->form_validation->set_rules('fee_session_groups', 'Fee Group', 'required|trim|xss_clean');
        $this->form_validation->set_rules('student_session_id[]', 'Student', 'required|trim|xss_clean');

        if ($this->form_validation->run() == false) {
            $data = array(
                'fee_session_groups' => form_error('fee_session_groups'),
                'student_session_id[]' => form_error('student_session_id[]'),
            );
            $array = array('status' => 'fail', 'error' => $data);
            echo json_encode($array);
        } else {
            $fee_session_groups = $this->input->post('fee_session_groups');
            $student_sesssion_array = $this->input->post('student_session_id');
            $student_ids = $this->input->post('student_ids');
            $delete_student = array_diff($student_ids, $student_sesssion_array);

            $preserve_record = array();
            foreach ($student_sesssion_array as $key => $value) {

                $insert_array = array(
                    'student_session_id' => $value,
                    'fee_session_group_id' => $fee_session_groups,
                );
                $inserted_id = $this->studentfeemaster_model->add($insert_array);

                $preserve_record[] = $inserted_id;
            }
            if (!empty($delete_student)) {
                $this->studentfeemaster_model->delete($fee_session_groups, $delete_student);
            }

            $array = array('status' => 'success', 'error' => '', 'message' => 'Record Saved Successfully');
            echo json_encode($array);
        }
    }

    function geBalanceFee() {
        $this->form_validation->set_rules('fee_groups_feetype_id', 'fee_groups_feetype_id', 'required|trim|xss_clean');
        $this->form_validation->set_rules('student_fees_master_id', 'student_fees_master_id', 'required|trim|xss_clean');

        if ($this->form_validation->run() == false) {
            $data = array(
                'fee_groups_feetype_id' => form_error('fee_groups_feetype_id'),
                'student_fees_master_id' => form_error('student_fees_master_id'),
            );
            $array = array('status' => 'fail', 'error' => $data);
            echo json_encode($array);
        } else {
            $data = array();
            $data['fee_groups_feetype_id'] = $this->input->post('fee_groups_feetype_id');
            $data['student_fees_master_id'] = $this->input->post('student_fees_master_id');

            $result = $this->studentfeemaster_model->studentDeposit($data);
            $amount_balance = 0;
            $amount = 0;
            $amount_fine = 0;
            $amount_discount = 0;
            $amount_detail = json_decode($result->amount_detail);

            if (is_object($amount_detail)) {

                foreach ($amount_detail as $amount_detail_key => $amount_detail_value) {
                    $amount = $amount + $amount_detail_value->amount;
                    $amount_discount = $amount_discount + $amount_detail_value->amount_discount;
                    $amount_fine = $amount_fine + $amount_detail_value->amount_fine;
                }
            }

            $amount_balance = $result->amount - ($amount + $amount_discount);
            $array = array('status' => 'success', 'error' => '', 'balance' => $amount_balance);
            echo json_encode($array);
        }
    }


    function studentfeesMonthlyReport()
    {
        $this->session->set_userdata('top_menu', 'Fees Collection');
        $this->session->set_userdata('sub_menu', 'studentfee/studentfeesMonthlyReport');
		$this->session->set_userdata('sel_month', date("F"));
		$month=date("F");

		$data['monthlist'] = $this->customlib->getMonthDropdown();
        $data["school"]=$this->Common_model->grab_school();

        $status=1;
        $data["for"]=date("F");
     
        $data['title'] = 'student fees';
        $resultlist = $this->Studentfee_model->studentfeesMonthlyReport($status,$month);
        $data['resultlist'] =$resultlist;
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $this->load->view('layout/header', $data);
        $this->load->view('studentfee/studentfeesMonthlyReport', $data);
        $this->load->view('layout/footer', $data);
    
    }
	
	
	
    function studentfeesMonthlyreportPrint()
    {
        
        $status=1;
		$month=$this->session->userdata("sel_month");
		$data["sel_month"]=$month;

        $this->session->set_userdata('top_menu', 'Fees Collection');
        $this->session->set_userdata('sub_menu', 'studentfee/studentfeesMonthlyReport');
        $data['title'] = 'student fees';
        $resultlist = $this->Studentfee_model->studentfeesMonthlyReport($status,$month);
        $data['resultlist'] =$resultlist;
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $this->load->view('studentfee/studentfeesMonthlyreportPrint', $data);
    
    }
	
	
 function studentfeesMonthlyreportSearch()
    {
		$this->session->set_userdata('top_menu', 'Fees Collection');
        $this->session->set_userdata('sub_menu', 'studentfee/studentfeesMonthlyReport');
		$month=$this->input->post("payment_for");
		$class=$this->input->post("class_id");
		$section=$this->input->post("section_id");
        $search_text=$this->input->post("search_text");

        $sel_school=$this->input->post("school");
        $data["school"]=$this->Common_model->grab_school();

        $data["sel_school"]=$sel_school;



		$data["sel_month"]=$month;
		$data["section"]=$section;
		$data["class"]=$class;
		$this->session->set_userdata('sel_month',$month);
        $this->session->set_userdata("class_id",$class);
        $this->session->set_userdata("section_id",$section);
        $this->session->set_userdata("search_text",$search_text);
        $this->session->set_userdata("sel_school",$sel_school);

		$data['monthlist'] = $this->customlib->getMonthDropdown();

        $status=1;
        $data["for"]=date("F");
     
        $data['title'] = 'student fees';
        $resultlist = $this->Studentfee_model->studentfeesMonthlyreportSearch($status,$month,$class,$section,$search_text,$school);
        $data['resultlist'] =$resultlist;
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $this->load->view('layout/header', $data);
        $this->load->view('studentfee/studentfeesMonthlyReportSearch', $data);
        $this->load->view('layout/footer', $data);
    
    }
	
	 function studentfeesMonthlyreportSearchPrint()
    {
		$this->session->set_userdata('top_menu', 'Fees Collection');
        $this->session->set_userdata('sub_menu', 'studentfee/studentfeesMonthlyReport');
		$month=$this->session->userdata("sel_month");
		$class=$this->session->userdata("class_id");
        $section=$this->session->userdata("section_id");
        $search_text=$this->session->userdata("search_text");
        $sel_school=$this->session->userdata("sel_school");
        $data["school"]=$this->Common_model->grab_school();
		$data["sel_month"]=$month;

		$data['monthlist'] = $this->customlib->getMonthDropdown();

        $status=1;
      
        $data['title'] = 'student fees';
        $resultlist = $this->Studentfee_model->studentfeesMonthlyreportSearch($status,$month,$class,$section,$search_text,$sel_school);
        $data['resultlist'] =$resultlist;
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $this->load->view('studentfee/studentfeesMonthlyreportPrint', $data);
    
    }
	
	
	
	function studentfeesYearlyReport()
    {
        $this->session->set_userdata('top_menu', 'Fees Collection');
        $this->session->set_userdata('sub_menu', 'studentfee/studentfeesYearlyReport');
		$year=date("Y");
		$this->session->set_userdata('sel_year', $year);
		$data["sel_year"]=$year;
		
		        $data["school"]=$this->Common_model->grab_school();


        $status=1;
      
        $data['title'] = 'student fees';
        $resultlist = $this->Studentfee_model->studentfeesYearlyReport($status,$year);
        $data['resultlist'] =$resultlist;
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $this->load->view('layout/header', $data);
        $this->load->view('studentfee/studentfeesYearlyReport', $data);
        $this->load->view('layout/footer', $data);
    
    }
	
    function studentfeesYearlyreportPrint()
    {
        
        $status=1;
		$year=$this->session->userdata("sel_year");
		$sel_school=$this->session->userdata("sel_school");

        $data["sel_school"]=$sel_school;

        $this->session->set_userdata("sel_school",$sel_school);

		$data["sel_year"]=$year;
        $data["school"]=$this->Common_model->grab_school();

        $this->session->set_userdata('top_menu', 'Fees Collection');
        $this->session->set_userdata('sub_menu', 'studentfee/studentfeesYearlyReport');
        $data['title'] = 'student fees';
        $resultlist = $this->Studentfee_model->studentfeesYearlyReport($status,$year);
        $data['resultlist'] =$resultlist;
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $this->load->view('studentfee/studentfeesYearlyreportPrint', $data);
    
    }
	
	
	
 function studentfeesYearlyreportSearch()
    {
		$this->session->set_userdata('top_menu', 'Fees Collection');
        $this->session->set_userdata('sub_menu', 'studentfee/studentfeesYearlyReport');
		$year=$this->input->post("year");
        $class=$this->input->post("class_id");
        $search_text=$this->input->post("search_text");
		$section=$this->input->post("section_id");
		$sel_school=$this->input->post("sel_school");
		
        $sel_school=$this->input->post("school");
        $data["school"]=$this->Common_model->grab_school();

        $data["sel_school"]=$sel_school;
		$data["sel_year"]=$year;
		$data["section"]=$section;
		$data["class"]=$class;
		$this->session->set_userdata('sel_year',$year);
        $this->session->set_userdata("class_id",$class);
        $this->session->set_userdata("section_id",$section);
        $this->session->set_userdata("search_text",$search_text);
        $this->session->set_userdata("sel_school",$sel_school);

        $status=1;     
        $data['title'] = 'student fees';
        $resultlist = $this->Studentfee_model->studentfeesYearlyreportSearch($status,$year,$class,$section,$search_text,$sel_school);
        $data['resultlist'] =$resultlist;
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $this->load->view('layout/header', $data);
        $this->load->view('studentfee/studentfeesYearlyReportSearch', $data);
        $this->load->view('layout/footer', $data);
    
    }
	
	 function studentfeesYearlyreportSearchPrint()
    {
		$this->session->set_userdata('top_menu', 'Fees Collection');
        $this->session->set_userdata('sub_menu', 'studentfee/studentfeesYearlyReport');
		$year=$this->session->userdata("sel_year");
		$class=$this->session->userdata("class_id");
		$section=$this->session->userdata("section_id");
        $search_text=$this->session->userdata("search_text");
        $sel_school=$this->session->userdata("sel_school");
        
        $data["school"]=$this->Common_model->grab_school();
        $data["sel_school"]=$sel_school;


		$data["sel_year"]=$year;

        $status=1;
        $this->session->set_userdata('top_menu', 'Fees Collection');
        $this->session->set_userdata('sub_menu', 'studentfee/index');
        $data['title'] = 'student fees';
        $resultlist = $this->Studentfee_model->studentfeesYearlyreportSearch($status,$year,$class,$section,$search_text,$sel_school);
        $data['resultlist'] =$resultlist;
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $this->load->view('studentfee/studentfeesYearlyreportPrint', $data);
    
    }


    // Daily

    function studentfeesDailyReport()
    {
        $this->session->set_userdata('top_menu', 'Fees Collection');
        $this->session->set_userdata('sub_menu', 'studentfee/studentfeesDailyReport');
        $day=date("Y-m-d");
        $this->session->set_userdata('sel_day', $day);
        $data["sel_day"]=$day;

        $status=1;
        $data["school"]=$this->Common_model->grab_school();

        $data['title'] = 'student fees';
        $resultlist = $this->Studentfee_model->studentfeesDailyReport($status,$day);
        $data['resultlist'] =$resultlist;
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $this->load->view('layout/header', $data);
        $this->load->view('studentfee/studentfeesDailyReport', $data);
        $this->load->view('layout/footer', $data);
    
    }
    
    function studentfeesDailyreportPrint()
    {
        
        $status=1;
        $day=$this->session->userdata("sel_day");
      
        $data["sel_day"]=$day;

        $this->session->set_userdata('top_menu', 'Fees Collection');
        $this->session->set_userdata('sub_menu', 'studentfee/studentfeesDailyReport');
        $data['title'] = 'student fees';
        $resultlist = $this->Studentfee_model->studentfeesDailyReport($status,$day);
        $data['resultlist'] =$resultlist;
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $this->load->view('studentfee/studentfeesDailyreportPrint', $data);
    
    }
    
    
    
 function studentfeesDailyreportSearch()
    {
        $this->session->set_userdata('top_menu', 'Fees Collection');
        $this->session->set_userdata('sub_menu', 'studentfee/studentfeesDailyReport');
        $data["school"]=$this->Common_model->grab_school();

        $day=date("Y-m-d",strtotime($this->input->post("day")));
        $class=$this->input->post("class_id");
        $section=$this->input->post("section_id");
        $search_text=$this->input->post("search_text");
        $sel_school=$this->input->post("school");

        $data["sel_day"]=$day;
        $data["section"]=$section;
        $data["class"]=$class;
        $data["sel_school"]=$sel_school;

        $this->session->set_userdata('sel_day',$day);
        $this->session->set_userdata("class_id",$class);
        $this->session->set_userdata("section_id",$section);
        $this->session->set_userdata("search_text",$search_text);
        $this->session->set_userdata("sel_school",$sel_school);
        $status=1;     
        $data['title'] = 'student fees';
        $resultlist = $this->Studentfee_model->studentfeesDailyreportSearch($status,$day,$class,$section,$search_text,$sel_school);
        $data['resultlist'] =$resultlist;
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $this->load->view('layout/header', $data);
        $this->load->view('studentfee/studentfeesDailyReportSearch', $data);
        $this->load->view('layout/footer', $data);
    
    }
    
     function studentfeesDailyreportSearchPrint()
    {
        $this->session->set_userdata('top_menu', 'Fees Collection');
        $this->session->set_userdata('sub_menu', 'studentfee/studentfeesdaylyReport');
        
        $data["school"]=$this->Common_model->grab_school();

        $day=$this->session->userdata("sel_day");
        $class=$this->session->userdata("class_id");
        $search_text=$this->session->userdata("search_text");
        $sel_school=$this->session->userdata("sel_school");
        $section=$this->session->userdata("section_id");
        
        $data["sel_day"]=$day;
        $data["sel_school"]=$sel_school;

        $status=1;
      
        $data['title'] = 'student fees';
        $resultlist = $this->Studentfee_model->studentfeesDailyreportSearch($status,$day,$class,$section,$search_text,$sel_school);
        $data['resultlist'] =$resultlist;
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $this->load->view('studentfee/studentfeesDailyreportPrint', $data);
    
    }

    
	
	
	
	 function studentBalancefeesreport()
    {
        
        $status=0;
        $data["for"]=date("F");
        $this->session->set_userdata('top_menu', 'Fees Collection');
        $this->session->set_userdata('sub_menu', 'studentfee/index');
        $data['title'] = 'student fees';
        
        $resultlist = $this->db->query("SELECT * FROM students");
        foreach($resultlist->result() as $s):
        $ids[]=$s->id;
        endforeach;
       // $ids = array('1', '2', '3', '4', '5', '6', '7', '8');


// create sql part for IN condition by imploding comma after each id
        $in = '(' . implode(',', $ids) .')';

// create sql
        $SQL = 'SELECT * FROM fee_collection WHERE student_id IN ' . $in;

// see what you get
var_dump($sql);

      //  $check=$this->db->query("SELECT * FROM fee_collection WHERE student_id IN $stu");
       // $data['resultlist'] =$check->result_array();

        $this->load->view('studentfee/studentfeesDailyreportPrint', $data);
    
    }
		
	
	
	
	
	

}

?>