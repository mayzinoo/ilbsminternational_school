<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Stuattendence extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('file');
        $this->lang->load('message', 'english');
        $this->config->load("mailsms");
        $this->load->library('mailsmsconf');
        $this->config_attendance = $this->config->item('attendence');
        $this->load->model("Common_model");
    }

    function index() {

        $this->session->set_userdata('top_menu', 'Attendance');
        $this->session->set_userdata('sub_menu', 'stuattendence/index');
        $attendencetypes = $this->attendencetype_model->get();
        $data['attendencetypeslist'] = $attendencetypes;
        $data['title'] = 'Attendance Report List';
        $data['classlist'] =$this->class_model->get();
        $data['monthlist'] = $this->customlib->getMonthDropdown();
      
        $data['date'] = "";
        $data['month_selected'] = "";
        $data['year_selected'] = "";
        
        if ($this->input->server('REQUEST_METHOD') == "GET") {

        
             $class=1;
            $section=1;
            $month=date("n");
            $year=date("Y");
            $data["studentlist"] = $this->student_model->searchByClassSection($class, $section,0);
            $data['month_selected'] = $month;
            $data['year_selected'] = $year;
            $data['class_id'] = 1;
       		$data['section_id'] = 1;
            $att_date=date("Y-m");            
          
            $res = $this->stuattendence_model->get($class, $section, $year, $month);
            $data["resultlist"]=$res;
            $this->load->view('layout/header', $data);
            $this->load->view('admin/stuattendence/attendenceList', $data);
            $this->load->view('layout/footer', $data);
        } else {
        $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
        $this->form_validation->set_rules('month', 'Month', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/stuattendence/attendenceList', $data);
            $this->load->view('layout/footer', $data);
        } else {

            $class = $this->input->post('class_id');
            $section = $this->input->post('section_id');
            $month = $this->input->post('month');         
            $year = $this->input->post('year');         
          
            $data['class_id'] = $class;
            $data['section_id'] = $section;
            $data['month_selected'] = $month;
            $data['year_selected'] = $year;
            $month_number = date("m",strtotime($month));
            $att_date=date("Y-$month_number");

            $this->session->set_userdata('class', $class);
            $this->session->set_userdata('att_date', $att_date);
            $this->session->set_userdata('section', $section);
            $this->session->set_userdata('month', $month);

            $res = $this->stuattendence_model->get($class, $section, $year, $month);
            $data["resultlist"]=$res;
            $data['attendence_array'] = $attendence_array;
            $data['student_array'] = $student_result;
            $this->load->view('layout/header', $data);
            $this->load->view('admin/stuattendence/attendenceList', $data);
            $this->load->view('layout/footer', $data);
        }
    }
    }



    function monthlyattandence()
    {
        $this->session->set_userdata('top_menu', 'Attendance');
        $this->session->set_userdata('sub_menu', 'stuattendence/monthlyattandence');
        $data['title'] = 'Attendance Report List';
        $data['classlist'] =$this->class_model->get();
        $data['sessionlist'] =$this->Common_model->get_sessiondata();
      
        $data['date'] = "";
        $data['sel_session'] = "";
        
        if ($this->input->server('REQUEST_METHOD') == "GET") {

        
             $class=1;
            $section=1;
            $sel_session=$this->setting_model->getCurrentSessionid();;
        // $month=$this->input->post("month");
            $data["studentlist"] = $this->student_model->searchByClassSection($class, $section,0);
            $data['sel_session'] = $sel_session;
            $data['class_id'] = 1;
            $data['section_id'] = 1;
            $att_date=date("Y-m");
// echo $month;exit;
            
          
            $res = $this->stuattendence_model->get_monthly_attendenceList($class, $section,$sel_session);
            $data["resultlist"]=$res;
            $this->load->view('layout/header', $data);
            $this->load->view('admin/stuattendence/monthly_attendenceList', $data);
            $this->load->view('layout/footer', $data);
        } else {
        $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/stuattendence/monthly_attendenceList', $data);
            $this->load->view('layout/footer', $data);
        } else {

            $class = $this->input->post('class_id');
            $section = $this->input->post('section_id');
            $sel_session = $this->input->post('sel_session');         
          
            $data['class_id'] = $class;
            $data['section_id'] = $section;
            $data['sel_session'] = $sel_session;
            $month_number = date("m",strtotime($month));
            $att_date=date("Y-$month_number");

            $this->session->set_userdata('class', $class);
            $this->session->set_userdata('att_date', $att_date);
            $this->session->set_userdata('section', $section);
            $this->session->set_userdata('sel_session', $sel_session);

            $res = $this->stuattendence_model->get_monthly_attendenceList($class, $section,$sel_session);
            $data["resultlist"]=$res;
            $this->load->view('layout/header', $data);
            $this->load->view('admin/stuattendence/monthly_attendenceList', $data);
            $this->load->view('layout/footer', $data);
        }
    }
    }




    function monthlyattandence_percent()
    {
        $this->session->set_userdata('top_menu', 'Attendance');
        $this->session->set_userdata('sub_menu', 'stuattendence/monthlyattandence');
        $data['title'] = 'Attendance Report List';
        $data['classlist'] =$this->class_model->get();
        $data['sessionlist'] =$this->Common_model->get_sessiondata();
      
        $data['date'] = "";
        $data['sel_session'] = "";
        
        if ($this->input->server('REQUEST_METHOD') == "GET") {

        
             $class=1;
            $section=1;
            $sel_session=$this->setting_model->getCurrentSessionid();;
        // $month=$this->input->post("month");
            $data["studentlist"] = $this->student_model->searchByClassSection($class, $section,0);
            $data['sel_session'] = $sel_session;
            $data['class_id'] = 1;
            $data['section_id'] = 1;
            $att_date=date("Y-m");
// echo $month;exit;
            
          
            $res = $this->stuattendence_model->get_monthly_attendenceList($class, $section,$sel_session);
            $data["resultlist"]=$res;
            $data["attday_result"]=$this->stuattendence_model->get_school_calendar($sel_session);

            $this->load->view('layout/header', $data);
            $this->load->view('admin/stuattendence/monthly_attendence_percentList', $data);
            $this->load->view('layout/footer', $data);
        } else {
        $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/stuattendence/monthly_attendence_percentList', $data);
            $this->load->view('layout/footer', $data);
        } else {

            $class = $this->input->post('class_id');
            $section = $this->input->post('section_id');
            $sel_session = $this->input->post('sel_session');         
          
            $data['class_id'] = $class;
            $data['section_id'] = $section;
            $data['sel_session'] = $sel_session;
            $month_number = date("m",strtotime($month));
            $att_date=date("Y-$month_number");

            $this->session->set_userdata('class', $class);
            $this->session->set_userdata('att_date', $att_date);
            $this->session->set_userdata('section', $section);
            $this->session->set_userdata('sel_session', $sel_session);

            $res = $this->stuattendence_model->get_monthly_attendenceList($class, $section,$sel_session);
            $data["resultlist"]=$res;
            $data["attday_result"]=$this->stuattendence_model->get_school_calendar($sel_session);

            $this->load->view('layout/header', $data);
            $this->load->view('admin/stuattendence/monthly_attendence_percentList', $data);
            $this->load->view('layout/footer', $data);
        }
    }
    }

    function absent() {

        $this->session->set_userdata('top_menu', 'Attendance');
        $this->session->set_userdata('sub_menu', 'stuattendence/absent');
        $attendencetypes = $this->attendencetype_model->get();
        $data['attendencetypeslist'] = $attendencetypes;
        $data['title'] = 'Attendance Report List';
        $data['classlist'] =$this->class_model->get();
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
            $this->session->set_userdata('month', $month);
            }
             $class=1;
            $section=1;
        
            $data["studentlist"] = $this->student_model->searchByClassSection($class, $section,0);
            $data['month_selected'] = date("F");
            $att_date=date("Y-m");

            
          
            $res = $this->stuattendence_model->get_absent();
            $data["resultlist"]=$res;
            $this->load->view('layout/header', $data);
            $this->load->view('admin/stuattendence/absentList', $data);
            $this->load->view('layout/footer', $data);
        } else {
        $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
        $this->form_validation->set_rules('month', 'Month', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/stuattendence/absentList', $data);
            $this->load->view('layout/footer', $data);
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
            $this->session->set_userdata('month', $month);

            $res = $this->stuattendence_model->searchAbsentClassSection($class, $section, $month);
            $data["resultlist"]=$res;
            $data['attendence_array'] = $attendence_array;
            $data['student_array'] = $student_result;
            $this->load->view('layout/header', $data);
            $this->load->view('admin/stuattendence/absentList', $data);
            $this->load->view('layout/footer', $data);
        }
    }
    }
    function leave()
    {
        $this->session->set_userdata('top_menu', 'Attendance');
        $this->session->set_userdata('sub_menu', 'stuattendence/leave');
        $attendencetypes = $this->attendencetype_model->get();
        $data['attendencetypeslist'] = $attendencetypes;
        $data['title'] = 'Attendance Report List';
        $data['classlist'] =$this->class_model->get();
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
            $this->session->set_userdata('month', $month);
            }
             $class=1;
            $section=1;
        
            $data["studentlist"] = $this->student_model->searchByClassSection($class, $section,0);
            $data['month_selected'] = date("F");
            $att_date=date("Y-m");

            
          
            $res = $this->stuattendence_model->get_leave();
            $data["resultlist"]=$res;
            $this->load->view('layout/header', $data);
            $this->load->view('admin/stuattendence/leavelist', $data);
            $this->load->view('layout/footer', $data);
        } else {
        $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
        $this->form_validation->set_rules('month', 'Month', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/stuattendence/leavelist', $data);
            $this->load->view('layout/footer', $data);
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
            $this->session->set_userdata('month', $month);

            $res = $this->stuattendence_model->searchLeaveClassSection($class, $section, $month);
            $data["resultlist"]=$res;
            $data['attendence_array'] = $attendence_array;
            $data['student_array'] = $student_result;
            $this->load->view('layout/header', $data);
            $this->load->view('admin/stuattendence/leavelist', $data);
            $this->load->view('layout/footer', $data);
        }
    }
    }

    function stuattendence_form()
    { 
        $data['title'] = 'Add Attendance';

        //$this->load->view('layout/header', $data);
        $this->load->view('admin/stuattendence/stuattendence_form', $data);
       // $this->load->view('layout/footer', $data);
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

     $data["school"]=$this->Common_model->grab_school();
        $data["statusarr"]=array(
    "Present"=>"Present",
    "Absent"=>"Absent",
    "Leave"=>"Leave",
    "Holiday"=>"Holiday",
    "Half Day Leave"=>"Half Day Leave"
    
);
      if ($this->input->server('REQUEST_METHOD') == "GET") {
           
           $class = $this->class_model->get();
           $section = $this->section_model->get();

         $data['sessionlist'] =$this->Common_model->get_sessiondata();
            $sel_session=$this->setting_model->getCurrentSessionid();;

           $data['classlist'] = $class;
		   $data['sectionlist']=$section;
           $data['class_id'] = "";
           $data['section_id'] = "";
           $data['date'] = "";

          
            $this->load->view('layout/header', $data);
            $this->load->view('admin/stuattendence/stumaintenance_form', $data);
            $this->load->view('layout/footer', $data);
        } else {
			
			
			$class_id = $this->input->post('class_id');
        	$section_id = $this->input->post('section_id');  
        	$school = $this->input->post('school');  
			$data['class_id'] = $class_id;
           $data['section_id'] = $section_id;
			  $class = $this->class_model->get();
           $section = $this->section_model->get();
           $data['classlist'] = $class;
		   $data['sectionlist']=$section;
		   $resign=0;

			$studentlist = $this->student_model->searchByClassSection($class_id, $section_id,$resign,$school);
			$data['resultlist'] = $studentlist;
            $this->load->view('layout/header', $data);
            $this->load->view('admin/stuattendence/stumaintenance_form', $data);
            $this->load->view('layout/footer', $data);
        
        }
        
        }


