<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class School extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('file');
        $this->lang->load('message', 'english');
    }

    function index() {
        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'School/index');
        $data['title'] = 'Section List';

        $school = $this->db->get("school");
        $data['school'] = $school;
        $this->form_validation->set_rules('name', 'Enter School Name', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/school/schoolList', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'name' => $this->input->post('name'),
            );
           $this->db->insert("school",$data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">School added successfully</div>');
            redirect('admin/School/index');
        }
    }

    function view($id) {
        $data['title'] = 'Section List';
        $section = $this->section_model->get($id);
        $data['section'] = $section;
        $this->load->view('layout/header', $data);
        $this->load->view('section/sectionShow', $data);
        $this->load->view('layout/footer', $data);
    }

    function delete($id) {
        $data['title'] = 'Section List';
        $this->section_model->remove($id);
        redirect('admin/School/index');
    }

    function getByClass() {
        $class_id = $this->input->get('class_id');
        $data = $this->section_model->getClassBySection($class_id);
        echo json_encode($data);
    }

    function edit($id) {
        $data['title'] = 'School List';
        $schoollist = $this->db->get("school");
        $data['schoollist'] = $schoollist;
        $data['title'] = 'Edit School';
        $data['id'] = $id;
        $school = $this->db->get_where("school",array("id",$id))->row();
       
        $data['school'] = $school;
        $this->form_validation->set_rules('name', 'Enter School Name', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/school/schoolEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'id' => $id,
                'name' => $this->input->post('name'),
            );
            $this->section_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">School updated successfully</div>');
            redirect('admin/School/index');
        }
    }

}

?>