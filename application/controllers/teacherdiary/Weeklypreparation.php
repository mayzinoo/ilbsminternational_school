<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Weeklypreparation extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('file');
        $this->lang->load('message', 'english');
        $this->load->model("Common_model");
        $this->load->model("Weeklypreparation_model");
    }

    function index() {
        $this->session->set_userdata('top_menu', 'Teacherdiary');
        $this->session->set_userdata('sub_menu', 'Weeklypreparation/index');
        $data['title'] = 'Weekly Preparation List';
        $data['teacherlists'] = $this->Common_model->grab_teacher();
        $data['subjectlists'] = $this->Common_model->grab_subject();
        $data['classlists'] = $this->Common_model->grab_class();
          $data["inter_class"]=$this->Common_model->grab_inter_class();
      $data['sectionlists'] = $this->Common_model->grab_section();
        $data["lists"]=$this->Weeklypreparation_model->get();
        $this->load->view('layout/header', $data);
        $this->load->view('teacherdiary/weeklypreparationList');// $data);
        $this->load->view('layout/footer', $data);
    }
    
function Search() {
        $this->session->set_userdata('top_menu', 'Teacherdiary');
        $this->session->set_userdata('sub_menu', 'Weeklypreparation/index');
        $data['title'] = 'Weekly Preparation List';
        $date_from=$this->input->post("date_from");
        $date_to=$this->input->post("date_to");
        $data['teacherlists'] = $this->Common_model->grab_teacher();
        $data['subjectlists'] = $this->Common_model->grab_subject();
        $data['classlists'] = $this->Common_model->grab_class();
        $data['sectionlists'] = $this->Common_model->grab_section();
        $data["lists"]=$this->Weeklypreparation_model->search($date_from,$date_to);
        $this->load->view('layout/header', $data);
        $this->load->view('teacherdiary/weeklypreparationList');// $data);
        $this->load->view('layout/footer', $data);
    }

    function createform()
    {
        $this->session->set_userdata('top_menu', 'Weekly Preparation');
        $this->session->set_userdata('sub_menu', 'Weekly Preparation/index');
        $data['title'] = 'Weekly Preparation List';
        $data['teacherlists'] = $this->Common_model->grab_teacher();
        $data['subjectlists'] = $this->Common_model->grab_subject();
        $data["schools"]=$this->Common_model->grab_school();
        $data['classlists'] = $this->Common_model->grab_class();
        $data["inter_class"]=$this->Common_model->grab_inter_class();
        $data['sectionlists'] = $this->Common_model->grab_section();
        $this->load->view('layout/header', $data);
        $this->load->view('teacherdiary/weeklypreparationCreate');// $data);
        $this->load->view('layout/footer', $data);
    }

    function view($id) {
        $data['title'] = 'Weekly Preparation List';
        $lists = $this->Weeklypreparation_model->get($id);
        $data['lists'] = $lists;
        $this->load->view('layout/header', $data);
        $this->load->view('teacherdiary/weeklypreparationShow', $data);
        $this->load->view('layout/footer', $data);
    }

    function delete($id) {
        $data['title'] = 'Weekly Preparation List';
        $this->Weeklypreparation_model->remove($id);
            redirect('teacherdiary/Weeklypreparation/index');
    }

    function create() {
       

        $data['title'] = 'Add Weekly Preparation';

        $this->form_validation->set_rules('teacher', 'Teacher Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('date_from', 'Date From', 'trim|required|xss_clean');
        $this->form_validation->set_rules('date_to', 'Date To', 'trim|required|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            
            $this->load->view('layout/header', $data);
            $this->load->view('teacherdiary/WeeklypreparationList', $data);
            $this->load->view('layout/footer', $data);
            
        } else {
            
            $session_id=$this->setting_model->getCurrentSessionid();
            $subject=$this->input->post("subject");
            $description=$this->input->post("description");
            $grade=$this->input->post('grade');
            
            $data = array(
                'teacher_id' => $this->input->post('teacher'),
                'class_section_id' => $grade[0],
                'school' => $this->input->post('school'),
                'session_id' => $session_id,
                'date_from' => date("Y-m-d",strtotime($this->input->post('date_from'))),
                'date_to' => date("Y-m-d",strtotime($this->input->post('date_to'))),
                'created_at' => date("Y-m-d",strtotime($this->input->post('date')))
            );

           
            $header_id=$this->Weeklypreparation_model->add($data);

          
            
            for($i=0;$i<count($subject);$i++)
            {
                $data=array(

                            'grade' =>$grade[$i],
                            "header_id"=>$header_id,
                            "subject_id"=>$subject[$i],
                            "description"=>$description[$i],
                    );

                $this->db->insert("weeklypreparation_detail",$data);
            }



            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Weekly Preparation added successfully</div>');
            redirect('teacherdiary/Weeklypreparation/index');
        }
    }

    function edit($id) {
        $data['title'] = 'Edit Weekly Preparation';
         $data['teacherlists'] = $this->Common_model->grab_teacher();
        $data['subjectlists'] = $this->Common_model->grab_subject();
        $data['classlists'] = $this->Common_model->grab_class();
        $data['sectionlists'] = $this->Common_model->grab_section();
        $data["schools"]=$this->Common_model->grab_school();
        $data["inter_class"]=$this->Common_model->grab_inter_class();

        $data['id'] = $id;
        $weeklypreparation = $this->Weeklypreparation_model->get($id);
        $data['lists'] = $weeklypreparation;

        $this->form_validation->set_rules('teacher', 'Teacher Name', 'trim|required|xss_clean');
      //  $this->form_validation->set_rules('class', 'Class', 'trim|required|xss_clean');
        ///$this->form_validation->set_rules('section', 'Section', 'trim|required|xss_clean');
        $this->form_validation->set_rules('date_from', 'Date From', 'trim|required|xss_clean');
        $this->form_validation->set_rules('date_to', 'Date To', 'trim|required|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('teacherdiary/weeklypreparationEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {
            
             $session_id=$this->setting_model->getCurrentSessionid();
            $subject=$this->input->post("subject");
            $description=$this->input->post("description");
            $grade=$this->input->post('grade');
            
            
            $data = array(
                'id' => $id,                
                'teacher_id' => $this->input->post('teacher'),
                'class_section_id' => $grade[0],
                'school' => $this->input->post('school'),
                'session_id' => $session_id,
                'date_from' => date("Y-m-d",strtotime($this->input->post('date_from'))),
                'date_to' => date("Y-m-d",strtotime($this->input->post('date_to'))),
                'created_at' => date("Y-m-d")
            );
          

            $this->Weeklypreparation_model->add($data);


            $subject=$this->input->post("subject");
            $description=$this->input->post("description");
            $detail_id=$this->input->post("detail_id");
            $grade=$this->input->post("grade");

            $this->db->where("header_id",$id)->delete("weeklypreparation_detail");


            for($i=0;$i<count($subject);$i++)
            {
                
                 
                $data=array(
                            "header_id"=>$id,
                            "grade"=>$grade[$i],
                            "subject_id"=>$subject[$i],
                            "description"=>$description[$i],
                    );

                $this->db->insert("weeklypreparation_detail",$data);
            }

            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Weekly Preparation updated successfully</div>');
            redirect('teacherdiary/Weeklypreparation/index');
        }
    }

}

?>