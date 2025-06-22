<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Improvement_result extends Admin_Controller {

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
         
        $this->db->select("improvement_result.*,teachers.name as tname,classes.class,sections.section,improvement.lessontitle,reportcard_month.name as rpmonth");
       $this->db->join("improvement",'improvement_result.improvement_id=improvement.id');
       $this->db->join("reportcard_month",'reportcard_month.id=improvement_result.reportcard_month');
       $this->db->join("teachers",'improvement_result.teacher_id=teachers.id');
       $this->db->join("classes",'improvement_result.class_id=classes.id');
       $this->db->join("sections",'improvement_result.section_id=sections.id');  
       $this->db->order_by('improvement_result.created_at',"DESC");
       $this->db->group_by("improvement_result.improvement_id");

        $data['resultlist'] =$this->db->get("improvement_result");
        
        $this->load->view('layout/header', $data);
        $this->load->view('improvement/Improvement_result', $data);
        $this->load->view('layout/footer', $data);
    }
    function reportcard_month()
    {
        $this->session->set_userdata('top_menu', 'Improvement');
        $this->session->set_userdata('sub_menu', 'Improvement_result/reportcard_month');
        $data['monthlist']= $this->Common_model->grab_month();  
        $data['class_level'] = array(1=>"Pre School",2=>"KG School",3=>"Primary School"); 
        
        $data["resultlist"]=$this->db->get("reportcard_month");
        $this->load->view('layout/header', $data);
        $this->load->view('improvement/improvement_month');
        $this->load->view('layout/footer', $data);
        
    }
    function rpcardmonth_insert()
    {
        $month=$this->input->post("month");
        $class_level=$this->input->post("class_level");
        $cur_session=$this->setting_model->getCurrentSessionName();
        
        if($class_level=="1"){
            $data=array(
            "Pre_status" =>1,
            "sesion_id"=>$cur_session,
            "updated_at"=>date("Y-m-d")
            );
        }
        elseif($class_level=="2"){
            $data=array(
            "KG_status" =>1,
            "sesion_id"=>$cur_session,
            "updated_at"=>date("Y-m-d")
            );
        }
        elseif($class_level=="3"){
            $data=array(
            "Primary_status" =>1,
            "sesion_id"=>$cur_session,
            "updated_at"=>date("Y-m-d")
            );
        }
        
        
		$this->db->where('id',$month);
		$this->db->update("reportcard_month",$data);
		
		redirect("improvement/improvement_result/reportcard_month");
        
    }
   
    function kgimpro_result_index() {
        $this->session->set_userdata('top_menu', 'Improvement');
        $this->session->set_userdata('sub_menu', 'Improvement_result/kgimpro_result_index');
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $data['title'] = 'Add KG Improvement Result';
        $data['title_list'] = 'Recent Improvements Result';       
        $kgimprovementdesc_result = $this->Improvement_result_model->get_kgresult();
        // $data['resultlist'] = $kgimprovementdesc_result;       
        $this->db->select("kgimprovement_result.*,classes.class as cls,sections.section,teachers.name as teacher,kgimprovement.*,kgimprovement_result.created_at as date,kgimprovement_detail.description");
        $this->db->join("kgimprovement_detail",'kgimprovement_detail.id=kgimprovement_result.description_id');
        $this->db->join("classes",'kgimprovement_result.class_id=classes.id');
        $this->db->join("sections",'kgimprovement_result.section_id=sections.id'); 
        $this->db->join("teachers",'kgimprovement_result.teacher_id=teachers.id');
        $this->db->join("kgimprovement",'kgimprovement_result.improvement_id=kgimprovement.id');
        
        $this->db->group_by("kgimprovement_result.improvement_id");
        $data['resultlist'] = $this->db->get("kgimprovement_result");
        
        // echo $this->db->last_query();exit;
        $this->load->view('layout/header', $data);
        $this->load->view('improvement/kgImprovement_result');
        $this->load->view('layout/footer', $data);
    }
    function primary_result_index() {
        $this->session->set_userdata('top_menu', 'Improvement');
        $this->session->set_userdata('sub_menu', 'Improvement_result/primary_result_index');
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $data['title'] = 'Add KG Improvement Result';
        $data['title_list'] = 'Recent Improvements Result';       
        $kgimprovementdesc_result = $this->Improvement_result_model->get_primaryresult();
        // $data['resultlist'] = $kgimprovementdesc_result;     
        $this->db->select("primary_result.*,reportcard_month.name as rpmonth,students.firstname,students.lastname,students.admission_no,classes.class,sections.section,subjects.name as subname");
        // $this->db->join("teachers",'primary_result.teacher_id=teachers.id');
        $this->db->join("students",'primary_result.student_id=students.id');
        $this->db->join("classes",'primary_result.class_id=classes.id');
        $this->db->join("sections",'primary_result.section_id=sections.id');  
        $this->db->join("subjects",'primary_result.subject_id=subjects.id'); 
        $this->db->join("reportcard_month",'primary_result.reportcard_month=reportcard_month.id'); 
        $this->db->group_by("primary_result.subject_id,primary_result.reportcard_month,primary_result.class_id");
        $data['resultlist'] = $this->db->get("primary_result");
        
        $this->load->view('layout/header', $data);
        $this->load->view('improvement/primary_result');
        $this->load->view('layout/footer', $data);
    }
     function search_student() {
    	
		$this->session->set_userdata('top_menu', 'Improvement Result');
        $this->session->set_userdata('sub_menu', 'Improvement_result/index');
        $data['title'] = 'Improvement Result List';
		$class=$this->input->post("class");
		$section=$this->input->post("section");
		$school=$this->input->post("school");
        $data['teacherlists'] = $this->Common_model->grab_teacher();
        $data['monthlist']= $this->Common_model->grab_month();  
        
        $data['grades'] = array(3=>"ေကာင္း",2=>"သင့္",1=>"လို");
        $data['classlists'] = $this->Common_model->grab_class();
        $data['sectionlists'] = $this->Common_model->grab_section();
        $data["school"]=$this->Common_model->grab_school(); 
        $data['lessons'] = $this->Common_model->grab_improvementdesc();
        $data["class"]=$class;
        $data["section"]=$section;
        $this->session->set_userdata('section', $section);
        $this->session->set_userdata('class', $class);

        $resultlist =  $this->student_model->searchClassSection($class,$section,$school);
        $data['resultlist'] = $resultlist;
        $this->load->view('layout/header', $data);
        $this->load->view('improvement/Improvement_resultCreate');// $data);
        $this->load->view('layout/footer', $data);
    }
    function search_primarystudent() {
    	
		$this->session->set_userdata('top_menu', 'Improvement Result');
        $this->session->set_userdata('sub_menu', 'Improvement_result/index');
        $data['title'] = 'Improvement Result List';
		$class=$this->input->post("class");
		$section=$this->input->post("section");
		$school=$this->input->post("school");
        $data['teacherlists'] = $this->Common_model->grab_teacher();
        $data['monthlist']= $this->Common_model->primary_month();  
        
        $data['grades'] = array(1=>"A",2=>"B",3=>"C");
        $data['examtime'] = array(1=>"ပ",2=>"ဒု",3=>"တ",4=>"စ");
        $data['classlists'] = $this->Common_model->grab_class();
        $data['sectionlists'] = $this->Common_model->grab_section();
        $data["school"]=$this->Common_model->grab_school(); 
        $data['subject'] = $this->Common_model->grab_primarysubject();
        $data["class"]=$class;
        $data["section"]=$section;
        $this->session->set_userdata('section', $section);
        $this->session->set_userdata('class', $class);

        $resultlist =  $this->student_model->searchClassSection($class,$section,$school);
        $data['resultlist'] = $resultlist;
        $this->load->view('layout/header', $data);
        $this->load->view('improvement/primary_resultCreate');// $data);
        $this->load->view('layout/footer', $data);
    }
    
    function search_kgstudent() {
    	
		$this->session->set_userdata('top_menu', 'Improvement Result');
        $this->session->set_userdata('sub_menu', 'Improvement_result/index');
        $data['title'] = 'Improvement Result List';
		$class=$this->input->post("class");
		$section=$this->input->post("section");
		$school=$this->input->post("school");
        $data['teacherlists'] = $this->Common_model->grab_teacher();
        $data['monthlist']= $this->Common_model->kg_month();  
        
        $data['grades'] = array(1=>"စတင္ေလ့လာ",2=>"ေကာင္းစြာေလ့လာ",3=>"တိုးတက္မႈရွိ",4=>"သင္ယူၿပီးေၿမာက္");
        $data['classlists'] = $this->Common_model->grab_class();
        $data['sectionlists'] = $this->Common_model->grab_section();
        $data["school"]=$this->Common_model->grab_school(); 
        $data['lessons'] = $this->Common_model->grab_kgimprovementdesc();
        $data["class"]=$class;
        $data["section"]=$section;
        $this->session->set_userdata('section', $section);
        $this->session->set_userdata('class', $class);

        $resultlist =  $this->student_model->searchClassSection($class,$section,$school);
        $data['resultlist'] = $resultlist;
        $this->load->view('layout/header', $data);
        $this->load->view('improvement/kgImprovement_resultCreate');// $data);
        $this->load->view('layout/footer', $data);
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
          

        $this->load->view('layout/header', $data);
        $this->load->view('improvement/Improvement_result', $data);
        $this->load->view('layout/footer', $data);
    }


     function lower() {
        $this->session->set_userdata('top_menu', 'Improvement');
        $this->session->set_userdata('sub_menu', 'Improvement_result/index');
        $data['title'] = 'Add Improvement Result';
        $data['title_list'] = 'Recent Improvements Result';       
        $improvementdesc_result = $this->Improvement_result_model->get('lower');
        $data['lists'] = $improvementdesc_result;        
        $this->load->view('layout/header', $data);
        $this->load->view('improvement/Improvement_result', $data);
        $this->load->view('layout/footer', $data);
    }

    function createform()
    {
       $this->session->set_userdata('top_menu', 'Improvement');
        $this->session->set_userdata('sub_menu', 'Improvement_result/index');
        $data['teacherlists'] = $this->Common_model->grab_teacher();
        $data['monthlist']= $this->Common_model->grab_month();     
        $data['grades'] = array(3=>"ေကာင္း",2=>"သင့္",1=>"လို");
        $data['classlists'] = $this->Common_model->grab_class();
        $data['sectionlists'] = $this->Common_model->grab_section();
        $data["school"]=$this->Common_model->grab_school(); 
        $data['lessons'] = $this->Common_model->grab_improvementdesc();
      //  $resultlist = $this->student_model->get();
        $data['resultlist'] = "";
        $this->load->view('layout/header', $data);
        $this->load->view('improvement/Improvement_resultCreate');// $data);
        $this->load->view('layout/footer', $data);
    }
    function kgresult_createform()
    {
       $this->session->set_userdata('top_menu', 'Improvement');
        $this->session->set_userdata('sub_menu', 'Improvement_result/index');
        $data['teacherlists'] = $this->Common_model->grab_teacher();
        $data['monthlist']= $this->Common_model->grab_month();     
        $data['grades'] = array(1=>"စတင္ေလ့လာ",2=>"ေကာင္းစြာေလ့လာ",3=>"တိုးတက္မႈရွိ",4=>"သင္ယူၿပီးေၿမာက္");
        $data['classlists'] = $this->Common_model->grab_class();
        $data['sectionlists'] = $this->Common_model->grab_section();
        $data["school"]=$this->Common_model->grab_school(); 
        $data['lessons'] = $this->Common_model->grab_kgimprovementdesc();
      //  $resultlist = $this->student_model->get();
        $data['resultlist'] = "";
        $this->load->view('layout/header', $data);
        $this->load->view('improvement/kgImprovement_resultCreate');// $data);
        $this->load->view('layout/footer', $data);
    }
    function primaryresult_createform()
    {
       $this->session->set_userdata('top_menu', 'Improvement');
        $this->session->set_userdata('sub_menu', 'Improvement_result/index');
        $data['teacherlists'] = $this->Common_model->grab_teacher();
        $data['monthlist']= $this->Common_model->grab_month();     
        $data['grades'] = array(1=>"ေကာင္း",2=>"သင့္",3=>"ၾကိဳးစားရန္");
        $data['examtime'] = array(1=>"ပ",2=>"ဒု",3=>"တ",4=>"စ");
        $data['classlists'] = $this->Common_model->grab_class();
        $data['sectionlists'] = $this->Common_model->grab_section();
        $data["school"]=$this->Common_model->grab_school(); 
        $data['subject'] = $this->Common_model->grab_primarysubject();
      //  $resultlist = $this->student_model->get();
        $data['resultlist'] = "";
        $this->load->view('layout/header', $data);
        $this->load->view('improvement/primary_resultCreate');// $data);
        $this->load->view('layout/footer', $data);
    }
    function presch_view()
    {
        $titleid=$this->uri->segment("4");
        $data['title'] = 'Preschool Improvement Result List';
        
       $this->db->select("improvement_result_details.*,teachers.name as tname,classes.class,sections.section,improvement.lessontitle,students.firstname,students.lastname,improvement_result_details.id as preid");
       $this->db->join("improvement_result","improvement_result.improvement_id=$titleid");
       $this->db->join("improvement",'improvement_result.improvement_id=improvement.id');
       $this->db->join("students",'improvement_result_details.student_id=students.id');
       $this->db->join("teachers",'improvement_result.teacher_id=teachers.id');
       $this->db->join("classes",'improvement_result.class_id=classes.id');
       $this->db->join("sections",'improvement_result.section_id=sections.id'); 
       $this->db->where("improvement_result_details.improvement_id",$titleid);
       $data['lists'] = $this->db->get("improvement_result_details");
       
       $this->db->select("improvement_result_details.*,teachers.name as tname,classes.class,sections.section,improvement.lessontitle,students.firstname,students.lastname");
       $this->db->join("improvement_result","improvement_result.improvement_id=$titleid");
       $this->db->join("improvement",'improvement_result.improvement_id=improvement.id');
       $this->db->join("students",'improvement_result_details.student_id=students.id');
       $this->db->join("teachers",'improvement_result.teacher_id=teachers.id');
       $this->db->join("classes",'improvement_result.class_id=classes.id');
       $this->db->join("sections",'improvement_result.section_id=sections.id'); 
       $this->db->where("improvement_result_details.improvement_id",$titleid);
       $data['resultlist'] = $this->db->get("improvement_result_details")->row();
       
        $this->load->view('layout/header', $data);
        $this->load->view('improvement/preImprovement_resultShow', $data);
        $this->load->view('layout/footer', $data);
    }
    function view() {
        $subid=$this->uri->segment("4");
        $data['title'] = 'Improvement Result List';
        // $lists = $this->Improvement_result_model->primaryresult_get();
        $this->db->select("primary_result.*,teachers.name as tname,students.firstname,students.lastname,students.admission_no,classes.class,sections.section,subjects.name as subname");
        $this->db->join("teachers",'primary_result.teacher_id=teachers.id');
        $this->db->join("students",'primary_result.student_id=students.id');
        $this->db->join("classes",'primary_result.class_id=classes.id');
        $this->db->join("sections",'primary_result.section_id=sections.id');  
        $this->db->join("subjects",'primary_result.subject_id=subjects.id');  
        $this->db->where("primary_result.subject_id",$subid);
        $data['lists'] = $this->db->get("primary_result");
        
        $this->db->select("primary_result.*,teachers.name as tname,students.firstname,students.lastname,students.admission_no,classes.class,sections.section,subjects.name as subname");
        $this->db->join("teachers",'primary_result.teacher_id=teachers.id');
        $this->db->join("students",'primary_result.student_id=students.id');
        $this->db->join("classes",'primary_result.class_id=classes.id');
        $this->db->join("sections",'primary_result.section_id=sections.id');  
        $this->db->join("subjects",'primary_result.subject_id=subjects.id');  
        $this->db->where("primary_result.subject_id",$subid);
        $data['resultlist'] = $this->db->get("primary_result")->row();
        
        $this->load->view('layout/header', $data);
        $this->load->view('improvement/Improvement_resultShow', $data);
        $this->load->view('layout/footer', $data);
    }

    function kgresult_view() {
        $titileid=$this->uri->segment("4");
        $desid=$this->uri->segment("5");
        $data['title'] = 'KG Improvement Result List';
       
        $this->db->select("kgimprovement_result_details.*,students.firstname,students.lastname,classes.class as cls,sections.section,teachers.name as teacher,kgimprovement.*,kgimprovement_result.created_at as date,kgimprovement.lessontitle,reportcard_month.name as rpmonth,kgimprovement_detail.description,kgimprovement_result_details.id as kgid,kgimprovement_result_details.description_id");
        
        $this->db->join("kgimprovement_result",'kgimprovement_result_details.header_id=kgimprovement_result.id');
        
        $this->db->join("kgimprovement_detail","kgimprovement_detail.id=$desid");
        
        $this->db->join("students",'kgimprovement_result_details.student_id=students.id');
        $this->db->join("classes",'kgimprovement_result.class_id=classes.id');
        $this->db->join("sections",'kgimprovement_result.section_id=sections.id');
        $this->db->join("teachers",'kgimprovement_result.teacher_id=teachers.id');
        $this->db->join("kgimprovement",'kgimprovement_result.improvement_id=kgimprovement.id');
        $this->db->join("reportcard_month",'reportcard_month.id=kgimprovement_result_details.reportcard_month');
        
        $this->db->where("kgimprovement_result_details.description_id",$desid);
        $this->db->where("kgimprovement_result_details.improvement_id",$titileid);
        $data['lists'] = $this->db->get("kgimprovement_result_details");
        
        
        $this->db->select("kgimprovement_result_details.*,students.firstname,students.lastname,classes.class as cls,sections.section,teachers.name as teacher,kgimprovement.*,kgimprovement_result.created_at as date,kgimprovement.lessontitle,reportcard_month.name as rpmonth");
        
        $this->db->join("kgimprovement_result",'kgimprovement_result_details.header_id=kgimprovement_result.id');
        $this->db->join("students",'kgimprovement_result_details.student_id=students.id');
        $this->db->join("classes",'kgimprovement_result.class_id=classes.id');
        $this->db->join("sections",'kgimprovement_result.section_id=sections.id');
        $this->db->join("teachers",'kgimprovement_result.teacher_id=teachers.id');
        $this->db->join("kgimprovement",'kgimprovement_result.improvement_id=kgimprovement.id');
        $this->db->join("reportcard_month",'reportcard_month.id=kgimprovement_result_details.reportcard_month');
        
        $this->db->where("kgimprovement_result_details.improvement_id",$titileid);
        $data['resultlist'] = $this->db->get("kgimprovement_result_details")->row();
        
        $this->load->view('layout/header', $data);
        $this->load->view('improvement/kgimprovement_resultShow', $data);
        $this->load->view('layout/footer', $data);
    }
    // function delete($id) {
    //     $data['title'] = 'Improvement Description List';
    //     $this->Improvement_model->remove($id);
    // redirect('improvement/improvementdesc/index');
    // }

    function delete(){
        $id= $this->uri->segment(4);
		$this->Improvement_model->delete("improvement_result",'improvement_id',$id);
		$this->Improvement_model->delete("improvement_result_details",'improvement_id',$id);
		redirect('improvement/Improvement_result');
    }

    function create() {

 		$this->session->set_userdata('top_menu', 'Improvement');
        $this->session->set_userdata('sub_menu', 'Improvement_result/index');
        $data['title'] = 'Add Improvement Result';
        $data['title_list'] = 'Recent Improvements Result'; 
		$data['teacherlists'] = $this->Common_model->grab_teacher();
        $data['monthlist']= $this->Common_model->grab_month();  

        $data['grades'] = array(3=>"ေကာင္း",2=>"သင့္",1=>"လို");
        $data['classlists'] = $this->Common_model->grab_class();
        $data['sectionlists'] = $this->Common_model->grab_section();
        $data['lessons'] = $this->Common_model->grab_improvementdesc();
		$resultlist = $this->student_model->get();
        $data['resultlist'] = $resultlist;
     	$this->form_validation->set_rules('date', 'Date', 'trim|required|xss_clean');
     	$this->form_validation->set_rules('teacher_id', 'Teacher', 'trim|required|xss_clean');
     	$this->form_validation->set_rules('improvement_id', 'Improvement Title', 'trim|required|xss_clean');
		 
		   if ($this->form_validation->run() == FALSE) {

            $this->load->view('layout/header', $data);
            $this->load->view('improvement/Improvement_resultCreate', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $authority=$this->customlib->getAdminSessionUserName();
            $student_id=$this->input->post("student_id");          
            $class=$this->session->userdata("class");
            $grades=$this->input->post("grades");
            $weight=$this->input->post("weight");
            $height=$this->input->post("height");
            $section=$this->session->userdata("section");
            $teacher_id=$this->input->post("teacher_id");
            $improvement_id=$this->input->post("improvement_id");
            $month=$this->input->post("month");
            $date=date("Y-m-d",strtotime($this->input->post("date")));	
            
           
          
               $arr=array(
                            "class_id"=>$class,
                            "section_id"=>$section,
                            'teacher_id' => $teacher_id,
                            'improvement_id' => $improvement_id,
                            'authority' => $authority,
                            'reportcard_month'=>$month,
                            'created_at' => $date
                    );

            $this->db->insert("improvement_result",$arr);
            $header_id=$this->db->insert_id();
           
            
            		

            for($i=0;$i<count($student_id);$i++)
            {
                $arr=array(
                            "header_id"=>$header_id,
                            "student_id"=>$student_id[$i],
                            'improvement_id' => $improvement_id,
                            "grade"=>$grades[$i],
                            "weight"=>$weight,
                            "height"=>$height,
                            'authority' => $authority,
                            'reportcard_month'=>$month,
                            'created_at' => $date

                    );

                $this->db->insert("improvement_result_details",$arr);
            }
			
			     


          $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Improvement Results added successfully</div>');
          redirect('improvement/Improvement_result');
		}
    }

    function primaryresult_create() {
	
 		$this->session->set_userdata('top_menu', 'Improvement');
        $this->session->set_userdata('sub_menu', 'Improvement_result/primary_result_index');
        $data['title'] = 'Add Improvement Result';
        $data['title_list'] = 'Recent Improvements Result'; 
		$data['teacherlists'] = $this->Common_model->grab_teacher();
        $data['monthlist']= $this->Common_model->grab_month();  

        $data['grades'] = array(1=>"ေကာင္း",2=>"သင့္",3=>"ၾကိဳးစားရန္");
        $data['examtime'] = array(1=>"ပ",2=>"ဒု",3=>"တ",4=>"စ");
        $data['subject'] = $this->Common_model->grab_primarysubject();
        $data['classlists'] = $this->Common_model->grab_class();
        $data['sectionlists'] = $this->Common_model->grab_section();
        $data['lessons'] = $this->Common_model->grab_improvementdesc();
		$resultlist = $this->student_model->get();
        $data['resultlist'] = $resultlist; 
     	$this->form_validation->set_rules('date', 'Date', 'trim|required|xss_clean');
     	$this->form_validation->set_rules('teacher_id', 'Teacher', 'trim|required|xss_clean');
     	$this->form_validation->set_rules('improvement_id', 'Improvement Title', 'trim|required|xss_clean');
		 
		
            
            $authority=$this->customlib->getAdminSessionUserName();
            $student_id=$this->input->post("student_id");          
            $class=$this->session->userdata("class");
            $grades=$this->input->post("grades");
            
            $section=$this->session->userdata("section");
            // $teacher_id=$this->input->post("teacher_id");
            $subject=$this->input->post("subject");
            $examtime=$this->input->post("examtime");
            
            // echo $kgdesc;exit;
            $month=$this->input->post("month");
            $date=date("Y-m-d",strtotime($this->input->post("date")));	
            // echo $class;echo "<br/>";
            // echo $section;echo "<br/>";
            // echo $teacher_id;echo "<br/>";
            // echo $subject;echo "<br/>";exit;
            // echo $grades;echo "<br/>";
            // echo $examtime;echo "<br/>";
            // echo $authority;echo "<br/>";
            // echo $month;echo "<br/>";
            // echo $date;echo "<br/>";
            // echo count($student_id);exit;
            for($i=0;$i<count($student_id);$i++)
            {
            $arr=array(
                            'class_id'=>$class,
                            'student_id'=>$student_id[$i],
                            'section_id'=>$section,
                            // 'teacher_id' => $teacher_id,
                            'subject_id' => $subject,
                            'grade'=>$grades[$i],
                            // 'exam_time'=>$examtime,
                            'authority' => $authority,
                            'reportcard_month'=>$month,
                            'created_at' => $date
                    );
            // echo print_r($arr);exit;
            $this->db->insert("primary_result",$arr);
            }    
          $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Improvement Results added successfully</div>');
          redirect('improvement/Improvement_result/search_primarystudent');
		
    }
    function kgresult_create() {
		
 		$this->session->set_userdata('top_menu', 'Improvement');
        $this->session->set_userdata('sub_menu', 'Improvement_result/kgimpro_result_index');
        $data['title'] = 'Add Improvement Result';
        $data['title_list'] = 'Recent Improvements Result'; 
		$data['teacherlists'] = $this->Common_model->grab_teacher();
        $data['monthlist']= $this->Common_model->grab_month();  

        $data['grades'] =  array(1=>"စတင္ေလ့လာ",2=>"ေကာင္းစြာေလ့လာ",3=>"တိုးတက္မႈရွိ",4=>"သင္ယူၿပီးေၿမာက္");
        $data['classlists'] = $this->Common_model->grab_class();
        $data['sectionlists'] = $this->Common_model->grab_section();
        $data['lessons'] = $this->Common_model->grab_improvementdesc();
		$resultlist = $this->student_model->get();
        $data['resultlist'] = $resultlist; 
     	 $this->form_validation->set_rules('date', 'Date', 'trim|required|xss_clean');
     	 $this->form_validation->set_rules('teacher_id', 'Teacher', 'trim|required|xss_clean');
     	 $this->form_validation->set_rules('improvement_id', 'Improvement Title', 'trim|required|xss_clean');
		 
		   if ($this->form_validation->run() == FALSE) {

            $this->load->view('layout/header', $data);
            $this->load->view('improvement/Improvement_resultCreate', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $authority=$this->customlib->getAdminSessionUserName();
            $student_id=$this->input->post("student_id");          
            $class=$this->session->userdata("class");
            $grades=$this->input->post("grades");
            $weight=$this->input->post("weight");
            $height=$this->input->post("height");
            $section=$this->session->userdata("section");
            $teacher_id=$this->input->post("teacher_id");
            $improvement_id=$this->input->post("improvement_id");
            $kgdesc=$this->input->post("kgdesc");
            // echo $kgdesc;exit;
            $month=$this->input->post("month");
            $date=date("Y-m-d",strtotime($this->input->post("date")));	
            
            $arr=array(
                            "class_id"=>$class,
                            "section_id"=>$section,
                            'teacher_id' => $teacher_id,
                            'improvement_id' => $improvement_id,
                            'description_id' => $kgdesc,
                            'authority' => $authority,
                            'reportcard_month'=>$month,
                            'created_at' => $date

                    );

                $this->db->insert("kgimprovement_result",$arr);
                $header_id=$this->db->insert_id();

            for($i=0;$i<count($student_id);$i++)
            {
                $arr=array(
                        // $r=$month[$i]
                        "header_id"=>$header_id,
                        "student_id"=>$student_id[$i],
                        'improvement_id' => $improvement_id,
                        'description_id' => $kgdesc,
                        "grade"=>$grades[$i],
                        'authority' => $authority,
                        'reportcard_month'=>$month,
                        'created_at' => $date
                    );
                
                $this->db->insert("kgimprovement_result_details",$arr);
            }

          $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Improvement Results added successfully</div>');
          redirect('improvement/Improvement_result/search_kgstudent');
		}
    }
    function preedit_show()
    {
        $preid=$this->uri->segment("5");
        $subid=$this->uri->segment("4");
        $data['grades'] = array(3=>"ေကာင္း",2=>"သင့္",1=>"လို");
         
        $this->db->select("improvement_result_details.*,teachers.name as tname,classes.class as cls,sections.section,improvement.lessontitle,students.firstname,students.lastname,improvement_result_details.id as preid,reportcard_month.name as rpmonth");
       $this->db->join("improvement_result","improvement_result.improvement_id=$subid");
       $this->db->join("improvement",'improvement_result.improvement_id=improvement.id');
       $this->db->join("reportcard_month",'reportcard_month.id=improvement_result_details.reportcard_month');
       $this->db->join("students",'improvement_result_details.student_id=students.id');
       $this->db->join("teachers",'improvement_result.teacher_id=teachers.id');
       $this->db->join("classes",'improvement_result.class_id=classes.id');
       $this->db->join("sections",'improvement_result.section_id=sections.id'); 
       $this->db->where("improvement_result_details.id",$preid);
       $data['resultlist'] = $this->db->get("improvement_result_details")->row();
        
        $this->load->view('layout/header', $data);
        $this->load->view('improvement/pre_resultEdit', $data);
        $this->load->view('layout/footer', $data);
    }
    function edit_show()
    {
        $stuid=$this->uri->segment("5");
        $subid=$this->uri->segment("4");
        $data['grades'] = array(1=>"A",2=>"B",3=>"C");
         
        $this->db->select("primary_result.*,teachers.name as tname,students.firstname,students.lastname,students.admission_no,classes.class,sections.section,subjects.name as subname,reportcard_month.name as month");
        $this->db->join("teachers",'primary_result.teacher_id=teachers.id');
        $this->db->join("students",'primary_result.student_id=students.id');
        $this->db->join("classes",'primary_result.class_id=classes.id');
        $this->db->join("sections",'primary_result.section_id=sections.id');  
        $this->db->join("subjects",'primary_result.subject_id=subjects.id');
        $this->db->join("reportcard_month",'primary_result.reportcard_month= reportcard_month.id'); 
        $this->db->where("primary_result.student_id",$stuid);
        $this->db->where("primary_result.subject_id",$subid);
        $data['resultlist'] = $this->db->get("primary_result")->row();
        
        $this->load->view('layout/header', $data);
        $this->load->view('improvement/primary_resultEdit', $data);
        $this->load->view('layout/footer', $data);
    }
    function kgedit_show()
    {
        // $stuid=$this->uri->segment("5");
        // $titleid=$this->uri->segment("4");
        $id=$this->uri->segment("4");
        $desid=$this->uri->segment("5");
        $data['grades'] = array(1=>"A",2=>"B",3=>"C");
         
        $this->db->select("kgimprovement_result_details.*,students.firstname,students.lastname,classes.class as cls,sections.section,teachers.name as teacher,kgimprovement.*,kgimprovement_result.created_at as date,kgimprovement.lessontitle,reportcard_month.name as rpmonth,kgimprovement_detail.description,kgimprovement_result_details.id as kgid");
        
        $this->db->join("kgimprovement_result",'kgimprovement_result_details.header_id=kgimprovement_result.id');
        
        $this->db->join("kgimprovement_detail","kgimprovement_detail.id=$desid");
        
        $this->db->join("students",'kgimprovement_result_details.student_id=students.id');
        $this->db->join("classes",'kgimprovement_result.class_id=classes.id');
        $this->db->join("sections",'kgimprovement_result.section_id=sections.id');
        $this->db->join("teachers",'kgimprovement_result.teacher_id=teachers.id');
        $this->db->join("kgimprovement",'kgimprovement_result.improvement_id=kgimprovement.id');
        $this->db->join("reportcard_month",'reportcard_month.id=kgimprovement_result_details.reportcard_month');
        
        $this->db->where("kgimprovement_result_details.id",$id);
        // $this->db->where("kgimprovement_result_details.improvement_id",$titileid);
        $data['resultlist'] = $this->db->get("kgimprovement_result_details")->row();
        
        $this->load->view('layout/header', $data);
        $this->load->view('improvement/kg_resultEdit', $data);
        $this->load->view('layout/footer', $data);
    }
    function preresult_edit()
    {
        $preid=$this->input->post("preid");
        $subid=$this->input->post("subid");
        $grades=$this->input->post("grades");
        $clsid=$this->input->post("clsid");
        // echo $grades;exit;
        $arr=array(
                    'grade'=>$grades,
                    'updated_at'=>date("Y-m-d")
                );
        $this->db->where("id",$preid);
        
        $this->db->update("improvement_result_details",$arr);
        
        redirect("improvement/Improvement_result/presch_view/$subid");
    }
    function primaryresult_edit(){
        $stuid=$this->input->post("stuid");
        $subid=$this->input->post("subid");
        $grades=$this->input->post("grades");
        $clsid=$this->input->post("clsid");
        
        $arr=array(
                    'grade'=>$grades,
                    'updated_at'=>date("Y-m-d")
                );
        $this->db->where("student_id",$stuid);
        $this->db->where("subject_id",$subid);
        $this->db->update("primary_result",$arr);
        
        redirect("improvement/Improvement_result/view/$subid");
        // $this->load->view('layout/header', $data);
        // $this->load->view('improvement/Improvement_resultShow', $data);
        // $this->load->view('layout/footer', $data);
    }
    function kgresult_edit(){
       $grades=$this->input->post("grades");
        $kgid=$this->input->post("kgid");
        $title_id=$this->input->post("title_id");
        $des_id=$this->input->post("des_id");
        
        $arr=array(
                    'grade'=>$grades,
                    'updated_at'=>date("Y-m-d")
                );
        $this->db->where("id",$kgid);
        
        $this->db->update("kgimprovement_result_details",$arr);
        
        redirect("improvement/Improvement_result/kgresult_view/$title_id/$des_id");
        // $this->load->view('layout/header', $data);
        // $this->load->view('improvement/Improvement_resultShow', $data);
        // $this->load->view('layout/footer', $data);
    }
    function edit($id) {

      $this->session->set_userdata('top_menu', 'Improvement');
        $this->session->set_userdata('sub_menu', 'Improvement_result/index');
        $data['title'] = 'Edit Improvement Result';
        $data['title_list'] = 'Recent Improvements Result'; 
        $data['teacherlists'] = $this->Common_model->grab_teacher();
        $data['monthlist']= $this->Common_model->grab_month();  
        $data['grades'] = array(3=>"ေကာင္း",2=>"သင့္",1=>"လို");
        $data['classlists'] = $this->Common_model->grab_class();
        $data['sectionlists'] = $this->Common_model->grab_section();
        $data['lessons'] = $this->Common_model->grab_improvementdesc();
        $data["id"]=$id;
        $lists = $this->Improvement_result_model->get($id);
        $data['lists'] = $lists;
         $this->form_validation->set_rules('date', 'Date', 'trim|required|xss_clean');
         $this->form_validation->set_rules('teacher_id', 'Teacher', 'trim|required|xss_clean');
         $this->form_validation->set_rules('improvement_id', 'Improvement Title', 'trim|required|xss_clean');
         
           if ($this->form_validation->run() == FALSE) {

            $this->load->view('layout/header', $data);
            $this->load->view('improvement/Improvement_resultEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {

            
            $authority=$this->customlib->getAdminSessionUserName();
            $student_id=$this->input->post("student_id");          
            $class=$this->session->userdata("class");
            $grades=$this->input->post("grades");
            $weight=$this->input->post("weight");
            $height=$this->input->post("height");
            $section=$this->session->userdata("section");
            $teacher_id=$this->input->post("teacher_id");
            $improvement_id=$this->input->post("improvement_id");
            $month=$this->input->post("month");
            $date=date("Y-m-d",strtotime($this->input->post("date")));  
            
            $arr=array(
                            "class_id"=>$class,
                            "section_id"=>$section,
                            'teacher_id' => $teacher_id,
                            'improvement_id' => $improvement_id,
                            'authority' => $authority,
                            'reportcard_month'=>$month,
                            'created_at' => $date

                    );
                
                $this->db->where("id",$id);
                $this->db->update("improvement_result",$arr);
                
                $this->db->where("header_id",$id)->delete("improvement_result_details");

            for($i=0;$i<count($student_id);$i++)
            {
                $arr=array(
                            "header_id"=>$id,
                            "student_id"=>$student_id[$i],
                            'improvement_id' => $improvement_id,
                            "grade"=>$grades[$i],
                            "weight"=>$weight,
                            "height"=>$height,
                            'authority' => $authority,
                            'reportcard_month'=>$month,
                            'created_at' => $date

                    );
                $this->db->where("id",$id);
                $this->db->update("improvement_result_details",$arr);
            }
            
                 


          $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Improvement Results Edited successfully</div>');
          redirect('improvement/Improvement_result');
        }

    }

}

?>