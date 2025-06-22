<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Qrecord extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('file');
        $this->lang->load('message', 'english');
        $this->load->model("Common_model");
        $this->load->model("Qrecord_model");
        $this->load->model("Student_model");
    }

    function index() {
        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'admin/Qrecord/index');
        $data['title'] = 'Teacher Diary List';
        $data['studentlists'] = $this->Student_model->getStudents();
        $data['subjectlists'] = $this->Common_model->grab_subject();
        $data['classlists'] = $this->Common_model->grab_class();
        $data['sectionlists'] = $this->Common_model->grab_section();
        $data["lists"]=$this->Qrecord_model->get();
        $this->load->view('layout/header', $data);
        $this->load->view('admin/qrecord/qrecordList');// $data);
        $this->load->view('layout/footer', $data);
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

        $this->load->view('layout/header', $data);
        $this->load->view('teacherdiary/teacherdiaryCreate');// $data);
        $this->load->view('layout/footer', $data);
    }

    function view($id) {
        $data['title'] = 'Qualification Record Lists';
        $lists = $this->Qrecord_model->get($id);
        $data['lists'] = $lists;

        $this->load->view('layout/header', $data);
        $this->load->view('teacherdiary/teacherdiaryShow', $data);
        $this->load->view('layout/footer', $data);
    }

    function delete($id) {
        $data['title'] = 'Teacher Diary List';
        $this->Teacherdiary_model->remove($id);
            redirect('teacherdiary/teacherdiary/index');
    }

    function create() {

        $data['title'] = 'Add Teacher Diary';

        $this->form_validation->set_rules('teacher', 'Teacher Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('class', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section', 'Section', 'trim|required|xss_clean');
        $this->form_validation->set_rules('subject[]', 'Subject', 'trim|required|xss_clean');
        $this->form_validation->set_rules('date', 'date', 'trim|required|xss_clean');
        $this->form_validation->set_rules('description[]', 'description', 'trim|required|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('teacherdiary/teacherdiaryList', $data);
            $this->load->view('layout/footer', $data);
        } else {
            
            $data = array(
                'teacher_id' => $this->input->post('teacher'),
                'class_section_id' => $this->input->post('class'),
                'section_id' => $this->input->post('section'),
                'created_at' => date("Y-m-d",strtotime($this->input->post('date')))
            );

           

             $header_id=$this->Teacherdiary_model->add($data);
            $subject=$this->input->post("subject");
            $description=$this->input->post("description");
            $month=$this->input->post("month");

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
            redirect('teacherdiary/teacherdiary/index');
        }
    }

    function edit($id) {

        $data['title'] = 'Edit Teacher Diary';
         $data['teacherlists'] = $this->Common_model->grab_teacher();
        $data['subjectlists'] = $this->Common_model->grab_subject();
        $data['classlists'] = $this->Common_model->grab_class();
        $data['sectionlists'] = $this->Common_model->grab_section();
        $data['monthlist'] = $this->customlib->getMonthDropdown();

       
        $data['id'] = $id;
        $teacherdiary = $this->Teacherdiary_model->get($id);
        $data['lists'] = $teacherdiary;

        $this->form_validation->set_rules('teacher', 'Teacher Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('class', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section', 'Section', 'trim|required|xss_clean');
        $this->form_validation->set_rules('subject[]', 'Subject', 'trim|required|xss_clean');
        $this->form_validation->set_rules('date', 'date', 'trim|required|xss_clean');
        $this->form_validation->set_rules('description[]', 'description', 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('teacherdiary/teacherdiaryEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'id' => $id,
                'teacher_id' => $this->input->post('teacher'),
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
            redirect('teacherdiary/teacherdiary/index');
        }
    }

}

?>