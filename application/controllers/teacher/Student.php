<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Student extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('smsgateway');
        $this->load->library('mailsmsconf');
        $this->load->helper('file');
        $this->lang->load('message', 'english');
        $this->role;
        $this->load->model("Studentfee_model");
        $this->load->model("Common_model");

    }

    function index() {
        $data['title'] = 'Student List';
        $student_result = $this->student_model->get();
        $data['studentlist'] = $student_result;
        $this->load->view('layout/teacher/header', $data);
        $this->load->view('teacher/student/studentList', $data);
        $this->load->view('layout/teacher/footer', $data);
    }

    function studentreport() {
        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'teacher/student/studentreport');
        $data['title'] = 'student fee';
        $data['title'] = 'student fee';
        $genderList = $this->customlib->getGender();
        $data['genderList'] = $genderList;
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $category = $this->category_model->get();
        $data['categorylist'] = $category;
        if ($this->input->server('REQUEST_METHOD') == "GET") {
            $this->load->view('layout/teacher/header', $data);
            $this->load->view('teacher/student/studentReport', $data);
            $this->load->view('layout/teacher/footer', $data);
        } else {
            $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('layout/teacher/header', $data);
                $this->load->view('teacher/student/studentReport', $data);
                $this->load->view('layout/teacher/footer', $data);
            } else {
                $class = $this->input->post('class_id');
                $section = $this->input->post('section_id');
                $category_id = $this->input->post('category_id');
                $gender = $this->input->post('gender');
                $search = $this->input->post('search');
                if (isset($search)) {
                    if ($search == 'search_filter') {
                        $resultlist = $this->student_model->searchByClassSectionCategoryGenderRte($class, $section, $category_id, $gender);
                        $data['resultlist'] = $resultlist;
                    }
                    $data['class_id'] = $class;
                    $data['section_id'] = $section;
                    $data['category_id'] = $category_id;
                    $data['gender'] = $gender;
                    $this->load->view('layout/teacher/header', $data);
                    $this->load->view('teacher/student/studentReport', $data);
                    $this->load->view('layout/teacher/footer', $data);
                }
            }
        }
    }

    public function download($student_id, $doc) {
        $this->load->helper('download');
        $filepath = "./uploads/student_documents/$student_id/" . $this->uri->segment(4);
        $data = file_get_contents($filepath);
        $name = $this->uri->segment(6);
        force_download($name, $data);
    }


    function cardprint($id)
    {
        $data["student"] = $this->student_model->get($id);
        $this->load->view('teacher/student/cardprint', $data);
    }
    
     function gurdiancardprint($id)
    {
        $data["student"] = $this->student_model->get($id);
        $this->load->view('teacher/student/gurdiancardprint', $data);
    }



    function rpcards($id,$month)
    {
		$student_id=$this->uri->segment(3);
        $data["exams"]=$this->db->order_by("id","ASC")->get("exams");
		$data["rpcards"]=$this->db->query("SELECT exam_results.*,exam_schedules.* FROM exam_results JOIN exam_schedules
                            ON exam_results.exam_schedule_id=exam_schedules.id  WHERE 
                            exam_results.student_id='$id'");
							
		
		
		
		
    }

    function view($id) {
        $data['title'] = 'Student Details';
        $student = $this->student_model->get($id);
        $gradeList = $this->grade_model->get();
        $student_session_id = $student['student_session_id'];
      //  $student_due_fee = $this->studentfeemaster_model->getStudentFees($student_session_id);
      //  $student_discount_fee = $this->feediscount_model->getStudentFeesDiscount($student_session_id);
     //   $data['student_discount_fee'] = $student_discount_fee;
     //   $data['student_due_fee'] = $student_due_fee;

                $prefs['template'] = '
                {table_open}<table cellpadding="10" cellspacing="2">{/table_open}

                {heading_row_start}<tr>{/heading_row_start}

                {heading_previous_cell}<th class="prev_sign"><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
                {heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
                {heading_next_cell}<th class="next_sign"><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}

                {heading_row_end}</tr>{/heading_row_end}

                //Deciding where to week row start
                {week_row_start}<tr class="week_name" >{/week_row_start}
                //Deciding  week day cell and  week days
                {week_day_cell}<td >{week_day}</td>{/week_day_cell}
                //week row end
                {week_row_end}</tr>{/week_row_end}

                {cal_row_start}<tr>{/cal_row_start}
                {cal_cell_start}<td>{/cal_cell_start}

                {cal_cell_content}<a href="{content}">{day}</a>{/cal_cell_content}
                {cal_cell_content_today}<div class="highlight"><a href="{content}">{day}</a></div>{/cal_cell_content_today}

                {cal_cell_no_content}{day}{/cal_cell_no_content}
                {cal_cell_no_content_today}<div class="highlight">{day}</div>{/cal_cell_no_content_today}

                {cal_cell_blank}&nbsp;{/cal_cell_blank}

                {cal_cell_end}</td>{/cal_cell_end}
                {cal_row_end}</tr>{/cal_row_end}

                {table_close}</table>{/table_close}
                ';


        $prefs['day_type'] = 'short';
        $prefs['show_next_prev'] = true;
        $prefs['next_prev_url'] = base_url().'teacher/student/view/42';
        
        $this->load->library('calendar', $prefs);
       // $data["attendances"]=$this->db->query("SELECT created_at FROM student_attendences WHERE student_id='$id' GROUP BY created_at ORDER BY created_at ASC");
	   	$data["exams"]=$this->db->order_by("id","ASC")->get("exams");
		
        $feeresultlist = $this->Studentfee_model->getEachstudentFee($id);
        $data['feeresultlist'] =$feeresultlist;
       
        $examList = $this->examschedule_model->getExamByClassandSection($student['class_id'], $student['section_id']);

        $data['examSchedule'] = array();
        if (!empty($examList)) {
            $new_array = array();
            foreach ($examList as $ex_key => $ex_value) {
                $array = array();
                $x = array();
                $exam_id = $ex_value['exam_id'];
                $student['id'];
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
        $student_doc = $this->student_model->getstudentdoc($id);
        $data['student_doc'] = $student_doc;
        $data['student_doc_id'] = $id;
        $category_list = $this->category_model->get();
        $data['category_list'] = $category_list;
        $data['gradeList'] = $gradeList;
        $data['student'] = $student;
        $this->load->view('layout/teacher/header', $data);
        $this->load->view('teacher/student/studentShow', $data);
        $this->load->view('layout/teacher/footer', $data);
    }

    function exportformat() {
        $array = array(
            array("admission_no", "roll_no",
                "admission_date(dd-mm-yyyy)", "firstname",
                "lastname", "mobileno",
                "email", "state", "city", "pincode",
                "religion", "dob(dd-mm-yyyy)",
                "current_address", "permanent_address",
                "bank_account_no",
                "bank_name", "ifsc_code", "guardian_name",
                "guardian_relation", "guardian_phone",
                "guardian_address"),
        );
        $this->load->helper('csv');
        echo array_to_csv($array, 'import_student_sample_file.csv');
    }

    function delete($id) {
        $this->student_model->remove($id);
        $this->session->set_flashdata('msg', '<i class="fa fa-check-square-o" aria-hidden="true"></i> Record Deleted Successfully');
        redirect('teacher/student/search');
    }

    function doc_delete($id, $student_id) {
        $this->student_model->doc_delete($id);
        $this->session->set_flashdata('msg', '<i class="fa fa-check-square-o" aria-hidden="true"></i> Document Deleted Successfully');
        redirect('teacher/student/view/' . $student_id);
    }

    function create() {

        $this->session->set_userdata('top_menu', 'Student Information');
        $this->session->set_userdata('sub_menu', 'teacher/student/create');
        $genderList = $this->customlib->getGender();
        $data['genderList'] = $genderList;
        $data["school"]=$this->Common_model->grab_school();

        $data['title'] = 'Add Student';
        $data['title_list'] = 'Recently Added Student';
        $session = $this->setting_model->getCurrentSession();
        $student_result = $this->student_model->getRecentRecord();
        $data['studentlist'] = $student_result;
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $category = $this->category_model->get();
        $data['categorylist'] = $category;
        $vehroute_result = $this->vehroute_model->get();
        $data['vehroutelist'] = $vehroute_result;
        $this->form_validation->set_rules('firstname', 'First Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required|xss_clean');
        $this->form_validation->set_rules('dob', 'Date of Birth', 'trim|required|xss_clean');
        $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
        $this->form_validation->set_rules('guardian_name', 'Guardian Name', 'trim|required|xss_clean');

        $this->form_validation->set_rules('guardian_phone', 'Guardian Phone', 'trim|required|xss_clean');
        $this->form_validation->set_rules('admission_no', 'Admission No', 'trim|required|xss_clean|is_unique[students.admission_no]');
        $this->form_validation->set_rules('file', 'Image', 'callback_handle_upload');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/teacher/header', $data);
            $this->load->view('teacher/student/studentCreate', $data);
            $this->load->view('layout/teacher/footer', $data);
        } else {
            $class_id = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');

            $fees_discount = $this->input->post('fees_discount');
            $vehroute_id = $this->input->post('vehroute_id');
            $data = array(
                'admission_no' => $this->input->post('admission_no'),
                'roll_no' => $this->input->post('roll_no'),
                'admission_date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('admission_date'))),
                'firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname'),
                'mobileno' => $this->input->post('mobileno'),
                'email' => $this->input->post('email'),
                'state' => $this->input->post('state'),
                'city' => $this->input->post('city'),
                'guardian_is' => $this->input->post('guardian_is'),
                'pincode' => $this->input->post('pincode'),
                'religion' => $this->input->post('religion'),
                'previous_school' => $this->input->post('previous_school'),
                'dob' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('dob'))),
                'current_address' => $this->input->post('current_address'),
                'permanent_address' => $this->input->post('permanent_address'),
                'image' => 'uploads/student_images/no_image.png',
                'category_id' => $this->input->post('category_id'),
                'adhar_no' => $this->input->post('adhar_no'),
                'samagra_id' => $this->input->post('samagra_id'),
                'bank_account_no' => $this->input->post('bank_account_no'),
                'bank_name' => $this->input->post('bank_name'),
                'ifsc_code' => $this->input->post('ifsc_code'),
                'father_name' => $this->input->post('father_name'),
                'father_phone' => $this->input->post('father_phone'),
                'father_occupation' => $this->input->post('father_occupation'),
                'mother_name' => $this->input->post('mother_name'),
                'mother_phone' => $this->input->post('mother_phone'),
                'mother_occupation' => $this->input->post('mother_occupation'),
                'guardian_occupation' => $this->input->post('guardian_occupation'),
                'guardian_email' => $this->input->post('guardian_email'),
                'gender' => $this->input->post('gender'),
                'guardian_name' => $this->input->post('guardian_name'),
                'guardian_relation' => $this->input->post('guardian_relation'),
                'guardian_phone' => $this->input->post('guardian_phone'),
                'guardian_address' => $this->input->post('guardian_address'),
                'resign' => $this->input->post('resign'),
                'school' => $this->input->post('school')

            );
            $insert_id = $this->student_model->add($data);
            $data_new = array(
                'student_id' => $insert_id,
                'class_id' => $class_id,
                'section_id' => $section_id,
                'session_id' => $session,
                'vehroute_id' => $vehroute_id,
                'fees_discount' => $fees_discount
            );
            $this->student_model->add_student_session($data_new);
            $user_password = $this->role->get_random_password($chars_min = 6, $chars_max = 6, $use_upper_case = false, $include_numbers = true, $include_special_chars = false);
            $sibling_id = $this->input->post('sibling_id');
            $data_student_login = array(
                'username' => $this->student_login_prefix . $insert_id,
                'password' => $user_password,
                'user_id' => $insert_id,
                'role' => 'student'
            );
            $this->user_model->add($data_student_login);
            if (isset($sibling_id)) {
                $countsib = 0;
                $up_record = 0;
                $record_value = "";
                $findusers = $this->user_model->read_user();
                $find = $sibling_id;
                foreach ($findusers as $key => $value) {
                    if ($value->childs != "") {
                        $childs = explode(",", $value->childs);
                        foreach ($childs as $k_child => $v_child) {
                            if ($find == $v_child) {
                                $up_record = $value->id;
                                $record_value = $value->childs;
                                $countsib = 1;
                                break;
                            }
                        }
                    }
                }
                if ($countsib != 0) {
                    $json = array($insert_id);
                    $da = array_merge((array) $record_value, (array) $json);
                    $rec = implode(",", $da);
                    $data_parent_login = array(
                        'id' => $up_record,
                        'childs' => $rec
                    );
                    $ins_id = $this->user_model->add($data_parent_login);
                } else {
                    $parent_password = $this->role->get_random_password($chars_min = 6, $chars_max = 6, $use_upper_case = false, $include_numbers = true, $include_special_chars = false);
                    $temp = $insert_id;
                    $data_parent_login = array(
                        'username' => $this->parent_login_prefix . $insert_id,
                        'password' => $parent_password,
                        'user_id' => $insert_id,
                        'role' => 'parent',
                        'childs' => $temp
                    );
                    $ins_id = $this->user_model->add($data_parent_login);
                }
            }
            if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
                $fileInfo = pathinfo($_FILES["file"]["name"]);
                $img_name = $insert_id . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/student_images/" . $img_name);
                $data_img = array('id' => $insert_id, 'image' => 'uploads/student_images/' . $img_name);
                $this->student_model->add($data_img);
            }
            if (isset($_FILES["first_doc"]) && !empty($_FILES['first_doc']['name'])) {
                $uploaddir = './uploads/student_documents/' . $insert_id . '/';
                if (!is_dir($uploaddir) && !mkdir($uploaddir)) {
                    die("Error creating folder $uploaddir");
                }
                $fileInfo = pathinfo($_FILES["first_doc"]["name"]);
                $first_title = $this->input->post('first_title');
                $img_name = $uploaddir . basename($_FILES['first_doc']['name']);
                move_uploaded_file($_FILES["first_doc"]["tmp_name"], $img_name);
                $data_img = array('student_id' => $insert_id, 'title' => $first_title, 'doc' => basename($_FILES['first_doc']['name']));
                $this->student_model->adddoc($data_img);
            }
            if (isset($_FILES["second_doc"]) && !empty($_FILES['second_doc']['name'])) {
                $uploaddir = './uploads/student_documents/' . $insert_id . '/';
                if (!is_dir($uploaddir) && !mkdir($uploaddir)) {
                    die("Error creating folder $uploaddir");
                }
                $fileInfo = pathinfo($_FILES["second_doc"]["name"]);
                $second_title = $this->input->post('second_title');
                $img_name = $uploaddir . basename($_FILES['second_doc']['name']);
                move_uploaded_file($_FILES["second_doc"]["tmp_name"], $img_name);
                $data_img = array('student_id' => $insert_id, 'title' => $second_title, 'doc' => basename($_FILES['second_doc']['name']));
                $this->student_model->adddoc($data_img);
            }
            if (isset($_FILES["third_doc"]) && !empty($_FILES['third_doc']['name'])) {
                $uploaddir = './uploads/student_documents/' . $insert_id . '/';
                if (!is_dir($uploaddir) && !mkdir($uploaddir)) {
                    die("Error creating folder $uploaddir");
                }
                $fileInfo = pathinfo($_FILES["third_doc"]["name"]);
                $third_title = $this->input->post('third_title');
                $img_name = $uploaddir . basename($_FILES['third_doc']['name']);
                move_uploaded_file($_FILES["third_doc"]["tmp_name"], $img_name);
                $data_img = array('student_id' => $insert_id, 'title' => $third_title, 'doc' => basename($_FILES['third_doc']['name']));
                $this->student_model->adddoc($data_img);
            }
            if (isset($_FILES["fourth_doc"]) && !empty($_FILES['fourth_doc']['name'])) {
                $uploaddir = './uploads/student_documents/' . $insert_id . '/';
                if (!is_dir($uploaddir) && !mkdir($uploaddir)) {
                    die("Error creating folder $uploaddir");
                }
                $fileInfo = pathinfo($_FILES["fourth_doc"]["name"]);
                $fourth_title = $this->input->post('fourth_title');
                $img_name = $uploaddir . basename($_FILES['fourth_doc']['name']);
                move_uploaded_file($_FILES["fourth_doc"]["tmp_name"], $img_name);
                $data_img = array('student_id' => $insert_id, 'title' => $fourth_title, 'doc' => basename($_FILES['fourth_doc']['name']));
                $this->student_model->adddoc($data_img);
            }
            if (isset($_FILES["fifth_doc"]) && !empty($_FILES['fifth_doc']['name'])) {
                $uploaddir = './uploads/student_documents/' . $insert_id . '/';
                if (!is_dir($uploaddir) && !mkdir($uploaddir)) {
                    die("Error creating folder $uploaddir");
                }
                $fileInfo = pathinfo($_FILES["fifth_doc"]["name"]);
                $fifth_title = $this->input->post('fifth_title');
                $img_name = $uploaddir . basename($_FILES['fifth_doc']['name']);
                move_uploaded_file($_FILES["fifth_doc"]["tmp_name"], $img_name);
                $data_img = array('student_id' => $insert_id, 'title' => $fifth_title, 'doc' => basename($_FILES['fifth_doc']['name']));
                $this->student_model->adddoc($data_img);
            }


            $sender_details = array('student_id' => $insert_id, 'contact_no' => $this->input->post('guardian_phone'), 'email' => $this->input->post('guardian_email'));

            $this->mailsmsconf->mailsms('student_admission', $sender_details);


            $student_login_detail = array('id' => $insert_id, 'credential_for' => 'student', 'username' => $this->student_login_prefix . $insert_id, 'password' => $user_password, 'contact_no' => $this->input->post('mobileno'), 'email' => $this->input->post('email'));

            $parent_login_detail = array('id' => $insert_id, 'credential_for' => 'parent', 'username' => $this->parent_login_prefix . $insert_id, 'password' => $parent_password, 'contact_no' => $this->input->post('guardian_phone'), 'email' => $this->input->post('guardian_email'));

            $this->mailsmsconf->mailsms('login_credential', $student_login_detail);
            $this->mailsmsconf->mailsms('login_credential', $parent_login_detail);

            $this->session->set_flashdata('msg', '<div class="alert alert-success">Student added Successfully</div>');
            redirect('teacher/student/create');
        }
    }

    function create_doc() {
        $student_id = $this->input->post('student_id');
        if (isset($_FILES["first_doc"]) && !empty($_FILES['first_doc']['name'])) {
            $uploaddir = './uploads/student_documents/' . $student_id . '/';
            if (!is_dir($uploaddir) && !mkdir($uploaddir)) {
                die("Error creating folder $uploaddir");
            }
            $fileInfo = pathinfo($_FILES["first_doc"]["name"]);
            $first_title = $this->input->post('first_title');
            $img_name = $uploaddir . basename($_FILES['first_doc']['name']);
            move_uploaded_file($_FILES["first_doc"]["tmp_name"], $img_name);
            $data_img = array('student_id' => $student_id, 'title' => $first_title, 'doc' => basename($_FILES['first_doc']['name']));
            $this->student_model->adddoc($data_img);
        }
        redirect('teacher/student/view/' . $student_id);
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
            if ($_FILES["file"]["size"] > 102400) {
                $this->form_validation->set_message('handle_upload', 'File size shoud be less than 100 kB');
                return false;
            }
            return true;
        } else {
            return true;
        }
    }

    function import() {
        $data['title'] = 'Import Student';
        $data['title_list'] = 'Recently Added Student';
        $session = $this->setting_model->getCurrentSession();
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $category = $this->category_model->get();
        $data['categorylist'] = $category;
        $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
        $this->form_validation->set_rules('file', 'Image', 'callback_handle_csv_upload');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/teacher/header', $data);
            $this->load->view('teacher/student/import', $data);
            $this->load->view('layout/teacher/footer', $data);
        } else {
            $class_id = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');
            $session = $this->setting_model->getCurrentSession();
            if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
                $file = $_FILES['file']['tmp_name'];
                $this->load->library('CSVReader');
                $result = $this->csvreader->parse_file($file);
                for ($i = 1; $i <= count($result); $i++) {
                    $insert_id = $this->student_model->add($result[$i]);
                    $data_new = array(
                        'student_id' => $insert_id,
                        'class_id' => $class_id,
                        'section_id' => $section_id,
                        'session_id' => $session
                    );
                    $this->student_model->add_student_session($data_new);
                    $user_password = $this->role->get_random_password($chars_min = 6, $chars_max = 6, $use_upper_case = false, $include_numbers = true, $include_special_chars = false);
                    $sibling_id = $this->input->post('sibling_id');
                    $data_student_login = array(
                        'username' => $this->student_login_prefix . $insert_id,
                        'password' => $user_password,
                        'user_id' => $insert_id,
                        'role' => 'student'
                    );
                    $this->user_model->add($data_student_login);
                    $parent_password = $this->role->get_random_password($chars_min = 6, $chars_max = 6, $use_upper_case = false, $include_numbers = true, $include_special_chars = false);
                    $temp = $insert_id;
                    $data_parent_login = array(
                        'username' => $this->parent_login_prefix . $insert_id,
                        'password' => $parent_password,
                        'user_id' => $insert_id,
                        'role' => 'parent',
                        'childs' => $temp
                    );
                    $ins_id = $this->user_model->add($data_parent_login);
                }
                $data['csvData'] = $result;
            }
            $this->session->set_flashdata('msg', '<div student="alert alert-success text-center">Students imported successfully</div>');
            redirect('teacher/student/search');
        }
    }

    function handle_csv_upload() {
        $error = "";
        if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
            $allowedExts = array('csv');
            $mimes = array('text/csv',
                'text/plain',
                'application/csv',
                'text/comma-separated-values',
                'application/excel',
                'application/vnd.ms-excel',
                'application/vnd.msexcel',
                'text/anytext',
                'application/octet-stream',
                'application/txt');
            $temp = explode(".", $_FILES["file"]["name"]);
            $extension = end($temp);
            if ($_FILES["file"]["error"] > 0) {
                $error .= "Error opening the file<br />";
            }
            if (!in_array($_FILES['file']['type'], $mimes)) {
                $error .= "Error opening the file<br />";
                $this->form_validation->set_message('handle_csv_upload', 'File type not allowed');
                return false;
            }
            if (!in_array($extension, $allowedExts)) {
                $error .= "Error opening the file<br />";
                $this->form_validation->set_message('handle_csv_upload', 'Extension not allowed');
                return false;
            }
            if ($error == "") {
                return true;
            }
        } else {
            $this->form_validation->set_message('handle_csv_upload', 'Please Select file');
            return false;
        }
    }

    function edit($id) {
        $data['title'] = 'Edit Student';
        $data['id'] = $id;
        $student = $this->student_model->get($id);
        $genderList = $this->customlib->getGender();
        $data['student'] = $student;
        $data['genderList'] = $genderList;
        $data["school"]=$this->Common_model->grab_school();

        $session = $this->setting_model->getCurrentSession();
        $vehroute_result = $this->vehroute_model->get();
        $data['vehroutelist'] = $vehroute_result;
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $category = $this->category_model->get();
        $data['categorylist'] = $category;
        $this->form_validation->set_rules('firstname', 'First Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('dob', 'Date of Birth', 'trim|required|xss_clean');
        $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required|xss_clean');
        $this->form_validation->set_rules('guardian_name', 'Guardian Name', 'trim|required|xss_clean');

        $this->form_validation->set_rules('guardian_phone', 'Guardian Phone', 'trim|required|xss_clean');
        $this->form_validation->set_rules('file', 'Image', 'callback_handle_upload');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/teacher/header', $data);
            $this->load->view('teacher/student/studentEdit', $data);
            $this->load->view('layout/teacher/footer', $data);
        } else {
            $class_id = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');

            $fees_discount = $this->input->post('fees_discount');
            $vehroute_id = $this->input->post('vehroute_id');
            $data = array(
                'id' => $id,
                'admission_no' => $this->input->post('admission_no'),
                'roll_no' => $this->input->post('roll_no'),
                'admission_date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('admission_date'))),
                'firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname'),
                'mobileno' => $this->input->post('mobileno'),
                'email' => $this->input->post('email'),
                'state' => $this->input->post('state'),
                'city' => $this->input->post('city'),
                'previous_school' => $this->input->post('previous_school'),
                'guardian_is' => $this->input->post('guardian_is'),
                'pincode' => $this->input->post('pincode'),
                'religion' => $this->input->post('religion'),
                'dob' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('dob'))),
                'current_address' => $this->input->post('current_address'),
                'permanent_address' => $this->input->post('permanent_address'),
                'category_id' => $this->input->post('category_id'),
                'adhar_no' => $this->input->post('adhar_no'),
                'samagra_id' => $this->input->post('samagra_id'),
                'bank_account_no' => $this->input->post('bank_account_no'),
                'bank_name' => $this->input->post('bank_name'),
                'ifsc_code' => $this->input->post('ifsc_code'),
                'father_name' => $this->input->post('father_name'),
                'father_phone' => $this->input->post('father_phone'),
                'father_occupation' => $this->input->post('father_occupation'),
                'mother_name' => $this->input->post('mother_name'),
                'mother_phone' => $this->input->post('mother_phone'),
                'mother_occupation' => $this->input->post('mother_occupation'),
                'guardian_occupation' => $this->input->post('guardian_occupation'),
                'guardian_email' => $this->input->post('guardian_email'),
                'gender' => $this->input->post('gender'),
                'guardian_name' => $this->input->post('guardian_name'),
                'guardian_relation' => $this->input->post('guardian_relation'),
                'guardian_phone' => $this->input->post('guardian_phone'),
                'guardian_address' => $this->input->post('guardian_address'),
                'resign' => $this->input->post('resign'),
                'school' => $this->input->post('school')


            );
            $this->student_model->add($data);
            $data_new = array(
                'student_id' => $id,
                'class_id' => $class_id,
                'section_id' => $section_id,
                'session_id' => $session,
                'vehroute_id' => $vehroute_id,
                'fees_discount' => $fees_discount
            );
            $insert_id = $this->student_model->add_student_session($data_new);
            if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
                $fileInfo = pathinfo($_FILES["file"]["name"]);
                $img_name = $id . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/student_images/" . $img_name);
                $data_img = array('id' => $id, 'image' => 'uploads/student_images/' . $img_name);
                $this->student_model->add($data_img);
            }
            $this->session->set_flashdata('msg', '<div student="alert alert-success text-left">Student Record Updated successfully</div>');
            redirect('teacher/student/search');
        }
    }

    function search() {
        $this->session->set_userdata('top_menu', 'Student Information');
        $this->session->set_userdata('sub_menu', 'teacher/student/search');
        $data['title'] = 'Student Search';
        $class = $this->class_model->get();
        $data["school"]=$this->Common_model->grab_school();

        $data['classlist'] = $class;
        $button = $this->input->post('search');
        if ($this->input->server('REQUEST_METHOD') == "GET") {
            $this->load->view('layout/teacher/header', $data);
            $this->load->view('teacher/student/studentSearch', $data);
            $this->load->view('layout/teacher/footer', $data);
        } else {
            $class = $this->input->post('class_id');
            $section = $this->input->post('section_id');
            $search = $this->input->post('search');
            $resign = $this->input->post('resign');
            $school = $this->input->post('school');
            $search_text = $this->input->post('search_text');
            if (isset($search)) {
                if ($search == 'search_filter') {
                 //   $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
                   // if ($this->form_validation->run() == FALSE) {
                        
                   // } else {
                        $data['searchby'] = "filter";
                        $data['class_id'] = $this->input->post('class_id');
                        $data['section_id'] = $this->input->post('section_id');
                    
                        $data['search_text'] = $this->input->post('search_text');
                        $resultlist = $this->student_model->searchByClassSection($class, $section,$resign,$school);
                        $data['resultlist'] = $resultlist;
             $title=$this->classsection_model->getDetailbyClassSection($data['class_id'], $data['section_id']);
               $data['title'] = 'Student Details for '.$title['class']."(".$title['section'].")";
                   // }
                } else if ($search == 'search_full') {
                    $data['searchby'] = "text";
                   
                    $data['search_text'] = trim($this->input->post('search_text'));
                    $resultlist = $this->student_model->searchFullText($search_text);
				    $data["exams"]=$this->db->order_by("id","ASC")->get("exams");
                
                   $data["rpcards"]=$this->db->query("SELECT exam_results.*,exam_schedules.* FROM exam_results JOIN exam_schedules
                            ON exam_results.exam_schedule_id=exam_schedules.id  WHERE 
                            exam_results.student_id='$id'");
					
                    $data['resultlist'] = $resultlist;
                    $data['title'] = 'Search Details: '.$data['search_text'];
                }
            }
            $this->load->view('layout/teacher/header', $data);
            $this->load->view('teacher/student/studentSearch', $data);
            $this->load->view('layout/teacher/footer', $data);
        }
    }
    
    


    function getByClassAndSection() {
        $class = $this->input->get('class_id');
        $section = $this->input->get('section_id');
        $resultlist = $this->student_model->searchByClassSection($class, $section);
        echo json_encode($resultlist);
    }

    function getStudentRecordByID() {
        $student_id = $this->input->get('student_id');
        $resultlist = $this->student_model->get($student_id);
        echo json_encode($resultlist);
    }

    function uploadimage($id) {
        $data['title'] = 'Add Image';
        $data['id'] = $id;
        $this->load->view('layout/teacher/header', $data);
        $this->load->view('teacher/student/uploadimage', $data);
        $this->load->view('layout/teacher/footer', $data);
    }

    public function doupload($id) {
        $config = array(
            'upload_path' => "./uploads/student_images/",
            'allowed_types' => "gif|jpg|png|jpeg|df",
            'overwrite' => TRUE,
        );
        $config['file_name'] = $id . ".jpg";
        $this->upload->initialize($config);
        $this->load->library('upload', $config);
        if ($this->upload->do_upload()) {
            $data = array('upload_data' => $this->upload->data());
            $upload_data = $this->upload->data();
            $data_record = array('id' => $id, 'image' => $upload_data['file_name']);
            $this->setting_model->add($data_record);

            $this->load->view('upload_success', $data);
        } else {
            $error = array('error' => $this->upload->display_errors());

            $this->load->view('file_view', $error);
        }
    }

    function getlogindetail() {
        $student_id = $this->input->post('student_id');
        $examSchedule = $this->user_model->getLoginDetails($student_id);
        echo json_encode($examSchedule);
    }
    
    /*controller by mzo*/
    function create_resigncertificate_form()
    {
        $this->load->view('layout/teacher/header', $data);
        $this->load->view('teacher/student/create_resigncertificate', $data);
        $this->load->view('layout/teacher/footer', $data);
    }
    function create_resigncertificate()
    {
        $enter_date=date("Y-m-d",strtotime($this->input->post("enter_date")));
        $student_name=$this->input->post('student_name');
        $resign_date=date("Y-m-d",strtotime($this->input->post('resign_date')));
        $nrc_no=$this->input->post('nrc_no');
        $yearfrom=date("Y-m-d",strtotime($this->input->post('yearfrom')));
        $yearto=date("Y-m-d",strtotime($this->input->post('yearto')));
        $father_name=$this->input->post('father_name');
        $moved_school=$this->input->post('moved_school');
        $moved_division=$this->input->post('moved_division');
        $moved_township=$this->input->post('moved_township');
        $moved_city=$this->input->post('moved_city');
        $letattend_class=$this->input->post('letattend_class');
        $letattend_date=date("Y-m-d",strtotime($this->input->post('letattend_date')));
        $dob=date("Y-m-d",strtotime($this->input->post('dob')));
        $nowattend_class=$this->input->post('nowattend_class');
        $attend_date=date("Y-m-d",strtotime($this->input->post('attend_date')));
        $rollcalltime=$this->input->post('rollcalltime');
        $parent_sign=$this->input->post('parent_sign');
        $parent_name=$this->input->post('parent_name');
        $parent_nrc=$this->input->post('parent_nrc');
        $parent_date=date("Y-m-d",strtotime($this->input->post('parent_date')));
        $principal_school=$this->input->post('principal_school');
        $principal_city=$this->input->post('principal_city');
        
        $data=array(
				"enter_date"=>$enter_date,
				"student_name"=>$student_name,
				"resign_date"=>$resign_date,
				"nrc_no"=>$nrc_no,
				"edu_from"=>$yearfrom,
				"edu_to"=>$yearto,
				"father_name"=>$father_name,
				"moved_school"=>$moved_school,
				"moved_division"=>$moved_division,
				"moved_township"=>$moved_township,
				"moved_city"=>$moved_city,
				"letattend_class"=>$letattend_class,
				"letattend_date"=>$letattend_date,
				"dob"=>$dob,
				"nowattend_class"=>$nowattend_class,
				"attend_date"=>$attend_date,
				"rollcalltime"=>$rollcalltime,
				"parent_sign"=>$parent_sign,
				"parent_name"=>$parent_name,
				"parent_nrc"=>$parent_nrc,
				"parent_date"=>$parent_date,
				"principal_school"=>$principal_school,
				"principal_city"=>$principal_city,
				"registered_date"=>date('Y-m-d')
				);
		$this->student_model->insert("resign_certificate",$data);
		redirect('teacher/Student/create_resigncertificate_form');
    }
    /*mzo*/

}

?>