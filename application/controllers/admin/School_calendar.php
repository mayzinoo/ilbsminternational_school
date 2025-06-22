<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class School_calendar extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('file');
        $this->lang->load('message', 'english');
        $this->load->library('Customlib');
        $this->load->model("Purchase_model");
        $this->load->model("Common_model");
        error_reporting(1);
    }

    function view_detail()
    {
        $id=$this->uri->segment(4);
        // $this->load->model("Leave_model");
        // $data["row"]=$this->Leave_model->get($id); 
        // echo $id; exit;
        $data["row"]=$this->db->query("SELECT * FROM purchase_header WHERE id=$id")->row();
        // $data["lists"]=$this->db->query("SELECT purchase_header.*,purchase_detail.* FROM purchase_header JOIN purchase_detail ON purchase_detail.purchase_id=purchase_header.id WHERE purchase_header.id='$id'");
        
        $data["lists"]=$this->db->query("SELECT * FROM purchase_detail WHERE purchase_id='$id'");
        
                $error = $this->db->error();
                echo $error["message"];                
        $data["content"]="purchaseDetail";
         $this->load->view('layout/header', $data);
        $this->load->view("admin/purchase/purchaseDetail",$data);
        $this->load->view('layout/footer', $data);
    }

     function holiday() {
        $this->session->set_userdata('top_menu', 'Attendance');
        $this->session->set_userdata('sub_menu', 'admin/School_calendar/holiday');
        // $data['exp_title'] = date("F-Y");
          $data["locations"]=$this->Common_model->grab_location();

        // $data['title'] = 'Add Salary';
        // $data['title_list'] = 'Recent Salary';        
        $qry= $this->db->get("holiday");
        $data['holidaylist']=$qry->result_array();
        $this->load->view('layout/header', $data);
        $this->load->view('admin/school_calendar/holidayList', $data);
        $this->load->view('layout/footer', $data);
    }



    function index() {
        $this->session->set_userdata('top_menu', 'Attendance');
        $this->session->set_userdata('sub_menu', 'admin/School_calendar/index');
        // $data['exp_title'] = date("F-Y");
          $data["locations"]=$this->Common_model->grab_location();
        $data['sessionlist'] =$this->Common_model->get_sessiondata();
        $data['monthlist'] = $this->customlib->getMonthDropdown();
        $data["sel_session"]=$this->setting_model->getCurrentSessionid();

        $qry= $this->db->get_where("school_calendar",array("session_id"=>$this->setting_model->getCurrentSessionid()));
        $data['schlenders']=$qry->result_array();
        $this->load->view('layout/header', $data);
        $this->load->view('admin/school_calendar/school_calendarlist', $data);
        $this->load->view('layout/footer', $data);
    }

    public function download($documents) {
        $this->load->helper('download');
        $filepath = "./uploads/school_salary/" . $this->uri->segment(6);
        $data = file_get_contents($filepath);
        $name = $this->uri->segment(6);
        force_download($name, $data);
    }

    function view($id) {
        $data['title'] = 'Fees Master List';
        $salary = $this->Salary_model->get($id);
        $data['salary'] = $salary;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/salary/Salaryshow', $data);
        $this->load->view('layout/footer', $data);
    }

    function getByFeecategory() {
        $feecategory_id = $this->input->get('feecategory_id');
        $data = $this->feetype_model->getTypeByFeecategory($feecategory_id);
        echo json_encode($data);
    }
    
    function calculateDay()
    {
         $start_date=$this->input->post("start_date");
         $end_date=$this->input->post("end_date"); 
         $day=$end_date - $start_date; 
         echo $day+1;
    }

    function getStudentCategoryFee() {
        $type = $this->input->post('type');
        $class_id = $this->input->post('class_id');
        $data = $this->Salary_model->getTypeByFeecategory($type, $class_id);
        if (empty($data)) {
            $status = 'fail';
        } else {
            $status = 'success';
        }
        $array = array('status' => $status, 'data' => $data);
        echo json_encode($array);
    }

    function delete($id) {
        $this->db->where("id",$id);
        $this->db->delete("holiday");
        redirect('admin/Holiday/index');
    }

    function delete_calendar($id) {
        $this->db->where("id",$id);
        $this->db->delete("school_calendar");
        redirect('admin/School_calendar/index');
    }

    function createform()
    {
            $data["teachers"] = $this->teacher_model->get();
            $this->load->view('layout/header', $data);
            $this->load->view('admin/school_calendar/holidayCreate', $data);
            $this->load->view('layout/footer', $data);
    }


    function create_calendar_form()
    {

        $data['sessionlist'] =$this->Common_model->get_sessiondata();
        $data['monthlist'] = $this->customlib->getMonthDropdown();
        $data["sel_session"]=$this->setting_model->getCurrentSessionid();

        $this->load->view('layout/header', $data);
        $this->load->view('admin/school_calendar/shool_calenderCreate', $data);
        $this->load->view('layout/footer', $data);
    }


    function create_calendar() {
       
    
            $sel_session=$this->input->post('sel_session');
            $date=date("Y-m-d");
            $month=$this->input->post('month');
            $att_day=$this->input->post('att_day');
            
            $data=array(
                
                        "session_id"=>$sel_session,
                        "att_month"=>$month,
                        "att_day"=>$att_day,
                        "date"=>$date

                );
                
            $query=$this->db->insert("school_calendar",$data);
            if($query)
            {
                redirect("admin/School_calendar/index");
            }
            
                $error = $this->db->error();
                 if (isset($error['message'])) {
                    echo $error['message'];
                }
            
    }


 function edit_calendar() {
       
    
            $id=$this->input->post('id');
            $sel_session=$this->input->post('sel_session');
            $date=date("Y-m-d");
            $month=$this->input->post('month');
            $att_day=$this->input->post('att_day');
            
            $data=array(
                        "session_id"=>$sel_session,
                        "att_month"=>$month,
                        "att_day"=>$att_day,
                        "date"=>$date

                );
            $this->db->where("id",$id);
            $query=$this->db->update("school_calendar",$data);
            if($query)
            {
                redirect("admin/School_calendar/index");
            }
            
                $error = $this->db->error();
                 if (isset($error['message'])) {
                    echo $error['message'];
                }
            
    }

    function search_calendar()
    {
          $this->session->set_userdata('top_menu', 'Attendance');
        $this->session->set_userdata('sub_menu', 'admin/School_calendar/index');
        // $data['exp_title'] = date("F-Y");
          $data["locations"]=$this->Common_model->grab_location();
        $data['sessionlist'] =$this->Common_model->get_sessiondata();
        $data['monthlist'] = $this->customlib->getMonthDropdown();
        $data["sel_session"]=$this->input->post("sel_session");

        $qry= $this->db->get_where("school_calendar",array("session_id"=>$this->input->post("sel_session")));
        $data['schlenders']=$qry->result_array();
        $this->load->view('layout/header', $data);
        $this->load->view('admin/school_calendar/school_calendarlist', $data);
        $this->load->view('layout/footer', $data);


    }

    function calendar_edit_form($id)
    {
        $data["row"]=$this->db->query("SELECT * FROM school_calendar WHERE id=$id")->row();
            $data['sessionlist'] =$this->Common_model->get_sessiondata();
            $data['monthlist'] = $this->customlib->getMonthDropdown();
            $this->load->view('layout/header', $data);
            $this->load->view('admin/school_calendar/calendar_edit_form', $data);
            $this->load->view('layout/footer', $data);
    }

    
    function edit_form($id)
    {
        $data["row"]=$this->db->query("SELECT * FROM holiday WHERE id=$id")->row();
            $data["teachers"] = $this->teacher_model->get();
            $this->load->view('layout/header', $data);
            $this->load->view('admin/holiday/holidayEdit', $data);
            $this->load->view('layout/footer', $data);
    }

    function create() {
       
    
            $name=$this->input->post('name');
            $datefrom=date("Y-m-d",strtotime($this->input->post('datefrom')));
            $dateto=date("Y-m-d",strtotime($this->input->post('dateto')));
            $total=$this->input->post('total');
            $description=$this->input->post('description');
            
            $data=array(
                        "name"=>$name,
                        "description"=>$description,
                        "datefrom"=>$datefrom,
                        "dateto"=>$dateto,
                        "total"=>$total
                );
                
            $query=$this->db->insert("holiday",$data);
            if($query)
            {
                redirect("admin/Holiday/index");
            }
            
                $error = $this->db->error();
                 if (isset($error['message'])) {
                    echo $error['message'];
                }
            
    }

    function edit($id) {
            $id=$this->input->post('id');
            $name=$this->input->post('name');
            $datefrom=date("Y-m-d",strtotime($this->input->post('datefrom')));
            $dateto=date("Y-m-d",strtotime($this->input->post('dateto')));
            $total=$this->input->post('total');
            $description=$this->input->post('description');
            
            $data=array(
                        "name"=>$name,
                        "description"=>$description,
                        "datefrom"=>$datefrom,
                        "dateto"=>$dateto,
                        "total"=>$total
                );
                
                $this->db->where("id",$id);
                $query=$this->db->update("holiday",$data);
                
                if($query)
                {
                    redirect("admin/Holiday/index");
                }
           
    }

    function salarySearch() {
        $this->session->set_userdata('top_menu', 'Salary');
        $this->session->set_userdata('sub_menu', 'salary/Salaryearch');
        $data['title'] = 'Search Salary';
        $data["locations"]=$this->Common_model->grab_location();

        if ($this->input->server('REQUEST_METHOD') == "POST") {
            $search = $this->input->post('search');
            if ($search == "search_filter") {
                $data['exp_title'] = $this->input->post('date_from') . " ~ " . $this->input->post('date_to');
                $date_from = date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date_from')));
                $date_to = date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date_to')));
                $resultList = $this->Salary_model->search("", $date_from, $date_to);
                $data['salarylist'] = $resultList;
            } 
                else if($search=="search_location")
                {
                     $data['exp_title'] = 'Salary Result';
                    $location = $this->input->post('location');
                    $resultList = $this->Salary_model->search($location,$search_text, "", "");
                    $data['salarylist'] = $resultList;
                    
                }
            else {
                $data['exp_title'] = 'Salary Result';
                $search_text = $this->input->post('search_text');
                $resultList = $this->Salary_model->search($location,$search_text, "", "");
                $data['salarylist'] = $resultList;
            }
            $this->load->view('layout/header', $data);
            $this->load->view('admin/salary/salarySearch', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/salary/salarySearch', $data);
            $this->load->view('layout/footer', $data);
        }
    }

}

?>