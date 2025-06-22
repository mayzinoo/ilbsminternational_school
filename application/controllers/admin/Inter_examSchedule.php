<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Inter_examSchedule extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('file');
        $this->lang->load('message', 'english');
    }

    function index() {
        $this->session->set_userdata('top_menu', 'Examinations');
        $this->session->set_userdata('sub_menu', 'Inter_examSchedule/index');
        $data['title'] = 'Inter Exam Schedule';
        $data["inter_classes"]=$this->Common_model->grab_inter_class();
        $data["schools"]=$this->Common_model->grab_school();
        
        $examSchedule = $this->examschedule_model->getInterExamSchdules($data['inter_class'], $data['school_id']);
            $data['examSchedule'] = $examSchedule;
        $this->form_validation->set_rules('inter_class', 'inter_class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('school', 'school', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/inter_exam_schedule/examList', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data['inter_class'] = $this->input->post('inter_class');
            $data['school_id'] = $this->input->post('school_id');
           
            $this->load->view('layout/header', $data);
            $this->load->view('admin/inter_exam_schedule/examList', $data);
            $this->load->view('layout/footer', $data);
        }
    }

    function view($id) {
        $data['title'] = 'Exam Schedule List';
        $exam = $this->exam_model->get($id);
        $data['exam'] = $exam;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/inter_exam_schedule/examShow', $data);
        $this->load->view('layout/footer', $data);
    }

    function delete($id) {
        $data['title'] = 'Exam Schedule List';
        $this->exam_model->remove($id);
         redirect('admin/Inter_examSchedule');
    }

    function create() {
        $session = $this->setting_model->getCurrentSession();
        $data['title'] = 'Exam Schedule';
        $data['exam_id'] = "";
        $data['inter_class'] = "";
        $data['school'] = "";
        $exam = $this->exam_model->get();
        $data["inter_classes"]=$this->Common_model->grab_inter_class();
        $data["schools"]=$this->Common_model->grab_school();
        $data['subjectlists'] = $this->Common_model->grab_subject();

        $data['examlist'] = $exam;
        $data['classlist'] = $class;
        $this->form_validation->set_rules('exam_id', 'Exam', 'trim|required|xss_clean');
        $this->form_validation->set_rules('inter_class', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('school', 'Section', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/inter_exam_schedule/examCreate', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $exam_id = $this->input->post('exam_id');
            $inter_class = $this->input->post('inter_class');
            $subject_id = $this->input->post('subject_id');
            $date = $this->input->post('date');
            $stime = $this->input->post('stime');
            $etime = $this->input->post('etime');
            $room = $this->input->post('room');
            $fmark = $this->input->post('fmark');
            $pmarks = $this->input->post('pmarks');
            $school = $this->input->post('school');

            $data['exam_id'] = $exam_id;
            $data['inter_class'] = $inter_class;
            $data['school'] = $school;
            
            $headerdata=array(
                        'session_id' => $session,
                        'inter_class' => $inter_class,
                        'exam_id' => $exam_id,
                        'school' => $school
                );
                
                 $this->db->insert('inter_exam_schedules', $headerdata);
                 
                 $header_id=$this->db->insert_id();

            
                for($i=0;$i<count($subject_id);$i++) {
                    $data = array(
                        
                        'header_id' => $header_id,
                        'subject_id' => $subject_id[$i],
                        'date_of_exam' => date("Y-m-d",strtotime($date[$i])),
                        'start_to' => $stime[$i],
                        'end_from' => $etime[$i],
                        'room_no' => $room[$i],
                        'full_marks' => $fmark[$i],
                        'passing_marks' => $pmarks[$i],
                        
                    );
                    
                    $this->db->insert('inter_exam_schedules_details', $data);


                
            }
            
         redirect('admin/Inter_examSchedule');

            $this->load->view('layout/header', $data);
            $this->load->view('admin/inter_exam_schedule/examCreate', $data);
            $this->load->view('layout/footer', $data);
        }
    }
    
    

    function edit($id) {
        $data['title'] = 'Edit Exam Schedule';
        $data['id'] = $id;
        $examSchedule = $this->examschedule_model->getInterDetailbyEdit($id);
        $data['examSchedule'] = $examSchedule;
        $data['examlist']  = $this->exam_model->get();

        $data["inter_classes"]=$this->Common_model->grab_inter_class();
        $data["schools"]=$this->Common_model->grab_school();
        $data['subjectlists'] = $this->Common_model->grab_subject();

 $this->form_validation->set_rules('exam_id', 'Exam', 'trim|required|xss_clean');
        $this->form_validation->set_rules('inter_class', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('school', 'Section', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/inter_exam_schedule/examEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $exam_id = $this->input->post('exam_id');
            $inter_class = $this->input->post('inter_class');
            $subject_id = $this->input->post('subject_id');
            $date = $this->input->post('date');
            $stime = $this->input->post('stime');
            $etime = $this->input->post('etime');
            $room = $this->input->post('room');
            $fmark = $this->input->post('fmark');
            $pmarks = $this->input->post('pmarks');
            $school = $this->input->post('school');

            $data['exam_id'] = $exam_id;
            $data['inter_class'] = $inter_class;
            $data['school'] = $school;
            
            $headerdata=array(
                        'inter_class' => $inter_class,
                        'exam_id' => $exam_id,
                        'school' => $school
                );
                
            $this->db->where("id",$id);
            $this->db->update('inter_exam_schedules', $headerdata);
                 
            $this->db->where("header_id",$id)->delete("inter_exam_schedules_details");
            
            
            for($i=0;$i<count($subject_id);$i++) {
                    $data = array(
                        
                        'header_id' => $id,
                        'subject_id' => $subject_id[$i],
                        'date_of_exam' => date("Y-m-d",strtotime($date[$i])),
                        'start_to' => $stime[$i],
                        'end_from' => $etime[$i],
                        'room_no' => $room[$i],
                        'full_marks' => $fmark[$i],
                        'passing_marks' => $pmarks[$i],
                        
            );
                    
            $this->db->insert('inter_exam_schedules_details', $data);



           
        }
        
         $this->session->set_flashdata('msg', '<div exam="alert alert-success text-center">Employee details added to Database!!!</div>');
         redirect('admin/Inter_examSchedule');
    }
    
    }
    
    
    

    function getInterDetailbyClsandSection() {
        $header_id = $this->input->post('header_id');
      
        $examSchedule = $this->examschedule_model->getInterDetailbyClsandSection($header_id);
        echo json_encode($examSchedule);
    }

}

?>