<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Teaattendence extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('file');
        $this->lang->load('message', 'english');
        $this->config->load("mailsms");
        $this->load->library('mailsmsconf');
        $this->config_attendance = $this->config->item('attendence');
        $this->load->model("teaattendence_model");
        $this->load->model("Leave_model");
        $this->load->model('common_model');
    }

     function index() {

        $this->session->set_userdata('top_menu', 'Attendance');
        $this->session->set_userdata('sub_menu', 'teaattendence/index');
        $data['title'] = 'Attendance Report List';
        $data['monthlist'] = $this->customlib->getMonthDropdown();
        $data['month_selected'] = "";
        $data["school"]=$this->Common_model->grab_school();

        if ($this->input->server('REQUEST_METHOD') == "GET") {

        
                 $month=date("n");
                $year=date("Y");
            $data['month_selected'] = $month;
            $data['year_selected'] = $year;
            
          
            $res = $this->teaattendence_model->get($school, $year, $month);
            $data["resultlist"]=$res;
            $this->load->view('layout/header', $data);
            $this->load->view('admin/teaattendence/attendenceList', $data);
            $this->load->view('layout/footer', $data);
        } else {
        $this->form_validation->set_rules('year', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('month', 'Month', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/teaattendence/attendenceList', $data);
            $this->load->view('layout/footer', $data);
        } else {

            $school = $this->input->post('school');
            $year = $this->input->post('year');
            $month = $this->input->post('month');         
          
            $data['year_selected'] = $year;
            $data['school_selected'] = $school;
            $data['month_selected'] = $month;
            $month_number = date("m",strtotime($month));
          
            $res = $this->teaattendence_model->get($school, $year, $month);
            $data["resultlist"]=$res;
            $data['attendence_array'] = $attendence_array;
            $data['student_array'] = $student_result;
            $this->load->view('layout/header', $data);
            $this->load->view('admin/teaattendence/attendenceList', $data);
            $this->load->view('layout/footer', $data);
        }
    }
    }

  

    function teaattendence_form()
    { 
        $data['title'] = 'Add Attendance';
        //$this->load->view('layout/header', $data);
        $this->load->view('admin/teaattendence/teaattendence_form', $data);
       // $this->load->view('layout/footer', $data);
    }


     function insert_teaattendance()
    {
        $stu_id=$this->input->post("id");
        $check=$this->db->get_where("teacher_attendences",array('teacher_id'=>$tea_id,'created_at'=>date("Y-m-d")));
        if($check->num_rows()<1)
        {

        $data=array(
                        "teacher_id"=>$stu_id,                       
                        'approved_by'=> "Self",
                        "created_at"=>date("Y-m-d")

                    );

        $qry=$this->db->insert("teacher_attendences",$data);
            if($qry)
            {

                echo "Successfully inserted";
            }
            else
            {
                echo "Fail to insert";

            }
        }

        else
        {
           
        $outtime=date("Y-m-d H:i:s");

            $data=array(
                        "out_time"=>$outtime,
                        "updated_at"=>$outtime
                );

             $this->db->where("teacher_id",$stu_id);
             $this->db->where("created_at",date("Y-m-d"));
             $qry=$this->db->update("teacher_attendences",$data);
          

            if($qry)
            {

               // echo "<tr><td></td></tr>"
                echo "Successfully update";
            }
            else
            {
                echo "Fail to update";

            }
        }

    }

   function attendencereport() {
        $this->session->set_userdata('top_menu', 'Attendance');
        $this->session->set_userdata('sub_menu', 'Teaattendence/attendenceReport');
        $data['title'] = 'Add Fees Type';
        $data['title_list'] = 'Fees Type List';
        $month = $this->input->post("month");

        $data['monthlist'] = $this->customlib->getMonthDropdown();       
        $data['month_selected'] = $month;

        $month_number = date("m",strtotime($month));
        $att_date=date("Y-$month_number");
          if ($this->input->server('REQUEST_METHOD') == "GET") {
            $resultlist = $this->teaattendence_model->get();
          $data['resultlist'] = $resultlist;
            $this->load->view('layout/header', $data);
            $this->load->view('admin/teaattendence/teacherReport', $data);
            $this->load->view('layout/footer', $data);
        } else {
              
                $resultlist = $this->teaattendence_model->searchAttendence($att_date);
                $data['resultlist'] = $resultlist;

                $this->load->view('layout/header', $data);
                $this->load->view('admin/teaattendence/teaattendencereport', $data);
                $this->load->view('layout/footer', $data);
                                
    }

}



function teamaintenance()
{
         $this->session->set_userdata('top_menu', 'Attendance');
        $this->session->set_userdata('sub_menu', 'Teaattendence/teamaintenance');
      if ($this->input->server('REQUEST_METHOD') == "GET") {
           
         
           $data['date'] = "";

            $resultlist = $this->teacher_model->get();
            $data['resultlist'] = $resultlist;
            $data["locations"]=$this->common_model->grab_location();

            $this->load->view('layout/header', $data);
            $this->load->view('admin/teaattendence/teamaintenance_form', $data);
            $this->load->view('layout/footer', $data);
        } else {

}
}

 function absent() {

        $this->session->set_userdata('top_menu', 'Attendance');
        $this->session->set_userdata('sub_menu', 'teaattendence/absent');
        $data['title'] = 'Add Fees Type';
        $data['title_list'] = 'Fees Type List';
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $data['class_id'] = "";
        $data['section_id'] = "";
        $data['date'] = "";
        $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
        $resultlist = $this->teaattendence_model->get_absent();
        $data['resultlist'] = $resultlist;    
        $this->load->view('layout/header', $data);
        $this->load->view('admin/teaattendence/absentList', $data);
        $this->load->view('layout/footer', $data);
        }
function leave() {

        $this->session->set_userdata('top_menu', 'Attendance');
        $this->session->set_userdata('sub_menu', 'teaattendence/leave');
        $data['title'] = 'Add Fees Type';
        $data['title_list'] = 'Fees Type List';
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $data['class_id'] = "";
        $data['section_id'] = "";
        $data['date'] = "";
        $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
        $resultlist = $this->teaattendence_model->get_leave();
        $data['resultlist'] = $resultlist;    
        $this->load->view('layout/header', $data);
        $this->load->view('admin/teaattendence/leavelist', $data);
        $this->load->view('layout/footer', $data);
        }
function teamaintenance_insert()
    {
        $tea_id=$this->input->post("tea_id");
        $sdate=date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('sdate')));
        $stime=$this->input->post("stime");
        $etime=$this->input->post("etime");
        $reason=$this->input->post("reason");       
      	$authority=$this->customlib->getAdminSessionUserName();
	
    for($i=0;$i<count($tea_id);$i++) 

    { 
        $check=$this->db->get_where("teacher_attendences",array('teacher_id'=>$tea_id[$i],'created_at'=>$sdate));
       echo $check->num_rows();
        if($check->num_rows()<1)
        {
        $data=array(
                    "teacher_id"=>$tea_id[$i],                 
                    'approved_by'=> $authority,
                    'created_at' => $sdate,
                    "in_time"=>date("Y-m-d H:s:i",strtotime($stime[$i])),
                    'status'=> $reason[$i]
                );

                $qry=$this->db->insert("teacher_attendences",$data);
                 
            if($qry)
            {

               // echo "<tr><td></td></tr>"
             //   echo "Successfully inserted";
            }
            else
            {
                echo "Fail to insert";

            }
        }
        else
        {
            $etime=$this->input->post("etime");
            // echo $etime[$i];exit;
            $data=array(
                        "out_time"=>date("Y-m-d H:s:i",strtotime($etime[$i])),
                        "out_time"=>date("Y-m-d H:s:i",strtotime($etime[$i])),
                        "updated_at"=>date("Y-m-d H:s:i"),
                        'status'=> $reason[$i]
                );

             $this->db->where("teacher_id",$tea_id[$i]);
             $this->db->where("created_at",$sdate);
             $qry=$this->db->update("teacher_attendences",$data);

            if($qry)
            {
                echo "Successfully update";
            }
            else
            {
                echo "Fail to update";

            }
        }

    }

