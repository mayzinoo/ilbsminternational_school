<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class adminuser extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('file');
        $this->lang->load('message', 'english');
    }

    function index() {
        $this->session->set_userdata('top_menu', 'users');
        $this->session->set_userdata('sub_menu', 'adminusers/index');
        $data['title'] = 'Admin User';
        $adminuser_result = $this->admin_model->get();
        $data["school"]=$this->Common_model->grab_school();

        $data['adminlist'] = $adminuser_result;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/adminuser/adminuserList', $data);
        $this->load->view('layout/footer', $data);
    }

    function delete($id) {
        $data['title'] = 'Admin User List';
        $this->admin_model->remove($id);
        redirect('admin/adminuser/index');
    }

    function create() {
        $data['title'] = 'Add Admin User';
        $adminuser_result = $this->admin_model->get();
        $data["school"]=$this->Common_model->grab_school();

        $data['adminlist'] = $adminuser_result;
        $this->form_validation->set_rules('username', 'Admin Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/adminuser/adminuserList', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'username' => $this->input->post('username'),
                'school' => $this->input->post('school'),
                'email' => $this->input->post('email'),
                'password' => md5($this->input->post('password')),
                'role' => 'admin',
                'is_active' => 'yes'
            );
            $this->admin_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Admin user added successfully</div>');
            redirect('admin/adminuser/index');
        }
    }

}

?>