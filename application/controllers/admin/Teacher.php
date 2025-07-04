<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Teacher extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->load->helper('file');
        $this->load->library('mailsmsconf');
        $this->load->model('common_model');
        $this->lang->load('message', 'english');
        $this->role;
    }

    function index() {
        $data["school"]=$this->Common_model->grab_school();
        $this->session->set_userdata('top_menu', 'Teacher');
        $this->session->set_userdata('sub_menu', 'teacher/index');
        $data['title'] = 'Add Teacher';
        $data["locations"]=$this->common_model->grab_location();

        $teacher_result = $this->teacher_model->get($id = null,$location=null,0);

        $data['teacherlist'] = $teacher_result;
        $genderList = $this->customlib->getGender();
        $data['genderList'] = $genderList;
        $vehroute_result = $this->vehroute_model->get();
        $data['vehroutelist'] = $vehroute_result;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/teacher/teacherList', $data);
        $this->load->view('layout/footer', $data);
    }
    function tearcher_report()
    {
        $data["school"]=$this->Common_model->grab_school();
        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'teacher/tearcher_report');
        $data['title'] = 'Add Teacher';
        $data["locations"]=$this->common_model->grab_location();

        $teacher_result = $this->teacher_model->get();

        $data['teacherlist'] = $teacher_result;
        
        $data['total']=$this->db->query("SELECT count(gender) as teatotal FROM teachers where resign=0")->row();
        $data['male']=$this->db->query("SELECT count(gender) as total FROM teachers WHERE gender='Male' and resign=0")->row();
        $data['female']=$this->db->query("SELECT count(gender) as total FROM teachers WHERE gender='Female' and resign=0")->row();
        
        $genderList = $this->customlib->getGender();
        $data['genderList'] = $genderList;
        $vehroute_result = $this->vehroute_model->get();
        $data['vehroutelist'] = $vehroute_result;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/teacher/teacherReport', $data);
        $this->load->view('layout/footer', $data);
    }
    function getSubjctByClassandSection() {
        $class_id = $this->input->post('class_id');
        $section_id = $this->input->post('section_id');
        $data = $this->teachersubject_model->getSubjectByClsandSection($class_id, $section_id);
        echo json_encode($data);
    }
    
     function teachercardprint($id)
    {
        $data["teacher"] = $this->teacher_model->getTeacher($id);
        $this->load->view('admin/teacher/teachercardprint', $data);
    }
    

    function assignteacher() {

        $data["school"]=$this->Common_model->grab_school();

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
                $school = $this->input->post('school');
                $dt = $this->classsection_model->getDetailbyClassSection($class_id, $section_id,$school);

                $s['class_section_id'] = $dt['id'];
                $s['teacher_id'] = $this->input->post('teacher_id_' . $value);
                $s['subject_id'] = $this->input->post('subject_id_' . $value);
                $s['school'] = $this->input->post('school');
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
        $this->form_validation->set_rules('school', 'School', 'trim|required|xss_clean');
        if ($this->form_validation->run()) {
            $class_id = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');
            $school = $this->input->post('school');

            $dt = $this->classsection_model->getDetailbyClassSection($class_id, $section_id);
            $data = $this->teachersubject_model->getDetailByclassAndSection($dt['id'],$school);
            echo json_encode(array('st' => 0, 'msg' => $data));
        } else {
            $data = array(
                'class_id' => form_error('class_id'),
                'section_id' => form_error('section_id'),
                'school' => form_error('school')
               
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
        $data['title'] = 'Teacher List';
        $this->teacher_model->remove($id);
        redirect('admin/teacher/index');
    }

    function create() {
        $data['title'] = 'Add teacher';
        $genderList = $this->customlib->getGender();
        $data['genderList'] = $genderList;
        $this->form_validation->set_rules('name', 'Teacher', 'trim|required|xss_clean');
        $vehroute_result = $this->vehroute_model->get();
        $data['vehroutelist'] = $vehroute_result;
        /*$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required|xss_clean');
        $this->form_validation->set_rules('dob', 'Date of Birth', 'trim|required|xss_clean');
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required|xss_clean');
        $this->form_validation->set_rules('file', 'Image', 'callback_handle_upload');*/
        if ($this->form_validation->run() == FALSE) {
            $teacher_result = $this->teacher_model->get();
            $data['teacherlist'] = $teacher_result;
            $genderList = $this->customlib->getGender();
            $data['genderList'] = $genderList;
            $data["locations"]=$this->common_model->grab_location();
            $data["school"]=$this->Common_model->grab_school();
            $this->load->view('layout/header', $data);
            $this->load->view('admin/teacher/teacherCreate', $data);
            $this->load->view('layout/footer', $data);
        } else {
                $data = array(
                'name' => $this->input->post('name'),
                'nrcno' => $this->input->post('nrcno'),
                'resign' => $this->input->post('resign'),
                'raceandreligion' => $this->input->post('raceandreligion'),
                'spouseName' => $this->input->post('spouseName'),
                'spouseOccupation' => $this->input->post('spouseOccupation'),
                'fathername' => $this->input->post('fathername'),
                'mothername' => $this->input->post('mothername'),
                'parentOccupation' => $this->input->post('parentOccupation'),
                'gender' => $this->input->post('gender'),
                'position' => $this->input->post('position'),
                'education' => $this->input->post('education'),
                'primarySubject' => $this->input->post('primarySubject'),
                'entryDate' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('entryDate'))),
                'transferedSchool' => $this->input->post('transferedSchool'),
                'salary' => $this->input->post('salary'),
                'currency' => $this->input->post('currency'),
                'startDateofTeaching' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('startDateofTeaching'))),
                'currentsubject' => $this->input->post('currentsubject'),
                'responsibility' => $this->input->post('responsibility'),
                'attendedclass' => $this->input->post('attendedclass'),
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password'),
                'sex' => $this->input->post('gender'),
                'dob' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('dob'))),
                'address' => $this->input->post('address'),
                'phone' => $this->input->post('phone'),
                'location' => $this->input->post('location'),
                'vehroute_id' => $this->input->post('vehroute_id'),
                'image' => 'uploads/student_images/no_image.png'
            );
            $insert_id = $this->teacher_model->add($data);
            
            if($this->input->post("sub_admin")==1)
            {
                 $role="teacher_head";
            }
            else
            {
                $role="teacher";
            }
            
           
            $user_password = $this->role->get_random_password($chars_min = 6, $chars_max = 6, $use_upper_case = false, $include_numbers = true, $include_special_chars = false);
            $data_student_login = array(
                'username' => $this->teacher_login_prefix . $insert_id,
                'password' => $user_password,
                'user_id' => $insert_id,
                'role' => $role
            );
          
            $this->user_model->add($data_student_login);
           
            if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
                $fileInfo = pathinfo($_FILES["file"]["name"]);
                $img_name = $insert_id . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/teacher_images/" . $img_name);
                $data_img = array('id' => $insert_id, 'image' => 'uploads/teacher_images/' . $img_name);
                $this->teacher_model->add($data_img);
            }
            $teacher_login_detail = array('id' => $insert_id, 'credential_for' => 'teacher', 'username' => $this->teacher_login_prefix . $insert_id, 'password' => $user_password, 'contact_no' => $this->input->post('phone'));

            $this->mailsmsconf->mailsms('login_credential', $teacher_login_detail);

            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Teacher added successfully</div>');
            redirect('admin/Teacher/index');
        }
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

    function edit($id) {
        $data['title'] = 'Edit Teacher';
        $data['id'] = $id;
        $genderList = $this->customlib->getGender();
        $data['genderList'] = $genderList;
        $teacher = $this->teacher_model->get($id);
        $data['teacher'] = $teacher;
        $data["locations"]=$this->common_model->grab_location();

       

        $this->form_validation->set_rules('name', 'Teacher', 'trim|required|xss_clean');
        /*$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required|xss_clean');
        $this->form_validation->set_rules('dob', 'Date of Birth', 'trim|required|xss_clean');
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required|xss_clean');
        $this->form_validation->set_rules('file', 'Image', 'callback_handle_upload');*/
        if ($this->form_validation->run() == FALSE) {
            $teacher_result = $this->teacher_model->get();
            $data['teacherlist'] = $teacher_result;
            $this->load->view('layout/header', $data);
            $this->load->view('admin/teacher/teacherEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {
			
            $data = array(
                'id' => $id,
               'name' => $this->input->post('name'),
                'nrcno' => $this->input->post('nrcno'),
                'resign' => $this->input->post('resign'),
				'email' => $this->input->post('email'),
                'password' => $this->input->post('password'),
                'raceandreligion' => $this->input->post('raceandreligion'),
                'spouseName' => $this->input->post('spouseName'),
                'spouseOccupation' => $this->input->post('spouseOccupation'),
                'fathername' => $this->input->post('fathername'),
                'mothername' => $this->input->post('mothername'),
                'parentOccupation' => $this->input->post('parentOccupation'),
                'gender' => $this->input->post('gender'),
                'position' => $this->input->post('position'),
                'education' => $this->input->post('education'),
                'primarySubject' => $this->input->post('primarySubject'),
                'entryDate' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('entryDate'))),
                'transferedSchool' => $this->input->post('transferedSchool'),
                'startDateofTeaching' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('startDateofTeaching'))),
                'salary' => $this->input->post('salary'),
                'currency' => $this->input->post('currency'),
                'currentsubject' => $this->input->post('currentsubject'),
                'responsibility' => $this->input->post('responsibility'),
                'attendedclass' => $this->input->post('attendedclass'),
                'sex' => $this->input->post('gender'),
                'dob' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('dob'))),
                'address' => $this->input->post('address'),
                'phone' => $this->input->post('phone'),
                'location' => $this->input->post('location'),
                'image' => 'uploads/student_images/no_image.png'
            );
            $insert_id = $this->teacher_model->add($data);
            if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
                $fileInfo = pathinfo($_FILES["file"]["name"]);
                $img_name = $id . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/teacher_images/" . $img_name);
                $data_img = array('id' => $id, 'image' => 'uploads/teacher_images/' . $img_name);
                $this->teacher_model->add($data_img);
            }
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Teacher updated successfully</div>');
          $teacher_result = $this->teacher_model->get();
            $data['teacherlist'] = $teacher_result;
            $data["locations"]=$this->common_model->grab_location();

            $this->load->view('layout/header', $data);
            $this->load->view('admin/teacher/teacherEdit', $data);
            $this->load->view('layout/footer', $data);
        }
    }

    function getlogindetail() {
        $teacher_id = $this->input->post('teacher_id');
        $examSchedule = $this->user_model->getTeacherLoginDetails($teacher_id);
        echo json_encode($examSchedule);
    }


    function search(){

        $location=$this->input->post("location");
        $resign=$this->input->post("resign");
        $data["school"]=$this->Common_model->grab_school();
         $id=null;
        $data['teacherlist']= $teacher = $this->teacher_model->get($id,$location,$resign);
        $this->load->view('layout/header', $data);
        $this->load->view('admin/teacher/teacherList', $data);
        $this->load->view('layout/footer', $data);
    }

}

?>