redirect("admin/teaattendence");    

}



    
    function teaattendencereport() {
        $this->session->set_userdata('top_menu', 'Attendance');
        $this->session->set_userdata('sub_menu', 'Teaattendence/teaattendencereport');
        $attendencetypes = $this->attendencetype_model->get();
       
        $data['monthlist'] = $this->customlib->getMonthDropdown();       
        if ($this->input->server('REQUEST_METHOD') == "GET") {
             
            $data["teacherlist"] = $this->teacher_model->get();
            $data['month_selected'] = date("F");
            $att_date=date("Y-m");
                 $resultlist = $this->teaattendence_model->get();
             $data['resultlist'] = $resultlist;
            
            $this->load->view('layout/header', $data);
            $this->load->view('admin/teaattendence/teaattendencereport', $data);
            $this->load->view('layout/footer', $data);
        } else {
      
        $this->form_validation->set_rules('month', 'Month', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/teaattendence/teaattendencereport', $data);
            $this->load->view('layout/footer', $data);
        } else {

           
            $month = $this->input->post('month');
           
            $data['month_selected'] = $month;
            $month_number = date("m",strtotime($month));
             $att_date=date("Y-$month_number");

            $res = $this->teaattendence_model->searchAttendenceClassSection($att_date);
            $data["resultlist"]=$res;
            $data['attendence_array'] = $attendence_array;
            $data['student_array'] = $student_result;
            $this->load->view('layout/header', $data);
            $this->load->view('admin/teaattendence/teaattendencereport', $data);
            $this->load->view('layout/footer', $data);
        }
    }

}




}

?>