<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Examresult extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('file');
        $this->lang->load('message', 'english');
        $this->load->model('Exam_model');
    }
    
    function index() {
        
        // $this->db->select("exam_location.*");
        // $this->db->join("sch_settings","sch_settings.id=exam_location.school","left");
        // $data["results"]=$this->db->get("exam_location");
        
        $this->db->select("exam_location.*,sch_settings.name as sch_name");                             
        $this->db->join("sch_settings","exam_location.school=sch_settings.id");
       	$data["examresults"]=$this->db->get("exam_location");
        
        $this->load->view('layout/header', $data);
        $this->load->view('admin/examresult/resultlist', $data);
        $this->load->view('layout/footer', $data);
        
        }    
    function result_create(){
       $this->session->set_userdata('top_menu', 'Improvement Result');
        $this->session->set_userdata('sub_menu', 'Improvement_result/index');
        $data['title'] = 'Improvement Result List';
		$class=$this->input->post("class");
		$section=$this->input->post("section");
        $data['teacherlists'] = $this->Common_model->grab_teacher();
        $data['monthlist']= $this->Common_model->grab_month();  
        $data['sessionlists']=$this->Exam_model->getsession();
        $data["school"]=$this->Common_model->grab_school();
        
        $data['grades'] = array(2=>"Pass",1=>"Fail");
        $data['classlists'] = $this->Common_model->grab_class();
        $data['sectionlists'] = $this->Common_model->grab_section();
        $data['lessons'] = $this->Common_model->grab_improvementdesc();
        $data["class"]=$class;
        $data["section"]=$section;
        
        $this->load->view('layout/header', $data);
        $this->load->view('admin/examresult/create', $data);
        $this->load->view('layout/footer', $data);
    }
    function search_student() {
    	
		$this->session->set_userdata('top_menu', 'Improvement Result');
        $this->session->set_userdata('sub_menu', 'Improvement_result/index');
        $data['title'] = 'Improvement Result List';
		$class=$this->input->post("class");
		$section=$this->input->post("section");
        $data['teacherlists'] = $this->Common_model->grab_teacher();
        $data['monthlist']= $this->Common_model->grab_month();  
        $data['sessionlists']=$this->Exam_model->getsession();
        $data["school"]=$this->Common_model->grab_school();
        
        $data['grades'] = array(2=>"Pass",1=>"Fail");
        $data['classlists'] = $this->Common_model->grab_class();
        $data['sectionlists'] = $this->Common_model->grab_section();
        $data['lessons'] = $this->Common_model->grab_improvementdesc();
        $data["class"]=$class;
        $data["section"]=$section;
        $this->session->set_userdata('section', $section);
        $this->session->set_userdata('class', $class);

        $resultlist =  $this->student_model->searchClassSection($class,$section);
        $data['resultlist'] = $resultlist;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/examresult/create');// $data);
        $this->load->view('layout/footer', $data);
    }
    function result_insert()
    {
        $session=$this->input->post("session");
        $division=$this->input->post("division");
        $district=$this->input->post("district");
        $township=$this->input->post("township");
        $school=$this->input->post("school");
        
        $class=$this->input->post("class");
        $section=$this->input->post("section");
        $seat_no=$this->input->post("seat_no");
        $admission_no=$this->input->post("admission_no");
        $student=$this->input->post("student");
        $father=$this->input->post("father");
        $remark=$this->input->post("remark");
        $grades=$this->input->post("grades");
        
        // echo count($student);exit;
        // echo $session;exit;
        $locationdata=array(
            "session"=>$session,
            "division"=>$division,
            "district"=>$district,
            "township"=>$township,
            "school"=>$school
            );
        $this->db->insert("exam_location",$locationdata);
        $id=$this->db->insert_id();
        
        for($i=0;$i<count($admission_no);$i++){
            $result=array(
                "session"=>$session,
                "examlocation_id"=>$id,
                "seat_no"=>$seat_no[$i],
                "admission_no"=>$admission_no[$i],
                "class"=>$class,
                "section"=>$section,
                "name"=>$student[$i],
                "father_name"=>$father[$i],
                "result"=>$grades[$i],
                "remark"=>$remark[$i]
            );
            $this->db->insert("exam_result_detail",$result);
        }
        redirect("admin/Examresult/index");
    }
    function resultshow()
    {
        $location_id=$this->uri->segment(4);
        $this->db->select("exam_location.*,sch_settings.name as sch_name,sch_settings.image as logo,,sessions.session as year");                            
        $this->db->join("sch_settings","exam_location.school=sch_settings.id");
        $this->db->join("sessions","sessions.id=exam_location.session");
       	$data["location"]=$this->db->get_where("exam_location",array('exam_location.id'=>$location_id))->row();
       	
       	$this->db->select("exam_result_detail.*,students.*");
       	$this->db->join("students","students.id=exam_result_detail.name");
       	
       	$data["examresult"]=$this->db->get_where("exam_result_detail",array("result !="=>1));
       	// echo $data["examresult"]->num_rows();
    //   $er= $this->db->error();
    //   echo $er['message'];
        $this->db->select("exam_result_detail.*,classes.class as clss");
        $this->db->join('classes', 'exam_result_detail.class = classes.id');
        $data["studata"]=$this->db->get_where("exam_result_detail",array("examlocation_id"=>$location_id))->row();
        
        $data["scho_logo"]=$this->db->get("sch_settings ")->row();
       	
        $this->load->view("admin/examresult/show",$data);
    }
    function print_resultshow()
    {
        $location_id=$this->uri->segment(4);
        $this->db->select("exam_location.*,sch_settings.name as sch_name,sessions.session as year");                            
        $this->db->join("sch_settings","exam_location.school=sch_settings.id");
        $this->db->join("sessions","sessions.id=exam_location.session");
       	$row=$this->db->get_where("exam_location",array('exam_location.id'=>$location_id))->row();
       	
       	$data['location']=$row;
		    
       	$this->db->select("exam_result_detail.*,students.*,classes.class as cls");
       	$this->db->join("students","students.id=exam_result_detail.name");
       	$this->db->join("classes","classes.id=exam_result_detail.class");
        $this->db->join("sections","sections.id=exam_result_detail.section");
       	$data["studentdata"]=$this->db->get_where("exam_result_detail",array("result !="=>1))->row();
       	
       	$this->db->select("exam_result_detail.*,students.*");
       	$this->db->join("students","students.id=exam_result_detail.name");
       	
       	$data["examresult"]=$this->db->get_where("exam_result_detail",array("result !="=>1));
       	// echo $data["examresult"]->num_rows();
    //   $er= $this->db->error();
    //   echo $er['message'];
        // $data["schlogo"]=$this->db->query("Select image From sch_settings")->row();
        $data["scho_logo"]=$this->db->get("sch_settings ")->row();
        
       	
        // $this->load->view("admin/examresult/show",$data);
        
        $pdf_view=$this->load->view('admin/examresult/show_print',$data, true);
    	$pdfFilePath = 'Result-'.'.pdf';
    	$this->load->library('m_pdf');
    	$this->m_pdf->pdf->WriteHTML($pdf_view);
    	$this->m_pdf->pdf->Output($pdfFilePath, "I");	
    }
}