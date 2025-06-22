<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Teacherdiary extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('file');
        $this->lang->load('message', 'english');
        $this->load->model("Common_model");
        $this->load->model("Teacherdiary_model");
    }

    function index() {
        
        $teacher_id = $this->session->userdata['student']['teacher_id'];

        $this->session->set_userdata('top_menu', 'Teacherdiary');
        $this->session->set_userdata('sub_menu', 'Teacherdiary/index');
        $data['title'] = 'Teacher Diary List';
        $data['teacherlists'] = $this->Common_model->grab_teacher();
        $data['subjectlists'] = $this->Common_model->grab_subject();
        $data['classlists'] = $this->Common_model->grab_class();
        $data['sectionlists'] = $this->Common_model->grab_section();
        $data["lists"]=$this->Teacherdiary_model->getByeachTeacher($teacher_id);
        
       
        $this->load->view('layout/teacher/header', $data);
        $this->load->view('teacher/teacherdiary/teacherdiaryList');// $data);
        $this->load->view('layout/teacher/footer', $data);
    }


    function createform()
    {
        $this->session->set_userdata('top_menu', 'Teacher Diary');
        $this->session->set_userdata('sub_menu', 'Teacher Diary/index');
        $data['title'] = 'Teacher Diary List';
        $data['teacherlists'] = $this->Common_model->grab_teacher();
        $data['subjectlists'] = $this->Common_model->grab_subject();
        $data['classlists'] = $this->Common_model->grab_class();
        $data['sectionlists'] = $this->Common_model->grab_section();
        $data['monthlist'] = $this->customlib->getMonthDropdown();

        $this->load->view('layout/teacher/header', $data);
        $this->load->view('teacher/teacherdiary/teacherdiaryCreate');// $data);
        $this->load->view('layout/teacher/footer', $data);
    }

    function view($id) {
        $data['title'] = 'Teacher Diary List';
        $lists = $this->Teacherdiary_model->get($id);
        $data['lists'] = $lists;
        $data['monthlist'] = $this->customlib->getMonthDropdown();


        $this->load->view('layout/teacher/header', $data);
        $this->load->view('teacher/teacherdiary/teacherdiaryShow', $data);
        $this->load->view('layout/teacher/footer', $data);
    }

    function delete($id) {
        $data['title'] = 'Teacher Diary List';
        $this->Teacherdiary_model->remove($id);
            redirect('teacher/teacherdiary/index');
    }

    function create() {

        $data['title'] = 'Add Teacher Diary';
          $teacher_id = $this->session->userdata['student']['teacher_id'];
        $session_id = $this->setting_model->getCurrentSession();

        $this->form_validation->set_rules('class', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section', 'Section', 'trim|required|xss_clean');
        $this->form_validation->set_rules('subject[]', 'Subject', 'trim|required|xss_clean');
        $this->form_validation->set_rules('date', 'date', 'trim|required|xss_clean');
        $this->form_validation->set_rules('description[]', 'description', 'trim|required|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/teacher/header', $data);
            $this->load->view('teacher/teacherdiary/teacherdiaryList', $data);
            $this->load->view('layout/teacher/footer', $data);
        } else {
            
            $data = array(
                'teacher_id' => $teacher_id,
                'session_id' => $session_id,
                'class_section_id' => $this->input->post('class'),
                'section_id' => $this->input->post('section'),
                'created_at' => date("Y-m-d",strtotime($this->input->post('date')))
            );

           

             $header_id=$this->Teacherdiary_model->add($data);
             
             
            $subject=$this->input->post("subject");
            $description=$this->input->post("description");
            $month=$this->input->post("month");
            // echo $month;exit;

            for($i=0;$i<count($subject);$i++)
            {
                $data=array(
                            "header_id"=>$header_id,
                            "subject_id"=>$subject[$i],
                            "description"=>$description[$i],
                            "month"=>$month[$i]
                    );

                $this->db->insert("teacherdiary_detail",$data);
            }



            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Teacher Diary added successfully</div>');
            redirect('teacher/teacherdiary/index');
        }
    }

    function edit($id) {

        $data['title'] = 'Edit Teacher Diary';
         $data['teacherlists'] = $this->Common_model->grab_teacher();
        $data['subjectlists'] = $this->Common_model->grab_subject();
        $data['classlists'] = $this->Common_model->grab_class();
        $data['sectionlists'] = $this->Common_model->grab_section();
        $data['monthlist'] = $this->customlib->getMonthDropdown();
        $teacher_id = $this->session->userdata['student']['teacher_id'];
        $session_id = $this->setting_model->getCurrentSession();
       
        $data['id'] = $id;
        $teacherdiary = $this->Teacherdiary_model->get($id);
        $data['lists'] = $teacherdiary;

        $this->form_validation->set_rules('class', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section', 'Section', 'trim|required|xss_clean');
        $this->form_validation->set_rules('subject[]', 'Subject', 'trim|required|xss_clean');
        $this->form_validation->set_rules('date', 'date', 'trim|required|xss_clean');
        $this->form_validation->set_rules('description[]', 'description', 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/teacher/header', $data);
            $this->load->view('teacher/teacherdiary/teacherdiaryEdit', $data);
            $this->load->view('layout/teacher/footer', $data);
        } else {
            $data = array(
                'id' => $id,
                'class_section_id' => $this->input->post('class'),
                'section_id' => $this->input->post('section'),
                'created_at' => date("Y-m-d",strtotime($this->input->post('date')))
            );

            $this->Teacherdiary_model->add($data);

             $subject=$this->input->post("subject");
            $description=$this->input->post("description");
            $month=$this->input->post("month");
            $detail_id=$this->input->post("detail_id");

            $this->db->where("header_id",$id)->delete("teacherdiary_detail");

            for($i=0;$i<count($subject);$i++)
            {
                $data=array(
                            "header_id"=>$id,
                            "subject_id"=>$subject[$i],
                            "description"=>$description[$i],
                            "month"=>$month[$i]
                    );

                $this->db->insert("teacherdiary_detail",$data);
            }


            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Teacher Diary updated successfully</div>');
            redirect('teacher/teacherdiary/teacherdiary/index');
        }
    }

}

?>