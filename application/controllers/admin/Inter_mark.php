<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Inter_mark extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('file');
        $this->lang->load('message', 'english');
        $this->load->library('smsgateway');
        $this->load->library('mailsmsconf');
    }

    function index() {
        $this->session->set_userdata('top_menu', 'Examinations');
        $this->session->set_userdata('sub_menu', 'inter_mark/index');
        $session = $this->setting_model->getCurrentSession();
        $data['title'] = 'Exam Marks';
        $data['exam_id'] = "";
        $data['inter_class'] = "";
        $data['section_id'] = "";
        $exam = $this->exam_model->get();
        $class = $this->class_model->get();
        $data['examlist'] = $exam;
        $data['classlist'] = $class;
        $feecategory = $this->feecategory_model->get();
        $data["inter_classes"]=$this->Common_model->grab_inter_class();
        $data["schools"]=$this->Common_model->grab_school();
        $exam_id = $this->input->post('exam_id');
        $data['exam_id'] = $exam_id;
        $data['feecategorylist'] = $feecategory;
        $this->form_validation->set_rules('exam_id', 'Exam', 'trim|required|xss_clean');
        $this->form_validation->set_rules('inter_class', 'Class', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/inter_mark/markList', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $exam_id = $this->input->post('exam_id');
            $inter_class = $this->input->post('inter_class');
            $school = $this->input->post('school');
            $data['exam_id'] = $exam_id;
            $data['inter_class'] = $inter_class;
            $data['school'] = $school;
            $examSchedule = $this->examschedule_model->getDetailbyInterclass($inter_class, $school,$exam_id);
            $studentList = $this->student_model->searchByInterClass($inter_class);
            $data['examSchedule'] = array();
            if (!empty($examSchedule)) {
                $new_array = array();
                $data['examSchedule']['status'] = "yes";
                foreach ($studentList as $stu_key => $stu_value) {
                    $array = array();
                    $array['student_id'] = $stu_value['stuid'];
                    $array['roll_no'] = $stu_value['roll_no'];
                    $array['firstname'] = $stu_value['firstname'];
                    $array['lastname'] = $stu_value['lastname'];
                    $array['admission_no'] = $stu_value['admission_no'];
                    $array['dob'] = $stu_value['dob'];
                    $array['father_name'] = $stu_value['father_name'];
                    $x = array();
                    foreach ($examSchedule as $ex_key => $ex_value) {
                        $exam_array = array();
                        $exam_array['exam_schedule_id'] = $ex_value['id'];
                        $exam_array['exam_id'] = $ex_value['exam_id'];
                        $exam_array['full_marks'] = $ex_value['full_marks'];
                        $exam_array['passing_marks'] = $ex_value['passing_marks'];
                        $exam_array['exam_name'] = $ex_value['name'];
                        $exam_array['exam_type'] = $ex_value['type'];
                        $student_exam_result = $this->examresult_model->get_inter_result($ex_value['id'], $ex_value['sid'],$stu_value['stuid']);
                        if (empty($student_exam_result)) {
                            
                        } else {
                            $exam_array['attendence'] = $student_exam_result->attendence;
                            $exam_array['get_marks'] = $student_exam_result->get_marks;
                        }
                        $x[] = $exam_array;
                    }
                    if (empty($x)) {
                        $data['examSchedule']['status'] = "no";
                    }
                    $array['exam_array'] = $x;
                    $new_array[] = $array;
                }

                $data['examSchedule']['result'] = $new_array;
            } else {
                $s = array('status' => 'no');
                $data['examSchedule'] = $s;
            }
            $this->load->view('layout/header', $data);
            $this->load->view('admin/inter_mark/markList', $data);
            $this->load->view('layout/footer', $data);
        }
    }

    function view($id) {
        $data['title'] = 'Mark List';
        $mark = $this->mark_model->get($id);
        $data['mark'] = $mark;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/inter_mark/markShow', $data);
        $this->load->view('layout/footer', $data);
    }

    function delete($id) {
        $data['title'] = 'Mark List';
        $this->mark_model->remove($id);
        redirect('admin/inter_mark/index');
    }

    function create() {
        $session = $this->setting_model->getCurrentSession();
        $data['title'] = 'Exam Schedule';
        $data['exam_id'] = "";
        $data['class_id'] = "";
        $data['section_id'] = "";
        $exam = $this->exam_model->get();
        $data["inter_classes"]=$this->Common_model->grab_inter_class();
        $data["school"]=$this->Common_model->grab_school();

        $data['examlist'] = $exam;
        $feecategory = $this->feecategory_model->get();
        $data['feecategorylist'] = $feecategory;
        $this->form_validation->set_rules('exam_id', 'Exam', 'trim|required|xss_clean');
        $this->form_validation->set_rules('inter_class', 'Inter Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('school', 'School', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/inter_mark/markCreate', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $exam_id = $this->input->post('exam_id');
            $inter_class = $this->input->post('inter_class');
            $school = $this->input->post('school');
            $data['exam_id'] = $exam_id;
            $data['inter_class'] = $inter_class;
            $data['school'] = $school;
            $examSchedule = $this->examschedule_model->getDetailbyInterclass($inter_class, $school,$exam_id);
            $studentList = $this->student_model->searchByInterClass($inter_class);
            $data['examSchedule'] = array();
            if (!empty($examSchedule)) {
                $new_array = array();
                foreach ($studentList as $stu_key => $stu_value) {
                    $array = array();
                    $array['student_id'] = $stu_value['stuid'];
                    $array['admission_no'] = $stu_value['admission_no'];
                    $array['roll_no'] = $stu_value['roll_no'];
                    $array['firstname'] = $stu_value['firstname'];
                    $array['lastname'] = $stu_value['lastname'];
                    $array['dob'] = $stu_value['dob'];
                    $array['father_name'] = $stu_value['father_name'];
                    $x = array();
                    foreach ($examSchedule as $ex_key => $ex_value) {
                        $exam_array = array();
                        $exam_array['exam_schedule_id'] = $ex_value['id'];
                        $exam_array['sid'] = $ex_value['sid'];
                        $exam_array['exam_id'] = $ex_value['exam_id'];
                        $exam_array['full_marks'] = $ex_value['full_marks'];
                        $exam_array['passing_marks'] = $ex_value['passing_marks'];
                        $exam_array['exam_name'] = $ex_value['name'];
                        $exam_array['exam_type'] = $ex_value['type'];
                        $student_exam_result = $this->examresult_model->get_exam_result($ex_value['id'], $stu_value['id']);
                        $exam_array['attendence'] = $student_exam_result->attendence;
                        $exam_array['get_marks'] = $student_exam_result->get_marks;
                        $x[] = $exam_array;
                    }
                    $array['exam_array'] = $x;
                    $new_array[] = $array;
                }
                $data['examSchedule'] = $new_array;
            }
            if ($this->input->post('save_exam') == "save_exam") {
                $ex_array = array();
                $exam_id = $this->input->post('exam_id'); 
                $student_array = $this->input->post('student');
                $exam = $this->input->post('exam_schedule');
                $sid = $this->input->post('sid');
                $full_marks = $this->input->post('full_marks');
                
                foreach ($student_array as $key => $student) {
                    
                    $a=0;

                      foreach( $sid as $key=>$subid){

                         $record['get_marks']=$this->input->post('student_number' . $student . "_" . $subid);
                         $record['full_marks']=$this->input->post('student_number' . $student . "_" . $subid);
                        $record['exam_schedule_id'] = $exam;
                        $record['student_id'] = $student;
                        $record['subject_id'] = $subid;
                        $record['full_marks'] = $full_marks[$a];
                       // $inserted_id = $this->examresult_model->add_inter_exam_result($record);
                          $this->db->insert('inter_exam_results', $record);
                         $insert_id = $this->db->insert_id();

                        if ($inserted_id) {
                            $ex_array[$student] = $exam_id;
                        }
                    
                    $a++;
                    }
                }




                if (!empty($ex_array)) {
                    $this->mailsmsconf->mailsms('exam_result', $ex_array, NULL, $exam_array);
                }

                redirect('admin/inter_mark');
            }
            $this->load->view('layout/header', $data);
            $this->load->view('admin/inter_mark/markCreate', $data);
            $this->load->view('layout/footer', $data);
        }
    }

    function edit($id) {
        $data['title'] = 'Edit Mark';
        $data['id'] = $id;
        $mark = $this->mark_model->get($id);
        $data['mark'] = $mark;
        $this->form_validation->set_rules('name', 'Mark', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/inter_mark/markEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'id' => $id,
                'name' => $this->input->post('name'),
                'note' => $this->input->post('note'),
            );
            $this->mark_model->add($data);
            $this->session->set_flashdata('msg', '<div mark="alert alert-success text-center">Employee details added to Database!!!</div>');
            redirect('admin/inter_mark/index');
        }
    }

}

?>