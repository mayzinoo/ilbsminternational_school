<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class studentfee extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('smsgateway');
        $this->load->library('mailsmsconf');

        $this->load->helper('file');
        $this->lang->load('message', 'english');
        $this->load->model("Common_model");
        $this->load->model("Studentfee_model");
        $this->load->model("Install_model");
    }

    function index() {
    
        
        $data["for"]=date("F");
        $this->session->set_userdata('top_menu', 'Payment');
        $this->session->set_userdata('sub_menu', 'studentfee/index');
        $data['title'] = 'student fees';
        $data["school"]=$this->Common_model->grab_school();

        $resultlist = $this->Studentfee_model->get(1);
        $data['resultlist'] =$resultlist;
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $this->load->view('layout/header', $data);
        $this->load->view('studentfee/studentfeePaidlist', $data);
        $this->load->view('layout/footer', $data);
    }

    

    function studentfeePaidList() {

        $data["for"]=date("F");
        $this->session->set_userdata('top_menu', 'Fees Collection');
        $this->session->set_userdata('sub_menu', 'studentfee/index');
        $data['title'] = 'student fees';
        $data["school"]=$this->Common_model->grab_school();

        $resultlist = $this->Studentfee_model->get(1);
        $data['resultlist'] =$resultlist;
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $this->load->view('layout/header', $data);
        $this->load->view('studentfee/studentfeePaidlist', $data);
        $this->load->view('layout/footer', $data);
    }
    
    
    function monthlyfee() {

        $data["for"]=date("F");
        $this->session->set_userdata('top_menu', 'Payment');
        $this->session->set_userdata('sub_menu', 'studentfee/monthlyfee');
        $data['title'] = 'student fees';
        $data["school"]=$this->Common_model->grab_school();
        $this->db->select("monthlyfee.*,fee_groups.name as fee_name");
        $this->db->join("fee_groups","monthlyfee.feegroup_id=fee_groups.id","left");
        $query=$this->db->get("monthlyfee");
        $data['resultlist'] =$query->result_array();
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $this->load->view('layout/header', $data);
        $this->load->view('studentfee/monthlyfee', $data);
        $this->load->view('layout/footer', $data);
    }
    
    function insert_monthlyfee()
    {
        //  $this->session->set_userdata('top_menu', 'Payment');
        // $this->session->set_userdata('sub_menu', 'studentfee/insert_monthlyfee');
        $data['classlist']= $this->Install_model->getClass();
        $data["sessionlist"]=$this->Install_model->getSession();
        $data["feegroups"]=$this->Install_model->getFeegroup();
        $this->load->view('layout/header', $data);
        $this->load->view('balancefee/monthlyfee_form', $data);
        $this->load->view('layout/footer', $data);
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


   
    function printvoc() {
        $data['title'] = 'studentfee List';

        $student_id=$this->uri->segment(4);
        $id=$this->uri->segment(3);
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
		 $paydate= date("Y-m-d",strtotime($this->input->post('date'))).date(", h:i:s");

        $data['title'] = 'Student Detail';
        $this->form_validation->set_rules('feegroup[]', 'Fee Group', 'trim|required|xss_clean');
        $this->form_validation->set_rules('discount[]', 'Discount', 'trim|required|xss_clean');
        $this->form_validation->set_rules('receive[]', 'Receive', 'trim|required|xss_clean');
        $this->form_validation->set_rules('alltotal', 'alltotal', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('month', 'payment_for', 'trim|required|xss_clean');
        $this->form_validation->set_rules('date', 'date', 'trim|required|xss_clean');


        if ($this->form_validation->run() == FALSE) {

            $this->load->view('layout/header', $data);
            $this->load->view('studentfee/studentAddfee', $data);
            $this->load->view('layout/footer', $data);
        } else {

        $month="";
        $total=0;
        for($j=0;$j<12;$j++)
       {
        
        if($this->input->post("month".$j) != "")
        {
            $month.=$this->input->post("month".$j);
            $month.=",";
            $total+=$this->input->post('alltotal');
        }
       }
        
        $data = array(
                'student_id' => $id,
                'total_amount' => $total,
                'total_received' => $total,
                'paydate' => $paydate,
                'payment_for' => $month,             
                'payment_mode' => $this->input->post('payment_method'),   
                'session_id' => $this->input->post('sel_session'),   
                'authority'=> $this->customlib->getAdminSessionUserName()
            );
            
        $this->db->insert("fee_collection",$data);          
        $header_id=$this->db->insert_id();
        
       for($j=0;$j<12;$j++)
       {
        
        if($this->input->post("month".$j) != "")
        {
           $pay=$this->input->post('month'.$j);
           
            // $data = array(
            //     'student_id' => $id,
            //     'total_amount' => $this->input->post('alltotal'),
            //     'total_received' => $this->input->post('alltotal'),
            //     'paydate' => $paydate,
            //     'payment_for' => $this->input->post('month'.$j),             
            //     'payment_mode' => $this->input->post('payment_method'),   
            //     'authority'=> $this->customlib->getAdminSessionUserName()
            // );

           
            $amount=$this->input->post("amount");
            $receive=$this->input->post("receive");
            $discount=$this->input->post("discount");
            $feegroup=$this->input->post("feegroup");

            for($i=0;$i<count($amount);$i++)
            {
                $data=array(
                            "header_id"=>$header_id,
                            "feegroup_id"=>$feegroup[$i],
                            "amount"=>$amount[$i],
                            "amount_discount"=>$discount[$i],
                            "receive"=>$receive[$i],
                            'date' => date("Y-m-d",strtotime($this->input->post('date'))),
                            'month' => $pay
                    );

                $qry=$this->db->insert("fee_collection_details",$data);
               
                $this->db->where("payment_for",$pay);
                $this->db->where("student_id",$id);
                $this->db->where("feegroup_id",$feegroup[$i]);
                $this->db->delete("balance_fee");

            }
            
         } 
         
         else
           {
            $err= $this->db->error();
            echo $err["message"];
           }
        }

            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Fees Collection added successfully</div>');
           redirect(base_url()."studentfee/printvoc/".$header_id."/".$id);
           // $this->printvoc($header_id);
        }
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
                $month="";
                $total=0;
                for($j=0;$j<12;$j++)
               {
                
                if($this->input->post("month".$j) != "")
                {
                    $month.=$this->input->post("month".$j);
                    $month.=",";
                    $total+=$this->input->post('alltotal');
                }
               }
                
                $data = array(
                        'student_id' => $id,
                        'total_amount' => $total,
                        'total_received' => $total,
                        'paydate' => $paydate,
                        'payment_for' => $month,             
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

            for($j=0;$j<12;$j++)
               {
                
                if($this->input->post("month".$j) != "")
                {
                   $pay=$this->input->post('month'.$j);
                   
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
                                    'date' => date("Y-m-d",strtotime($this->input->post('date'))),
                                    'month' => $pay
                            );
        
                        $qry=$this->db->insert("fee_collection_details",$data);
                       
                        // $this->db->where("payment_for",$pay);
                        // $this->db->where("student_id",$id);
                        // $this->db->where("feegroup_id",$feegroup[$i]);
                        // $this->db->delete("balance_fee");
        
                    }
                    
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
        $data['title'] = 'Student Detail';
        $student = $this->student_model->get($id);
        $data['student'] = $student;

        $data['id'] = $id;
          $data['sessionlist'] =$this->Common_model->get_sessiondata();
        $data["sel_session"]=$this->setting_model->getCurrentSessionid();

        $data["paymenttype"]=$this->Common_model->grab_paymenttype();
        $data["feegroups"]=$this->Common_model->grab_feegroup();
        $data['monthlist'] = $this->customlib->getMonthDropdown();
        $data['monthlists'] = $this->customlib->getMonthLists();
        // $data['monthlist'] = $this->customlib->getMonthDropdown();
        $data['sessionlist'] =$this->Common_model->get_sessiondata();
        $data["sel_session"]=$this->setting_model->getCurrentSessionid();

        $this->load->view('layout/header', $data);
        $this->load->view('studentfee/studentAddfee', $data);
        $this->load->view('layout/footer', $data);
    }
    

    function deleteTransportFee() {
        $id = $this->input->post('feeid');
        $this->studenttransportfee_model->remove($id);
        $array = array('status' => 'success', 'result' => 'success');
        echo json_encode($array);
    }

  function delete($id) {
        $data['title'] = 'studentfee List';
        $this->studentfee_model->remove($id);
        redirect('studentfee/index/1');
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