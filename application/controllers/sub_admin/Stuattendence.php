<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Stuattendence extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('file');
        $this->lang->load('message', 'english');
        $this->config->load("mailsms");
        $this->load->library('mailsmsconf');
        $this->config_attendance = $this->config->item('attendence');
    }

    function index() {

        $this->session->set_userdata('top_menu', 'Attendance');
        $this->session->set_userdata('sub_menu', 'stuattendence/index');
        $data['title'] = 'Add Fees Type';
        $data['title_list'] = 'Fees Type List';
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $data['class_id'] = "";
        $data['section_id'] = "";
        $data['date'] = "";
        $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
        $resultlist = $this->stuattendence_model->get();
        $data['resultlist'] = $resultlist;    
        $this->load->view('layout/teacher/header', $data);
        $this->load->view('teacher/stuattendence/attendenceList', $data);
        $this->load->view('layout/teacher/footer', $data);
        }



         function absent() {

        $this->session->set_userdata('top_menu', 'Attendance');
        $this->session->set_userdata('sub_menu', 'stuattendence/index');
        $data['title'] = 'Add Fees Type';
        $data['title_list'] = 'Fees Type List';
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $data['class_id'] = "";
        $data['section_id'] = "";
        $data['date'] = "";
        $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
        $resultlist = $this->stuattendence_model->get_absent();
        $data['resultlist'] = $resultlist;    
        $this->load->view('layout/teacher/header', $data);
        $this->load->view('teacher/stuattendence/absentList', $data);
        $this->load->view('layout/teacher/footer', $data);
        }
    

    function stuattendence_form()
    { 
        $data['title'] = 'Add Attendance';

        //$this->load->view('layout/teacher/header', $data);
        $this->load->view('teacher/stuattendence/stuattendence_form', $data);
       // $this->load->view('layout/teacher/footer', $data);
    }


    function insert_attendance()
    {
        $stu_id=$this->input->post("id");
        $check=$this->db->get_where("student_attendences",array('student_id'=>$stu_id,'created_at'=>date("Y-m-d")));
        if($check->num_rows()<1)
        {

        $row=$this->student_model->get($stu_id);
        $data=array(
                        "student_id"=>$stu_id,
                        "class_id"=>$row["class_id"],
                        "section_id"=>$row["section_id"],
                        'approved_by'=> $this->customlib->getAdminSessionUserName(),
                        "created_at"=>date("Y-m-d")

                    );

        $qry=$this->db->insert("student_attendences",$data);
            if($qry)
            {

               // echo "<tr><td></td></tr>"
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

             $this->db->where("student_id",$stu_id);
             $this->db->where("created_at",date("Y-m-d"));
             $qry=$this->db->update("student_attendences",$data);
          

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



function stumaintenance()
{
        $this->session->set_userdata('top_menu', 'Attendance');
        $this->session->set_userdata('sub_menu', 'stuattendence/stumaintenance');

        
      if ($this->input->server('REQUEST_METHOD') == "GET") {
           
           $class = $this->class_model->get();
           $section = $this->section_model->get();
           $data['classlist'] = $class;
           $data['sectionlist']=$section;
           $data['class_id'] = "";
           $data['section_id'] = "";
           $data['date'] = "";

            $resultlist = $this->student_model->get();
            $data['resultlist'] = $resultlist;
            $this->load->view('layout/teacher/header', $data);
            $this->load->view('teacher/stuattendence/stumaintenance_form', $data);
            $this->load->view('layout/teacher/footer', $data);
        } else {
            
            
            $class_id = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');  
            $data['class_id'] = $class_id;
           $data['section_id'] = $section_id;
              $class = $this->class_model->get();
           $section = $this->section_model->get();
           $data['classlist'] = $class;
           $data['sectionlist']=$section;

            $studentlist = $this->student_model->searchByClassSection($class_id, $section_id);
            $data['resultlist'] = $studentlist;
            $this->load->view('layout/teacher/header', $data);
            $this->load->view('teacher/stuattendence/stumaintenance_form', $data);
            $this->load->view('layout/teacher/footer', $data);
            

           

}




}


function stumaintenance_insert()
    {

        $class = $this->input->post('class');
        $section= $this->input->post('section');         
        $stu_id=$this->input->post("stu_id");
        $sdate=date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('sdate')));
        $stime=$this->input->post("stime");
        $etime=$this->input->post("etime");
        $reason=$this->input->post("reason");       
        $authority=$this->customlib->getStudentSessionUserName();
        

        

        for($i=0;$i<count($stu_id);$i++) 

        {    

            if($status[$i] !="")
            {
                
            }

        $check=$this->db->get_where("student_attendences",array('student_id'=>$stu_id[$i],'created_at'=>$sdate));
       
       
        if($check->num_rows()<1)
        {

        $data=array(
                    "student_id"=>$stu_id[$i],
                    "class_id"=>$class[$i],
                    "section_id"=>$section[$i],
                    'approved_by'=> $authority,
                    'created_at' => $sdate,
                    "in_time"=>date("Y-m-d H:s:i",strtotime($stime[$i])),
                    'status'=> $reason[$i]


                );

                 $qry=$this->db->insert("student_attendences",$data);
               

                 
            if($qry)
            {

               // echo "<tr><td></td></tr>"
               // echo "Successfully inserted";
            }
            else
            {
               // echo "Fail to insert";

            }
        
        }

        

        else
        {
           

            $data=array(
                        "out_time"=>date("Y-m-d H:s:i",strtotime($etime[$i])),
                        "out_time"=>date("Y-m-d H:s:i",strtotime($etime[$i])),
                        "updated_at"=>date("Y-m-d H:s:i"),
                         'status'=> $reason[$i]

                );

             $this->db->where("student_id",$stu_id[$i]);
             $this->db->like("created_at",$sdate);
             $qry=$this->db->update("student_attendences",$data);
          

            if($qry)
            {
              //  echo "Successfully update";
            }
            else
            {
               // echo "Fail to update";

            }
        }

     }
        
        

       $this->index();
    }



    function attendencereport() {
        $this->session->set_userdata('top_menu', 'Attendance');
        $this->session->set_userdata('sub_menu', 'stuattendence/attendenceReport');
        $data['title'] = 'Add Fees Type';
        $data['title_list'] = 'Fees Type List';
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $data['class_id'] = "";
        $data['section_id'] = "";
        $data['date'] = "";
          if ($this->input->server('REQUEST_METHOD') == "GET") {
            $resultlist = $this->stuattendence_model->get();
          $data['resultlist'] = $resultlist;
            $this->load->view('layout/teacher/header', $data);
            $this->load->view('student/studentReport', $data);
            $this->load->view('layout/teacher/footer', $data);
        } else {
        $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
        $this->form_validation->set_rules('date', 'Date', 'trim|required|xss_clean');
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('layout/teacher/header', $data);
                $this->load->view('teacher/stuattendence/attendenceList', $data);
                $this->load->view('layout/teacher/footer', $data);
            } else {

                $class = $this->input->post('class_id');
                $section = $this->input->post('section_id');
                $date = $this->input->post('date');
                $resultlist = $this->stuattendence_model->searchAttendenceClassSection($class, $section, date('Y-m-d', $this->customlib->datetostrtotime($date)));
                $data['resultlist'] = $resultlist;

                $this->load->view('layout/teacher/header', $data);
                $this->load->view('teacher/stuattendence/attendenceList', $data);
                $this->load->view('layout/teacher/footer', $data);
                
                }

    }

}
    
    function classattendencereport() {
        $this->session->set_userdata('top_menu', 'Attendance');
        $this->session->set_userdata('sub_menu', 'stuattendence/classattendencereport');
        $attendencetypes = $this->attendencetype_model->get();
        $data['attendencetypeslist'] = $attendencetypes;
        $data['title'] = 'Add Fees Type';
        $data['title_list'] = 'Fees Type List';
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $data['monthlist'] = $this->customlib->getMonthDropdown();
        $data['class_id'] = "";
        $data['section_id'] = "";
        $data['date'] = "";
        $data['month_selected'] = "";
        if ($this->input->server('REQUEST_METHOD') == "GET") {

            if($this->session->userdata("month"))
            {
                
            }

            else
            {
            $this->session->set_userdata('class', $class);
            $this->session->set_userdata('att_date', $att_date);
            $this->session->set_userdata('section', $section);
            }
             $class=1;
            $section=1;
        
            $data["studentlist"] = $this->student_model->searchByClassSection($class, $section);
            $data['month_selected'] = date("F");
            $att_date=date("Y-m");

            
          
            $res = $this->stuattendence_model->searchAttendenceClassSection($class, $section, $att_date);
            $data["resultlist"]=$res;
            $this->load->view('layout/teacher/header', $data);
            $this->load->view('teacher/stuattendence/classattendencereport', $data);
            $this->load->view('layout/teacher/footer', $data);
        } else {
        $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
        $this->form_validation->set_rules('month', 'Month', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/teacher/header', $data);
            $this->load->view('teacher/stuattendence/classattendencereport', $data);
            $this->load->view('layout/teacher/footer', $data);
        } else {

            $class = $this->input->post('class_id');
            $section = $this->input->post('section_id');
            $month = $this->input->post('month');         
            $data['class_id'] = $class;
            $data['section_id'] = $section;
            $data['month_selected'] = $month;
            $month_number = date("m",strtotime($month));
             $att_date=date("Y-$month_number");

            $this->session->set_userdata('class', $class);
            $this->session->set_userdata('att_date', $att_date);
            $this->session->set_userdata('section', $section);

            $res = $this->stuattendence_model->searchAttendenceClassSection($class, $section, $att_date);
            $data["resultlist"]=$res;
            $data['attendence_array'] = $attendence_array;
            $data['student_array'] = $student_result;
            $this->load->view('layout/teacher/header', $data);
            $this->load->view('teacher/stuattendence/classattendencereport', $data);
            $this->load->view('layout/teacher/footer', $data);
        }
    }

}


