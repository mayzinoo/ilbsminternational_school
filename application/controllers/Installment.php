<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Installment extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('smsgateway');
        $this->load->library('mailsmsconf');
        error_reporting(1);
        $this->load->helper('file');
        $this->load->library('auth');
        $this->lang->load('message', 'english');
        $this->load->model("Common_model");
        $this->load->model("Install_model");
        $this->load->model("class_model");
    }

    function index() {
        $data["for"]=date("F");
        $data['monthlist'] = $this->customlib->getMonthDropdown();
        $data['month_selected'] = date("F");
        $data["class_id"]="";
        $this->session->set_userdata('top_menu', 'Payment');
        $this->session->set_userdata('sub_menu', 'Installment/index');
        $data["school"]=$this->Common_model->grab_school();
        $data['classlist']= $this->Install_model->getClass();

        // $this->form_validation->set_rules('month', 'Month', 'trim|required|xss_clean');
        //     if ($this->form_validation->run() == FALSE) {
        //         $resultlist = $this->Install_model->install_plan();
        //         $data['resultlist'] =$resultlist;
        //     }
        //     else
        if($this->uri->segment(3)=="search")
            {
                $month=$this->input->post("month");
                $class_id=$this->input->post("class_id");
                $this->db->select("install_plan.*,classes.class as class, sessions.session"); 
                $this->db->join("classes","classes.id=install_plan.class_id",'left');
                $this->db->join("sessions","sessions.id=install_plan.session_id",'left');
                $this->db->where("MONTHNAME(date)",$month);
                
                if($class_id != "")
                {
                $this->db->where("install_plan.class_id",$class_id);
                }
                $data['resultlist']=$this->db->order_by("install_plan.id","DESC")->get("install_plan");   
                // $data['resultlist'] = $this->db->query("SELECT * FROM install_plan WHERE MONTHNAME(date)='$month'");
                $data['month_selected'] = $month;
                $data["class_id"]=$class_id;
                // echo $data['resultlist']->num_rows(); exit;
            }
            else
            {
                $resultlist = $this->Install_model->install_plan();
                $data['resultlist'] =$resultlist;
            }
        
        // $class = $this->class_model->get();
        // $data['classlist'] = $class;
        $this->load->view('layout/header', $data);
        $this->load->view('installment/install_plan', $data);
        $this->load->view('layout/footer', $data);
    }
    


    function insert_data() {
        $data['session_id']=$this->setting_model->getCurrentSession();
        $form=$this->uri->segment(3);
        $data['install_plans']=$this->Install_model->getInstallPlans();
        $data['classlist']= $this->Install_model->getClass();
        $data["sessionlist"]=$this->Install_model->getSession();
        $data["studentlist"]=$this->Install_model->grab_student();
        $data["teacherlist"]=$this->Common_model->grab_teacher();
        $this->load->view('layout/header', $data);
        $this->load->view('installment/'.$form, $data);
        $this->load->view('layout/footer', $data);
    }
    
    function edit_data() {
        $form=$this->uri->segment(3);
        $id=$this->uri->segment(4);
        $data["row"]=$this->Install_model->get_data($form,$id);
        $data['install_plans']=$this->Install_model->getInstallPlans();
        $data['classlist']= $this->Install_model->getClass();
        $data["sessionlist"]=$this->Install_model->getSession();
        $data["studentlist"]=$this->Install_model->grab_student();
        $data["teacherlist"]=$this->Common_model->grab_teacher();
        $this->load->view('layout/header', $data);
        $this->load->view('installment/edit_'.$form.'_form', $data);
        $this->load->view('layout/footer', $data);
    }
    
    
     function delete_data() {

        $form=$this->uri->segment(3);
        $id=$this->uri->segment(4);
        $this->db->where("id",$id);
        $this->db->delete($form);
        if($form=="install_plan")
        {
            redirect("Installment/index");
        }
        else
        {
            redirect("Installment/".$form);
        }
    }


    function courses_subject()
    {
        $data["for"]=date("F");
        $this->session->set_userdata('top_menu', 'Courses');
        $this->session->set_userdata('sub_menu', 'Installment/courses_subject');
        // $data["school"]=$this->Common_model->grab_school();
        $resultlist = $this->Install_model->courses_subject();
        $data['resultlist'] =$resultlist;
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $this->load->view('layout/header', $data);
        $this->load->view('installment/courses_subject', $data);
        $this->load->view('layout/footer', $data);
    }
    
    
    function install_student()
    {
        $data["for"]=date("F");
        $this->session->set_userdata('top_menu', 'Payment');
        $this->session->set_userdata('sub_menu', 'Installment/install_student');
        // $data["school"]=$this->Common_model->grab_school();
        $resultlist = $this->Install_model->install_student();
        $data['resultlist'] =$resultlist;
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $this->load->view('layout/header', $data);
        $this->load->view('installment/install_student', $data);
        $this->load->view('layout/footer', $data);
    }
    
    
    function studentfee_balance()
    {
        $data["for"]=date("F");
        $this->session->set_userdata('top_menu', 'Payment');
        $this->session->set_userdata('sub_menu', 'Installment/studentfee_balance');
        // $data["school"]=$this->Common_model->grab_school();
        $resultlist = $this->Install_model->studentfee_balance();
        $data['resultlist'] =$resultlist;
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $this->load->view('layout/header', $data);
        $this->load->view('installment/studentfee_balance', $data);
        $this->load->view('layout/footer', $data);
    }
    
    function studentfee_receive()
    {
        $data["for"]=date("F");
        $this->session->set_userdata('top_menu', 'Payment');
        $this->session->set_userdata('sub_menu', 'Installment/studentfee_receive');
        // $data["school"]=$this->Common_model->grab_school();
        $resultlist = $this->Install_model->studentfee_receive();
        $data['resultlist'] =$resultlist;
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $this->load->view('layout/header', $data);
        $this->load->view('installment/studentfee_receive', $data);
        $this->load->view('layout/footer', $data);
    }
    
    
    function create_install_plan() {
        
        $class_id=$this->input->post("class");
        $name=$this->input->post("name");
        $session_id=$this->input->post("session");
        $date=date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date')));
        $fees=$this->input->post("fees");
        
        $data=array("name"=>$name,
                    "class_id"=>$class_id,
                    "session_id"=>$session_id,
                    "fee"=>$fees,
                    "date"=>$date
                    );
        $query=$this->db->insert("install_plan",$data);
        if($query)
        {
            
        }
        else
        {
            $err= $this->db->error();
            echo $err["message"];
        }
        
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Successfully Saved</div>');
        redirect(base_url()."Installment/insert_data/install_plan_form");
        // $data["teacherlist"]=$this->Common_model->grab_teacher();
        // $this->load->view('layout/header', $data);
        // $this->load->view('course/lectured_courses_form', $data);
        // $this->load->view('layout/footer', $data);
    }
    
    
    function update_install_plan()
    {
        $id=$this->input->post("id");
        $name=$this->input->post("name");
        $class_id=$this->input->post("class");
        // $description=$this->input->post("description");
        $session_id=$this->input->post("session");
        $date=date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date')));
        $fees=$this->input->post("fees");
        
        $data=array("name"=>$name,
                    "class_id"=>$class_id,
                    "session_id"=>$session_id,
                    "fee"=>$fees,
                    "date"=>$date
                    );
        $this->db->where("id",$id);
        $query=$this->db->update("install_plan",$data);
        if($query)
        {
            
        }
        else
        {
            $err= $this->db->error();
            echo $err["message"];
        }
        
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Successfully Updated</div>');
        redirect(base_url()."Installment/edit_data/install_plan/".$id);
    }
    
    
    function create_courses_subject() {
        
        $subject=$this->input->post("subject");
        $description=$this->input->post("description");
        $teacher=$this->input->post("teacher");
       
        $data=array("subject"=>$subject,
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
        redirect(base_url()."Installment/insert_data/courses_subject_form");
        // $data["teacherlist"]=$this->Common_model->grab_teacher();
        // $this->load->view('layout/header', $data);
        // $this->load->view('course/lectured_courses_form', $data);
        // $this->load->view('layout/footer', $data);
    }
    
    
    function update_courses_subject()
    {
        $id=$this->input->post("id");
        $subject=$this->input->post("subject");
        $description=$this->input->post("description");
        $teacher=$this->input->post("teacher");
       
        $data=array("subject"=>$subject,
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
        redirect(base_url()."Installment/edit_data/courses_subject/".$id);
    }
    
    
    
    function create_install_student() {
        $student_id=$this->input->post("student_id");
        $install_plan_id=$this->input->post("install_plan_id");
        $fees=$this->input->post("fees");
        $session_id=$this->input->post("session");
        $register_date=date("Y-m-d",strtotime($this->input->post("date")));
        $due_date=date("Y-m-d",strtotime($this->input->post("due_date")));
        $data=array("install_plan_id"=>$install_plan_id,
                    "student_id"=>$student_id,
                    "register_date"=>$register_date,
                    "fee"=>$fees,
                    "session_id"=>$session_id,
                    "due_date"=>$due_date
                    );
        $query=$this->db->insert("install_student",$data);
        $id=$this->db->insert_id();
        if($query)
        {
            $cfbdata=array( "install_stuid"=>$id,
                            "install_plan_id"=>$install_plan_id,
                            "student_id"=>$student_id,
                            "fee"=>$fees,
                            "balance"=>$fees,
                            "due_date"=>$due_date
            );
            
            $this->db->insert("studentfee_balance",$cfbdata);
        }
        else
        {
            $err= $this->db->error();
            echo $err["message"];
        }
        
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Successfully Saved</div>');
        redirect(base_url()."Installment/insert_data/install_student_form");
    }
    
    
    function update_install_student()
    {
        $id=$this->input->post("id");
        $student_id=$this->input->post("student_id");
        $install_plan_id=$this->input->post("install_plan_id");
        $fee=$this->input->post("fee");
        $session_id=$this->input->post("session");
        $date=date("Y-m-d",strtotime($this->input->post("date")));
        
        $data=array("install_plan_id"=>$install_plan_id,
                    "student_id"=>$student_id,
                    "register_date"=>$register_date,
                    "fee"=>$fees,
                    "session_id"=>$session_id,
                    "due_date"=>$due_date
                    );
                    
        $this->db->where("id",$id);         
        $query=$this->db->update("install_student",$data);
        if($query)
        {
            $data2=array(
                         "install_plan_id"=>$install_plan_id,
                         "student_id"=>$student_id,
                         "fee"=>$fee,
                         "balance"=>$fee,
                         "due_date"=>$date
            );
            
            $this->db->where("install_stuid",$id);
            $this->db->where("fee","balance");
            $this->db->update("studentfee_balance",$data2);
            
        }
        else
        {
            $err= $this->db->error();
            echo $err["message"];
        }
        
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Successfully Updated</div>');
        redirect(base_url()."Installment/edit_data/install_student/".$id);
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
        $fee=$this->input->post("final_fees");
        
        $row=$this->db->query("SELECT * FROM studentfee_balance WHERE id=$feebalance_id ");
        if($row->num_rows()==1)
        {
            $result=$row->row();
            $install_plan_id=$result->install_plan_id;
            $student_id=$result->student_id;
            
        $data=array("install_plan_id"=>$install_plan_id,
                    "student_id"=>$student_id,
                    "fee"=>$fee,
                    "paydate"=>$paydate,
                    "pay_amount"=>$pay_amt,
                    "balance"=>$balance
                    );
                    
            $query=$this->db->insert("studentfee_receive",$data);
            if($query)
            {
                
                $paytotal=$result->pay_amount+$pay_amt;
                $data=array(
                        "pay_amount"=>$paytotal,
                        "balance"=>$balance
                                );
                $this->db->where("id",$feebalance_id);
                $this->db->update("studentfee_balance",$data);
                
                if($balance==0)
                {   
                    $this->db->where("id",$feebalance_id);
                    $this->db->delete("studentfee_balance");
                }
            }
            else
            {
                $err= $this->db->error();
                echo $err["message"];
            }
        
        }
        
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Successfully Saved</div>');
        redirect(base_url()."Installment/studentfee_receive");
    }
    

    function pdf() {
        $this->load->helper('pdf_helper');
    }

    function searchStudent()
    {
        $session_id=$this->setting_model->getCurrentSession();
        $install_plan_id=$this->input->post("install_plan_id");
		$this->db->select("student_session.*,students.id,students.firstname,students.lastname,install_plan.fee as fee");
		$this->db->join("students","student_session.student_id=students.id");
		$this->db->join("install_plan","student_session.class_id=install_plan.class_id");
// 		$this->db->join("classes","install_plan.class_id=classes.id");
		$this->db->where("install_plan.id",$install_plan_id);
		$this->db->where("student_session.session_id",$session_id);
		$this->db->where("install_plan.session_id",$session_id);
		$query = $this->db->get("student_session");
		if($query)
		{
		    
		}
		else
		{
		     $err=$this->db->error();
	        echo $err["message"]; exit;
		}
		
// 		echo $this->db->last_query(); exit;
		
	    $r="";
	    $qry=$this->db->query("SELECT install_plan.fee, sessions.session, sessions.id FROM install_plan LEFT JOIN sessions ON install_plan.session_id=sessions.id WHERE install_plan.id='$install_plan_id' AND install_plan.session_id='$session_id'");
		$q=$qry->row();
		$fee=$q->fee;
		$session_id=$q->id;
		$session_name=$q->session;
		foreach($query->result() as $row):
        
		$r.= "<option value='".$row->id."'>".$row->firstname." ".$row->lastname."</option>";
		endforeach;
	    $r.="]";
	    $r.=$fee;
	    $r.="]";
	    $r.=$session_id;
	    $r.="]";
	    $r.=$session_name;
	    echo $r;
	    
	   
//  		$result=json_encode($query);
// 		echo $result;
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
        redirect('Installment/'.$form);
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