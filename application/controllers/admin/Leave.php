<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Leave extends Admin_Controller {

    function __construct() {
        parent::__construct();
        error_reporting(1);
        $this->load->helper('file');
        $this->load->library('mailsmsconf');
        $this->load->model('common_model');
        $this->load->model("Leave_model");
        $this->lang->load('message', 'english');
        $this->role;
    }

    function index() {
        $this->session->set_userdata('top_menu', 'Attendance');
        $this->session->set_userdata('sub_menu', 'teacher/index');
        $data['title'] = 'Add Teacher';
    $data["locations"]=$this->common_model->grab_location();

        $teacher_result = $this->teacher_model->get();

        $data['teacherlist'] = $teacher_result;
        $genderList = $this->customlib->getGender();
        $data['genderList'] = $genderList;
        $vehroute_result = $this->vehroute_model->get();
        $data['vehroutelist'] = $vehroute_result;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/teacher/teacherList', $data);
        $this->load->view('layout/footer', $data);
    }
    
    
    function leavereport() {
        $this->session->set_userdata('top_menu', 'Attendance');
        $this->session->set_userdata('sub_menu', 'Leave/leavereport');
        // $data['title'] = 'Add Fees Type';
        
                $data['monthlist'] = $this->customlib->getMonthDropdown();
                $data['month_selected'] = date("F");
                
    $this->form_validation->set_rules('month', 'Month', 'trim|required|xss_clean');
            if ($this->form_validation->run() == FALSE) {
                $data['resultlist'] = $this->db->query("SELECT * FROM tbl_leave");
            }
            else
            {
                $month=$this->input->post("month");
                $data['resultlist'] = $this->db->query("SELECT * FROM tbl_leave WHERE MONTHNAME(leave_date)='$month'");
                $data['month_selected'] = $month;
                // echo $data['resultlist']->num_rows(); exit;
            }
            
                $this->load->view('layout/header', $data);
                $this->load->view('admin/Leave/leaveList', $data);
                $this->load->view('layout/footer', $data); 
        }

    function getSubjctByClassandSection() {
        $class_id = $this->input->post('class_id');
        $section_id = $this->input->post('section_id');
        $data = $this->teachersubject_model->getSubjectByClsandSection($class_id, $section_id);
        echo json_encode($data);
    }

    function assignteacher() {
        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'teacher/assignTeacher');
        $data['title'] = 'Assign Teacher with Class and Subject wise';
        $teacher = $this->teacher_model->get();
        $data['teacherlist'] = $teacher;
        $subject = $this->subject_model->get();
        $data['subjectlist'] = $subject;
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/teacher/assignTeacher', $data);
        $this->load->view('layout/footer', $data);
        if ($this->input->server('REQUEST_METHOD') == "POST") {
            $loop = $this->input->post('i');
            $array = array();
            foreach ($loop as $key => $value) {
                $s = array();
                $s['session_id'] = $this->setting_model->getCurrentSession();
                $class_id = $this->input->post('class_id');
                $section_id = $this->input->post('section_id');
                $dt = $this->classsection_model->getDetailbyClassSection($class_id, $section_id);

                $s['class_section_id'] = $dt['id'];
                $s['teacher_id'] = $this->input->post('teacher_id_' . $value);
                $s['subject_id'] = $this->input->post('subject_id_' . $value);
                $row_id = $this->input->post('row_id_' . $value);
                if ($row_id == 0) {
                    $insert_id = $this->teachersubject_model->add($s);
                    $array[] = $insert_id;
                } else {
                    $s['id'] = $row_id;
                    $array[] = $row_id;
                    $this->teachersubject_model->add($s);
                }
            }

            $ids = $array;
            $class_section_id = $dt['id'];
            $this->teachersubject_model->deleteBatch($ids, $class_section_id);
            $this->session->set_flashdata('msg', '<div class="alert alert-success">Record updated successfully</div>');
            redirect('admin/teacher/assignteacher');
        }
    }

    public function getSubjectTeachers() {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
        if ($this->form_validation->run()) {
            $class_id = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');
            $dt = $this->classsection_model->getDetailbyClassSection($class_id, $section_id);
            $data = $this->teachersubject_model->getDetailByclassAndSection($dt['id']);
            echo json_encode(array('st' => 0, 'msg' => $data));
        } else {
            $data = array(
                'class_id' => form_error('class_id'),
                'section_id' => form_error('section_id'),
            );
            echo json_encode(array('st' => 1, 'msg' => $data));
        }
    }

    function view($id) {
        $data['title'] = 'Teacher List';
        $teacher = $this->teacher_model->get($id);
        $teachersubject = $this->teachersubject_model->getTeacherClassSubjects($id);
        $data['teacher'] = $teacher;
        $data['teachersubject'] = $teachersubject;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/teacher/teacherShow', $data);
        $this->load->view('layout/footer', $data);
    }

    function delete($id) {
        
        $this->db->where("id",$id);
        $this->db->delete("tbl_leave");
        redirect('admin/Leave/leavereport');
    }

    function create() {
        $data['title'] = 'Add teacher';
        $genderList = $this->customlib->getGender();
        $data['teacherlists'] = $this->Common_model->grab_teacher();
        $data['teachernamelists']=$this->Common_model->grab_teachername();
        // $data['genderList'] = $genderList;
        
            $this->load->view('layout/header', $data);
            $this->load->view('admin/Leave/leaveCreate', $data);
            $this->load->view('layout/footer', $data);
    }
    
    
    function edit($id) {
       
        $data['title'] = 'Edit Teacher';
        // $data['id'] = $id;
        $genderList = $this->customlib->getGender();
        // $data['genderList'] = $genderList;
        // $teacher = $this->teacher_model->get($id);
        // $data['teacher'] = $teacher;
        $data["row"]=$this->db->get_where("tbl_leave",array("id"=>$id))->row();
        $data['teacherlists'] = $this->Common_model->grab_teacher();
        $data['teachernamelists']=$this->Common_model->grab_teachername();
        // $data['genderList'] = $genderList;
        
            $this->load->view('layout/header', $data);
            $this->load->view('admin/Leave/leaveEdit', $data);
            $this->load->view('layout/footer', $data);

    }
    
    
      function insert_leave()
        {
            $this->load->model('common_model');
            $data['teacherlists'] = $this->Common_model->grab_teacher();
            $data['teachernamelists']=$this->Common_model->grab_teachername();
            $check=$this->db->get_where("teacher_attendences",array('teacher_id'=>$tea_id,'created_at'=>date("Y-m-d")));
            
            $teacher_id=$this->input->post("teacher");
            $leavetype=$this->input->post("leavetype");
            $leavedate=date("Y-m-d",strtotime($this->input->post("leave_date")));
            $leavefrom=date("Y-m-d",strtotime($this->input->post("leavefrom")));
            $leaveto=date("Y-m-d",strtotime($this->input->post("leaveto"))); 
            $total_leave=$this->input->post("leavetotal");
            $leave_reason=$this->input->post("leave_reason");
            $dtteacher=$this->input->post("dtransfer");
            $adbysalary=$this->input->post("adbysalary");
            $remark=$this->input->post("remark");
            $recbyadmin=$this->input->post("recbyadmin");
            $hrleavebalance=$this->input->post("hrleavebalance");
            $hrbysalary=$this->input->post("hrbysalary");
            $approve_status=$this->input->post("approve_status");
            
            // $teacher_sign=$this->input->post("apply_by");

            // $dtteacher_sign=$this->input->post("dtsign");

            // $admin_sign=$this->input->post("admin_sign");

            // $hrmanager_sign=$this->input->post("hrmanager_sign");

            // $manager_sign=$this->input->post("manager_sign");
            
            $teacher_sign="teacher";

            $dtteacher_sign="teacher";

            $admin_sign="admin_sign";

            $hrmanager_sign="hrmanager_sign";

            $manager_sign="manager_sign";
            
            $data=array("teacher"=>$teacher_id,
                        "leave_type"=>$leavetype,
                        "leave_date"=>$leavedate,
                        "leave_from"=>$leavefrom,
                        "leave_to"=>$leaveto,
                        "total_leave"=>$total_leave,
                        "leave_reason"=>$leave_reason,
                        "dtteacher"=>$dtteacher,
                        "adbysalary"=>$adbysalary,
                        "remark"=>$remark,
                        "recbyadmin"=>$recbyadmin,
                        "hrleavebalance"=>$hrleavebalance,
                        "hrbysalary"=>$hrbysalary,
                        "approve_status"=>$approve_status,
            );
            
            $qry=$this->db->insert("tbl_leave",$data);
            if($qry)
            {
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Leave added successfully</div>');
                redirect('admin/Leave/create');
            }
            
            else
            {
                $error = $this->db->error();
                echo $error["message"];     
                
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Failed to Save</div>');
                redirect('admin/Leave/create');
            }

        }
        
        
        function edit_leave()
        {
            $this->load->model('common_model');
            $data['teacherlists'] = $this->Common_model->grab_teacher();
            $data['teachernamelists']=$this->Common_model->grab_teachername();
            $check=$this->db->get_where("teacher_attendences",array('teacher_id'=>$tea_id,'created_at'=>date("Y-m-d")));
            $id=$this->input->post("id");
            $teacher_id=$this->input->post("teacher");
            $leavetype=$this->input->post("leavetype");
            $leavedate=date("Y-m-d",strtotime($this->input->post("leave_date")));
            $leavefrom=date("Y-m-d",strtotime($this->input->post("leavefrom")));
            $leaveto=date("Y-m-d",strtotime($this->input->post("leaveto"))); 
            $total_leave=$this->input->post("leavetotal");
            $leave_reason=$this->input->post("leave_reason");
            $dtteacher=$this->input->post("dtransfer");
            $adbysalary=$this->input->post("adbysalary");
            $remark=$this->input->post("remark");
            $recbyadmin=$this->input->post("recbyadmin");
            $hrleavebalance=$this->input->post("hrleavebalance");
            $hrbysalary=$this->input->post("hrbysalary");
            $approve_status=$this->input->post("approve_status");
            
            // $teacher_sign=$this->input->post("apply_by");

            // $dtteacher_sign=$this->input->post("dtsign");

            // $admin_sign=$this->input->post("admin_sign");

            // $hrmanager_sign=$this->input->post("hrmanager_sign");

            // $manager_sign=$this->input->post("manager_sign");
            
            $teacher_sign="teacher";

            $dtteacher_sign="teacher";

            $admin_sign="admin_sign";

            $hrmanager_sign="hrmanager_sign";

            $manager_sign="manager_sign";
            
            $data=array("teacher"=>$teacher_id,
                        "leave_type"=>$leavetype,
                        "leave_date"=>$leavedate,
                        "leave_from"=>$leavefrom,
                        "leave_to"=>$leaveto,
                        "total_leave"=>$total_leave,
                        "leave_reason"=>$leave_reason,
                        "dtteacher"=>$dtteacher,
                        "adbysalary"=>$adbysalary,
                        "remark"=>$remark,
                        "recbyadmin"=>$recbyadmin,
                        "hrleavebalance"=>$hrleavebalance,
                        "hrbysalary"=>$hrbysalary,
                        "approve_status"=>$approve_status,
            );
            $this->db->where("id",$id);
            $qry=$this->db->update("tbl_leave",$data);
            if($qry)
            {
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Leave Updated successfully</div>');
                redirect('admin/Leave/leavereport');
            }
            
            else
            {
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Failed to Save</div>');
                redirect('admin/Leave/leavereport');
            }

            $error = $this->db->error();
                echo $error["message"];      
        }


    function view_detail()
    {
        $id=$this->uri->segment(4);
        // $this->load->model("Leave_model");
        // $data["row"]=$this->Leave_model->get($id); 
        // echo $id; exit;
        $data["row"]=$this->db->query("SELECT tbl_leave.*,teachers.name as name, teachers.position as position,teachers.educationDepartment as dept FROM tbl_leave JOIN teachers ON tbl_leave.teacher=teachers.id WHERE tbl_leave.id='$id'")->row();
        $data["dtrow"]=$this->db->query("SELECT teachers.name as dtname, teachers.position as dtposition,teachers.educationDepartment as dept FROM tbl_leave LEFT JOIN teachers ON tbl_leave.dtteacher=teachers.id WHERE tbl_leave.id='$id'")->row();
                $error = $this->db->error();
                echo $error["message"];                
        $data["content"]="leaveDetail";
         $this->load->view('layout/header', $data);
        $this->load->view("admin/Leave/leaveDetail",$data);
        $this->load->view('layout/footer', $data);
        
    }

    function handle_upload() {
        if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
            $allowedExts = array('jpg', 'jpeg', 'png');
            $temp = explode(".", $_FILES["file"]["name"]);
            $extension = end($temp);
            if ($_FILES["file"]["error"] > 0) {
                $error .= "Error opening the file<br />";
            }
            if ($_FILES["file"]["type"] != 'image/gif' &&
                    $_FILES["file"]["type"] != 'image/jpeg' &&
                    $_FILES["file"]["type"] != 'image/png') {

                $this->form_validation->set_message('handle_upload', 'File type not allowed');
                return false;
            }
            if (!in_array($extension, $allowedExts)) {

                $this->form_validation->set_message('handle_upload', 'Extension not allowed');
                return false;
            }
            if ($_FILES["file"]["size"] > 10240000) {

                $this->form_validation->set_message('handle_upload', 'File size shoud be less than 100 kB');
                return false;
            }
            if ($error == "") {
                return true;
            }
        } else {
            return true;
        }
    }

    
    function getlogindetail() {
        $teacher_id = $this->input->post('teacher_id');
        $examSchedule = $this->user_model->getTeacherLoginDetails($teacher_id);
        echo json_encode($examSchedule);
    }


    function search(){

        $location=$this->input->post("location");
         $data["locations"]=$this->common_model->grab_location();
         $id=null;
        $data['teacherlist']= $teacher = $this->teacher_model->get($id,$location);
        $this->load->view('layout/header', $data);
        $this->load->view('admin/teacher/teacherList', $data);
        $this->load->view('layout/footer', $data);
    }

}

?>