function stumaintenance_insert()
    {

        $class = $this->input->post('class');
        $section= $this->input->post('section');       
        $session=$this->setting_model->getCurrentSessionid();

        $stu_id=$this->input->post("stu_id");
        $sdate=date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('sdate')));
        $stime=$this->input->post("stime");
        $etime=$this->input->post("etime");
        $reason=$this->input->post("reason");
        
        
        $authority=$this->customlib->getAdminSessionUserName();

		if($this->input->post("holiday"))
        {
            $status=$this->input->post("holiday");     
           
                 for($i=0;$i<count($stu_id);$i++) 
                 {
                 $data=array(
                        "student_id"=>$stu_id[$i],
                        "class_id"=>$class[$i],
                        "section_id"=>$section[$i],
                        "session_id"=>$session,
                        'approved_by'=> $authority,
                        'created_at' => $sdate,
                        'status'=> $status
    
    
                    );
    
                     $qry=$this->db->insert("student_attendences",$data);
                     $err=  $this->db->error(); 
                   echo $err["message"];
    
                     
                if($qry)
                {
    
                   // echo "<tr><td></td></tr>"
                  //  echo "Successfully inserted";
                }
                else
                {
                    echo "Fail to insert";
    
                }
            
             }

        }
        
        else
        {
            
            
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
                    "session_id"=>$session,

                    'created_at' => $sdate,
                    "in_time"=>date("Y-m-d H:s:i",strtotime($stime[$i])),
                    'status'=> $reason[$i]


                );

                 $qry=$this->db->insert("student_attendences",$data);
               

                 
            if($qry)
            {

               // echo "<tr><td></td></tr>"
              //  echo "Successfully inserted";
            }
            else
            {
                echo "Fail to insert";

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
             $this->db->where("created_at",$sdate);
             $qry=$this->db->update("student_attendences",$data);
          

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
     
     
        }

      
		
		echo "hello";
	//	exit;
		redirect("admin/Stuattendence");
   // $this->index();

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
            $this->load->view('layout/header', $data);
            $this->load->view('student/studentReport', $data);
            $this->load->view('layout/footer', $data);
        } else {
        $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
        $this->form_validation->set_rules('date', 'Date', 'trim|required|xss_clean');
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('layout/header', $data);
                $this->load->view('admin/stuattendence/attendenceList', $data);
                $this->load->view('layout/footer', $data);
            } else {

                $class = $this->input->post('class_id');
                $section = $this->input->post('section_id');
                $date = $this->input->post('date');
                $resultlist = $this->stuattendence_model->searchAttendenceClassSection($class, $section, date('Y-m-d', $this->customlib->datetostrtotime($date)));
                $data['resultlist'] = $resultlist;

                $this->load->view('layout/header', $data);
                $this->load->view('admin/stuattendence/attendenceList', $data);
                $this->load->view('layout/footer', $data);
                
                }

    }

}
    
    function classattendencereport() {
        $this->session->set_userdata('top_menu', 'Attendance');
        $this->session->set_userdata('sub_menu', 'stuattendence/classattendencereport');
        $attendencetypes = $this->attendencetype_model->get();
        $data['attendencetypeslist'] = $attendencetypes;
        $data['title'] = 'Attendance Report List';
        $data['classlist'] =$this->class_model->get();
        $data['monthlist'] = $this->customlib->getMonthDropdown();
        $data['class_id'] = "";
        $data['section_id'] = "";
        $data['att_date'] = "";
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
            $this->session->set_userdata('month', $month);
            }
             $class=1;
            $section=1;
        
            $data["studentlist"] = $this->student_model->searchByClassSection($class, $section,0);
            $data['month_selected'] = date("F");
            $att_date=date("Y-m");

            
          
            $res = $this->stuattendence_model->searchAttendenceClassSection($class, $section, $att_date);
            $data["resultlist"]=$res;
            $this->load->view('layout/header', $data);
            $this->load->view('admin/stuattendence/classattendencereport', $data);
            $this->load->view('layout/footer', $data);
        } else {
        $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
        $this->form_validation->set_rules('date', 'Date', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/stuattendence/classattendencereport', $data);
            $this->load->view('layout/footer', $data);
        } else {

            $class = $this->input->post('class_id');
            $section = $this->input->post('section_id');
            $date = date("Y-m-d",strtotime($this->input->post('date')));         
            $data['class_id'] = $class;
            $data['section_id'] = $section;
            $data["att_date"]=$this->input->post('date');

            $this->session->set_userdata('class', $class);
            $this->session->set_userdata('att_date', $att_date);
            $this->session->set_userdata('section', $section);
            $this->session->set_userdata('$date', $date);

            $res = $this->stuattendence_model->searchAttendenceClassSection($class, $section, $date);
            $data["resultlist"]=$res;
            $data['attendence_array'] = $attendence_array;
            $data['student_array'] = $student_result;
            $this->load->view('layout/header', $data);
            $this->load->view('admin/stuattendence/classattendencereport', $data);
            $this->load->view('layout/footer', $data);
        }
    }

}

 function classabsentreport() {
        $this->session->set_userdata('top_menu', 'Attendance');
        $this->session->set_userdata('sub_menu', 'stuattendence/classattendencereport');
        $attendencetypes = $this->attendencetype_model->get();
        $data['attendencetypeslist'] = $attendencetypes;
        $data['title'] = 'Absent Report List';
        $data['classlist'] = $this->class_model->get();
        $data['monthlist'] = $this->customlib->getMonthDropdown();

        $class=$this->session->userdata('class');
        $att_date=$this->session->userdata('att_date');
        $section=$this->session->userdata('section');
        $month=$this->session->userdata('month');


        $data['class_id'] = $class;
        $data['section_id'] = $section;
        $data['date'] = $att_date;
        $data['month_selected'] = $month;
        if ($this->input->server('REQUEST_METHOD') == "GET") {

                      
            

            $data["studentlist"] = $this->student_model->searchByClassSection($class, $section,0);
            $data['month_selected'] = $att_date;

            
          
            $res = $this->stuattendence_model->searchAbsentClassSection($class, $section, $att_date);
            $data["resultlist"]=$res;
            $this->load->view('layout/header', $data);
            $this->load->view('admin/stuattendence/classabsentreport', $data);
            $this->load->view('layout/footer', $data);
        } 

}

function edit()
{
    $id=$this->input->post("id");
    $status=$this->input->post("status");
    $data=array("status"=>$status);
    $this->db->where("id",$id);
    $this->db->update("student_attendences",$data);
    echo $status;
    
    
}

function delete($id)
{
    $this->db->where("id",$id);
    $this->db->delete("student_attendences");
    redirect("admin/Stuattendence/classattendencereport");
}





}

?>