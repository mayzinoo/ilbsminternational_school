<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Teaattendence extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('file');
        $this->lang->load('message', 'english');
        $this->config->load("mailsms");
        $this->load->library('mailsmsconf');
        $this->config_attendance = $this->config->item('attendence');
        $this->load->model("teaattendence_model");
    }

    function index() {

        $this->session->set_userdata('top_menu', 'Attendance');
        $this->session->set_userdata('sub_menu', 'teaattendence/index');
        $data['title'] = 'Add Fees Type';
        $data['title_list'] = 'Fees Type List';
        
        $data['date'] = "";
        $stu=$this->session->userdata($student);
         $teacher_id=$stu["student"]["teacher_id"];
        $resultlist = $this->teaattendence_model->get($teacher_id);
        $data['resultlist'] = $resultlist;
         $this->load->view('layout/teacher/header', $data);
        $this->load->view('teacher/teaattendence/attendenceList', $data);
        $this->load->view('layout/teacher/footer', $data);

        }
    

    function teaattendence_form()
    { 
        $data['title'] = 'Add Attendance';
        //$this->load->view('layout/teacher/header', $data);
        $this->load->view('teacher/teaattendence/teaattendence_form', $data);
       // $this->load->view('layout/teacher/footer', $data);
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
      
        $data['date'] = "";
          if ($this->input->server('REQUEST_METHOD') == "GET") {
            $resultlist = $this->teaattendence_model->get();
          $data['resultlist'] = $resultlist;
            $this->load->view('layout/teacher/header', $data);
            $this->load->view('student/teacherReport', $data);
            $this->load->view('layout/teacher/footer', $data);
        } else {
       
        $this->form_validation->set_rules('date', 'Date', 'trim|required|xss_clean');
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('layout/teacher/header', $data);
                $this->load->view('teacher/teaattendence/attendencereport', $data);
                $this->load->view('layout/teacher/footer', $data);
            } else {

               
                $resultlist = $this->teaattendence_model->searchAttendence(date('Y-m-d', $this->customlib->datetostrtotime($date)));
                $data['resultlist'] = $resultlist;

                $this->load->view('layout/teacher/header', $data);
                $this->load->view('teacher/teaattendence/attendencereport', $data);
                $this->load->view('layout/teacher/footer', $data);
                
                }

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
            $this->load->view('layout/teacher/header', $data);
            $this->load->view('teacher/teaattendence/teamaintenance_form', $data);
            $this->load->view('layout/teacher/footer', $data);
        } else {

           

}




}


function teamaintenance_insert()
    {

      
        $tea_id=$this->input->post("tea_id");
        $sdate=$this->input->post("sdate");
        $stime=$this->input->post("stime");
        $etime=$this->input->post("etime");

       
      $authority=$this->customlib->getAdminSessionUserName();
        for($i=0;$i<count($tea_id);$i++) 

        {    

        $check=$this->db->get_where("teacher_attendences",array('teacher_id'=>$tea_id[$i],'created_at'=>date("Y-m-d",strtotime($sdate[$i]))));
       
        if($check->num_rows()<1)
        {

        $data=array(
                    "teacher_id"=>$tea_id[$i],                 
                    'approved_by'=> $authority,
                    "created_at"=>date("Y-m-d",strtotime($sdate[$i])),
                    "in_time"=>date("Y-m-d H:s:i",strtotime($stime[$i]))

                );

                 $qry=$this->db->insert("teacher_attendences",$data);

                 
            if($qry)
            {

               // echo "<tr><td></td></tr>"
             //   echo "Successfully inserted";
            }
            else
            {
              //  echo "Fail to insert";

            }
        
        }

        

        else
        {
           

            $data=array(
                        "out_time"=>date("Y-m-d H:s:i",strtotime($etime[$i])),
                        "out_time"=>date("Y-m-d H:s:i",strtotime($etime[$i])),
                        "updated_at"=>date("Y-m-d H:s:i")
                );

             $this->db->where("teacher_id",$tea_id[$i]);
             $this->db->where("created_at",date("Y-m-d",strtotime($sdate[$i])));
             $qry=$this->db->update("teacher_attendences",$data);
          

            if($qry)
            {
               // echo "Successfully update";
            }
            else
            {
                //echo "Fail to update";

            }
        }

     }

       $this->index();
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
            
            $this->load->view('layout/teacher/header', $data);
            $this->load->view('teacher/teaattendence/teaattendencereport', $data);
            $this->load->view('layout/teacher/footer', $data);
        } else {
      
        $this->form_validation->set_rules('month', 'Month', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/teacher/header', $data);
            $this->load->view('teacher/teaattendence/teaattendencereport', $data);
            $this->load->view('layout/teacher/footer', $data);
        } else {

           
            $month = $this->input->post('month');
           
            $data['month_selected'] = $month;
            $month_number = date("m",strtotime($month));
             $att_date=date("Y-$month_number");

            $res = $this->teaattendence_model->searchAttendenceClassSection($att_date);
            $data["resultlist"]=$res;
            $data['attendence_array'] = $attendence_array;
            $data['student_array'] = $student_result;
            $this->load->view('layout/teacher/header', $data);
            $this->load->view('teacher/teaattendence/teaattendencereport', $data);
            $this->load->view('layout/teacher/footer', $data);
        }
    }

}




}

?>