function classabsentreport() {
        $this->session->set_userdata('top_menu', 'Attendance');
        $this->session->set_userdata('sub_menu', 'stuattendence/classabsentreport');
        $attendencetypes = $this->attendencetype_model->get();
        $data['attendencetypeslist'] = $attendencetypes;
        $data['title'] = 'Add Fees Type';
        $data['title_list'] = 'Fees Type List';
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $data['monthlist'] = $this->customlib->getMonthDropdown();
        $data['class_id'] = "";
        $data['section_id'] = "";
        $data['date'] = "";
        $data['month_selected'] = "";
        if ($this->input->server('REQUEST_METHOD') == "GET") {
            
            $class=$this->session->userdata("class");
            $section=$this->session->userdata("section");
            $att_date=$this->session->userdata("att_date");


            $data["studentlist"] = $this->student_model->searchByClassSection($class, $section);
            $data['month_selected'] = date("F");
          
            $res = $this->stuattendence_model->searchAbsentClassSection($class, $section, $att_date);
            $data["resultlist"]=$res;
            $this->load->view('layout/teacher/header', $data);
            $this->load->view('teacher/stuattendence/classabsentreport', $data);
            $this->load->view('layout/teacher/footer', $data);
        } else {
        $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
        $this->form_validation->set_rules('month', 'Month', 'trim|required|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/teacher/header', $data);
            $this->load->view('teacher/stuattendence/classabsentreport', $data);
            $this->load->view('layout/teacher/footer', $data);
        } else {


          $class=$this->session->userdata("class");
          $section=$this->session->userdata("section");
          $att_date=$this->session->userdata("att_date");

            $month = $this->input->post('month');

            
            $data['class_id'] = $class;
            $data['section_id'] = $section;
            $data['month_selected'] = $month;
            $month_number = date("m",strtotime($month));
            $res = $this->stuattendence_model->searchAttendenceClassSection($class, $section, $att_date);
            $data["resultlist"]=$res;
            $data['attendence_array'] = $attendence_array;
            $data['student_array'] = $student_result;
            $this->load->view('layout/teacher/header', $data);
            $this->load->view('teacher/stuattendence/classabsentreport', $data);
            $this->load->view('layout/teacher/footer', $data);
        }
    }

}




}

?>