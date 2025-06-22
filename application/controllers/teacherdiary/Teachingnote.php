<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Teachingnote extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('file');
        $this->lang->load('message', 'english');
        $this->load->model("Common_model");
        $this->load->model("Teachingnote_model");
    }

    function index() {
        $this->session->set_userdata('top_menu', 'Teacherdiary');
        $this->session->set_userdata('sub_menu', 'Teachingnote/index');
        $data['title'] = 'Teaching Note List';
        $data['teacherlists'] = $this->Common_model->grab_teacher();
        $data['subjectlists'] = $this->Common_model->grab_subject();
        $data['classlists'] = $this->Common_model->grab_class();
         $data["inter_class"]=$this->Common_model->grab_inter_class();
       $data['sectionlists'] = $this->Common_model->grab_section();
        $data["lists"]=$this->Teachingnote_model->get();
        $this->load->view('layout/header', $data);
        $this->load->view('teacherdiary/teachingnoteList');// $data);
        $this->load->view('layout/footer', $data);
    }


    function createform()
    {
        $this->session->set_userdata('top_menu', 'Teaching Note');
        $this->session->set_userdata('sub_menu', 'Teaching Note/index');
        $data['title'] = 'Teaching Note List';
        $data['teacherlists'] = $this->Common_model->grab_teacher();
        $data['subjectlists'] = $this->Common_model->grab_subject();
        $data['classlists'] = $this->Common_model->grab_class();
        $data['sectionlists'] = $this->Common_model->grab_section();
         $data["inter_class"]=$this->Common_model->grab_inter_class();
       
        $this->load->view('layout/header', $data);
        $this->load->view('teacherdiary/teachingnoteCreate');// $data);
        $this->load->view('layout/footer', $data);
    }

    function view($id) {
        $data['title'] = 'Teaching Note List';
        $lists = $this->Teachingnote_model->get($id);
        $data['lists'] = $lists;


        $this->load->view('layout/header', $data);
        $this->load->view('teacherdiary/teachingnoteShow', $data);
        $this->load->view('layout/footer', $data);
    }

    function delete($id) {
        $data['title'] = 'Teaching Note List';
        $this->Teachingnote_model->remove($id);
    // redirect('teacherdiary/Teachingnote/index');
    $this->index();
    }

    function create() {

 
        $data['title'] = 'Add Teaching Note';


        $this->form_validation->set_rules('teacher', 'Teacher Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('class', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section', 'Section', 'trim|required|xss_clean');
        $this->form_validation->set_rules('subject[]', 'Subject', 'trim|required|xss_clean');
        $this->form_validation->set_rules('date', 'date', 'trim|required|xss_clean');
        $this->form_validation->set_rules('lesson_title', 'lesson title', 'trim|required|xss_clean');
        $this->form_validation->set_rules('description[]', 'description', 'trim|required|xss_clean');



        if ($this->form_validation->run() == FALSE) {

            $this->load->view('layout/header', $data);
            $this->load->view('teacherdiary/teachingnoteList', $data);
            $this->load->view('layout/footer', $data);
        } else {


            
            $data = array(
                'teacher_id' => $this->input->post('teacher'),
                'class_section_id' => $this->input->post('class'),
                'section_id' => $this->input->post('section'),
                'lessontitle' => $this->input->post('lesson_title'),
                'created_at' => date("Y-m-d",strtotime($this->input->post('date')))
            );

            

            $header_id=$this->Teachingnote_model->add($data);

            $subject=$this->input->post("subject");
            $description=$this->input->post("description");

            for($i=0;$i<count($subject);$i++)
            {
                $data=array(
                            "header_id"=>$header_id,
                            "subject_id"=>$subject[$i],
                            "description"=>$description[$i],
                    );

                $this->db->insert("teachingnote_detail",$data);
            }



            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Teaching Note added successfully</div>');
            // redirect('teacherdiary/Teachingnote/index');
            $this->index();
        }
    }

    function edit($id) {
        $data['title'] = 'Edit Teaching Note';
         $data['teacherlists'] = $this->Common_model->grab_teacher();
        $data['subjectlists'] = $this->Common_model->grab_subject();
        $data['classlists'] = $this->Common_model->grab_class();
        $data['sectionlists'] = $this->Common_model->grab_section();
          $data["inter_class"]=$this->Common_model->grab_inter_class();
      
      
        $data['id'] = $id;
        $teachingnote = $this->Teachingnote_model->get($id);
       
        $data['lists'] = $teachingnote;

        $this->form_validation->set_rules('teacher', 'Teacher Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('class', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section', 'Section', 'trim|required|xss_clean');
        $this->form_validation->set_rules('subject[]', 'Subject', 'trim|required|xss_clean');
        $this->form_validation->set_rules('date', 'date', 'trim|required|xss_clean');
        $this->form_validation->set_rules('description[]', 'description', 'trim|required|xss_clean');


        if ($this->form_validation->run() == FALSE) {

            $this->load->view('layout/header', $data);
            $this->load->view('teacherdiary/teachingnoteEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'id' => $id,
                'teacher_id' => $this->input->post('teacher'),
                'class_section_id' => $this->input->post('class'),
                'section_id' => $this->input->post('section'),
                'lessontitle' => $this->input->post('lesson_title'),
                'created_at' => date("Y-m-d",strtotime($this->input->post('date')))
            );


            $this->Teachingnote_model->add($data);

             $subject=$this->input->post("subject");
            $description=$this->input->post("description");

            $this->db->where("header_id",$id)->delete("teachingnote_detail");


            for($i=0;$i<count($subject);$i++)
            {
                $data=array(
                            "header_id"=>$id,
                            "subject_id"=>$subject[$i],
                            "description"=>$description[$i],
                    );

                $this->db->insert("teachingnote_detail",$data);
            }


            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Teaching Note updated successfully</div>');
            $this->index();        
            
        }
    }

}

?>