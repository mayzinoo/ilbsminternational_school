<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Inter_class extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('file');
        $this->lang->load('message', 'english');
        $this->load->model("Inter_class_model");
    }

    function index() {
        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'inter_class/index');
        $data['title'] = 'Inter Class List';

        $inter_class_result = $this->Inter_class_model->get();
        $data['inter_classlist'] = $inter_class_result;
        $this->form_validation->set_rules('class', 'Inter Class', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('inter_class/inter_classList', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'class' => $this->input->post('class'),
            );
            $this->Inter_class_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Inter Class added successfully</div>');
            redirect('inter_class/index');
        }
    }

    function view($id) {
        $data['title'] = 'Inter Class List';
        $inter_class = $this->Inter_class_model->get($id);
        $data['inter_class'] = $inter_class;
        $this->load->view('layout/header', $data);
        $this->load->view('inter_class/inter_classShow', $data);
        $this->load->view('layout/footer', $data);
    }

    function delete($id) {
        $data['title'] = 'Inter Class List';
        $this->Inter_class_model->remove($id);
        redirect('inter_class/index');
    }

    

    function edit($id) {
        $data['title'] = 'Inter Class List';
        $inter_class_result = $this->Inter_class_model->get();
        $data['inter_classlist'] = $inter_class_result;
        $data['title'] = 'Edit Inter Class';
        $data['id'] = $id;
        $inter_class = $this->Inter_class_model->get($id);
        $data['inter_class'] = $inter_class;
        $this->form_validation->set_rules('class', 'Inter Class', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('inter_class/inter_classEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'id' => $id,
                'class' => $this->input->post('class'),
            );
            $this->Inter_class_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Inter Class updated successfully</div>');
            redirect('inter_class/index');
        }
    }

}

?>