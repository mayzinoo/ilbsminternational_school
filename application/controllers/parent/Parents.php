<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Parents extends CI_Controller {

   public $payment_method;
    function __construct() {
        parent::__construct();
        $this->load->library('auth');
        $this->lang->load('message', 'english');
        $this->load->library('auth');
        $this->auth->is_logged_in_parent();
        $this->payment_method =  $this->paymentsetting_model->getActiveMethod();
        $this->load->model("Studentfee_model");
        $this->load->model("Dailyrecord_model");
        $this->load->model("examschedule_model");
        $this->load->model("Weeklypreparation_model");
        $this->load->model("Common_model");
        $this->load->model("feecategory_model");
        $this->load->model("Notification_model");
     $this->load->model("Reportcard_model");

    }

    function dashboard() {
        $this->session->set_userdata('top_menu', 'Dashboard');
        $this->session->set_userdata('sub_menu', 'parent/parents/dashboard');
        $student_id = $this->customlib->getStudentSessionUserID();
        
        $array_childs = array();
        $ch = $this->session->userdata('parent_childs');
        
        foreach ($ch as $key_ch => $value_ch) {
            $array_childs[] = $this->student_model->get($value_ch['student_id']);
        }
        $data["student"]=$this->student_model->get($student_id);
 
        $data['student_list'] = $array_childs;
        $this->load->view('layout/parent/header', $data);
        $this->load->view('parent/parent_dashboard', $data);
        $this->load->view('layout/parent/footer', $data);
    }
    
    
      function feedback() {
        $this->session->set_userdata('top_menu', 'Parent');
        $this->session->set_userdata('sub_menu', 'parent/parents/feedback');
        $student_id = $this->customlib->getStudentSessionUserID();
        $array_childs = array();
        $ch = $this->session->userdata('parent_childs');
        foreach ($ch as $key_ch => $value_ch) {
            $array_childs[] = $this->student_model->get($value_ch['student_id']);
        }
        $data['student_list'] = $array_childs;
        $data["feedbacks"]=$this->db->order_by("id","ASC")->get_where("feedback",array("user_id"=>$student_id));
        
        $data_status=array("viewm"=>1);
        $this->db->where("user_id",$student_id);
        $this->db->update("feedback",$data_status);
        
        $this->load->view('layout/parent/header', $data);
        $this->load->view('parent/feedback', $data);
        $this->load->view('layout/parent/footer', $data);
    }
    
    
    function send_feedback()
    {
        $message=strip_tags($this->input->post("message"));
        $this->form_validation->set_rules('message', 'message', 'trim|required|xss_clean');

         if ($this->form_validation->run() == FALSE) {
             
            
         }
         else
         {
        $student_id = $this->customlib->getStudentSessionUserID();

        $data=array(
                    "user_id"=>$student_id,
                    "message"=>$message,
                    "date"=>date("Y-m-d h:i:s a")
            );
            
            $qry=$this->db->insert("feedback",$data);
        echo '  <div class="incoming_msg">
              <div class="incoming_msg_img"> <img src="'.base_url().'uploads/school_content/logo/user-profile.png"> </div>
              <div class="received_msg">
                <div class="received_withd_msg">
                  <p>'.$message.'</p>
                  <span class="time_date"> '.date("h:m A").'   |    Today</span></div>
              </div>
            </div>';
         }
    }



    public function download($student_id, $doc) {
        $this->load->helper('download');
        $filepath = "./uploads/student_documents/$student_id/" . $this->uri->segment(5);
        $data = file_get_contents($filepath);
        $name = $this->uri->segment(6);
        force_download($name, $data);
    }

    function inter_reportcard($id)
    {

         $student=$this->session->userdata("student");
        $this->db->select("inter_exam_schedules.*,inter_exam_schedules.id as esid,exams.name as ename");
       $this->db->join("inter_exam_schedules","exams.id=inter_exam_schedules.exam_id","left");
       $this->db->where("inter_exam_schedules.inter_class",$student['inter_class']);
       $data["exs"]=$this->db->get("exams");

        $this->load->view('layout/parent/header', $data);
        $this->load->view('parent/student/inter_reportcard', $data);
        $this->load->view('layout/parent/footer', $data);

    }

    function changepass() {
        $data['title'] = 'Change Password';
        $this->form_validation->set_rules('current_pass', 'Current password', 'trim|required|xss_clean');
        $this->form_validation->set_rules('new_pass', 'New password', 'trim|required|xss_clean|matches[confirm_pass]');
        $this->form_validation->set_rules('confirm_pass', 'Confirm password', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $sessionData = $this->session->userdata('loggedIn');
            $this->data['id'] = $sessionData['id'];
            $this->data['username'] = $sessionData['username'];
            $this->load->view('layout/parent/header', $data);
            $this->load->view('parent/change_password', $data);
            $this->load->view('layout/parent/footer', $data);
        } else {
            $sessionData = $this->session->userdata('student');
            $data_array = array(
                'current_pass' => ($this->input->post('current_pass')),
                'new_pass' => ($this->input->post('new_pass')),
                'user_id' => $sessionData['id'],
                'user_name' => $sessionData['username']
            );
            $newdata = array(
                'id' => $sessionData['id'],
                'password' => $this->input->post('new_pass')
            );
            $query1 = $this->user_model->checkOldPass($data_array);
            if ($query1) {
                $query2 = $this->user_model->saveNewPass($newdata);
                if ($query2) {

                    $this->session->set_flashdata('success_msg', 'Password changed successfully');
                    $this->load->view('layout/parent/header', $data);
                    $this->load->view('parent/change_password', $data);
                    $this->load->view('layout/parent/footer', $data);
                }
            } else {

                $this->session->set_flashdata('error_msg', 'Invalid current password');
                $this->load->view('layout/parent/header', $data);
                $this->load->view('parent/change_password', $data);
                $this->load->view('layout/parent/footer', $data);
            }
        }
    }

    function changeusername() {
        $sessionData = $this->customlib->getLoggedInUserData();

        $data['title'] = 'Change Username';
        $this->form_validation->set_rules('current_username', 'Current username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('new_username', 'New username', 'trim|required|xss_clean|matches[confirm_username]');
        $this->form_validation->set_rules('confirm_username', 'Confirm username', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            
        } else {

            $data_array = array(
                'username' => $this->input->post('current_username'),
                'new_username' => $this->input->post('new_username'),
                'role' => $sessionData['role'],
                'user_id' => $sessionData['id'],
            );
            $newdata = array(
                'id' => $sessionData['id'],
                'username' => $this->input->post('new_username')
            );
            $is_valid = $this->user_model->checkOldUsername($data_array);

            if ($is_valid) {
                $is_exists = $this->user_model->checkUserNameExist($data_array);
                if (!$is_exists) {
                    $is_updated = $this->user_model->saveNewUsername($newdata);
                    if ($is_updated) {
                        $this->session->set_flashdata('success_msg', 'Username changed successfully');
                        redirect('parent/parents/changeusername');
                    }
                } else {
                    $this->session->set_flashdata('error_msg', 'Username Already Exists, Please choose other');
                }
            } else {
                $this->session->set_flashdata('error_msg', 'Invalid current username');
            }
        }
        $this->data['id'] = $sessionData['id'];
        $this->data['username'] = $sessionData['username'];
        $this->load->view('layout/parent/header', $data);
        $this->load->view('parent/change_username', $data);
        $this->load->view('layout/parent/footer', $data);
    }

    function getstudent($id = NULL) {
        $this->session->set_userdata('top_menu', 'My Children');
        $this->session->set_userdata('sub_menu', 'parent/parents/getStudent');

        $this->auth->validate_child($id);

        $student_id = $id;
        $payment_setting = $this->paymentsetting_model->get();
        $data['payment_setting'] = $payment_setting;
        $category = $this->category_model->get();
        $data['category_list'] = $category;
        $student = $this->student_model->get($student_id);
        $gradeList = $this->grade_model->get();
        $data['gradeList'] = $gradeList;
        $class_id = $student['class_id'];
        $section_id = $student['section_id'];
        $data['title'] = 'Student Details';
        $student_session_id = $student['student_session_id'];
       // $student_due_fee = $this->studentfeemaster_model->getStudentFees($student_session_id);
        $student_discount_fee = $this->feediscount_model->getStudentFeesDiscount($student_session_id);
        $data['student_discount_fee'] = $student_discount_fee;
        $data['student_due_fee'] = $student_due_fee;
        $feeresultlist = $this->Studentfee_model->getEachstudentFee($student_id);
        $data['feeresultlist'] =$feeresultlist;
        $examList = $this->examschedule_model->getExamByClassandSection($student['class_id'], $student['section_id']);
        $data['examSchedule'] = array();
        if (!empty($examList)) {
            $new_array = array();
            foreach ($examList as $ex_key => $ex_value) {
                $array = array();
                $x = array();
                $exam_id = $ex_value['exam_id'];
                $exam_subjects = $this->examschedule_model->getresultByStudentandExam($exam_id, $student['id']);
                foreach ($exam_subjects as $key => $value) {
                    $exam_array = array();
                    $exam_array['exam_schedule_id'] = $value['exam_schedule_id'];
                    $exam_array['exam_id'] = $value['exam_id'];
                    $exam_array['full_marks'] = $value['full_marks'];
                    $exam_array['passing_marks'] = $value['passing_marks'];
                    $exam_array['exam_name'] = $value['name'];
                    $exam_array['exam_type'] = $value['type'];
                    $exam_array['attendence'] = $value['attendence'];
                    $exam_array['get_marks'] = $value['get_marks'];
                    $x[] = $exam_array;
                }
                $array['exam_name'] = $ex_value['name'];
                $array['exam_result'] = $x;
                $new_array[] = $array;
            }
            $data['examSchedule'] = $new_array;
        }
        $data['student'] = $student;
        $this->load->view('layout/parent/header', $data);
        $this->load->view('parent/student/getstudent', $data);
        $this->load->view('layout/parent/footer', $data);
    }
    
    function updatephone()
    {
        $phone=$this->input->post("phone");
        $student_id=$this->input->post("student_id");
        $data=array("guardian_phone"=>$phone);
        $this->db->where("id",$student_id);
        $this->db->update("students",$data);
        // echo $phone; exit;
    }
    
    function updateaddress()
    {
        $guardian_address=$this->input->post("address");
        $student_id=$this->input->post("student_id");
        $data=array("guardian_address"=>$guardian_address);
        $this->db->where("id",$student_id);
        $this->db->update("students",$data);
        // echo $phone; exit;
    }

    function getfees($id = NULL) {
        $this->auth->validate_child($id);
        $this->session->set_userdata('top_menu', 'Fees');
        $this->session->set_userdata('sub_menu', 'parent/parents/getFees');
        $paymentoption = $this->customlib->checkPaypalDisplay();
        $data['paymentoption'] = $paymentoption;
        $data['payment_method'] = false;
        if (!empty($this->payment_method)) {
        $data['payment_method'] = true;

        }
        $student_id = $id;
        $student = $this->student_model->get($student_id);
        $class_id = $student['class_id'];
        $section_id = $student['section_id'];
        $data['title'] = 'Student Details';
        //$student_due_fee = $this->studentfeemaster_model->getStudentFees($student['student_session_id']);
        $student_discount_fee = $this->feediscount_model->getStudentFeesDiscount($student['student_session_id']);
        $data['student_discount_fee'] = $student_discount_fee;
        $data['student_due_fee'] = $student_due_fee;
        $feeresultlist = $this->Studentfee_model->getEachstudentFee($student_id);
        $feeresultlist->num_rows();
        $data['feeresultlist'] =$feeresultlist;
        $data['student'] = $student;
        $this->load->view('layout/parent/header', $data);
        $this->load->view('parent/student/getfees', $data);
        $this->load->view('layout/parent/footer', $data);
    }



function feedetail($id) {
        $data['title'] = 'studentfee List';

        $student_id=$this->uri->segment(5);
        $student = $this->student_model->get($student_id);
        $data['student'] = $student;

        $studentfee = $this->studentfee_model->get_editdata($id);
        
         $data['studentfee'] = $studentfee;
        $this->load->view('layout/parent/header', $data);
        $this->load->view('parent/studentfee/studentfeeShow', $data);
        $this->load->view('layout/parent/footer', $data);
    }



    function gettimetable($id = NULL) {
        $this->auth->validate_child($id);
        $this->session->set_userdata('top_menu', 'Time Table');
        $this->session->set_userdata('sub_menu', 'parent/parents/gettimetable');
        $student_id = $id;
        $student = $this->student_model->get($student_id);
        $class_id = $student['class_id'];
        $section_id = $student['section_id'];
        $data["class_id"]=$class_id;
        $data["section_id"]=$section_id;
        $data["school"]=$student['school'];
        $result_subjects = $this->teachersubject_model->getSubjectByClsandSection($class_id, $section_id);
        $getDaysnameList = $this->customlib->getDaysname();
        $data['getDaysnameList'] = $getDaysnameList;
        $final_array = array();
        
        $this->db->select("class_time.*,classes.class,sections.section,sessions.session");
            $this->db->join("classes","classes.id=class_time.class_id","left");
            $this->db->join("sections","sections.id=class_time.section_id","left");
            $this->db->join("sessions","sessions.id=class_time.academic_year","left");
            $this->db->where("class_time.class_id",$class_id);
            $this->db->where("class_time.section_id",$section_id);
            $data["lists"]=$this->db->get("class_time");
            
            $this->load->view('layout/parent/header', $data);
            $this->load->view('parent/timetable/timetableList', $data);
            $this->load->view('layout/parent/footer', $data);
    }

    function getsubject($id = NULL) {
        $this->auth->validate_child($id);
        $this->session->set_userdata('top_menu', 'Subjects');
        $this->session->set_userdata('sub_menu', 'parent/parents/getsubject');
        $student_id = $id;
        $student = $this->student_model->get($student_id);
        $data['student'] = $student;
        $class_id = $student['class_id'];
        $section_id = $student['section_id'];
        $data['title'] = 'Student Details';
        $subject_list = $this->teachersubject_model->getSubjectByClsandSection($class_id, $section_id);
        $data['result_array'] = $subject_list;
        $this->load->view('layout/parent/header', $data);
        $this->load->view('parent/student/getsubject', $data);
        $this->load->view('layout/parent/footer', $data);
    }

    function getattendence($id = NULL) {
        $this->auth->validate_child($id);
        $this->session->set_userdata('top_menu', 'Attendance');
        $this->session->set_userdata('sub_menu', 'parent/parents/getattendence');
        $student_id = $id;
        $student = $this->student_model->get($student_id);
        $data['monthlist'] = $this->customlib->getMonthDropdown();
         $session_id = $this->setting_model->getCurrentSession();

        $data['session_id'] = $session_id;
        $data['student_id'] = $student_id;
        $data['student'] = $student;
        $data["attdays"]=$this->parent_model->get_school_calendar($session_id);

        $data["attendances"]=$this->db->query("SELECT created_at as,status FROM student_attendences 
            WHERE student_id='$student_id' AND session_id='$session_id'");
        $data["att_percent"]=$this->parent_model->monthlyattandence_percent($session_id,$student_id);

               

        $this->load->view('layout/parent/header', $data);
        $this->load->view('parent/student/getattendence', $data);
        $this->load->view('layout/parent/footer', $data);
    }


function leave($id = NULL) {
        $this->auth->validate_child($id);
        $this->session->set_userdata('top_menu', 'Attendance');
        $this->session->set_userdata('sub_menu', 'parent/parents/getattendence');
        $student_id = $id;
        $student = $this->student_model->get($student_id);
        $data['student'] = $student;
         $session_id = $this->setting_model->getCurrentSession();

       $data["leaveuser"]=$this->db->query("SELECT leave_tbl.*,students.firstname as fname,
            students.lastname as lname,students.admission_no as adminno,
            classes.class as clss,sections.section as section FROM leave_tbl LEFT JOIN students
             ON leave_tbl.student_id=students.id LEFT JOIN classes ON classes.id=leave_tbl.class_id LEFT JOIN sections 
             ON sections.id=leave_tbl.section_id WHERE leave_tbl.session_id='$session_id' AND 
             leave_tbl.student_id='$student_id' 
             ORDER BY student_id");
  
         

        $this->load->view('layout/parent/header', $data);
        $this->load->view('parent/student/leave', $data);
        $this->load->view('layout/parent/footer', $data);
    }


    function leaveform_insert(){
        
        $stuid=$this->input->post("stuid");
        $leavefrom=$this->input->post("leavefrom");
        $leaveto=$this->input->post("leaveto");
        $time_status=$this->input->post("time_status");
        $reason=$this->input->post("reason");
        
        $classes=$this->input->post("classes");
        $section=$this->input->post("section");
        $session=$this->input->post("session");
        
        $data=array(
            "student_id"=>$stuid,
            "leave_from"=>$leavefrom,
            "leave_to"=>$leaveto,
            "status"=>$time_status,
            "reason"=>$reason,
            "class_id"=>$classes,
            "section_id"=>$section,
            "session_id"=>$session
            );
        $this->db->insert("leave_tbl",$data);
        
        
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Successfully !</div>');
        redirect("parent/parents/getattendence/$stuid");
    }
    
    function dailyrecord($sid) {
        $this->session->set_userdata('top_menu', 'parent/Parents/dailyrecord');
        $this->session->set_userdata('sub_menu', 'parent/Parents/dailyrecord');
        $data['title'] = 'Daily Record List';
         $qry=$this->db->get_where("student_session",array("student_id"=>$sid))->row();
        $class_id=$qry->class_id;
        $section_id=$qry->section_id;
        
        $data["lists"]=$this->db->query("SELECT * FROM dailyrecord WHERE class_section_id='$class_id' ANd section_id='$section_id'")->result_array();
      

        $this->load->view('layout/parent/header', $data);
        $this->load->view('parent/dailyrecordList');// $data);
        $this->load->view('layout/parent/footer', $data);
    }
    
       function viewdailyrecord($id) {
        $data['title'] = 'Daily Record List';
        $lists = $this->Dailyrecord_model->get($id);
        $data['lists'] = $lists;
        $this->load->view('layout/parent/header', $data);
        $this->load->view('parent/dailyrecordShow', $data);
        $this->load->view('layout/parent/footer', $data);
    }
    
     public function exam_schedule($sid) {
        $this->session->set_userdata('top_menu', 'parent/Parents/exam_schedule');
        $this->session->set_userdata('sub_menu', 'parent/Parents/exam_schedule');
        $data['title'] = 'Exam Schedule';
        $class = $this->class_model->get();
        $session_id = $this->setting_model->getCurrentSession();

        $data['classlist'] = $class;
        $feecategory = $this->feecategory_model->get();
        $data['feecategorylist'] = $feecategory;
       $this->load->view('layout/parent/header', $data);
                 $qry=$this->db->get_where("student_session",array("student_id"=>$sid,"session_id"=>$session_id))->row();
                $class_id=$qry->class_id;
                $section_id=$qry->section_id;
                $inter=$qry->inter_class;
            $data['student_due_fee'] = array();
            $data['class_id'] = $class_id;
            $data['section_id'] = $section_id;
            if($inter!="")
            {
                
            $examSchedule = $this->examschedule_model->getInterExamSchdules($inter);
            $data['examSchedule'] = $examSchedule;

            $this->load->view('parent/inter_exam_schedule/examList', $data);

            
            }
            else
            {
            $examSchedule = $this->examschedule_model->getExamByClassandSection($class_id, $section_id);
            $data['examSchedule'] = $examSchedule;

            $this->load->view('parent/exam_schedule', $data);

            }
           
            $this->load->view('layout/parent/footer', $data);
       
    }
    
    function getexamscheduledetail() {
        $exam_id = $this->input->post('exam_id');
        $section_id = $this->input->post('section_id');
        $class_id = $this->input->post('class_id');
        $examSchedule = $this->examschedule_model->getDetailbyClsandSection($class_id, $section_id, $exam_id);
        echo json_encode($examSchedule);
    }
    
   
    
     function getInterDetailbyClsandSection() {
        $header_id = $this->input->post('header_id');
      
        $examSchedule = $this->examschedule_model->getInterDetailbyClsandSection($header_id);
        echo json_encode($examSchedule);
    }
    
    
    public function weeklypreparation($sid) {
        $this->session->set_userdata('top_menu', 'parent/Parents/weeklypreparation');
        $this->session->set_userdata('sub_menu', 'parent/Parents/weeklypreparation');
        $data['title'] = 'Weekly Preparation List';
        $data['teacherlists'] = $this->Common_model->grab_teacher();
        $data['subjectlists'] = $this->Common_model->grab_subject();
        $data['classlists'] = $this->Common_model->grab_class();
        $data['sectionlists'] = $this->Common_model->grab_section();
        $data["lists"]=$this->Weeklypreparation_model->get_weeklypreparation($sid);
        $this->load->view('layout/parent/header', $data);
        $this->load->view('parent/weeklypreparationList');// $data);
        $this->load->view('layout/parent/footer', $data);
    }
    
    
    function view($id) {
        $data['title'] = 'Weekly Preparation List';
        $lists = $this->Weeklypreparation_model->get($id);
        $data['lists'] = $lists;
        $this->load->view('layout/parent/header', $data);
        $this->load->view('parent/weeklypreparationShow', $data);
        $this->load->view('layout/parent/footer', $data);
    }
    

    public function getAjaxAttendence() {
        $year = $this->input->get('year');
        $month = $this->input->get('month');
        $student_id =$this->input->get('student_id');
        $result = array();
        
        $new_date = "01-" . $month . "-" . $year;
        $totalDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $first_day_this_month = date('01-m-Y');
        $fst_day_str = strtotime(date($new_date));
        $array = array();
        for ($day = 2; $day <= $totalDays; $day++) {
            $fst_day_str = ($fst_day_str + 86400);
            $date = date('Y-m-d', $fst_day_str);
            $student_attendence = $this->attendencetype_model->getStudentAttendence($date, $student_id);
                  if (!empty($student_attendence)) {
                $s = array();
                $s['date'] = $date;
                $s['badge'] = false;
                $s['footer'] = "Extra information";
                $s['body'] = $student_attendence->remark;
                $type = $student_attendence->status;
                $s['title'] = $type;
                if ($type == 'Leave') {
                    $s['classname'] = "grade-2";
                } else if ($type == 'Present') {
                    $s['classname'] = "grade-3";
                }  else if ($type == 'Absent') {
                    $s['classname'] = "grade-1";
                } else if ($type == 'Leave') {
                    $s['classname'] = "grade-3";
                } else if ($type == 'Late with excuse') {
                    $s['classname'] = "grade-2";
                } else if ($type == 'Holiday') {
                    $s['classname'] = "grade-5";
                }
                $array[] = $s;
            }
        }
        if (!empty($array)) {
            echo json_encode($array);
        } else {
            echo false;
        }
    }

    function getexams($id = NULL) {
        $this->auth->validate_child($id);
        $this->session->set_userdata('top_menu', 'Examination');
        $this->session->set_userdata('sub_menu', 'parent/parents/getexams');
        $student_id = $id;
        $student = $this->student_model->get($student_id);
        $class_id = $student['class_id'];
        $section_id = $student['section_id'];
        $data['title'] = 'Student Details';
        $gradeList = $this->grade_model->get();
        $data['gradeList'] = $gradeList;
        $examList = $this->examschedule_model->getExamByClassandSection($student['class_id'], $student['section_id']);
        $data['examSchedule'] = array();
        if (!empty($examList)) {
            $new_array = array();
            foreach ($examList as $ex_key => $ex_value) {
                $array = array();
                $x = array();
                $exam_id = $ex_value['exam_id'];
                $exam_subjects = $this->examschedule_model->getresultByStudentandExam($exam_id, $student['id']);
                foreach ($exam_subjects as $key => $value) {
                    $exam_array = array();
                    $exam_array['exam_schedule_id'] = $value['exam_schedule_id'];
                    $exam_array['exam_id'] = $value['exam_id'];
                    $exam_array['full_marks'] = $value['full_marks'];
                    $exam_array['passing_marks'] = $value['passing_marks'];
                    $exam_array['exam_name'] = $value['name'];
                    $exam_array['exam_type'] = $value['type'];
                    $exam_array['attendence'] = $value['attendence'];
                    $exam_array['get_marks'] = $value['get_marks'];
                    $x[] = $exam_array;
                }
                $array['exam_name'] = $ex_value['name'];
                $array['exam_result'] = $x;
                $new_array[] = $array;
            }
            $data['examSchedule'] = $new_array;
        }
        $data['student'] = $student;
        $this->load->view('layout/parent/header', $data);
        $this->load->view('parent/student/getexams', $data);
        $this->load->view('layout/parent/footer', $data);
    }

    function getexamresult() {
        $student_id = $this->uri->segment('4');
        $exam_id = $this->uri->segment('5');
        $student = $this->student_model->get($student_id);
        $class_id = $student['class_id'];
        $section_id = $student['section_id'];
        $data['title'] = 'Exam Result';
        $data['student'] = $student;
        $new_array = array();
        $array = array();
        $x = array();
        $exam_detail_array = $this->exam_model->get($exam_id);
        $exam_subjects = $this->examschedule_model->getresultByStudentandExam($exam_id, $student_id);
        foreach ($exam_subjects as $key => $value) {
            $exam_array = array();
            $exam_array['exam_schedule_id'] = $value['exam_schedule_id'];
            $exam_array['exam_id'] = $value['exam_id'];
            $exam_array['full_marks'] = $value['full_marks'];
            $exam_array['passing_marks'] = $value['passing_marks'];
            $exam_array['exam_name'] = $value['name'];
            $exam_array['exam_type'] = $value['type'];
            $exam_array['attendence'] = $value['attendence'];
            $exam_array['get_marks'] = $value['get_marks'];
            $x[] = $exam_array;
        }
        $array['exam_name'] = $exam_detail_array['name'];
        $array['exam_result'] = $x;
        $new_array[] = $array;
        $data['examSchedule'] = $new_array;
        $this->load->view('layout/parent/header', $data);
        $this->load->view('parent/student/examresult', $data);
        $this->load->view('layout/parent/footer', $data);
    }

    function getexamtimetable() {
        $data['title'] = 'Student Details';
        $class_id = $this->uri->segment('4');
        $section_id = $this->uri->segment('5');
        $exam_id = $this->uri->segment('6');
        $examSchedule = $this->examschedule_model->getDetailbyClsandSection($class_id, $section_id, $exam_id);
        $data['examSchedule'] = $examSchedule;
        $exam_detail_array = $this->exam_model->get($exam_id);
        $data['exam_name'] = $exam_detail_array['name'];
        $this->load->view('layout/parent/header', $data);
        $this->load->view('parent/student/examtimetable', $data);
        $this->load->view('layout/parent/footer', $data);
    }

}

?>