<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Weeklypreparation extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('file');
        $this->lang->load('message', 'english');
        $this->load->model("Common_model");
        $this->load->model("Weeklypreparation_model");
    }

    function index() {

        $stu=$this->session->userdata($student);
        $this->session->set_userdata('top_menu', 'Weekly Preparation');
        $this->session->set_userdata('sub_menu', 'Weekly Preparation/index');
        $data['title'] = 'Weekly Preparation List';
        $data['teacherlists'] = $this->Common_model->grab_teacher();
        $data['subjectlists'] = $this->Common_model->grab_subject();
        $data['classlists'] = $this->Common_model->grab_class();
        $data['sectionlists'] = $this->Common_model->grab_section();
        $data["lists"]=$this->Weeklypreparation_model->getByeachTeacher($stu["student"]["teacher_id"]);

       $this->load->view('layout/teacher/header', $data);
        $this->load->view('teacher/teacherdiary/weeklypreparationList');// $data);
        $this->load->view('layout/teacher/footer', $data);
    }


    function createform()
    {
        $stu=$this->session->userdata($student);
        $data["teacher_id"]=$stu["student"]["teacher_id"];
        $this->session->set_userdata('top_menu', 'Weekly Preparation');
        $this->session->set_userdata('sub_menu', 'Weekly Preparation/index');
        $data['title'] = 'Weekly Preparation List';
        $data['teacherlists'] = $this->Common_model->grab_teacher();
        $data['subjectlists'] = $this->Common_model->grab_subject();
        $data['classlists'] = $this->Common_model->grab_class();
        $data['sectionlists'] = $this->Common_model->grab_section();
        $this->load->view('layout/teacher/header', $data);
        $this->load->view('teacher/teacherdiary/weeklypreparationCreate');// $data);
        $this->load->view('layout/teacher/footer', $data);
    }

    function view($id) {
        $data['title'] = 'Weekly Preparation List';
        $lists = $this->Weeklypreparation_model->get($id);
        $data['lists'] = $lists;
        $this->load->view('layout/teacher/header', $data);
        $this->load->view('teacher/teacherdiary/weeklypreparationShow', $data);
        $this->load->view('layout/teacher/footer', $data);
    }

    function delete($id) {
        $data['title'] = 'Weekly Preparation List';
        $this->Weeklypreparation_model->remove($id);
            redirect('teacher/teacherdiary/Weeklypreparation/index');
    }

    function create() {
       
        $stu=$this->session->userdata($student);
        $teacher_id=$stu["student"]["teacher_id"];

        $data['title'] = 'Add Weekly Preparation';

        $this->form_validation->set_rules('class', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section', 'Section', 'trim|required|xss_clean');
        $this->form_validation->set_rules('date_from', 'Date From', 'trim|required|xss_clean');
        $this->form_validation->set_rules('date_to', 'Date To', 'trim|required|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/teacher/header', $data);
            $this->load->view('teacher/teacherdiary/WeeklypreparationList', $data);
            $this->load->view('layout/teacher/footer', $data);
        } else {
            
            $data = array(
                'teacher_id' => $teacher_id,
                'class_section_id' => $this->input->post('class'),
                'section_id' => $this->input->post('section'),
                'date_from' => date("Y-m-d",strtotime($this->input->post('date_from'))),
                'date_to' => date("Y-m-d",strtotime($this->input->post('date_to'))),
                'created_at' => date("Y-m-d",strtotime($this->input->post('date')))
            );

           
            $header_id=$this->Weeklypreparation_model->add($data);

            $subject=$this->input->post("subject");
            $description=$this->input->post("description");

            for($i=0;$i<count($subject);$i++)
            {
                $data=array(
                            "header_id"=>$header_id,
                            "subject_id"=>$subject[$i],
                            "description"=>$description[$i],
                    );

                $this->db->insert("weeklypreparation_detail",$data);
            }



            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Weekly Preparation added successfully</div>');
            redirect('teacher/teacherdiary/Weeklypreparation/index');
        }
    }

    function edit($id) {
        $data['title'] = 'Edit Weekly Preparation';
         $data['teacherlists'] = $this->Common_model->grab_teacher();
        $data['subjectlists'] = $this->Common_model->grab_subject();
        $data['classlists'] = $this->Common_model->grab_class();
        $data['sectionlists'] = $this->Common_model->grab_section();
      
        $data['id'] = $id;
        $weeklypreparation = $this->Weeklypreparation_model->get($id);
        $data['lists'] = $weeklypreparation;

        $this->form_validation->set_rules('teacher', 'Teacher Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('class', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section', 'Section', 'trim|required|xss_clean');
        $this->form_validation->set_rules('date_from', 'Date From', 'trim|required|xss_clean');
        $this->form_validation->set_rules('date_to', 'Date To', 'trim|required|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/teacher/header', $data);
            $this->load->view('teacher/teacherdiary/weeklypreparationEdit', $data);
            $this->load->view('layout/teacher/footer', $data);
        } else {
            $data = array(
                'id' => $id,                
                'teacher_id' => $this->input->post('teacher'),
                'class_section_id' => $this->input->post('class'),
                'section_id' => $this->input->post('section'),
                'date_from' => date("Y-m-d",strtotime($this->input->post('date_from'))),
                'date_to' => date("Y-m-d",strtotime($this->input->post('date_to'))),
                'created_at' => date("Y-m-d")
            );
          

            $this->Weeklypreparation_model->add($data);


            $subject=$this->input->post("subject");
            $description=$this->input->post("description");
            $detail_id=$this->input->post("detail_id");

            $this->db->where("header_id",$id)->delete("weeklypreparation_detail");


            for($i=0;$i<count($subject);$i++)
            {
                $data=array(
                            "header_id"=>$id,
                            "subject_id"=>$subject[$i],
                            "description"=>$description[$i],
                    );

                $this->db->insert("weeklypreparation_detail",$data);
            }

            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Weekly Preparation updated successfully</div>');
            redirect('teacher/teacherdiary/Weeklypreparation/index');
        }
    }

}

?>