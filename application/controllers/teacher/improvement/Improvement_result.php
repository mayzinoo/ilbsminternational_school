<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Improvement_result extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('file');
        $this->lang->load('message', 'english');
        $this->load->library('Customlib');
        $this->load->model("Improvement_model");
        $this->load->model("Improvement_result_model");
        $this->load->model("Common_model");
		$this->load->model("Student_model");

    }

    function index() {
        $this->session->set_userdata('top_menu', 'Improvement');
        $this->session->set_userdata('sub_menu', 'Improvement_result/index');
           $class = $this->class_model->get();
        $data['classlist'] = $class;
        $data['title'] = 'Add Improvement Result';
        $data['title_list'] = 'Recent Improvements Result';       
        $improvementdesc_result = $this->Improvement_result_model->get();
        $data['resultlist'] = $improvementdesc_result;        
        $this->load->view('layout/teacher/header', $data);
        $this->load->view('teacher/improvement/Improvement_result', $data);
        $this->load->view('layout/teacher/footer', $data);
    }


     function search_student() {
    	
		$this->session->set_userdata('top_menu', 'Improvement Result');
        $this->session->set_userdata('sub_menu', 'Improvement_result/index');
        $data['title'] = 'Improvement Result List';
		$class=$this->input->post("class");
		$section=$this->input->post("section");
        $data['teacherlists'] = $this->Common_model->grab_teacher();
        $data['grades'] = array(3=>"ေကာင္း",2=>"သင့္",1=>"လို");
        $data['classlists'] = $this->Common_model->grab_class();
        $data['sectionlists'] = $this->Common_model->grab_section();
        $data['lessons'] = $this->Common_model->grab_improvementdesc();
        $data["class"]=$class;
        $data["section"]=$section;

        $resultlist =  $this->student_model->searchClassSection($class,$section);
        $data['resultlist'] = $resultlist;
        $this->load->view('layout/teacher/header', $data);
        $this->load->view('teacher/improvement/Improvement_resultCreate');// $data);
        $this->load->view('layout/teacher/footer', $data);
    }


     function search_result() {
        $this->session->set_userdata('top_menu', 'Improvement');
        $this->session->set_userdata('sub_menu', 'Improvement_result/index');
           $class = $this->class_model->get();
        $data['classlist'] = $class;
        $data['title'] = 'Add Improvement Result';
        $data['title_list'] = 'Recent Improvements Result';       
        $improvementdesc_result = $this->Improvement_result_model->get();
        $data['resultlist'] = $improvementdesc_result;        
        $this->load->view('layout/teacher/header', $data);
        $this->load->view('teacher/improvement/Improvement_result', $data);
        $this->load->view('layout/teacher/footer', $data);
    }


     function lower() {
        $this->session->set_userdata('top_menu', 'Improvement');
        $this->session->set_userdata('sub_menu', 'Improvement_result/index');
        $data['title'] = 'Add Improvement Result';
        $data['title_list'] = 'Recent Improvements Result';       
        $improvementdesc_result = $this->Improvement_result_model->get('lower');
        $data['lists'] = $improvementdesc_result;        
        $this->load->view('layout/teacher/header', $data);
        $this->load->view('teacher/improvement/Improvement_result', $data);
        $this->load->view('layout/teacher/footer', $data);
    }


    function createform()
    {
        $this->session->set_userdata('top_menu', 'Improvement Result');
        $this->session->set_userdata('sub_menu', 'Improvement_result/index');
        $data['title'] = 'Improvement Result List';
        $data['teacherlists'] = $this->Common_model->grab_teacher();
        $data['grades'] = array(3=>"ေကာင္း",2=>"သင့္",1=>"လို");
        $data['classlists'] = $this->Common_model->grab_class();
        $data['sectionlists'] = $this->Common_model->grab_section();
        $data['lessons'] = $this->Common_model->grab_improvementdesc();
        $resultlist = $this->student_model->get();
        $data['resultlist'] = $resultlist;
        $this->load->view('layout/teacher/header', $data);
        $this->load->view('teacher/improvement/Improvement_resultCreate');// $data);
        $this->load->view('layout/teacher/footer', $data);
    }

    function view($id) {
        $data['title'] = 'Improvement Result List';
        $lists = $this->Improvement_model->get($id);
        $data['lists'] = $lists;
        $this->load->view('layout/teacher/header', $data);
        $this->load->view('teacher/improvement/Improvement_resultShow', $data);
        $this->load->view('layout/teacher/footer', $data);
    }

    function delete($id) {
        $data['title'] = 'Improvement Description List';
        $this->Improvement_model->remove($id);
    redirect('teacher/improvement/improvementdesc/index');
    }

    

    function create() {
		


 		$this->session->set_userdata('top_menu', 'Improvement');
        $this->session->set_userdata('sub_menu', 'Improvement_result/index');
        $data['title'] = 'Add Improvement Result';
        $data['title_list'] = 'Recent Improvements Result'; 
		$data['teacherlists'] = $this->Common_model->grab_teacher();
        $data['grades'] = array(3=>"ေကာင္း",2=>"သင့္",1=>"လို");
        $data['classlists'] = $this->Common_model->grab_class();
        $data['sectionlists'] = $this->Common_model->grab_section();
        $data['lessons'] = $this->Common_model->grab_improvementdesc();
		 $resultlist = $this->student_model->get();
        $data['resultlist'] = $resultlist; 
     	 $this->form_validation->set_rules('class_id[]', 'Class', 'trim|required|xss_clean');
     	 $this->form_validation->set_rules('section_id[]', 'Section', 'trim|required|xss_clean');
     	 $this->form_validation->set_rules('date', 'Date', 'trim|required|xss_clean');
     	 $this->form_validation->set_rules('teacher_id', 'Teacher', 'trim|required|xss_clean');
     	 $this->form_validation->set_rules('teacher/improvement_id', 'Improvement Title', 'trim|required|xss_clean');
		 
		   if ($this->form_validation->run() == FALSE) {

            $this->load->view('layout/teacher/header', $data);
            $this->load->view('teacher/improvement/Improvement_resultCreate', $data);
            $this->load->view('layout/teacher/footer', $data);
        } else {

            
            $authority=$this->customlib->getAdminSessionUserName();
            $student_id=$this->input->post("student_id");          
            $class_id=$this->input->post("class_id");
            $grades=$this->input->post("grades");
            $section_id=$this->input->post("section_id");
            $teacher_id=$this->input->post("teacher_id");
            $improvement_id=$this->input->post("improvement_id");
            $date=date("Y-m-d",strtotime($this->input->post("date")));			

            for($i=0;$i<count($student_id);$i++)
            {
                $arr=array(
                            "class_id"=>$class_id[$i],
                            "section_id"=>$section_id[$i],
                            "student_id"=>$student_id[$i],
                            "grade"=>$grades[$i],
                            'teacher_id' => $teacher_id,
                            'improvement_id' => $improvement_id,
                            'authority' => $authority,
                            'created_at' => $date

                    );

                $this->db->insert("improvement_result",$arr);
            }
			
			          $dbError = $this->db->error();
					  echo $dbError['message'];


          $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Improvement Results added successfully</div>');
          redirect('teacher/improvement/Improvement_result');
		}
    }



    function edit($id) {


       $data['title'] = 'Add Improvement Description';

        $data['id'] = $id;
        $improvement = $this->Improvement_model->get($id);
        $data['lists'] = $improvement;

        $this->form_validation->set_rules('lesson_title', 'lesson_title', 'trim|required|xss_clean');
        $this->form_validation->set_rules('description[]', 'description', 'trim|required|xss_clean');



        if ($this->form_validation->run() == FALSE) {

            $this->load->view('layout/teacher/header', $data);
            $this->load->view('teacher/improvement/improvementdescEdit', $data);
            $this->load->view('layout/teacher/footer', $data);
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
            redirect('teacher/improvement/Improvementdesc/index');
        }
    }

}

?>