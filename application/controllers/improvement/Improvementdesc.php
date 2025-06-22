<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Improvementdesc extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('file');
        $this->lang->load('message', 'english');
        $this->load->library('Customlib');
        $this->load->model("Improvement_model");

    }

    function index() {
        $this->session->set_userdata('top_menu', 'Improvement');
        $this->session->set_userdata('sub_menu', 'Improvementdesc/index');
        $data['title'] = 'Add Improvement Description';
        $data['title_list'] = 'Recent Improvements Description';       
        $improvementdesc_result = $this->Improvement_model->get();
        $data['lists'] = $improvementdesc_result;        
        $this->load->view('layout/header', $data);
        $this->load->view('improvement/improvementdescList', $data);
        $this->load->view('layout/footer', $data);
    }

    function kgdescriptionlist() {
        $this->session->set_userdata('top_menu', 'Improvement');
        $this->session->set_userdata('sub_menu', 'Improvementdesc/index');
        $data['title'] = 'Add Improvement Description';
        $data['title_list'] = 'Recent Improvements Description';       
        $improvementdesc_result = $this->Improvement_model->get_kgdesc();
        $data['lists'] = $improvementdesc_result;        
        $this->load->view('layout/header', $data);
        $this->load->view('improvement/kgdescList', $data);
        $this->load->view('layout/footer', $data);
    }
    
    function createform()
    {
        $this->session->set_userdata('top_menu', 'Improvement Description');
        $this->session->set_userdata('sub_menu', 'Improvement Description/index');
        $data['title'] = 'Improvement Description List';
      
        $this->load->view('layout/header', $data);
        $this->load->view('improvement/improvementdescCreate');// $data);
        $this->load->view('layout/footer', $data);
    }
    function kgcreateform()
    {
        $this->session->set_userdata('top_menu', 'Improvement Description');
        $this->session->set_userdata('sub_menu', 'Improvement Description/index');
        $data['title'] = 'Improvement Description List';
      
        $this->load->view('layout/header', $data);
        $this->load->view('improvement/kgimprovementdescCreate');// $data);
        $this->load->view('layout/footer', $data);
    }
    function view($id) {
        $data['title'] = 'Improvement Description List';
        $lists = $this->Improvement_model->get($id);
        $data['lists'] = $lists;
        $this->load->view('layout/header', $data);
        $this->load->view('improvement/improvementdescShow', $data);
        $this->load->view('layout/footer', $data);
    }

    function delete($id) {
        $data['title'] = 'Improvement Description List';
        $this->Improvement_model->remove($id);
    redirect('improvement/improvementdesc/index');
    }

    function create() {

 
        $data['title'] = 'Add Improvement Description';
      $this->form_validation->set_rules('lesson_title', 'lesson_title', 'trim|required|xss_clean');
      $this->form_validation->set_rules('rank', 'rank', 'trim|required|xss_clean');
      $this->form_validation->set_rules('description[]', 'description', 'trim|required|xss_clean');



        if ($this->form_validation->run() == FALSE) {

            $this->load->view('layout/header', $data);
            $this->load->view('improvement/improvementdescList', $data);
            $this->load->view('layout/footer', $data);
        } else {
            
            $data = array(
                'lessontitle' => $this->input->post('lesson_title'),
                'rank' => $this->input->post('rank'),
                'created_at' => date("Y-m-d",strtotime($this->input->post('date')))
            );

            $header_id=$this->Improvement_model->add($data);

          
            $description=$this->input->post("description");

            for($i=0;$i<count($description);$i++)
            {
                $data=array(
                            "header_id"=>$header_id,
                            "description"=>$description[$i],
                    );
                $this->db->insert("improvement_detail",$data);
            }
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Improvement Description added successfully</div>');
            redirect('improvement/Improvementdesc/index');
        }
    }
    function kgdesccreate() {
        
        $data['title'] = 'Add KG Improvement Description';
      $this->form_validation->set_rules('lesson_title', 'lesson_title', 'trim|required|xss_clean');
      $this->form_validation->set_rules('rank', 'rank', 'trim|required|xss_clean');
      $this->form_validation->set_rules('description[]', 'description', 'trim|required|xss_clean');

      $lessontitle=$this->input->post('lesson_title');
      $data = array(
                'lessontitle' => $lessontitle,
               
                'created_at' => date("Y-m-d")
            );
            $this->db->insert('kgimprovement', $data);
            
            $header_id=$this->db->insert_id();
            
            $description=$this->input->post("description");

            for($i=0;$i<count($description);$i++)
            {
                $desdata=array(
                        "header_id"=>$header_id,
                        "description"=>$description[$i],
                    );
                
                $this->db->insert("kgimprovement_detail",$desdata);
                $msg=$this->db->error();
                echo $msg["message"];
            }

            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Improvement Description added successfully</div>');
            redirect('improvement/improvementdesc/kgdescriptionlist');
        
    }
    function edit($id) {


       $data['title'] = 'Add Improvement Description';

        $data['id'] = $id;
        $improvement = $this->Improvement_model->get($id);
        $data['lists'] = $improvement;

        $this->form_validation->set_rules('lesson_title', 'lesson_title', 'trim|required|xss_clean');
        $this->form_validation->set_rules('description[]', 'description', 'trim|required|xss_clean');



        if ($this->form_validation->run() == FALSE) {

            $this->load->view('layout/header', $data);
            $this->load->view('improvement/improvementdescEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {


            
            $data = array(
                'id' => $id,
                'lessontitle' => $this->input->post('lesson_title'),
                'rank' => $this->input->post('rank'),
                'created_at' => date("Y-m-d",strtotime($this->input->post('date')))
            );

        
            $this->Improvement_model->add($data);


           $this->db->where("header_id",$id)->delete("improvement_detail");



            $description=$this->input->post("description");

            for($i=0;$i<count($description);$i++)
            {
                $data=array(
                            "header_id"=>$id,
                            "description"=>$description[$i],
                    );

                $this->db->insert("improvement_detail",$data);
            }





            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Improvement Description added successfully</div>');
            redirect('improvement/improvementdesc/index');
        }
    }
    
    function kgedit($id) {


       $data['title'] = 'Add Improvement Description';

        $data['id'] = $id;
        $improvement = $this->Improvement_model->get($id);
        $data['lists'] = $improvement;

        $this->form_validation->set_rules('lesson_title', 'lesson_title', 'trim|required|xss_clean');
        $this->form_validation->set_rules('description[]', 'description', 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {

            $this->load->view('layout/header', $data);
            $this->load->view('improvement/kgimprovementdescEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {

            $data = array(
                'id' => $id,
                'lessontitle' => $this->input->post('lesson_title'),
                
                'created_at' => date("Y-m-d",strtotime($this->input->post('date')))
            );

        
            $this->Improvement_model->add($data);


           $this->db->where("header_id",$id)->delete("kgimprovement_detail");



            $description=$this->input->post("description");

            for($i=0;$i<count($description);$i++)
            {
                $data=array(
                            "header_id"=>$id,
                            "description"=>$description[$i],
                    );

                $this->db->insert("improvement_detail",$data);
            }





            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Improvement Description added successfully</div>');
            redirect('improvement/improvementdesc/index');
        }
    }

}

?>