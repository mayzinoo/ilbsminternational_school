<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Meetingminutes extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('file');
        $this->lang->load('message', 'english');
        $this->load->model("Common_model");
        $this->load->model("Meetingminutes_model");
    }

    function index() {
        $this->session->set_userdata('top_menu', 'Teacherdiary');
        $this->session->set_userdata('sub_menu', 'Meetingminutes/index');
        $data['title'] = 'Meeting Minute List';
        $data['teacherlists'] = $this->Common_model->grab_teacher();
        $data['subjectlists'] = $this->Common_model->grab_subject();
        $data['classlists'] = $this->Common_model->grab_class();
        $data['sectionlists'] = $this->Common_model->grab_section();
       
        $data["lists"]=$this->Meetingminutes_model->get();

        $this->load->view('layout/header', $data);
        $this->load->view('teacherdiary/meetingminutesList');
        $this->load->view('layout/footer', $data);
    }


    function createform()
    {
        $this->session->set_userdata('top_menu', 'Teacherdiary');
        $this->session->set_userdata('sub_menu', 'Meetingminutes/index');
        $data['title'] = 'Meeting Minutes Create';
        $data['teacherlists'] = $this->Common_model->grab_teacher();
        $data['subjectlists'] = $this->Common_model->grab_subject();
        $data['classlists'] = $this->Common_model->grab_class();
        $data['sectionlists'] = $this->Common_model->grab_section();
        $this->load->view('layout/header', $data);
        $this->load->view('teacherdiary/meetingminutesCreate');// $data);
        $this->load->view('layout/footer', $data);
    }
    
    
    function editform($id)
    {
        $this->session->set_userdata('top_menu', 'Teacherdiary');
        $this->session->set_userdata('sub_menu', 'Meetingminutes/index');
        $data['title'] = 'Meeting Minutes Create';
        $data['teacherlists'] = $this->Common_model->grab_teacher();
        $data['subjectlists'] = $this->Common_model->grab_subject();
        $data['classlists'] = $this->Common_model->grab_class();
        $data['sectionlists'] = $this->Common_model->grab_section();
        $data["row"]=$this->db->query("SELECT * FROM meetingminutes WHERE id=$id")->row();
        $data["lists"]=$this->db->query("SELECT * FROM meetingminutes_detail WHERE mtm_id='$id'");
        $this->load->view('layout/header', $data);
        $this->load->view('teacherdiary/meetingminutesEdit');// $data);
        $this->load->view('layout/footer', $data);
    }

    function view_detail()
    {
        $id=$this->uri->segment(4);        
        $data["row"]=$this->db->query("SELECT * FROM meetingminutes WHERE id='$id'")->row();
        $data["teachers"]=$this->db->query("SELECT meetingminutes.*,meetingminutes_detail.*, teachers.name as name FROM meetingminutes JOIN meetingminutes_detail ON meetingminutes.id=meetingminutes_detail.mtm_id LEFT JOIN teachers ON meetingminutes_detail.teacher_id=teachers.id WHERE meetingminutes.id='$id'");     
                $error = $this->db->error();
                echo $error["message"];                
        // $data["content"]="meetingminutesDetail";
         $this->load->view('layout/header', $data);
        $this->load->view("teacherdiary/meetingminutesDetail",$data);
        $this->load->view('layout/footer', $data);
    }

    function view($id) {
        $data['title'] = 'Daily Record List';
        $lists = $this->Dailyrecord_model->get($id);
        $data['lists'] = $lists;
        $this->load->view('layout/header', $data);
        $this->load->view('teacherdiary/DailyrecordShow', $data);
        $this->load->view('layout/footer', $data);
    }

    function delete($id) {
        $this->db->where("id",$id);
        $this->db->delete("meetingminutes");
            redirect('teacherdiary/Meetingminutes/index');
    }

    function create() {

        $data['title'] = 'Add Meeting Minutes';    

/*        $this->form_validation->set_rules('teacher', 'Teacher Name', 'trim|required|xss_clean');
*/        
        
        $this->form_validation->set_rules('date', 'Date', 'required');
        $this->form_validation->set_rules('place', 'Place', 'required');
        $this->form_validation->set_rules('approved_by', 'Approved By', 'required');

        if ($this->form_validation->run() == FALSE) {
        redirect("teacherdiary/Meetingminutes/createform");
        }
        
        else {
           
           $date=date("Y-m-d",strtotime($this->input->post("date")));
           $opening_time=$this->input->post("opening_time");
           $closing_time=$this->input->post("closing_time");
           $place=$this->input->post("place");
           $prepared_by=$this->input->post("prepared_by");
           $approved_by=$this->input->post("approved_by");
           $description=$this->input->post("description");
           
            $data = array(
                'opening_time' => $opening_time,
                'closing_time' => $closing_time,
                'place' => $place,
                'prepared_by'=>$prepared_by,
                'approved_by'=>$approved_by,
                'date'=>$date,
                'description'=>$description
            );

            $qry=$this->db->insert("meetingminutes",$data);
            $id=$this->db->insert_id();
           
            $count=count($this->input->post("teacher"));
            $teacher=$this->input->post("teacher");
            // $sign=$this->input->post("sign");
            $sign=$this->input->post("sign");
            
            for($i=0;$i<$count;$i++)
            {
                $data2=array(
                            "mtm_id"=>$id,
                            "teacher_id" => $teacher[$i],
                            "sign"=>$sign[$i]
                    );
                $this->db->insert("meetingminutes_detail",$data2);
            }


            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Meeting Minutes added successfully</div>');
            redirect('teacherdiary/Meetingminutes/createform');
        }
    }

    function edit($id) {
        $data['title'] = 'Edit Meeting Minutes';
         $data['teacherlists'] = $this->Common_model->grab_teacher();
        $data['subjectlists'] = $this->Common_model->grab_subject();
        $data['classlists'] = $this->Common_model->grab_class();
        $data['sectionlists'] = $this->Common_model->grab_section();
       
        $this->form_validation->set_rules('date', 'Date', 'trim|required|xss_clean');
        $this->form_validation->set_rules('place', 'Place', 'trim|required|xss_clean');
        $this->form_validation->set_rules('approved_by', 'Approved By', 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('teacherdiary/meetingminutesEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {
            
           $date=date("Y-m-d",strtotime($this->input->post("date")));
           $opening_time=$this->input->post("opening_time");
           $closing_time=$this->input->post("closing_time");
           $place=$this->input->post("place");
           $prepared_by=$this->input->post("prepared_by");
           $approved_by=$this->input->post("approved_by");
           $description=$this->input->post("description");
           
            $data = array(
                'opening_time' => $opening_time,
                'closing_time' => $closing_time,
                'place' => $place,
                'prepared_by'=>$prepared_by,
                'approved_by'=>$approved_by,
                'date'=>$date,
                'description'=>$description
            );
            
        $this->db->where("id",$id);    
        $qry=$this->db->update("meetingminutes",$data);
        if($qry)
        {
            $this->db->where("mtm_id",$id)->delete("meetingminutes_detail");
        }

            $count=count($this->input->post("teacher"));
            $teacher=$this->input->post("teacher");
            // $sign=$this->input->post("sign");
            $sign=$this->input->post("sign");
            
            for($i=0;$i<$count;$i++)
            {
                $data2=array(
                            "mtm_id"=>$id,
                            "teacher_id" => $teacher[$i],
                            "sign"=>$sign[$i]
                    );
                $this->db->insert("meetingminutes_detail",$data2);
            }


            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Meeting Minutes updated successfully</div>');
            redirect('teacherdiary/Meetingminutes');
        }
    }

}

?>