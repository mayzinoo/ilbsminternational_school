<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dailyrecord extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('file');
        $this->lang->load('message', 'english');
        $this->load->model("Common_model");
        $this->load->model("Dailyrecord_model");
    }

    function index() {
        $this->session->set_userdata('top_menu', 'Teacherdiary');
        $this->session->set_userdata('sub_menu', 'Dailyrecord/index');
        $data['title'] = 'Daily Record List';
        $data['teacherlists'] = $this->Common_model->grab_teacher();
        $data['subjectlists'] = $this->Common_model->grab_subject();
     $class = $this->class_model->get();
        $data['classlist'] = $class;       
        $data['sectionlists'] = $this->Common_model->grab_section();
          $data["inter_class"]=$this->Common_model->grab_inter_class();
     
        $data["lists"]=$this->Dailyrecord_model->get();

        $this->load->view('layout/header', $data);
        $this->load->view('teacherdiary/dailyrecordList');// $data);
        $this->load->view('layout/footer', $data);
    }


    function createform()
    {
        $this->session->set_userdata('top_menu', 'Daily Record');
        $this->session->set_userdata('sub_menu', 'Daily Record/index');
        $data['title'] = 'Daily Record List';
        $data['teacherlists'] = $this->Common_model->grab_teacher();
        $data['subjectlists'] = $this->Common_model->grab_subject();
        $data['classlists'] = $this->Common_model->grab_class();
        $data['sectionlists'] = $this->Common_model->grab_section();
        $data["inter_class"]=$this->Common_model->grab_inter_class();
        $this->load->view('layout/header', $data);
        $this->load->view('teacherdiary/dailyrecordCreate');// $data);
        $this->load->view('layout/footer', $data);
    }

    function view($id) {
        $data['title'] = 'Daily Record List';
        $lists = $this->Dailyrecord_model->get($id);
        $data['lists'] = $lists;
        $this->load->view('layout/header', $data);
        $this->load->view('teacherdiary/dailyrecordShow', $data);
        $this->load->view('layout/footer', $data);
    }

    function delete($id) {
        $data['title'] = 'Daily Record List';
        $this->Dailyrecord_model->remove($id);
            redirect('teacherdiary/Dailyrecord/index');
    }

    function create() {

        $data['title'] = 'Add Daily Record';    

       $this->form_validation->set_rules('class', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section', 'Section', 'trim|required|xss_clean');
        $this->form_validation->set_rules('date', 'date', 'trim|required|xss_clean');


        if ($this->form_validation->run() == FALSE) {

            $this->load->view('layout/header', $data);
            $this->load->view('teacherdiary/dailyrecordList', $data);
            $this->load->view('layout/footer', $data);
        } else {
           
            $data = array(
                'class_section_id' => $this->input->post('class'),
                'section_id' => $this->input->post('section'),
                'created_at' => date("Y-m-d",strtotime($this->input->post('date')))
            );

           

            $header_id= $this->Dailyrecord_model->add($data);


            $subject=$this->input->post("subject");
            $description=$this->input->post("description");
           $teacher=$this->input->post('teacher');
           $times=$this->input->post('times');
           $grade=$this->input->post('grade');

            for($i=0;$i<count($subject);$i++)
            {
                $data=array(
                            "header_id"=>$header_id,
                            'grade' => $grade[$i],
                            "subject_id"=>$subject[$i],
                            "times"=>$times[$i],
                            "description"=>$description[$i]
                    );

                $this->db->insert("dailyrecord_detail",$data);
            }


            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Daily Record added successfully</div>');
            redirect('teacherdiary/Dailyrecord/index');
        }
    }

    function edit($id) {
        $data['title'] = 'Edit Daily Record';
         $data['teacherlists'] = $this->Common_model->grab_teacher();
        $data['subjectlists'] = $this->Common_model->grab_subject();
        $data['classlists'] = $this->Common_model->grab_class();
        $data['sectionlists'] = $this->Common_model->grab_section();
         $data["inter_class"]=$this->Common_model->grab_inter_class();
       
        
        $data['id'] = $id;
        $Dailyrecord = $this->Dailyrecord_model->get($id);
        $data['lists'] = $Dailyrecord;

/*        $this->form_validation->set_rules('teacher', 'Teacher Name', 'trim|required|xss_clean');
*/        $this->form_validation->set_rules('class', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section', 'Section', 'trim|required|xss_clean');
        $this->form_validation->set_rules('date', 'date', 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('teacherdiary/DailyrecordEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {
             $data = array(
                'id' => $id,                
                'class_section_id' => $this->input->post('class'),
                'section_id' => $this->input->post('section'),
                'created_at' => date("Y-m-d",strtotime($this->input->post('date')))
            );
            $this->Dailyrecord_model->add($data);
            $subject=$this->input->post("subject");
            $description=$this->input->post("description");
            $detail_id=$this->input->post("detail_id");
             $times=$this->input->post('times');
          $grade=$this->input->post('grade');

            $this->db->where("header_id",$id)->delete("dailyrecord_detail");


             for($i=0;$i<count($subject);$i++)
            {
                $data=array(
                           "header_id"=>$id,
                            'grade' => $grade[$i],
                            "subject_id"=>$subject[$i],
                            "times"=>$times[$i],
                            "description"=>$description[$i]
                    );

                $this->db->insert("dailyrecord_detail",$data);
                    $error = $this->db->error();
                    echo $error['message'];
            }
           



            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Daily Record updated successfully</div>');
            redirect('teacherdiary/Dailyrecord/index');
        }
    }

}

?>